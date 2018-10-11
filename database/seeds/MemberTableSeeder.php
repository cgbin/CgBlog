<?php

use Illuminate\Database\Seeder;

class MemberTableSeeder extends Seeder
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

        for ($i=0; $i <24 ; $i++) {
            $data[] = [
                'username' => $faker -> userName,
                'password' => bcrypt('123456'),
                'gender' => rand(1,3),
                'mobile' => $faker -> phoneNumber,
                'email' => $faker -> email,
                'avatar' => '\admin\static\default.png',
                'province' => '福建省',
                'city' => '福州市',
                'area' => '三坊七巷',
                'created_at' => date('Y-m-d H:i:s'),
                'type' => rand(1,2),
                'status' => rand(1,2),
            ];
        }

        DB::table('member')->insert($data);
    }
}
