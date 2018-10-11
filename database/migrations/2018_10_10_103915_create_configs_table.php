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
        if(!Schema::hasTable('configs')){
            Schema::create('configs',function($table){
            $table->increments('id')->comment('ID');//主键字段
            $table->string('configs_title',50)->nullable()->default('')->comment('配置项标题');
            $table->string('configs_name',20)->nullable()->default('')->comment('配置项变量名');
            $table->string('configs_type',20)->notNull()->default('')->comment('配置项类型');
            $table->text('configs_content')->nullable()->comment('配置项值');
            $table->string('configs_desc')->nullable()->comment('配置项简述');

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
        if(Schema::hasTable('configs')){
            Schema::dropIfExists('configs');
        }
    }
}
