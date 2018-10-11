@extends('admin.common')

@section('link')
<!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
@endsection

@section('title','文章列表')

@section('content')
<nav class="breadcrumb" style="padding-top: 2px"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 文章管理 <span class="c-gray en">&gt;</span> 文章列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onClick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a class="btn btn-primary radius" data-title="添加文章" data-href="{{url('admin/article_create')}}" onclick="Hui_admin_tab(this)" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加文章</a></span> <span class="r">共有数据：<strong>{{count($list)}}</strong> 条</span> </div>
    <div class="mt-20">
        <table class="table table-border table-bordered table-bg table-hover table-sort table-responsive">
            <thead>
                <tr class="text-c">
                    <th width="25"><input type="checkbox" name="" value=""></th>
                    <th width="60">ID</th>
                    <th width="80">排序</th>
                    <th >标题</th>
                    <th width="80">分类</th>
                    <th width="80">作者</th>
                    <th width="240">标签</th>
                    <th width="150">更新时间</th>
                    <th width="85">浏览次数</th>
                    <th width="80">发布状态</th>
                    <th width="120">操作</th>
                </tr>
            </thead>
            <tbody>
            @foreach($list as $data)
                <tr class="text-c">
                    <td><input type="checkbox" value="{{$data->id}}" name="checkbox"></td>
                    <td>{{$data->id}}</td>
                    <td><input type="text" class="input-text text-c" value="{{$data->article_order}}" onchange="changeorder(this,{{$data->id}})"></td>

                    <td class="text-l">{{$data->title}}</td>
                    <td>{{$data->cate_name?$data->cate_name:'暂无分类'}}</td>
                    <td>{{$data->editor}}</td>
                    <td>{{$data->tags}}</td>
                    <td>{{$data->updated_at}}</td>
                    <td>{{$data->clicks}}</td>
                    <td class="td-status"><span class="label
                    @if($data->status)
                     label-success
                    @else
                    label-danger
                    @endif
                    radius">
                    {{$data->status?'已发布':'待审核'}}</span></td>
                    <td class="f-14 td-manage">
                    @if($data->status)
                     <a style="text-decoration:none" onClick="article_stop(this,{{$data->id}})" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>
                    @else
                    <a style="text-decoration:none" onClick="article_start(this,{{$data->id}})" href="javascript:;" title="发布"><i class="Hui-iconfont">&#xe603;</i></a>
                    @endif
                     <a style="text-decoration:none" class="ml-5" onClick="article_edit('文章编辑','{{url("admin/article_edit/$data->id")}}','1','1000','600')" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a> <a style="text-decoration:none" class="ml-5" onClick="article_del(this,{{$data->id}})" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>

    <nav aria-label="Page navigation">
    {{$list->links()}}
    </nav>

    </div>
</div>
@endsection
@section('script')
<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="{{asset('admin/lib/ueditor/umeditor.config.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/lib/ueditor/umeditor.min.js')}}"> </script>
<script type="text/javascript" src="{{asset('admin/lib/ueditor/lang/zh-cn/zh-cn.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{asset('admin/lib/laypage/1.2/laypage.js')}}"></script>
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
			url: "{{url('admin/article_destroy')}}/"+arr,
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


/*系统-栏目-排序编辑*/
function changeorder(obj,article_id){
    var order = $(obj).val();

    $.post(
        '{{url('admin/article_order')}}',
         {'id': article_id,'order':order,'_token':'{{csrf_token()}}'},
          function(data) {
            if (data.status==1) {
                layer.msg(data.msg,{icon:1,time:1000});
            }else{
                layer.msg(data.msg,{icon:2,time:1000});
            }

            });
}


/*系统-栏目-编辑*/
function article_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}
/*系统-栏目-删除*/
function article_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		$.ajax({
			type: 'POST',
			url: '{{url('admin/article_destroy')}}/'+id,
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


/*资讯-发布*/
function article_start(obj,id){
layer.confirm('确认要发布吗？',function(index){
    $.ajax({
            type: 'POST',
            url: "{{url('admin/article_show')}}/"+id,
            data:{'_token':'{{csrf_token()}}','_method':'GET'},
            dataType: 'json',
            success: function(data){
                if (data.status==1) {

            $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="article_stop(this,'+id+')" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>');
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

/*资讯-下架*/
function article_stop(obj,id){
layer.confirm('确认要下架吗？',function(index){
    $.ajax({
            type: 'POST',
            url: "{{url('admin/article_show')}}/"+id,
            data:{'_token':'{{csrf_token()}}','_method':'GET'},
            dataType: 'json',
            success: function(data){
                if (data.status==1) {

            $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="article_start(this,'+id+')" href="javascript:;" title="发布"><i class="Hui-iconfont">&#xe603;</i></a>');
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
