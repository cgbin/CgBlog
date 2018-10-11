@extends('admin.common')

@section('title','角色管理')

@section('content')
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 管理员管理 <span class="c-gray en">&gt;</span> 角色管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">

    <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a href="javascript:;" onclick="admin_permission_add('添加角色,'{{url('admin/role_add')}}','','510')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加角色</a></span> <span class="r">共有数据：<strong>54</strong> 条</span> </div>
    <table class="table table-border table-bordered table-bg table-sort">
        <thead>
            <tr class="text-c">
                <th width="25"><input type="checkbox" name="" value=""></th>
                <th width="40">ID</th>
                <th width="100">角色名称</th>
                <th >拥有权限</th>
                <th >控制器和方法</th>
                <th width="80">操作</th>
            </tr>
        </thead>
        <tbody>
        @foreach($data as $val)
            <tr class="text-c">
                <td><input type="checkbox" value="{{$val['id']}}" name=""></td>
                <td>{{$val['id']}}</td>
                <td>{{$val['role_name']}}</td>
                <td>{{$val['auth_ids']}}</td>
                <td>{{$val['auth_ac']}}</td>
                <td><a title="添加权限" href="javascript:;" onclick="admin_permission_add('权限添加','{{url('admin/role_auth_add')}}/{{$val['id']}}','','510')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe603;</i></a>&nbsp;<a title="编辑" href="javascript:;" onclick="admin_permission_edit('角色编辑','{{url('admin/role_edit')}}/{{$val['id']}}','1','','510')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> <a title="删除" href="javascript:;" onclick="admin_permission_del(this,{{$val['id']}})" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('script')
<script type="text/javascript" src="/admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript">

$(function(){

    $('.table-sort').DataTable({
          "bSort": false,
    });
});
/*
    参数解释：
    title   标题
    url     请求的url
    id      需要操作的数据id
    w       弹出层宽度（缺省调默认值）
    h       弹出层高度（缺省调默认值）
*/
/*管理员-权限-添加*/
function admin_permission_add(title,url,w,h){
    layer_show(title,url,w,h);
}
/*管理员-权限-编辑*/
function admin_permission_edit(title,url,id,w,h){
    layer_show(title,url,w,h);
}

/*管理员-权限-删除*/
function admin_permission_del(obj,id){
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