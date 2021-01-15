<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cate_name');//分类名称
            $table->string('cate_title');//分类标题
            $table->string('cate_keywords');//关键字
            $table->string('cate_description')->default('');//描述
            $table->integer('cate_view')->default(0);//浏览次数
            $table->integer('cate_order')->default(0);//排序
            $table->integer('cate_pid')->default(0);//父级分类
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
        Schema::dropIfExists('categories');
    }
}
