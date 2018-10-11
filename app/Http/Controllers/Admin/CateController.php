<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Db;
use App\Http\Model\Admin\Category;
use Illuminate\Support\Facades\Validator;

class CateController extends Controller
{

    //栏目列表页
    public function cate_index(){

        $cate_list = Category::getlist();

       return view('admin.category.list',
        [
            'cate_list'=>$cate_list
            ]
        );
    }
    //修改自定义排序
    public function  cate_store(Request $request){

        $post = $request->input();
        if ($request->isMethod('post')) {
            $res = Category::where('id', $post['id'])->update(['cate_order' => $post['order'] ]);

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

    //添加栏目
    public function cate_add(Request $request)
    {
        if ($request->isMethod('post')) {

            $input = $request->input();

            $rules = [
            'cate_name' => 'required|max:20',
            'cate_order' => 'numeric|integer',
        ];

        $messages = [
            'cate_name.required' => '栏目名为必填项',
            'cate_name.max' => '栏目名最长为20位',
            'cate_order.numeric' => '排序必须为数值',
            'cate_order.integer' => '排序必须为整数',
        ];

    $validator = Validator::make($input, $rules, $messages);

        if ($validator->fails()) {
            return redirect('admin/cate_add')->withErrors($validator);
        }

         $cate=new Category;
         $cate->cate_name= $input['cate_name'];
         $cate->cate_order = $input['cate_order'];
         $cate->pid = $input['pid'];

         $res = $cate->save();

            if ($res) {
              return redirect('admin/cate_index')->with('msg','添加成功');
            }else{
                return redirect('admin/cate_index')->with('msg','添加失败');
            }

        }

        $option = Category::where('pid',0)->get();
        return view('admin.category.add',['option'=>$option]);
    }

    //删除栏目
    public function cate_destroy($id)
    {

        $id=(int)$id;
        $cid = Category::find($id);

        $cids=array();
        if ($cid->pid == 0) {
           $cates = Category::select('id')->where('pid',$id)->get();
           foreach ($cates as $k => $v) {
                $cids[] = $v->id;
             }
              $cids = array_merge([$id], $cids);

        }else{
                $cids[] = $id;
        }

        if(Category::destroy($cids)){
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

    //栏目修改
    public function cate_edit(Request $request,$id){

        $id=(int)$id;
        $input = $request->input();

    if ($request->isMethod('post')) {

            $rules = [
            'cate_name' => 'required|max:20',
            'cate_order' => 'numeric|integer',
            ];

            $messages = [
                'cate_name.required' => '栏目名为必填项',
                'cate_name.max' => '栏目名最长为20位',
                'cate_order.numeric' => '排序必须为数值',
                'cate_order.integer' => '排序必须为整数',
            ];

    $validator = Validator::make($input, $rules, $messages);

        if ($validator->fails()) {
            return redirect('admin/cate_edit/'.$id)->withErrors($validator);
        }

        $res=Category::where('id', $id)->update([
            'cate_name'=>$input['cate_name'],
            'cate_order'=>$input['cate_order'],
            'pid'=>$input['pid'],
            ]);

        if ($res !== false ) {
            return redirect('admin/cate_edit/'.$id)->with('msg','修改成功');
        }else{
            return redirect('admin/cate_edit/'.$id)->with('msg','修改失败');
        }
    }
        $data= Category::find($id);


        $option = Category::where('pid',0)->get();
        return view('admin.category.edit',[
            'option'=>$option,
            'data'=>$data,
            ]);
    }


}
