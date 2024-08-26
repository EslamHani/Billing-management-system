@extends('layouts.master')

@section('title')
{{ __('admin.'.$pageName) }}
@endsection

@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<style type="text/css">
	.paid{
		background-color: lightgreen;
		border-radius: 10px;
		padding: 0px 15px;
	}
	.unpaid{
		background-color: #fe5151;
		border-radius: 10px;
		padding: 0px 15px;
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
		<div class="row">
			<!-- Modals Delete -->
			@unless($trash)
				@include('backend.shared.modals.single-delete-modal')
			@endunless
			<!-- Modals Delete -->
			<div class="col-md-12">
				<form method="POST">
					@csrf
					@method('DELETE')
					<div class="card">
						<div class="card-header pb-0">
							<div class="col-sm-12 col-md-12 col-xl-12">
								@unless($trash)
									@can('invoices_delete')
									<button class="btn btn-danger-gradient delbtn" onclick="delete_all()" type="button">
										حذف
										<i class="las la-trash"></i>
									</button>
									@endcan
									@can('invoices_archive')
									<button class="btn btn-primary-gradient archbtn" onclick="archive_all()" type="button">
										ارشفة
										<i class="las la-archive"></i>
									</button>
									@endcan
									@can('invoices_excel')
									<a class="btn btn-info-gradient" href="{{ route('invoices.excel') }}">
										Excel
									</a>
									@endcan
								@endunless
							</div>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table text-md-nowrap" id="example1">
									<thead>
										<tr>
											@unless($trash)
											<th class="wd-10p border-bottom-0">
												<input type="checkbox" class="selectall">
											</th>
											@endunless
											<th class="wd-10p border-bottom-0">{{ __('admin.invoice_number') }}</th>
											<th class="wd-20p border-bottom-0">{{ __('admin.client_name') }}</th>
											<th class="wd-15p border-bottom-0">{{ __('admin.client_number1') }}</th>
											<th class="wd-10p border-bottom-0">{{ __('admin.shipping_company') }}</th>
											<th class="wd-15p border-bottom-0">{{ __('admin.payment_status') }}</th>
											<th class="wd-25p border-bottom-0">{{ __('admin.actions') }}</th>
										</tr>
									</thead>
									<tbody>
										@foreach($records as $record)
										<tr>
											@unless($trash)
											<td>
												<input type="checkbox" name="ids[]" class="selectbox" 
													   value="{{ $record->id }}" style="margin-right: 20px;">
											</td>
											@endunless
											<td>JM-{{ $record->order->order_number }}</td>
											<td>{{ $record->order->client_name }}</td>
											<td>{{ $record->order->client_number1 }}</td>
											<td>{{ $record->shipping_company }}</td>
											<td>
												<span class="{{ status_payment($record->payment_status) }}"> 
													{{ __('admin.'.$record->payment_status) }}
												</span>
											</td>
											<td>

												@if($trash)
													@can('invoices_archive')
													<a href="{{ route($routeName.'.restore', $record) }}" class="btn btn-secondary-gradient" title="restore">
															الغاء الارشفة  <i class="typcn typcn-arrow-back-outline"></i>
													</a>
													@endcan
												@else
													<div class="dropdown">
														<button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-secondary-gradient"
														data-toggle="dropdown" type="button">العمليات <i class="fas fa-caret-down ml-1"></i></button>
														<div class="dropdown-menu tx-13">
															@can('invoices_delete')
															<a class="modal-effect dropdown-item" data-effect="effect-newspaper" data-route="invoices" data-id="{{ $record->id }}" data-name="JM-{{ $record->order->order_number }}" data-toggle="modal" href="#modaldemo8" title="delete">
																<i class="las la-trash"></i> حذف
															</a>
															@endcan
															@can('invoices_archive')
															<button  class="dropdown-item" formaction="{{ route($routeName.'.archive', $record) }}" title="archive">
																<i class="typcn typcn-document-text"></i> ارشفة
															</button>
															@endcan
															@can('invoices_update')
															<a href="{{ route($routeName.'.edit', $record) }}" class="dropdown-item" title="edit">
																<i class="las la-pen"></i> تعديل
															</a>
															@endcan
															@can('invoices_print')
															<a href="{{ route($routeName.'.print', $record) }}" class="dropdown-item" title="print">
																<i class="las la-print"></i> معاينة الفاتورة
															</a>
															@endcan

														</div>
													</div>
												@endif

											</td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
					@unless($trash)
					@include('backend.shared.modals.multiple-delete-modal')
					@include('backend.shared.modals.multiple-archive-modal')
					@endunless
				</form>
			</div>
		</div>
		<!-- row closed -->
	</div>
	<!-- Container closed -->	
</div>
<!-- main-content closed -->

@endsection
@section('js')
<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!-- Internal Modal js-->
<script src="{{URL::asset('assets/js/modal.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
<script src="{{URL::asset('assets/js/app.js')}}"></script>
@endsection
