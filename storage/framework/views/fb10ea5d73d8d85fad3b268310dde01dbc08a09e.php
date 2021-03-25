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
                    <!-- Page Heading -->
                    <div class="row">
                        <div class="col-8">
                            <h1 class="h3 mb-2 text-gray-800"><b style="color:red">Khách Hàng</b></h1>
                        </div>
                        <div class="col-4 float-right" style="padding-left: 10%;">
                            <form 
                                class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" >
                                <div class="input-group">
                                    <input type="text" id="search" class="form-control bg-light border-1 small" placeholder="Search for..." name="name_customer"
                                        aria-label="Search" aria-describedby="basic-addon2">
                                </div>
                            </form>
                        </div>
                    </div>
    
                    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thông Tin Chi Tiết</h6>
        </div>
        <div class="ml-5 card-body">
            <div class="table-responsive">
                <table class="table table-responsive" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Avatar</th>
                            <th>Tên Đăng Nhập</th>
                            <th>Điện Thoại</th>
                            <th>Email</th>
                            <th>Thông Tin </th>
                            
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    
                    <tbody id="tbody">
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                        <th><?php echo e($key+1); ?></th>
                            <?php if($data->url_avata == null ): ?>
                                <th> 
                                    <img alt="avatar" id="logo" src="<?php echo e(asset('img/avt_null.jpg')); ?>" />
                                </th>
                            <?php else: ?>
                                <th>
                                    <img alt="avatar" id="logo" src="<?php echo e($data->url_avata); ?>">
                                </th>
                            <?php endif; ?>
                            <th><?php echo e($data->username); ?></th>
                            <th><?php echo e($data->phone); ?></th>
                            <th><?php echo e($data->email); ?></th>
                            <th><button  style="background-color: #28a745; background-image: linear-gradient(180deg,#2ebd4e 10%,#1acc43 100%)" type="button" class="btn btn-success"><a href="<?php echo e(route('detail-account', ['id' => $data->id])); ?>"><i class="fa fa-eye" style="color: #fff" aria-hidden="true"></i></a></button></th>
                            
                            <th>
                                <button type="button" class="btn btn-danger"><a onclick="return confirm('Bạn có chắc chắn muốn xóa?')" href="<?php echo e(route('delete-user', ['id' => $data->id])); ?>"><i class="fa fa-trash" style="color: #fff" ></i></a>
                                </button>
                            </th>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="page float-right"><?php echo e($users->links()); ?></div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script type="text/javascript">
        $('#search').change(function(){
            
            $value = $(this).val();
          
            setTimeout(function() {
                $.ajax({
                        type: 'get',
                        url: '<?php echo e(route('search')); ?>',
                        data: {
                            'name_customer': $value
                        },
                        success:function(data){
                            var html = '';
                            var value = data.data.length;
                            if(value == 0){
                                html = html + `<h3 >Không tìm thấy</h3>`;
                            }
                            else{
                                for (var i = 0; i < data.data.length; i++) {
                                html = html + `
                                    <tr>
                                        <th>` + i + `</th>
                                        <th><img alt="avatar" id="logo" src="` + ((data.data[i].url_avata == null)? 'https://lh3.googleusercontent.com/AYiuk8hk-h05AlUM9q1qLiVWLER1lrC113L3bByuX5AnPJdgMoMqxp_Fsg4BjM0QBD84=s85' : data.data[i].url_avata) + `"></th>
                                        <th>` + data.data[i].username + `</th>
                                        <th>` + data.data[i].phone + `</th>
                                        <th>` + data.data[i].email + `</th>
                                        <th>
                                            <button  style="background-color: #28a745; background-image: linear-gradient(180deg,#2ebd4e 10%,#1acc43 100%)" type="button" class="btn btn-success">
                                                <a href="/detail-account/` + data.data[i].id + `">
                                                    <i class="fa fa-eye" style="color: #fff" aria-hidden="true"></i>
                                                </a>
                                            </button>
                                        </th>
                                        <th>
                                            <button type="button" class="btn btn-danger">
                                                <a onclick="return confirm('Bạn có chắc chắn muốn xóa?')" href="/delete-user/` + data.data[i].id + `">
                                                    <i class="fa fa-trash" style="color: #fff" ></i>
                                                </a>
                                            </button>
                                        </th>
                                    </tr>
                                `;
                                }
                            }
                            $('#tbody').fadeOut(100, function(data){
                                $('#tbody').html(html).fadeIn().delay(100);
                            });
                        }
                    });
            }, 100);
            
        })
        $.ajaxSetup({ headers: { 'csrftoken' : '<?php echo e(csrf_token()); ?>' } });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('MasterPage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/arqyxqvohosting/public_html/api.billionaire-land.net/resources/views/Admin/ListCustomer.blade.php ENDPATH**/ ?>