@extends('MasterPage')
@section('content')

<div class="container-fluid">
    <!-- Content Row -->
    <h5>Thống Kê Tổng Quan</h5>
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                SỐ LƯỢNG TÀI KHOẢN</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$quantity_user}}</div>
                        </div>
                        <div class="col-auto">
                        <a href="{{ route('list-customer') }}"><i class="fa fa-user fa-2x"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                SỐ LƯỢNG DỰ ÁN </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$quantity_pro}}</div>
                        </div>
                        <div class="col-auto">
                            <a href="{{ route('list-project') }}"><i class="fas fa-dollar-sign fa-2x "></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">SỐ LƯỢNG TIN TỨC
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold ">{{$quantity_news}}</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar"
                                            style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <a href="{{ route('get-all-news') }}"><i class="fas fa-clipboard-list fa-2x"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                SỐ LƯỢNG BÀI ĐĂNG</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$quantity_post}}</div>
                        </div>
                        <div class="col-auto">
                            <img src="https://image.flaticon.com/icons/png/512/1999/1999310.png" alt="" height="35">
                            {{-- <i class="fas fa-comments fa-2x text-gray-300"></i> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Biểu đồ thống kê --}}

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <figure class="highcharts-figure">
    <div id="container"></div>
    <p class="highcharts-description text-center pt-2">
        Biểu đồ thống kê hoạt động sử dụng App
    </p>
    </figure>

    <script>
        
        var datas = <?php echo json_encode($data); ?> ;
        var datanews = <?php echo json_encode($datanews); ?>;
        var datapost = <?php echo json_encode($datapost); ?>;

        Highcharts.chart('container', {

        title: {
        text: 'Thống kê hoạt động theo tháng'
        },

        subtitle: {
        text: 'Nguồn: nhadatchinhchu.billionaire-land.net'
        },

        yAxis: {
            title: {
                text: 'Số tài khoản mới'
            }
        },

        xAxis: {
            categories:['','Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },

        legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle'
        },

        plotOptions: {
        series: {
            allowPointSelect:true,
        }
        },

        series: [
            {
                name: 'Tài Khoản',
                data: datas
            },
            {
                name: 'Sản Phẩm',
                data: datanews
            },
            {
                name: 'Tin Tức',
                data: datapost
            }
        ],

        responsive: {
        rules: [{
            condition: {
            maxWidth: 500
            },
            chartOptions: {
            legend: {
                layout: 'horizontal',
                align: 'center',
                verticalAlign: 'bottom'
            }
            }
        }]
        }

        });
    </script>

    <!-- Dự Án Được Yêu Thích Nhất -->

    <h5>Dự Án Được Yêu Thích Nhất</h5>


    <div class="row">
    @for($i = 0; $i < count($project); $i++)
        @if($project[$i]->id_news)
        <div class="__card col-lg-3 p-3">
            <div class="div" style="border: 1px solid #e4e4e4; border-radius: 10px; overflow: hidden; height: 50vh;">
                <div class="card-img h-50">
                    <a href="{{route('detail-project', ['id' => $project[$i]->id_news->id])}}">
                        <img class="img w-100 h-100" src="{{ $project[$i]->id_news->news_image[0] }}" alt="alt.cc">
                    </a>
                </div>
                <div class="card-des p-3">
                    <div class="title">
                        <h5 class="title">{{ $project[$i]->id_news->news_title }}</h5>
                    </div>
                   
                    <div class="row button">
                        <div class="pl-2 pr-5" style="font-size: 24px;"> {{ $project[$i]->total }} <i class="fa fa-thumbs-up" aria-hidden="true"></i> 
                        </div>

                        <a href="{{route('detail-project', ['id' => $project[$i]->id_news->id])}}" class="btn btn-primary"> Xem chi tiết <i class="fa fa-mouse-pointer pl-2" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        </div>
            
        @endif
    @endfor
    </div>

</div>

@endsection