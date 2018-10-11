<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManagerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('manager')){
            Schema::create('manager',function($table){
            $table->increments('id')->comment('ID');//主键字段
            $table->string('username',20)->notNull()->comment('管理员名');//用户名,长度20的varchar,不能为nul
            $table->string('password')->notNull()->comment('密码');//密码, varchar(255),不能为null
            $table->enum('gender', [1,2,3])->notNull()->default('1')->comment('性别');//性别, 1-男, 2-女, 3=保密
            $table->string('mobile', 11)->comment('手机号码');//手机号, varchar(11)
            $table->string('email', 50)->comment('邮箱');//邮箱, varchar(50)
            $table->tinyInteger('role_id')->comment('角色id');//角色表中的主键id
            $table->timestamps();//created at和updated at时间字段(系统自己创建)
            $table->rememberToken()->comment('记住登录的token');//实现记住登录状态字段,用于存储token
            $table->enum('status', [1,2])->notNull()->default('2')->comment('帐号状态, 1-禁用, 2=启用');//帐号状态, 1-禁用, 2=启用
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(Schema::hasTable('manager')){
            Schema::dropIfExists('manager');
        }
    }
}
