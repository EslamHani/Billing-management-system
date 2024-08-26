<div class="col-xl-12">
	<input wire:model="search" type="text" class="form-control" placeholder="بحث المنتجات ...">

	<div wire:loading wire:target="search">
        جاري البحث ....
    </div>

    @if($product)
	<div class="card">
		<div class="card-body h-100">
			<div class="row row-sm ">
				<div class=" col-xl-5 col-lg-12 col-md-12">
					<div class="preview-pic tab-content">
					  <div class="tab-pane active" id="pic-1">
					  	<img src="{{ $product->photo }}" alt="image" style="max-height: 450px;" />
					  </div>
					</div>
				</div>
				<div class="details col-xl-7 col-lg-12 col-md-12 mt-4 mt-xl-0">
					<h4 class="product-title mb-1">{{ $product->product_name }}</h4>
					<p class="text-muted tx-13 mb-1">{{ __('admin.code') }} : {{ $product->code }}</p>
					<p class="text-muted tx-13 mb-1">{{ __('admin.dep_id') }} :  {{ $product->department->department_name }}</p>
					<p class="text-muted tx-13 mb-1">{{ __('admin.trade_id') }} : {{ $product->trademark->name }} </p>
					<p class="text-muted tx-13 mb-1">{{ __('admin.stock') }} :  {{ $product->stock }}</p>
					<h6 class="price">{{ __('admin.selling_price') }} :
						<span class="h3 ml-2">
							{{ $product->selling_price }}
						</span>
					</h6>
					<p class="product-description">{{ $product->description }}</p>
					<form wire:submit.prevent="addProductOrder({{ $product->id }}, {{ $record->id }})">
						<div class="colors d-flex mr-3 mt-2">
							<span class="mt-2">{{ __('admin.colors') }} : </span>
							<div class="row gutters-xs mr-4">
								@foreach($product->colors as $color)
								<div class="mr-2">
									<label class="colorinput">
										<input name="color" wire:model="color" type="radio" value="{{ $color->name }}" class="colorinput-input" checked="">
										<span class="colorinput-color" style="background-color: {{ $color->color }}"></span>
									</label>
								</div>
								@endforeach
								@error('color') 
									<span style="color: red; display: block;">{{ $message }}</span> 
								@enderror
							</div>
						</div>
						<div class="d-flex  mt-2">
							<div class="mt-2 product-title">{{ __('admin.quantity') }}:</div>
							<div class="d-flex ml-2">
								<ul class=" mb-0 qunatity-list">
									<li>
										<div class="form-group">
											<select name="quantity" wire:model="quantity" id="select-countries17" class="form-control nice-select wd-100">
												<option value="">...</option>
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5">5</option>
												<option value="6">6</option>
												<option value="7">7</option>
												<option value="8">8</option>
												<option value="9">9</option>
												<option value="10">10</option>
											</select>
											@error('quantity') <span style="color: red;">{{ $message }}</span> @enderror
										</div>
									</li>
								</ul>
							</div>
							<div class="mt-2 product-title">{{ __('admin.discount') }}</div>
							<div class="d-flex ml-2" style="margin-right: 10px;">
								<div class="form-group">
									<input type="integer" wire:model="discount" class="form-control wd-100" name="discount" value="0" step="0.5" autocomplete="off">
									@error('discount') <span style="color: red;">{{ $message }}</span> @enderror
								</div>
							</div>
						</div>
						<div class="action">
							<button class="add-to-cart btn btn-success" type="submit">
								{{ __('admin.add') }}
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	@endif


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
						@forelse($orderDetails as $detail)
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
								<i class="fa fa-trash" style="color: red; cursor: pointer;" wire:click="remove({{ $detail->pivot->id }})"></i>
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