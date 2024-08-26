@extends('layouts.master')

@section('title')
{{ __('admin.'.$pageName) }}
@endsection

@section('css')
<style type="text/css">
	@media print{
		#print_button {
			display: none;
		}
	}
</style>
@endsection

@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
	<div class="my-auto">
		<div class="d-flex">
			<h4 class="content-title mb-0 my-auto">{{ __('admin.home') }}</h4>
			<span class="text-muted mt-1 tx-13 mr-2 mb-0">\ {{ __('admin.'.$pageName) }}</span>
		</div>
	</div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
		<!-- row -->
				<div class="row row-sm">
					<div class="col-md-12 col-xl-12">
						<div class=" main-content-body-invoice" id="print">
							<div class="card card-invoice">
								<div class="card-body">
									<div class="invoice-header">
										<h1 class="invoice-title">Jomla Shop</h1>
										<div class="billed-from">
											<h6>Facebook@jomla.shop1</h6>
											<p>instgram@jomla.shop1<br>
											Mobile: 01228184491<br>
											للشكاوي والاقتراحات : 01228184491</p>
										</div><!-- billed-from -->
									</div><!-- invoice-header -->
									<div class="row mg-t-20">
										<div class="col-md">
											<label class="tx-gray-600">دفع إلى</label>
											<div class="billed-to">
												<h6>اسم العميل : {{ $record->order->client_name }}</h6>
												<p>عنوان العميل : {{ $record->order->client_address }}<br>
												تليفون العميل : {{ $record->order->client_number1 }}<br>
												المحافظة : {{ $record->order->governorate->governorate }}</p>
											</div>
										</div>
										<div class="col-md">
											<label class="tx-gray-600">معلومات الفاتورة</label>
											<p class="invoice-info-row"><span>رقم الفاتورة:</span> <span>JM-{{ $record->order->order_number }}</span></p>
											<p class="invoice-info-row"><span>تاريخ الإصدار:</span> <span>{{ $record->created_at }}</span></p>
			
										</div>
									</div>
									<div class="table-responsive mg-t-40">
										<table class="table table-invoice border text-md-nowrap mb-0">
											<thead>
												<tr>
													<th class="wd-20p">المنتج</th>
													<th class="wd-20p">الكمية</th>
													<th class="tx-center">السعر</th>
													<th class="tx-right">الخصم</th>
													<th class="tx-right">الاجمالي</th>
												</tr>
											</thead>
											<tbody>
												@php $discount = 0 @endphp
												@foreach($record->order->products as $product)
												<tr>
													<td>{{ $product->product_name }}</td>
													<td class="tx-12">{{ $product->pivot->quantity }}</td>
													<td class="tx-center">{{ $product->selling_price }}</td>
													<td class="tx-right">{{ $product->pivot->discount }}</td>
													@php $discount += ( $product->pivot->discount * $product->pivot->quantity) @endphp
													<td class="tx-right">{{ number_format(($product->selling_price)*($product->pivot->quantity)-($product->pivot->discount)*($product->pivot->quantity), 2) }}</td>
												</tr>
												@endforeach
												<tr>
													<td class="valign-middle" colspan="2" rowspan="4">
														<div class="invoice-notes">
															<label class="main-content-label tx-13">
																Notes
															</label>
															<p style="color: black;">
																{{ $record->order->note }}
															</p>
														</div><!-- invoice-notes -->
													</td>
													<td class="tx-right">الاجمالي</td>
													<td class="tx-right" colspan="2">
														{{ number_format(($record->order->total + $discount) , 2) }}
													</td>
												</tr>
												<tr>
													<td class="tx-right">اجمالي الخصم</td>
													<td class="tx-right" colspan="2">
														{{ number_format($discount, 2) }}
													</td>
												</tr>
												<tr>
													<td class="tx-right">خدمة الشحن</td>
													<td class="tx-right" colspan="2">
														{{ number_format($record->order->shipping , 2) }}
													</td>
												</tr>
												<tr>
													<td class="tx-right tx-uppercase tx-bold tx-inverse">الصافي</td>
													<td class="tx-right" colspan="2">
														<h4 class="tx-primary tx-bold">
															{{ number_format(($record->order->shipping + $record->order->total), 2) }}
														</h4>
													</td>
												</tr>
											</tbody>
										</table>
									</div><br>
									<center>
										الاسترجاع يتم وقت المعاينة اثناء تواجد مندوب الشحن <br>
										الاستبدال خلال 48 ساعة من استلام الاوردر بشرط ان يكون بحالته <br>الاصلية ومرفق معه فاتورة الاستلام  <br>
										يعتبر  استلام المنتج اقرار من العميل بسلامتة المنتج <br><br>
										We Care Our Customer
									</center>
									<hr class="mg-b-40">
									<button class="btn btn-danger float-left mt-3 mr-2" onclick="printDiv()" id="print_button">
										<i class="mdi mdi-printer ml-1"></i>Print
									</button>
								</div>
							</div>
						</div>
					</div><!-- COL-END -->
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!--Internal  Chart.bundle js -->
<script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>

<script type="text/javascript">
	function printDiv()
	{
		var printContents = document.getElementById('print').innerHTML;
		var originalContents = document.body.innerHTML;
		document.body.innerHTML = printContents;
		window.print();
		document.body.innerHTML = originalContents;
		location.reload();
	}
</script>
@endsection
