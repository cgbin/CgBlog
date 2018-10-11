@extends('admin.common')

@section('title','网站配置项添加')

@section('content')
<div class="page-container">
	<form action="{{url('admin/configs_store')}}" method="post" class="form form-horizontal" id="form-configs-add">
	{{csrf_field()}}
		<div id="tab-configs" class="HuiTab">
			<div class="tabBar cl">
				<span>添加网站配置项</span>

			</div>
			<div class="tabCon">

				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-3">
						<span class="c-red">*</span>
						配置项标题：</label>
					<div class="formControls col-xs-6 col-sm-7">
						<input type="text" class="input-text" value="{{old('configs_title')}}" placeholder="" id="" name="configs_title">
					</div>
					<div class="col-3">
					</div>
				</div>

				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-3">
						<span class="c-red">*</span>
						配置项变量名：</label>
					<div class="formControls col-xs-6 col-sm-7">
						<input type="text" class="input-text" value="{{old('configs_name')}}" placeholder="" id="" name="configs_name">
					</div>

					<div class="col-3">
					</div>
				</div>

				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>配置项类型：</label>
					<div class="formControls col-xs-6 col-sm-7">
						<input type="radio" checked  value="input" placeholder="" id="" name="configs_type">input　　
						<input type="radio" @if(old('configs_type')=='textarea')
						checked
						@endif value="textarea" placeholder="" id="" name="configs_type">texterea　　
						<input type="radio" @if(old('configs_type')=='radio')
						checked
						@endif value="radio" placeholder="" id="" name="configs_type">radio
					</div>
					<div class="col-3">
					</div>
				</div>

				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>配置项简述：</label>
					<div class="formControls col-xs-6 col-sm-7">
						<textarea name="configs_desc" cols="" rows="" class="textarea"  placeholder="说点什么..." datatype="*10-100" dragonfly="true" nullmsg="备注不能为空！" >{{old('configs_desc')}}</textarea>
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


	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});

	$("#tab-configs").Huitab({
		index:0
	});
	$("#form-configs-add").validate({
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