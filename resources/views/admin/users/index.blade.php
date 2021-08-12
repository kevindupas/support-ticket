@extends('layouts.admin')

@section('page-title')
    {{ __('Manage Users') }}
@endsection

@section('multiple-action-button')
    @can('create-users')
        <a href="{{route('admin.users.create')}}" class="btn btn-xs btn-white btn-icon-only width-auto">{{ __('Add') }}</a>
    @endcan
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card o-hidden mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="selection-datatable" class="table dataTable-collapse text-center">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ __('Avatar') }}</th>
                                <th scope="col">{{ __('Name') }}</th>
                                <th scope="col">{{ __('Email') }}</th>
                                <th scope="col">{{ __('Role') }}</th>
                                <th scope="col">{{ __('Action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $index => $user)
                                <tr>
                                    <th scope="row">{{++$index}}</th>
                                    <td><img alt="image" class="rounded-circle m-0 avatar-sm-table" width="35" src="{{$user->avatarlink}}"></td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td><span class="badge badge-blue">{{$user->roles[0]->name}}</span></td>
                                    <td>
                                        @can('edit-users')
                                            <a href="{{ route('admin.users.edit', $user->id) }}" class="edit-icon" title="{{ __('Edit') }}"><i class="fas fa-pencil-alt"></i></a>
                                        @endcan
                                        @can('delete-users')
                                            <a href="#" class="delete-icon" title="{{ __('Delete') }}" data-confirm="{{ __('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?') }}" data-confirm-yes="document.getElementById('delete-form-{{$user->id}}').submit();"><i class="fas fa-trash"></i></a>
                                            <form id="delete-form-{{ $user->id }}" action="{{ route('admin.users.destroy',$user->id) }}" method="POST" style="display: none;">
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
