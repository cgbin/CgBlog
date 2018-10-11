@extends('index.common')

@section('title',config('web.web_title'))

@section('css')
<link href="{{asset('index/statics/css/index.css')}}" rel="stylesheet">
<link href="{{asset('index/statics/css/style.css')}}" rel="stylesheet">
@endsection


@section('banner')
<div class="banner">
  <section class="box">
    <ul class="texts">
      {!! config('web.web_description') !!}
    </ul>
    <div class="avatar"><a href="#"><span>{{config('web.web_editor')}}</span></a> </div>
  </section>
</div>
@endsection


@section('content')
<h2 class="title_tj">
    <p>文章<span>推荐</span></p>
  </h2>
  <div class="bloglist left">

    @foreach($article_list as $data)
    <h3>{{$data->title}}</h3>
    @if($data->thumb_pic)
    <figure>
    <img src="{{$data->thumb_pic}}"  >
    </figure>
    @endif
    <ul>
      <p>{{$data->description}}</p>
      <a title="{{$data->title}}" href='{{url("index/$data->id")}}' target="_blank" class="readmore">阅读全文>></a>
    </ul>
    <p class="dateview"><span style="padding-left: 8px">{{$data->created_at}}</span><span>作者：{{$data->editor}}</span><span>文章分类：
    @if(isset($data->cate->cate_name))
    [<a href='
    {{url("index/$data->cate_id/edit")}}'>{{$data->cate->cate_name}}</a>]
    @else
    [<a href='#'>暂无</a>]
    </span></p>
    @endif

    @endforeach

    <!-- 分页 -->
    <div class="page">
{{$article_list->links()}}
    </div>
    <!-- 分页 -->
  </div>


@endsection


  @section('weather')
    <div class="weather" style="float: left"><iframe width="250" scrolling="no" height="60" frameborder="0" allowtransparency="true" src="http://i.tianqi.com/index.php?c=code&id=12&icon=1&num=1"></iframe></div>
  @endsection


  @section('js')

{!! config('web.web_visit') !!}

  @endsection