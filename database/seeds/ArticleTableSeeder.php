<?php

use Illuminate\Database\Seeder;

class ArticleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('zh_CN');

        $data = [];


        for ($i=0; $i <9 ; $i++) {
            $data[$i] = [
                'title' => str_random(10),
                'editor' => $faker -> userName,
                'tags' => str_random(5),
                'description' => str_random(100),
                'content' => str_random(100),
                'thumb_pic' => '\admin\static\default.png',
                'cate_id' => rand(1,5),
                'status' => 1,
                'created_at' => time(),
            ];
        }

        $data [10] = [
                'title' => '关于我',
                'editor' => 'admin',
                'tags' => '介绍',
                'description' => '站长介绍',
                'content' => '个人简介',
                'thumb_pic' => '',
                'cate_id' => 6,
                'status' => 1,
                'created_at' => time(),
            ];

        DB::table('article')->insert($data);
    }
}
