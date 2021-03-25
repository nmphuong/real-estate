<?php $__env->startSection('css'); ?>
<style>
    .img_news{
        height: 250px;
    }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="pl-5 col-lg-10">

        <!-- Title -->
<h2 class="mt-4"><?php echo e($news->title); ?></h2>

        <!-- Author -->
        <h6>
          Tác giả
        <a href="#"><?php echo e($news->post_author); ?></a>
        </h6>

        <hr>

        <!-- Date/Time -->
      <p><?php echo e($news->post_date); ?></p>

        <hr>

        <!-- Preview Image -->
      <img class="img-fluid rounded" src="<?php echo e($news->url_img); ?>" alt="">

        <hr>

        <!-- Post Content -->
      <p class="lead"><?php echo e($news->title_website); ?></p>

      <div id="content_news"><?php echo $news->content ?></div>

      <h6 class="float-right">Nguồn: <?php echo e($news->post_source); ?></h6>
      
      </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('MasterPage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/arqyxqvohosting/public_html/api.billionaire-land.net/resources/views/Admin/DetailNews.blade.php ENDPATH**/ ?>