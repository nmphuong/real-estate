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

                <a type="button" style="text-decoration: none" href="{{ route('add-news') }}" data-toggle="modal" data-target="#exampleModal" class="btn-sm btn-success"> <i class="fa fa-plus"></i> <span> Thêm mới</span> </a>

                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bold" style="color: red" id="exampleModalLabel">Thêm mới nghành nghề</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <form action="{{ route('add-job')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên Nghành Nghề</label>
                                <input type="text" name="job_name"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nhập tên nghành nghề mong muốn">
                                {{-- <small id="emailHelp" class="form-text text-muted">Thể loại mới của tin tức. Lưu ý khi thêm mới thể loại.</small> --}}
                            </div>
                            <button type="submit" class="btn float-right btn-primary">Thêm mới</button>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>


                <div class="module-head">
                    <h3 style="color: rgb(194, 13, 13); text-align:center" >Danh sách và thông tin các nghành nghề hiện có</h3>
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
                                <th>Nghành nghề</th>
                                <th>Trạng Thái</th>
                                <th></th>
                                <th>Xóa</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($job as $key => $data)
                                <tr>
                                    <td style="vertical-align: middle;">{{$key+1}}</td>
                                        <td> 
                                            <h5>{{ $data->job_name }}</h5>
                                        </td>
                                        <td style="vertical-align: middle;">
                                            {{-- {{$data->status}} --}}
                                            @if($data->status == 1)
                                                <p style="color: rgb(25, 230, 25)">Đang hoạt động</p>
                                            @else 
                                                <p style="color: rgb(235, 17, 10)">Tạm ngưng hoạt động</p>
                                            @endif
                                        </td>
                                    
                                        <td style="text-align: center">
                                            @if($data->status == 0)
                                                <button type="button" class="btn btn-outline-success"><a href="{{route('change-status-job', ['id' => $data->id])}}"><i class="fa fa-check-circle" style="color: rgb(211, 20, 20)"  aria-hidden="true"> Kích hoạt </i></a></button> 
                                            @else 
                                                <button type="button" class="btn btn-outline-success"><a href="{{route('change-status-job', ['id' => $data->id])}}"><i class="fa fa-times" aria-hidden="true"> Tạm ẩn</i></a></button> 
                                            @endif
                                        </td>

                                        <td style="vertical-align: middle;">
                                            <button type="button" class="btn btn-danger"><a onclick="return confirm('Bạn có chắc chắn muốn xóa?')" href="{{ route('delete-job', ['id' => $data->id]) }}"><i class="fa fa-trash" style="color: #fff" ></i></a>
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