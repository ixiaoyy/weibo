<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * 迁移数据-生成数据
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('users', function (Blueprint $table) { 建表 , 固定写法
        Schema::create('users', function (Blueprint $table) {
            // 定义自增ID  $table->increments('id');
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            // timestamp 日期类型 格式： 2020-01-14 00:00:01  nullable() 可以为空，默认为空;
            $table->timestamp('email_verified_at')->nullable();
            // $table->string('password', 60); 可增加第二个参数，限制长度
            $table->string('password');
            // $table->rememberToken(); 固定写法为用户创建一个 remember_token 字段，用于保存『记住我』的相关信息。
            $table->rememberToken();
            // $table->timestamps(); 固定写法，创建一个 created_at 和一个 updated_at 字段，分别用于保存创建时间和更新时间。
            $table->timestamps();
        });
    }

    /**
     * 回滚迁移
     *
     * @return void
     */
    public function down()
    {
        // 回滚迁移
        Schema::dropIfExists('users');
    }
}
