@extends('Admin.Chat.layouts.app')

@section('css')
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@500&display=swap" rel="stylesheet">
    <style>
        h2 {
            font-family: 'Sansita Swashed', cursive;
            text-align: center;
        }
        .button {
            margin: 5%;
            float: right;
        }
    </style>
@endsection
@section('content')
<h2>Dịch vụ và hỗ trợ khách hàng</h2>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="user-wrapper">
                <ul class="users">

                    @foreach($users as $user)
                        <li class="user" id="{{ $user->id }}">
                            @if($user->unread)
                                <span class="pending">{{ $user->unread }}</span>
                            @endif
                            <div class="media">
                                <div class="media-left">
                                    <img src="{{ $user->url_avata }}"  alt="" class="media-object"/>
                                </div>
                                <div class="media-body">
                                    <p class="name">{{ $user->username }}</p>
                                    <p class="email">{{ $user->email }}</p>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-md-8" id="messages">
           
        </div>
    </div>
</div>

<div class="button">
<a type="button" href="{{ route('statistical-admin') }}" class="btn btn-secondary"><img src="https://icon-library.com/images/back-icon-png/back-icon-png-17.jpg" width="20" alt="back"> Quay Về Trang Chủ</a>
</div>
@endsection
