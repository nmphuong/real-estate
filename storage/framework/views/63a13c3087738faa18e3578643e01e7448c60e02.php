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
    <h2> <?php if(isset($news)): ?> Cập nhật <?php else: ?> Thêm Mới <?php endif; ?> Tin Tức </h2>
  </div>
  <?php if(isset($news)): ?>
  <form class="pl-5 pr-5" action="<?php echo e(route('xu-ly-cap-nhat', ['id' => $news->id])); ?>" enctype="multipart/form-data" method="POST">
  <?php else: ?>
  <form class="pl-5 pr-5" action="<?php echo e(route('xu-ly-them-tin-tuc')); ?>" enctype="multipart/form-data" method="POST">
  <?php endif; ?>
    <?php echo csrf_field(); ?>
      <br>
      <div class="form-group row">
          <div class="col-sm-4 mb-3 mb-sm-0">
            <h5><label for="exampleFormControlFile1"> Thể Loại: </label></h5>
            <select class="form-control" id="exampleFormControlSelect1" name="category">
              <?php if(isset($allCategories)): ?>
                  <?php $__currentLoopData = $allCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(isset($news)): ?>
                      <?php 
                        $selected = '';
                        if($data->id == $news->category_id) {
                          $selected = 'selected';
                        }
                      ?>
                    <?php endif; ?>
                    <option <?php if(isset($news)): ?> <?php echo $selected; ?> <?php endif; ?> value="<?php echo e($data->category_name); ?>"><?php echo e($data->category_name); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php endif; ?> 
            </select>
            <?php if($errors->has('category')): ?>
            <p class="text-danger"><?php echo e($errors->first('category')); ?></p>
            <?php endif; ?>
          </div>
          <div class="col-sm-4">
            <h5><label for="exampleFormControlFile1"> Tác giả: </label></h5>
            <input type="text" <?php if(isset($news)): ?> value="<?php echo e($news->post_author); ?>" <?php endif; ?> class="form-control form-control-user" name="post_author">
            <?php if($errors->has('post_author')): ?>
            <p class="text-danger"><?php echo e($errors->first('post_author')); ?></p>
            <?php endif; ?>
          </div>
          <div class="col-sm-4">
            <h5><label for="exampleFormControlFile1"> Từ khóa: </label></h5>
            <input type="text" <?php if(isset($news)): ?> value="<?php echo e($news->keyword); ?>" <?php endif; ?> class="form-control form-control-user" name="keywords">
            <?php if($errors->has('keywords')): ?>
            <p class="text-danger"><?php echo e($errors->first('keywords')); ?></p>
            <?php endif; ?>
          </div>
      </div>
      <div class="form-group">
        <h5><label for="exampleFormControlFile1"> Tiêu đề: </label></h5>
        <input type="text" <?php if(isset($news)): ?> value="<?php echo e($news->title); ?>" <?php endif; ?> class="form-control form-control-user" name="title" id="exampleInputEmail">
        <?php if($errors->has('title')): ?>
            <p class="text-danger"><?php echo e($errors->first('title')); ?></p>
        <?php endif; ?>
      </div>
      <div class="form-group">
        <h5><label for="exampleFormControlFile1"> Nội dung giới thiệu: </label></h5>
        <input type="text" <?php if(isset($news)): ?> value="<?php echo e($news->short_content); ?>" <?php endif; ?> class="form-control form-control-user" name="short_content" id="exampleInputEmail">
        <?php if($errors->has('short_content')): ?>
            <p class="text-danger"><?php echo e($errors->first('short_content')); ?></p>
        <?php endif; ?>
      </div>
      <div class="form-group">
        <h5><label for="exampleFormControlFile1"> Nội dung: </label></h5>
        <?php if(isset($news)): ?> 
          <textarea name="editor"><?php echo e($news->content); ?></textarea> 
        <?php else: ?>
          <textarea name="editor"></textarea> 
        <?php endif; ?> 
        <?php if($errors->has('editor')): ?>
            <p class="text-danger"><?php echo e($errors->first('editor')); ?></p>
        <?php endif; ?>
      </div>
      <div class="form-group row">
        <div class="col-sm-8 mb-3 mb-sm-0">
          <?php if(isset($news)): ?>
            <img style="width:75%;" src="<?php echo e($news->url_img); ?>" alt="Images">
            <h5 class="pt-3"><label for="exampleFormControlFile1">Chọn hình ảnh: </label></h5>
            <input type="file" name="img_news" class="form-control-file" id="exampleFormControlFile1">
          <?php else: ?>
            <h5><label for="exampleFormControlFile1">Chọn hình ảnh: </label></h5>
            <input type="file" name="img_news" class="form-control-file" id="exampleFormControlFile1">
          <?php endif; ?>
          <?php if($errors->has('img_news')): ?>
            <p class="text-danger"><?php echo e($errors->first('img_news')); ?></p>
          <?php endif; ?>
        </div>
        <div class="col-sm-4 mb-3">
          <h5><label for="exampleFormControlFile1">Nguồn thông tin: </label></h5>
          <input type="text" <?php if(isset($news)): ?> value="<?php echo e($news->post_source); ?>" <?php endif; ?> name="post_source" class="form-control form-control-user" id="exampleFormControlFile1">
          <?php if($errors->has('post_source')): ?>
            <p class="text-danger"><?php echo e($errors->first('post_source')); ?></p>
            <?php endif; ?>
        </div>
      </div>
      <div class="submit pb-3">
        <input class="btn btn-primary" type="submit" <?php if(isset($news)): ?> value="Cập nhật" <?php else: ?> value="Thêm mới" <?php endif; ?>>
      </div>
  </form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
  <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
  <script>
    CKEDITOR.replace('editor');
  </script>
  
<?php $__env->stopSection(); ?>
<?php echo $__env->make('MasterPage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/arqyxqvohosting/public_html/nhadatchinhchu.billionaire-land.net/resources/views/Admin/CreateNews.blade.php ENDPATH**/ ?>