<?php

namespace App\Http\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table='category';

    protected $primaryKey='id';

    public $timestamps=false;

    protected $guarded = [];



    public static  function getlist(){

        $cate_list = Category::orderBy('cate_order', 'asc')->get();

        return  $res = Category::getTree($cate_list);
    }

    //获得分类树
    public static  function getTree($data,$pid=0,$heng=0)
    {
        $arr = array();
        foreach ($data as $k => $v) {
            if ($v->pid == $pid) {
               $v->heng = $heng;
               $arr[] = $v;
               $arr=array_merge($arr, Category::getTree($data,$v->id,$heng+1));
            }
        }
        return $arr;
    }


    /**
     * [获取所有传入分类id的所有父级和子级]
     * @param  int  $id  [传入一个分类id]
     * @param  boolean $all [为顶级分类时是否获取子集分类]
     * @return array       [description]
     */
    public static  function getcates($id,$all = true)
    {

        $find = Category::find($id);

        if (!$find) {
          return false;
        }
        $cid = array();

        if ($find->pid ==0 ) {

            if ($all) {

                //若传入的就是父级id，则取所有子集
                $cids = Category::select('id')->where('pid',$find->id)
                ->get();
                foreach ($cids as $k => $v) {
                    $cid[] = $v->id;
                }

                $cid = array_merge([$id], $cid);
            }else{
                $cid[] = $id;
            }

        }else{

            //若传入的为子集id，在获取其所有子集

            if ($all) {

                $cids = Category::where('pid',$find->pid)->get();
                foreach ($cids as $k => $v) {
                    $cid[] = $v->id;
                }
            }else{
                $cid[] = $id;
            }


            $cid = array_merge([$find->pid], $cid);

        }

        return $cid;

    }
}
