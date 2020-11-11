<?php

declare(strict_types=1);

namespace App\Controller;

use App\Util\ApiUtil;


class UserController extends AbstractController
{
    public function index()
    {
        return ApiUtil::normal(['uid' => $this->request->getAttribute('uid')]);
    }

    public function create()
    {
        return ApiUtil::normal();
    }
}
