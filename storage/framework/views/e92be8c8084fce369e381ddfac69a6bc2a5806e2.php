<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Faq')); ?>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('multiple-action-button'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create-faq')): ?>
        <a href="<?php echo e(route('admin.faq.create')); ?>" class="btn btn-xs btn-white btn-icon-only width-auto"><?php echo e(__('Add')); ?></a>
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
                                <th>#</th>
                                <th class="w-25"><?php echo e(__('Title')); ?></th>
                                <th><?php echo e(__('Description')); ?></th>
                                <th><?php echo e(__('Action')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <th scope="row"><?php echo e(++$index); ?></th>
                                    <td><span class="font-weight-bold white-space"><?php echo e($faq->title); ?></span></td>
                                    <td class="faq_desc"><?php echo $faq->description; ?></td>
                                    <td>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit-faq')): ?>
                                            <a class="edit-icon" title="<?php echo e(__('Edit')); ?>" href="<?php echo e(route('admin.faq.edit',$faq->id)); ?>"><i class="fa fa-pen font-weight-bold"></i></a>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit-faq')): ?>
                                            <a href="#" class="delete-icon" title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('user-form-<?php echo e($faq->id); ?>').submit();"><i class="fas fa-trash"></i></a>
                                            <form method="post" id="user-form-<?php echo e($faq->id); ?>" action="<?php echo e(route('admin.faq.destroy',$faq->id)); ?>">
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/kevindupas/Documents/GitHub/support-ticket/resources/views/admin/faq/index.blade.php ENDPATH**/ ?>