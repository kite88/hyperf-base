<?php
declare(strict_types=1);

namespace App\Service;

use App\Exception\NormalApiException;
use App\Model\User;
use App\Util\PageUtil;
use App\Util\PasswordUtil;
use Hyperf\DbConnection\Db;
use Hyperf\Di\Annotation\Inject;


class UserService extends Service
{
    /**
     * @Inject()
     * @var PasswordUtil
     */
    private $pwdUtil;

    public function __construct()
    {
        $this->pwdUtil->setKey(env('PASSWORD_KEY'));
    }

    public function lists(array $where, int $pageIndex, int $pageSize)
    {
        $count = User::query()->where($where)->count();
        $Page = new PageUtil($count, $pageIndex, $pageSize);
        $list = User::query()
            ->where($where)
            ->offset($Page->offset)
            ->take($Page->length)
            ->get()->toArray();
        return [
            'page' => $Page->result,
            'list' => $list
        ];
    }

    public function find(int $id)
    {
        return User::query()->where('id',$id)->first();
    }

    public function create(array $data): bool
    {
        $User = new User();
        if ($User::where('username', $data['username'])->count() > 0) {
            throw new NormalApiException('该账户名已经存在！');
        }
        $User->username = $data['username'];
        $User->password = $this->pwdUtil->encrypt($data['password']);
        return $User->save() ? true : false;
    }

    public function edit(array $data): bool
    {
        if (User::where([['username', '=', $data['username']], ['id', '<>', $data['id']]])->count() > 0) {
            throw new NormalApiException('该账户名已经存在！');
        }
        $User = User::query()->find($data['id']);
        if ($User === null) {
            throw new NormalApiException("记录不存在");
        }
        $User->username = $data['username'];
        if ($data['password'] !== '') {
            $User->password = $this->pwdUtil->encrypt($data['password']);
        }
        return $User->save() ? true : false;
    }

    public function remove($id): int
    {
        return User::destroy($id);
    }

}