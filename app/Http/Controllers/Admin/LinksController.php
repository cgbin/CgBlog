<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Db;
use App\Http\Model\Admin\Links;
use Illuminate\Support\Facades\Validator;

class LinksController extends Controller
{

    //链接列表页   links  *get
    public function links_index(){

        $links_list = Links::orderBy('links_order','asc')->get();

       return view('admin.links.list',compact('links_list'));
    }

    //添加链接页 links/create *get
    public function links_create(){

        return view('admin.links.add');
    }

    //修改自定义排序
    public function  links_order(Request $request){

        $post = $request->input();
        if ($request->isMethod('post')) {
            $res = Links::where('id', $post['id'])->update(['links_order' => $post['order'] ]);

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

    //获取添加链接添加的数据 *post
    public function links_store(Request $request)
    {
        $input=$request->except('_token');

        if ($request->isMethod('post')) {

            $input = $request->input();

            $rules = [
            'links_name' => 'required|max:20',
            'links_url' => 'required|max:255',
            'links_desc' => 'required|max:100',
            'links_order' => 'required|integer',
        ];

        $messages = [
            'links_name.required' => '友链名为必填项',
            'links_url.required' => '友链地址为必填项',
            'links_desc.required' => '友链简介为必填项',
            'links_order.required' => '友链排序为必填项',
            'links_name.max' => '友链名字符最长为20位',
            'links_url.max' => '友链地址字符最长为255位',
            'links_desc.max' => '友链简介字符最长为100位',
            'links_order.integer' => '友链排序必须为整数',
        ];

    $validator = Validator::make($input, $rules, $messages);

        if ($validator->fails()) {
            return redirect('admin/links/create')->withErrors($validator)->withInput();
        }

        $links= new links();
        $links->links_name = $input['links_name'];
        $links->links_url = $input['links_url'];
        $links->links_desc = $input['links_desc'];
        $links->links_order = $input['links_order'];
        $links->save();

        if ($links) {
           return redirect('admin/links_index')->with('msg','添加成功');
        }else{
            return redirect('admin/links_index')->with('msg','添加失败');
        }
    }

    }

    //修改链接页  links/{id}/edit
    public function links_edit($id){

        $list = links::find((int)$id);

        return view('admin.links.edit',compact('list'));
    }

    //获取提交的修改链接内容  links/{id} *PUT
    public function links_update(Request $request,$id){
        $id=(int)$id;
        $input=$request->except('_token','_method');

        if ($request->isMethod('PUT')) {

           $rules = [
            'links_name' => 'required|max:20',
            'links_url' => 'required|max:255',
            'links_desc' => 'required|max:100',
            'links_order' => 'required|integer',
        ];

        $messages = [
            'links_name.required' => '友链名为必填项',
            'links_url.required' => '友链地址为必填项',
            'links_desc.required' => '友链简介为必填项',
            'links_order.required' => '友链排序为必填项',
            'links_name.max' => '友链名字符最长为20位',
            'links_url.max' => '友链地址字符最长为255位',
            'links_desc.max' => '友链简介字符最长为100位',
            'links_order.integer' => '友链排序必须为整数',
        ];

    $validator = Validator::make($input, $rules, $messages);

        if ($validator->fails()) {
            return redirect("admin/links_edit/$id")->withErrors($validator);
        }

        $res = links::where('id',$id)->update($input);

        if ($res !== false ) {
           return redirect("admin/links_edit/$id")->with('msg','修改成功');
        }else{
            return redirect("admin/links_edit/$id")->with('msg','修改失败');
        }
    }

    }


    //删除链接  links/{id} *DELETE
    public function links_destroy($id){

        $arrid = explode(',', $id);
        if($res = links::destroy($arrid)){
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


    //链接的发布和下架   links/{id} *get
    public function links_show($id)
    {
       $id=(int)$id;

            $ar = links::find($id);
            $status = $ar->links_status?0:1;
            $res = links::where('id', $id)->update(['links_status' => $status ]);

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




}

