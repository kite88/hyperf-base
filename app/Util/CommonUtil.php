<?php

declare(strict_types=1);

namespace App\Util;

class CommonUtil
{
    public static function headerPlus($param)
    {
        if (!is_array($param)) {
            return '';
        }
        if (count($param) === 0) {
            return '';
        }
        if (!isset($param[0])) {
            return '';
        }
        if ($param[0] === '') {
            return '';
        }
        if ($param[0] === null) {
            return '';
        }
        return $param[0];
    }
}