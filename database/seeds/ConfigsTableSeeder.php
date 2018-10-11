<?php

use Illuminate\Database\Seeder;

class ConfigsTableSeeder extends Seeder
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
                'configs_title' => '网站标题',
                'configs_name' => 'web_title',
                'configs_type' => 'input',
                'configs_content' => 'CgBlog',
                'configs_desc' => '网站标题',

                ],
                [
                'configs_title' => '网站状态',
                'configs_name' => 'web_switch',
                'configs_type' => 'radio',
                'configs_content' => '1',
                'configs_desc' => '网站状态开关',

                ],
                [
                'configs_title' => '网站统计js代码',
                'configs_name' => 'web_visit',
                'configs_type' => 'textarea',
                'configs_content' => '\'<script type=\"text/javascript\">\r\n        var _bdhmProtocol = ((\"https:\" == document.location.protocol) ? \" https://\" : \" http://\");\r\n        document.write(unescape(\"%3Cscript src=\'\" + _bdhmProtocol + \r\n\"hm.baidu.com/h.js%3F01234567890ABCDEF01234567890ABCDEF\' type=\'text/javascript\'%3E%3C/script%3E\"));\r\n        </script>\'',
                'configs_desc' => '网站统计js代码',

                ],
                [
                'configs_title' => '备案号',
                'configs_name' => 'web_beian',
                'configs_type' => 'input',
                'configs_content' => '闽b-10086',
                'configs_desc' => '网站备案号',

                ],
                [
                'configs_title' => '网站描述',
                'configs_name' => 'web_description',
                'configs_type' => 'textarea',
                'configs_content' => '<p>打了死结的青春，捆死一颗苍白绝望的灵魂。</p>\r\n<p>为自己掘一个坟墓来葬心，红尘一梦，不再追寻。</p>\r\n <p>加了锁的青春，不会再因谁而推开心门。</p>',
                'configs_desc' =>  '首页头部描述一些个人座右铭的',

                ],
                [
                'configs_title' => '网站链接',
                'configs_name' => 'web_url',
                'configs_type' => 'textarea',
                'configs_content' => 'http://localhost/www',
                'configs_desc' =>  '首页底部网站链接',

                ],
                [
                'configs_title' => '网站创始人',
                'configs_name' => 'web_editor',
                'configs_type' => 'input',
                'configs_content' => 'cgbin',
                'configs_desc' =>  '网站创始人',

                ],

            ];

        DB::table('configs')->insert($data);
    }
}
