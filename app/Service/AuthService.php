<?php
declare(strict_types=1);

namespace App\Service;


use App\Exception\NormalApiException;
use App\Model\User;
use App\Util\JwtUtil;
use App\Util\PasswordUtil;
use Psr\Container\ContainerInterface;

class AuthService extends Service
{
    /**
     * @var JwtUtil
     */
    private $jwt;

    /**
     * @var PasswordUtil
     */
    private $pwdUtil;

    private $redis;

    private $tokenCacheKey = 'AUTH_TOKEN_';

    public function __construct(JwtUtil $jwtUtil, PasswordUtil $pwdUtil, ContainerInterface $container)
    {
        $this->pwdUtil = $pwdUtil;
        $this->pwdUtil->setKey(env('PASSWORD_KEY')); //pwd key
        $this->jwt = $jwtUtil;
        $this->jwt->setKey(env('JWT_SECRET'));//jwt key
        $this->redis = $container->get(\Redis::class);
        $this->tokenCacheKey = env('REDIS_PREFIX') . $this->tokenCacheKey;
    }

    public function verifyLogin($username, $password)
    {
        $userModel = new User();
        $result = $userModel::query()
            ->where('username', $username)
            ->first(['*']);
        if ($result === null) {
            throw new NormalApiException('账户不存在');
        }
        if (!$this->pwdUtil->verify($password, (string)$result->password)) {
            throw new NormalApiException('密码错误');
        }
        return $this->getUserToken($result->toArray());
    }

    private function getUserToken($user)
    {
        $expireTime = time() + env('JWT_EXPIRE_TIME');
        $this->jwt->setExp($expireTime);//jwt 设置过期时间
        $this->jwt->setClaim($user);// 存储用户信息
        $token = $this->jwt->getToken();
        $res['Profile'] = $user;
        $res['Token'] = [
            'token' => $token,
            'expire_time' => $expireTime
        ];
        //存入redis
        $this->redis->set($this->tokenCacheKey . $user['id'], $token);
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
