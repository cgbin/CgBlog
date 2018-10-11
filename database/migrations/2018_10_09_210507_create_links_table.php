<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       if(!Schema::hasTable('links')){
            Schema::create('links',function($table){
            $table->increments('id')->comment('ID');//主键字段
            $table->string('links_name',30)->notNull()->default('')->comment('分类名');
            $table->string('links_desc',100)->default('')->comment('友链说明');
            $table->string('links_url')->notNull()->default('')->comment('友链url');
            $table->Integer('links_order')->notNull()->default('100')->comment('自定义排序');
            $table->Integer('links_status')->notNull()->default('0')->comment('状态');
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
        if(Schema::hasTable('links')){
            Schema::dropIfExists('links');
        }
    }
}
