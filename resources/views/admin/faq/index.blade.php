@extends('layouts.admin')

@section('page-title')
    {{ __('Manage Faq') }}
@endsection



@section('multiple-action-button')
    @can('create-faq')
        <a href="{{route('admin.faq.create')}}" class="btn btn-xs btn-white btn-icon-only width-auto">{{ __('Add') }}</a>
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
                                <th>#</th>
                                <th class="w-25">{{ __('Title') }}</th>
                                <th>{{ __('Description') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($faqs as $index => $faq)
                                <tr>
                                    <th scope="row">{{++$index}}</th>
                                    <td><span class="font-weight-bold white-space">{{$faq->title}}</span></td>
                                    <td class="faq_desc">{!! $faq->description !!}</td>
                                    <td>
                                        @can('edit-faq')
                                            <a class="edit-icon" title="{{ __('Edit') }}" href="{{route('admin.faq.edit',$faq->id)}}"><i class="fa fa-pen font-weight-bold"></i></a>
                                        @endcan
                                        @can('edit-faq')
                                            <a href="#" class="delete-icon" title="{{ __('Delete') }}" data-confirm="{{ __('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?') }}" data-confirm-yes="document.getElementById('user-form-{{$faq->id}}').submit();"><i class="fas fa-trash"></i></a>
                                            <form method="post" id="user-form-{{$faq->id}}" action="{{route('admin.faq.destroy',$faq->id)}}">
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
