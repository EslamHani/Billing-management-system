<div class="form-group">
	@php $input = "department_name" @endphp
	<input type="text" class="form-control @error($input) error @enderror" id="{{ $input }}" name="{{ $input }}" placeholder="الاسم"  value="{{ isset($record->{$input}) ? $record->{$input} : old($input) }}">
	@error($input)
		<span style="color: red">{{ $message }}</span>
	@enderror
</div>
<div class="form-group">
	@php $input = "description" @endphp
	<textarea class="form-control @error($input) error @enderror" id="{{ $input }}" name="{{ $input }}" placeholder="الوصف"  >{{ isset($record->{$input}) ? $record->{$input} : old($input) }}</textarea>
	@error($input)
		<span style="color: red">{{ $message }}</span>
	@enderror
</div>