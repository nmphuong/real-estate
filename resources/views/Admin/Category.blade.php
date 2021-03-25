@extends('MasterPage')
@section('css')
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital@1&display=swap" rel="stylesheet">
    <style>
        .title {
            font-size: 20px;
            font-family: 'Roboto', sans-serif;
        }
        span{
            font-family: 'Roboto', sans-serif;
        }
        .create{
            margin: 20px;
        }
    </style>
@endsection
@section('content')
@if (session('flash_message'))
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    swal("{{session('flash_message')}}", "Chọn OK để tiếp tục!", "success");
</script>
@endif

<div class="mr-5 ml-5">
    <div class="title text-center">
        <p>Danh Sách Thể Loại Tin Tức </p>
    </div>
    <div class="create">

        <div class="row">
            <div class="col-2">
                <a type="button" style="text-decoration: none" href="{{ route('add-news') }}" data-toggle="modal" data-target="#exampleModal" class="btn-sm btn-success"> <i class="fa fa-plus"></i> <span> Thêm mới</span> </a>

                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bold" style="color: red" id="exampleModalLabel">Thêm mới thể loại</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <form action="{{ route('add-category')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên Thể Loại</label>
                                <input type="text" name="category"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nhập tên thể loại">
                                <small id="emailHelp" class="form-text text-muted">Thể loại mới của tin tức. Lưu ý khi thêm mới thể loại.</small>
                            </div>
                            <button type="submit" class="btn float-right btn-primary">Thêm mới</button>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
            </div>

            <div class="col-2">
                 {{-- RESTORE --}}
                <a type="button" style="text-decoration: none" href="{{ route('restore-category') }}" class="btn-sm btn-warning"> <i class="fa fa-reply" aria-hidden="true"></i> Khôi Phục </a>
            </div>

        </div>

    </div>
    <table class="table table-striped text-center">
        <thead>
            <tr>
            <th scope="col">STT</th>
            <th scope="col">Tên Thể Loại</th>
            <th scope="col">Chỉnh sửa</th>
            <th scope="col">Xóa</th>
            <th scope="col">Chi Tiết</th>
            </tr>
        </thead>
        <tbody>

            @foreach($allCategories as $key => $data)
                <tr>
                    <th scope="row">{{ $key+1 }}</th>
                    <td>{{ $data->category_name }}</td>
                    <td> 
                        <a type="button" style="text-decoration: none" href="#" data-toggle="modal" class="btn btn-outline-info" style=" width: 50px;" data-target="#exampleModal-{{ $key }}" class="btn-sm btn-success"> <i class="fa fa-paint-brush"></i> </a>

                    <div class="modal fade" id="exampleModal-{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title font-weight-bold" style="color: red" id="exampleModalLabel">Cập nhật thể loại</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('update-category', ['id' => $data->id]) }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tên Thể Loại</label>
                                        <input type="text" name="category"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $data->category_name }}">
                                    </div>
                                    <button type="submit" class="btn float-right btn-primary">Cập nhật</button>
                                    </form>
                                </div>
                                
                                </div>
                            </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <a href="{{ route('delete-category', ['id' => $data->id]) }}"><button onclick="return confirm('Bạn có chắc chắn muốn xóa?')" type="button" class="btn btn-outline-danger " style=" width: 50px;"> <i class="fa fa-trash"> </i></button></a>
                    </td>

                    <td>
                        <a href="{{ route('detail-category', ['id' => $data->id]) }}"><button type="button" class="btn btn-outline-success " style=" width: 50px;"> <i class="fa fa-list" aria-hidden="true"></i></button></a>
                    </td>
                    
                </tr>
            @endforeach
            
        </tbody>
    </table>
</div>
    

@endsection