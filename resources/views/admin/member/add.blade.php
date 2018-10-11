@extends('admin.common')

@section('link')
<link href="/admin/lib/webuploader/0.1.5/webuploader.css" rel="stylesheet" type="text/css" />
@endsection


@section('title','会员添加')

@section('content')
<article class="page-container">
    <form class="form form-horizontal" id="form-admin-add" >
    {{csrf_field()}}
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>会员名称：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <input type="text" class="input-text" value="" placeholder="" id="username"  name="username">
        </div>
    </div>

    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>密码：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <input type="text" class="input-text" value="" placeholder="" id="password" name="password">
        </div>
    </div>

    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>性别：</label>
        <div class="formControls col-xs-8 col-sm-9 skin-minimal">
            <div class="radio-box">
                <input name="gender" type="radio" id="sex-1" checked value="1">
                <label for="sex-1">男</label>
            </div>
            <div class="radio-box">
                <input type="radio" id="sex-2" name="gender" value="2">
                <label for="sex-2">女</label>
            </div>
            <div class="radio-box">
                <input name="gender" type="radio" id="sex-3" value="3">
                <label for="sex-3">保密</label>
            </div>
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3">手机：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <input type="text" class="input-text" value="" placeholder="" id="mobile" name="mobile">
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3">邮箱：</label>
        <div class="formControls col-xs-8 col-sm-9">
            <input type="text" class="input-text" placeholder="@" name="email" id="email">
        </div>
    </div>

    <!-- <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">图片上传：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <div class="uploader-list-container">
                    <div class="queueList">
                        <div id="dndArea" class="placeholder">
                            <div id="filePicker-2"></div>
                            <p>或将照片拖到这里，单次最多可选300张</p>
                        </div>
                    </div>
                    <div class="statusBar" style="display:none;">
                        <div class="progress"> <span class="text">0%</span> <span class="percentage"></span> </div>
                        <div class="info"></div>
                        <div class="btns">
                            <div id="filePicker2"></div>
                            <div class="uploadBtn">开始上传</div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3">图片上传：</label>
        <div id="uploader-demo" class="formControls col-xs-8 col-sm-9">
            <!--用来存放item-->
            <div id="fileList" class="uploader-list"></div>
            <div id="filePicker">选择图片</div>

            <!-- 用来存放上传成功后的图片路径 -->
            <input type="hidden" name="avatar" value="">
        </div>
    </div>

    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3">所属区域：</label>

        <div class="formControls col-xs-8 col-sm-9" id="demo">

            <select name="province" class="select select-box"  style="width:150px;"></select>

            <select name="city" class="select select-box"  style="width:150px;"></select>

            <select name="area" class="select select-box"  style="width:150px;"></select>
        </div>
    </div>



    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>账号类别：</label>
        <div class="formControls col-xs-8 col-sm-9 skin-minimal">
            <div class="radio-box">
                <input name="type" type="radio" id="sex-4" checked value="1">
                <label for="sex-4">学生</label>
            </div>
            <div class="radio-box">
                <input type="radio" id="sex-5" name="type" value="2">
                <label for="sex-5">老师</label>
            </div>
        </div>
    </div>

    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>账号状态：</label>
        <div class="formControls col-xs-8 col-sm-9 skin-minimal">
            <div class="radio-box">
                <input name="status" type="radio" id="sex-6" checked value="2">
                <label for="sex-6">已启用</label>
            </div>
            <div class="radio-box">
                <input type="radio" id="sex-7" name="status" value="1">
                <label for="sex-7">已禁用</label>
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
<script type="text/javascript" src="/admin/script/jquery.citys.js"></script>
<script type="text/javascript" src="/admin/lib/webuploader/0.1.5/webuploader.min.js"></script>
<script type="text/javascript">
$(function(){
    //实例化城市联动
    $('#demo').citys({
                    required:false,
                    nodata:'disabled'
                });


    $('.skin-minimal input').iCheck({
        checkboxClass: 'icheckbox-blue',
        radioClass: 'iradio-blue',
        increaseArea: '20%'
    });

    $("#form-admin-add").validate({
        rules:{
            username:{
                required:true,
                minlength:4,
                maxlength:20
            },
            password:{
                required:true,
                minlength:3,
                maxlength:20
            },
            mobile:{
                digits:true,
                maxlength:11
            },
            email:{
                email:true
            },
        },
        onkeyup:false,
        success:"valid",
        submitHandler:function(form){
            $(form).ajaxSubmit({
                type: 'post',
                url: "{{url('admin/member_add')}}" ,
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

    // 初始化Web Uploader
var uploader = WebUploader.create({

    // 选完文件后，是否自动上传。
    auto: true,

    formData :{
        _token : "{{csrf_token()}}"
    },
    // swf文件路径/public/admin/lib/webuploader/0.1.5/Uploader.swf
    swf: '/admin/lib/webuploader/0.1.5/Uploader.swf',

    // 文件接收服务端。
    server: '/admin/avatar_upload',

    // 选择文件的按钮。可选。
    // 内部根据当前运行是创建，可能是input元素，也可能是flash.
    pick: '#filePicker',

    // 只允许选择图片文件。
    accept: {
        title: 'Images',
        extensions: 'gif,jpg,jpeg,bmp,png',
        mimeTypes: 'image/*'
    }
});

            // 当有文件添加进来的时候
        uploader.on( 'fileQueued', function( file ) {

            var $list = $('#fileList');

            var $li = $(
                    '<div id="' + file.id + '" class="file-item thumbnail">' +
                        '<img>' +
                        '<div class="info">' + file.name + '</div>' +
                    '</div>'
                    ),
                $img = $li.find('img');


            // $list为容器jQuery实例
            $list.html( $li );

            // 创建缩略图
            // 如果为非图片文件，可以不用调用此方法。
            // thumbnailWidth x thumbnailHeight 为 100 x 100
            var thumbnailWidth, thumbnailHeight = 100 ;

            uploader.makeThumb( file, function( error, src ) {
                if ( error ) {
                    $img.replaceWith('<span>不能预览</span>');
                    return;
                }

                $img.attr( 'src', src );
            }, thumbnailWidth, thumbnailHeight );
        });


                    // 文件上传成功，给item添加成功class, 用样式标记上传成功。
            uploader.on( 'uploadSuccess', function( file , response ) {
                $( '#'+file.id ).addClass('upload-state-done');
                //需要将返回值中的path写到input隐藏域中，供用户提交
                $('input[name=avatar]').val(response.path);
            });

            // 文件上传失败，显示上传出错。
            uploader.on( 'uploadError', function( file ) {
                var $li = $( '#'+file.id ),
                    $error = $li.find('div.error');

                // 避免重复创建
                if ( !$error.length ) {
                    $error = $('<div class="error"></div>').appendTo( $li );
                }

                $error.text('上传失败');
            });

            // 完成上传完了，成功或者失败，先删除进度条。
            uploader.on( 'uploadComplete', function( file ) {
                $( '#'+file.id ).find('.progress').remove();
            });


</script>

@endsection