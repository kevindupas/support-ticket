@if($customFields)
    @foreach($customFields as $customField)
        @if($customField->id == '1')
            <div class="form-group col-md-{{ $customField->width }}">
                <label for="name" class="form-control-label">{{ __($customField->name) }}</label>
                <div class="form-icon-user">
                    <span class="prefix-icon"><i class="fas fa-user"></i></span>
                    <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" name="name" placeholder="{{ __($customField->placeholder) }}" required="" value="{{old('name')}}">
                    <div class="invalid-feedback d-block">
                        {{ $errors->first('name') }}
                    </div>
                </div>
            </div>
        @elseif($customField->id == '2')
            <div class="form-group col-md-{{ $customField->width }}">
                <label for="email" class="form-control-label">{{ __($customField->name) }}</label>
                <div class="form-icon-user">
                    <span class="prefix-icon"><i class="fas fa-envelope"></i></span>
                    <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email" placeholder="{{ __($customField->placeholder) }}" required="" value="{{old('email')}}">
                    <div class="invalid-feedback d-block">
                        {{ $errors->first('email') }}
                    </div>
                </div>
            </div>
        @elseif($customField->id == '3')
            <div class="form-group col-md-{{ $customField->width }}">
                <label for="category" class="form-control-label">{{ __($customField->name) }}</label>
                <select class="select2 select2" id="category" name="category" data-placeholder="{{ __($customField->placeholder) }}">
                    <option value="">{{ __($customField->placeholder) }}</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}" @if(old('category') == $category->id) selected @endif>{{$category->name}}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback d-block">
                    {{ $errors->first('category') }}
                </div>
            </div>
        @elseif($customField->id == '4')
            <div class="form-group col-md-{{ $customField->width }}">
                <label for="subject" class="form-control-label">{{ __($customField->name) }}</label>
                <div class="form-icon-user">
                    <span class="prefix-icon"><i class="fas fa-file"></i></span>
                    <input type="text" class="form-control {{ $errors->has('subject') ? ' is-invalid' : '' }}" id="subject" name="subject" placeholder="{{ __($customField->placeholder) }}" required="" value="{{old('subject')}}">
                    <div class="invalid-feedback d-block">
                        {{ $errors->first('subject') }}
                    </div>
                </div>
            </div>
        @elseif($customField->id == '5')
            <div class="form-group col-md-{{ $customField->width }}">
                <label for="description" class="form-control-label">{{ __('Description') }}</label>
                <textarea name="description" class="form-control ckdescription {{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="{{ __($customField->placeholder) }}">{{old('description')}}</textarea>
                <div class="invalid-feedback">
                    {{ $errors->first('description') }}
                </div>
            </div>
        @elseif($customField->id == '6')
            <div class="form-group col-md-{{ $customField->width }}">
                <label class="form-control-label">{{ __($customField->name) }} <small>({{__($customField->placeholder)}})</small></label>
                <div class="choose-file form-group">
                    <label for="file" class="form-control-label">
                        <div>{{ __('Choose File Here') }}</div>
                        <input type="file" class="form-control {{ $errors->has('attachments') ? ' is-invalid' : '' }}" multiple="" name="attachments[]" id="file" data-filename="multiple_file_selection">
                        <div class="invalid-feedback">
                            {{ $errors->first('attachments') }}
                        </div>
                    </label>
                    <p class="multiple_file_selection"></p>
                </div>
            </div>
        @elseif($customField->type == 'text')
            <div class="form-group col-md-{{ $customField->width }}">
                {{ Form::label('customField-'.$customField->id, __($customField->name),['class'=>'form-control-label']) }}
                @if($customField->is_required == 1)
                    {{ Form::text('customField['.$customField->id.']', null, ['class' => 'form-control', 'placeholder' => __($customField->placeholder),'required']) }}
                @else
                    {{ Form::text('customField['.$customField->id.']', null, ['class' => 'form-control', 'placeholder' => __($customField->placeholder)]) }}
                @endif
            </div>
        @elseif($customField->type == 'email')
            <div class="form-group col-md-{{ $customField->width }}">
                {{ Form::label('customField-'.$customField->id, __($customField->name),['class'=>'form-control-label']) }}
                @if($customField->is_required == 1)
                    {{ Form::email('customField['.$customField->id.']', null, ['class' => 'form-control', 'placeholder' => __($customField->placeholder),'required']) }}
                @else
                    {{ Form::email('customField['.$customField->id.']', null, ['class' => 'form-control', 'placeholder' => __($customField->placeholder)]) }}
                @endif
            </div>
        @elseif($customField->type == 'number')
            <div class="form-group col-md-{{ $customField->width }}">
                {{ Form::label('customField-'.$customField->id, __($customField->name),['class'=>'form-control-label']) }}
                @if($customField->is_required == 1)
                    {{ Form::number('customField['.$customField->id.']', null, ['class' => 'form-control', 'placeholder' => __($customField->placeholder),'required']) }}
                @else
                    {{ Form::number('customField['.$customField->id.']', null, ['class' => 'form-control', 'placeholder' => __($customField->placeholder)]) }}
                @endif
            </div>
        @elseif($customField->type == 'date')
            <div class="form-group col-md-{{ $customField->width }}">
                {{ Form::label('customField-'.$customField->id, __($customField->name),['class'=>'form-control-label']) }}
                @if($customField->is_required == 1)
                    {{ Form::date('customField['.$customField->id.']', null, ['class' => 'form-control', 'placeholder' => __($customField->placeholder),'required']) }}
                @else
                    {{ Form::date('customField['.$customField->id.']', null, ['class' => 'form-control', 'placeholder' => __($customField->placeholder)]) }}
                @endif
            </div>
        @elseif($customField->type == 'textarea')
            <div class="form-group col-md-{{ $customField->width }}">
                {{ Form::label('customField-'.$customField->id, __($customField->name),['class'=>'form-control-label']) }}
                @if($customField->is_required == 1)
                    {{ Form::textarea('customField['.$customField->id.']', null, ['class' => 'form-control ckdescription', 'placeholder' => __($customField->placeholder),'required']) }}
                @else
                    {{ Form::textarea('customField['.$customField->id.']', null, ['class' => 'form-control ckdescription', 'placeholder' => __($customField->placeholder)]) }}
                @endif
            </div>
        @endif
    @endforeach
@endif
