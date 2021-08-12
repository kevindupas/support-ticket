<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Create Ticket')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('css-page'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/floating_chat.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('action-button'); ?>
    <div class="row w-100 pb-2">
        <div class="col-sm-12 col-md-2 col-lg-2">
            <?php if(env('CHAT_MODULE') == 'yes'): ?>
                <div class="fabs">
                    <div class="chat d-none">
                        <div class="chat_header">
                            <div class="chat_option">
                                <div class="header_img">
                                    <img src="<?php echo e(asset(Storage::url('logo/white.png'))); ?>"/>
                                </div>
                                <span id="chat_head" class="position-absolute pt-2"><?php echo e(__('Agent')); ?></span>
                            </div>
                        </div>
                        <div class="msg_chat">
                            <div id="chat_fullscreen" class="chat_conversion chat_converse">
                                <h3 class="text-center mt-5 pt-5"><?php echo e(__('No Message Found.!')); ?></h3>
                            </div>
                            <div class="fab_field">
                                <textarea id="chatSend" name="chat_message" placeholder="<?php echo e(__('Send a message')); ?>" class="chat_field chat_message"></textarea>
                            </div>
                        </div>
                        <div class="msg_form">
                            <div id="chat_fullscreen" class="chat_conversion chat_converse">
                                <form class="pt-4" name="chat_form">
                                    <div class="form-group row mb-3 ml-md-2">
                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-icon-user">
                                                <span class="currency-icon"><i class="fas fa-envelope"></i></span>
                                                <input type="text" id="chat_email" placeholder="<?php echo e(__('Enter You Email')); ?>" name="name" class="form-control" autofocus>
                                            </div>
                                            <div class="invalid-feedback d-block e_error">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4 ml-md-2">
                                        <div class="col-sm-12 col-md-7">
                                            <button class="btn-submit" id="chat_frm_submit" type="button"><span><?php echo e(__('Start Chat')); ?></span></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <a id="prime" class="fab"><i class="prime fas fa-envelope text-white"></i></a>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-sm-12 col-md-10 col-lg-10 text-right">
            <a href="<?php echo e(route('faq')); ?>" class="btn-submit"><?php echo e(__('FAQ')); ?></a>
            <a href="<?php echo e(route('login')); ?>" class="btn-submit"><?php echo e(__('Agent Login')); ?></a>
            <a href="<?php echo e(route('search')); ?>" class="btn-submit"><?php echo e(__('Search Ticket')); ?></a>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-md-12">
        <div class="card bg-secondary border-0 mt-6">
            <div class="card-body px-lg-5 py-lg-5">
                <div class="text-center text-muted mb-4">
                    <h2 class="mb-3 text-18"><?php echo e(__('Create Ticket')); ?></h2>
                </div>
                <?php if(Session::has('create_ticket')): ?>
                    <div class="alert alert-success">
                        <p><?php echo session('create_ticket'); ?></p>
                    </div>
                <?php endif; ?>
                <form method="post" action="<?php echo e(route('home.store')); ?>" class="create-form" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <?php if(!$customFields->isEmpty()): ?>
                            <?php echo $__env->make('admin.customFields.formBuilder', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endif; ?>

                        <?php if(env('RECAPTCHA_MODULE') == 'yes'): ?>
                            <div class="form-group col-lg-12 col-md-12">
                                <?php echo NoCaptcha::display(); ?>

                                <?php $__errorArgs = ['g-recaptcha-response'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="small text-danger" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="mt-3 text-center">
                        <input type="hidden" name="status" value="In Progress"/>
                        <button class="btn-submit mt-2"><?php echo e(__('Create Ticket')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <?php if(env('RECAPTCHA_MODULE') == 'yes'): ?>
        <?php echo NoCaptcha::renderJs(); ?>

    <?php endif; ?>

    <script src="//cdn.ckeditor.com/4.12.1/basic/ckeditor.js"></script>
    <script src="<?php echo e(asset('assets/js/editorplaceholder.js')); ?>"></script>
    <script>
        $(document).ready(function () {
            $.each($('.ckdescription'), function (i, editor) {
                CKEDITOR.replace(editor, {
                    // contentsLangDirection: 'rtl',
                    extraPlugins: 'editorplaceholder',
                    editorplaceholder: editor.placeholder
                });
            });
        });

        if ($(".select2").length) {
            $('.select2').select2({
                "language": {
                    "noResults": function () {
                        return "<?php echo e(__('No result found')); ?>";
                    }
                },
            });
        }

        // for Choose file
        $(document).on('change', 'input[type=file]', function () {
            var names = '';
            var files = $('input[type=file]')[0].files;

            for (var i = 0; i < files.length; i++) {
                names += files[i].name + '<br>';
            }
            $('.' + $(this).attr('data-filename')).html(names);
        });
    </script>
    <?php if(env('CHAT_MODULE') == 'yes'): ?>
        <script>
            var old_chat_user = getCookie('chat_user');
            $('#prime').click(function () {
                if (old_chat_user != '') {
                    // has cookie
                    $('.msg_chat').removeClass('d-none');
                    $('.msg_form').removeClass('d-block');
                    $('.msg_chat').addClass('d-block');
                    $('.msg_form').addClass('d-none');

                    getMsg();
                } else {
                    // no cookie
                    $('.msg_chat').removeClass('d-block');
                    $('.msg_form').removeClass('d-none');
                    $('.msg_chat').addClass('d-none');
                    $('.msg_form').addClass('d-block');
                }
                toggleFab();
            });


            function setCookie(cname, cvalue, exdays) {
                var d = new Date();
                d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
                var expires = "expires=" + d.toUTCString();
                document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
            }

            function getCookie(cname) {
                var name = cname + "=";
                var ca = document.cookie.split(';');
                for (var i = 0; i < ca.length; i++) {
                    var c = ca[i];
                    while (c.charAt(0) == ' ') {
                        c = c.substring(1);
                    }
                    if (c.indexOf(name) == 0) {
                        return c.substring(name.length, c.length);
                    }
                }
                return "";
            }

            //Toggle chat and links
            function toggleFab() {
                $('.chat').toggleClass('is-visible');
                $('.fab').toggleClass('is-visible');
                $('.chat').toggleClass('d-none');
            }

            // Email Form Submit
            $('#chat_frm_submit').on('click', function () {
                var email = $('#chat_email').val();
                $.ajax({
                    type: 'POST',
                    url: '<?php echo e(route('chat_form.store')); ?>',
                    data: {
                        "_token": '<?php echo e(csrf_token()); ?>',
                        email: email,
                    },
                    success: function (data) {
                        if (data != 'false') {
                            setCookie('chat_user', JSON.stringify(data), 30);
                            $('.msg_chat').removeClass('d-none').addClass('d-block');
                            $('.msg_form').removeClass('d-block').addClass('d-none');
                        } else if (data == 'false') {
                            $('.e_error').html('Something went wrong.!');
                        }
                    }
                });
            });
            // End Email Form Submit

            $(document).on('keyup', '#chatSend', function (e) {
                var message = $(this).val();
                if (e.keyCode == 13 && message != '') {
                    $(this).val('');

                    $.ajax({
                        type: "post",
                        url: "floating_message",
                        data: {
                            "_token": '<?php echo e(csrf_token()); ?>',
                            message: message,
                        },
                        cache: false,
                        success: function (data) {
                        },
                        error: function (jqXHR, status, err) {
                        },
                        complete: function () {
                            getMsg();
                        }
                    })
                }
            });

            // make a function to scroll down auto
            function scrollToBottomFunc() {
                $('#chat_fullscreen').animate({
                    scrollTop: $('#chat_fullscreen').get(0).scrollHeight
                }, 10);
            }

            // get Message when page is load or when msg successfully send
            function getMsg() {
                $.ajax({
                    type: "get",
                    url: "<?php echo e(route('get_message')); ?>",
                    cache: false,
                    success: function (data) {
                        $('#chat_fullscreen').html(data);
                        scrollToBottomFunc();
                    }
                });
            }

            $(document).ready(function () {

                if (getCookie('chat_user') != '') {
                    var k = JSON.parse(getCookie('chat_user'));
                    var receiver_id = k.id;
                    var my_id = 0;

                    // Enable pusher logging - don't include this in production
                    Pusher.logToConsole = false;

                    var pusher = new Pusher('<?php echo e(env('PUSHER_APP_KEY')); ?>', {
                        cluster: '<?php echo e(env('PUSHER_APP_CLUSTER')); ?>',
                        forceTLS: true
                    });

                    var channel = pusher.subscribe('my-channel');
                    channel.bind('my-event', function (data) {
                        /*alert(JSON.stringify(data));*/
                        if (my_id == data.from && receiver_id == data.to) {
                            getMsg();
                        }
                    });
                }
            });
        </script>
    <?php endif; ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/kevindupas/Documents/GitHub/support-ticket/resources/views/home.blade.php ENDPATH**/ ?>