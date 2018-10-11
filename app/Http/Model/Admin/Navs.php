<?php

namespace App\Http\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Navs extends Model
{
    protected $table='navs';

    protected $primaryKey='id';

    public $timestamps=true;

    protected  function  getDateFormat(){
        return time();
    }

    protected $guarded = [];


}
