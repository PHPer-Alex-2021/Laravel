<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index();//用户编号
            $table->string('content',200);//内容

            $table->integer('order')->default(0);//排序
            $table->string('title',200)->default('');;//标题
            $table->integer('status')->default(0);//审核状态
            $table->integer('click')->default(0);//点击
            $table->string('comment',200)->default('');//评论

            $table->timestamps();//
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
