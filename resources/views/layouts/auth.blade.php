<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('page-title') - {{ config('app.name', 'Taskly') }}
    </title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset(Storage::url('logo/favicon.png'))}}">
    <!-- Font Awesome 5 -->
    <link rel="stylesheet" href="{{ asset('assets/libs/@fontawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/select2/dist/css/select2.min.css') }}">

    @stack('css-page')

    <link rel="stylesheet" href="{{ asset('assets/css/site.css') }}" id="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/stylesheet.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/ac.css') }}">
</head>

<body class="bg-gradient-primary">
<div class="main-content">
    <div class="container">
        <div class="row justify-content-center">
            @yield('content')
        </div>
    </div>
</div>
<footer class="py-2 footer-auto-bottom1" id="footer-main">
    <div class="container-fluid">
        <div class="row align-items-center justify-content-xl-between">
            <div class="col-lg-12 col-xl-12">
                @yield('action-button')
            </div>
        </div>
    </div>
</footer>

<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/site.core.js') }}"></script>
<script src="{{ asset('assets/libs/select2/dist/js/select2.min.js') }}"></script>
<script src="https://js.pusher.com/5.0/pusher.min.js"></script>

@stack('scripts')

{{-- Toaster Checker --}}
@if($message = Session::get('success'))
    <script>show_toastr('Success', '{!! $message !!}', 'success');</script>
@endif
@if($message = Session::get('error'))
    <script>show_toastr('Error', '{!! $message !!}', 'error');</script>
@endif

</body>
</html>
