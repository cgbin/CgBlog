@extends('admin.common')

@section('title','栏目添加')

@section('content')
<div class="page-container">
	<form action="{{url('admin/cate_add')}}" method="post" class="form form-horizontal" id="form-category-add">
	{{csrf_field()}}
		<div id="tab-category" class="HuiTab">
			<div class="tabBar cl">
				<span>添加栏目</span>

			</div>
			<div class="tabCon">

				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-3">
						<span class="c-red">*</span>
						上级栏目：</label>
					<div class="formControls col-xs-6 col-sm-7">
						<span class="select-box">
						<select class="select" id="sel_Sub" name="pid">
							<option value="0">顶级分类</option>
							@foreach($option as $data)
							<option value="{{$data->id}}">{{$data->cate_name}}</option>
							@endforeach
						</select>
						</span>
					</div>
					<div class="col-3">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-3">
						<span class="c-red">*</span>
						分类名称：</label>
					<div class="formControls col-xs-6 col-sm-7">
						<input type="text" class="input-text" value="" placeholder="" id="" name="cate_name">
					</div>
					<div class="col-3">
					</div>
				</div>

				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-3">排序：</label>
					<div class="formControls col-xs-6 col-sm-7">
						<input type="text" class="input-text" value="100" placeholder="" id="" name="cate_order">
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

	$("#tab-category").Huitab({
		index:0
	});
	$("#form-category-add").validate({
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