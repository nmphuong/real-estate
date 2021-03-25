<?php $__env->startSection('css'); ?>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital@1&display=swap" rel="stylesheet">
    <style>
        .title {
            font-size: 20px;
            font-family: 'Roboto', sans-serif;
        }
        span{
            font-family: 'Roboto', sans-serif;
        }
        .create{
            margin: 20px;
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

<div class="mr-5 ml-5">
    <div class="title text-center">
        <p> Thể Loại Tin Tức Đã Xóa </p>
    </div>
    <div class="create">
        <a type="button" href="<?php echo e(route('category')); ?>" class="btn-sm btn-warning"> <i class="fa fa-reply" aria-hidden="true"></i> Trang Chủ </a>
    </div>
    <table class="table table-striped text-center">
        <thead>
            <tr>
            <th scope="col">STT</th>
            <th scope="col">Tên Thể Loại</th>
            <th scope="col">Khôi phục</th>
            </tr>
        </thead>
        <tbody>

            <?php $__currentLoopData = $Categorydelete; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <th scope="row"><?php echo e($key+1); ?></th>
                    <td><?php echo e($data->category_name); ?></td>
                    <td>
                        <a href="<?php echo e(route('restore', ['id' => $data->id])); ?>"><button onclick="return confirm('Bạn có chắc chắn muốn khôi phục thể loại này?')" type="button" class="btn btn-outline-danger " style=" width: 50px;"> <i class="fa fa-reply" aria-hidden="true"></i></button></a>
                    </td>
                    
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
        </tbody>
    </table>
</div>
    

<?php $__env->stopSection(); ?>
<?php echo $__env->make('MasterPage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/arqyxqvohosting/public_html/nhadatchinhchu.billionaire-land.net/resources/views/Admin/RestoreCategory.blade.php ENDPATH**/ ?>