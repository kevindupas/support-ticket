@extends('layouts.admin')

@section('page-title')
    {{ __('Edit Profile') }} ({{ $user->name }})
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{route('admin.users.update',$user->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group row mb-4">
                            <label class="col-form-label form-control-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Name') }}</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" placeholder="{{ __('Full name of the user') }}" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ $user->name }}" autofocus>
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label form-control-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Email') }}</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="email" placeholder="{{ __('Email address (should be unique)') }}" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ $user->email }}">
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            </div>
                        </div>

                        @if($userObj->id != $user->id)
                            <div class="form-group row mb-4">
                                <label class="col-form-label form-control-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Role') }}</label>
                                <div class="col-sm-12 col-md-7">
                                    <select class="form-control select2" name="role">
                                        @foreach($roles as $role)
                                            <option value="{{$role->id}}" @if($user->roles[0]->id == $role->id) selected @endif>{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif

                        <div class="form-group row mb-4">
                            <label class="col-form-label form-control-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Password') }}</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="password" name="password" autocomplete="new-password" placeholder="{{ __('Set an account password') }}" class="form-control {{ $errors->has('password') ? ' is-invalid': '' }}">
                                <div class="invalid-feedback">
                                    {{ $errors->first('password') }}
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label form-control-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Confirm Password') }}</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="password" name="password_confirmation" placeholder="{{ __('Confirm account password') }}" autocomplete="new-password" class="form-control {{ $errors->has('password_confirmation') ? ' is-invalid': '' }}">
                                <div class="invalid-feedback">
                                    {{ $errors->first('password_confirmation') }}
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label form-control-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Avatar') }}</label>
                            <div class="col-sm-12 col-md-7">
                                <div class="form-group col-lg-12 col-md-12">
                                    <label class="form-control-label">{{ __('Please upload a valid image file. Size of image should not be more than 2MB.') }}</label>
                                    <div class="choose-file form-group">
                                        <label for="file" class="form-control-label">
                                            <div>{{ __('Choose File Here') }}</div>
                                            <input type="file" class="form-control {{ $errors->has('avatar') ? ' is-invalid' : '' }}" name="avatar" id="file" data-filename="avatar_selection">
                                            <div class="invalid-feedback">
                                                {{ $errors->first('avatar') }}
                                            </div>
                                        </label>
                                        <p class="avatar_selection"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label form-control-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                                <div class="form-group col-lg-12 col-md-12">
                                    <img src="{{$user->avatarlink}}" id="myAvatar" alt="user-image" class="w-10">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label class="col-form-label form-control-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                                <button class="btn-submit"><span>{{ __('Update') }}</span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
