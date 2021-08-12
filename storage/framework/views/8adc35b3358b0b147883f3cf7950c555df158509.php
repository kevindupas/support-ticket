<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Tickets')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('multiple-action-button'); ?>
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6 pt-lg-3 pt-xl-2">
        <select class="select2" id="projects" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
            <option value="<?php echo e(route('admin.tickets.index')); ?>"><?php echo e(__('All Tickets')); ?></option>
            <option value="<?php echo e(route('admin.tickets.index', 'in-progress')); ?>" <?php if($status == 'in-progress'): ?> selected <?php endif; ?>><?php echo e(__('In Progress')); ?></option>
            <option value="<?php echo e(route('admin.tickets.index', 'on-hold')); ?>" <?php if($status == 'on-hold'): ?> selected <?php endif; ?>><?php echo e(__('On Hold')); ?></option>
            <option value="<?php echo e(route('admin.tickets.index', 'closed')); ?>" <?php if($status == 'closed'): ?> selected <?php endif; ?>><?php echo e(__('Closed')); ?></option>
        </select>
    </div>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create-tickets')): ?>
        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-6 col-6 pt-lg-3 pt-xl-2">
            <a href="<?php echo e(route('admin.tickets.create')); ?>" class="btn btn-xs btn-white btn-icon-only width-auto"><?php echo e(__('Add')); ?></a>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <?php if(session()->has('ticket_id') || session()->has('smtp_error')): ?>
                <div class="alert alert-info">
                    <?php if(session()->has('ticket_id')): ?>
                        <?php echo Session::get('ticket_id'); ?>

                        <?php echo e(Session::forget('ticket_id')); ?>

                    <?php endif; ?>
                    <?php if(session()->has('smtp_error')): ?>
                        <?php echo Session::get('smtp_error'); ?>

                        <?php echo e(Session::forget('smtp_error')); ?>

                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-lg-12 col-md-12">
            <div class="card o-hidden mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="selection-datatable" class="table" width="100%">
                            <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th><?php echo e(__('Ticket ID')); ?></th>
                                <th class="w-10"><?php echo e(__('Name')); ?></th>
                                <th><?php echo e(__('Email')); ?></th>
                                <th><?php echo e(__('Subject')); ?></th>
                                <th><?php echo e(__('Category')); ?></th>
                                <th><?php echo e(__('Status')); ?></th>
                                <th><?php echo e(__('Created')); ?></th>
                                <th><?php echo e(__('Action')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <th scope="row"><?php echo e(++$index); ?></th>
                                    <td class="Id sorting_1">
                                        <a href="<?php echo e(route('admin.tickets.edit',$ticket->id)); ?>">
                                            <?php echo e($ticket->ticket_id); ?>

                                        </a>
                                    </td>
                                    <td><span class="white-space"><?php echo e($ticket->name); ?></span></td>
                                    <td><?php echo e($ticket->email); ?></td>
                                    <td><span class="white-space"><?php echo e($ticket->subject); ?></span></td>
                                    <td><span class="badge badge-white" style="background: <?php echo e($ticket->color); ?>;"><?php echo e($ticket->category_name); ?></span></td>
                                    <td><span class="badge <?php if($ticket->status == 'In Progress'): ?>badge-warning <?php elseif($ticket->status == 'On Hold'): ?> badge-danger <?php else: ?> badge-success <?php endif; ?>"><?php echo e(__($ticket->status)); ?></span></td>
                                    <td><?php echo e($ticket->created_at->diffForHumans()); ?></td>
                                    <td>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('reply-tickets')): ?>
                                            <a href="<?php echo e(route('admin.tickets.edit', $ticket->id)); ?>" class="edit-icon" title="<?php echo e(__('Reply')); ?>"><i class="fas fa-reply"></i></a>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit-tickets')): ?>
                                            <a href="#" class="delete-icon" title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('user-form-<?php echo e($ticket->id); ?>').submit();"><i class="fas fa-trash"></i></a>
                                            <form method="post" id="user-form-<?php echo e($ticket->id); ?>" action="<?php echo e(route('admin.tickets.destroy',$ticket->id)); ?>">
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/kevindupas/Documents/GitHub/support-ticket/resources/views/admin/tickets/index.blade.php ENDPATH**/ ?>