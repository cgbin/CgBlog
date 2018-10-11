<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Admin\Auth;

class IndexController extends Controller
{
    /**
     * 后台首页
     */
   public function index(){
        $data = Auth::where('is_nav',1)->get()->toArray();

        $res = Auth::digui($data);

        return view('admin.index',compact('res'));
    }

    /**
     * 后台欢迎页面
     */
    public function welcome(){
        return view('admin.welcome');
    }
}
