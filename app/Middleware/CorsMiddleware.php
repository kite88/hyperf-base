<?php

declare(strict_types=1);

namespace App\Middleware;

use Hyperf\Utils\Context;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Hyperf\HttpServer\Contract\RequestInterface as HttpRequest;

class CorsMiddleware implements MiddlewareInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var HttpRequest
     */
    protected $httpRequest;

    public function __construct(ContainerInterface $container, HttpRequest $httpRequest)
    {
        $this->container = $container;
        $this->httpRequest = $httpRequest;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $response = Context::get(ResponseInterface::class);
        $response = $response->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Credentials', 'true')
            ->withHeader('Access-Control-Allow-Headers', 'Origin, Content-Type, Cookie, X-CSRF-TOKEN, Accept, Authorization, X-XSRF-TOKEN, TOKEN')
            ->withHeader('Access-Control-Expose-Headers', 'Authorization, authenticated')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PATCH, PUT, OPTIONS, DELETE');
        Context::set(ResponseInterface::class, $response);
        return $handler->handle($request);
    }
}