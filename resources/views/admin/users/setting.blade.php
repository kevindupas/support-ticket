@extends('layouts.admin')

@section('page-title')
    {{ __('Site Settings ') }}
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="nav-tabs border-bottom-0">
                <div class="col-lg-12 our-system">
                    <div class="row">
                        <ul class="nav nav-tabs my-4">
                            <li>
                                <a data-toggle="tab" href="#site-settings" class="active">{{__('Site Setting')}}</a>
                            </li>
                            <li class="annual-billing">
                                <a data-toggle="tab" href="#email-settings" class="">{{__('Email Setting')}} </a>
                            </li>
                            <li class="annual-billing">
                                <a data-toggle="tab" href="#pusher-settings" class="">{{__('Pusher Setting')}} </a>
                            </li>
                            <li class="annual-billing">
                                <a data-toggle="tab" href="#recaptcha-settings" class="">{{__('ReCaptcha Setting')}} </a>
                            </li>
                            <li class="annual-billing">
                                <a data-toggle="tab" href="#custom-fields-settings" class="">{{__('Ticket Fields')}} </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tab-content">
                    <div id="site-settings" class="tab-pane active">
                        <div class="col-md-12">
                            {{Form::open(['route'=>'admin.settings.store','method'=>'post', 'enctype' => 'multipart/form-data'])}}
                            <div class="row justify-content-between align-items-center">
                                <div class="col-md-6 col-sm-6 mb-3 mb-md-0">
                                    <h4 class="h4 font-weight-400 float-left pb-2">{{__('Site settings')}}</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-sm-3 col-md-3">
                                    <h4 class="small-title">{{__('Favicon')}}</h4>
                                    <div class="card setting-card setting-logo-box">
                                        <div class="logo-content">
                                            <img src="{{asset(Storage::url('logo/favicon.png'))}}" class="small-logo" alt=""/>
                                        </div>
                                        <div class="choose-file mt-5">
                                            <label for="favicon">
                                                <div>{{__('Choose file here')}}</div>
                                                <input type="file" class="form-control" name="favicon" id="small-favicon" data-filename="edit-favicon">
                                            </label>
                                            <p class="edit-favicon"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-3 col-md-3">
                                    <h4 class="small-title">{{__('Logo')}}</h4>
                                    <div class="card setting-card setting-logo-box">
                                        <div class="logo-content">
                                            <img src="{{asset(Storage::url('logo/logo.png'))}}" class="big-logo" alt=""/>
                                        </div>
                                        <div class="choose-file mt-5">
                                            <label for="logo">
                                                <div>{{__('Choose file here')}}</div>
                                                <input type="file" class="form-control" name="logo" id="logo" data-filename="edit-logo">
                                            </label>
                                            <p class="edit-logo"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-3 col-md-3">
                                    <h4 class="small-title">{{__('White Logo')}}</h4>
                                    <div class="card setting-card setting-logo-box">
                                        <div class="logo-content">
                                            <img src="{{asset(Storage::url('logo/white.png'))}}" class="big-logo" alt=""/>
                                        </div>
                                        <div class="choose-file mt-5">
                                            <label for="logo">
                                                <div>{{__('Choose file here')}}</div>
                                                <input type="file" class="form-control" name="white_logo" id="white_logo" data-filename="edit-white_logo">
                                            </label>
                                            <p class="edit-white_logo"></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-sm-3 col-md-3">
                                    <h4 class="small-title">{{__('Settings')}}</h4>
                                    <div class="card setting-card">
                                        <div class="form-group">
                                            {{Form::label('app_name',__('App Name'),array('class'=>'form-control-label')) }}
                                            {{Form::text('app_name',env('APP_NAME'),array('class'=>'form-control','placeholder'=>__('App Name')))}}
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('footer_text',__('Footer Text'),array('class'=>'form-control-label')) }}
                                            {{Form::text('footer_text',env('FOOTER_TEXT'),array('class'=>'form-control','placeholder'=>__('Footer Text')))}}
                                        </div>
                                        <div class="form-group">
                                            {{Form::label('default_language',__('Default Language'),array('class'=>'form-control-label')) }}
                                            <div class="changeLanguage">
                                                <select name="default_language" id="default_language" class="form-control select2">
                                                    @foreach($lang as $lan)
                                                        <option value="{{$lan}}" @if(env('DEFAULT_LANG') == $lan) selected @endif>
                                                            {{Str::upper($lan)}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-12 text-right">
                                    <input type="submit" value="{{__('Save Changes')}}" class="btn-submit">
                                </div>
                            </div>
                            {{Form::close()}}
                        </div>
                    </div>
                    <div id="email-settings" class="tab-pane">
                        <div class="col-md-12">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-md-6 col-sm-6 mb-3 mb-md-0">
                                    <h4 class="h4 font-weight-400 float-left pb-2">{{__('Email settings')}}</h4>
                                </div>
                            </div>
                            <div class="card p-3">
                                {{Form::open(['route'=>'admin.email.settings.store','method'=>'post'])}}
                                <div class="row">
                                    <div class="col-lg-3 col-md-6 col-sm-6 form-group">
                                        {{Form::label('mail_driver',__('Mail Driver'),array('class'=>'form-control-label')) }}
                                        {{Form::text('mail_driver',env('MAIL_DRIVER'),array('class'=>'form-control','placeholder'=>__('Enter Mail Driver')))}}
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 form-group">
                                        {{Form::label('mail_host',__('Mail Host'),array('class'=>'form-control-label')) }}
                                        {{Form::text('mail_host',env('MAIL_HOST'),array('class'=>'form-control ','placeholder'=>__('Enter Mail Driver')))}}
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 form-group">
                                        {{Form::label('mail_port',__('Mail Port'),array('class'=>'form-control-label')) }}
                                        {{Form::text('mail_port',env('MAIL_PORT'),array('class'=>'form-control','placeholder'=>__('Enter Mail Port')))}}
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 form-group">
                                        {{Form::label('mail_username',__('Mail Username'),array('class'=>'form-control-label')) }}
                                        {{Form::text('mail_username',env('MAIL_USERNAME'),array('class'=>'form-control','placeholder'=>__('Enter Mail Username')))}}
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 form-group">
                                        {{Form::label('mail_password',__('Mail Password'),array('class'=>'form-control-label')) }}
                                        {{Form::text('mail_password',env('MAIL_PASSWORD'),array('class'=>'form-control','placeholder'=>__('Enter Mail Password')))}}
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 form-group">
                                        {{Form::label('mail_encryption',__('Mail Encryption'),array('class'=>'form-control-label')) }}
                                        {{Form::text('mail_encryption',env('MAIL_ENCRYPTION'),array('class'=>'form-control','placeholder'=>__('Enter Mail Encryption')))}}
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 form-group">
                                        {{Form::label('mail_from_address',__('Mail From Address'),array('class'=>'form-control-label')) }}
                                        {{Form::text('mail_from_address',env('MAIL_FROM_ADDRESS'),array('class'=>'form-control','placeholder'=>__('Enter Mail From Address')))}}
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 form-group">
                                        {{Form::label('mail_from_name',__('Mail From Name'),array('class'=>'form-control-label')) }}
                                        {{Form::text('mail_from_name',env('MAIL_FROM_NAME'),array('class'=>'form-control','placeholder'=>__('Enter Mail Encryption')))}}
                                    </div>
                                </div>
                                <div class="col-lg-12 ">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <a href="#" data-url="{{route('admin.test.email')}}" data-title="{{__('Send Test Mail')}}" class="btn-submit text-white bg-info send_email">
                                                {{ __('Send Test Mail') }}
                                            </a>
                                        </div>
                                        <div class="form-group col-md-6 text-right">
                                            <input type="submit" value="{{__('Save Changes')}}" class="btn-submit text-white">
                                        </div>
                                    </div>
                                </div>
                                {{Form::close()}}
                            </div>
                        </div>
                    </div>
                    <div id="pusher-settings" class="tab-pane">
                        <div class="col-md-12">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-md-6 col-sm-6 mb-3 mb-md-0">
                                    <h4 class="h4 font-weight-400 float-left pb-2">{{ __('Pusher settings') }}</h4>
                                </div>
                            </div>
                            <div class="card p-3">
                                <form method="POST" action="{{ route('admin.pusher.settings.store') }}" accept-charset="UTF-8">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="enable_chat" id="enable_chat" value="yes" {{ env('CHAT_MODULE') == 'yes' ? 'checked="checked"' : '' }}>
                                                <label class="custom-control-label form-control-label" for="enable_chat">{{ __('Enable Chat') }}</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                            <label for="pusher_app_id" class="form-control-label">{{ __('Pusher App Id') }}</label>
                                            <input class="form-control" placeholder="Enter Pusher App Id" name="pusher_app_id" type="text" value="{{ env('PUSHER_APP_ID') }}" id="pusher_app_id">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                            <label for="pusher_app_key" class="form-control-label">{{ __('Pusher App Key') }}</label>
                                            <input class="form-control " placeholder="Enter Pusher App Key" name="pusher_app_key" type="text" value="{{ env('PUSHER_APP_KEY') }}" id="pusher_app_key">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                            <label for="pusher_app_secret" class="form-control-label">{{ __('Pusher App Secret') }}</label>
                                            <input class="form-control " placeholder="Enter Pusher App Secret" name="pusher_app_secret" type="text" value="{{ env('PUSHER_APP_SECRET') }}" id="pusher_app_secret">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                            <label for="pusher_app_cluster" class="form-control-label">{{ __('Pusher App Cluster') }}</label>
                                            <input class="form-control " placeholder="Enter Pusher App Cluster" name="pusher_app_cluster" type="text" value="{{ env('PUSHER_APP_CLUSTER') }}" id="pusher_app_cluster">
                                        </div>
                                    </div>
                                    <div class="col-lg-12  text-right">
                                        <input type="submit" value="{{ __('Save Changes') }}" class="btn-submit text-white">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div id="recaptcha-settings" class="tab-pane">
                        <div class="col-md-12">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-md-6 col-sm-6 mb-3 mb-md-0">
                                    <h4 class="h4 font-weight-400 float-left pb-2">{{ __('ReCaptcha settings') }}</h4>
                                </div>
                            </div>
                            <div class="card p-3">
                                <form method="POST" action="{{ route('admin.recaptcha.settings.store') }}" accept-charset="UTF-8">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="recaptcha_module" id="recaptcha_module" value="yes" {{ env('RECAPTCHA_MODULE') == 'yes' ? 'checked="checked"' : '' }}>
                                                <label class="custom-control-label form-control-label" for="recaptcha_module">
                                                    {{ __('Google Recaptcha') }}
                                                    <a href="https://phppot.com/php/how-to-get-google-recaptcha-site-and-secret-key/" target="_blank" class="text-blue">
                                                        <small>({{__('How to Get Google reCaptcha Site and Secret key')}})</small>
                                                    </a>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                            <label for="google_recaptcha_key" class="form-control-label">{{ __('Google Recaptcha Key') }}</label>
                                            <input class="form-control" placeholder="{{ __('Enter Google Recaptcha Key') }}" name="google_recaptcha_key" type="text" value="{{ env('NOCAPTCHA_SITEKEY') }}" id="google_recaptcha_key">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                            <label for="google_recaptcha_secret" class="form-control-label">{{ __('Google Recaptcha Secret') }}</label>
                                            <input class="form-control " placeholder="{{ __('Enter Google Recaptcha Secret') }}" name="google_recaptcha_secret" type="text" value="{{ env('NOCAPTCHA_SECRET') }}" id="google_recaptcha_secret">
                                        </div>
                                    </div>
                                    <div class="col-lg-12  text-right">
                                        <input type="submit" value="{{ __('Save Changes') }}" class="btn-submit text-white">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div id="custom-fields-settings" class="tab-pane">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card custom-fields" data-value="{{ json_encode($customFields) }}">
                                    <div class="card-header">
                                        <h6 class="float-left">
                                            {{ __('Ticket Fields') }}
                                            <small class="d-block mt-2">{{__('Drag fields to change order')}}</small>
                                        </h6>
                                        <button data-repeater-create type="button" class="btn-submit float-right">
                                            <i class="fas fa-plus mr-1"></i>{{__('Create')}}
                                        </button>
                                    </div>
                                    <div class="card-body">
                                        <form method="post" action="{{route('admin.custom-fields.store')}}">
                                            @csrf
                                            <table class="table table-hover" data-repeater-list="fields">
                                                <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>{{__('Labels')}}</th>
                                                    <th>{{__('Placeholder')}}</th>
                                                    <th>{{__('Type')}}</th>
                                                    <th>{{__('Require')}}</th>
                                                    <th>{{__('Width')}}</th>
                                                    <th class="text-right">{{__('Action')}}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr data-repeater-item>
                                                    <td><i class="fas fa-crosshairs sort-handler"></i></td>
                                                    <td>
                                                        <input type="hidden" name="id" id="id"/>
                                                        <input type="text" name="name" class="form-control mb-0" required/>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="placeholder" class="form-control mb-0" required/>
                                                    </td>
                                                    <td>
                                                        <select class="form-control select-field field_type" name="type">
                                                            @foreach(\App\CustomField::$fieldTypes as $key => $value)
                                                                <option value="{{ $key }}">{{ $value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td class="text-center">
                                                        <select class="form-control select-field field_type" name="is_required">
                                                            <option value="1">{{__('Yes')}}</option>
                                                            <option value="0">{{__('No')}}</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select class="form-control select-field" name="width">
                                                            <option value="3">25%</option>
                                                            <option value="4">33%</option>
                                                            <option value="6">50%</option>
                                                            <option value="8">66%</option>
                                                            <option value="12">100%</option>
                                                        </select>
                                                    </td>
                                                    <td class="text-right">
                                                        <a data-repeater-delete class="delete-icon"><i class="fas fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <div class="text-right p-4">
                                                <button class="btn-submit" type="submit">{{__('Save')}}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{asset('assets/js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('assets/js/repeater.js')}}"></script>

    <script>
        $(document).on("click", '.send_email', function (e) {
            e.preventDefault();
            var title = $(this).attr('data-title');

            var size = 'md';
            var url = $(this).attr('data-url');
            if (typeof url != 'undefined') {
                $("#commonModal .modal-title").html(title);
                $("#commonModal .modal-dialog").addClass('modal-' + size);
                $("#commonModal").modal('show');

                $.post(url, {
                    mail_driver: $("#mail_driver").val(),
                    mail_host: $("#mail_host").val(),
                    mail_port: $("#mail_port").val(),
                    mail_username: $("#mail_username").val(),
                    mail_password: $("#mail_password").val(),
                    mail_encryption: $("#mail_encryption").val(),
                    mail_from_address: $("#mail_from_address").val(),
                    mail_from_name: $("#mail_from_name").val(),
                }, function (data) {
                    $('#commonModal .modal-body .card-box').html(data);
                });
            }
        });
        $(document).on('submit', '#test_email', function (e) {
            e.preventDefault();
            $("#email_sending").show();
            var post = $(this).serialize();
            var url = $(this).attr('action');
            $.ajax({
                type: "post",
                url: url,
                data: post,
                cache: false,
                beforeSend: function () {
                    $('#test_email .btn-create').attr('disabled', 'disabled');
                },
                success: function (data) {
                    if (data.is_success) {
                        show_toastr('Success', data.message, 'success');
                    } else {
                        show_toastr('Error', data.message, 'error');
                    }
                    $("#email_sending").hide();
                },
                complete: function () {
                    $('#test_email .btn-create').removeAttr('disabled');
                },
            });
        });

        $(document).ready(function () {
            var $dragAndDrop = $("body .custom-fields tbody").sortable({
                handle: '.sort-handler'
            });

            var $repeater = $('.custom-fields').repeater({
                initEmpty: true,
                defaultValues: {},
                show: function () {
                    $(this).slideDown();
                    var eleId = $(this).find('input[type=hidden]').val();
                    if (eleId > 6 || eleId == '') {
                        $(this).find(".field_type option[value='file']").remove();
                        $(this).find(".field_type option[value='select']").remove();
                    }
                },
                hide: function (deleteElement) {
                    if (confirm('{{__('Are you sure ?')}}')) {
                        $(this).slideUp(deleteElement);
                    }
                },
                ready: function (setIndexes) {
                    $dragAndDrop.on('drop', setIndexes);
                },
                isFirstItemUndeletable: true
            });

            var value = $(".custom-fields").attr('data-value');
            if (typeof value != 'undefined' && value.length != 0) {
                value = JSON.parse(value);
                $repeater.setList(value);
            }

            $.each($('[data-repeater-item]'), function (index, val) {
                var elementId = $(this).find('input[type=hidden]').val();
                if (elementId <= 6) {
                    $.each($(this).find('.field_type'), function (index, val) {
                        $(this).prop('disabled', 'disabled');
                    });
                    $(this).find('.delete-icon').remove();
                }
            });
        });
    </script>
@endpush
