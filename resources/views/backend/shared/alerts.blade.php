@if(session('success'))
	<div class="col-md-12">
		<div class="alert alert-success" role="alert">
		    <button aria-label="Close" class="close" data-dismiss="alert" type="button">
			   <span aria-hidden="true">&times;</span>
		  	</button>
		    <strong>{{ session('success') }}</strong>
		</div>
	</div>
@endif

@if($errors->any())
<div class="col-md-12">
	<div class="alert alert-danger" role="alert">
		<button aria-label="Close" class="close" data-dismiss="alert" type="button">
			<span aria-hidden="true">&times;</span>
		</button>
		<ul>
		@foreach($errors->all() as $error)	
			<li>{{ $error }}</li>
		@endforeach
		</ul>
	</div>
</div>
@endif
