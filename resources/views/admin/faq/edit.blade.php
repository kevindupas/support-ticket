@extends('layouts.admin')

@section('page-title')
    {{ __('Edit Faq') }} ({{ $faq->title }})
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{route('admin.faq.update',$faq->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="form-group row mb-4">
                            <label class="col-form-label form-control-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Title') }}</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" placeholder="{{ __('Title of the Faq') }}" name="title" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{ $faq->title }}" autofocus>
                                <div class="invalid-feedback">
                                    {{ $errors->first('title') }}
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label form-control-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Description') }}</label>
                            <div class="col-sm-12 col-md-7">
                                <textarea name="description" class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}">{{ $faq->description }}</textarea>
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label class="col-form-label form-control-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                                <button class="btn btn-submit"><span>{{ __('Update') }}</span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="//cdn.ckeditor.com/4.12.1/basic/ckeditor.js"></script>
    <script src="{{ asset('assets/js/editorplaceholder.js') }}"></script>
    <script>
        CKEDITOR.replace('description', {
            // contentsLangDirection: 'rtl',
            extraPlugins: 'editorplaceholder',
            editorplaceholder: '{{__('Start Text here..')}}'
        });
    </script>
@endpush

