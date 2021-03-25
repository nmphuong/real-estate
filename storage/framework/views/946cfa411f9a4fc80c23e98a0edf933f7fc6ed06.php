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
        width:125px; 
        height:125px;
    }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <?php if(session('flash_message')): ?>
        <div class="alert alert-success"><?php echo e(session('flash_message')); ?></div>
    <?php endif; ?>
        <!-- DataTales Example -->
        <div class="content">
            <div class="module">
                <div class="module-head">
                    <h3 style="color: rgb(194, 13, 13); text-align:center" >Danh sách và thông tin khách hàng</h3>
                </div>

                
                <div class="container-fluid">
                        
                    <div class="row">
                        
                    <div class="col-12">

                        <div class="card">
                        
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Avatar</th>
                                
                                <th>Điện Thoại</th>
                                <th>Email</th>
                                <th>Ngày Đăng Ký</th>
                                <th>Thông Tin Chi Tiết</th>
                                <th>Xóa</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td style="vertical-align: middle;"><?php echo e($key+1); ?></td>
                                        <?php if($data->url_avata == null ): ?>
                                            <td> 
                                                <img alt="avatar" id="logo" src="<?php echo e(asset('img/avt_null.jpg')); ?>" />
                                            </td>
                                        <?php else: ?>
                                            <td>
                                                <img alt="avatar" id="logo" src="<?php echo e($data->url_avata); ?>">
                                            </td>
                                        <?php endif; ?>
                                        
                                        <td style="vertical-align: middle;"><?php echo e($data->phone); ?></td>
                                        <td style="vertical-align: middle;"><?php echo e($data->email); ?></td>
                                        <td style="vertical-align: middle;">
                                            <?php echo(date('d/m/Y',strtotime(str_replace("-","/",$data->created_at)))); ?>
                                        </td> 
                                        <td style="text-align: center; vertical-align: middle;">
                                            <button  style="background-color: #28a745; background-image: linear-gradient(180deg,#2ebd4e 10%,#1acc43 100%)" type="button" class="btn btn-success"><a href="<?php echo e(route('detail-account', ['id' => $data->id])); ?>"><i class="fa fa-eye" style="color: #fff" aria-hidden="true"></i></a>
                                            </button>
                                        </td>
                                        <td style="vertical-align: middle;">
                                            <button type="button" class="btn btn-danger"><a onclick="return confirm('Bạn có chắc chắn muốn xóa?')" href="<?php echo e(route('delete-user', ['id' => $data->id])); ?>"><i class="fa fa-trash" style="color: #fff" ></i></a>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
                            </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>

                

            </div>
        </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('MasterPage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/arqyxqvohosting/public_html/nhadatchinhchu.billionaire-land.net/resources/views/Admin/ListCustomer.blade.php ENDPATH**/ ?>