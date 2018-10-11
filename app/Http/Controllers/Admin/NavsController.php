<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Db;
use App\Http\Model\Admin\Navs;
use Illuminate\Support\Facades\Validator;

class NavsController extends Controller
{

    //链接列表页   navs_  *get
    public function navs_index(){

        $navs_list = navs::orderBy('navs_order','asc')->get();

       return view('admin.navs.list',compact('navs_list'));
    }

    //添加链接页 navs/create *get
    public function navs_create(){

        return view('admin.navs.add');
    }

    //修改自定义排序
    public function  navs_order(Request $request){

        $post = $request->input();
        if ($request->isMethod('post')) {
            $res = navs::where('id', $post['id'])->update(['navs_order' => $post['order'] ]);

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
    public function navs_store(Request $request)
    {
        $input=$request->except('_token');

        if ($request->isMethod('post')) {

            $input = $request->input();

            $rules = [
            'navs_name' => 'required|max:20',
            'navs_url' => 'required|max:255',
            'navs_desc' => 'required|max:100',
            'navs_order' => 'required|integer',
        ];

        $messages = [
            'navs_name.required' => '导航名为必填项',
            'navs_url.required' => '导航地址为必填项',
            'navs_desc.required' => '导航简介为必填项',
            'navs_order.required' => '导航排序为必填项',
            'navs_name.max' => '导航名字符最长为20位',
            'navs_url.max' => '导航地址字符最长为255位',
            'navs_desc.max' => '导航简介字符最长为100位',
            'navs_order.integer' => '导航排序必须为整数',
        ];

    $validator = Validator::make($input, $rules, $messages);

        if ($validator->fails()) {
            return redirect('admin/navs_create')->withErrors($validator)->withInput();
        }

        $navs= new navs();
        $navs->navs_name = $input['navs_name'];
        $navs->navs_url = $input['navs_url'];
        $navs->navs_desc = $input['navs_desc'];
        $navs->navs_order = $input['navs_order'];
        $navs->save();

        if ($navs) {
           return redirect('admin/navs_index')->with('msg','添加成功');
        }else{
            return redirect('admin/navs_index')->with('msg','添加失败');
        }
    }

    }

    //修改链接页  navs/{id}/edit
    public function navs_edit($id){

        $list = navs::find((int)$id);

        return view('admin.navs.edit',compact('list'));
    }

    //获取提交的修改链接内容  navs/{id} *PUT
    public function navs_update(Request $request,$id){
        $id=(int)$id;
        $input=$request->except('_token','_method');

        if ($request->isMethod('PUT')) {

           $rules = [
            'navs_name' => 'required|max:20',
            'navs_url' => 'required|max:255',
            'navs_desc' => 'required|max:100',
            'navs_order' => 'required|integer',
        ];

        $messages = [
            'navs_name.required' => '导航名为必填项',
            'navs_url.required' => '导航地址为必填项',
            'navs_desc.required' => '导航简介为必填项',
            'navs_order.required' => '导航排序为必填项',
            'navs_name.max' => '导航名字符最长为20位',
            'navs_url.max' => '导航地址字符最长为255位',
            'navs_desc.max' => '导航简介字符最长为100位',
            'navs_order.integer' => '导航排序必须为整数',
        ];

    $validator = Validator::make($input, $rules, $messages);

        if ($validator->fails()) {
            return redirect("admin/navs_edit/$id")->withErrors($validator);
        }

        $res = navs::where('id',$id)->update($input);

        if ($res !== false ) {
           return redirect("admin/navs_edit/$id")->with('msg','修改成功');
        }else{
            return redirect("admin/navs_edit/$id")->with('msg','修改失败');
        }
    }

    }


    //删除链接  navs/{id} *DELETE
    public function navs_destroy($id){

        $arrid = explode(',', $id);
        if($res = navs::destroy($arrid)){
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


    //链接的发布和下架   navs/{id} *get
    public function navs_show($id)
    {
       $id=(int)$id;

            $ar = navs::find($id);
            $status = $ar->navs_status?0:1;
            $res = navs::where('id', $id)->update(['navs_status' => $status ]);

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

