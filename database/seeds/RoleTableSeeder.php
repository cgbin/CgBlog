<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data =[
                    [
                        'role_name' => '超级管理员',
                        'auth_ids' => '',
                        'auth_ac' => '',
                    ],
                    [
                        'role_name' => '审核员',
                        'auth_ids' => '',
                        'auth_ac' => '',
                    ],
                    [
                        'role_name' => '人员主管',
                        'auth_ids' => '',
                        'auth_ac' => '',
                    ],
                    [
                        'role_name' => '文员',
                        'auth_ids' => '',
                        'auth_ac' => '',
                    ],
                    [
                        'role_name' => '裁办',
                        'auth_ids' => '',
                        'auth_ac' => '',
                    ],
                ];


        DB::table('role')->insert($data);
    }
}
