<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\AuthService;
use App\Util\ApiUtil;

class AuthController extends AbstractController
{
    public function login(AuthService $service)
    {
        if (!$this->request->has(['username', 'password'])) {
            return ApiUtil::abnormal('用户名或密码不能为空');
        }
        $username = $this->request->input('username');
        $password = $this->request->input('password');
        $res = $service->verifyLogin($username, $password);
        return ApiUtil::normal($res);
    }

    public function logout(AuthService $service)
    {
        if ($service->logout($this->request->getAttribute('uid')) === true) {
            return ApiUtil::normal(null, '退出登录成功');
        } else {
            return ApiUtil::abnormal('退出失败');
        }
    }

    public function refreshToken(AuthService $service)
    {
        $uid = $this->request->getAttribute('uid');
        return ApiUtil::normal($service->refreshToken($uid));
    }

}
