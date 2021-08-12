<div class="sidenav custom-sidenav" id="sidenav-main">
    <div class="sidenav-header d-flex align-items-center">
        <a href="<?php echo e(route('home')); ?>" class="navbar-brand">
            <img src="<?php echo e(asset('storage/logo/logo.png')); ?>" class="sidebar-logo" alt="<?php echo e(env('APP_NAME')); ?>">
        </a>
        <div class="ml-auto">
            <div class="sidenav-toggler sidenav-toggler-dark d-md-none" data-action="sidenav-unpin" data-target="#sidenav-main">
                <div class="sidenav-toggler-inner">
                    <i class="sidenav-toggler-line bg-white"></i>
                    <i class="sidenav-toggler-line bg-white"></i>
                    <i class="sidenav-toggler-line bg-white"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="scrollbar-inner">
        <div class="div-mega">
            <ul class="navbar-nav navbar-nav-docs">
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->is('*dashboard*') ? ' active' : ''); ?>" href="<?php echo e(route('home')); ?>">
                        <i class="fas fa-home"></i> <?php echo e(__('Dashboard')); ?>

                    </a>
                </li>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage-users')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->is('*users*') ? ' active' : ''); ?>" href="<?php echo e(route('admin.users')); ?>">
                            <i class="fas fa-users"></i>
                            <span><?php echo e(__('Users')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage-tickets')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->is('*ticket*') ? ' active' : ''); ?>" href="<?php echo e(route('admin.tickets.index')); ?>">
                            <i class="fas fa-ticket-alt"></i>
                            <span><?php echo e(__('Tickets')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage-category')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->is('*category*') ? ' active' : ''); ?>" href="<?php echo e(route('admin.category')); ?>">
                            <i class="fas fa-list-alt"></i>
                            <span><?php echo e(__('Category')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage-faq')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->is('*faq*') ? ' active' : ''); ?>" href="<?php echo e(route('admin.faq')); ?>">
                            <i class="fas fa-question"></i>
                            <span><?php echo e(__('FAQ')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if(env('CHAT_MODULE') == 'yes'): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->is('*chat*') ? ' active' : ''); ?>" href="<?php echo e(route('admin.chats')); ?>">
                            <i class="fas fa-comments"></i>
                            <span><?php echo e(__('Chat')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage-setting')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->is('*setting*') ? ' active' : ''); ?>" href="<?php echo e(route('admin.settings.index')); ?>">
                            <i class="fas fa-cog"></i>
                            <span><?php echo e(__('Settings')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>
<?php /**PATH /Users/kevindupas/Documents/GitHub/support-ticket/resources/views/admin/partials/sidebar.blade.php ENDPATH**/ ?>