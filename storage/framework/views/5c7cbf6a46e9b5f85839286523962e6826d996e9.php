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

                <a type="button" style="text-decoration: none" href="<?php echo e(route('add-news')); ?>" data-toggle="modal" data-target="#exampleModal" class="btn-sm btn-success"> <i class="fa fa-plus"></i> <span> Thêm mới</span> </a>

                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bold" style="color: red" id="exampleModalLabel">Thêm mới nghành nghề</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <form action="<?php echo e(route('add-job')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên Nghành Nghề</label>
                                <input type="text" name="job_name"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nhập tên nghành nghề mong muốn">
                                
                            </div>
                            <button type="submit" class="btn float-right btn-primary">Thêm mới</button>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>


                <div class="module-head">
                    <h3 style="color: rgb(194, 13, 13); text-align:center" >Danh sách và thông tin các nghành nghề hiện có</h3>
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
                                <th>Nghành nghề</th>
                                <th>Trạng Thái</th>
                                <th></th>
                                <th>Xóa</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $job; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td style="vertical-align: middle;"><?php echo e($key+1); ?></td>
                                        <td> 
                                            <h5><?php echo e($data->job_name); ?></h5>
                                        </td>
                                        <td style="vertical-align: middle;">
                                            
                                            <?php if($data->status == 1): ?>
                                                <p style="color: rgb(25, 230, 25)">Đang hoạt động</p>
                                            <?php else: ?> 
                                                <p style="color: rgb(235, 17, 10)">Tạm ngưng hoạt động</p>
                                            <?php endif; ?>
                                        </td>
                                    
                                        <td style="text-align: center">
                                            <?php if($data->status == 0): ?>
                                                <button type="button" class="btn btn-outline-success"><a href="<?php echo e(route('change-status-job', ['id' => $data->id])); ?>"><i class="fa fa-check-circle" style="color: rgb(211, 20, 20)"  aria-hidden="true"> Kích hoạt </i></a></button> 
                                            <?php else: ?> 
                                                <button type="button" class="btn btn-outline-success"><a href="<?php echo e(route('change-status-job', ['id' => $data->id])); ?>"><i class="fa fa-times" aria-hidden="true"> Tạm ẩn</i></a></button> 
                                            <?php endif; ?>
                                        </td>

                                        <td style="vertical-align: middle;">
                                            <button type="button" class="btn btn-danger"><a onclick="return confirm('Bạn có chắc chắn muốn xóa?')" href="<?php echo e(route('delete-job', ['id' => $data->id])); ?>"><i class="fa fa-trash" style="color: #fff" ></i></a>
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
<?php echo $__env->make('MasterPage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/arqyxqvohosting/public_html/nhadatchinhchu.billionaire-land.net/resources/views/Admin/ListallJob.blade.php ENDPATH**/ ?>