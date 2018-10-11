<?php

namespace App\Http\Model\Admin;

use Illuminate\Foundation\Auth\User;

class Manager extends User
{
    protected $table = 'manager';


    public function role()
    {
        return $this->hasOne('App\Http\Model\Admin\Role','id','role_id');
    }

    public static function sex($sex = '')
    {
        switch ($sex) {
            case '1':
                $sex = '男';
                break;
            case '2':
                $sex = '女';
                break;
            case '3':
                $sex = '保密';
                break;
            default:
                $sex = 'N/A';
                break;
        }


        return $sex;
    }
}
