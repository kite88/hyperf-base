<?php

declare(strict_types=1);

namespace App\Controller;

use App\Controller\Validator\BaseValidator;
use App\Service\UserService;
use App\Util\ApiUtil;
use Hyperf\Di\Annotation\Inject;


class UserController extends AbstractController
{

    /**
     * @Inject()
     * @var UserService
     */
    private $UserService;

    public function index()
    {
        $where = [];
        $p = $this->request->input('p', 1);
        $list = $this->UserService->lists($where, (int)$p, 10);
        return ApiUtil::normal($list);
    }

    public function find(int $id)
    {
        BaseValidator::make(['id' => $id], ['id' => 'gt:0']);
        return ApiUtil::normal($this->UserService->find($id));
    }

    public function create()
    {
        $data = $this->request->all();
        BaseValidator::make($data, [
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => '用户名必须填写',
            'password.required' => '密码必须填写',
        ]);
        return $this->UserService->create($data) ? ApiUtil::normal(null, '创建成功') : ApiUtil::abnormal('创建失败');
    }

    public function edit()
    {
        $data = $this->request->all();
        BaseValidator::make($data, [
            'id' => 'required|integer|gt:0',
            'username' => 'required',
            'password' => ''
        ], [
            'username.required' => '用户名必须填写',
        ]);
        $data['password'] = $data['password'] ?? '';
        return $this->UserService->edit($data) ? ApiUtil::normal(null, '修改成功') : ApiUtil::abnormal("修改失败");
    }

    public function remove(int $id)
    {
        $data['id'] = $id;
        BaseValidator::make($data, [
                'id' => 'required|integer|gt:0']
        );
        return $this->UserService->remove($data['id']) > 0 ? ApiUtil::normal(null, '删除成功') : ApiUtil::abnormal('删除失败');
    }
}
