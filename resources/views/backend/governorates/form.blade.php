<div class="form-group">
	@php $input = "governorate" @endphp
	<input type="text" class="form-control @error($input) error @enderror" id="{{ $input }}" name="{{ $input }}" placeholder="{{ __('admin.governorate') }}"  value="{{ isset($record->{$input}) ? $record->{$input} : old($input) }}">
	@error($input)
		<span style="color: red">{{ $message }}</span>
	@enderror
</div>