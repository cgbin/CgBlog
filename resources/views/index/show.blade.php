@extends('index.common')

@section('title','详情页')


@section('css')
<link href="{{asset('index/statics/css/new.css')}}" rel="stylesheet">
<link href="{{asset('index/statics/css/index.css')}}" rel="stylesheet">
<link type="text/css" rel="stylesheet" href="{{asset('index/syntaxhighlighter/styles/shThemeEclipse.css')}}">
@endsection


@section('content')
<h1 class="t_nav"><span>您当前的位置：<a href="{{url('/')}}">首页</a>
@if(isset($position))
@foreach($position as $data)
&gt;&nbsp;
<a href='{{url("index/$data->id/edit")}}'>{{$data->cate_name}}</a>
@endforeach
@endif
</span><a href="{{url('/')}}" class="n1">网站首页</a><a href='{{url("index/$detail->cate_id/edit")}}' class="n2">{{$detail->cate_name}}</a></h1>
  <div class="index_about">
    <h2 class="c_titile">{{$detail->title}}</h2>
    <p class="box_c"><span class="d_time">发布时间：{{$detail->created_at}}</span><span>编辑：{{$detail->editor}}</span><span>查看次数：{{$detail->clicks}}</span></p>
    <ul class="infos">

      {!! $detail->content !!}

    </ul>
    <div class="keybq">
    <p><span>关键字词</span>：{{$detail->tags}}</p>

    </div>

    <div class="nextinfo">
      <p>上一篇：
      @if(isset($pre))
      <a href='{{url("index/$pre->id")}}'>
      {{$pre->title}}</a>
      @else
      没有了~
      @endif
      </p>
      <p>下一篇：
      @if(isset($next))
      <a href='{{url("index/$next->id")}}'>
      {{$next->title}}</a>
      @else
      没有了~
      @endif</p>
    </div>
    <div class="otherlink">
      <h2>相关文章</h2>
      <ul>
      @if(isset($likes))
      @foreach($likes as $data)
        <li><a href='{{url("index/$data->id")}}' title="{{$data->title}}">{{$data->title}}</a></li>
      @endforeach
      @endif
      </ul>
    </div>

    <!-- 畅言评论 -->

    <div id="SOHUCS" style="padding-top: 110px" sid="{{$detail->id}}"></div>
  </div>
@endsection


@section('js')
<script type="text/javascript" src="{{asset('index/syntaxhighlighter/scripts/shCore.js')}}"></script>
<script type="text/javascript" src="{{asset('index/syntaxhighlighter/scripts/shBrushXml.js')}}"></script>
<script type="text/javascript" src="{{asset('index/syntaxhighlighter/scripts/shBrushPhp.js')}}"></script>

<script type="text/javascript">
  SyntaxHighlighter.all();
</script>

<script charset="utf-8" type="text/javascript" src="http://changyan.sohu.com/upload/changyan.js" ></script>
<script type="text/javascript">
window.changyan.api.config({
appid: 'cytBvPFn2',
conf: 'prod_bb3285ae57b0b11ffc6043e6e672b939'
});
</script>
@endsection