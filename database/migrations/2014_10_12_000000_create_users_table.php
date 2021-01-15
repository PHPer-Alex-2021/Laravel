<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');//昵称
            $table->string('email')->unique();//邮箱
            $table->string('password');//密码
            $table->tinyInteger('is_admin')->default(0);//是否是管理员
            $table->string('email_token');//邮箱令牌
            $table->tinyInteger('email_active');//是否激活
            $table->rememberToken();//记住密码
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
