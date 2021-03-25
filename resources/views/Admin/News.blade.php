@extends('MasterPage')
@section('css')
<style>
    .img_news{
        width: 420px;
        height: 250px;
    }
    .header-content a{
      margin-left: 5%;
      border-radius: 8px;
      height: 35px;
      text-decoration: none;
      text-align: center;
    }
</style>
@endsection
@section('content')
<div class="header-content d-flex">
  <h3 class="pl-5"> Danh Sách Tin Tức</h3>
  <a type="button" href="{{ route('add-news') }}" class="btn-sm btn-success"> <i class="fa fa-plus"></i> Thêm mới </a>
  </div>
<hr>
<div class="container">
    @foreach($news as $data)
    <div class="row" style="margin-top:20px;">
      <div class="col-sm-5" >
        <a href="{{ route('get-detail-news', ['id' => $data->id]) }}"><img class="img_news" src="{{$data->url_img}}" alt="Img"></a>
      </div>
      <div class="col-sm-7">
      <h5 class="font-weight-bold">{{$data->title}}</h5>
      <h6>{{$data->short_content}}</h6>
      <h6>{{$data->post_author}}</h6>
      <a href="{{ route('del-news', ['id' => $data->id]) }}"><button onclick="return confirm('Bạn có chắc chắn muốn xóa?')" type="button" class="btn btn-outline-danger float-right" style="margin-left:10px; width: 50px;"> <i class="fa fa-trash"> </i></button></a>
      <a href="{{ route('update-news', ['id' => $data->id]) }}"><button type="button" class="btn btn-outline-info float-right" style="margin-left:10px; width: 50px;"><i class="fa fa-paint-brush"></i></button></a>
      <a href="{{ route('get-detail-news', ['id' => $data->id]) }}"><button type="button" class="btn btn-outline-info float-right" style="width: 120px;">Xem chi tiết</button></a>
      </div>
    </div>
    @endforeach
</div>
@endsection