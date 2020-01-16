<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;

// 授权相关功能的引用
use Illuminate\Foundation\Auth\User as Authenticatable;

// 消息推送
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    /**
     * 只有包含在该属性中的字段才能够被正常更新
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * 当我们需要对用户密码或其它敏感信息在用户实例通过数组或 JSON 显示时进行隐藏
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
