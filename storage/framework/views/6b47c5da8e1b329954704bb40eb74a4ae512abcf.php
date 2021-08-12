<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Login')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-button'); ?>
    <div class="text-right my-5">
        <a href="<?php echo e(route('faq')); ?>" class="btn-submit"><?php echo e(__('FAQ')); ?></a>
        <a href="<?php echo e(route('home')); ?>" class="btn-submit"><?php echo e(__('Create Ticket')); ?></a>
        <a href="<?php echo e(route('search')); ?>" class="btn-submit"><?php echo e(__('Search Ticket')); ?></a>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-5 col-md-7">
        <a class="navbar-brand d-flex justify-content-center mt-10 mb-4" href="#">
            <img src="<?php echo e(asset(Storage::url('logo/logo.png'))); ?>" class="auth-logo" alt="logo">
        </a>
        <div class="card bg-secondary border-0 mb-0">
            <div class="card-body px-lg-5 py-lg-5">

                <div class="text-center text-muted mb-4">
                    <h2 class="mb-3 text-18"><?php echo e(__('Login')); ?></h2>
                </div>
                <form method="POST" action="<?php echo e(route('login')); ?>">
                    <?php echo csrf_field(); ?>
                    <?php if(session()->has('info')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session()->get('info')); ?>

                        </div>
                    <?php endif; ?>
                    <?php if(session()->has('status')): ?>
                        <div class="alert alert-info">
                            <?php echo e(session()->get('status')); ?>

                        </div>
                    <?php endif; ?>
                    <div class="form-group col-md-12">
                        <label for="email" class="form-control-label"><?php echo e(__('Email')); ?></label>
                        <div class="form-icon-user">
                            <span class="prefix-icon"><i class="fas fa-envelope"></i></span>
                            <input type="email" class="form-control <?php echo e($errors->has('email') ? 'is-invalid' : ''); ?>"
                                   id="email" name="email" placeholder="<?php echo e(__('Enter your Email')); ?>" required=""
                                   value="<?php echo e(old('email')); ?>">
                            <div class="invalid-feedback d-block">
                                <?php echo e($errors->first('email')); ?>

                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="password" class="form-control-label"><?php echo e(__('Password')); ?></label>
                        <div class="form-icon-user">
                            <span class="prefix-icon"><i class="fas fa-lock"></i></span>
                            <input type="password"
                                   class="form-control <?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" id="password"
                                   name="password" placeholder="<?php echo e(__('Enter Password')); ?>" required=""
                                   value="<?php echo e(old('password')); ?>">
                            <div class="invalid-feedback d-block">
                                <?php echo e($errors->first('password')); ?>

                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-submit mt-3"><?php echo e(__('Sign In')); ?></button>
                        <a href="<?php echo e(route('password.request')); ?>"
                           class="d-block mt-2"><small><?php echo e(__('Forgot password?')); ?></small></a>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/kevindupas/Documents/GitHub/support-ticket/resources/views/auth/login.blade.php ENDPATH**/ ?>