<div class="col-md-6" style="margin-bottom: 5px;">
	<div class="form-group">
		@php $input = "order_number" @endphp
		<label>{{ __('admin.invoice_number') }}</label>
		<input type="text" class="form-control  @error($input) is-invalid @enderror" id="{{ $input }}" name="{{ $input }}" placeholder="{{ __('admin.'.$input) }}"  value="{{ isset($record->order->{$input}) && !is_null($record->order->{$input}) ? $record->order->{$input} : '0' }}" readonly="readonly" required>
		@error($input)
			<span style="color: red">{{ $message }}</span>
		@enderror
	</div>
</div>

<div class="col-md-6" style="margin-bottom: 5px;">
	<div class="form-group">
		@php $input = "seller_name" @endphp
		<label>{{ __('admin.'.$input) }}</label>
		<input type="text" class="form-control  @error($input) is-invalid @enderror" id="{{ $input }}" name="{{ $input }}" placeholder="{{ __('admin.'.$input) }}"  value="{{ isset($record->order->{$input}) && !is_null($record->order->{$input}) ? $record->order->{$input} : '' }}" required readonly="readonly">
		@error($input)
			<span style="color: red">{{ $message }}</span>
		@enderror
	</div>
</div>

<div class="col-md-4" style="margin-bottom: 5px;">
	<div class="form-group">
		@php $input = "client_name" @endphp
		<label>{{ __('admin.'.$input) }}</label>
		<input type="text" class="form-control  @error($input) is-invalid @enderror" id="{{ $input }}" name="{{ $input }}" placeholder="{{ __('admin.'.$input) }}"  value="{{ isset($record->order->{$input}) && !is_null($record->order->{$input}) ? $record->order->{$input} : old($input) }}" required readonly="readonly">
		@error($input)
			<span style="color: red">{{ $message }}</span>
		@enderror
	</div>
</div>

<div class="col-md-4" style="margin-bottom: 5px;">
	<div class="form-group">
		@php $input = "client_number1" @endphp
		<label>{{ __('admin.'.$input) }}</label>
		<input type="text" class="form-control  @error($input) is-invalid @enderror" id="{{ $input }}" name="{{ $input }}" placeholder="{{ __('admin.'.$input) }}"  value="{{ isset($record->order->{$input}) && !is_null($record->order->{$input}) ? $record->order->{$input} : old($input) }}" required readonly="readonly">
		@error($input)
			<span style="color: red">{{ $message }}</span>
		@enderror
	</div>
</div>
<div class="col-md-4" style="margin-bottom: 5px;">
	<div class="form-group">
		@php $input = "client_number2" @endphp
		<label>{{ __('admin.'.$input) }}</label>
		<input type="text" class="form-control  @error($input) is-invalid @enderror" id="{{ $input }}" name="{{ $input }}" placeholder="{{ __('admin.'.$input) }}"  value="{{ isset($record->order->{$input}) && !is_null($record->order->{$input}) ? $record->order->{$input} : old($input) }}" required readonly="readonly">
		@error($input)
			<span style="color: red">{{ $message }}</span>
		@enderror
	</div>
</div>
<div class="col-md-4" style="margin-bottom: 5px;">
	<div class="form-group">
		@php $input = "client_address" @endphp
		<label>{{ __('admin.'.$input) }}</label>
		<input type="text" class="form-control  @error($input) is-invalid @enderror" id="{{ $input }}" min="0" name="{{ $input }}" placeholder="{{ __('admin.'.$input) }}"  value="{{ isset($record->order->{$input}) && !is_null($record->order->{$input})? $record->order->{$input} : old($input) }}" required readonly="readonly">
		@error($input)
			<span style="color: red">{{ $message }}</span>
		@enderror
	</div>
</div>
<div class="col-md-4">
	@php $input = "governorate_id" @endphp
	<p class="mg-b-10">{{ __('admin.'.$input) }}</p>
	<select class="form-control select2" name="{{ $input }}"  disabled="true">
		@foreach($governorates as $governorate)
		<option value="{{ $governorate->id }}" {{ isset($record->order->{$input}) && $record->order->{$input} ==  $governorate->id && !is_null($record->order->{$input}) ? 'selected' : '' }}>
			{{ $governorate->governorate }}
		</option>
		@endforeach
	</select>
	@error($input)
		<span style="color: red">{{ $message }}</span>
	@enderror
</div>

<div class="col-md-4" style="margin-bottom: 5px;">
	<div class="form-group">
		@php $input = "client_username" @endphp
		<label>{{ __('admin.'.$input) }}</label>
		<input type="text" class="form-control  @error($input) is-invalid @enderror" id="{{ $input }}" min="0" name="{{ $input }}" placeholder="{{ __('admin.'.$input) }}"  value="{{ isset($record->order->{$input}) && !is_null($record->order->{$input}) ? $record->order->{$input} : old($input) }}" required readonly="readonly">
		@error($input)
			<span style="color: red">{{ $message }}</span>
		@enderror
	</div>
</div>

<div class="col-md-4">
	@php $input = "plateform" @endphp
	<p class="mg-b-10">{{ __('admin.'.$input) }}</p>
	<select class="form-control select2" name="{{ $input }}" disabled="true">
		<option value="facebook" {{ isset($record->order->{$input}) && $record->order->{$input} == 'facebook' && !is_null($record->order->{$input}) ? 'selected' : '' }}>
			facebook
		</option>
		<option value="whatsapp" {{ isset($record->order->{$input}) && $record->order->{$input} == 'whatsapp' && !is_null($record->order->{$input}) ? 'selected' : '' }}>
			whatsapp
		</option>
		<option value="instagram" {{ isset($record->order->{$input}) && $record->order->{$input} == 'instagram' && !is_null($record->order->{$input}) ? 'selected' : '' }}>
			instagram	
		</option>
		<option value="olx" {{ isset($record->order->{$input}) && $record->order->{$input} == 'olx' && !is_null($record->order->{$input}) ? 'selected' : '' }}>
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
	<select class="form-control select2" name="{{ $input }}" disabled="true">
		<option value="pendding" {{ isset($record->order->{$input}) && $record->order->{$input} == 'pendding' ? 'selected' : '' }}>
			pendding
		</option>
		<option value="refused" {{ isset($record->order->{$input}) && $record->order->{$input} == 'refused' ? 'selected' : '' }}>
			refused	
		</option>
		<option value="approved" {{ isset($record->order->{$input}) && $record->order->{$input} == 'olx' ? 'approved' : '' }}>
			approved
		</option>
	</select>
	@error($input)
		<span style="color: red">{{ $message }}</span>
	@enderror
</div>

<div class="col-md-4" style="margin-bottom: 5px;" id="shipping-div">
	<div class="form-group">
		@php $input = "shipping" @endphp
		<label>{{ __('admin.'.$input) }}</label>
		<input type="number" class="form-control  @error($input) is-invalid @enderror" id="{{ $input }}" min="0" name="{{ $input }}" placeholder="{{ __('admin.'.$input) }}"  value="{{ isset($record->order->{$input}) && !is_null($record->order->{$input}) ? $record->order->{$input} : '35' }}" onchange="myFunc()" required readonly="readonly">
		@error($input)
			<span style="color: red">{{ $message }}</span>
		@enderror
	</div>
</div>

<div class="col-md-12" style="margin-bottom: 5px;">
	<div class="form-group">
		@php $input = "note" @endphp
		<label>{{ __('admin.'.$input) }}</label>
		<textarea class="form-control  @error($input) is-invalid @enderror" id="{{ $input }}" name="{{ $input }}" placeholder="{{ __('admin.'.$input) }}" readonly="readonly">{{ isset($record->order->{$input}) && !is_null($record->order->{$input}) ? $record->order->{$input} : old($input) }}</textarea>
		@error($input)
			<span style="color: red">{{ $message }}</span>
		@enderror
	</div>
</div>

<div class="col-md-12" style="margin-bottom: 5px;">
<div class="card" style="margin-top: 20px;">
		<div class="card-body">
			<!-- Shopping Cart-->
			<div class="product-details table-responsive text-nowrap">
				<table class="table table-bordered table-hover mb-0 text-nowrap">
					<thead>
						<tr>
							<th class="text-right">المنتج</th>
							<th class="w-150">الكمية</th>
							<th>السعر</th>
							<th>الخصم</th>
							<th>الاجمالي</th>
							<th><a class="btn btn-sm btn-outline-danger">حذف</a></th>
						</tr>
					</thead>
					<tbody>
						@php $total = 0; @endphp
						@forelse($record->order->products as $detail)
						<tr>
							<td>
								<div class="media">
									<div class="card-aside-img">
										<img src="{{ $detail->photo }}" alt="img" class="h-60 w-60">
									</div>
									<div class="media-body">
										<div class="card-item-desc mt-0">
											<h6 class="font-weight-semibold mt-0 text-uppercase">
												{{ $detail->product_name }}
											</h6>
											<dl class="card-item-desc-1">
											  <dt>{{ __('admin.code') }} : </dt>
											  <dd>{{ $detail->code }}</dd>
											</dl>
											<dl class="card-item-desc-1">
											  <dt>{{ __('admin.colors') }} : </dt>
											  <dd>{{ $detail->pivot->color }}</dd>
											</dl>
											<dl class="card-item-desc-1">
											  <dt>{{ __('admin.description') }} : </dt>
											  <dd>
											  	{{ substr($detail->description, 0, 70) }}
											  	{{ strlen($detail->description) > 70 ? '...' : '' }}
											  </dd>
											</dl>
										</div>
									</div>
								</div>
							</td>
							<td class="text-center text-lg text-medium">
								{{ $detail->pivot->quantity }}	
							</td>
							<td class="text-center text-lg text-medium">{{ $detail->selling_price }}</td>
							<td class="text-center text-lg text-medium">{{ $detail->pivot->discount }}</td>

							<td class="text-center text-lg text-medium">
								{{ number_format(($detail->selling_price)*($detail->pivot->quantity)-($detail->pivot->discount)*($detail->pivot->quantity), 2) }}
							</td>
							@php $total += ($detail->selling_price)*($detail->pivot->quantity)-($detail->pivot->discount)*($detail->pivot->quantity) @endphp
							<td class="text-center">
								<i class="fa fa-trash" style="color: red; cursor: pointer;"></i>
							</td>
						</tr>
						@empty
							<td class="text-center text-lg text-medium" colspan="6">No Products</td>
						@endforelse
					</tbody>
				</table>
			</div>
			<div class="shopping-cart-footer  border-top-0">
				<div class="column text-lg">
					الاجمالي  : 
					<span class="tx-20 font-weight-bold mr-2">
						{{ number_format($total, 2) }}
					</span>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="col-md-6" style="margin-bottom: 5px;">
	<div class="form-group">
		@php $input = "shipping_company" @endphp
		<label>{{ __('admin.'.$input) }}</label>
		<input type="text" class="form-control  @error($input) is-invalid @enderror" id="{{ $input }}" min="0" name="{{ $input }}" placeholder="{{ __('admin.'.$input) }}"  value="{{ isset($record->{$input}) && !is_null($record->{$input}) ? $record->{$input} : old($input) }}" required>
		@error($input)
			<span style="color: red">{{ $message }}</span>
		@enderror
	</div>
</div>

<div class="col-md-6">
	@php $input = "payment_status" @endphp
	<p class="mg-b-10">{{ __('admin.'.$input) }}</p>
	<select class="form-control select2" name="{{ $input }}">
		<option value="">...</option>
		<option value="paid" {{ isset($record->{$input}) && $record->{$input} == 'paid' ? 'selected' : '' }}>
			{{ __('admin.paid') }}
		</option>
		<option value="unpaid" {{ isset($record->{$input}) && $record->{$input} == 'unpaid' ? 'selected' : '' }}>
			{{ __('admin.unpaid') }}
		</option>
	</select>
	@error($input)
		<span style="color: red">{{ $message }}</span>
	@enderror
</div>