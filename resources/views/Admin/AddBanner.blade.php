@extends('MasterPage')
@section('css')
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Castoro&display=swap" rel="stylesheet">
  <style>
    .tittle{
      text-align: center;
      font-family: 'Castoro', serif;
    }
    .submit{
      float: right;
    }
    h5{
      color: #720ce2d1;
    }
  </style>
@endsection
@section('content')
  <div class="tittle">
    <h2> Thêm Mới Banner </h2>
  </div>
  <form class="pl-5 pr-5" action="{{ route('xu-ly-them-banner') }}" enctype="multipart/form-data" method="POST">
    @csrf
    <br>
    <div class="form-group row">
        <div class="col-sm-6 mb-3 mb-sm-0">
            <h5><label for="exampleFormControlFile1"> Tên banner: </label></h5>
            <input type="text" class="form-control form-control-user" name="name">
            @if ($errors->has('name'))
                <p class="text-danger">{{ $errors->first('name') }}</p>
            @endif
        </div>
        <div class="col-sm-6 mb-3 mb-sm-0 pt-1">
        <h5><label for="exampleFormControlFile1">Chọn hình ảnh: </label></h5>
        <input type="file" name="img_banner" class="form-control-file" id="exampleFormControlFile1">
        @if ($errors->has('img_banner'))
            <p class="text-danger">{{ $errors->first('img_banner') }}</p>
        @endif
        </div>
    </div>
    <div class="submit pb-3">
        <input class="btn btn-primary" type="submit" value="Thêm mới" >
    </div>
  </form>
@endsection

