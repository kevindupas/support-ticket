@extends('layouts.admin')

@section('page-title')
    {{ __('Create Category') }}
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/jscolor.js') }}"></script>
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" class="needs-validation" action="{{route('admin.category.store')}}">
                        @csrf
                        <div class="form-group row mb-4">
                            <label class="col-form-label form-control-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Name') }}</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" placeholder="{{ __('Name of the Category') }}" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" required>
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label form-control-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Color') }}</label>
                            <div class="col-sm-12 col-md-1">
                                <input name="color" class="jscolor form-control {{ $errors->has('color') ? ' is-invalid' : '' }}" value="#255ff7">
                                <div class="invalid-feedback">
                                    {{ $errors->first('color') }}
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label form-control-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                                <button class="btn-submit"><span>{{ __('Add') }}</span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
