<div class="form-group">
	@php $input = "name" @endphp
	<label for="{{ $input }}">{{ __('admin.'.$input) }}</label>
	<input type="text" class="form-control @error($input) is-invalid @enderror" 
	      name="{{ $input }}" id="{{ $input }}" 
	      placeholder="{{ __('admin.'.$input) }}" value="{{ isset($record->{$input}) ? $record->{$input} : old($input) }}" required autocomplete="off">
	@error($input)
	  <span id="{{ $input }}-error" class="error invalid-feedback">
	    {{ $message }}
	  </span>
	@enderror
</div>

<div class="form-group">
	@php $input = "color" @endphp
	<label for="{{ $input }}">{{ __('admin.'.$input) }}</label>
	<input type="color" class="form-control @error($input) is-invalid @enderror" 
	      name="{{ $input }}" id="{{ $input }}" value="{{ isset($record->{$input}) ? $record->{$input} : old($input) }}" required autocomplete="off">
	@error($input)
	  <span id="{{ $input }}-error" class="error invalid-feedback">
	    {{ $message }}
	  </span>
	@enderror
</div>
