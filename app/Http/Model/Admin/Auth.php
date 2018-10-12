<?php

namespace App\Http\Model\Admin;

use Illuminate\Foundation\Auth\User;

class Auth extends User
{
    protected $table = 'auth';

    public $timestamps = false;

    /**
     * 树状列表
     */
    public static  function getlist(){

        $cate_list = self::all()->toArray();

        return  self::getTree($cate_list);
    }

    //循环获得树状分类
    public static  function getTree($data,$pid=0,$heng=0)
    {
        $arr = array();
        foreach ($data as $k => $v) {
            if ($v['pid'] == $pid) {
               $v['heng'] = $heng;
               $arr[] = $v;
               $arr = array_merge($arr, self::getTree($data,$v['id'],$heng+1));
            }
        }
        return $arr;
    }


    /**
     * 递归列表
     */
    public static  function getdigui(){

        $cate_list = self::all()->toArray();

        return  self::digui($cate_list);
    }

    //获得递归权限
    public static function digui($data, $pid=0)
    {
        $arr = array();
        foreach ($data as $k => $v) {
            if ($v['pid'] == $pid) {
               $v['children'] = self::digui($data,$v['id']);
               $arr[] = $v;
            }
        }
        return $arr;
    }

}
