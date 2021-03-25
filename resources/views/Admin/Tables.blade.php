@extends('MasterPage')
@section('css')
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Castoro:ital@1&display=swap" rel="stylesheet">
    <style>
        .img_null {
            text-align: center;
            padding-top:10%;
        }
        .img_null img{
            border-radius: 50%;
        }
        h5 {
            font-family: 'Castoro', serif;
        }
    </style>
@endsection
@section('content')

<div class="container-fluid">
    @if(count($news) == 0)
        <div class="img_null">
            <img src="{{asset('img/null_project.png')}}" alt="IMG">
            <h5 class="pt-5">Loại dự án này đang được cập nhật</h5>
        </div>
    @else
        @if (session('flash_message'))
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            swal("{{session('flash_message')}}", "Chọn OK để tiếp tục!", "success");
        </script>
        @endif
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Danh sách <b style="color:red">Dự án</b></h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Thông Tin Chi Tiết</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-responsive" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="white-space: nowrap;">STT <a type="button" style="text-decoration: none" href="{{ route('sort') }}"><i class="fa fa-sort" aria-hidden="true"></i></a>
                                </th>
                                <th style="white-space: nowrap;">Tiêu đề</th>
                                <th style="white-space: nowrap;">Hình Ảnh</th>
                                <th style="white-space: nowrap;">Thể Loại</th>
                                <th style="white-space: nowrap;">Ngày Đăng </th>
                                <th style="white-space: nowrap;">Đơn Giá</th>
                                <th style="white-space: nowrap;">Diện tích</th>
                                <th style="white-space: nowrap;">Tác Giả</th>
                                <!-- {{-- <th>Địa Chỉ</th> --}} -->
                                <th style="white-space: nowrap;"></th>
                                <th style="white-space: nowrap;">Xác Nhận</th>
                                <th style="white-space: nowrap;">Hủy</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                        @foreach($news as $key => $item)
                            <tr>
                                <th style="vertical-align: middle;">{{$key+1}}</th>
                                <th style="vertical-align: middle; width: 100px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box;-webkit-line-clamp: 3; -webkit-box-orient: vertical;">{{$item->news_title}}
                                </th>
                                @for($i = 0; $i < 1; $i++)
                                <th style="vertical-align: middle;"><img width="100px" height="90px" src="{{$item->news_image[0]}}" /></th>
                                @endfor
                                <th style="vertical-align: middle;">{{$item->news_type}}</th>
                                <th style="vertical-align: middle;">
                                        <?php echo(date('d/m/Y',strtotime(str_replace("-","/",$item->created_at)))); ?> 
                                </th>
                                @if($item->news_status == 'draft')
                                    
                                    <th style="vertical-align: middle;">{{ number_format($item->news_price_from, 0, '', ',') }} VND</th>
                                    <th style="vertical-align: middle;">{{$item->news_land_area}}</th>

                                    @foreach($item->news_author as $name)
                                        <th style="vertical-align: middle;">{{$name['username']}}</th>
                                    @endforeach

                                    <th style="vertical-align: middle;">
                                        <button type="button" style="background-color: #28a745; background-image: linear-gradient(180deg,#2ebd4e 10%,#1acc43 100%)" class="btn btn-success"><a href="{{route('detail-project', ['id' => $item->id])}}"><i style="color: #fff" class="fa fa-eye" aria-hidden="true"></i></a>
                                        </button>
                                    </th>
                                    <th style="text-align: center;vertical-align: middle;">
                                        <button style="background-color: #28a745; background-image: linear-gradient(180deg,#2ebd4e 10%,#1acc43 100%)" type="button" class="btn btn-success"><a href="{{route('confirm-project', ['id' => $item->id])}}"><i style="color: #fff" class="fa fa-check" aria-hidden="true"></i></a>
                                        </button>
                                    </th>
                                @elseif($item->news_status == 'published')
                                    <th style="vertical-align: middle;">{{ number_format($item->news_price_from, 0, '', ',') }} VND</th>
                                    <th style="vertical-align: middle;">{{$item->news_land_area}}</th>

                                    @foreach($item->news_author as $name)
                                        <th style="vertical-align: middle;">{{$name['username']}}</th>
                                    @endforeach
                                    <th style="vertical-align: middle;">
                                        <button style="background-color: #28a745; background-image: linear-gradient(180deg,#2ebd4e 10%,#1acc43 100%)" type="button" class="btn btn-success"><a href="{{route('detail-project', ['id' => $item->id])}}"><i class="fa fa-eye" style="color: #fff" aria-hidden="true"></i></a>
                                        </button>
                                    </th>
                                    <th style="text-align: center; vertical-align: middle;">
                                        <button type="button" class="btn btn-danger"><a href="{{route('ban-project', ['id' => $item->id])}}"><i class="fa fa-ban" style="color: #fff"  aria-hidden="true"></i></a>
                                        </button>
                                    </th>

                                @elseif($item->news_status == 'alone')
                                    <th style="vertical-align: middle;">{{ number_format($item->news_price_from, 0, '', ',') }} VND</th>
                                    <th style="vertical-align: middle;">{{$item->news_land_area}}</th>

                                    @foreach($item->news_author as $name)
                                        <th style="vertical-align: middle;">{{$name['username']}}</th>
                                    @endforeach
                                    <th style="vertical-align: middle;">
                                        <button style="background-color: #28a745; background-image: linear-gradient(180deg,#2ebd4e 10%,#1acc43 100%)" type="button" class="btn btn-success"><a href="{{route('detail-project', ['id' => $item->id])}}"><i class="fa fa-eye" style="color: #fff" aria-hidden="true"></i></a>
                                        </button>
                                    </th>
                                    <th style="text-align: center; vertical-align: middle;">
                                        <button type="button" class="btn btn-danger"><a href="{{route('confirm-project', ['id' => $item->id])}}"><i class="fa fa-unlock" style="color: #fff" aria-hidden="true"></i></a>
                                        </button>
                                    </th>
                                    
                                @endif
                                
                                <th style="vertical-align: middle;">
                                    <button type="button" class="btn btn-danger"><a onclick="return confirm('Bạn có chắc chắn muốn xóa?')" href="{{ route('delete-pro', ['id' => $item->id]) }}"><i class="fa fa-trash" style="color: #fff" ></i></a>
                                    </button>
                                </th>
                            </tr>
                        @endforeach    
                            
                        </tbody>
                        
                    </table>
                    {{$news->links()}}
                </div>
            </div>
        </div>
    @endif   
</div>

@endsection