<?php

namespace App\Http\Model\Admin;

use Illuminate\Foundation\Auth\User;
use App\Http\Model\Admin\Auth;

class Role extends User
{
    protected $table = 'role';

    public $timestamps = false;

    public static function assignAuth($data, $id)
    {
        $post['auth_ids'] = implode(',', $data['auth_ids']);

        $ac = Auth::where('pid','!=',0)->whereIn('id',$data['auth_ids'])->get()->toArray();

        $str = '';
        foreach ($ac as $k => $v) {
           $str .= $v['controller'].'@'.$v['action'].',';
        }
            $post['auth_ac'] = rtrim($str, ',');
            $post['auth_ac'] = strtolower($post['auth_ac']);

           return self::where('id',$id)->update($post);
    }

}
