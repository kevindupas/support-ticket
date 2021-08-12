<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Edit Profile')); ?> (<?php echo e($user->name); ?>)
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="<?php echo e(route('admin.users.update',$user->id)); ?>" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <div class="form-group row mb-4">
                            <label class="col-form-label form-control-label text-md-right col-12 col-md-3 col-lg-3"><?php echo e(__('Name')); ?></label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" placeholder="<?php echo e(__('Full name of the user')); ?>" name="name" class="form-control <?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>" value="<?php echo e($user->name); ?>" autofocus>
                                <div class="invalid-feedback">
                                    <?php echo e($errors->first('name')); ?>

                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label form-control-label text-md-right col-12 col-md-3 col-lg-3"><?php echo e(__('Email')); ?></label>
                            <div class="col-sm-12 col-md-7">
                                <input type="email" placeholder="<?php echo e(__('Email address (should be unique)')); ?>" name="email" class="form-control <?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" value="<?php echo e($user->email); ?>">
                                <div class="invalid-feedback">
                                    <?php echo e($errors->first('email')); ?>

                                </div>
                            </div>
                        </div>

                        <?php if($userObj->id != $user->id): ?>
                            <div class="form-group row mb-4">
                                <label class="col-form-label form-control-label text-md-right col-12 col-md-3 col-lg-3"><?php echo e(__('Role')); ?></label>
                                <div class="col-sm-12 col-md-7">
                                    <select class="form-control select2" name="role">
                                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($role->id); ?>" <?php if($user->roles[0]->id == $role->id): ?> selected <?php endif; ?>><?php echo e($role->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="form-group row mb-4">
                            <label class="col-form-label form-control-label text-md-right col-12 col-md-3 col-lg-3"><?php echo e(__('Password')); ?></label>
                            <div class="col-sm-12 col-md-7">
                                <input type="password" name="password" autocomplete="new-password" placeholder="<?php echo e(__('Set an account password')); ?>" class="form-control <?php echo e($errors->has('password') ? ' is-invalid': ''); ?>">
                                <div class="invalid-feedback">
                                    <?php echo e($errors->first('password')); ?>

                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label form-control-label text-md-right col-12 col-md-3 col-lg-3"><?php echo e(__('Confirm Password')); ?></label>
                            <div class="col-sm-12 col-md-7">
                                <input type="password" name="password_confirmation" placeholder="<?php echo e(__('Confirm account password')); ?>" autocomplete="new-password" class="form-control <?php echo e($errors->has('password_confirmation') ? ' is-invalid': ''); ?>">
                                <div class="invalid-feedback">
                                    <?php echo e($errors->first('password_confirmation')); ?>

                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label form-control-label text-md-right col-12 col-md-3 col-lg-3"><?php echo e(__('Avatar')); ?></label>
                            <div class="col-sm-12 col-md-7">
                                <div class="form-group col-lg-12 col-md-12">
                                    <label class="form-control-label"><?php echo e(__('Please upload a valid image file. Size of image should not be more than 2MB.')); ?></label>
                                    <div class="choose-file form-group">
                                        <label for="file" class="form-control-label">
                                            <div><?php echo e(__('Choose File Here')); ?></div>
                                            <input type="file" class="form-control <?php echo e($errors->has('avatar') ? ' is-invalid' : ''); ?>" name="avatar" id="file" data-filename="avatar_selection">
                                            <div class="invalid-feedback">
                                                <?php echo e($errors->first('avatar')); ?>

                                            </div>
                                        </label>
                                        <p class="avatar_selection"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label form-control-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                                <div class="form-group col-lg-12 col-md-12">
                                    <img src="<?php echo e($user->avatarlink); ?>" id="myAvatar" alt="user-image" class="w-10">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label class="col-form-label form-control-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                                <button class="btn-submit"><span><?php echo e(__('Update')); ?></span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/kevindupas/Documents/GitHub/support-ticket/resources/views/admin/users/edit.blade.php ENDPATH**/ ?>