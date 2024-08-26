<div class="modal" tabindex="-1" role="dialog" id="multipleArchive">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">الارشفة</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="empty1">
        <p>برجاء تحديد سجلات </p>
      </div>
      <div class="modal-body" id="notempty1">
        <p> هل تريد تاكيد ارشفة <span id="records1"></span>؟</p>
      </div>
      <div class="modal-footer" id="btnNotEmpty1">
        <button type="submit"  formaction="{{ route($routeName.'.archiveall') }}" class="btn btn-primary">
        	نعم
        </button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
        	لا
    	 </button>
      </div>
      <div class="modal-footer" id="btnEmpty1">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
          اغلاق
       </button>
      </div>
    </div>
  </div>
</div>