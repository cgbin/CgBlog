<?php

namespace App\Http\Middleware;

use Closure;

class WebStatus
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
        //若网站关闭，则跳转到404页面
        if (!is_null(config('web.web_switch')) && !config('web.web_switch') ) {
            return response()->view('error.404', [], 404);
        }

        return $next($request);
    }
}
