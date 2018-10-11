<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CheckLoginPost;
use Auth;

class LoginController extends Controller
{

    /**
     * 登录页面显示
     * @return [type] [description]
     */
    public function index(){
        return view('admin.login');
    }

    /**
     * 登录验证
     * @param  CheckLoginPost $request [表单验证]
     * @return [type]                  [description]
     */
    public function check(CheckLoginPost $request){

        if($request->isMethod('POST')){
            $remember = (bool)$request->get('online');
            $data = $request->only(['username','password']);
            $data['status'] = 2;
            if (Auth::guard('admin')->attempt($data,$remember)) {
                    return redirect('admin/index');
            }else{
                return redirect(route('login'))->withErrors(['loginError'=>'用户名或密码错误']);
            }
        }

    }

    /**
     * 退出登录
     * @return [type] [description]
     */
    public function logout()
    {
        Auth::guard('admin')->logout(false);
        return redirect(route('login'));

    }
}
