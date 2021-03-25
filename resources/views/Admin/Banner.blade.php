@extends('MasterPage')
@section('css')
    <style>
        .header-content a{
            margin-left: 5%;
            border-radius: 8px;
            height: 35px;
            text-decoration: none;
            text-align: center;
            margin-bottom: 2%;
        }
    </style>
@endsection
@section('content')
    @if (session('flash_message'))
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            swal("{{session('flash_message')}}", "Chọn OK để tiếp tục!", "success");
        </script>
    {{-- <div class="alert alert-success">{{session('flash_message')}}</div> --}}
    @endif

    @if (session('flash_del_message'))
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            swal("{{session('flash_del_message')}}", "Chọn OK để tiếp tục!", "success");
        </script>
    {{-- <div class="alert alert-danger">{{session('flash_del_message')}}</div> --}}
    @endif

    <div class="w-75 m-auto">
        <div class="d-flex">
            <div class="pr-2">
                <h3>Present Banner</h3>
            </div>
            <div class="header-content text-nowrap">
                <a href="{{ route('add-banner') }}" class="btn btn-success">
                    <i class="fa fa-plus"></i>
                    <span>
                        Thêm mới
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="m-auto w-75">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                @foreach($banner as $index => $project)
                <?php
                    $class = '';
                    if ($index == 0) {
                        $class = 'active';
                    }
                ?>
                <li data-target="#carouselExampleIndicators" data-slide-to="{{ $index }}" {!! $class !!}></li>
                @endforeach
            </ol>
            <div class="carousel-inner">
                @foreach($banner as $index => $project)
                <?php
                    $class = '';
                    if ($index == 0) {
                        $class = 'active';
                    }
                ?>
                <div class="carousel-item {!! $class !!}" style="height: 50vh">
                    <img class="d-block w-100 h-100" src="{{ $project->img_banner }}" alt="First slide">
                </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <div class="w-75 m-auto pt-5">
        <h3>Danh sách hình ảnh</h3>
        <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">STT</th>
                <th scope="col">Tên Banner</th>
                <th scope="col">Hình Ảnh</th>
                <th scope="col">Ẩn</th>
                <th scope="col">Xóa</th>
              </tr>
            </thead>
            <tbody>
                @foreach($allbanner as $index => $data)
                    <tr>
                    <th scope="row" style="padding-top: 15%;">{{  $index + 1}} </th>
                        <td style="padding-top: 15%;">{{ $data->name }}</td>
                        <td> 
                            <img height="250px" width="350px" src="{{$data->img_banner}}" alt="img">  </td>
                        <td style="padding-top: 15%;"> 
                            @if($data->active == 1)
                                <button type="button" class="btn btn-outline-success"><a href="{{route('hide-banner', ['id' => $data->id])}}"><i class="fa fa-check-circle" style="color: rgb(211, 20, 20)"  aria-hidden="true"></i></a></button> 
                            @else 
                                <button type="button" class="btn btn-outline-success"><a href="{{route('hide-banner', ['id' => $data->id])}}"><i class="fa fa-times" aria-hidden="true"></i></a></button> 
                            @endif
                        </td>
                        <td style="padding-top: 15%;">
                            <button type="button" class="btn btn-danger"><a onclick="return confirm('Bạn có chắc chắn muốn xóa?')" href="{{ route('delete-banner', ['id' => $data->id]) }}"><i class="fa fa-trash" style="color: #fff" ></i></a>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
          </table>
          <div class="float-right">{{$allbanner->links()}}</div>
    </div>
@endsection