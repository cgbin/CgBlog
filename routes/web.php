<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware'=>['webstatus'],'namespace'=>'Index'],function(){
    //前台首页
    Route::get('/', 'IndexController@index' );
    //详情页  /{id}      *get
    Route::resource('/index', 'IndexController' );

});




Route::group(['prefix'=>'admin','namespace' => 'Admin'],function (){
    //后台登录页面
    Route::get('login', 'LoginController@index')->name('login');
    //登录表单提交验证
    Route::post('check', 'LoginController@check');
});

Route::group(['prefix'=>'admin','middleware'=>['auth:admin','checkrbac'],'namespace' => 'Admin'],function (){
    //退出登录
    Route::get('logout', 'LoginController@logout')->name('logout');
    //后台首页
    Route::get('index', 'IndexController@index');
    //后台welcome页面
    Route::get('welcome', 'IndexController@welcome');
    //管理员列表
    Route::get('manager_list', 'ManagerController@manager_list');
    //ajax获取管理员列表
    Route::get('manager_list_ajax', 'ManagerController@manager_list_ajax');
    //管理员密码修改
    Route::any('manager_changepwd/{id}', 'ManagerController@manager_changepwd');
    //管理员删除
    Route::any('manager_destroy/{id}', 'ManagerController@manager_destroy');
    //权限列表
    Route::get('auth_list', 'AuthController@auth_list');
    //添加权限
    Route::any('auth_add', 'AuthController@auth_add');
    //角色列表
    Route::get('role_list', 'RoleController@role_list');
    //为角色分配权限
    Route::any('role_auth_add/{id}', 'RoleController@role_auth_add');
    //编辑角色
    Route::any('role_edit', 'RoleController@role_edit');
    //会员列表
    Route::get('member_list', 'MemberController@member_list');
    //添加会员
    Route::any('member_add', 'MemberController@member_add');
    //ajax上传会员头像
    Route::any('avatar_upload', 'MemberController@avatar_upload');


    //blog
    //文章管理
    //article/index首页
    Route::get('article_index', 'ArticleController@article_index' );
    //添加文章
    Route::get('article_create', 'ArticleController@article_create' );
    //获取添加文章提交的数据
    Route::post('article_store', 'ArticleController@article_store' );
    //文章自定义排序修改
    Route::post('article_order','ArticleController@article_order');
    //文章上下架
    Route::get('article_show/{id}','ArticleController@article_show');
    //软删除文章
    Route::any('article_destroy/{id}','ArticleController@article_destroy');
    //修改文章页
    Route::get('article_edit/{id}','ArticleController@article_edit');
    //获取修改文章提交的数据
    Route::any('article_update/{id}','ArticleController@article_update');
    //文章回收站
    Route::get('article_del_store','ArticleController@article_del_store' );
    //彻底删除文章
    Route::get('article_true_del/{id}','ArticleController@article_true_del' );


    //分类管理
    //分类列表
    Route::get('cate_index', 'CateController@cate_index' );
    //修改自定义排序
    Route::post('cate_store', 'CateController@cate_store' );
    //添加分类
    Route::any('cate_add', 'CateController@cate_add' );
    //修改分类
    Route::any('cate_edit/{id}', 'CateController@cate_edit' );
    //删除分类
    Route::any('cate_destroy/{id}', 'CateController@cate_destroy' );

    //友情链接管理
    //友情链接列表
    Route::get('links_index','LinksController@links_index');
    //友链自定义排序修改
    Route::post('links_order','LinksController@links_order');
    //添加链接
    Route::get('links_create', 'LinksController@links_create' );
    //获取添加链接添加的数据 *post
    Route::post('links_store','LinksController@links_store');
     //上下架
    Route::get('links_show/{id}','LinksController@links_show');
    //删除
    Route::any('links_destroy/{id}','LinksController@links_destroy');
    //修改
    Route::get('links_edit/{id}','LinksController@links_edit');
    //获取修改提交的数据
    Route::any('links_update/{id}','LinksController@links_update');

    //自定义前台导航条管理
    //前台导航条列表
    Route::get('navs_index','NavsController@navs_index');
    //前台导航条自定义排序修改
    Route::post('navs_order','NavsController@navs_order');
    //添加前台导航条
    Route::get('navs_create', 'NavsController@navs_create' );
    //获取添加的数据 *post
    Route::post('navs_store','NavsController@navs_store');
    //删除
    Route::any('navs_destroy/{id}','NavsController@navs_destroy');
    //修改
    Route::get('navs_edit/{id}','NavsController@navs_edit');
    //获取修改提交的数据
    Route::any('navs_update/{id}','NavsController@navs_update');


    //网站配置项
    //列表
    Route::get('configs_index','ConfigsController@configs_index');
    //添加
    Route::get('configs_create', 'ConfigsController@configs_create' );
    //获取添加的数据 *post
    Route::post('configs_store','ConfigsController@configs_store');
    //删除
    Route::any('configs_destroy/{id}','ConfigsController@configs_destroy');
    //修改
    Route::get('configs_edit/{id}','ConfigsController@configs_edit');
    //获取修改提交的数据
    Route::any('configs_update/{id}','ConfigsController@configs_update');
    //获取写入web.php配置文件的参数
    Route::post('get_put','ConfigsController@get_put');

});

