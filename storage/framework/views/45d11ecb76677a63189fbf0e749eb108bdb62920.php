<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Dashboard')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row mt-3">
        <div class="col-lg-3 col-md-3 col-sm-6">
            <div class="card card-box">
                <div class="left-card">
                    <div class="icon-box bg-primary"><i class="fas fa-list-alt"></i></div>
                    <h4><?php echo e(__('Total')); ?> <span><?php echo e(__('Categories')); ?></span></h4>
                </div>
                <div class="number-icon"><?php echo e($categories); ?></div>
            </div>
            <img src="<?php echo e(asset('assets/img/dot-icon.png')); ?>" class="dotted-icon">
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6">
            <div class="card card-box">
                <div class="left-card">
                    <div class="icon-box bg-info"><i class="fas fa-ticket-alt"></i></div>
                    <h4><?php echo e(__('Open')); ?> <span><?php echo e(__('Tickets')); ?></span></h4>
                </div>
                <div class="number-icon"><?php echo e($open_ticket); ?></div>
            </div>
            <img src="<?php echo e(asset('assets/img/dot-icon.png')); ?>" class="dotted-icon">
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6">
            <div class="card card-box">
                <div class="left-card">
                    <div class="icon-box bg-success"><i class="fas fa-ticket-alt"></i></div>
                    <h4><?php echo e(__('Closed')); ?> <span><?php echo e(__('Tickets')); ?></span></h4>
                </div>
                <div class="number-icon"><?php echo e($close_ticket); ?></div>
            </div>
            <img src="<?php echo e(asset('assets/img/dot-icon.png')); ?>" class="dotted-icon">
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6">
            <div class="card card-box">
                <div class="left-card">
                    <div class="icon-box bg-gradient-teal"><i class="fas fa-users"></i></div>
                    <h4><?php echo e(__('Total')); ?> <span><?php echo e(__('Agents')); ?></span></h4>
                </div>
                <div class="number-icon"><?php echo e($agents); ?></div>
            </div>
            <img src="<?php echo e(asset('assets/img/dot-icon.png')); ?>" class="dotted-icon">
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h6 class="float-left">
                        <?php echo e(__('This Year Tickets')); ?>

                    </h6>
                </div>
                <div class="card-body p-0">
                    <div id="chartBar"></div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="float-left">
                        <?php echo e(__('Tickets by Category')); ?>

                    </h6>
                </div>
                <div class="card-body">
                    <div id="categoryPie"></div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('assets/js/apexcharts.min.js')); ?>"></script>
    <script>
        var chartBarOptions = {
            series: [
                {
                    name: '<?php echo e(__("Tickets")); ?>',
                    data: <?php echo json_encode(array_values($monthData)); ?>

                },
            ],
            chart: {
                type: 'line',
                dropShadow: {
                    enabled: true,
                    color: '#000',
                    top: 18,
                    left: 7,
                    blur: 10,
                    opacity: 0.2
                },
                toolbar: {
                    show: false
                }
            },
            colors: ['#2a3e66'],
            dataLabels: {
                enabled: true,
            },
            stroke: {
                curve: 'smooth'
            },
            title: {
                text: '',
                align: 'left'
            },
            grid: {
                borderColor: '#e7e7e7',
                row: {
                    colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                    opacity: 0.5
                },
            },
            markers: {
                size: 1
            },
            xaxis: {
                categories: <?php echo json_encode(array_keys($monthData)); ?>,
                title: {
                    text: '<?php echo e(__("Months")); ?>'
                }
            },
            yaxis: {
                title: {
                    text: '<?php echo e(__("Tickets")); ?>'
                },

            },
            legend: {
                position: 'top',
                horizontalAlign: 'right',
                floating: true,
                offsetY: -25,
                offsetX: -5
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
            }
        };

        setTimeout(function () {
            var arChart = new ApexCharts(document.querySelector("#chartBar"), chartBarOptions);
            arChart.render();
        }, 100);

        var categoryPieOptions = {
            series: <?php echo json_encode($chartData['value']); ?>,

            chart: {
                type: 'pie',
            },
            colors: <?php echo json_encode($chartData['color']); ?>,
            labels: <?php echo json_encode($chartData['name']); ?>,
            plotOptions: {
                pie: {
                    dataLabels: {
                        offset: -5
                    }
                }
            },
            title: {
                text: ""
            },
            dataLabels: {},
            legend: {
                position: 'top',
                align: 'end',
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
            }
        };
        setTimeout(function () {
            var categoryPieChart = new ApexCharts(document.querySelector("#categoryPie"), categoryPieOptions);
            categoryPieChart.render();
        }, 200);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/kevindupas/Documents/GitHub/support-ticket/resources/views/admin/dashboard/index.blade.php ENDPATH**/ ?>