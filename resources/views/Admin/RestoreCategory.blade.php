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
        <p> Thể Loại Tin Tức Đã Xóa </p>
    </div>
    <div class="create">
        <a type="button" href="{{ route('category') }}" class="btn-sm btn-warning"> <i class="fa fa-reply" aria-hidden="true"></i> Trang Chủ </a>
    </div>
    <table class="table table-striped text-center">
        <thead>
            <tr>
            <th scope="col">STT</th>
            <th scope="col">Tên Thể Loại</th>
            <th scope="col">Khôi phục</th>
            </tr>
        </thead>
        <tbody>

            @foreach($Categorydelete as $key => $data)
                <tr>
                    <th scope="row">{{ $key+1 }}</th>
                    <td>{{ $data->category_name }}</td>
                    <td>
                        <a href="{{ route('restore', ['id' => $data->id]) }}"><button onclick="return confirm('Bạn có chắc chắn muốn khôi phục thể loại này?')" type="button" class="btn btn-outline-danger " style=" width: 50px;"> <i class="fa fa-reply" aria-hidden="true"></i></button></a>
                    </td>
                    
                </tr>
            @endforeach
            
        </tbody>
    </table>
</div>
    

@endsection