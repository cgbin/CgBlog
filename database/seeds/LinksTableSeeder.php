<?php

use Illuminate\Database\Seeder;

class LinksTableSeeder extends Seeder
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
                'links_name' => '后盾网',
                'links_url' => 'https://www.houdunwang.com',
                'links_desc' => '做网站的后盾网',
                'created_at' => time(),

                ],
                [
                'links_name' => '百度',
                'links_url' => 'https://www.houdunwang.com',
                'links_desc' => 'https://www.baidu.com',
                'created_at' => time(),
                ],

            ];


        DB::table('links')->insert($data);
    }
}
