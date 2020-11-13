<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\AuthService;
use App\Util\ApiUtil;
use Hyperf\Di\Annotation\Inject;

class AuthController extends AbstractController
{
    /**
     * @Inject()
     * @var AuthService
     */
    private $AuthService;

    public function login()
    {
        if (!$this->request->has(['username', 'password'])) {
            return ApiUtil::abnormal('用户名或密码不能为空');
        }
        $username = $this->request->input('username');
        $password = $this->request->input('password');
        $res = $this->AuthService->verifyLogin($username, $password);
        return ApiUtil::normal($res);
    }

    public function logout()
    {
        if ($this->AuthService->logout($this->request->getAttribute('uid')) === true) {
            return ApiUtil::normal(null, '退出登录成功');
        } else {
            return ApiUtil::abnormal('退出失败');
        }
    }

    public function refreshToken()
    {
        $uid = $this->request->getAttribute('uid');
        return ApiUtil::normal($this->AuthService->refreshToken($uid));
    }

}
