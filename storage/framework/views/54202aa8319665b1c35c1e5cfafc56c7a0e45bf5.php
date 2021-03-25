<?php $__env->startSection('css'); ?>
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Castoro&display=swap" rel="stylesheet">
  <style>
    .tittle{
      text-align: center;
      font-family: 'Castoro', serif;
    }
    .submit{
      float: right;
    }
    h5{
      color: #720ce2d1;
    }
  </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
  <div class="tittle">
    <h2> Thêm Mới Banner </h2>
  </div>
  <form class="pl-5 pr-5" action="<?php echo e(route('xu-ly-them-banner')); ?>" enctype="multipart/form-data" method="POST">
    <?php echo csrf_field(); ?>
    <br>
    <div class="form-group row">
        <div class="col-sm-6 mb-3 mb-sm-0">
            <h5><label for="exampleFormControlFile1"> Tên banner: </label></h5>
            <input type="text" class="form-control form-control-user" name="name">
            <?php if($errors->has('name')): ?>
                <p class="text-danger"><?php echo e($errors->first('name')); ?></p>
            <?php endif; ?>
        </div>
        <div class="col-sm-6 mb-3 mb-sm-0 pt-1">
        <h5><label for="exampleFormControlFile1">Chọn hình ảnh: </label></h5>
        <input type="file" name="img_banner" class="form-control-file" id="exampleFormControlFile1">
        <?php if($errors->has('img_banner')): ?>
            <p class="text-danger"><?php echo e($errors->first('img_banner')); ?></p>
        <?php endif; ?>
        </div>
    </div>
    <div class="submit pb-3">
        <input class="btn btn-primary" type="submit" value="Thêm mới" >
    </div>
  </form>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('MasterPage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/arqyxqvohosting/public_html/nhadatchinhchu.billionaire-land.net/resources/views/Admin/AddBanner.blade.php ENDPATH**/ ?>