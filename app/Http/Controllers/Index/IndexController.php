<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Model\Admin\Article;
use App\Http\Model\Admin\Category;
use Illuminate\Support\Facades\Cache;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Redis;

class IndexController extends Controller
{

    //前台首页推荐文章   /  *get
    public function index(){

        /*$article_list = Article::Leftjoin('category', 'category.id', '=', 'article.cate_id')
            ->select('article.*', 'category.cate_name')
            ->orderBy('article.article_order','asc')
            ->where('article.status', '=', 1)
            ->paginate(6);*/

            //预加载添加添加select()条件限制时，必须要先取出关联的键
            //，否则无法读取关联数据：如
            // Article表的'cate_id'，关联 Category表的id
            $article_list = Article::
            orderBy('article_order','asc')
            ->where('status', '=', 1)
            ->with(['cate' => function ($query) {
                    $query->select('id','cate_name');
                }])
            ->paginate(6);


            /*Redis::set('name', 'Taylor');
            $user = Redis::get('name');

            dd($user);*/
    /*if (Cache::store('memcached')->has('key10086')) {
        //删除
        Cache::store('memcached')->forget('key10086');
        //添加缓存
        Cache::store('memcached')->put('hello', $article_list, 3600);
//          //获取缓存
        //$key = Cache::store('memcached')->get('key');
    }*/

           //$article_list = Cache::store('memcached')->get('hello');

   /* //按年月分组数据，并求当月记录总数
    $res = DB::select("select title from bg_article group by FROM_UNIXTIME(created_at, '%Y-%m'),title");


    //查询，按年月查询归档的数据
    $str = '2018-4';
    $month = strtotime($str);
    $res2=DB::select("select * from bg_article where FROM_UNIXTIME(created_at,'%Y%m') = FROM_UNIXTIME(?, '%Y%m') ",[$month]);*/

        return view('index.index',compact('article_list'));
    }


    //列表页   /{id}/edit   *get
    public function edit($id){

        //获取当前分类的所有父级和子级分类
        $cate_ids = Category::getcates((int)$id);

        //分类导航栏
        $cates = Category::select('id','cate_name')->find($cate_ids);
        //获取当前分类标题
        $now_cate = Category::select('id','cate_name')->find($id);
        //获取当前分类的所有文章
        $article_list = Article::
        Leftjoin('category', 'category.id', '=', 'article.cate_id')
            ->select('article.*', 'category.cate_name')
            ->orderBy('article.article_order','asc')
            ->where('article.status', '=', 1)
            ->whereIn('article.cate_id',$cate_ids)
            ->paginate(6);;

        return view('index.list',compact('cates','now_cate','article_list'));
    }

    //详情页   /{id} *get
    public function show($id)
    {

        //点击量自增1
        DB::table('article')->where('id',$id)->increment('clicks');

        //获取文章关联的分类名
        $detail = Article::Leftjoin('category', 'category.id', '=', 'article.cate_id')
            ->select('article.*', 'category.cate_name')
            ->where('article.status', '=', 1)
            ->find($id);

        //获取当前文章的分类的所有子分类id
        $cate_ids= Category::getcates($detail->cate_id);

        if ($cate_ids) {

        //上一篇
        $pre = Article::select('id', 'title')
            ->where('id', '<', $id)
            ->where('status',1)
            ->whereIn('cate_id',$cate_ids)
            ->orderBy('id','desc')
            ->first();

        //下一篇
        $next = Article::select('id', 'title')
            ->where('id', '>', $id)
            ->where('status',1)
            ->whereIn('cate_id',$cate_ids)
            ->orderBy('id','asc')
            ->first();

        //相关文章
        $likes = Article::select('id', 'title')
            ->where('id','<>',$id)
            ->where(['status'=>1 ,'cate_id'=> $detail->cate_id])
            ->take(6)
            ->get();

        //栏目最新
        $cate_new = Article::select('id', 'title')
            ->where(['status'=>1 ,'cate_id'=> $detail->cate_id])
            ->orderBy('updated_at','desc')
            ->take(8)
            ->get();
        //获取当前位置
        $position_ids = Category::getcates($detail->cate_id,false);

        $position= Category::find($position_ids);

        return view('index.show',compact('detail','pre','next','likes','cate_new','position'));
        }else{
            return view('index.show',compact('detail'));
        }
    }


    //添加页   /create *get
    public function create(){

        echo 'create';
    }


}
