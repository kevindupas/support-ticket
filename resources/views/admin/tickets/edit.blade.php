@extends('layouts.admin')

@section('page-title')
    {{ __('Reply Ticket') }} - {{ $ticket->ticket_id }}
@endsection

@section('multiple-action-button')
    @can('edit-tickets')
        <a class="btn btn-xs btn-white btn-icon-only width-auto" type="button" data-toggle="collapse" href="#ticket-info">{{ __('Edit') }}</a>
    @endcan
@endsection

@section('content')
    @can('edit-tickets')
        {{ Form::model($ticket, array('route' => array('admin.tickets.update', $ticket->id), 'id' => 'ticket-info', 'class' => 'collapse mt-3', 'method' => 'PUT','enctype'=>'multipart/form-data')) }}
        <div class="row">
            <div class="col-md-8 col-xs-12">
                <div class="card">
                    <div class="card-header"><h6>{{ __('Ticket Information') }}</h6></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="require form-control-label">{{ __('Name') }}</label>
                                <input class="form-control {{(!empty($errors->first('name')) ? 'is-invalid' : '')}}" type="text" name="name" required="" value="{{ $ticket->name }}" placeholder="{{ __('Name') }}">
                                @if ($errors->has('name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label class="require form-control-label">{{ __('Email') }}</label>
                                <input class="form-control {{(!empty($errors->first('email')) ? 'is-invalid' : '')}}" type="email" name="email" required="" value="{{ $ticket->email }}" placeholder="{{ __('Email') }}">
                                @if ($errors->has('email'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="require form-control-label">{{ __('Category') }}</label>
                                <select class="form-control select2 {{(!empty($errors->first('category')) ? 'is-invalid' : '')}}" name="category" required="">
                                    <option value="">{{ __('Select Category') }}</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" @if($ticket->category == $category->id) selected @endif>{{$category->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('category'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('category') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label class="require form-control-label">{{ __('Status') }}</label>
                                <select class="form-control select2 {{(!empty($errors->first('status')) ? 'is-invalid' : '')}}" name="status" required="">
                                    <option value="In Progress" @if($ticket->status == 'In Progress') selected @endif>{{ __('In Progress') }}</option>
                                    <option value="On Hold" @if($ticket->status == 'On Hold') selected @endif>{{ __('On Hold') }}</option>
                                    <option value="Closed" @if($ticket->status == 'Closed') selected @endif>{{ __('Closed') }}</option>
                                </select>
                                @if ($errors->has('status'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('status') }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group col-md-12">
                                <label class="require form-control-label">{{ __('Subject') }}</label>
                                <input class="form-control {{(!empty($errors->first('subject')) ? 'is-invalid' : '')}}" type="text" name="subject" required="" value="{{ $ticket->subject }}" placeholder="{{ __('Subject') }}">
                                @if ($errors->has('subject'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('subject') }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group col-md-12">
                                <label class="require form-control-label">{{ __('Description') }}</label>
                                <textarea name="description" class="form-control ckdescription {{(!empty($errors->first('description')) ? 'is-invalid' : '')}}">{!! $ticket->description !!}</textarea>
                                @if ($errors->has('description'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('description') }}
                                    </div>
                                @endif
                            </div>

                            @if(!$customFields->isEmpty())
                                @include('admin.customFields.formBuilder')
                            @endif
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <a class="btn btn-submit gray-bg mr-2" href="{{route('admin.tickets.index')}}">{{ __('Cancel') }}</a>
                        <button class="btn btn-submit" type="submit">{{ __('Update') }}</button>
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
                    <div class="mx-4">
                        <p class="multiple_file_selection mb-0"></p>
                        <ul class="list-group list-group-flush w-100">
                            @php $attachments = json_decode($ticket->attachments); @endphp
                            @foreach($attachments as $index => $attachment)
                                <li class="list-group-item">
                                    {{$attachment}}
                                    <a download="" href="{{ asset(Storage::url('tickets/'.$ticket->ticket_id."/".$attachment)) }}" class="edit-icon" title="{{ __('Download') }}"><i class="fa fa-download"></i></a>
                                    <a class="text-danger ml-1" title="{{ __('Delete') }}" onclick="(confirm('Are You Sure?')?(document.getElementById('user-form-{{$index}}').submit()):'');"><i class="nav-icon i-Close-Window font-weight-bold"></i></a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        {{ Form::close() }}

        @foreach($attachments as $index => $attachment)
            <form method="post" id="user-form-{{ $index }}" action="{{route('admin.tickets.attachment.destroy',[$ticket->id,$index])}}">
                @csrf
                @method('DELETE')
            </form>
        @endforeach
    @endcan
    <div class="row mt-3">
        <div class="col-md-8 col-xs-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h6>
                        <span class="text-left">
                            {{$ticket->name}} <small>({{$ticket->created_at->diffForHumans()}})</small>
                            <span class="d-block"><small>{{ $ticket->email }}</small></span>
                        </span>
                        </h6>
                        <small>
                        <span class="text-right">
                            {{ __('Status') }} : <span class="badge @if($ticket->status == 'In Progress')badge-warning @elseif($ticket->status == 'On Hold') badge-danger @else badge-success @endif">{{__($ticket->status)}}</span>
                        </span>
                            <span class="d-block">
                            {{ __('Category') }} : <span class="badge">{{ $ticket->tcategory ? $ticket->tcategory->name : '-' }}</span>
                        </span>
                        </small>
                    </div>
                    <div class="row">
                        @foreach($customFields as $field)
                            <div class="col-6">
                                <small>
                                    <span class="text-right">
                                        {{ $field->name }} : {{ (isset($ticket->customField[$field->id]) && !empty($ticket->customField[$field->id])) ? $ticket->customField[$field->id] : '-' }}
                                    </span>
                                </small>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="card-body">
                    <div>{!! $ticket->description !!}</div>
                    @php $attachments = json_decode($ticket->attachments); @endphp
                    @if(count($attachments))
                        <div class="m-1">
                            <h6>{{ __('Attachments') }} :</h6>
                            <ul class="list-group list-group-flush">
                                @foreach($attachments as $index => $attachment)
                                    <li class="list-group-item">
                                        {{$attachment}} <a download="" href="{{ asset(Storage::url('tickets/'.$ticket->ticket_id."/".$attachment)) }}" class="edit-icon py-1 ml-2" title="{{ __('Download') }}"><i class="fas fa-download"></i></a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>

            @foreach($ticket->conversions as $conversion)
                <div class="card">
                    <div class="card-header"><h6>{{$conversion->replyBy()->name}} <small>({{$conversion->created_at->diffForHumans()}})</small></h6></div>
                    <div class="card-body">
                        <div>{!! $conversion->description !!}</div>
                        @php $attachments = json_decode($conversion->attachments); @endphp
                        @if(count($attachments))
                            <div class="m-1">
                                <h6>{{ __('Attachments') }} :</h6>
                                <ul class="list-group list-group-flush">
                                    @foreach($attachments as $index => $attachment)
                                        <li class="list-group-item">
                                            {{$attachment}}<a download="" href="{{ asset(Storage::url('tickets/'.$ticket->ticket_id."/".$attachment))  }}" class="edit-icon py-1 ml-2" title="{{ __('Download') }}"><i class="fa fa-download"></i></a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        @can('reply-tickets')
            <div class="col-md-4 col-xs-12">
                <div class="card">
                    <div class="card-header"><h6>{{ __('Add Reply') }}</h6></div>
                    <form method="post" action="{{route('admin.conversion.store',$ticket->id)}}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">

                            <div class="form-group">
                                <label class="require form-control-label">{{ __('Description') }}</label>
                                <textarea name="reply_description" class="form-control ckdescription"></textarea>
                                <div class="invalid-feedback">
                                    {{ $errors->first('reply_description') }}
                                </div>
                            </div>
                            <div class="form-group file-group mb-5">
                                <label class="require form-control-label">{{ __('Attachments') }}</label>
                                <label class="form-control-label"><small>({{__('You can select multiple files')}})</small></label>
                                <div class="choose-file form-group">
                                    <label for="file" class="form-control-label">
                                        <div>{{ __('Choose File Here') }}</div>
                                        <input type="file" class="form-control {{ $errors->has('reply_attachments') ? ' is-invalid' : '' }}" multiple="" name="reply_attachments[]" id="file" data-filename="multiple_reply_file_selection">
                                        <div class="invalid-feedback">
                                            {{ $errors->first('reply_attachments') }}
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <p class="multiple_reply_file_selection"></p>
                        </div>

                        <div class="card-footer text-right">
                            <button class="btn-submit" type="submit">{{ __('Submit') }}</button>
                        </div>
                    </form>
                </div>
                <div class="card mt-4">
                    <div class="card-header"><h6>{{ __('Note') }}</h6></div>
                    <form method="post" action="{{route('admin.note.store',$ticket->id)}}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <textarea name="note" class="form-control ckdescription">{{$ticket->note}}</textarea>
                                <div class="invalid-feedback">
                                    {{ $errors->first('note') }}
                                </div>
                            </div>
                        </div>

                        <div class="card-footer text-right">
                            <button class="btn-submit" type="submit">{{ __('Add Note') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        @endcan
    </div>

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
