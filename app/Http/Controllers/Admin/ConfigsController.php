<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Db;
use App\Http\Model\Admin\Configs;
use Illuminate\Support\Facades\Validator;

class ConfigsController extends Controller
{

    //配置列表页   configs  *get
    public function configs_index(){

        $configs_list = configs::get_list_html();

       return view('admin.configs.list',compact('configs_list'));
    }


    //获取列表页提交的需要写入配置文件 web.php 的参数
    public function get_put(Request $request)
    {
        $input = $request->except('_token');

        foreach ($input['configs_content'] as $k => $v) {

            $res = configs::where('id',$k)->update(['configs_content'=>$v[0]]);
        }

        if ($res !== false) {

               $this->put_config_file();

            return redirect('admin/configs_index')->with('msg','写入成功');
        }else{
            return redirect('admin/configs_index')->with('msg','写入失败');
        }

    }

    //添加配置页 configs/create *get
    public function configs_create(){

        return view('admin.configs.add');
    }


    //获取添加配置添加的数据 *post
    public function configs_store(Request $request)
    {
        $input=$request->except('_token');


        if ($request->isMethod('post')) {

            $input = $request->input();

            $rules = [
            'configs_name' => 'required|max:20',
            'configs_title' => 'required|max:50',
            'configs_desc' => 'required|max:255',
        ];

        $messages = [
            'configs_name.required' => '配置项变量名为必填项',
            'configs_desc.required' => '配置项简介为必填项',
            'configs_title.required' => '配置项标题为必填项',
            'configs_name.max' => '配置项变量名名字符最长为20位',
            'configs_desc.max' => '配置项地址字符最长为255位',
            'configs_title.max' => '配置项简介字符最长为50位',
        ];

    $validator = Validator::make($input, $rules, $messages);

        if ($validator->fails()) {
            return redirect('admin/configs_create')->withErrors($validator)->withInput();
        }

        $configs= new configs();
        $configs->configs_name = $input['configs_name'];
        $configs->configs_title = $input['configs_title'];
        $configs->configs_type = $input['configs_type'];
        $configs->configs_desc = $input['configs_desc'];
        $configs->save();

        if ($configs) {
           return redirect('admin/configs_index')->with('msg','添加成功');
        }else{
            return redirect('admin/configs_index')->with('msg','添加失败');
        }
    }

    }

    //修改配置页  configs/{id}/edit
    public function configs_edit($id){

        $list = configs::get_id_html((int)$id);

        return view('admin.configs.edit',compact('list'));

    }

    //获取提交的修改配置内容  configs/{id} *PUT
    public function configs_update(Request $request,$id){
        $id=(int)$id;
        $input=$request->except('_token','_method');


        if ($request->isMethod('PUT')) {

          $rules = [
            'configs_name' => 'required|max:20',
            'configs_title' => 'required|max:50',
            'configs_desc' => 'required|max:255',
        ];

        $messages = [
            'configs_name.required' => '配置项变量名为必填项',
            'configs_desc.required' => '配置项简介为必填项',
            'configs_title.required' => '配置项标题为必填项',
            'configs_name.max' => '配置项变量名名字符最长为20位',
            'configs_desc.max' => '配置项地址字符最长为255位',
            'configs_title.max' => '配置项简介字符最长为50位',
        ];

    $validator = Validator::make($input, $rules, $messages);

        if ($validator->fails()) {
            return redirect("admin/configs_edit/$id")->withErrors($validator);
        }

        $res = configs::where('id',$id)->update($input);

        if ($res !== false ) {

              $this->put_config_file();

           return redirect("admin/configs_edit/$id")->with('msg','修改成功');
        }else{
            return redirect("admin/configs_edit/$id")->with('msg','修改失败');
        }
    }

    }


    //删除配置  configs/{id} *DELETE
    public function configs_destroy($id){

        $arrid = explode(',', $id);
        if($res = configs::destroy($arrid)){

               $this->put_config_file();

            return response()->json(
               [
                   'status' => 1,
                    'msg' => '删除成功'
                ]
           );
        }else{
            return response()->json(
               [
                   'status' => 0,
                    'msg' => '删除失败'
                ]
           );
        }
    }


    //将数据库的配置信息写入 config目录下的 web.php中  ，在其他处调用

    public function put_config_file()
    {

        $configs_all = Configs::pluck(
            'configs_content','configs_name')
        ->all();
        $arr = var_export($configs_all,true);

        $filedisk = base_path(). '/config/web.php';
        $content = "<?php \r\n return  $arr ; \r\n ?>";
        $res = file_put_contents($filedisk, $content);

    }


}

