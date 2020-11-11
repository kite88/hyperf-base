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

namespace App\Model;


abstract class Model extends \Hyperf\DbConnection\Model\Model
{
    public $timestamps = true;
    public $incrementing = true;

    const CREATED_AT = 'created_time';
    const UPDATED_AT = 'updated_time';

    protected $dateFormat = 'U';

    protected $primaryKey = 'id';

}
