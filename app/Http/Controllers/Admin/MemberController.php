<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Admin\Member;
use Illuminate\Support\Facades\Storage;
use zgldh\QiniuStorage\QiniuStorage;

class MemberController extends Controller
{
    /**
     * 会员列表
     */
    public function member_list()
    {
        $data = Member::all()->toArray();

        return view('admin.member.index',compact('data'));
    }

    /**
     * 添加会员
     */
    public function member_add(Request $request)
    {

        if ($request->isMethod('POST')) {

            $data = $request->except(['_token','file']);
            $data['password'] = bcrypt($data['password']);
            $data['avatar'] = isset($data['avatar']) ? $data['avatar'] : '/admin/static/default.png';
            $data['created_at'] = date('Y-m-d H:i:s');
            return Member::insert($data) ? '1' : '0';
        }

        return view('admin.member.add');
    }


    /**
     * ajax上传会员头像
     */
    public function avatar_upload(Request $request)
    {
        $file = $request->file('file');
        //是否存在文件，是否上传成功
        if ($request->hasFile('file') && $file->isValid()) {
                //获取文件后缀
                $ext = $file -> getClientOriginalExtension();
                //临时存储路径
                $realPath = $file -> getRealPath();
                //上传名
                $movename = date('Y-m-d-H-s-i') .'.'. $ext;

            // 1、 上传到自己的网站磁盘
              $res = Storage::disk('public')->put($movename, file_get_contents($realPath));
            //    上传自己的网站磁盘后存储的路径
              $url = '/storage/' . $movename;

            // 2、 上传到七牛云空间
            //  $disk = QiniuStorage::disk('qiniu');
            //  $res = $disk->put($movename, file_get_contents($realPath));
            //     七牛云存储的路径
            //  $url = $disk -> downloadUrl($movename);

              if ($res) {
                  return response()->json([
                        'status' => 1,
                        'msg' => '上传成功',
                        'path' => $url
                    ]);
              }else{
                    return response()->json([
                        'status' => 0,
                        'msg' => '上传失败',
                        'path' => ''
                    ]);
              }
        }else{
            return response()->json([
                        'status' => 0,
                        'msg' => '上传失败',
                        'path' => ''
                    ]);
        }

    }
}
