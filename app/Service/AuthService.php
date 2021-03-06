<?php
declare(strict_types=1);

namespace App\Service;


use App\Exception\NormalApiException;
use App\Model\User;
use App\Util\JwtUtil;
use App\Util\PasswordUtil;
use Hyperf\Di\Annotation\Inject;
use Psr\Container\ContainerInterface;

class AuthService extends Service
{
    /**
     * @Inject()
     * @var JwtUtil
     */
    private $jwt;

    /**
     * @Inject()
     * @var PasswordUtil
     */
    private $pwdUtil;

    /**
     * @Inject()
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var mixed|\Redis
     */
    private $redis;

    /**
     * @var string
     */
    private $tokenCacheKey = 'AUTH_TOKEN_';

    public function __construct()
    {
        $this->pwdUtil->setKey(env('PASSWORD_KEY')); //pwd key
        $this->jwt->setKey(env('JWT_SECRET'));//jwt key
        $this->redis = $this->container->get(\Redis::class);
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

    public function logout($uid)
    {
        return $this->redis->del($this->tokenCacheKey . $uid) > 0 ? true : false;
    }

    public function refreshToken($uid)
    {
        $userModel = new User();
        $result = $userModel::query()
            ->where('id', $uid)
            ->first(['*']);
        return $this->getUserToken($result->toArray());
    }

}
