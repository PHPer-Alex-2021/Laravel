<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('conf_title');//标题
            $table->string('conf_name');//名称
            $table->string('conf_type')->default(0);//类型
            $table->string('conf_content')->default('');//类型值
            $table->string('conf_order')->default(0);//排序
            $table->string('conf_tips')->default('');//说明
            $table->string('conf_values')->default('');//类型值
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
        Schema::dropIfExists('configs');
    }
}
