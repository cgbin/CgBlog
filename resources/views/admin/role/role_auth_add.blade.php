@extends('admin.common')

@section('title','分配权限')

@section('content')
<article class="page-container">
    <form  class="form form-horizontal" id="form-admin-role-add">
    {{csrf_field()}}
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">分配权限：</label>
            <div class="formControls col-xs-8 col-sm-9">
            @foreach($data as $val)
                <dl class="permission-list">
                    <dt>
                        <label>
                            <input type="checkbox" value="{{$val['id']}}" name="auth_ids[]" id="user-Character-0" @if(in_array($val['id'],$auth_ids)) checked @endif>
                            {{$val['auth_name']}}</label>
                    </dt>

                    <dd>
                        <dl class="cl permission-list2">
                            <dd>
                            @foreach($val['children'] as $v2)
                                <label class="">
                                    <input type="checkbox" value="{{$v2['id']}}" name="auth_ids[]" id="user-Character-0-0-0" @if(in_array($v2['id'],$auth_ids)) checked @endif>
                                    {{$v2['auth_name']}}</label>
                            @endforeach

                            </dd>
                        </dl>

                    </dd>
                </dl>
            @endforeach

            </div>
        </div>
        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
                <button type="submit" class="btn btn-success radius" id="admin-role-save" ><i class="icon-ok"></i> 确定</button>
            </div>
        </div>
    </form>
</article>
@endsection

@section('script')
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript">
$(function(){
    //手动勾选父级同时自动勾选全部子级
    $(".permission-list dt input:checkbox").click(function(){
        //prop(),获取或设置在匹配的元素集中的属性值
        $(this).parents("dl").find("dd input:checkbox").prop("checked",$(this).prop("checked"));
    });

    $(".permission-list2 dd input:checkbox").click(function(){
       var l = $(this).parents(".permission-list").find(".permission-list2 dd").find("input:checked").length;
       //若勾选当前子级同时自动勾选其父级
       if ($(this).prop("checked")) {
            $(this).parents(".permission-list").find("dt input:checkbox").prop("checked",true);
       }else{
        //若当前全部子级未勾选，则取消勾选父级
            if (l==0) {
                $(this).parents(".permission-list").find("dt input:checkbox").prop("checked",false);
            }
       }
    });


    $("#form-admin-role-add").validate({
        onkeyup:false,
        focusCleanup:true,
        success:"valid",
        submitHandler:function(form){
            $(form).ajaxSubmit({
                type: 'post',
                url: "" ,
                success: function(data){

                    if (data) {
                        layer.msg('添加成功!',{icon:1,time:1000},function(){
                            var index = parent.layer.getFrameIndex(window.name);
                            parent.window.location = parent.window.location;
                            parent.layer.close(index);
                        });
                    }else{
                        layer.msg('添加失败!',{icon:2,time:1000});
                    }

                }
            });

        }
    });
});
</script>
@endsection