@extends('index.common')

@section('title','列表页')

@section('css')
<link href="{{asset('index/statics/css/style.css')}}" rel="stylesheet">
<link href="{{asset('index/statics/css/index.css')}}" rel="stylesheet">
@endsection


@section('content')
<h1 class="t_nav">

<a href="{{url('/')}}" class="n1">网站首页</a><a href='{{url("index/$now_cate->id/edit")}}' class="n2">{{$now_cate->cate_name}}</a>

</h1>
<div class="newblog left">
  @foreach($article_list as $data)
   <h2>{{$data->title}}</h2>
   <p class="dateview"><span>&nbsp;发布时间：{{$data->created_at}}</span><span>作者：{{$data->editor}}</span><span>分类：[<a href='{{url("index/$data->cate_id/edit")}}'>{{$data->cate_name}}</a>]</span></p>

    @if($data->thumb_pic)
    <figure>
    <img src="{{$data->thumb_pic}}" >
    </figure>
    @endif

    <ul class="nlist">
      <p>{{$data->cate_description}}</p>
      <a title="{{$data->title}}" href='{{url("index/$data->id")}}' target="_blank" class="readmore">阅读全文>></a>
    </ul>
    <div class="line"></div>
     @endforeach


    <div class="blank"></div>


    <!-- 分页 -->
    <div class="page">
      {{$article_list->links()}}
    </div>
    <!-- 分页 -->


    <!-- 广告 -->
    <br>
    <br>

</div>
@endsection


  @section('weather')
    <div class="rnav" style="float: left">
      <ul>
      @foreach($cates as $k=>$data)
            <li class="rnav{{$k+1}}"><a href='{{url("index/$data->id/edit")}}' target="_blank">{{$data->cate_name}}</a></li>
      @endforeach
     </ul>
    </div>
  @endsection