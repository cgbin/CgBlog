<?php use App\Http\Model\Admin\Manager; ?>

@extends('admin.common')

@section('title','用户管理')

@section('content')
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 用户中心 <span class="c-gray en">&gt;</span> 用户管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
  <div class="cl pd-5 bg-1 bk-gray mt-20">
    <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="icon-trash"></i> 批量删除</a>
    <a href="javascript:;" onclick="user_add('550','','添加用户','{{url('admin/manager
    _create')}}')" class="btn btn-primary radius"><i class="icon-plus"></i> 添加用户</a></span>
  </div>
  <table class="table table-border table-bordered table-hover table-bg table-sort" align="center">
    <thead>
      <tr class="text-c">
        <th width="25"><input type="checkbox" name="" value=""></th>
        <th width="80">ID</th>
        <th width="120">用户名</th>
        <th width="60">性别</th>
        <th width="130">手机</th>
        <th width="160">邮箱</th>
        <th width="80">角色</th>
        <th width="150">加入时间</th>
        <th width="70">状态</th>
        <th width="100">操作</th>
      </tr>
    </thead>
  </table>
</div>
@endsection


@section('script')
<script type="text/javascript" src="/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="/admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/admin/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">

$(function(){

    $('.table-sort').DataTable({
        "aaSorting": [[ 1, "asc" ]],//默认第几个排序
        "aoColumnDefs": [
          //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
          {"orderable":false,"aTargets":[0,9]}// 制定列不参与排序
        ],
        "processing" : true, //DataTables载入数据时，是否显示进度条
        "serverSide": true,  //  开启服务端模式
        "ajax": {  // ajax 请求数据
                "url": "/admin/manager_list_ajax",
                "type": "get"
            },
        "columns": [
            {
                  "render": function (data, type, row) {
                    if (row.id == '1' && {{Auth::guard('admin')->user()->id}} != '1') {
                        return '';
                    }else{
                    return "<input type='checkbox' value="+ row.id +" name='checkbox'>";
                    }
                    }
            },
            { "data": "id" },
            { "data": "username" },
            { "data": "gender"
             },
            { "data": "mobile" },
            { "data": "email" },
            { "data": "role_name"},
            { "data": "created_at",
                "render": function (data, type, row) {
                    if(data == ''){
                        return "N/A";
                    }else{
                        return data;
                    }
                }
            },
            { "data": "status",
                "render": function (data, type, row) {
                    if(data == '2'){
                    return "<div class='user-status'><span class='label label-success'>已启用</span></div>";
                     }else if(data == '1'){
                        return "<div class='user-status'><span class='label label-error'>已禁用</span></div>";
                     }
                    }
            },
            {

                  "render": function (data, type, row) {
                    if (row.id == '1' && {{Auth::guard('admin')->user()->id}} != '1') {
                        return '';
                    }else{
                        return "<div class='td-manage'><a style='text-decoration:none' onClick='member_stop(this," + row.id + ")' href='javascript:;' title='停用'><i class='Hui-iconfont'>&#xe631;</i></a> <a title='编辑' href='javascript:;' onclick='member_edit("+row.id+")' class='ml-5' style='text-decoration:none'><i class='Hui-iconfont'>&#xe6df;</i></a> <a style='text-decoration:none' class='ml-5' onClick='change_password(" + row.id + ",800,500)' href='javascript:;' title='修改密码'><i class='Hui-iconfont'>&#xe63f;</i></a> <a title='删除' href='javascript:;' onclick='manager_del(this,"+row.id + ")' class='ml-5' style='text-decoration:none'><i class='Hui-iconfont'>&#xe6e2;</i></a></div>";
                    }
                    }
            },
        ]

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
   var url = "{{url('admin/manager_edit')}}/" + id ;
    layer_show('编辑',url,w,h);
}
/*密码-修改*/
function change_password(id,w,h){
    var url = "{{url('admin/manager_changepwd')}}/" + id ;
    layer_show('修改密码',url,w,h);
}


//批量删除
function datadel(){

    layer.confirm('确认要全部删除吗？',function(index){
            //定义一个空数组放选中的值
            var arr = [];
             $("input[name='checkbox']:checked").each(function() {
              // 遍历选中的checkbox
               v = $(this).val();
               //将中的值压入数组
               arr.push(v);
            });
             if(arr.length ==0){
                layer.msg('请先选择',{icon:2,time:1000});
                return false;
             }

        $.ajax({
            type: 'POST',
            url: "{{url('admin/manager_destroy')}}/"+arr,
            data:{'_method':'DELETE','_token':"{{csrf_token()}}"},
            dataType: 'json',
            success: function(data){
                if (data.status==1) {
                    layer.msg('删除成功',{icon:1,time:1000});
                    //删除成功，移除选中的tr
                    $("input[name='checkbox']:checked").each(function() {
                            $(this).parents('tr').remove();
                        });
                }else{
                    layer.msg('删除失败',{icon:2,time:1000});
                }
            },
            error:function(data) {
                console.log(data.msg);
            },
        });
    });
}

/*用户-删除*/
function manager_del(obj,id){
    layer.confirm('确认要删除吗？',function(index){
        $.ajax({
            type: 'POST',
            url: '{{url('admin/manager_destroy')}}/'+id,
            data:{'_method':'DELETE','_token':'{{csrf_token()}}'},
            dataType: 'json',
            success: function(data){
                if (data.status ==1 ) {

                    $(obj).parents("tr").remove();
                    layer.msg('已删除!',{icon:1,time:1000});
                }

            },
            error:function(data) {
                console.log(data.msg);
            },
        });
    });
}
</script>
@endsection