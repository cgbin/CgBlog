@extends('admin.common')

@section('title','前台导航修改')

@section('content')
<div class="page-container">
	<form action='{{url("admin/navs_update/$list->id")}}' method="post" class="form form-horizontal" id="form-navs-add">
	{{csrf_field()}}
	{{method_field('PUT')}}
		<div id="tab-navs" class="HuiTab">
			<div class="tabBar cl">
				<span>修改前台导航</span>

			</div>
			<div class="tabCon">

				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-3">
						<span class="c-red">*</span>
						导航名称：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" class="input-text" value="{{$list->navs_name}}" placeholder="" id="" name="navs_name">
					</div>
					<div class="col-3">
					</div>
				</div>

				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-3">
						<span class="c-red">*</span>
						导航URL：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" class="input-text" value="{{$list->navs_url}}" placeholder="" id="" name="navs_url">
					</div>
					<div class="col-3">
					</div>
				</div>

				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>导航简述：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" class="input-text" value="{{$list->navs_desc}}" placeholder="" id="" name="navs_desc">
					</div>
					<div class="col-3">
					</div>
				</div>

				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-3">排序：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" class="input-text" value="{{$list->navs_order}}" placeholder="" id="" name="navs_order">
					</div>
					<div class="col-3">
					</div>
				</div>


			</div>
		</div>
		<div class="row cl">
			<div class="col-9 col-offset-3">
				<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
			</div>
		</div>
	</form>
</div>

@if (count($errors) > 0)
    <div align="center" style="color: red">
        <ul>
            @foreach ($errors->all() as $error)
                <li >{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@endsection


@section('script')
<!--请在下方写此页面业务相关的脚本-->

<script type="text/javascript">
$(function(){

	@if(session('msg'))
	layer.msg('修改成功',{icon:1,time:1000});
	@endif

	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});

	$("#tab-navs").Huitab({
		index:0
	});
	$("#form-navs-add").validate({
		rules:{

		},
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){
			//$(form).ajaxSubmit();
			var index = parent.layer.getFrameIndex(window.name);
			//parent.$('.btn-refresh').click();
			parent.layer.close(index);
		}
	});
});
</script>
<!--/请在上方写此页面业务相关的脚本-->
@endsection