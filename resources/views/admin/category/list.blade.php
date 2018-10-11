@extends('admin.common')

@section('title','文章管理')

@section('content')
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页
    <span class="c-gray en">&gt;</span>
    系统管理
    <span class="c-gray en">&gt;</span>
    分类管理
    <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
</nav>
<div class="page-container">
    <div class="cl pd-5 bg-1 bk-gray mt-20">
        <span class="l">
        <a class="btn btn-primary radius" data-title="添加分类" data-href="{{url('admin/cate_add')}}" onclick="Hui_admin_tab(this)"  href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加分类</a>
        </span>
        <span class="r">共有数据：<strong>{{count($cate_list)}}</strong> 条</span>
    </div>
    <div class="mt-20">
        <table class="table table-border table-bordered table-hover table-bg table-sort">
            <thead>
                <tr class="text-c">
                    <th width="80">ID</th>
                    <th width="80">排序</th>
                    <th>栏目名称</th>
                    <th width="100">查看次数</th>
                    <th width="100">操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cate_list as $data)
                <tr class="text-c">
                    <td>{{$data->id}}</td>
                    <td><input type="text" class="input-text text-c" value="{{$data->cate_order}}" onchange="changeorder(this,{{$data->id}})"></td>
                    <td class="text-l">{{str_repeat('——',$data->heng) }}{{$data->cate_name}}</td>
                    <td>{{$data->cate_clicks}}</td>
                    <td class="f-14"><a title="编辑" href="javascript:;" onclick="system_category_edit('栏目编辑','{{url('admin/cate_edit')}}/{{$data->id}}','1','700','480')" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>
                        <a title="删除" href="javascript:;" onclick="system_category_del(this,{{$data->id}})" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
@endsection

@section('script')
<!--请在下方写此页面业务相关的脚本-->

<script type="text/javascript" src="{{asset('admin/lib/laypage/1.2/laypage.js')}}"></script>
<script type="text/javascript">

@if(session('msg'))
	layer.msg("{{session('msg')}}",{icon:1,time:1000});
@endif



/*系统-栏目-排序编辑*/
function changeorder(obj,cate_id){
	var order = $(obj).val();

	$.post(
		'{{url('admin/cate_store')}}',
		 {'id': cate_id,'order':order,'_token':'{{csrf_token()}}'},
		  function(data) {
		  	if (data.status==1) {
		  		layer.msg(data.msg,{icon:1,time:1000});
		  	}else{
		  		layer.msg(data.msg,{icon:2,time:1000});
		  	}

			});
}


/*系统-栏目-添加*/
function system_category_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*系统-栏目-编辑*/
function system_category_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}
/*系统-栏目-删除*/
function system_category_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		$.ajax({
			type: 'POST',
			url: '{{url('admin/cate_destroy')}}/'+id,
			data:{'_method':'DELETE','_token':'{{csrf_token()}}'},
			dataType: 'json',
			success: function(data){
				if (data.status ==1 ) {

					layer.msg('已删除!',{icon:1,time:1000});
                    setTimeout(location.reload(), 1000);
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
