@extends('admin.common')

@section('link')
<link href="{{asset('admin/lib/ueditor/themes/default/css/umeditor.css')}}" type="text/css" rel="stylesheet">
<link href="/admin/lib/webuploader/0.1.5/webuploader.css" rel="stylesheet" type="text/css" />
@endsection

@section('title','修改文章 - 文章管理')

@section('content')
<article class="page-container">
	<form class="form form-horizontal" id="form-article-add" action="{{url('admin/article_update')}}/{{$list->id}}" method="post">
	{{csrf_field()}}
	<input type="hidden" name="_method" value="PUT">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>文章标题：</label>
			<div class="formControls col-xs-8 col-sm-9">
			@if ($errors->first('title'))
			    <p style="color: red">
			        {{$errors->first('title')}}
			    </p>
			@endif
				<input type="text" class="input-text" value="{{$list->title}}" placeholder="" id="articletitle" name="title">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>文章作者：</label>
			<div class="formControls col-xs-8 col-sm-9">

			@if ($errors->first('editor'))
			    <p style="color: red">
			        {{$errors->first('editor')}}
			    </p>
			@endif

				<input type="text" class="input-text" value="{{$list->editor}}" placeholder="" id="author" name="editor">
			</div>
		</div>
		<div class="row cl">

			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>分类栏目：</label>
			<div class="formControls col-xs-8 col-sm-9">

			 <span class="select-box">
				<select name="cate_id" class="select">
					@foreach($cate_list as $data)
					<option @if($data->id==$list->cate_id)
						selected="selected"
						@endif
					 value="{{$data->id}}">{{str_repeat('——',$data->heng)}}{{$data->cate_name}}</option>
					@endforeach
				</select>
				</span> </div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>文章简介：</label>
			<div class="formControls col-xs-8 col-sm-9">
			@if ($errors->first('description'))
			    <p style="color: red">
			        {{$errors->first('description')}}
			    </p>
			@endif
				<textarea name="description" cols="" rows="" class="textarea"  placeholder="说点什么...最少输入10个字符" datatype="*10-100" dragonfly="true" nullmsg="备注不能为空！" onKeyUp="$.Huitextarealength(this,200)">{{$list->description}}</textarea>
				<p class="textarea-numberbar"><em class="textarea-length">0</em>/200</p>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>标签：</label>
			<div class="formControls col-xs-8 col-sm-9">
			@if ($errors->first('tags'))
			    <p style="color: red">
			        {{$errors->first('tags')}}
			    </p>
			@endif
				<input type="text" class="input-text" value="{{$list->tags}}" placeholder="" id="tags" name="tags">
			</div>
		</div>


		<div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">缩略图上传：</label>
        <div id="uploader-demo" class="formControls col-xs-8 col-sm-9">
            <!--用来存放item-->
            <div id="fileList" class="uploader-list">
            @if($list->thumb_pic)
            <img src="{{$list->thumb_pic}}" alt="" width="100px" height="100px">
			@endif
            </div>
            <div id="filePicker">选择图片</div>

            <!-- 用来存放上传成功后的图片路径 -->
            <input type="hidden" name="thumb_pic" value="{{$list->thumb_pic}}">

        </div>
    </div>

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>文章内容：</label>
			<div class="formControls col-xs-8 col-sm-9">
			@if ($errors->first('content'))
			    <p style="color: red">
			        {{$errors->first('content')}}
			    </p>
			@endif
				<script id="editor" name="content"  type="text/plain" style="width:100%;height:400px;">{!!$list->content!!}</script>
			</div>
		</div>

		<div class="row cl">
					<label class="form-label col-xs-4 col-sm-3">排序：</label>
					<div class="formControls col-xs-6 col-sm-7">
					@if ($errors->first('article_order'))
					    <p style="color: red">
					        {{$errors->first('article_order')}}
					    </p>
					@endif
						<input type="text" class="input-text" value="{{$list->article_order}}" placeholder="" id="" name="article_order">
					</div>
					<div class="col-3">
					</div>
				</div>


		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<button  class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 提交审核</button>

			</div>
		</div>
	</form>
</article>
@endsection


@section('script')
<!--请在下方写此页面业务相关的脚本-->
<!-- umditor -->
<script type="text/javascript" src="{{asset('admin/lib/ueditor/umeditor.config.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/lib/ueditor/umeditor.min.js')}}"> </script>
<script type="text/javascript" src="{{asset('admin/lib/ueditor/lang/zh-cn/zh-cn.js')}}"></script>
<script type="text/javascript" src="/admin/lib/webuploader/0.1.5/webuploader.min.js"></script>

<script type="text/javascript">

$(function(){

	@if(session('msg'))
	layer.msg('修改成功',{icon:1,time:1000});
	@endif

	var ue = UM.getEditor('editor');

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
                $('input[name=thumb_pic]').val(response.path);
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
});
</script>
<!--/请在上方写此页面业务相关的脚本-->
@endsection