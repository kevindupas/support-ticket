@extends('layouts.admin')

@section('page-title')
    {{ __('Manage Category') }}
@endsection

@section('multiple-action-button')
    @can('create-category')
        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-6 col-6 pt-lg-3 pt-xl-2">
            <a href="{{route('admin.category.create')}}" class="btn btn-xs btn-white btn-icon-only width-auto">{{ __('Add') }}</a>
        </div>
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
                                <th scope="col">{{ __('Name') }}</th>
                                <th scope="col">{{ __('Color') }}</th>
                                <th scope="col">{{ __('Action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $index => $category)
                                <tr>
                                    <th scope="row">{{++$index}}</th>
                                    <td>{{$category->name}}</td>
                                    <td><span class="badge" style="background: {{$category->color}}">&nbsp;&nbsp;&nbsp;</span></td>
                                    <td>
                                        @can('edit-category')
                                            <a href="{{ route('admin.category.edit', $category->id) }}" class="edit-icon" title="{{ __('Edit') }}"><i class="fas fa-pencil-alt"></i></a>
                                        @endcan
                                        @can('delete-category')
                                            <a href="#" class="delete-icon" title="{{ __('Delete') }}" data-confirm="{{ __('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?') }}" data-confirm-yes="document.getElementById('delete-form-{{$category->id}}').submit();"><i class="fas fa-trash"></i></a>
                                            <form id="delete-form-{{ $category->id }}" action="{{ route('admin.category.destroy',$category->id) }}" method="POST" style="display: none;">
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
