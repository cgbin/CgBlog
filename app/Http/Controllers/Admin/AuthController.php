<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Admin\Auth;

class AuthController extends Controller
{

    /**
     * 权限列表
     */
    public function auth_list()
    {

        $tree = Auth::getlist();

        return view('admin.auth.index',compact('tree'));
    }


    /**
     * 添加权限
     */
    public function auth_add(Request $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->except('_token');

            if (Auth::insert($data)) {
                return 1;
            }else{
                return 0;
            }
        }

        $select = Auth::where('pid',0)->get()->toArray();

        return view('admin.auth.add',compact('select'));

    }
}
