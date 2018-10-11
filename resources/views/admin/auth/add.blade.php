@extends('admin.common')

@section('title','权限添加')

@section('content')
<article class="page-container">
    <form class="form form-horizontal" id="form-admin-add" >
    {{csrf_field()}}
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>权限名称：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <input type="text" class="input-text" value="" placeholder="" id="adminName" name="auth_name">
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>父级权限：</label>
        <div class="formControls col-xs-8 col-sm-9"> <span class="select-box" style="width:150px;">
            <select class="select" name="pid" size="1">
                <option value="0">作为顶级权限</option>
                @if($select)
                @foreach($select as $val)
                <option value="{{$val['id']}}">{{$val['auth_name']}}</option>
                @endforeach
                @endif
            </select>
            </span> </div>
    </div>

    <div class="row_add"></div>

    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>作为导航：</label>
        <div class="formControls col-xs-8 col-sm-9 skin-minimal">
            <div class="radio-box">
                <input name="is_nav" type="radio" id="sex-1" checked value="1">
                <label for="sex-1">是</label>
            </div>
            <div class="radio-box">
                <input type="radio" id="sex-2" name="is_nav" value="2">
                <label for="sex-2">否</label>
            </div>
        </div>
    </div>

    <div class="row cl">
        <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
            <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
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

    $('.select').change(function(event) {
            var val = $(this).val();
            if (val > 0) {
                var html = '<div class="row cl"><label class="form-label col-xs-4 col-sm-3">控制器名：</label><div class="formControls col-xs-8 col-sm-9"><input type="text" class="input-text" value="" id="controller" name="controller"></div></div><div class="row cl"><label class="form-label col-xs-4 col-sm-3">方法名：</label><div class="formControls col-xs-8 col-sm-9"><input type="text" class="input-text" value="" id="action" name="action"></div></div>';

                $('.row_add').html(html).fadeIn(1000);
            }else{
                $('.row_add').html('').fadeOut(1000);
            }
    });

    $('.skin-minimal input').iCheck({
        checkboxClass: 'icheckbox-blue',
        radioClass: 'iradio-blue',
        increaseArea: '20%'
    });

    $("#form-admin-add").validate({
        rules:{
            auth_name:{
                required:true,
                minlength:4,
                maxlength:20
            },
        },
        onkeyup:false,
        focusCleanup:true,
        success:"valid",
        submitHandler:function(form){
            $(form).ajaxSubmit({
                type: 'post',
                url: "{{url('admin/auth_add')}}" ,
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