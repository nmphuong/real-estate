

<?php $__env->startSection('content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="user-wrapper">
                <ul class="users">
                   
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="user" id="<?php echo e($user->id); ?>">
                            
                            <div class="media">
                                <div class="media-left">
                                    <img src="<?php echo e($user->avatar); ?>"  alt="" class="media-object"/>
                                </div>
                                <div class="media-body">
                                    <p class="name"><?php echo e($user->name); ?></p>
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

<?php echo $__env->make('Admin.Chat.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\Desktop\pt\New folder\_\resources\views/Admin/Chat/home.blade.php ENDPATH**/ ?>