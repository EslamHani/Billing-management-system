<div class="col-md-6" style="margin-bottom: 5px;">
	<div class="form-group">
		@php $input = "product_name" @endphp
		<label>{{ __('admin.'.$input) }}</label>
		<input type="text" class="form-control  @error($input) is-invalid @enderror" id="{{ $input }}" name="{{ $input }}" placeholder="{{ __('admin.'.$input) }}"  value="{{ isset($record->{$input}) ? $record->{$input} : old($input) }}" required>
	</div>
</div>
<div class="col-md-6" style="margin-bottom: 5px;">
	<div class="form-group">
		@php $input = "code" @endphp
		<label>{{ __('admin.'.$input) }}</label>
		<input type="text" class="form-control  @error($input) is-invalid @enderror" id="{{ $input }}" name="{{ $input }}" placeholder="{{ __('admin.'.$input) }}"  value="{{ isset($record->{$input}) ? $record->{$input} : old($input) }}" required>
	</div>
</div>
<div class="col-md-6" style="margin-bottom: 5px;">
	<div class="form-group">
		@php $input = "Purchasing_price" @endphp
		<label>{{ __('admin.'.$input) }}</label>
		<input type="number" class="form-control  @error($input) is-invalid @enderror" id="{{ $input }}" min="0" step=".50" name="{{ $input }}" placeholder="{{ __('admin.'.$input) }}"  value="{{ isset($record->{$input}) ? $record->{$input} : '0' }}" required>
	</div>
</div>
<div class="col-md-6" style="margin-bottom: 5px;">
	<div class="form-group">
		@php $input = "selling_price" @endphp
		<label>{{ __('admin.'.$input) }}</label>
		<input type="number" class="form-control  @error($input) is-invalid @enderror" id="{{ $input }}" min="0" step=".50" name="{{ $input }}" placeholder="{{ __('admin.'.$input) }}"  value="{{ isset($record->{$input}) ? $record->{$input} : '0' }}" required>
	</div>
</div>
<div class="col-md-6" style="margin-bottom: 5px;">
	<div class="form-group">
		@php $input = "stock" @endphp
		<label>{{ __('admin.'.$input) }}</label>
		<input type="number" class="form-control  @error($input) is-invalid @enderror" id="{{ $input }}" min="0" name="{{ $input }}" placeholder="{{ __('admin.'.$input) }}"  value="{{ isset($record->{$input}) ? $record->{$input} : '0' }}" required>
	</div>
</div>

<div class="col-md-6">
	@php $input = "colors" @endphp
	<p class="mg-b-10">{{ __('admin.'.$input) }}</p>
	<select class="form-control select2" name="{{ $input }}[]" multiple="multiple">
		@foreach($colors as $color)
			<option value="{{ $color->id }}" {{ in_array($color->id, $selectedColors) ? 'selected' : '' }}>
				{{ $color->name }}
			</option>
		@endforeach
	</select>
</div>

<div class="col-md-6" style="margin-bottom: 5px;">
	@php $input = "dep_id" @endphp
	<p class="mg-b-10">{{ __('admin.'.$input) }}</p>
	<select class="form-control @error($input) is-invalid @enderror select2" name="{{ $input }}">
		<option label="Choose one" value=""></option>
		@foreach($departments as $department)
	        <option value="{{ $department->id }}" {{ isset($record->{$input}) && $department->id == $record->{$input} ? 'selected' : '' }}>
	          {{ $department->department_name }}
	        </option>
      	@endforeach
	</select>
</div>
<div class="col-md-6" style="margin-bottom: 5px;">
	@php $input = "trade_id" @endphp
	<p class="mg-b-10">{{ __('admin.'.$input) }}</p>
	<select class="form-control @error($input) is-invalid @enderror select2" name="{{ $input }}">
		<option label="Choose one" value=""></option>
		@foreach($trademarks as $trademark)
	        <option value="{{ $trademark->id }}" {{ isset($record->{$input}) && $trademark->id == $record->{$input} ? 'selected' : '' }}>
	          {{ $trademark->name }}
	        </option>
      	@endforeach
	</select>
</div>

<div class="col-md-12" style="margin-bottom: 5px;">
	<div class="form-group">
		@php $input = "description" @endphp
		<label>{{ __('admin.'.$input) }}</label>
		<textarea class="form-control  @error($input) is-invalid @enderror" id="{{ $input }}" name="{{ $input }}" placeholder="{{ __('admin.'.$input) }}"  required>{{ isset($record->{$input}) ? $record->{$input} : old($input) }}</textarea>
	</div>
</div>
<div class="col-md-12" style="margin-bottom: 20px;">
	@php $input = "photo" @endphp
	<label>{{ __('admin.'.$input) }}</label>
	<div class="custom-file">
		<input class="custom-file-input" id="imagepreview" name="{{ $input }}" type="file"> <label class="custom-file-label" for="customFile">Choose Photo</label>
	</div>
	<div id="showImg" style="margin-top: 20px;" {{ isset($record->{$input}) ? '' : 'hidden'  }}>
	    <img src="{{ isset($record->{$input}) ? asset($record->{$input}) : '' }}" id="ImgView" class="img-thumbnail wd-200p wd-sm-300" />
	</div>
</div>