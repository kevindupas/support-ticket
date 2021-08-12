@extends('layouts.auth')
@section('page-title')
    {{ __('Ticket') }} - {{$ticket->ticket_id}}
@endsection
@section('style')
    <style>


        @media (max-width: 767px) {
            .auth-layout-wrap .auth-content {
                min-width: 100%;
            }
        }

        @media (min-width: 768px) {
            .auth-layout-wrap .auth-content {
                min-width: 90%;
            }
        }

        @media (min-width: 1024px) {
            .auth-layout-wrap .auth-content {
                min-width: 50%;
            }
        }
    </style>
@endsection

@push('scripts')
    <script src="//cdn.ckeditor.com/4.12.1/basic/ckeditor.js"></script>
    <script src="{{ asset('assets/js/editorplaceholder.js') }}"></script>
    <script>
        CKEDITOR.replace('reply_description', {
            // contentsLangDirection: 'rtl',
            extraPlugins: 'editorplaceholder',
            editorplaceholder: '{{__('Start Text here..')}}'
        });
    </script>
@endpush


@section('action-button')
    <div class="text-right my-3">
        <a href="{{route('faq')}}" class="btn-submit">{{ __('FAQ') }}</a>
    </div>
@endsection

@section('content')
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card bg-secondary border-0 mb-0 mt-10">
            <div class="card-header">
                <h5>{{ __('Ticket') }} - {{$ticket->ticket_id}}</h5>
            </div>
            <div class="card-body">
                @csrf
                <div class="card">
                    <div class="card-header"><h6>{{$ticket->name}} <small>({{$ticket->created_at->diffForHumans()}})</small></h6></div>
                    <div class="card-body">
                        <div>{!! $ticket->description !!}</div>
                        @php
                            $attachments=json_decode($ticket->attachments);
                        @endphp
                        @if(count($attachments))
                            <div class="m-1">
                                <b>{{ __('Attachments') }} :</b>
                                <ul class="list-group list-group-flush">
                                    @foreach($attachments as $index => $attachment)
                                        <li class="list-group-item">
                                            {{$attachment}}<a download="" href="{{ asset(Storage::url('tickets/'.$ticket->ticket_id."/".$attachment)) }}" class="edit-icon py-1 ml-2" title="{{ __('Download') }}"><i class="fa fa-download"></i></a>
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
                            @php
                                $attachments=json_decode($conversion->attachments);
                            @endphp
                            @if(count($attachments))
                                <div class="m-1">
                                    <b>{{ __('Attachments') }} :</b>
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

                @if($ticket->status != 'Closed')
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="{{route('home.reply',$ticket->ticket_id)}}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label class="require form-control-label">{{ __('Description') }}</label>
                                        <textarea name="reply_description" class="form-control {{ $errors->has('reply_description') ? ' is-invalid' : '' }}">{{old('reply_description')}}</textarea>
                                        <div class="invalid-feedback">
                                            {{ $errors->first('reply_description') }}
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12 file-group">
                                        <label class="require form-control-label">{{ __('Attachments') }}</label>
                                        <label class="form-control-label"><small>({{__('You can select multiple files')}})</small></label>
                                        <div class="choose-file form-group">
                                            <label for="file" class="form-control-label">
                                                <div>{{ __('Choose File Here') }}</div>
                                                <input type="file" class="form-control {{ $errors->has('reply_attachments') ? 'is-invalid' : '' }}" multiple="" name="reply_attachments[]" id="file" data-filename="multiple_reply_file_selection">
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('reply_attachments') }}
                                                </div>
                                            </label>
                                            <p class="multiple_reply_file_selection"></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <div class="text-center">
                                        <input type="hidden" name="status" value="In Progress"/>
                                        <button class="btn-submit mt-2">{{ __('Submit') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="card">
                        <div class="card-body">
                            <p class="text-blue font-weight-bold text-center mb-0">{{ __('Ticket is closed you cannot replay.') }}</p>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
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
@endpush
