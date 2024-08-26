<div class="modal" tabindex="-1" role="dialog" id="multipleDelete">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">حذف سجلات</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="empty">
        <p>الرجاء تحديد السجلات لحذفها</p>
      </div>
      <div class="modal-body" id="notempty">
        <p>هل تريد تاكيد حذف <span id="records"></span>؟</p>
      </div>
      <div class="modal-footer" id="btnNotEmpty">
        <button type="submit"  formaction="{{ route($routeName.'.deleteall') }}" class="btn btn-primary">
        	نعم
        </button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
        	لا
    	 </button>
      </div>
      <div class="modal-footer" id="btnEmpty">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
          اغلاق
       </button>
      </div>
    </div>
  </div>
</div>