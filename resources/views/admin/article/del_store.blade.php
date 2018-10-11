@extends('admin.common')

@section('title','文章回收站')

@section('content')
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 文章管理 <span class="c-gray en">&gt;</span> 回收站 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">

    <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onClick="datadel()" title="批量删除" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> </span> <span class="r">共有数据：<strong>{{count($list)}}</strong> 条</span> </div>
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
                    <th >标签</th>
                    <th width="150">更新时间</th>
                    <th width="85">浏览次数</th>
                    <th width="80">发布状态</th>
                    <th width="120">操作</th>
                </tr>
            </thead>
            <tbody>
            @foreach($list as $data)
                <tr class="text-c">
                    <td><input type="checkbox" value="{{$data->id}}" name="checkbox" ></td>
                    <td>{{$data->id}}</td>
                    <td>{{$data->article_order}}</td>
                    <td class="text-l">{{$data->title}}</td>
                    <td>{{$data->cate_name}}</td>
                    <td>{{$data->editor}}</td>
                    <td>{{$data->tags}}</td>
                    <td>{{$data->updated_at}}</td>
                    <td>{{$data->clicks}}</td>
                    <td class="td-status"><span class="label label-defaunt radius">已删除</span></td>
                    <td class="f-14 td-manage">

                    <a style="text-decoration:none" onClick="article_start(this,{{$data->id}})" href="javascript:;" title="发布"><i class="Hui-iconfont">&#xe603;</i></a>

                      <a style="text-decoration:none" class="ml-5" onClick="article_del(this,{{$data->id}})" href="javascript:;" title="彻底删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>


    </div>
</div>
@endsection

@section('script')
<script type="text/javascript" src="{{asset('admin/lib/My97DatePicker/4.8/WdatePicker.js')}}"></script>

<script type="text/javascript" src="{{asset('admin/lib/laypage/1.2/laypage.js')}}"></script>
<script type="text/javascript">

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
            type: 'GET',
            url: "{{url('admin/article_true_del')}}/"+arr,
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

/*资讯-删除*/
function article_del(obj,id){
    layer.confirm('确认要彻底删除吗？',function(index){
        $.ajax({
            type: 'GET',
            url: "{{url('admin/article_true_del')}}/"+id,
            dataType: 'json',
            success: function(data){
                if (data.status==1) {
                    $(obj).parents("tr").remove();
                layer.msg('已删除!',{icon:1,time:1000});
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

                        $(obj).parents("tr").remove();
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


</script>
@endsection
