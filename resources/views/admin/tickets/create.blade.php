@extends('layouts.admin')

@section('page-title')
    {{ __('Create Ticket') }}
@endsection

@section('content')
    <form action="{{route('admin.tickets.store')}}" class="mt-3" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-8 col-xs-12">
                <div class="card">
                    <div class="card-header"><h6>{{ __('Ticket Information') }}</h6></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="require form-control-label">{{ __('Name') }}</label>
                                <input class="form-control {{(!empty($errors->first('name')) ? 'is-invalid' : '')}}" type="text" name="name" required="" placeholder="{{ __('Name') }}">
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="require form-control-label">{{ __('Email') }}</label>
                                <input class="form-control {{(!empty($errors->first('email')) ? 'is-invalid' : '')}}" type="email" name="email" required="" placeholder="{{ __('Email') }}">
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="require form-control-label">{{ __('Category') }}</label>
                                <select class="form-control select2 {{(!empty($errors->first('category')) ? 'is-invalid' : '')}}" name="category" required="">
                                    <option value="">{{ __('Select Category') }}</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    {{ $errors->first('category') }}
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="require form-control-label">{{ __('Status') }}</label>
                                <select class="form-control select2 {{(!empty($errors->first('status')) ? 'is-invalid' : '')}}" name="status" required="">
                                    <option value="In Progress">{{ __('In Progress') }}</option>
                                    <option value="On Hold">{{ __('On Hold') }}</option>
                                    <option value="Closed">{{ __('Closed') }}</option>
                                </select>
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <label class="require form-control-label">{{ __('Subject') }}</label>
                                <input class="form-control {{(!empty($errors->first('subject')) ? 'is-invalid' : '')}}" type="text" name="subject" required="" placeholder="{{ __('Subject') }}">
                                <div class="invalid-feedback">
                                    {{ $errors->first('subject') }}
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <label class="require form-control-label">{{ __('Description') }}</label>
                                <textarea name="description" class="form-control ckdescription {{(!empty($errors->first('description')) ? 'is-invalid' : '')}}"></textarea>
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            </div>
                            @if(!$customFields->isEmpty())
                                @include('admin.customFields.formBuilder')
                            @endif
                        </div>

                    </div>

                    <div class="card-footer text-right">
                        <a class="btn btn-submit gray-bg mr-2" href="{{route('admin.tickets.index')}}">{{ __('Cancel') }}</a>
                        <button class="btn btn-submit" type="submit">{{ __('Submit') }}</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xs-12">
                <div class="card">
                    <div class="card-header">
                        <h6>{{ __('Attachments') }}<small class="d-block">({{__('You can select multiple files')}})</small></h6>
                    </div>
                    <div class="card-body">
                        <div class="choose-file form-group">
                            <label for="file" class="form-control-label">
                                <div>{{ __('Choose File Here') }}</div>
                                <input type="file" class="form-control {{ $errors->has('attachments') ? ' is-invalid' : '' }}" multiple="" name="attachments[]" id="file" data-filename="multiple_file_selection">
                                <div class="invalid-feedback">
                                    {{ $errors->first('attachments') }}
                                </div>
                            </label>
                        </div>
                    </div>
                    <p class="multiple_file_selection mx-4"></p>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
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
    </script>
@endpush

