<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Service\AuthService;
use App\Util\ApiUtil;
use App\Util\CommonUtil;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface as HttpResponse;
use Hyperf\Utils\Context;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AuthMiddleware implements MiddlewareInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var HttpResponse
     */
    protected $response;

    /**
     * @var AuthService
     */
    protected $authService;

    public function __construct(ContainerInterface $container, HttpResponse $response, RequestInterface $request, AuthService $authService)
    {
        $this->container = $container;
        $this->response = $response;
        $this->request = $request;
        $this->authService = $authService;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $token = CommonUtil::headerPlus($request->getHeader('token'));
        if ($token === '') {
            return $this->response->json(ApiUtil::unAuthorized());
        }
        $uid = $this->authService->verifyToken($token);
        if ($uid === 0) {
            return $this->response->json(ApiUtil::unAuthorized());
        } elseif ($uid === -1) {
            return $this->response->json(ApiUtil::unAuthorized(ApiUtil::UNAUTHORIZED_S_MSG));
        }
        //写入用户ID信息
        $request = Context::get(ServerRequestInterface::class);
        $request = $request->withAttribute('uid', $uid);
        Context::set(ServerRequestInterface::class, $request);
        return $handler->handle($request);
    }
}