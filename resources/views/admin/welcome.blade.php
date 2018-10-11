@extends('admin.common')

@section('title','我的桌面')

@section('content')
<div class="page-container">
    <p class="f-20 text-success">欢迎进入CgBlog <span class="f-14">v1.0</span>后台！</p>
    <p>  当前登录时间：<?php echo date('Y-m-d H:i:s'); ?></p>

    <table class="table table-border table-bordered table-bg mt-20">
        <thead>
            <tr>
                <th colspan="2" scope="col">服务器信息</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th width="30%">PHP版本</th>
                <td><span id="lbServerName"><?php echo PHP_VERSION; ?></span></td>
            </tr>
            <tr>
                <td>服务器IP地址</td>
                <td><?php echo $_SERVER['SERVER_ADDR'] ; ?></td>
            </tr>
            <tr>
                <td>服务器域名</td>
                <td><?php echo $_SERVER['SERVER_NAME'] ;?></td>
            </tr>
            <tr>
                <td>服务器端口 </td>
                <td><?php echo  $_SERVER['SERVER_PORT'] ; ?></td>
            </tr>
            <tr>
                <td>服务器版本 </td>
                <td><?php echo $_SERVER['SERVER_SOFTWARE']; ?></td>
            </tr>

            <tr>
                <td>服务器操作系统 </td>
                <td><?php echo PHP_OS; ?></td>
            </tr>
            <tr>
                <td>系统所在文件夹 </td>
                <td><?php echo $_SERVER['DOCUMENT_ROOT'] ; ?></td>
            </tr>
            <tr>
                <td>服务器脚本超时时间 </td>
                <td><?php echo get_cfg_var("max_execution_time")."秒"; ?></td>
            </tr>
            <tr>
                <td>数据库版本 </td>
                <td><?php echo mysqli_get_server_info(mysqli_connect(env('DB_HOST', '127.0.0.1'),env('DB_USERNAME', 'forge'),env('DB_PASSWORD', ''))); ?></td>
            </tr>
            <tr>
                <td>最大上传限制 </td>
                <td><?php echo get_cfg_var("upload_max_filesize")?get_cfg_var("upload_max_filesize"):"不允许上传附件";  ?></td>
            </tr>
            <tr>
                <td>脚本运行占用最大内存 </td>
                <td><?php echo get_cfg_var("memory_limit")?get_cfg_var("memory_limit"):"无"; ?></td>
            </tr>

            <tr>
                <td>进程用户名 </td>
                <td><?php echo Get_Current_User(); ?> </td>
            </tr>

        </tbody>
    </table>
</div>
@endsection