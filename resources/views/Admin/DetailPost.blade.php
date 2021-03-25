@extends('MasterPage')
@section('css')
    <style>
        #image_post{
            width: 120px;
            height: 120px;
        }
        #img_avt {
            border-radius: 50%;
            height: 80px;
            width: 80px;
        }
        .info{
            padding-left: 150px;
            display: block;
        }
        .username{
            font-size: 28px;
            font-weight: 600;
            margin-top: -70px;
           
            display: block;
        }
        .description{
            display: block;
        }
        .user-block{
            display: block;
        }
        .content_post{
            margin-top:10px;
            font-size: 20px;
            padding-left: 150px;
        }
        .like-comment
        {
            float: right;
        }
        
    </style>
@endsection

@section('content')
    {{-- @if(count($posts->post_image) < 5)
        <div class="media">
                @foreach($posts->post_image as $src)
                    @if($src != null)
                        <img class="pl-3 align-self-start mr-3"  id="image_post" src="{{$src}}" 
                        alt="alt_image">
                    @endif
                @endforeach
            <div class="media-body">
                <div class="user-block">
                @if($posts->post_author->url_avata == null)
                    <img class="img-circle img-bordered-sm" id="img_avt" src="{{asset('img/avt_null.jpg')}}" alt="user image">
                @else 
                    <img class="img-circle img-bordered-sm" id="img_avt" src="{{$posts->post_author->url_avata}}" alt="user image">
                @endif
                    <div class="info">
                            <span class="username">
                            <a href="#">{{$posts->post_author->username}}</a>
                            <span class="description">{{$posts->created_at}}</span>
                    </div>
                </div>
                <div class="content_post">
                    Nội dung :
                    <p>{{$posts->post_content}}</p>
                    <i class="fa fa-thumbs-up" ></i> {{$likes}}
                </div>
                
            </div>
        </div>
    @else  --}}
    
        <div class="media" style="margin:50px;display: block; ">
            <div class="media-body" style="display: block">
                
                <div class="user-block">
                @if($posts->post_author->url_avata == null)
                    <img class="img-circle img-bordered-sm" id="img_avt" src="{{asset('img/avt_null.jpg')}}" alt="user image">
                @else 
                    <img class="img-circle img-bordered-sm" id="img_avt" src="{{$posts->post_author->url_avata}}" alt="user image">
                @endif
                    <div class="info">
                        <span class="username">
                        <a href="#">{{$posts->post_author->username}}</a>
                        <span class="description">{{$posts->created_at}}</span>
                    </div>
                </div>
                <div class="content_post">
                    <p>{{$posts->post_content}}</p>
                    <i class="fa fa-thumbs-up" ></i> {{$likes}}
                </div>
            </div>
            <h6>Hình Ảnh</h6>   
                @foreach($posts->post_image as $src)
                    @if($src != null)
                        <img class="pl-3 align-self-start mr-3"  id="image_post" src="{{$src}}" 
                        alt="alt_image">
                    @endif
                @endforeach
        </div>
    {{-- @endif    --}}
@endsection

@section('js')
@endsection