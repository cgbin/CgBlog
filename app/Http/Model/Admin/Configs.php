<?php

namespace App\Http\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Configs extends Model
{
    protected $table='configs';

    protected $primaryKey='id';

    public $timestamps = false;

    protected $guarded = [];


    //将所有记录的配置类型转成html形式读取
    public static  function get_list_html()
    {

        $configs_list = self::all();

         foreach ($configs_list as $k => $v) {
            $str = '';
            switch ($v->configs_type) {
                case 'input':
                $str = '<input type="text" style="width:300px;height:36px"  class="input-text" name="configs_content['.$v->id.'][]" placeholder="写点什么~" value="'.$v->configs_content.'" >';
                    break;
                case 'textarea':
                $str = '<textarea name="configs_content['.$v->id.'][]" placeholder="写点什么..." cols="66" rows="6"   dragonfly="true">'.$v->configs_content.'</textarea>';
                    break;
                case 'radio':

                if ($v->configs_content=='1') {
                    $checked = 'checked' ;
                    $str =  '<span><input type="radio" '.$checked.' name="configs_content['.$v->id.'][]" value="1" >:开启　　<input type="radio"  name="configs_content['.$v->id.'][]" value="0" >:关闭</span>';
                }elseif($v->configs_content=='0'){
                    $checked = 'checked' ;
                    $str =  '<span><input type="radio"  name="configs_content['.$v->id.'][]" value="1" >:开启　　<input type="radio" '.$checked.'  name="configs_content['.$v->id.'][]" value="0" >:关闭</span>';
                }elseif(is_null($v->configs_content)){
                    $str =  '<span><input type="radio" name="configs_content['.$v->id.'][]" value="1" >:开启　　<input type="radio"  name="configs_content['.$v->id.'][]" value="0" >:关闭</span>';
                    $str =  '<span><input type="radio"  name="configs_content['.$v->id.'][]" value="1" >:开启　　<input type="radio"  name="configs_content['.$v->id.'][]" value="0" >:关闭</span>';
                }

                    break;
            }

            $v->configs_html = $str ;
        }

        return $configs_list;
    }


    //将指定一条数据的配置类型转成html形式读取
    public static  function get_id_html($get_id = nll)
    {
      if ($get_id) {

        $configs_find = self::find($get_id);


            $str = '';
            switch ($configs_find->configs_type) {
                case 'input':
                $str = '<input type="text" style="width:300px;height:36px"  class="input-text" name="configs_content" placeholder="写点什么~" value="'.$configs_find->configs_content.'" >';
                    break;
                case 'textarea':
                $str = '<textarea name="configs_content" placeholder="写点什么..." cols="66" rows="6"   dragonfly="true">'.$configs_find->configs_content.'</textarea>';
                    break;
                case 'radio':

                if ($configs_find->configs_content=='1') {
                    $checked = 'checked' ;
                    $str =  '<span><input type="radio" '.$checked.' name="configs_content" value="1" >:开启　　<input type="radio"  name="configs_content" value="0" >:关闭</span>';

                }elseif($configs_find->configs_content=='0'){
                    $checked = 'checked' ;
                    $str =  '<span><input type="radio"  name="configs_content" value="1" >:开启　　<input type="radio" '.$checked.' name="configs_content" value="0" >:关闭</span>';

                }elseif(is_null($configs_find->configs_content)){
                    $str =  '<span><input type="radio" name="configs_content" value="1" >:开启　　<input type="radio"  name="configs_content" value="0" >:关闭</span>';
                }

                    break;
            }

            $configs_find->configs_html = $str ;


        return $configs_find;
    }
  }

}
