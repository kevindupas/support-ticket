@extends('layouts.auth')
@section('page-title')
    {{ __('Create Ticket') }}
@endsection
@push('css-page')
    <link rel="stylesheet" href="{{ asset('assets/css/floating_chat.css') }}">
@endpush
@section('action-button')
    <div class="row w-100 pb-2">
        <div class="col-sm-12 col-md-2 col-lg-2">
            @if(env('CHAT_MODULE') == 'yes')
                <div class="fabs">
                    <div class="chat d-none">
                        <div class="chat_header">
                            <div class="chat_option">
                                <div class="header_img">
                                    <img src="{{asset(Storage::url('logo/white.png'))}}"/>
                                </div>
                                <span id="chat_head" class="position-absolute pt-2">{{ __('Agent') }}</span>
                            </div>
                        </div>
                        <div class="msg_chat">
                            <div id="chat_fullscreen" class="chat_conversion chat_converse">
                                <h3 class="text-center mt-5 pt-5">{{ __('No Message Found.!') }}</h3>
                            </div>
                            <div class="fab_field">
                                <textarea id="chatSend" name="chat_message" placeholder="{{ __('Send a message') }}" class="chat_field chat_message"></textarea>
                            </div>
                        </div>
                        <div class="msg_form">
                            <div id="chat_fullscreen" class="chat_conversion chat_converse">
                                <form class="pt-4" name="chat_form">
                                    <div class="form-group row mb-3 ml-md-2">
                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-icon-user">
                                                <span class="currency-icon"><i class="fas fa-envelope"></i></span>
                                                <input type="text" id="chat_email" placeholder="{{ __('Enter You Email') }}" name="name" class="form-control" autofocus>
                                            </div>
                                            <div class="invalid-feedback d-block e_error">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4 ml-md-2">
                                        <div class="col-sm-12 col-md-7">
                                            <button class="btn-submit" id="chat_frm_submit" type="button"><span>{{ __('Start Chat') }}</span></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <a id="prime" class="fab"><i class="prime fas fa-envelope text-white"></i></a>
                </div>
            @endif
        </div>
        <div class="col-sm-12 col-md-10 col-lg-10 text-right">
            <a href="{{route('faq')}}" class="btn-submit">{{ __('FAQ') }}</a>
            <a href="{{route('login')}}" class="btn-submit">{{ __('Agent Login') }}</a>
            <a href="{{route('search')}}" class="btn-submit">{{ __('Search Ticket') }}</a>
        </div>
    </div>
@endsection
@section('content')
    <div class="col-lg-12 col-md-12">
        <div class="card bg-secondary border-0 mt-6">
            <div class="card-body px-lg-5 py-lg-5">
                <div class="text-center text-muted mb-4">
                    <h2 class="mb-3 text-18">{{ __('Create Ticket') }}</h2>
                </div>
                @if(Session::has('create_ticket'))
                    <div class="alert alert-success">
                        <p>{!! session('create_ticket') !!}</p>
                    </div>
                @endif
                <form method="post" action="{{route('home.store')}}" class="create-form" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        @if(!$customFields->isEmpty())
                            @include('admin.customFields.formBuilder')
                        @endif

                        @if(env('RECAPTCHA_MODULE') == 'yes')
                            <div class="form-group col-lg-12 col-md-12">
                                {!! NoCaptcha::display() !!}
                                @error('g-recaptcha-response')
                                <span class="small text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        @endif
                    </div>
                    <div class="mt-3 text-center">
                        <input type="hidden" name="status" value="In Progress"/>
                        <button class="btn-submit mt-2">{{ __('Create Ticket') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @if(env('RECAPTCHA_MODULE') == 'yes')
        {!! NoCaptcha::renderJs() !!}
    @endif

    <script src="//cdn.ckeditor.com/4.12.1/basic/ckeditor.js"></script>
    <script src="{{ asset('assets/js/editorplaceholder.js') }}"></script>
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
                        return "{{ __('No result found') }}";
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
    @if(env('CHAT_MODULE') == 'yes')
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
                    url: '{{ route('chat_form.store') }}',
                    data: {
                        "_token": '{{ csrf_token() }}',
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
                            "_token": '{{ csrf_token() }}',
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
                    url: "{{ route('get_message') }}",
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

                    var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
                        cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
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
    @endif
@endpush
