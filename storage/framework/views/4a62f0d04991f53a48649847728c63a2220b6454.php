<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title>
        <?php echo $__env->yieldContent('page-title'); ?> - <?php echo e(config('app.name', 'Taskly')); ?>

    </title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo e(asset(Storage::url('logo/favicon.png'))); ?>">
    <!-- Font Awesome 5 -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/libs/@fontawesome/fontawesome-free/css/all.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/libs/select2/dist/css/select2.min.css')); ?>">

    <?php echo $__env->yieldPushContent('css-page'); ?>

    <link rel="stylesheet" href="<?php echo e(asset('assets/css/site.css')); ?>" id="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/stylesheet.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/ac.css')); ?>">
</head>

<body class="bg-gradient-primary">
<div class="main-content">
    <div class="container">
        <div class="row justify-content-center">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>
</div>
<footer class="py-2 footer-auto-bottom1" id="footer-main">
    <div class="container-fluid">
        <div class="row align-items-center justify-content-xl-between">
            <div class="col-lg-12 col-xl-12">
                <?php echo $__env->yieldContent('action-button'); ?>
            </div>
        </div>
    </div>
</footer>

<script src="<?php echo e(asset('assets/js/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/site.core.js')); ?>"></script>
<script src="<?php echo e(asset('assets/libs/select2/dist/js/select2.min.js')); ?>"></script>
<script src="https://js.pusher.com/5.0/pusher.min.js"></script>

<?php echo $__env->yieldPushContent('scripts'); ?>


<?php if($message = Session::get('success')): ?>
    <script>show_toastr('Success', '<?php echo $message; ?>', 'success');</script>
<?php endif; ?>
<?php if($message = Session::get('error')): ?>
    <script>show_toastr('Error', '<?php echo $message; ?>', 'error');</script>
<?php endif; ?>

</body>
</html>
<?php /**PATH /Users/kevindupas/Documents/GitHub/support-ticket/resources/views/layouts/auth.blade.php ENDPATH**/ ?>