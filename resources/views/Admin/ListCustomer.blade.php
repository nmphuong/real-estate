@extends('MasterPage')
@section('css')
<style>
    #img{
        height: auto;
        padding-top:10px;
        padding-bottom: 3%;
        padding-left:3%;
    }
    #logo
    {
        border-radius: 50%;
        width:125px; 
        height:125px;
    }
</style>
@endsection
@section('content')
<div class="container-fluid">
    @if (session('flash_message'))
        <div class="alert alert-success">{{session('flash_message')}}</div>
    @endif
        <!-- DataTales Example -->
        <div class="content">
            <div class="module">
                <div class="module-head">
                    <h3 style="color: rgb(194, 13, 13); text-align:center" >Danh sách và thông tin khách hàng</h3>
                </div>

                {{-- Table --}}
                <div class="container-fluid">
                        
                    <div class="row">
                        
                    <div class="col-12">

                        <div class="card">
                        
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Avatar</th>
                                {{-- <th>Tên Đăng Nhập</th> --}}
                                <th>Điện Thoại</th>
                                <th>Email</th>
                                <th>Ngày Đăng Ký</th>
                                <th>Thông Tin Chi Tiết</th>
                                <th>Xóa</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $key => $data)
                                <tr>
                                    <td style="vertical-align: middle;">{{$key+1}}</td>
                                        @if($data->url_avata == null )
                                            <td> 
                                                <img alt="avatar" id="logo" src="{{asset('img/avt_null.jpg')}}" />
                                            </td>
                                        @else
                                            <td>
                                                <img alt="avatar" id="logo" src="{{$data->url_avata}}">
                                            </td>
                                        @endif
                                        {{-- <td style="vertical-align: middle;">{{$data->username}}</td> --}}
                                        <td style="vertical-align: middle;">{{$data->phone}}</td>
                                        <td style="vertical-align: middle;">{{$data->email}}</td>
                                        <td style="vertical-align: middle;">
                                            <?php echo(date('d/m/Y',strtotime(str_replace("-","/",$data->created_at)))); ?>
                                        </td> 
                                        <td style="text-align: center; vertical-align: middle;">
                                            <button  style="background-color: #28a745; background-image: linear-gradient(180deg,#2ebd4e 10%,#1acc43 100%)" type="button" class="btn btn-success"><a href="{{route('detail-account', ['id' => $data->id])}}"><i class="fa fa-eye" style="color: #fff" aria-hidden="true"></i></a>
                                            </button>
                                        </td>
                                        <td style="vertical-align: middle;">
                                            <button type="button" class="btn btn-danger"><a onclick="return confirm('Bạn có chắc chắn muốn xóa?')" href="{{ route('delete-user', ['id' => $data->id]) }}"><i class="fa fa-trash" style="color: #fff" ></i></a>
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
</div>
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