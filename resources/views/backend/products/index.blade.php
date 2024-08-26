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
	.span{
		font-size: 16px; 
	    font-weight: bold; 
	    color: blue;
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
			@include('backend.shared.modals.single-delete-modal')
			<!-- Modals Delete -->
			<div class="col-md-12">
				<form method="POST">
					@csrf
					@method('DELETE')
					<div class="card">
						<div class="card-header pb-0">
							<div class="col-sm-6 col-md-4 col-xl-3">
								@can('products_create')
								<a href="{{ route($routeName.'.create') }}" class="btn btn-primary-gradient">
									<i class="las la-plus"></i>
									{{ __('admin.add') }}
								</a>
								@endcan
								@can('products_delete')
								<button class="btn btn-danger-gradient delbtn" onclick="delete_all()" type="button">
								حذف
								<i class="las la-trash"></i>
								</button>
								@endcan	
							</div>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table text-md-nowrap" id="example1">
									<thead>
										<tr>
											<th class="wd-10p border-bottom-0">
												<input type="checkbox" class="selectall">
											</th>
											<th class="wd-10p border-bottom-0">#</th>
											<th class="wd-20p border-bottom-0">{{ __('admin.product_name') }}</th>
											<th class="wd-10p border-bottom-0">{{ __('admin.code') }}</th>
											<th class="wd-10p border-bottom-0">{{ __('admin.selling_price') }}</th>
											<th class="wd-10p border-bottom-0">{{ __('admin.stock') }}</th>
											<th class="wd-15p border-bottom-0">{{ __('admin.created_at') }}</th>
											<th class="wd-25p border-bottom-0">{{ __('admin.actions') }}</th>
										</tr>
									</thead>
									<tbody>
										@foreach($records as $record)
										<tr>
											<td>
												<input type="checkbox" name="ids[]" class="selectbox" 
													   value="{{ $record->id }}" style="margin-right: 20px;">
											</td>
											<td>{{ $loop->iteration }}</td>
											<td>{{ $record->product_name }}</td>
											<td>{{ $record->code }}</td>
											<td>{{ $record->selling_price }}</td>
											
											<td>{{ $record->stock }}</td>
											<td>{{ $record->created_at }}</td>
											<td>

												<div class="dropdown">
													<button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-secondary-gradient"
													data-toggle="dropdown" type="button">العمليات <i class="fas fa-caret-down ml-1"></i></button>
													<div class="dropdown-menu tx-13">

														@can('products_update')		
														<a href="{{ route($routeName.'.edit', $record) }}" class="dropdown-item" title="edit">
															<i class="las la-pen"></i> تعديل
														</a>
														@endcan

														@can('products_delete')
														<a class="modal-effect dropdown-item" data-effect="effect-newspaper" data-route="products" data-id="{{ $record->id }}" data-name="{{ $record->product_name }}" data-toggle="modal" href="#modaldemo8" title="delete">
															<i class="las la-trash"></i> حذف
														</a>
														@endcan

														@can('products_show')
														<a class="dropdown-item" data-target="#modaldemo6" data-toggle="modal" href="" title="show"
														data-name="{{ $record->product_name }}" data-code="{{ $record->code }}" data-photo="{{ $record->photo }}" data-selling_price="{{ $record->selling_price }}" data-stock="{{ $record->stock }}" data-price="{{ $record->Purchasing_price }}" data-created_at="{{ $record->created_at }}" data-desc="{{ $record->description }}" data-trademark="{{ $record->trademark->name }}" data-department="{{ $record->department->department_name }}" data-colors="{{ $record->colors }}">
															<i class="las la-eye"></i> عرض
														</a>
														@endcan
													</div>
												</div>

											</td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
					@include('backend.shared.modals.multiple-delete-modal')
				</form>
			</div>
		</div>
		<!-- row closed -->
	</div>
	<!-- Container closed -->	
</div>
<!-- main-content closed -->

@include('backend.shared.modals.show-modal')

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
