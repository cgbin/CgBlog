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

`DB_CONNECTION=mysql  
    DB_HOST=127.0.0.1  
    DB_PORT=3306  
    DB_DATABASE=homestead  
    DB_USERNAME=homestead  
    DB_PASSWORD=secret`  
  
配置基本信息

`APP_NAME=MeEdu
APP_ENV=local(这里如果正式运行，请修改为：production)
APP_KEY=
APP_DEBUG=true(这里如果是正式运行，请修改为：false)
APP_LOG_LEVEL=debug
APP_URL=http://localhost(这里修改你自己的地址)`

