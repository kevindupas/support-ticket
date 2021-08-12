@extends('layouts.admin')

@section('page-title')
    {{ __('Manage Languages') }}
@endsection

@section('multiple-action-button')
    <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6 pt-lg-3 pt-xl-2">
        <div class="all-button-box mb-3">
            <a href="#" class="btn btn-xs btn-white btn-icon-only width-auto" data-ajax-popup="true" data-size="md" data-title="{{ __('Create Language') }}" data-url="{{route('admin.lang.create')}}">
                {{ __('Create') }}
            </a>
        </div>
    </div>
    @if($lang != (env('DEFAULT_LANG') ?? 'en'))
        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6 pt-lg-3 pt-xl-2">
            <div class="all-button-box mb-3">
                <a href="#" class="btn btn-xs btn-white btn-icon-only width-auto bg-red" data-toggle="tooltip" data-original-title="{{__('Delete This Language')}}" data-confirm="{{__('Are You Sure? | Do you want to continue?')}}" data-confirm-yes="document.getElementById('delete-form-{{$lang}}').submit();">{{__('Delete')}}</a>
                {!! Form::open(['method' => 'DELETE', 'route' => ['admin.lang.destroy', $lang],'id'=>'delete-form-'.$lang]) !!}
                {!! Form::close() !!}
            </div>
        </div>
    @endif
@endsection

@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            @foreach($user->languages() as $code)
                                <a href="{{route('admin.lang.index',$code)}}" class="nav-link text-sm my-1 font-weight-bold @if($code == $lang) active @endif">
                                    <i class="d-lg-none d-block mr-1"></i>
                                    <span class="d-none d-lg-block">{{Str::upper($code)}}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-body">

                        <ul class="nav nav-tabs my-4">
                            <li>
                                <a data-toggle="tab" href="#labels" class="active">{{__('Labels')}}</a>
                            </li>
                            <li class="annual-billing">
                                <a data-toggle="tab" href="#messages" class="">{{__('Messages')}} </a>
                            </li>
                        </ul>
                        <form method="post" action="{{route('admin.lang.store.data',[$lang])}}">
                            @csrf
                            <div class="tab-content">
                                <div class="tab-pane active" id="labels">
                                    <div class="row">
                                        @foreach($arrLabel as $label => $value)
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-control-label text-dark">{{$label}}</label>
                                                    <input type="text" class="form-control" name="label[{{$label}}]" value="{{$value}}">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="tab-pane" id="messages">
                                    @foreach($arrMessage as $fileName => $fileValue)
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <h6>{{ucfirst($fileName)}}</h6>
                                            </div>
                                            @foreach($fileValue as $label => $value)
                                                @if(is_array($value))
                                                    @foreach($value as $label2 => $value2)
                                                        @if(is_array($value2))
                                                            @foreach($value2 as $label3 => $value3)
                                                                @if(is_array($value3))
                                                                    @foreach($value3 as $label4 => $value4)
                                                                        @if(is_array($value4))
                                                                            @foreach($value4 as $label5 => $value5)
                                                                                <div class="col-lg-6">
                                                                                    <div class="form-group mb-3">
                                                                                        <label class="form-control-label text-dark">{{$fileName}}.{{$label}}.{{$label2}}.{{$label3}}.{{$label4}}.{{$label5}}</label>
                                                                                        <input type="text" class="form-control" name="message[{{$fileName}}][{{$label}}][{{$label2}}][{{$label3}}][{{$label4}}][{{$label5}}]" value="{{$value5}}">
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach
                                                                        @else
                                                                            <div class="col-lg-6">
                                                                                <div class="form-group mb-3">
                                                                                    <label class="form-control-label text-dark">{{$fileName}}.{{$label}}.{{$label2}}.{{$label3}}.{{$label4}}</label>
                                                                                    <input type="text" class="form-control" name="message[{{$fileName}}][{{$label}}][{{$label2}}][{{$label3}}][{{$label4}}]" value="{{$value4}}">
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    @endforeach
                                                                @else
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group mb-3">
                                                                            <label class="form-control-label text-dark">{{$fileName}}.{{$label}}.{{$label2}}.{{$label3}}</label>
                                                                            <input type="text" class="form-control" name="message[{{$fileName}}][{{$label}}][{{$label2}}][{{$label3}}]" value="{{$value3}}">
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            <div class="col-lg-6">
                                                                <div class="form-group mb-3">
                                                                    <label class="form-control-label text-dark">{{$fileName}}.{{$label}}.{{$label2}}</label>
                                                                    <input type="text" class="form-control" name="message[{{$fileName}}][{{$label}}][{{$label2}}]" value="{{$value2}}">
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-3">
                                                            <label class="form-control-label text-dark">{{$fileName}}.{{$label}}</label>
                                                            <input type="text" class="form-control" name="message[{{$fileName}}][{{$label}}]" value="{{$value}}">
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <input type="submit" value="{{__('Save')}}" class="btn-create badge-blue">
                        </form>
                    </div>
                </div> <!-- end card-->
            </div>
        </div>
    </div>

@endsection
