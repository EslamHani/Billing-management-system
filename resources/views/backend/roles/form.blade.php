<div class="col-md-12" style="margin-bottom: 5px;">
	<div class="form-group">
		@php $input = "name" @endphp
		<label>{{ __('admin.'.$input) }}</label>
		<input type="text" class="form-control  @error($input) is-invalid @enderror" id="{{ $input }}" name="{{ $input }}" placeholder="{{ __('admin.'.$input) }}"  value="{{ isset($record->{$input}) ? $record->{$input} : old($input) }}" required>
		@error($input)
			<span style="color: red;">{{ $message }}</span>
		@enderror
	</div>
</div>

<div class="col-md-12" style="margin-bottom: 5px;">
	<div class="form-group">
		@php $input = "label" @endphp
		<label>{{ __('admin.'.$input) }}</label>
		<textarea  class="form-control  @error($input) is-invalid @enderror" id="{{ $input }}" name="{{ $input }}" placeholder="{{ __('admin.'.$input) }}">{{ isset($record->{$input}) ? $record->{$input} : old($input) }}</textarea>
		@error($input)
			<span style="color: red;">{{ $message }}</span>
		@enderror
	</div>
</div>


<div class="col-md-12">
	<div class="card">
		<div class="card-header tx-medium bd-0 tx-white bg-gray-800">
			الصلاحيات
		</div>
		<div class="card-body">
			<div class="row">
				@foreach($abilities as $ability)
					<div class="col-md-3" style="margin: 5px;">
						<label class="ckbox">
							<input type="checkbox" name="abilities[]" value="{{ $ability->id }}" {{ in_array($ability->id, $selectedAbility) ? 'checked' : '' }}>
							<span>
								{{ __('admin.'.$ability->name )}}
							</span>
						</label>
					</div>
				@endforeach
			</div>
		</div>
	</div>
	<div class="col-md-12" style="margin-top: 5px;">
		@error('abilities')
			<span style="color: red;">{{ $message }}</span>
		@enderror
	</div>
</div>