<p align="center">CgBlog</p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## 介绍

功能:

- 文章管理模块
- 文章分类管理
- 文章回收站
- RBAC权限管理模块
- 友情链接管理
- 自定义导航条前台
- 网站配置项



## 安装教程

环境要求:

- Composer
- PHP >= 5.5.9
  
  
## 步骤

步骤一  
安装 CgBlog  
`composer create-project qsnh/meedu=dev-master` 

步骤二  
配置数据库，打开 .env 文件，修改下面的内容： 

```
DB_CONNECTION=mysql  
DB_HOST=127.0.0.1  
DB_PORT=3306  
DB_DATABASE=homestead  
DB_USERNAME=homestead  
DB_PASSWORD=secret
```
  
配置基本信息

```
APP_NAME=MeEdu
APP_ENV=local(这里如果正式运行，请修改为：production)
APP_KEY=
APP_DEBUG=true(这里如果是正式运行，请修改为：false)
APP_LOG_LEVEL=debug
APP_URL=http://localhost(这里修改你自己的地址)
```

生成加密密钥：  

`php artisan key:generate`

步骤三  
创建上传目录软链接： 

`php artisan storage:link`

步骤四  
设置 storage 目录和 configs/web.php 权限为 777

```
chomod -R  0777 storage
chomod -R  0777 config/web.php 777
````

步骤五  
配置伪静态并设置 meedu 的运行目录为 public 。

伪静态规则（Nginx）：

```
location / {  
	try_files $uri $uri/ /index.php$is_args$query_string;  
}
```

步骤六  
安装数据表
`php artisan migrate`
执行填充文件
`php artisan db:seed`

步骤七  
到这里，网站可以正常访问了。但是想要整个程序完整运行，还需进行后续配置。

后台登录地址：http://youdomain.com/admin/index
超级管理员账号: admin  密码: 123


