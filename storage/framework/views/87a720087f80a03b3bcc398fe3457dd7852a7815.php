<?php $__env->startSection('css'); ?>
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Castoro&display=swap" rel="stylesheet">
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
        height: 320px;
        width: 320px;
        padding: 15px; 
    }
    h5, th {
        font-family: 'Castoro', serif;
    }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <?php if(session('flash_message')): ?>
    <div class="alert alert-success"><?php echo e(session('flash_message')); ?></div>
    <?php endif; ?>
                    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><b style="color:red">Dự án</b> <?php echo e($news->news_title); ?></h1>
                    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thông Tin Chi Tiết</h6>
        </div>
                        
        <!--Section: Block Content-->
        <section class="mb-5 pt-4">

            <div class="row">

                <div class="col-md-5 mb-4 mb-md-0">

                  <div id="mdb-lightbox-ui"></div>

                  <div class="mdb-lightbox">

                    <div class="row product-gallery mx-1">

                      <div class="col-12 mb-0">
                        <figure class="view overlay rounded pl-4 z-depth-1 main-img">
                            <h3 style="text-align: center;">Logo Dự Án</h3>
                          <a href="<?php echo e($news->news_logo); ?>"
                            data-size="710x823">
                             <img id="logo" class="img-fluid ml-4 z-depth-1" src="<?php echo e($news->news_logo); ?>">
                              
                          </a>
                        </figure>
                      </div>
                      
                    </div>

                  </div>
                </div>
                    <div class="col-md-7">
                        <div class="row">
                            <div class="col-6">
                                <h5>Tên dự án</h5>
                                <p class="mb-2 text-muted text-uppercase small"><?php echo e($news->news_title); ?></p>
                            </div>
                            <div class="col-6">
                                <h5>Thể loại</h5>
                                <p class="mb-2 text-muted text-uppercase small"><?php echo e($news->news_type); ?></p>
                            </div>
                        </div>
                    <div class="row">
                        <div class="col-3"> <h5>Diện tích: </h5></div>
                        <div class="col-3"> <strong><?php echo e($news->news_land_area); ?> <span>&#13217;</span>

                        </strong></div>
                    </div>
                    <h5>Mô tả: </h5>
                    <p class="pt-1" id="main"><?php echo e($news->news_description); ?></p>
                    <div class="table-responsive pt-3">
                        <table class="table table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <?php $__currentLoopData = $news->news_author; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <th class="pl-0 w-25" scope="row">Tác giả</th> 
                                    <td><?php echo e($data->username); ?></td>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tr>
                                <tr >
                                    <th class="pl-0 w-25" scope="row">Trạng thái</th>
                                    <td ><?php echo e($news->news_status); ?></td>
                                </tr>
                                <tr >
                                    <th class="pl-0 w-25" scope="row">Đơn giá </th>
                                    <td><?php echo e(number_format($news->news_price_from, 0, '', ',')); ?> VND</td>
                                </tr>
                                <tr>
                                    <th class="pl-0 w-25" scope="row"> Tiến độ xây dựng </th>
                                    <?php if($news->news_building_density != 0): ?>
                                        <td class="w-100"><?php echo e($news->news_building_density); ?>%</td>
                                    <?php else: ?>
                                        <td class="w-100"></td>
                                    <?php endif; ?>
                                <tr>
                                <tr>
                                    <th class="pl-0 w-25" scope="row"> Địa chỉ </th> 
                                    <td><?php echo e($news->news_street); ?> <br><br> <?php echo e($news->news_ward); ?> <?php echo e($news->news_district); ?> <?php echo e($news->news_province); ?></td>
                                </tr>
                                 <tr>
                                    <th class="pl-0 w-25" scope="row"> Ngày đăng dự án </th> 
                                    <td>
                                        <?php echo(date('d/m/Y h:i:s',strtotime('+7 hour',strtotime(str_replace("-","/",$news->created_at))))); ?>
                                        
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <div class="row"> 
                        <div class="col-4">
                            <h5> Tình trạng </h5>
                        </div> 
                            <div class="col-8"> 
                                <?php if($news->news_status == 'draft'): ?>
                                    <button style="background-color: #28a745; background-image: linear-gradient(180deg,#2ebd4e 10%,#1acc43 100%);  border-radius: 4px;" type="button" class="btn btn-success"><a href="<?php echo e(route('confirm-project', ['id' => $news->id])); ?>"><i style="color: #fff" class="fa fa-check" aria-hidden="true"> Chờ xác nhận</i></a>
                                    </button>
                                <?php elseif($news->news_status == 'published'): ?>
                                    <button style="background-color: #28a745; background-image: linear-gradient(180deg,#2ebd4e 10%,#1acc43 100%);  border-radius: 4px;" type="button" class="btn btn-success">Đã duyệt</i>
                                    </button>
                                <?php elseif($news->news_status == 'alone'): ?>
                                    <button style="background-color: #28a745; background-image: linear-gradient(180deg,#2ebd4e 10%,#1acc43 100%);  border-radius: 4px;" type="button" class="btn btn-success">Bị từ chối</i>
                                    </button>
                                <?php endif; ?>
                            </div>
                    </div>
                    <hr>
                </div>
            </div>
        </section>
        <!--Section: Block Content-->

        <h1 style="padding-left:1%;">Danh Sách Hình Ảnh Mô Tả Dự Án</h1>
        <div class="row">
            <?php $__currentLoopData = $news->news_image; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $src): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-4">
                <a target="_blank" >
                    <img src="<?php echo e($src); ?>" class="w-100" alt="Cinque Terre" id="img">
                </a>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script type="text/javascript">
        $(document).ready(function () {
          // MDB Lightbox Init
          $(function () {
            $("#mdb-lightbox-ui").load("mdb-addons/mdb-lightbox-ui.html");
          });
        });
    </script>

    <script type="text/javascript">
        $("#main").shorten({
        "showChars" : 200,
        "moreText"  : "Xem thêm",
        "lessText"  : "Rút gọn",
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('MasterPage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/arqyxqvohosting/public_html/nhadatchinhchu.billionaire-land.net/resources/views/Admin/DetailProject.blade.php ENDPATH**/ ?>