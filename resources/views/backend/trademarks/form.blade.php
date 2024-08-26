<div class="form-group">
	@php $input = "name" @endphp
	<input type="text" class="form-control @error($input) error @enderror" id="{{ $input }}" name="{{ $input }}" placeholder="الاسم"  value="{{ isset($record->{$input}) ? $record->{$input} : old($input) }}">
	@error($input)
		<span style="color: red">{{ $message }}</span>
	@enderror
</div>
<div class="custom-file">
	@php $input = "logo" @endphp
	<input class="custom-file-input" id="imagepreview" name="{{ $input }}" type="file"> <label class="custom-file-label" for="customFile">Choose logo</label>
	@error($input)
		<span style="color: red">{{ $message }}</span>
	@enderror
</div>
<div id="showImg" style="margin-top: 20px;" {{ isset($record->{$input}) ? '' : 'hidden'  }}>
    <img src="{{ isset($record->{$input}) ? $record->{$input} : '' }}" id="ImgView" class="img-thumbnail wd-200p wd-sm-300" />
</div>