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
<style>
	.error{ color:red; } 
</style>

@livewireStyles

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
					<div class="card-body pt-0">
						<form class="form-horizontal" id="customerform" method="POST" action="{{ route($routeName.'.store') }}" enctype="multipart/form-data"  autocomplete="off">
							@csrf
							<input type="hidden" name="id" value="{{ $record->id }}">
							<div class="form-group mb-2 mt-3 justify-content-end">
								<div>
									<button type="submit" class="btn btn-primary">
										{{ __('admin.save') }}
									</button>
									<a href="{{ route($routeName.'.index') }}" class="btn btn-secondary">
										{{ __('admin.cancel') }}
									</a>
								</div>
							</div>
							@include($viewName.'form')
						</form>
						<div class="row"> 
							@livewire('search-product', ['record' => $record])
						</div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
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
<script>
if ($("#customerform").length > 0) {
	$("#customerform").validate({
		rules: {
			client_name: {
				required: true,
				maxlength: 150
			},
			client_number1: {
				required: true,
				digits:true,
				minlength: 11,
				maxlength:11,
			},
			client_number2: {
				required: true,
				digits:true,
				minlength: 11,
				maxlength:11,
			},
			client_address: {
				required: true,
				maxlength: 150
			},
			client_username: {
				required: true,
				maxlength: 150
			},
			
		},
		messages: {
			client_name: {
				required: "Please enter client name",
				maxlength: "Your last client name maxlength should be 150 characters long."
			},
			client_number1: {
				required: "Please enter first contact number",
				minlength: "The first contact number should be 11 digits",
				digits: "Please enter only numbers",
				maxlength: "The first contact number should be 11 digits",
			},
			client_number2: {
				required: "Please enter second contact number",
				minlength: "The second contact number should be 11 digits",
				digits: "Please enter only numbers",
				maxlength: "The second contact number should be 11 digits",
			},
			client_address: {
				required: "Please enter client address",
				maxlength: "Your last client address maxlength should be 150 characters long."
			},
			
			client_username: {
				required: "Please enter client username",
				maxlength: "Your last client username maxlength should be 150 characters long."
			},
		},
	})
}
</script>
@livewireScripts
@endsection