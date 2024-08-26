@extends('layouts.master')

@section('title')
{{ __('admin.'.$pageName) }}
@endsection
@section('css')
<!-- Internal Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<!--Internal  Datetimepicker-slider css -->
<link href="{{URL::asset('assets/plugins/amazeui-datetimepicker/css/amazeui.datetimepicker.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/pickerjs/picker.min.css')}}" rel="stylesheet">
<!-- Internal Spectrum-colorpicker css -->
<link href="{{URL::asset('assets/plugins/spectrum-colorpicker/spectrum.css')}}" rel="stylesheet">

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
			<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
				<div class="card  box-shadow-0">
					<div class="card-header">
						<h4 class="card-title mb-1">{{ __('admin.'.$pageName) }}</h4>
					</div>
					<div class="card-body pt-0">
						<form class="form-horizontal" method="POST" action="{{ route($routeName.'.store') }}" enctype="multipart/form-data"  autocomplete="off">
							@csrf
							<div class="row">
								@include($viewName.'form')
							</div>
							<div class="form-group mb-0 mt-3 justify-content-end">
								<div>
									<button type="submit" class="btn btn-primary">
										{{ __('admin.save') }}
									</button>
									<a href="{{ route($routeName.'.index') }}" class="btn btn-secondary">
										{{ __('admin.cancel') }}
									</a>
								</div>
							</div>
						</form>
					</div>
				</div>
				
			</div>
		</div>
		<!-- row closed -->
	</div>
	<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')
<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!--Internal  jquery.maskedinput js -->
<script src="{{URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js')}}"></script>
<!--Internal  spectrum-colorpicker js -->
<script src="{{URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js')}}"></script>
<!-- Internal Select2.min js -->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!--Internal Ion.rangeSlider.min js -->
<script src="{{URL::asset('assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js')}}"></script>
<!--Internal  jquery-simple-datetimepicker js -->
<script src="{{URL::asset('assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js')}}"></script>
<!-- Ionicons js -->
<script src="{{URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js')}}"></script>
<!--Internal  pickerjs js -->
<script src="{{URL::asset('assets/plugins/pickerjs/picker.min.js')}}"></script>
<!-- Internal form-elements js -->
<script src="{{URL::asset('assets/js/form-elements.js')}}"></script>

<script>

	  // Image Preview //
	$("#imagepreview").change(function() {
	  if (this.files && this.files[0]) {
	    var reader = new FileReader();
	    reader.onload = function(e) {
	      $('#showImg').removeAttr('hidden');
	      $('#ImgView').attr('src', e.target.result);
	    }
	    reader.readAsDataURL(this.files[0]); // convert to base64 string
	  }
	});
</script>
@endsection