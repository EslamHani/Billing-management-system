<div class="col-md-6" style="margin-bottom: 5px;">
	<div class="form-group">
		@php $input = "name" @endphp
		<label>{{ __('admin.'.$input) }}</label>
		<input type="text" class="form-control  @error($input) is-invalid @enderror" id="{{ $input }}" name="{{ $input }}" placeholder="{{ __('admin.'.$input) }}"  value="{{ isset($record->{$input}) ? $record->{$input} : old($input) }}" required>
		@error($input)
			<span style="color: red;">{{ $message }}</span>
		@enderror
	</div>
</div>
<div class="col-md-6" style="margin-bottom: 5px;">
	<div class="form-group">
		@php $input = "email" @endphp
		<label>{{ __('admin.'.$input) }}</label>
		<input type="email" class="form-control  @error($input) is-invalid @enderror" id="{{ $input }}" name="{{ $input }}" placeholder="{{ __('admin.'.$input) }}"  value="{{ isset($record->{$input}) ? $record->{$input} : old($input) }}" required>
		@error($input)
			<span style="color: red;">{{ $message }}</span>
		@enderror
	</div>
</div>
<div class="col-md-6" style="margin-bottom: 5px;">
	<div class="form-group">
		@php $input = "password" @endphp
		<label>{{ __('admin.'.$input) }}</label>
		<input type="password" class="form-control  @error($input) is-invalid @enderror" id="{{ $input }}" name="{{ $input }}" placeholder="{{ __('admin.'.$input) }}">
		@error($input)
			<span style="color: red;">{{ $message }}</span>
		@enderror
	</div>
</div>

<div class="col-md-6">
	@php $input = "roles[]" @endphp
	<p class="mg-b-10">{{ __('admin.roles') }}</p>
	<select class="form-control select2 @error('roles') is-invalid @enderror" name="{{ $input }}" multiple="multiple">
		@foreach($roles as $role)
	        <option value="{{ $role->id }}" {{ in_array($role->id, $selectedRole) ? 'selected' : '' }} }}>
	          {{ $role->name }}
	        </option>
	    @endforeach
	</select>
	@error('roles')
	    <span class="invalid-feedback">
	        {{ $message }}
	    </span>
	@enderror
</div>

<div class="col-md-6" style="margin-bottom: 20px;">
	@php $input = "image" @endphp
	<label>{{ __('admin.'.$input) }}</label>
	<div class="custom-file">
		<input class="custom-file-input" id="imagepreview" name="{{ $input }}" type="file"> <label class="custom-file-label" for="customFile">Choose Photo</label>
		@error($input)
			<span style="color: red;">{{ $message }}</span>
		@enderror
	</div>
	<div id="showImg" style="margin-top: 20px;" {{ isset($record->{$input}) ? '' : 'hidden'  }}>
	    <img src="{{ isset($record->{$input}) ? asset($record->{$input}) : '' }}" id="ImgView" class="img-thumbnail wd-200p wd-sm-300" />
	</div>
</div>

<div class="col-md-6">
	@php $input = "status" @endphp
	<p class="mg-b-10">{{ __('admin.'.$input) }}</p>
	<select class="form-control select2 @error('roles') is-invalid @enderror" name="{{ $input }}">
		<option value=""></option>
        <option value="active" {{ isset($record->{$input}) && $record->{$input} == 'active' ? 'selected' : '' }}>
          Active
        </option>
        <option value="unactive" {{ isset($record->{$input}) && $record->{$input} == 'unactive' ? 'selected' : '' }}>
          Unactive
        </option>
	</select>
	@error('roles')
	    <span class="invalid-feedback">
	        {{ $message }}
	    </span>
	@enderror
</div>
