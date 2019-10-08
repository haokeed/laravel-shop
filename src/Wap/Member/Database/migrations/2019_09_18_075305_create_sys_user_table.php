<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSysUserTable extends Migration
{
    /**
     * Run the migrations.
     * 运行数据库迁移
     * @return void
     */
    public function up()
    {
        Schema::create('sys_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nickname',60);
            $table->char('weixin_openid',64)->nullable();
            $table->string('image_head',255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * 回滚数据库迁移
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sys_user');
    }
}
