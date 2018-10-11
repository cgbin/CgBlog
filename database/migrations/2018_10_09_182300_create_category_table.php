<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
     if(!Schema::hasTable('category')){
            Schema::create('category',function($table){
            $table->increments('id')->comment('ID');//主键字段
            $table->string('cate_name',30)->notNull()->default('')->comment('分类名');
            $table->Integer('cate_order')->notNull()->default('100')->comment('自定义排序');
            $table->Integer('cate_id')->nullable()->comment('分类id');
            $table->Integer('cate_clicks')->notNull()->default('0')->comment('点击数');
            $table->Integer('pid')->notNull()->default('0')->comment('父级id');
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
        if(Schema::hasTable('category')){
            Schema::dropIfExists('category');
        }
    }
}
