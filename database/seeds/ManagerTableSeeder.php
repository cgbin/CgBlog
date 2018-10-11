<?php

use Illuminate\Database\Seeder;

class ManagerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        $data[0] = [
                'username' => 'admin',
                'password' => bcrypt('123'),
                'gender' => rand(1,3),
                'mobile' => rand(10000000000,19999999999),
                'email' => str_random(6).'@qq.com',
                'role_id' => '1',
                'created_at' => date('Y-m-d H:i:s',time()),
                'updated_at' => date('Y-m-d H:i:s',time()),
                'status' => '2'

            ];
        for ($i=1; $i <10 ; $i++) {
            $data[] = [
                'username' => str_random(6),
                'password' => bcrypt('123'),
                'gender' => rand(1,3),
                'mobile' => rand(10000000000,19999999999),
                'email' => str_random(6).'@qq.com',
                'role_id' => rand(1,5),
                'created_at' => date('Y-m-d H:i:s',time()),
                'updated_at' => date('Y-m-d H:i:s',time()),
                'status' => rand(1,2)

            ];
        }

        DB::table('manager')->insert($data);
    }
}
