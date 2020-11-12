<?php

declare(strict_types=1);

/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

use Hyperf\HttpServer\Router\Router;

Router::addRoute(['GET', 'POST', 'HEAD'], '/', 'App\Controller\IndexController@index');
Router::get('/favicon.ico', function () {
    return '';
});


Router::post('/login', [\App\Controller\AuthController::class, 'login']);//登录
Router::addGroup('/', function () {
    Router::post('logout', [\App\Controller\AuthController::class, 'logout']);//退出登录
    Router::post('token', [\App\Controller\AuthController::class, 'refreshToken']);//刷新token
    Router::addGroup('user', function () {
        Router::get('', [\App\Controller\UserController::class, 'index']);
        Router::post('', [\App\Controller\UserController::class, 'create']);
    });


}, ['middleware' => [\App\Middleware\AuthMiddleware::class]]);
