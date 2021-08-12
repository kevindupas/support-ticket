<nav class="navbar navbar-main navbar-expand-lg navbar-border n-top-header" id="navbar-main">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-main-collapse" aria-controls="navbar-main-collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-user d-lg-none ml-auto">
            <ul class="navbar-nav flex-row align-items-center">
                <li class="nav-item">
                    <a href="#" class="nav-link nav-link-icon sidenav-toggler" data-action="sidenav-pin" data-target="#sidenav-main"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link nav-link-icon" data-action="omnisearch-open" data-target="#omnisearch"><i class="fas fa-search"></i></a>
                </li>
                <li class="nav-item dropdown dropdown-animate">
                    <a class="nav-link pr-lg-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <span class="avatar avatar-sm rounded-circle">
                        <img src="<?php echo e(Auth::user()->avatarlink); ?>" alt="<?php echo e(Auth::user()->name); ?>">
                      </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right dropdown-menu-arrow">
                        <h6 class="dropdown-header px-0 text-center"><?php echo e(__('Hi')); ?>, <?php echo e(Auth::user()->name); ?></h6>

                        <a href="<?php echo e(Auth::user()->profilelink); ?>" class="dropdown-item">
                            <i class="fa fa-user-circle"></i> <span><?php echo e(__('Account Settings')); ?></span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item text-danger" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i> <span><?php echo e(__('Logout')); ?></span>
                        </a>
                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                            <?php echo csrf_field(); ?>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
        <!-- Navbar nav -->
        <div class="collapse navbar-collapse navbar-collapse-fade" id="navbar-main-collapse">
            <ul class="navbar-nav align-items-center d-none d-lg-flex">
                <li class="nav-item">
                    <a href="#" class="nav-link nav-link-icon sidenav-toggler" data-action="sidenav-pin" data-target="#sidenav-main"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item dropdown dropdown-animate">
                    <a class="nav-link pr-lg-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="media media-pill align-items-center">
                            <span class="avatar rounded-circle">
                               <img src="<?php echo e(Auth::user()->avatarlink); ?>" alt="<?php echo e(Auth::user()->name); ?>">
                            </span>
                            <div class="ml-2 d-none d-lg-block">
                                <span class="mb-0 text-sm font-weight-bold"><?php echo e(Auth::user()->name); ?></span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-left dropdown-menu-arrow">
                        <h6 class="dropdown-header px-0 text-center"><?php echo e(__('Hi')); ?>, <?php echo e(Auth::user()->name); ?></h6>
                        <a href="<?php echo e(Auth::user()->profilelink); ?>" class="dropdown-item">
                            <i class="fa fa-user-circle"></i> <span><?php echo e(__('Account Settings')); ?></span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item text-danger" onclick="event.preventDefault();document.getElementById('logout-form1').submit();">
                            <i class="fas fa-sign-out-alt"></i> <span><?php echo e(__('Logout')); ?></span>
                        </a>
                        <form id="logout-form1" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                            <?php echo csrf_field(); ?>
                        </form>
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav ml-lg-auto align-items-lg-center">
                <li class="nav-item dropdown dropdown-list-toggle">
                    <a href="#" data-toggle="dropdown" class="nav-link nav-link-icon">
                        <span class="align-middle text-dark"><i class="fas fa-globe-europe mr-2"></i><?php echo e(Str::upper(Auth::user()->currantLang())); ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right dropdown-menu-arrow mr-3 py-1">
                        <?php $__currentLoopData = Auth::user()->languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('admin.lang.update',$lang)); ?>" class="dropdown-item <?php echo e($lang == Auth::user()->currantLang() ? 'text-danger' : ''); ?> py-1">
                                <span class="small"><?php echo e(Str::upper($lang)); ?></span>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('lang-manage')): ?>
                            <a href="<?php echo e(route('admin.lang.index',[Auth::user()->currantLang()])); ?>" class="dropdown-item border-top py-1 text-danger">
                                <span class="small"><?php echo e(__('Manage Languages')); ?></span>
                            </a>
                        <?php endif; ?>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
<?php /**PATH /Users/kevindupas/Documents/GitHub/support-ticket/resources/views/admin/partials/topnav.blade.php ENDPATH**/ ?>