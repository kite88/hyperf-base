<?php
declare(strict_types=1);

namespace App\Service;


use App\Util\JwtUtil;

class AuthService extends Service
{
    /**
     * @var JwtUtil
     */
    private $jwt;

    private $tokenCacheKey = 'AUTH_TOKEN_';

    public function __construct(JwtUtil $jwtUtil)
    {
        $this->jwt = $jwtUtil;
        $this->jwt->setKey(env('JWT_SECRET'));//jwt key
    }

    public function verifyLogin($email, $password)
    {

    }

    private function getUserToken($res)
    {
        $expireTime = time() + env('JWT_EXPIRE_TIME');
        $this->jwt->setExp($expireTime);//jwt 设置过期时间
        $this->jwt->setClaim($res);// 存储用户信息
        $token = $this->jwt->getToken();
        $res['token'] = $token;
        $res['expire_time'] = $expireTime;
        return $res;
    }

    /**
     * @param $token
     * @return int 返回用户ID
     */
    public function verifyToken($token)
    {
        $r = $this->jwt->verifyToken((string)$token);
        if (!$r) {
            return 0;
        }
        $u = $this->jwt->getClaim();
        //单点登录
        $redisToken = $this->redis->get($this->tokenCacheKey . $u['id']);
        if ($redisToken === null) {
            return 0;
        }
        if ($redisToken !== $token) {
            return -1;
        }
        return $u['id'];
    }

}
