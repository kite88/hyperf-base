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
namespace HyperfTest\Cases;

use App\Model\User;
use App\Util\PasswordUtil;
use HyperfTest\HttpTestCase;

/**
 * @internal
 * @coversNothing
 */
class UserTest extends HttpTestCase
{
    public function testUser()
    {
        /*$passwordUtil = new PasswordUtil(env('PASSWORD_KEY'));
        $userM = new User();
        $userM->username = 'test';
        $userM->password = $passwordUtil->encrypt('123123');
        $res = $userM->save();
        var_dump($res);*/
    }
}
