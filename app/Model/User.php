<?php

declare (strict_types=1);

namespace App\Model;

/**
 * @property int $id
 * @property string $username
 * @property string $password
 * @property \Carbon\Carbon $created_at
 */
class User extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'created_time' => 'integer',
        'updated_time' => 'integer'
    ];

    protected $hidden = [
        'password'
    ];
}