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
    <h2> @if(isset($news)) Cập nhật @else Thêm Mới @endif Tin Tức </h2>
  </div>
  @if(isset($news))
  <form class="pl-5 pr-5" action="{{ route('xu-ly-cap-nhat', ['id' => $news->id]) }}" enctype="multipart/form-data" method="POST">
  @else
  <form class="pl-5 pr-5" action="{{ route('xu-ly-them-tin-tuc') }}" enctype="multipart/form-data" method="POST">
  @endif
    @csrf
      <br>
      <div class="form-group row">
          <div class="col-sm-4 mb-3 mb-sm-0">
            <h5><label for="exampleFormControlFile1"> Thể Loại: </label></h5>
            <select class="form-control" id="exampleFormControlSelect1" name="category">
              @if(isset($allCategories))
                  @foreach($allCategories as $data)
                    @if(isset($news))
                      <?php 
                        $selected = '';
                        if($data->id == $news->category_id) {
                          $selected = 'selected';
                        }
                      ?>
                    @endif
                    <option @if(isset($news)) {!! $selected !!} @endif value="{{ $data->category_name }}">{{$data->category_name}}</option>
                  @endforeach
              @endif 
            </select>
            @if ($errors->has('category'))
            <p class="text-danger">{{ $errors->first('category') }}</p>
            @endif
          </div>
          <div class="col-sm-4">
            <h5><label for="exampleFormControlFile1"> Tác giả: </label></h5>
            <input type="text" @if(isset($news)) value="{{ $news->post_author }}" @endif class="form-control form-control-user" name="post_author">
            @if ($errors->has('post_author'))
            <p class="text-danger">{{ $errors->first('post_author') }}</p>
            @endif
          </div>
          <div class="col-sm-4">
            <h5><label for="exampleFormControlFile1"> Từ khóa: </label></h5>
            <input type="text" @if(isset($news)) value="{{ $news->keyword }}" @endif class="form-control form-control-user" name="keywords">
            @if ($errors->has('keywords'))
            <p class="text-danger">{{ $errors->first('keywords') }}</p>
            @endif
          </div>
      </div>
      <div class="form-group">
        <h5><label for="exampleFormControlFile1"> Tiêu đề: </label></h5>
        <input type="text" @if(isset($news)) value="{{ $news->title }}" @endif class="form-control form-control-user" name="title" id="exampleInputEmail">
        @if ($errors->has('title'))
            <p class="text-danger">{{ $errors->first('title') }}</p>
        @endif
      </div>
      <div class="form-group">
        <h5><label for="exampleFormControlFile1"> Nội dung giới thiệu: </label></h5>
        <input type="text" @if(isset($news)) value="{{ $news->short_content }}" @endif class="form-control form-control-user" name="short_content" id="exampleInputEmail">
        @if ($errors->has('short_content'))
            <p class="text-danger">{{ $errors->first('short_content') }}</p>
        @endif
      </div>
      <div class="form-group">
        <h5><label for="exampleFormControlFile1"> Nội dung: </label></h5>
        @if(isset($news)) 
          <textarea name="editor">{{ $news->content }}</textarea> 
        @else
          <textarea name="editor"></textarea> 
        @endif 
        @if ($errors->has('editor'))
            <p class="text-danger">{{ $errors->first('editor') }}</p>
        @endif
      </div>
      <div class="form-group row">
        <div class="col-sm-8 mb-3 mb-sm-0">
          @if(isset($news))
            <img style="width:75%;" src="{{$news->url_img}}" alt="Images">
            <h5 class="pt-3"><label for="exampleFormControlFile1">Chọn hình ảnh: </label></h5>
            <input type="file" name="img_news" class="form-control-file" id="exampleFormControlFile1">
          @else
            <h5><label for="exampleFormControlFile1">Chọn hình ảnh: </label></h5>
            <input type="file" name="img_news" class="form-control-file" id="exampleFormControlFile1">
          @endif
          @if ($errors->has('img_news'))
            <p class="text-danger">{{ $errors->first('img_news') }}</p>
          @endif
        </div>
        <div class="col-sm-4 mb-3">
          <h5><label for="exampleFormControlFile1">Nguồn thông tin: </label></h5>
          <input type="text" @if(isset($news)) value="{{ $news->post_source }}" @endif name="post_source" class="form-control form-control-user" id="exampleFormControlFile1">
          @if ($errors->has('post_source'))
            <p class="text-danger">{{ $errors->first('post_source') }}</p>
            @endif
        </div>
      </div>
      <div class="submit pb-3">
        <input class="btn btn-primary" type="submit" @if(isset($news)) value="Cập nhật" @else value="Thêm mới" @endif>
      </div>
  </form>
@endsection

@section('js')
  <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
  <script>
    CKEDITOR.replace('editor');
  </script>
  
@endsection