<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNavsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       if(!Schema::hasTable('navs')){
            Schema::create('navs',function($table){
            $table->increments('id')->comment('ID');//主键字段
            $table->string('navs_name',30)->notNull()->default('')->comment('分类名');
            $table->string('navs_desc',100)->default('')->comment('友链说明');
            $table->string('navs_url')->notNull()->default('')->comment('友链url');
            $table->Integer('navs_order')->notNull()->default('100')->comment('自定义排序');
            $table->Integer('navs_status')->notNull()->default('0')->comment('状态');
            $table->Integer('created_at')->notNull()->default('0')->comment('创建时间');
            $table->Integer('updated_at')->notNull()->default('0')->comment('更新时间');
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
        if(Schema::hasTable('navs')){
            Schema::dropIfExists('navs');
        }
    }
}
