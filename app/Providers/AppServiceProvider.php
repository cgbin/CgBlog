<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\Model\Admin\Navs;
use App\Http\Model\Admin\Links;
use App\Http\Model\Admin\Article;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        //全局sql监听
        /*\DB::listen(function($query){
            $sql = $query->sql; //获取预处理sql语句
            $bindings = $query->bindings; //获取预处理语句绑定的参数
            $time = $query->time; //获取sql语句运行的毫秒数

        if ($time>10) {
            //慢于10ms的sql才写入日志文件
            \Log::debug(var_export(compact('sql','bindings','time'), true));
        }

        });*/


        //首页头部导航栏
        $navs = Navs::orderBy('navs_order')->get();
        //友情链接
        $links = Links::where('links_status', '=', 1)->orderBy('links_order')->get();
        //文章点击排行
        $clicks_rank =  Article::orderBy('article.clicks','desc')
            ->select('id','title','clicks')
            ->where('article.status', '=', 1)
            ->take(5)
            ->get();
        //最新文章
        $article_new =  Article::orderBy('article.updated_at','desc')
            ->select('id','title')
            ->where('article.status', '=', 1)
            ->take(8)
            ->get();

        View::share([
            'navs' => $navs,
            'links'=> $links,
            'clicks_rank'=>$clicks_rank,
            'article_new'=>$article_new,
            ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
