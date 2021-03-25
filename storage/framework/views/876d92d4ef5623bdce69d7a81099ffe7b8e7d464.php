

<?php $__env->startSection('css'); ?>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@500&display=swap" rel="stylesheet">
    <style>
        h2 {
            font-family: 'Sansita Swashed', cursive;
            text-align: center;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<h2>Dịch vụ và hỗ trợ khách hàng</h2>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="user-wrapper">
                <ul class="users">

                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="user" id="<?php echo e($user->id); ?>">
                            <?php if($user->unread): ?>
                                <span class="pending"><?php echo e($user->unread); ?></span>
                            <?php endif; ?>
                            <div class="media">
                                <div class="media-left">
                                    <img src="<?php echo e($user->url_avata); ?>"  alt="" class="media-object"/>
                                </div>
                                <div class="media-body">
                                    <p class="name"><?php echo e($user->username); ?></p>
                                    <p class="email"><?php echo e($user->email); ?></p>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
        <div class="col-md-8" id="messages">
           
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin.Chat.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\Desktop\pt\New folder\_\resources\views/Admin/Chat/viewAdminchat.blade.php ENDPATH**/ ?>