<div class="modal" id="modaldemo6">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content modal-content-demo">
			<div class="modal-header">
				<h6 class="modal-title">{{ __('admin.information') }}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<span class="span">
							{{ __('admin.product_name') }} : 
						</span>
						<span id="productNameShow"></span><br>
						<span class="span">
							{{ __('admin.code') }} : 
						</span>
						<span id="productCodeShow"></span><br>
						<span class="span">
							{{ __('admin.Purchasing_price') }} : 
						</span>
						<span id="productPurchasingShow"></span><br>
						<span class="span">
							{{ __('admin.selling_price') }} : 
						</span>
						<span id="productSellingShow"></span><br>
						<span class="span">
							{{ __('admin.stock') }} : 
						</span>
						<span id="productStockShow"></span><br>
						<span class="span">
							{{ __('admin.created_at') }} : 
						</span>
						<span id="productCreatedShow"></span><br>
						<span class="span">
							{{ __('admin.dep_id') }} : 
						</span>
						<span id="productDepartShow"></span><br>
						<span class="span">
							{{ __('admin.trade_id') }} : 
						</span><span id="productTradeShow"></span><br>
						<span class="span">
							{{ __('admin.colors') }} : 
						</span>
						<span id="productColorsShow"></span><br>
						<span class="span">
							{{ __('admin.description') }} : 
						</span>
						<span id="productDescShow"></span><br>
					</div>
					<div class="col-md-6">
						<img src="" width="100%" height="500" class="img-thumbnail" id="imageProduct">
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
			</div>
		</div>
	</div>
</div>