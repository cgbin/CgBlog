<?php

namespace App\Http\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table='article';

    protected $primaryKey='id';

    public $timestamps=true;

    protected  function  getDateFormat(){
        return time();
    }

    protected $guarded = [];

    public function cate()
    {
        return $this->belongsTo('App\Http\Model\Admin\Category');
    }
}
