<?php

use Illuminate\Database\Seeder;

class AuthTableSeeder extends Seeder
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
            "auth_name"=> "文章管理",
            "controller"=> "",
            "action"=> "",
            "pid"=> "0",
            "is_nav"=> "1"
        ],
        [
            "auth_name"=> "文章列表",
            "controller"=> "ArticleController",
            "action"=> "article_index",
            "pid"=> "1",
            "is_nav"=> "1"
        ],
        [
            "auth_name"=> "添加文章",
            "controller"=> "ArticleController",
            "action"=> "article_create",
            "pid"=> "1",
            "is_nav"=> "2"
        ],
        [
            "auth_name"=> "获取添加文章提交的数据",
            "controller"=> "ArticleController",
            "action"=> "article_store",
            "pid"=> "1",
            "is_nav"=> "2"
        ],
        [
            "auth_name"=> "文章ajax自定义排序",
            "controller"=> "ArticleController",
            "action"=> "article_order",
            "pid"=> "1",
            "is_nav"=> "2"
        ],
        [
            "auth_name"=> "文章ajax上/下架",
            "controller"=> "ArticleController",
            "action"=> "article_show",
            "pid"=> "1",
            "is_nav"=> "2"
        ],
        [
            "auth_name"=> "文章软删除",
            "controller"=> "ArticleController",
            "action"=> "article_destroy",
            "pid"=> "1",
            "is_nav"=> "2"
        ],
        [
            "auth_name"=> "修改文章页",
            "controller"=> "ArticleController",
            "action"=> "article_edit",
            "pid"=> "1",
            "is_nav"=> "2"
        ],
        [
            "auth_name"=> "获取修改文章提交的数据",
            "controller"=> "ArticleController",
            "action"=> "article_update",
            "pid"=> "1",
            "is_nav"=> "2"
        ],
        [
            "auth_name"=> "彻底删除文章",
            "controller"=> "ArticleController",
            "action"=> "article_true_del",
            "pid"=> "1",
            "is_nav"=> "2"
        ],
        [
            "auth_name"=> "文章分类",
            "controller"=> "CateController",
            "action"=> "cate_index",
            "pid"=> "1",
            "is_nav"=> "1"
        ],
        [
            "auth_name"=> "文章回收站",
            "controller"=> "ArticleController",
            "action"=> "article_del_store",
            "pid"=> "1",
            "is_nav"=> "1"
        ],
        [
            "auth_name"=> "管理员管理",
            "controller"=> "",
            "action"=> "",
            "pid"=> "0",
            "is_nav"=> "1"
        ],
        [
            "auth_name"=> "管理员列表",
            "controller"=> "ManagerController",
            "action"=> "manager_list",
            "pid"=> "13",
            "is_nav"=> "1"
        ],
        [
            "auth_name"=> "权限列表",
            "controller"=> "AuthController",
            "action"=> "auth_list",
            "pid"=> "13",
            "is_nav"=> "1"
        ],
        [
            "auth_name"=> "ajax获取管理员列表",
            "controller"=> "ManagerController",
            "action"=> "manager_list_ajax",
            "pid"=> "13",
            "is_nav"=> "2"
        ],
        [
            "auth_name"=> "角色列表",
            "controller"=> "RoleController",
            "action"=> "role_list",
            "pid"=> "13",
            "is_nav"=> "1"
        ],
        [
            "auth_name"=> "添加权限",
            "controller"=> "AuthController",
            "action"=> "auth_add",
            "pid"=> "13",
            "is_nav"=> "2"
        ],
        [
            "auth_name"=> "会员管理",
            "controller"=> "",
            "action"=> "",
            "pid"=> "0",
            "is_nav"=> "1"
        ],
        [
            "auth_name"=> "会员列表",
            "controller"=> "MemberController",
            "action"=> "member_list",
            "pid"=> "19",
            "is_nav"=> "1"
        ],
        [
            "auth_name"=> "添加会员",
            "controller"=> "MemberController",
            "action"=> "member_add",
            "pid"=> "19",
            "is_nav"=> "2"
        ],
        [
            "auth_name"=> "ajax上传会员头像",
            "controller"=> "MemberController",
            "action"=> "avatar_upload",
            "pid"=> "19",
            "is_nav"=> "2"
        ],
        [
            "auth_name"=> "系统管理",
            "controller"=> "",
            "action"=> "",
            "pid"=> "0",
            "is_nav"=> "1"
        ],
        [
            "auth_name"=> "友情链接",
            "controller"=> "LinksController",
            "action"=> "links_index",
            "pid"=> "23",
            "is_nav"=> "1"
        ],
        [
            "auth_name"=> "自定义导航条",
            "controller"=> "NavsController",
            "action"=> "navs_index",
            "pid"=> "23",
            "is_nav"=> "1"
        ],
        [
            "auth_name"=> "网站配置项",
            "controller"=> "ConfigsController",
            "action"=> "configs_index",
            "pid"=> "23",
            "is_nav"=> "1"
        ],
        [
            "auth_name"=> "友链自定义排序修改",
            "controller"=> "LinksController",
            "action"=> "links_order",
            "pid"=> "23",
            "is_nav"=> "2"
        ],
        [
            "auth_name"=> "添加友情链接页面",
            "controller"=> "LinksController",
            "action"=> "links_create",
            "pid"=> "23",
            "is_nav"=> "2"
        ],
        [
            "auth_name"=> "获取添加友情链接的数据",
            "controller"=> "LinksController",
            "action"=> "links_store",
            "pid"=> "23",
            "is_nav"=> "2"
        ],
        [
            "auth_name"=> "上/下架,友情链接",
            "controller"=> "LinksController",
            "action"=> "links_show",
            "pid"=> "23",
            "is_nav"=> "2"
        ],
        [
            "auth_name"=> "删除友情链接",
            "controller"=> "LinksController",
            "action"=> "links_destroy",
            "pid"=> "23",
            "is_nav"=> "2"
        ],
        [
            "auth_name"=> "修改友情链接",
            "controller"=> "LinksController",
            "action"=> "links_edit",
            "pid"=> "23",
            "is_nav"=> "2"
        ],
        [
            "auth_name"=> "获取友链修改提交的数据",
            "controller"=> "LinksController",
            "action"=> "links_update",
            "pid"=> "23",
            "is_nav"=> "2"
        ],
        [
            "auth_name"=> "前台导航条自定义排序修改",
            "controller"=> "NavsController",
            "action"=> "navs_order",
            "pid"=> "23",
            "is_nav"=> "2"
        ],
        [
            "auth_name"=> "添加前台导航条页面",
            "controller"=> "NavsController",
            "action"=> "navs_create",
            "pid"=> "23",
            "is_nav"=> "2"
        ],
        [
            "auth_name"=> "获取添加导航条提交的数据",
            "controller"=> "NavsController",
            "action"=> "navs_store",
            "pid"=> "23",
            "is_nav"=> "2"
        ],
        [
            "auth_name"=> "删除导航条",
            "controller"=> "NavsController",
            "action"=> "navs_destroy",
            "pid"=> "23",
            "is_nav"=> "2"
        ],
        [
            "auth_name"=> "修改前台导航条页面",
            "controller"=> "NavsController",
            "action"=> "navs_edit",
            "pid"=> "23",
            "is_nav"=> "2"
        ],
        [
            "auth_name"=> "获取修改导航条提交的数据",
            "controller"=> "NavsController",
            "action"=> "navs_update",
            "pid"=> "23",
            "is_nav"=> "2"
        ],
        [
            "auth_name"=> "添加网站配置项页面",
            "controller"=> "ConfigsController",
            "action"=> "configs_create",
            "pid"=> "23",
            "is_nav"=> "2"
        ],
        [
            "auth_name"=> "获取添加网站配置项提交的数据",
            "controller"=> "ConfigsController",
            "action"=> "configs_store",
            "pid"=> "23",
            "is_nav"=> "2"
        ],
        [
            "auth_name"=> "删除网站配置项",
            "controller"=> "ConfigsController",
            "action"=> "configs_destroy",
            "pid"=> "23",
            "is_nav"=> "2"
        ],
        [
            "auth_name"=> "修改网站配置项页面",
            "controller"=> "ConfigsController",
            "action"=> "configs_edit",
            "pid"=> "23",
            "is_nav"=> "2"
        ],
        [
            "auth_name"=> "获取修改网站配置项提交的数据",
            "controller"=> "ConfigsController",
            "action"=> "configs_update",
            "pid"=> "23",
            "is_nav"=> "2"
        ],
        [
            "auth_name"=> "获取写入web.php配置文件的参数",
            "controller"=> "ConfigsController",
            "action"=> "get_put",
            "pid"=> "23",
            "is_nav"=> "2"
        ],
        [
            "auth_name"=> "修改管理员密码",
            "controller"=> "ManagerController",
            "action"=> "manager_changepwd",
            "pid"=> "13",
            "is_nav"=> "2"
        ],
        [
            "auth_name"=> "删除管理员",
            "controller"=> "ManagerController",
            "action"=> "manager_destroy",
            "pid"=> "13",
            "is_nav"=> "2"
        ]
                ];


        DB::table('auth')->insert($data);
    }
}
