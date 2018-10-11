<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('article')){
            Schema::create('article',function($table){
            $table->increments('id')->comment('ID');//主键字段
            $table->string('title',50)->notNull()->comment('文章标题');
            $table->string('editor',20)->notNull()->comment('作者');
            $table->string('tags',100)->notNull()->default('')->comment('标签');
            $table->string('description', 200)->notNull()->default('')->comment('描述');
            $table->text('content')->notNull()->comment('内容');
            $table->string('thumb_pic')->nullable()->comment('缩略图');//头像路径
            $table->Integer('clicks')->notNull()->default('0')->comment('点击数');
            $table->Integer('article_order')->notNull()->default('100')->comment('自定义排序');
            $table->Integer('cate_id')->nullable()->comment('分类id');
            $table->tinyInteger('status')->notNull()->default('0')->comment('文章状态');
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
        if(Schema::hasTable('article')){
            Schema::dropIfExists('article');
        }
    }
}
