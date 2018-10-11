<?php

namespace App\Http\Middleware;

use Closure;
use Route;
use Auth;

class CheckRbac
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
            //Rbac鉴权，超级管理员无需验证权限
        if (Auth::guard('admin')->user()->role_id != '1') {
            //获取当前的路由，App\Http\Controllers\Admin\Indexcontroller@index
             $route = Route::currentRouteAction();
            //获取当前用户对应的角色已经具备的权限，注意例外
             $ac = Auth::guard('admin')->user()-> role -> auth_ac ;
             $ac = $ac . ',indexcontroller@index,indexcontroller@welcome,logincontroller@logout';
             //explode()方法：获取当前路由需要的部分
             $routeArr = explode('\\',$route);
             // end()方法：返回数组内的最后一个值
             $currentRoute = strtolower(end($routeArr));
             //判断权限
             if (strpos($ac, $currentRoute) === false ) {
                exit('
<body>
<script type="text/javascript" src="/admin/lib/jquery/1.9.1/jquery.min.js"></script><script type="text/javascript" src="/admin/lib/layer/2.4/layer.js"></script>
<script>layer.msg("您没有访问权限！",{icon:2,time:1500});</script>
</body>');
             }
        }
        //继续后续请求
        return $next($request);
    }
}
