<div class="row">
	<div class="col-md-6" style="margin-bottom: 5px;">
		<div class="form-group">
			@php $input = "order_number" @endphp
			<label>{{ __('admin.'.$input) }}</label>
			<input type="text" class="form-control  @error($input) is-invalid @enderror" id="{{ $input }}" name="{{ $input }}" placeholder="{{ __('admin.'.$input) }}"  value="{{ isset($record->{$input}) && !is_null($record->{$input}) ? $record->{$input} : '0' }}" readonly="readonly" required>
			@error($input)
				<span style="color: red">{{ $message }}</span>
			@enderror
		</div>
	</div>

	<div class="col-md-6" style="margin-bottom: 5px;">
		<div class="form-group">
			@php $input = "seller_name" @endphp
			<label>{{ __('admin.'.$input) }}</label>
			<input type="text" class="form-control  @error($input) is-invalid @enderror" id="{{ $input }}" name="{{ $input }}" placeholder="{{ __('admin.'.$input) }}"  value="{{ isset($record->{$input}) && !is_null($record->{$input}) ? $record->{$input} : '' }}" required readonly="readonly">
			@error($input)
				<span style="color: red">{{ $message }}</span>
			@enderror
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-4" style="margin-bottom: 5px;">
		<div class="form-group">
			@php $input = "client_name" @endphp
			<label>{{ __('admin.'.$input) }}</label>
			<input type="text" class="form-control  @error($input) is-invalid @enderror" id="{{ $input }}" name="{{ $input }}" placeholder="{{ __('admin.'.$input) }}"  value="{{ isset($record->{$input}) && !is_null($record->{$input}) ? $record->{$input} : old($input) }}" required>
			@error($input)
				<span style="color: red">{{ $message }}</span>
			@enderror
		</div>
	</div>

	<div class="col-md-4" style="margin-bottom: 5px;">
		<div class="form-group">
			@php $input = "client_number1" @endphp
			<label>{{ __('admin.'.$input) }}</label>
			<input type="text" class="form-control  @error($input) is-invalid @enderror" id="{{ $input }}" name="{{ $input }}" placeholder="{{ __('admin.'.$input) }}"  value="{{ isset($record->{$input}) && !is_null($record->{$input}) ? $record->{$input} : old($input) }}" required>
			@error($input)
				<span style="color: red">{{ $message }}</span>
			@enderror
		</div>
	</div>
	<div class="col-md-4" style="margin-bottom: 5px;">
		<div class="form-group">
			@php $input = "client_number2" @endphp
			<label>{{ __('admin.'.$input) }}</label>
			<input type="text" class="form-control  @error($input) is-invalid @enderror" id="{{ $input }}" name="{{ $input }}" placeholder="{{ __('admin.'.$input) }}"  value="{{ isset($record->{$input}) && !is_null($record->{$input}) ? $record->{$input} : old($input) }}" required>
			@error($input)
				<span style="color: red">{{ $message }}</span>
			@enderror
		</div>
	</div>
</div>

	<div class="row">
	<div class="col-md-4" style="margin-bottom: 5px;">
		<div class="form-group">
			@php $input = "client_address" @endphp
			<label>{{ __('admin.'.$input) }}</label>
			<input type="text" class="form-control  @error($input) is-invalid @enderror" id="{{ $input }}" name="{{ $input }}" placeholder="{{ __('admin.'.$input) }}"  value="{{ isset($record->{$input}) && !is_null($record->{$input})? $record->{$input} : old($input) }}" required>
			@error($input)
				<span style="color: red">{{ $message }}</span>
			@enderror
		</div>
	</div>
	<div class="col-md-4">
		@php $input = "governorate_id" @endphp
		<p class="mg-b-10">{{ __('admin.'.$input) }}</p>
		<select class="form-control select2" name="{{ $input }}" id="governorate-dropdown" required>
			<option value=""></option>
			@foreach($governorates as $governorate)
			<option value="{{ $governorate->id }}" {{ isset($record->{$input}) && $record->{$input} ==  $governorate->id && !is_null($record->{$input}) ? 'selected' : '' }}>
				{{ $governorate->governorate }}
			</option>
			@endforeach
		</select>
		@error($input)
			<span style="color: red; display: block;">{{ $message }}</span>
		@enderror
	</div>

	<div class="col-md-4" style="margin-bottom: 5px;">
		<div class="form-group">
			@php $input = "client_username" @endphp
			<label>{{ __('admin.'.$input) }}</label>
			<input type="text" class="form-control  @error($input) is-invalid @enderror" id="{{ $input }}" name="{{ $input }}" placeholder="{{ __('admin.'.$input) }}"  value="{{ isset($record->{$input}) && !is_null($record->{$input}) ? $record->{$input} : old($input) }}" required>
			@error($input)
				<span style="color: red;">{{ $message }}</span>
			@enderror
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-4">
		@php $input = "plateform" @endphp
		<p class="mg-b-10">{{ __('admin.'.$input) }}</p>
		<select class="form-control select2" name="{{ $input }}" required>
			<option value=""></option>
			<option value="facebook" {{ isset($record->{$input}) && $record->{$input} == 'facebook' && !is_null($record->{$input}) ? 'selected' : '' }}>
				facebook
			</option>
			<option value="whatsapp" {{ isset($record->{$input}) && $record->{$input} == 'whatsapp' && !is_null($record->{$input}) ? 'selected' : '' }}>
				whatsapp
			</option>
			<option value="instagram" {{ isset($record->{$input}) && $record->{$input} == 'instagram' && !is_null($record->{$input}) ? 'selected' : '' }}>
				instagram	
			</option>
			<option value="olx" {{ isset($record->{$input}) && $record->{$input} == 'olx' && !is_null($record->{$input}) ? 'selected' : '' }}>
				olx
			</option>
		</select>
		@error($input)
			<span style="color: red">{{ $message }}</span>
		@enderror
	</div>

	<div class="col-md-4">
		@php $input = "status" @endphp
		<p class="mg-b-10">{{ __('admin.'.$input) }}</p>
		<select class="form-control select2" name="{{ $input }}" required>
			<option value=""></option>
			<option value="pendding" {{ isset($record->{$input}) && $record->{$input} == 'pendding' ? 'selected' : '' }}>
				pendding
			</option>
			@can('orders_update')
			<option value="refused" {{ isset($record->{$input}) && $record->{$input} == 'refused' ? 'selected' : '' }}>
				refused	
			</option>
			<option value="approved" {{ isset($record->{$input}) && $record->{$input} == 'approved' ? 'selected' : '' }}>
				approved
			</option>
			@endcan
		</select>
		@error($input)
			<span style="color: red">{{ $message }}</span>
		@enderror
	</div>

	<div class="col-md-4" style="margin-bottom: 5px;" id="shipping-div">
		<div class="form-group">
			@php $input = "shipping" @endphp
			<label>{{ __('admin.'.$input) }}</label>
			<input type="number" class="form-control  @error($input) is-invalid @enderror" id="{{ $input }}" min="0" name="{{ $input }}" placeholder="{{ __('admin.'.$input) }}"  value="{{ isset($record->{$input}) && !is_null($record->{$input}) ? $record->{$input} : '35' }}" required>
			@error($input)
				<span style="color: red">{{ $message }}</span>
			@enderror
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12" style="margin-bottom: 5px;">
		<div class="form-group">
			@php $input = "note" @endphp
			<label>{{ __('admin.'.$input) }}</label>
			<textarea class="form-control  @error($input) is-invalid @enderror" id="{{ $input }}" name="{{ $input }}" placeholder="{{ __('admin.'.$input) }}">{{ isset($record->{$input}) && !is_null($record->{$input}) ? $record->{$input} : old($input) }}</textarea>
			@error($input)
				<span style="color: red">{{ $message }}</span>
			@enderror
		</div>
	</div>
</div>
