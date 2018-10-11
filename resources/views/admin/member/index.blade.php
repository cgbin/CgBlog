<?php use App\Http\Model\Admin\Manager; ?>

@extends('admin.common')

@section('title','会员管理')

@section('content')
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 用户中心 <span class="c-gray en">&gt;</span> 会员管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">

  <div class="cl pd-5 bg-1 bk-gray mt-20">
    <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="icon-trash"></i> 批量删除</a>
    <a href="javascript:;" onclick="member_add('添加会员','{{url('admin/member_add')}}',1000,600)" class="btn btn-primary radius"><i class="icon-plus"></i> 添加会员</a></span>
  </div>
  <table class="table table-border table-bordered table-hover table-bg table-sort" align="center">
    <thead>
      <tr class="text-c">
        <th width="25"><input type="checkbox" name="" value=""></th>
        <th width="60">ID</th>
        <th width="140">用户名</th>
        <th width="60">性别</th>
        <th width="130">手机</th>
        <th width="180">邮箱</th>
        <th width="80">头像</th>
        <th width="200">所在地</th>
        <th width="150">加入时间</th>
        <th width="70">账号类别</th>
        <th width="70">状态</th>
        <th width="80">操作</th>
      </tr>
    </thead>
    <tbody>
        @foreach($data as $val)
            <tr class="text-c">
                <td><input type="checkbox" value="{{$val['id']}}" name=""></td>
                <td>{{$val['id']}}</td>
                <td class="text-l">{{$val['username']}}</td>
                <td>{{Manager::sex($val['gender'])}}</td>
                <td>{{$val['mobile']}}</td>
                <td>{{$val['email']}}</td>
                <td><img src="{{$val['avatar']}}" alt="头像"  width="60px"></td>
                <td>{{$val['province'].'&nbsp;' .$val['city'] .'&nbsp;' .$val['area']}}</td>
                <td>{{$val['created_at']}}</td>
                <td> @if($val['type'] == '1') 学生 @else 老师 @endif </td>
                <td>@if($val['status'] == '2')
                <div class='user-status'><span class='label label-success'>已启用</span></div>
                    @else
                <div class='user-status'><span class='label label-error'>已禁用</span></div>
                    @endif
                </td>
                <td><a title="编辑" href="javascript:;" onclick="admin_permission_edit('权限编辑','{{url('admin/member_edit')}}/{{$val['id']}}','1','','310')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> <a title="删除" href="javascript:;" onclick="admin_permission_del(this,{{$val['id']}})" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
            </tr>
        @endforeach
        </tbody>
  </table>
</div>
@endsection


@section('script')

<script type="text/javascript" src="/admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/admin/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">

$(function(){

    $('.table-sort').DataTable({
        "aaSorting": [[ 1, "asc" ]],//默认第几个排序
        "aoColumnDefs": [
          //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
          {"orderable":false,"aTargets":[0,11]}// 制定列不参与排序
        ],
    });
});

/*用户-添加*/
function member_add(title,url,w,h){
    layer_show(title,url,w,h);
}
/*用户-查看*/
function member_show(title,url,id,w,h){
    layer_show(title,url,w,h);
}
/*用户-停用*/
function member_stop(obj,id){
    layer.confirm('确认要停用吗？',function(index){
        $.ajax({
            type: 'POST',
            url: '',
            dataType: 'json',
            success: function(data){
                $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_start(this,id)" href="javascript:;" title="启用"><i class="Hui-iconfont">&#xe6e1;</i></a>');
                $(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已停用</span>');
                $(obj).remove();
                layer.msg('已停用!',{icon: 5,time:1000});
            },
            error:function(data) {
                console.log(data.msg);
            },
        });
    });
}

/*用户-启用*/
function member_start(obj,id){
    layer.confirm('确认要启用吗？',function(index){
        $.ajax({
            type: 'POST',
            url: '',
            dataType: 'json',
            success: function(data){
                $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_stop(this,id)" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a>');
                $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
                $(obj).remove();
                layer.msg('已启用!',{icon: 6,time:1000});
            },
            error:function(data) {
                console.log(data.msg);
            },
        });
    });
}
/*用户-编辑*/
function member_edit(id,w,h){
   var url = "{{url('admin/manager/edit')}}/" + id ;
    layer_show('编辑',url,w,h);
}
/*密码-修改*/
function change_password(id,w,h){
    var url = "{{url('admin/manager/changerpwd')}}/" + id ;
    layer_show('修改密码',url,w,h);
}
/*用户-删除*/
function member_del(obj,id){
    layer.confirm('确认要删除吗？',function(index){
        $.ajax({
            type: 'POST',
            url: '',
            dataType: 'json',
            success: function(data){
                $(obj).parents("tr").remove();
                layer.msg('已删除!',{icon:1,time:1000});
            },
            error:function(data) {
                console.log(data.msg);
            },
        });
    });
}
</script>
@endsection