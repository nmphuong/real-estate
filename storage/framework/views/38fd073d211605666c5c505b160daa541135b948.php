
<?php $__env->startSection('css'); ?>
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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<?php if(session('flash_message')): ?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            swal("<?php echo e(session('flash_message')); ?>", "Chọn OK để tiếp tục!", "success");
        </script>

<?php endif; ?>
<h3 class="pl-5"> Thông Tin Tài Khoản <b style="color: rgba(245, 23, 108, 0.815)"><?php echo e($users->username); ?></b></h3>
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
                            <h4>Tài khoản:  <?php echo e($users->username); ?></h4>
                      
                            <h4>Số điện thoại: <?php echo e($users->phone); ?></h4>
                            
                            <h4>E-mail: <?php echo e($users->email); ?></h4>
                            
                            <h4>Ngày sinh: <?php echo e($users->birth_date); ?></h4> 
                            
                        </div>
                        
                        <div class="col-md-12">
                            <h3 class="mt-2"><span class="fa fa-clock-o ion-clock float-right"></span> <b>Giới Thiệu</b></h3>
                            <table class="table table-sm table-hover table-striped">
                                <tbody>                                    
                                    <tr>
                                        <td>
                                            <?php if($users->personal_infor == null): ?>
                                            <strong>Người dùng chưa cập nhật thông tin giới thiệu</strong>
                                            <?php else: ?>
                                            <?php echo e($users->personal_infor); ?>

                                            <?php endif; ?>
                                        </td>
                                    </tr>
                              
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--/row-->
                </div>
                
                <div class="tab-pane" id="messages">
                    <table class="table table-hover table-striped">
                        <tbody>  
                            <?php if(count($post) == 0): ?> 
                                <img class="img_null" src="<?php echo e(asset('img/project_null.jpg')); ?>" height="250px" alt="project_null">
                            <?php else: ?>
                            <?php $__currentLoopData = $post; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                                 
                            <tr>
                                <td>
                                   <span class="float-right font-weight-bold"><a href="<?php echo e(route('detail-post', ['id' => $data->id])); ?>"><i class="fa fa-link"></i></a> <br>  <a onclick="return confirm('Bạn có chắc chắn muốn xóa?')" href="<?php echo e(route('delete-post', ['id' => $data->id])); ?>"><i class="fa fa-minus-circle" style="color:red" ></i></a></span><?php echo e($data->post_content); ?>

                                   <?php if($data->post_image[0] == null): ?>
                                        <div class="image_post">
                                            <img class="d-block" style="height: 55px; width:auto;"  src="<?php echo e(asset('img/image_post_null.png')); ?>" alt="images_post">
                                        </div>
                                   <?php else: ?>
                                        <div class="image_post">
                                            <img class="d-block" style="height: 55px; width:auto;"  src="<?php echo e($data->post_image[0]); ?>" alt="images_post">
                                        </div>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </tbody> 
                        
                    </table>
                    <?php echo e($post->links()); ?>

                </div>
                
                <div class="tab-pane" id="edit">
                    <?php if(count($news) == 0): ?>
                    <img class="img_null" src="<?php echo e(asset('img/project_null.jpg')); ?>" height="250px" alt="project_null">
                    <?php else: ?>
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $class = '';
                                    if ($index == 0) {
                                        $class = 'active';
                                    }
                                ?>
                                    <div class="carousel-item <?php echo $class; ?>">
                                        <img class="d-block w-100" style="height: 70vh;" src="<?php echo e($project->news_image[0]); ?>" alt="First slide">
                                        <div class="carousel-caption d-none d-md-block">
                                        <h3>
                                            <a class="text-white  text-uppercase font-weight-bold" href="<?php echo e(route('detail-project', ['id' => $project->id])); ?>" style="text-decoration:none" ><?php echo e($project->news_title); ?> </a>
                                        </h3>
                                        </div>
                                    </div> 
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                    <?php endif; ?>
                </div>
                
                <div class="tab-pane" id="album">
                    <div  class="row">
                        <div class="col-md-12">
                      
                          <div id="mdb-lightbox-ui"></div>
                      
                          <div class="mdb-lightbox row">
                            <?php $__currentLoopData = $arrayImage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $src): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($src): ?>
                            <figure class="col-md-4">
                              <a href="#" data-size="1600x1067">
                                <img alt="picture" src="<?php echo e($src); ?>" class="img-fluid">
                              </a>
                            </figure>
                            <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </div>
                      
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 order-lg-1 text-center">
            <?php if($users->url_avata == null): ?>
            <img src="<?php echo e(asset('img/avt_null.jpg')); ?>" alt="avatar" />
            <?php else: ?>
            <img src="<?php echo e($users->url_avata); ?>" style="border-radius: 50%; height:250px; width:250px;" class="mx-auto img-fluid img-circle d-block" alt="avatar">
            <?php endif; ?>
            <?php if( $users->firstname != null && $users->lastname != null): ?>
                <h4 class="mt-2"><?php echo e($users->firstname); ?> <?php echo e($users->lastname); ?></h4>
            <?php else: ?>
                <h4 class="mt-2"><?php echo e($users->username); ?></h4>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>
        $(function () {
            $("#mdb-lightbox-ui").load("mdb-addons/mdb-lightbox-ui.html");
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('MasterPage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\Desktop\pt\New folder\_\resources\views/Admin/DetailCustomer.blade.php ENDPATH**/ ?>