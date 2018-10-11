@extends('admin.common')

@section('title','修改密码')

@section('content')
<div class="pd-20">
  <form class="Huiform" id="loginform" action='' method="post">
    {{csrf_field( ) }}
    <table class="table table-border table-bordered table-bg">
      <thead>
        <tr>
          <th colspan="2">修改密码</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th class="text-r" width="30%">旧密码：</th>
          <td><input name="oldpassword" id="oldpassword" class="input-text" type="password" autocomplete="off" placeholder="密码" tabindex="1" datatype="*6-16" nullmsg="请输入旧密码！" errormsg="4~16个字符，区分大小写！">
          </td>
        </tr>
        <tr>
          <th class="text-r">新密码：</th>
          <td><input name="password" id="newpassword" class="input-text" type="password" autocomplete="off" placeholder="设置密码" tabindex="2" datatype="*6-16"  nullmsg="请输入您的新密码！" errormsg="4~16个字符，区分大小写！" >
          </td>
        </tr>
        <tr>
          <th class="text-r">再次输入新密码：</th>
          <td><input name="password_confirmation" id="newpassword2" class="input-text" type="password" autocomplete="off" placeholder="确认新密码" tabindex="3" datatype="*" recheck="newpassword" nullmsg="请再输入一次新密码！" errormsg="您两次输入的新密码不一致！">
          </td>
        </tr>
        <tr>
          <th></th>
          <td>
            <button type="submit" class="btn btn-success radius" id="admin-password-save" ><i class="icon-ok"></i> 确定</button>
          </td>
        </tr>
      </tbody>
    </table>
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

@if(session('error'))
<div align="center" style="color: red">
      {{session('error')}}
</div>
@endif


@endsection


@section('script')
<script type="text/javascript">

      @if(session('msg'))
      layer.msg("{{session('msg')}}",{icon:1,time:1000});
      @endif




$(".Huiform").Validform();
</script>
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?080836300300be57b7f34f4b3e97d911";
  var s = document.getElementsByTagName("script")[0];
  s.parentNode.insertBefore(hm, s);
})();
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F080836300300be57b7f34f4b3e97d911' type='text/javascript'%3E%3C/script%3E"));
</script>
@endsection