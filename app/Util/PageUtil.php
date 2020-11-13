<?php

declare(strict_types=1);

namespace App\Util;


class PageUtil
{
    public $offset = 0;
    public $length = 10;
    public $result = null;

    public function __construct($count, $pageIndex = 1, $pageSize = 10)
    {
        $pageIndex = $pageIndex <= 0 ? 1 : (int)$pageIndex;
        $pageSize = $pageSize <= 0 ? $this->length : (int)$pageSize;

        $this->offset = ($pageIndex - 1) * $pageSize;
        $this->length = $pageSize;
        $this->result = [
            'pageCount' => ceil($count / $pageSize),
            'pageSize' => $pageSize,
            'pageIndex' => $pageIndex,
            'itemCount' => $count,
        ];
    }

}