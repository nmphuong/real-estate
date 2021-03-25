<?php $__env->startSection('content'); ?>

<div class="container-fluid">
                    <!-- Content Row -->
                    <h5>Thống Kê Tổng Quan</h5>
                    <div class="row">
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                SỐ LƯỢNG TÀI KHOẢN</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e($quantity_user); ?></div>
                                        </div>
                                        <div class="col-auto">
                                        <a href="<?php echo e(route('list-customer')); ?>"><i class="fa fa-user fa-2x"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                SỐ LƯỢNG DỰ ÁN </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e($quantity_pro); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <a href="<?php echo e(route('list-table')); ?>"><i class="fas fa-dollar-sign fa-2x "></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">SỐ LƯỢNG TIN TỨC
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold "><?php echo e($quantity_news); ?></div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <a href="<?php echo e(route('get-all-news')); ?>"><i class="fas fa-clipboard-list fa-2x"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                SỐ LƯỢNG BÀI ĐĂNG</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e($quantity_post); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <h5>Dự Án Được Yêu Thích Nhất</h5>

                    
                    <div class="row">
                    <?php for($i = 0; $i < count($project); $i++): ?>
                        <?php if($project[$i]->id_news): ?>
                        <div class="__card col-lg-3 p-3">
                            <div class="div" style="border: 1px solid #e4e4e4; border-radius: 10px; overflow: hidden; height: 50vh;">
                                <div class="card-img h-50">
                                    <a href="<?php echo e(route('detail-project', ['id' => $project[$i]->id_news->id])); ?>">
                                        <img class="img w-100 h-100" src="<?php echo e($project[$i]->id_news->news_image[0]); ?>" alt="alt.cc">
                                    </a>
                                </div>
                                <div class="card-des p-3">
                                    <div class="title">
                                        <h5 class="title"><?php echo e($project[$i]->id_news->news_title); ?></h5>
                                    </div>
                                    <div class="des">
                                        <p class="text"><?php echo e($project[$i]->id_news->news_description); ?></p>
                                    </div>
                                    <div class="row button">
                                        <div class="pl-2 pr-5" style="font-size: 24px;"> <?php echo e($project[$i]->total); ?> <i class="fa fa-thumbs-up" aria-hidden="true"></i> 
                                        </div>

                                        <a href="<?php echo e(route('detail-project', ['id' => $project[$i]->id_news->id])); ?>" class="btn btn-primary"> Xem chi tiết <i class="fa fa-mouse-pointer pl-2" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                           
                        <?php endif; ?>
                    <?php endfor; ?>
                    </div>

                </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('MasterPage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/arqyxqvohosting/public_html/api.billionaire-land.net/resources/views/Admin/HomePages.blade.php ENDPATH**/ ?>