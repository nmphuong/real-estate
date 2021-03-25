<?php $__env->startSection('css'); ?>
    <style>
        .header-content a{
            margin-left: 5%;
            border-radius: 8px;
            height: 35px;
            text-decoration: none;
            text-align: center;
            margin-bottom: 2%;
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

    <?php if(session('flash_del_message')): ?>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            swal("<?php echo e(session('flash_del_message')); ?>", "Chọn OK để tiếp tục!", "success");
        </script>
    
    <?php endif; ?>

    <div class="w-75 m-auto">
        <div class="d-flex">
            <div class="pr-2">
                <h3>Present Banner</h3>
            </div>
            <div class="header-content text-nowrap">
                <a href="<?php echo e(route('add-banner')); ?>" class="btn btn-success">
                    <i class="fa fa-plus"></i>
                    <span>
                        Thêm mới
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="m-auto w-75">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <?php $__currentLoopData = $banner; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $class = '';
                    if ($index == 0) {
                        $class = 'active';
                    }
                ?>
                <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo e($index); ?>" <?php echo $class; ?>></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ol>
            <div class="carousel-inner">
                <?php $__currentLoopData = $banner; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $class = '';
                    if ($index == 0) {
                        $class = 'active';
                    }
                ?>
                <div class="carousel-item <?php echo $class; ?>" style="height: 50vh">
                    <img class="d-block w-100 h-100" src="<?php echo e($project->img_banner); ?>" alt="First slide">
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <div class="w-75 m-auto pt-5">
        <h3>Danh sách hình ảnh</h3>
        <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">STT</th>
                <th scope="col">Tên Banner</th>
                <th scope="col">Hình Ảnh</th>
                <th scope="col">Ẩn</th>
                <th scope="col">Xóa</th>
              </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $allbanner; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                    <th scope="row" style="padding-top: 15%;"><?php echo e($index + 1); ?> </th>
                        <td style="padding-top: 15%;"><?php echo e($data->name); ?></td>
                        <td> 
                            <img height="250px" width="350px" src="<?php echo e($data->img_banner); ?>" alt="img">  </td>
                        <td style="padding-top: 15%;"> 
                            <?php if($data->active == 1): ?>
                                <button type="button" class="btn btn-outline-success"><a href="<?php echo e(route('hide-banner', ['id' => $data->id])); ?>"><i class="fa fa-check-circle" style="color: rgb(211, 20, 20)"  aria-hidden="true"></i></a></button> 
                            <?php else: ?> 
                                <button type="button" class="btn btn-outline-success"><a href="<?php echo e(route('hide-banner', ['id' => $data->id])); ?>"><i class="fa fa-times" aria-hidden="true"></i></a></button> 
                            <?php endif; ?>
                        </td>
                        <td style="padding-top: 15%;">
                            <button type="button" class="btn btn-danger"><a onclick="return confirm('Bạn có chắc chắn muốn xóa?')" href="<?php echo e(route('delete-banner', ['id' => $data->id])); ?>"><i class="fa fa-trash" style="color: #fff" ></i></a>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          </table>
          <div class="float-right"><?php echo e($allbanner->links()); ?></div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('MasterPage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/arqyxqvohosting/public_html/api.billionaire-land.net/resources/views/Admin/Banner.blade.php ENDPATH**/ ?>