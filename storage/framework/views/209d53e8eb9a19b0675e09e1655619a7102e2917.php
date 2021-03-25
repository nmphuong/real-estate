<?php $__env->startSection('css'); ?>
    <style>
        .img_null {
            text-align: center;
            padding-top:10%;
        }
        .img_null img{
            border-radius: 50%;
        }
        h5 {
            font-family: 'Castoro', serif;
        }
    </style> 

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


    <?php if(count($news) == 0): ?>
        <div class="img_null" >
            <img src="<?php echo e(asset('img/null_project.png')); ?>" alt="IMG">
            <h5 class="pt-5">Loại dự án này đang được cập nhật</h5>
        </div>
    <?php else: ?>
        <?php if(session('flash_message')): ?>
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script>
                swal("<?php echo e(session('flash_message')); ?>", "Chọn OK để tiếp tục!", "success");
            </script>
        <?php endif; ?>
            <div class="content">
                <div class="module">
                    <div class="module-head margin-auto">
                        <h3 style="color: rgb(194, 13, 13); text-align: center">Danh sách và thông tin dự án</h3>
                    </div>

                    
                    <div class="container-fluid">
                        
                        <div class="row">
                            
                        <div class="col-12">

                            <div class="card">
                            
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div >
                                    <h6 style="color: #ff452c">Tình trạng Xác nhận Sản phẩm</h6>
                                    <ul> 
                                        <li> 
                                            <div class="row">
                                                <div class="col-1">
                                                    <i style="color: rgb(96, 219, 39)" class="fa fa-check" aria-hidden="true"></i>
                                                </div>
                                                <div class="col-3">
                                                    <h6>Sản phẩm đang chờ kiểm duyệt</h6>
                                                </div>
                                            </div>
                                        </li>
                                        <li> 
                                            <div class="row">
                                                <div class="col-1">
                                                    <i class="fa fa-ban" style="color: rgb(224, 15, 15)"aria-hidden="true"></i>
                                                </div>
                                                <div class="col-4">
                                                    <h6>Hủy bỏ sản phẩm đã được duyệt</h6>
                                                </div>
                                            </div>
                                        </li>
                                        <li> 
                                            <div class="row">
                                                <div class="col-1">
                                                    <i class="fa fa-minus-circle" style="color: rgb(224, 15, 15)" aria-hidden="true"></i>
                                                </div>
                                                <div class="col-3">
                                                    <h6>Xác nhận lại dự án</h6>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tiêu đề</th>
                                    <th>Hình Ảnh</th>
                                    <th>Thể Loại</th>
                                    <th>Ngày Đăng </th>
                                    <th>Đơn Giá</th>
                                    
                                    <th></th>
                                    <th>Xác Nhận</th>
                                    <th>Hủy</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td style="vertical-align: middle; border: none;"><?php echo e($key+1); ?></td>
                                            <td style="vertical-align: middle; border: none;">
                                                <p style="width: 100px;
                                                overflow: hidden;
                                                white-space: nowrap; 
                                                text-overflow: ellipsis;"><?php echo e($item->news_title); ?></p>
                                            </td>
                                            <?php for($i = 0; $i < 1; $i++): ?>
                                            <td style=" border: none;"><img style="width:120px; height:100px; border-radius:12px;"  src="<?php echo e($item->news_image[0]); ?>" /></td>
                                            <?php endfor; ?>
                                            <td style="vertical-align: middle; border: none;"><?php echo e($item->news_type); ?></td>
                                            <td style="vertical-align: middle; border: none;">
                                                    <?php echo(date('d/m/Y',strtotime(str_replace("-","/",$item->created_at)))); ?> 
                                            </td>
                                            <?php if($item->news_status == 'draft'): ?>
                                                
                                                <td style="vertical-align: middle; border: none;"><?php echo e(number_format($item->news_price_from, 0, '', ',')); ?> VND</td>
                                                

                                                <td style="vertical-align: middle; border: none;">
                                                    <button type="button" style="background-color: #28a745; background-image: linear-gradient(180deg,#2ebd4e 10%,#1acc43 100%)" class="btn btn-success"><a href="<?php echo e(route('detail-project', ['id' => $item->id])); ?>"><i style="color: #fff" class="fa fa-eye" aria-hidden="true"></i></a>
                                                    </button>
                                                </td>
                                                <td style="text-align: center;vertical-align: middle; border: none;">
                                                    <button style="background-color: #28a745; background-image: linear-gradient(180deg,#2ebd4e 10%,#1acc43 100%)" type="button" class="btn btn-success"><a href="<?php echo e(route('confirm-project', ['id' => $item->id])); ?>"><i style="color: #fff" class="fa fa-check" aria-hidden="true"></i></a>
                                                    </button>
                                                </td>
                                            <?php elseif($item->news_status == 'published'): ?>
                                                <td style="vertical-align: middle; border: none;"><?php echo e(number_format($item->news_price_from, 0, '', ',')); ?> VND</td>
                                                
                                                <td style="vertical-align: middle; border: none;">
                                                    <button style="background-color: #28a745; background-image: linear-gradient(180deg,#2ebd4e 10%,#1acc43 100%)" type="button" class="btn btn-success"><a href="<?php echo e(route('detail-project', ['id' => $item->id])); ?>"><i class="fa fa-eye" style="color: #fff" aria-hidden="true"></i></a>
                                                    </button>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle; border: none;">
                                                    <button type="button" class="btn btn-danger"><a href="<?php echo e(route('ban-project', ['id' => $item->id])); ?>"><i class="fa fa-ban" style="color: #fff"  aria-hidden="true"></i></a>
                                                    </button>
                                                </td>

                                            <?php elseif($item->news_status == 'alone'): ?>
                                                <td style="vertical-align: middle; border: none;"><?php echo e(number_format($item->news_price_from, 0, '', ',')); ?> VND</td>
                                                
                                                <td style="vertical-align: middle; border: none;" >
                                                    <button style="background-color: #28a745; background-image: linear-gradient(180deg,#2ebd4e 10%,#1acc43 100%)" type="button" class="btn btn-success"><a href="<?php echo e(route('detail-project', ['id' => $item->id])); ?>"><i class="fa fa-eye" style="color: #fff" aria-hidden="true"></i></a>
                                                    </button>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle; border: none;">
                                                    <button type="button" class="btn btn-danger"><a href="<?php echo e(route('confirm-project', ['id' => $item->id])); ?>"><i class="fa fa-minus-circle" style="color: #fff" aria-hidden="true"></i></a>
                                                    </button>
                                                </td>
                                                
                                            <?php endif; ?>
                                            
                                            <td style="vertical-align: middle; border: none;">
                                                <button type="button" class="btn btn-danger"><a onclick="return confirm('Bạn có chắc chắn muốn xóa?')" href="<?php echo e(route('delete-pro', ['id' => $item->id])); ?>"><i class="fa fa-trash" style="color: #fff" ></i></a>
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
    <?php endif; ?>
    
<?php $__env->stopSection(); ?>



<?php echo $__env->make('MasterPage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/arqyxqvohosting/public_html/nhadatchinhchu.billionaire-land.net/resources/views/Admin/project.blade.php ENDPATH**/ ?>