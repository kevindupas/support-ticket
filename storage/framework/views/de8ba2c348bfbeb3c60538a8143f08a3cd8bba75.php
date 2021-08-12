<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Category')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('multiple-action-button'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create-category')): ?>
        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-6 col-6 pt-lg-3 pt-xl-2">
            <a href="<?php echo e(route('admin.category.create')); ?>" class="btn btn-xs btn-white btn-icon-only width-auto"><?php echo e(__('Add')); ?></a>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card o-hidden mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="selection-datatable" class="table dataTable-collapse text-center">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col"><?php echo e(__('Name')); ?></th>
                                <th scope="col"><?php echo e(__('Color')); ?></th>
                                <th scope="col"><?php echo e(__('Action')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <th scope="row"><?php echo e(++$index); ?></th>
                                    <td><?php echo e($category->name); ?></td>
                                    <td><span class="badge" style="background: <?php echo e($category->color); ?>">&nbsp;&nbsp;&nbsp;</span></td>
                                    <td>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit-category')): ?>
                                            <a href="<?php echo e(route('admin.category.edit', $category->id)); ?>" class="edit-icon" title="<?php echo e(__('Edit')); ?>"><i class="fas fa-pencil-alt"></i></a>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete-category')): ?>
                                            <a href="#" class="delete-icon" title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($category->id); ?>').submit();"><i class="fas fa-trash"></i></a>
                                            <form id="delete-form-<?php echo e($category->id); ?>" action="<?php echo e(route('admin.category.destroy',$category->id)); ?>" method="POST" style="display: none;">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                            </form>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/kevindupas/Documents/GitHub/support-ticket/resources/views/admin/category/index.blade.php ENDPATH**/ ?>