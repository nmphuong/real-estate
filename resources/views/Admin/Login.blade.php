<!DOCTYPE html>
<html>

<head>

  <meta charset="UTF-8">

  <title>Quản lý Nhà Đất Chính Chủ</title>
  <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Big+Shoulders+Stencil+Display:wght@800&display=swap" rel="stylesheet">
    <style>
    @import url(http://fonts.googleapis.com/css?family=Exo:100,200,400);
    @import url(http://fonts.googleapis.com/css?family=Source+Sans+Pro:700,400,300);
        .logo {
            position: relative;
            vertical-align: middle;
            /* border-right: none; */
        }
        .title {
            font-family: 'Big Shoulders Stencil Display', cursive;
        }
        form input[type='submit'] {
            border-radius: 30px;
        }
        body {
            min-height: 100vh;
            background-image: linear-gradient(to right, #c3eac2, #de6434);
        }
        
        #form-login {
                margin: auto;
            }
        @media screen and (min-width: 992px) {
            #logo {
                text-align: right!important;
                /* border-right: 1px solid #000; */
            }
            #form-login {
                margin: 0px;
            }
        }
    </style>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="js/prefixfree.min.js"></script>

</head>

<body class="bg-warning">

    @if (session('error'))
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        swal("Thất Bại", "{{session('error')}}", "error");
    </script>
    @endif
    <div class="row" style="position: absolute; top: 50%; transform: translate(0, -50%);">
		<div id="logo" class="col-lg-6 logo h-100 text-center">
            <img class="w-50" src="{{asset('img/logo.png')}}" alt="">
		</div>
        <br>
        <div class="col-lg-6 h-100 text-center">
        <form action="{{'xu-ly-dang-nhap'}}" method="POST" id="form-login" class="login form-group w-50">
            @csrf
                <div class="title pb-3"><span class="h2">Đăng Nhập</span></div>
                <input class="form-control mb-2" type="text" placeholder=" Tên đăng nhập" name="email">
                <input class="form-control mb-2" type="password" placeholder=" Mật khẩu" name="passwords">
                <input class="form-control mb-2 bg-success text-white border-0" type="submit" value="Đăng Nhập">
            </form>
        </div>
    </div>
    
   
  <script src='http://codepen.io/assets/libs/fullpage/jquery.js'></script>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>