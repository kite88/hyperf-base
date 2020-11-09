<?php

declare(strict_types=1);

namespace App\Controller;

use App\Exception\NormalApiException;
use App\Util\ApiUtil;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Annotation\PostMapping;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;


class UserController
{
    public function index(RequestInterface $request, ResponseInterface $response)
    {
        return ApiUtil::abnormal('正常异常');
    }

    public function create()
    {
        return 'create';
    }
}
