@extends('layouts.auth')
@section('page-title')
    {{ __('Search Your Ticket') }}
@endsection
@section('action-button')
    <div class="text-right my-5">
        <a href="{{route('faq')}}" class="btn-submit">{{ __('FAQ') }}</a>
        <a href="{{route('home')}}" class="btn-submit">{{ __('Create Ticket') }}</a>
    </div>
@endsection
@section('content')
    <div class="col-lg-5 col-md-7">
        <div class="card bg-secondary border-0 mb-0 mt-6">
            <div class="card-body px-lg-5 py-lg-5 ">
                <div class="text-center text-muted mb-4">
                    <h2 class="mb-3 text-18">{{ __('Search Your Ticket') }}</h2>
                </div>
                <form method="post">
                    @csrf
                    @if(session()->has('info'))
                        <div class="alert alert-danger">
                            {{ session()->get('info') }}
                        </div>
                    @endif
                    @if(session()->has('status'))
                        <div class="alert alert-info">
                            {{ session()->get('status') }}
                        </div>
                    @endif
                    <div class="form-group col-md-12">
                        <label for="ticket_id" class="form-control-label">{{ __('Ticket Number') }}</label>
                        <div class="form-icon-user">
                            <span class="prefix-icon"><i class="fas fa-search"></i></span>
                            <input type="number" class="form-control {{ $errors->has('ticket_id') ? 'is-invalid' : '' }}" min="0" id="ticket_id" name="ticket_id" placeholder="{{ __('Enter Ticket Number') }}" required="" value="{{old('ticket_id')}}" autofocus>
                            <div class="invalid-feedback d-block">
                                {{ $errors->first('ticket_id') }}
                            </div>
                        </div>
                    </div>
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
                    <div class="form-group col-md-12">
                        <button class="btn btn-rounded btn-submit btn-block">{{ __('Search') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
