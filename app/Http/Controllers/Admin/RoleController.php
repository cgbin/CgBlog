<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Admin\Role;
use App\Http\Model\Admin\Auth;

class RoleController extends Controller
{
    /**
     * 角色列表
     */
    public function role_list()
    {
        $data = Role::all();

        return view('admin.role.index',compact('data'));
    }


    /**
     * 为角色分配权限
     * @param  [int]  $id      角色id
     */
    public function role_auth_add(Request $request,$id)
    {

        if ($request->isMethod('POST')) {
                $input = $request->except('_token');
                //在Role模型中拼接写入数据的 auth_ids 和 auth_ac
                if(Role::assignAuth($input, $id) !== false){
                    return 1;
                }else{
                    return 0;
                }
        }
        $data = Auth::getdigui();

        //勾选已分配的权限
        $auth_ids = Role::select('auth_ids')->where('id',$id)->first()->toArray();
        $auth_ids = explode(',', $auth_ids['auth_ids']);

        return view('admin.role.role_auth_add',compact('data','auth_ids'));
    }
}
