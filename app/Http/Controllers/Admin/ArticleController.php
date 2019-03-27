<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Db;
use App\Http\Model\Admin\Article;
use App\Http\Model\Admin\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{

    //栏目列表页   article  *get
    public function article_index(){

        $list = Article::
            Leftjoin('category', 'category.id', '=', 'article.cate_id')
            ->select('article.*', 'category.cate_name')
            ->orderBy('article.article_order','asc')
            ->where('article.status', '>', -1)
            ->paginate(8);

       return view('admin.article.list',compact('list'));
    }

    //添加文章页 article/create *get
    public function article_create(){
        $cate_list = Category::getlist();
        return view('admin.article.add',compact('cate_list'));
    }

    //获取添加文章添加的数据 *post
    public function article_store(Request $request)
    {
        $input=$request->except('_token');

        if ($request->isMethod('post')) {

            $input = $request->input();

            $rules = [
            'title' => 'required|max:50',
            'editor' => 'required|max:20',
            'description' => 'required|max:255',
            'tags' => 'required|max:100',
            'content' => 'required',
            'article_order' => 'required|integer',
        ];

        $messages = [
            'title.required' => '标题为必填项',
            'editor.required' => '作者为必填项',
            'description.required' => '简介为必填项',
            'article_order.required' => '排序为必填项',
            'tags.required' => '标签为必填项',
            'content.required' => '内容为必填项',
            'title.max' => '标题字符最长为50位',
            'editor.max' => '作者字符最长为20位',
            'tags.max' => '标签字符最长为100位',
            'article_order.integer' => '排序必须为整数',
        ];

    $validator = Validator::make($input, $rules, $messages);

        if ($validator->fails()) {
            return redirect('admin/article_create')->withErrors($validator)->withInput();
        }

        $article= new Article();
        $article->title = $input['title'];
        $article->editor = $input['editor'];
        $article->tags = $input['tags'];
        $article->cate_id = $input['cate_id'];
        $article->description = $input['description'];
        $article->content = $input['content'];
        $article->thumb_pic = $input['thumb_pic'];
        $article->article_order = $input['article_order'];
        $article->save();

        if ($article) {
           return redirect('admin/article_index')->with('msg','添加成功');
        }else{
            return redirect('admin/article_index')->with('msg','添加失败');
        }
    }

    }

    //修改文章自定义排序
    public function  article_order(Request $request){

        $post = $request->input();
        if ($request->isMethod('post')) {
            $res = Article::where('id', $post['id'])->update(['article_order' => $post['order'] ]);

            if ($res !== false ) {
                return response()->json(
               [
                   'status' => 1,
                    'msg' => '修改成功'
                ]
           );
            }
        }else{
           return response()->json(
               [
                   'status' => 0,
                    'msg' => '修改失败'
                ]
           );
        }
    }

    //修改文章页  article/{id}/edit
    public function article_edit($id){
        $list = Article::find((int)$id);
        $cate_list = Category::getlist();

        return view('admin.article.edit',compact('list','cate_list'));
    }

    //获取提交的修改文章内容  article/{id} *PUT
    public function article_update(Request $request,$id){
        $id=(int)$id;
        $input=$request->except('_token','_method','file');


        if ($request->isMethod('PUT')) {

            $rules = [
            'title' => 'required|max:50',
            'editor' => 'required|max:20',
            'description' => 'required|max:255',
            'tags' => 'required|max:100',
            'content' => 'required',
            'article_order' => 'required|integer',
        ];

        $messages = [
            'title.required' => '标题为必填项',
            'editor.required' => '作者为必填项',
            'description.required' => '简介为必填项',
            'tags.required' => '标签为必填项',
            'article_order.required' => '排序为必填项',
            'content.required' => '内容为必填项',
            'title.max' => '标题字符最长为50位',
            'editor.max' => '作者字符最长为20位',
            'tags.max' => '标签字符最长为100位',
            'article_order.integer' => '排序必须为整数',
        ];

    $validator = Validator::make($input, $rules, $messages);

        if ($validator->fails()) {
            return redirect("admin/article_edit/$id")->withErrors($validator);
        }


        $res = Article::where('id',$id)->update($input);


        if ($res !== false ) {
           return redirect("admin/article_edit/$id")->with('msg','修改成功');
        }else{
            return redirect("admin/article_edit/$id")->with('msg','修改失败');
        }
    }

    }


    //软删除文章  article/{id} *DELETE
    public function article_destroy($id){

        $arrid = explode(',',$id);
        if($res=Article::whereIn('id',$arrid)->update(['status'=>-1])){

            return response()->json(
               [
                   'status' => 1,
                    'msg' => '删除成功'
                ]
           );
        }else{
            return response()->json(
               [
                   'status' => 0,
                    'msg' => '删除失败'
                ]
           );
        }
    }


    //文章的发布和下架   article/{id} *get
    public function article_show($id)
    {
        $id=(int)$id;

            $ar = Article::find($id);
            $status = $ar->status?0:1;
            $res = Article::where('id', $id)->update(['status' => $status ]);

        if ($res) {
                return response()->json(
               [
                   'status' => 1,
                    'msg' => '修改成功'
                ]
           );
        }else{
           return response()->json(
               [
                   'status' => 0,
                    'msg' => '修改失败'
                ]
           );
        }

    }


    //文章回收站
    public function article_del_store()
    {

        $list = Article::Leftjoin('category', 'category.id', '=', 'article.cate_id')
            ->select('article.*', 'category.cate_name')
            ->orderBy('article.id','desc')
            ->where('article.status',-1)
            ->get();

       return view('admin.article.del_store',compact('list'));
    }

    //彻底删除文章
    public function article_true_del($id)
    {

        $arrid =explode(',', $id);
        //先删除图片路径
        $allpic = Article::find($arrid);
        //循环删除
        foreach ($allpic as $k => $v) {
            if ($v->thumb_pic) {
                $thumb_pic_url = '.'. $v->thumb_pic;
                @unlink($thumb_pic_url);
            }
        }

        // 批量删除记录 destroy() 传入的值可为一个数组
        // 或 destroy(1,2,3)的形式
        $res = Article::destroy($arrid);
        // $res 返回的为影响的记录数 (int)

        if ($res) {
                return response()->json(
               [
                   'status' => 1,
                    'msg' => '修改成功'
                ]
           );
        }else{
           return response()->json(
               [
                   'status' => 0,
                    'msg' => '修改失败'
                ]
           );
        }
    }


    //图片异步上传
    public function uploader(Request $request)
    {
        /*array:3 [
          "Filename" => "`2(MVT0C%`2WLG%M[0WDM(D.png"
          "_token" => "Lc7JVvxo3aR2AiWolNXE094sZIu7isHA53mzsRPi"
          "Upload" => "Submit Query"
        ]*/

        $file = $request->file('Filedata');
        //文件是否上传成功
        if ($file->isValid()) {
            //原文件名
           $originalname= $file->getClientOriginalName();
           //后缀名
           $ext = $file->getClientOriginalExtension();
            //保存文件名
           $movename = uniqid().'.'.$ext;
           /* storre() 所需参数
           第1个参数为指定磁盘下的文件夹名
           第2个参数为保存的文件名
           第3个指定filesystems填写的指定磁盘名*/
        $path = $request->file('Filedata')->storeAs(date('Y-m-d'),
            $movename,'uploader');

        $url= config('filesystems.disks.uploader.url').'/'.$path;
        if ($path) {

            return response()->json([
            'status'=>1,
            'msg'=>'上传成功',
            'path'=> $url,
            'savepath'=>$path
            ]);
        }else{

            return response()->json([
            'status'=>0,
            'msg'=>'上传失败',
            ]);
        }


           //$path 返回 为字符串
           //"2018-05-01-18-41-56/2018-05-01-18-41-56-5ae847e948aa9.png"
        }
    }

}
