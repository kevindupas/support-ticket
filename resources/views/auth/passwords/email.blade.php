@extends('layouts.auth')
@section('page-title')
    {{ __('Reset Password') }}
@endsection
@section('action-button')
    <div class="text-right my-5">
        <a href="{{route('faq')}}" class="btn-submit">{{ __('FAQ') }}</a>
        <a href="{{route('home')}}" class="btn-submit">{{ __('Create Ticket') }}</a>
    </div>
@endsection
@section('content')
    <div class="col-lg-5 col-md-7">
        <a class="navbar-brand d-flex justify-content-center mt-10 mb-4" href="#">
            <img src="{{ asset(Storage::url('logo/logo.png')) }}" class="auth-logo" alt="logo">
        </a>
        <div class="card bg-secondary border-0 mb-0">
            <div class="card-body px-lg-5 py-lg-5">
                <div class="text-center text-muted mb-4">
                    <h2 class="mb-3 text-18">{{ __('Forgot Password') }}</h2>
                </div>
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    @if(session()->has('info'))
                        <div class="alert alert-primary">
                            {{ session()->get('info') }}
                        </div>
                    @endif
                    @if(session()->has('status'))
                        <div class="alert alert-info">
                            {{ session()->get('status') }}
                        </div>
                    @endif
                    <div class="form-group col-md-12">
                        <label for="email" class="form-control-label">{{ __('Email') }}</label>
                        <div class="form-icon-user">
                            <span class="prefix-icon"><i class="fas fa-envelope"></i></span>
                            <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email" placeholder="{{ __('Enter Email') }}" required="" value="{{old('email')}}">
                            <div class="invalid-feedback d-block">
                                {{ $errors->first('email') }}
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-submit mt-3">{{ __('Reset Password') }}</button>
                        <a href="{{ route('login') }}" class="d-block mt-2"><small>{{ __('Sign In') }}</small></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
