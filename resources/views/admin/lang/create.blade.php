<form class="pl-3 pr-3 animated" method="post" action="{{ route('admin.lang.store') }}">
    @csrf
    <div class="form-group">
        <label for="code" class="form-control-label">{{ __('Language Code') }}</label>
        <input class="form-control" type="text" id="code" name="code" required="" placeholder="{{ __('Language Code') }}">
    </div>
    <div class="form-group">
        <input type="submit" value="{{ __('Create') }}" class="btn-create badge-blue">
        <input type="button" value="{{ __('Cancel') }}" class="btn-create bg-gray" data-dismiss="modal">
    </div>
</form>
