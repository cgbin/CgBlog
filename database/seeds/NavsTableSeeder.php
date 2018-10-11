<?php

use Illuminate\Database\Seeder;

class NavsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
                [
                'navs_name' => '首页',
                'navs_url' => env('APP_URL'),
                'navs_desc' => '进入首页',
                'navs_order' => 1,
                'created_at' => time(),

                ],
                [
                'navs_name' => '慢生活',
                'navs_url' => env('APP_URL').'/index/1/edit',
                'navs_desc' => '慢生活',
                'navs_order' => 2,
                'created_at' => time(),
                ],
                [
                'navs_name' => '学无止境',
                'navs_url' => env('APP_URL').'/index/2/edit',
                'navs_desc' => '学无止境',
                'navs_order' => 3,
                'created_at' => time(),
                ],
                [
                'navs_name' => '关于我',
                'navs_url' => env('APP_URL').'/index/10',
                'navs_desc' => '关于我的介绍',
                'navs_order' => 4,
                'created_at' => time(),
                ],

            ];

        DB::table('navs')->insert($data);
    }
}
