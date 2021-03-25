@extends('MasterPage')
@section('css')
<style>
    .img_news{
        height: 250px;
    }
</style>
@endsection
@section('content')
<div class="pl-5 col-lg-10">

        <!-- Title -->
<h2 class="mt-4">{{$news->title}}</h2>

        <!-- Author -->
        <h6>
          Tác giả
        <a href="#">{{$news->post_author}}</a>
        </h6>

        <hr>

        <!-- Date/Time -->
      <p>{{$news->post_date}}</p>

        <hr>

        <!-- Preview Image -->
      <img class="img-fluid rounded" src="{{$news->url_img}}" alt="">

        <hr>

        <!-- Post Content -->
      <p class="lead">{{$news->title_website}}</p>

      <div id="content_news">@php echo $news->content @endphp</div>

      <h6 class="float-right">Nguồn: {{$news->post_source}}</h6>
      
      </div>
@endsection
