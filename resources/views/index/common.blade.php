<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>@yield('title') - {{config('web.web_addtitle')}}</title>
<meta name="keywords" content="个人博客模板,博客模板" />
<meta name="description" content="寻梦主题的个人博客模板，优雅、稳重、大气,低调。" />
<link href="{{asset('index/statics/css/base.css')}}" rel="stylesheet">
@section('css')

@show
<!--[if lt IE 9]>
<script src="{{asset('index/statics/js/modernizr.js')}}"></script>
<![endif]-->
</head>
<body>
<header>
  <div id="logo"><a href="{{url('/')}}"></a></div>

  <nav class="topnav" id="topnav">
  @foreach($navs as $nav)
  <a href='{{url("$nav->navs_url")}}'><span>{{$nav->navs_name}}</span><span class="en">{{$nav->navs_name}}</span></a>
  @endforeach
  </nav>


</header>

@section('banner')

@show

<article class="blogs">

@yield('content')


  <!-- 右边栏 -->
  <aside class="right" >

   <!--  分享按钮 -->
  <!-- Baidu Button BEGIN -->
    <div id="bdshare" style="float: left" class="bdshare_t bds_tools_32 get-codes-bdshare"><a class="bds_tsina"></a><a class="bds_qzone"></a><a class="bds_tqq"></a><a class="bds_renren"></a><span class="bds_more"></span><a class="shareCount"></a></div>
    <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6574585" ></script>
    <script type="text/javascript" id="bdshell_js"></script>
    <script type="text/javascript">
document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
</script>
    <!-- Baidu Button END -->


    @section('weather')

    @show


    <div class="news">

    @if(isset($cate_new))
    <h3>
        <p>栏目<span>最新</span></p>
      </h3>
      <ul class="rank">
        @foreach($cate_new as $data)
      <li><a href='{{url("index/$data->id")}}' title="{{$data->title}}" target="_blank">{{$data->title}}</a></li>
      @endforeach
      </ul>
    @else

    <h3>
      <p>最新<span>文章</span></p>
    </h3>
    <ul class="rank">
    @foreach($article_new as $data)
      <li><a href='{{url("index/$data->id")}}' title="{{$data->title}}" target="_blank">{{$data->title}}</a></li>
      @endforeach
    </ul>
    @endif

    <h3 class="ph">
      <p>点击<span>排行</span></p>
    </h3>
    <ul class="paih">
      @foreach($clicks_rank as $data)
      <li><a href='{{url("index/$data->id")}}' title="{{$data->title}}" target="_blank">{{$data->title}}</a></li>
      @endforeach
    </ul>


    <h3 class="links">
      <p>友情<span>链接</span></p>
    </h3>
    <ul class="website">
    @foreach($links as $data)
      <li><a href="{{$data->links_url}}" target="_blank">{{$data->links_name}}</a></li>
    @endforeach
    </ul>
    </div>


</aside>
</article>


<!-- 尾部 -->
<footer>
  <p> {{config('web.web_beian')}}   Copyright © 2018-2019 {{config('web.web_title')}} <a href="{{config('web.web_url')}}" target="_blank">{{config('web.web_url')}}</a> <a href="/">网站统计</a></p>
</footer>
<script src="{{asset('index/statics/js/silder.js')}}"></script>
@section('js')

@show

</body>
</html>