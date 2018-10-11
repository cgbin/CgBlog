<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
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
                'cate_name' => '慢生活',
                    'pid' => 0
                ],
                [
                'cate_name' => '学无止境',
                    'pid' => 0
                ],
                [
                'cate_name' => '随记',
                    'pid' => 1
                ],
                [
                'cate_name' => 'PHP',
                    'pid' => 2
                ],
                [
                'cate_name' => 'laravel',
                    'pid' => 2
                ],
                [
                'cate_name' => '关于我',
                    'pid' => 0
                ],

            ];


        DB::table('category')->insert($data);
    }
}
