<?php
declare(strict_types=1);

namespace App\Util;


class ApiUtil
{
    const SUCCESS_CODE = 200;
    const SUCCESS_MSG = "请求成功";

    const FAIL_CODE = 500;
    const FAIL_MSG = "致命错误";

    const UNAUTHORIZED_CODE = 401;
    const UNAUTHORIZED_MSG = "暂无权限，请先登录";
    const UNAUTHORIZED_S_MSG = "账号在别处登录，尝试重新登录";

    const FORBIDDEN_CODE = 403;
    const FORBIDDEN_MSG = "没有操作权限，拒绝请求";

    const NOTFOUND_CODE = 404;
    const NOTFOUND_MSG = "路由不存在";

    const METHOD_NOT_ALLOWED_CODE = 405;
    const METHOD_NOT_ALLOWED_MSG = "路由请求方式不对";

    private $result;

    public function __construct($data, $msg, $code)
    {
        if ($data === null) {
            $data = (Object)null;
        }
        $this->result = ['code' => $code, 'msg' => $msg, 'data' => $data];
    }

    public static function normal($data = null, $msg = self::SUCCESS_MSG, $code = self::SUCCESS_CODE)
    {
        $ApiUtil = new ApiUtil($data, $msg, $code);
        return $ApiUtil->result;
    }

    public static function abnormal($msg = self::FAIL_MSG)
    {
        $ApiUtil = new ApiUtil(null, $msg, self::FAIL_CODE);
        return $ApiUtil->result;
    }

    public static function unAuthorized($msg = self::UNAUTHORIZED_MSG)
    {
        $ApiUtil = new ApiUtil(null, $msg, self::UNAUTHORIZED_CODE);
        return $ApiUtil->result;
    }

    public static function notFound()
    {
        $ApiUtil = new ApiUtil(null, self::NOTFOUND_MSG, self::NOTFOUND_CODE);
        return $ApiUtil->result;
    }

    public static function methodNotAllowed()
    {
        $ApiUtil = new ApiUtil(null, self::METHOD_NOT_ALLOWED_MSG, self::METHOD_NOT_ALLOWED_CODE);
        return $ApiUtil->result;
    }

    public static function forbidden()
    {
        $ApiUtil = new ApiUtil(null, self::FORBIDDEN_CODE, self::FORBIDDEN_MSG);
        return $ApiUtil->result;
    }
}