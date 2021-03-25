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
        width:115px; 
        height:115px;
    }
    .img_null
    {
        margin-left: 30%;
    }
</style>
@endsection
@section('content')

@if (session('flash_message'))
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            swal("{{session('flash_message')}}", "Chọn OK để tiếp tục!", "success");
        </script>
{{-- <div class="alert alert-danger">{{session('flash_message')}}</div> --}}
@endif
<h3 class="pl-5"> Thông Tin Tài Khoản <b style="color: rgba(245, 23, 108, 0.815)">{{$users->username}}</b></h3>
<div class="container">
    <div class="row my-2">
        <div class="col-lg-8 order-lg-2">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a href="" data-target="#profile" data-toggle="tab" class="nav-link active">Thông tin cá nhân</a>
                </li>
                <li class="nav-item">
                    <a href="" data-target="#messages" data-toggle="tab" class="nav-link">Bài viết</a>
                </li>
                <li class="nav-item">
                    <a href="" data-target="#edit" data-toggle="tab" class="nav-link">Dự Án</a>
                </li>
                <li class="nav-item">
                    <a href="" data-target="#album" data-toggle="tab" class="nav-link">Hình Ảnh</a>
                </li>
            </ul>
            <div class="tab-content py-4">
                <div class="tab-pane active" id="profile">
                    <h3 class="mb-3"><b>Thông Tin Cá Nhân</b></h3>
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Tài khoản:  {{$users->username}}</h4>
                      
                            <h4>Số điện thoại: {{$users->phone}}</h4>
                            
                            <h4>E-mail: {{$users->email}}</h4>
                            
                            <h4>Ngày sinh: {{$users->birth_date}}</h4> 
                            
                            <h4> Ngày đăng ký: <?php echo(date('d/m/Y',strtotime(str_replace("-","/",$users->created_at)))); ?>
                            </h4>

                            <h4>Nghành nghề: {{$users->job_id->job_name}}</h4> 
                        </div>
                        
                        <div class="col-md-12">
                            <h3 class="mt-2"><span class="fa fa-clock-o ion-clock float-right"></span> <b>Giới Thiệu</b></h3>
                            <table class="table table-sm table-hover table-striped">
                                <tbody>                                    
                                    <tr>
                                        <td>
                                            @if($users->personal_infor == null)
                                            <strong>Người dùng chưa cập nhật thông tin giới thiệu</strong>
                                            @else
                                            {{$users->personal_infor}}
                                            @endif
                                        </td>
                                    </tr>
                              
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--/row-->
                </div>
                {{-- POST --}}
                <div class="tab-pane" id="messages">
                    <table class="table table-hover table-striped">
                        <tbody>  
                            @if(count($post) == 0) 
                                <img class="img_null" src="{{asset('img/project_null.jpg')}}" height="250px" alt="project_null">
                            @else
                            @foreach($post as $index => $data)                                 
                            <tr>
                                <td>
                                   <span class="float-right font-weight-bold"><a href="{{route('detail-post', ['id' => $data->id])}}"><i class="fa fa-link"></i></a> <br>  <a onclick="return confirm('Bạn có chắc chắn muốn xóa?')" href="{{route('delete-post', ['id' => $data->id])}}"><i class="fa fa-minus-circle" style="color:red" ></i></a></span>{{$data->post_content}}
                                   @if($data->post_image[0] == null)
                                        <div class="image_post">
                                            <img class="d-block" style="height: 55px; width:auto;"  src="{{asset('img/image_post_null.png')}}" alt="images_post">
                                        </div>
                                   @else
                                        <div class="image_post">
                                            <img class="d-block" style="height: 55px; width:auto;"  src="{{$data->post_image[0]}}" alt="images_post">
                                        </div>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody> 
                        
                    </table>
                    {{ $post->links() }}
                </div>
                {{-- PROJECT --}}
                <div class="tab-pane" id="edit">
                    @if(count($news) == 0)
                    <img class="img_null" src="{{asset('img/project_null.jpg')}}" height="250px" alt="project_null">
                    @else
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($news as $index => $project)
                                <?php
                                    $class = '';
                                    if ($index == 0) {
                                        $class = 'active';
                                    }
                                ?>
                                    <div class="carousel-item {!! $class !!}">
                                        <img class="d-block w-100" style="height: 70vh;" src="{{$project->news_image[0]}}" alt="First slide">
                                        <div class="carousel-caption d-none d-md-block">
                                        <h3>
                                            <a class="text-white  text-uppercase font-weight-bold" href="{{route('detail-project', ['id' => $project->id])}}" style="text-decoration:none" >{{$project->news_title}} </a>
                                        </h3>
                                        </div>
                                    </div> 
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                            </a>
                        </div>
                    @endif
                </div>
                {{-- ALBUM --}}
                <div class="tab-pane" id="album">
                    <div  class="row">
                        <div class="col-md-12">
                      
                          <div id="mdb-lightbox-ui"></div>
                      
                          <div class="mdb-lightbox row">
                            @foreach($arrayImage as $src)
                            @if($src)
                            <figure class="col-md-4">
                              <a href="#" data-size="1600x1067">
                                <img alt="picture" src="{{$src}}" class="img-fluid">
                              </a>
                            </figure>
                            @endif
                            @endforeach
                          </div>
                      
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 order-lg-1 text-center">
            @if($users->url_avata == null)
            <img src="{{asset('img/avt_null.jpg')}}" alt="avatar" />
            @else
            <img src="{{$users->url_avata}}" style="border-radius: 50%; height:250px; width:250px;" class="mx-auto img-fluid img-circle d-block" alt="avatar">
            @endif
            @if( $users->firstname != null && $users->lastname != null)
                <h4 class="mt-2">{{$users->firstname}} {{$users->lastname}}</h4>
            @else
                <h4 class="mt-2">{{$users->username}}</h4>
            @endif
        </div>
    </div>
</div>
@endsection
@section('js')
    <script>
        $(function () {
            $("#mdb-lightbox-ui").load("mdb-addons/mdb-lightbox-ui.html");
        });
    </script>
@endsection