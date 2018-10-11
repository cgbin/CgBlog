<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('role')){
            Schema::create('role',function($table){
                  $table -> increments('id');//主鍵
                  $table -> string('role_name' ,20) -> notNull();//角色名称
                  $table -> text('auth_ids');//权限id集合
                  $table -> text('auth_ac');//权限控制器和方法組合字符串
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
        if(Schema::hasTable('role')){
            Schema::dropIfExists('role');
        }
    }
}
