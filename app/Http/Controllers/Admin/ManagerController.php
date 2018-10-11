<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Admin\Manager;
use Illuminate\Support\Facades\Validator;
use Datatables;

class ManagerController extends Controller
{
    /**
     * 管理员列表
     */
   public function manager_list(){

        $list = Manager::all()->toArray();

        return view('admin.manager.list',compact('list'));
    }

    /**
     * ajax获取的管理员列表
     */
   public function manager_list_ajax(Datatables $dataTables) {

      $data = Manager::all();
      foreach ($data as $k => &$v) {
         $v->role_name = $v->role->role_name;
         $v->gender = Manager::sex($v->gender);
      }

       return Datatables::of($data)->make(true);
    }



    //添加管理员 manager/create *get
    public function create(){

        return view('admin.manager.add');
    }

    //获取添加链接添加的数据  manager *post
    public function store(Request $request)
    {
        $input=$request->except('_token');

        if ($request->isMethod('post')) {

            $input = $request->input();

             $rules = [
            'password' => 'required|min:5|max:15',
            'depassword' => 'required|min:5|max:15|confirmed',
        ];

        $messages = [
            'password.required' => '密码为必填项',
            'depassword.required' => '确认密码为必填项',
            'password.min' => '密码最短为5位',
            'depassword.min' => '确认密码最短为5位',
            'password.max' => '密码最长为15位',
            'depassword.max' => '确认密码最长为15位',
            'password.confirmed' => '确认密码与新密码不符合',
        ];

    $validator = Validator::make($input, $rules, $messages);

    if ($validator->fails()) {
        return redirect("admin/manager_create")->withErrors($validator);
    }

        $pwd = encrypt($input['password']);

        $admin= new admin();
        $admin->username = $input['username'];
        $admin->password = $pwd;
        $admin->save();

        if ($admin) {
            return redirect("admin/manager_index")->with('msg','添加成功');
        }else{
             return redirect("admin/manager_index")->with('msg','添加失败');
        }

    }

  }

    //管理员资料修改 manager/{id}/edit
    public function manager_edit($id)
    {

        return view('admin.manager.edit');
    }


    //管理员修改密码
    public function manager_changepwd(Request $request,$id)
    {

    if($request->isMethod('POST')){
        $id=(int)$id;
        $input = $request->except('_token','_method');

        $rules = [
            'oldpassword' => 'required|min:3|max:20',
            'password' => 'required|min:3|max:20|confirmed',
        ];

        $messages = [
            'oldpassword.required' => '旧密码为必填项',
            'password.required' => '新密码为必填项',
            'oldpassword.min' => '旧密码最短为3位',
            'password.min' => '新密码最短为3位',
            'oldpassword.max' => '旧密码最长为20位',
            'password.max' => '新密码最长为20位',
            'password.confirmed' => '确认密码与新密码不符合',
        ];

    $validator = Validator::make($input, $rules, $messages);

    if ($validator->fails()) {
        return redirect("admin/manager_changepwd/$id")->withErrors($validator);
    }

        $newpwd = bcrypt($input['password']);

        $upwd = Manager::find($id);

        if(! \Hash::check($input['oldpassword'], $upwd->password)){
            return redirect("admin/manager_changepwd/$id")->with('error','旧密码错误');
         }

        $res = Manager::where('id', $id)->update(['password' => $newpwd ]);


        if ($res !== false ) {
            return redirect("admin/manager_changepwd/$id")->with('msg','修改成功');
        }else{
             return redirect("admin/manager_changepwd/$id")->with('msg','修改失败');
        }
    }
                return view('admin.manager.changepwd');
    }

    //删除管理员  manager/{id} *DELETE
    public function manager_destroy($id){

        $arrid = explode(',', $id);
        if($res = Manager::destroy($arrid)){
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
}
