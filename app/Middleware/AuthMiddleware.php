<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Service\AuthService;
use App\Util\ApiUtil;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface as HttpResponse;
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

    public function __construct(ContainerInterface $container, HttpResponse $response, RequestInterface $request,AuthService $authService)
    {
        $this->container = $container;
        $this->response = $response;
        $this->request = $request;
        $this->authService = $authService;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $token = $request->getHeader('token');
        //return $this->response->json($token);
        $isValidToken = false;
        if (!$isValidToken) {
            return $this->response->json(['c'=>$this->authService->verifyLogin('','')]);
            //return $this->response->json(ApiUtil::unAuthorized());
        }
        return $handler->handle($request);
    }
}