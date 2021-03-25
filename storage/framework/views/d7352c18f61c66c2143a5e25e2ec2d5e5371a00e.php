<?php $__env->startSection('css'); ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    
    
        <div class="media" style="margin:50px;display: block; ">
            <div class="media-body" style="display: block">
                
                <div class="user-block">
                <?php if($posts->post_author->url_avata == null): ?>
                    <img class="img-circle img-bordered-sm" id="img_avt" src="<?php echo e(asset('img/avt_null.jpg')); ?>" alt="user image">
                <?php else: ?> 
                    <img class="img-circle img-bordered-sm" id="img_avt" src="<?php echo e($posts->post_author->url_avata); ?>" alt="user image">
                <?php endif; ?>
                    <div class="info">
                        <span class="username">
                        <a href="#"><?php echo e($posts->post_author->username); ?></a>
                        <span class="description"><?php echo e($posts->created_at); ?></span>
                    </div>
                </div>
                <div class="content_post">
                    <p><?php echo e($posts->post_content); ?></p>
                    <i class="fa fa-thumbs-up" ></i> <?php echo e($likes); ?>

                </div>
            </div>
            <h6>Hình Ảnh</h6>   
                <?php $__currentLoopData = $posts->post_image; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $src): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($src != null): ?>
                        <img class="pl-3 align-self-start mr-3"  id="image_post" src="<?php echo e($src); ?>" 
                        alt="alt_image">
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('MasterPage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/arqyxqvohosting/public_html/nhadatchinhchu.billionaire-land.net/resources/views/Admin/DetailPost.blade.php ENDPATH**/ ?>