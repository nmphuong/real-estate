@extends('MasterPage')
@section('css')
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


    @if(count($news) == 0)
        <div class="img_null" >
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
            <div class="content">
                <div class="module">
                    <div class="module-head margin-auto">
                        <h3 style="color: rgb(194, 13, 13); text-align: center">Danh sách và thông tin dự án</h3>
                    </div>

                    {{-- Table --}}
                    <div class="container-fluid">
                        
                        <div class="row">
                            
                        <div class="col-12">

                            <div class="card">
                            
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div >
                                    <h6 style="color: #ff452c">Tình trạng Xác nhận Sản phẩm</h6>
                                    <ul> 
                                        <li> 
                                            <div class="row">
                                                <div class="col-1">
                                                    <i style="color: rgb(96, 219, 39)" class="fa fa-check" aria-hidden="true"></i>
                                                </div>
                                                <div class="col-3">
                                                    <h6>Sản phẩm đang chờ kiểm duyệt</h6>
                                                </div>
                                            </div>
                                        </li>
                                        <li> 
                                            <div class="row">
                                                <div class="col-1">
                                                    <i class="fa fa-ban" style="color: rgb(224, 15, 15)"aria-hidden="true"></i>
                                                </div>
                                                <div class="col-4">
                                                    <h6>Hủy bỏ sản phẩm đã được duyệt</h6>
                                                </div>
                                            </div>
                                        </li>
                                        <li> 
                                            <div class="row">
                                                <div class="col-1">
                                                    <i class="fa fa-minus-circle" style="color: rgb(224, 15, 15)" aria-hidden="true"></i>
                                                </div>
                                                <div class="col-3">
                                                    <h6>Xác nhận lại dự án</h6>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tiêu đề</th>
                                    <th>Hình Ảnh</th>
                                    <th>Thể Loại</th>
                                    <th>Ngày Đăng </th>
                                    <th>Đơn Giá</th>
                                    {{-- <th>Diện tích</th>
                                    <th>Tác Giả</th> --}}
                                    <th></th>
                                    <th>Xác Nhận</th>
                                    <th>Hủy</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($news as $key => $item)
                                        <tr>
                                            <td style="vertical-align: middle; border: none;">{{$key+1}}</td>
                                            <td style="vertical-align: middle; border: none;">
                                                <p style="width: 100px;
                                                overflow: hidden;
                                                white-space: nowrap; 
                                                text-overflow: ellipsis;">{{$item->news_title}}</p>
                                            </td>
                                            @for($i = 0; $i < 1; $i++)
                                            <td style=" border: none;"><img style="width:120px; height:100px; border-radius:12px;"  src="{{$item->news_image[0]}}" /></td>
                                            @endfor
                                            <td style="vertical-align: middle; border: none;">{{$item->news_type}}</td>
                                            <td style="vertical-align: middle; border: none;">
                                                    <?php echo(date('d/m/Y',strtotime(str_replace("-","/",$item->created_at)))); ?> 
                                            </td>
                                            @if($item->news_status == 'draft')
                                                
                                                <td style="vertical-align: middle; border: none;">{{ number_format($item->news_price_from, 0, '', ',') }} VND</td>
                                                {{-- <td style="vertical-align: middle; border: none;">{{$item->news_land_area}}</td>

                                                @foreach($item->news_author as $name)
                                                    <td style="vertical-align: middle; border: none;">{{$name['username']}}</td>
                                                @endforeach --}}

                                                <td style="vertical-align: middle; border: none;">
                                                    <button type="button" style="background-color: #28a745; background-image: linear-gradient(180deg,#2ebd4e 10%,#1acc43 100%)" class="btn btn-success"><a href="{{route('detail-project', ['id' => $item->id])}}"><i style="color: #fff" class="fa fa-eye" aria-hidden="true"></i></a>
                                                    </button>
                                                </td>
                                                <td style="text-align: center;vertical-align: middle; border: none;">
                                                    <button style="background-color: #28a745; background-image: linear-gradient(180deg,#2ebd4e 10%,#1acc43 100%)" type="button" class="btn btn-success"><a href="{{route('confirm-project', ['id' => $item->id])}}"><i style="color: #fff" class="fa fa-check" aria-hidden="true"></i></a>
                                                    </button>
                                                </td>
                                            @elseif($item->news_status == 'published')
                                                <td style="vertical-align: middle; border: none;">{{ number_format($item->news_price_from, 0, '', ',') }} VND</td>
                                                {{-- <td style="vertical-align: middle; border: none;">{{$item->news_land_area}}</td>

                                                @foreach($item->news_author as $name)
                                                    <td style="vertical-align: middle; border: none;">{{$name['username']}}</td>
                                                @endforeach --}}
                                                <td style="vertical-align: middle; border: none;">
                                                    <button style="background-color: #28a745; background-image: linear-gradient(180deg,#2ebd4e 10%,#1acc43 100%)" type="button" class="btn btn-success"><a href="{{route('detail-project', ['id' => $item->id])}}"><i class="fa fa-eye" style="color: #fff" aria-hidden="true"></i></a>
                                                    </button>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle; border: none;">
                                                    <button type="button" class="btn btn-danger"><a href="{{route('ban-project', ['id' => $item->id])}}"><i class="fa fa-ban" style="color: #fff"  aria-hidden="true"></i></a>
                                                    </button>
                                                </td>

                                            @elseif($item->news_status == 'alone')
                                                <td style="vertical-align: middle; border: none;">{{ number_format($item->news_price_from, 0, '', ',') }} VND</td>
                                                {{-- <td style="vertical-align: middle; border: none;">{{$item->news_land_area}}</td>

                                                @foreach($item->news_author as $name)
                                                    <td style="vertical-align: middle; border: none;">{{$name['username']}}</td>
                                                @endforeach --}}
                                                <td style="vertical-align: middle; border: none;" >
                                                    <button style="background-color: #28a745; background-image: linear-gradient(180deg,#2ebd4e 10%,#1acc43 100%)" type="button" class="btn btn-success"><a href="{{route('detail-project', ['id' => $item->id])}}"><i class="fa fa-eye" style="color: #fff" aria-hidden="true"></i></a>
                                                    </button>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle; border: none;">
                                                    <button type="button" class="btn btn-danger"><a href="{{route('confirm-project', ['id' => $item->id])}}"><i class="fa fa-minus-circle" style="color: #fff" aria-hidden="true"></i></a>
                                                    </button>
                                                </td>
                                                
                                            @endif
                                            
                                            <td style="vertical-align: middle; border: none;">
                                                <button type="button" class="btn btn-danger"><a onclick="return confirm('Bạn có chắc chắn muốn xóa?')" href="{{ route('delete-pro', ['id' => $item->id]) }}"><i class="fa fa-trash" style="color: #fff" ></i></a>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach    
                                </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>

                    {{-- Table --}}
                </div>
            </div>
    @endif
    
@endsection

{{-- @section('js')
    <script src="{{asset('plugins/scripts/jquery-1.9.1.min.js')}}"></script>
    <script src="{{asset('plugins/scripts/jquery-ui-1.10.1.custom.min.js')}}"></script>
    <script src="{{asset('plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('plugins/scripts/datatables/jquery.dataTables.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('.datatable-1').dataTable();
            $('.dataTables_paginate').addClass("btn-group pager datatable-pagination");
            $('.dataTables_paginate > a').wrapInner('<span />');
            $('.dataTables_paginate > a:first-child').append('<i class="icon-circle-arrow-left icon-3x "></i>');
            $('.dataTables_paginate > a:last-child').append('<i class="icon-circle-arrow-right "></i>');
        } );
    </script>
@endsection --}}
