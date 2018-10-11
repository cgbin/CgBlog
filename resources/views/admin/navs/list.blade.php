@extends('admin.common')

@section('title','前台导航条管理')

@section('content')
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页
	<span class="c-gray en">&gt;</span>
	系统管理
	<span class="c-gray en">&gt;</span>
	前台导航条管理
	<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
</nav>
<div class="page-container">
	<div class="cl pd-5 bg-1 bk-gray mt-20">
		<span class="l">
		<a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a>
		<a class="btn btn-primary radius" data-title="添加前台导航条" data-href="{{url('admin/navs_create')}}" onclick="Hui_admin_tab(this)"  href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加前台导航条</a>
		</span>
		<span class="r">共有数据：<strong>{{count($navs_list)}}</strong> 条</span>
	</div>
	<div class="mt-20">
		<table class="table table-border table-bordered table-hover table-bg table-sort">
			<thead>
				<tr class="text-c">
					<th width="25"><input type="checkbox" name="" value=""></th>
					<th width="60">ID</th>
					<th width="80">排序</th>
					<th width="160">导航名称</th>
					<th>URL</th>
					<th>简述</th>
					<th width="160">更新时间</th>
					<th width="100">操作</th>
				</tr>
			</thead>
			<tbody>
				@foreach($navs_list as $data)
				<tr class="text-c">
					<td><input type="checkbox" name="checkbox" value="{{$data->id}}"></td>
					<td>{{$data->id}}</td>
					<td><input type="text" class="input-text text-c" value="{{$data->navs_order}}" onchange="changeorder(this,{{$data->id}})"></td>
					<td class="text-l">{{$data->navs_name}}</td>
					<td>{{$data->navs_url}}</td>
					<td>{{$data->navs_desc}}</td>
					<td>{{$data->updated_at}}</td>

                    <td class="f-14 td-manage">
                    <a title="编辑" href="javascript:;" onclick="system_navs_edit('前台导航条编辑','{{url("admin/navs_edit/$data->id")}}','1','700','480')" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>
						<a title="删除" href="javascript:;" onclick="system_navs_del(this,{{$data->id}})" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection

@section('script')
<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript">

@if(session('msg'))
	layer.msg("{{session('msg')}}",{icon:1,time:1000});
@endif

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
			url: "{{url('admin/navs_destroy')}}/"+arr,
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



/*系统-前台导航条-排序编辑*/
function changeorder(obj,navs_id){
	var order = $(obj).val();

	$.post(
		'{{url('admin/navs_order')}}',
		 {'id': navs_id,'order':order,'_token':'{{csrf_token()}}'},
		  function(data) {
		  	if (data.status==1) {
		  		layer.msg(data.msg,{icon:1,time:1000});
		  	}else{
		  		layer.msg(data.msg,{icon:2,time:1000});
		  	}

			});
}


/*系统-前台导航条-添加*/
function system_navs_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*系统-前台导航条-编辑*/
function system_navs_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}
/*系统-前台导航条-删除*/
function system_navs_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		$.ajax({
			type: 'POST',
			url: '{{url('admin/navs_destroy')}}/'+id,
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


/*导航-发布*/
function navs_start(obj,id){
layer.confirm('确认要发布吗？',function(index){
    $.ajax({
            type: 'POST',
            url: "{{url('admin/navs_show')}}/"+id,
            data:{'_token':'{{csrf_token()}}','_method':'GET'},
            dataType: 'json',
            success: function(data){
                if (data.status==1) {

            $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="navs_stop(this,'+id+')" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>');
            $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
            $(obj).remove();
            layer.msg('已发布!',{icon: 6,time:1000});

                }else{
                layer.msg('发布失败',{icon:2,time:1000});
                }

            },
            error:function(data) {
                console.log(data.msg);
            },
        });
});

}

/*导航-下架*/
function navs_stop(obj,id){
layer.confirm('确认要下架吗？',function(index){
    $.ajax({
            type: 'POST',
            url: "{{url('admin/navs_show')}}/"+id,
            data:{'_token':'{{csrf_token()}}','_method':'GET'},
            dataType: 'json',
            success: function(data){
                if (data.status==1) {

            $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="navs_start(this,'+id+')" href="javascript:;" title="发布"><i class="Hui-iconfont">&#xe603;</i></a>');
            $(obj).parents("tr").find(".td-status").html('<span class="label label-danger radius">待审核</span>');
             $(obj).remove();
            layer.msg('已下架!',{icon: 5,time:1000});

                }else{
                layer.msg('下架失败',{icon:2,time:1000});
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
