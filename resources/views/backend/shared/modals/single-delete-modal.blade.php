<!-- Modal effects -->
<div class="modal" id="modaldemo8">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content modal-content-demo">
			<div class="modal-header">
				<h6 class="modal-title">هل تريد تاكيد عملية الحذف ؟</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
			</div>
			<form method="POST" action="" id="formDelete">
				@csrf
				@method('DELETE')
				<div class="modal-body">
					<input type="text" id="viewName" class="form-control" readonly="readonly">
				</div>
				<div class="modal-footer">
					<button class="btn ripple btn-primary" type="submit">نعم</button>
					<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">لا</button>
				</div>
			</form>
		</div>
	</div>
</div>