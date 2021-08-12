@extends('layouts.admin')

@section('page-title')
    {{ __('Manage Tickets') }}
@endsection

@section('multiple-action-button')
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6 pt-lg-3 pt-xl-2">
        <select class="select2" id="projects" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
            <option value="{{route('admin.tickets.index')}}">{{__('All Tickets')}}</option>
            <option value="{{route('admin.tickets.index', 'in-progress')}}" @if($status == 'in-progress') selected @endif>{{__('In Progress')}}</option>
            <option value="{{route('admin.tickets.index', 'on-hold')}}" @if($status == 'on-hold') selected @endif>{{__('On Hold')}}</option>
            <option value="{{route('admin.tickets.index', 'closed')}}" @if($status == 'closed') selected @endif>{{__('Closed')}}</option>
        </select>
    </div>
    @can('create-tickets')
        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-6 col-6 pt-lg-3 pt-xl-2">
            <a href="{{route('admin.tickets.create')}}" class="btn btn-xs btn-white btn-icon-only width-auto">{{ __('Add') }}</a>
        </div>
    @endcan
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12">
            @if(session()->has('ticket_id') || session()->has('smtp_error'))
                <div class="alert alert-info">
                    @if(session()->has('ticket_id'))
                        {!! Session::get('ticket_id') !!}
                        {{ Session::forget('ticket_id') }}
                    @endif
                    @if(session()->has('smtp_error'))
                        {!! Session::get('smtp_error') !!}
                        {{ Session::forget('smtp_error') }}
                    @endif
                </div>
            @endif
        </div>
        <div class="col-lg-12 col-md-12">
            <div class="card o-hidden mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="selection-datatable" class="table" width="100%">
                            <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>{{ __('Ticket ID') }}</th>
                                <th class="w-10">{{ __('Name') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Subject') }}</th>
                                <th>{{ __('Category') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Created') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tickets as $index => $ticket)
                                <tr>
                                    <th scope="row">{{++$index}}</th>
                                    <td class="Id sorting_1">
                                        <a href="{{route('admin.tickets.edit',$ticket->id)}}">
                                            {{$ticket->ticket_id}}
                                        </a>
                                    </td>
                                    <td><span class="white-space">{{$ticket->name}}</span></td>
                                    <td>{{$ticket->email}}</td>
                                    <td><span class="white-space">{{$ticket->subject}}</span></td>
                                    <td><span class="badge badge-white" style="background: {{$ticket->color}};">{{$ticket->category_name}}</span></td>
                                    <td><span class="badge @if($ticket->status == 'In Progress')badge-warning @elseif($ticket->status == 'On Hold') badge-danger @else badge-success @endif">{{__($ticket->status)}}</span></td>
                                    <td>{{$ticket->created_at->diffForHumans()}}</td>
                                    <td>
                                        @can('reply-tickets')
                                            <a href="{{ route('admin.tickets.edit', $ticket->id) }}" class="edit-icon" title="{{ __('Reply') }}"><i class="fas fa-reply"></i></a>
                                        @endcan
                                        @can('edit-tickets')
                                            <a href="#" class="delete-icon" title="{{ __('Delete') }}" data-confirm="{{ __('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?') }}" data-confirm-yes="document.getElementById('user-form-{{$ticket->id}}').submit();"><i class="fas fa-trash"></i></a>
                                            <form method="post" id="user-form-{{$ticket->id}}" action="{{route('admin.tickets.destroy',$ticket->id)}}">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
