$('#modaldemo8').on('show.bs.modal', function(event) {
	var button    = $(event.relatedTarget);
	var route = button.data('route');
	var name      = button.data('name');
	var id        = button.data('id');
	var modal = $(this);
	modal.find('.modal-body #viewName').val(name);
	modal.find('.modal-content #formDelete').attr('action', route+'/'+id);
});

$('#modaldemo6').on('show.bs.modal', function(event) {
  var button    = $(event.relatedTarget);
  var product_name      = button.data('name');
  var code      = button.data('code');
  var photo      = button.data('photo');
  var selling_price      = button.data('selling_price');
  var stock      = button.data('stock');
  var Purchasing = button.data('price');
  var created_at      = button.data('created_at');
  var description      = button.data('desc');
  var trademark      = button.data('trademark');
  var department      = button.data('department');
  var colors      = button.data('colors');
  var total = colors.length;
  var row = "";
  var modal = $(this);
  $.each( colors, function( key, value ) {
    row += value.name;
    if(key != total - 1){
      row += " - ";
    }
  });
  modal.find('.modal-body #imageProduct').attr("src", photo);
  modal.find('.modal-body #productNameShow').html(product_name);
  modal.find('.modal-body #productCodeShow').html(code);
  modal.find('.modal-body #productPurchasingShow').html(Purchasing);
  modal.find('.modal-body #productSellingShow').html(selling_price);
  modal.find('.modal-body #productStockShow').html(stock);
  modal.find('.modal-body #productCreatedShow').html(created_at);
  modal.find('.modal-body #productDescShow').html(description);
  modal.find('.modal-body #productTradeShow').html(trademark);
  modal.find('.modal-body #productDepartShow').html(department);
  modal.find('.modal-body #productColorsShow').html(row);
});

function delete_all()
{
  $(document).on('click', '.delbtn', function(){
    var number = $('.selectbox:checked').length;
    if(number != 0)
    {
      $('#multipleDelete').modal('show');
      $('#notempty').show();
      $('#btnNotEmpty').show();
      $('#empty').hide();
      $('#btnEmpty').hide();
      if(number > 1){
        $('#records').text(number + " سجلات");
      }else{
        $('#records').text(number + "  سجل");
      }
    }else{
      $('#multipleDelete').modal('show');
      $('#empty').show();
      $('#notempty').hide();
      $('#btnEmpty').show();
      $('#btnNotEmpty').hide();
    }
  });
}

function archive_all()
{
  $(document).on('click', '.archbtn', function(){
    var number = $('.selectbox:checked').length;
    if(number != 0)
    {
      $('#multipleArchive').modal('show');
      $('#notempty1').show();
      $('#btnNotEmpty1').show();
      $('#empty1').hide();
      $('#btnEmpty1').hide();
      if(number > 1){
        $('#records1').text(number + " سجلات");
      }else{
        $('#records1').text(number + "  سجل");
      }
    }else{
      $('#multipleArchive').modal('show');
      $('#empty1').show();
      $('#notempty1').hide();
      $('#btnEmpty1').show();
      $('#btnNotEmpty1').hide();
    }
  });
}


$('.selectall').click(function(){
	$('.selectbox').prop('checked', $(this).prop('checked'));
});

$('.selectbox').change(function() {
	var total = $('.selectbox').length;
	var number = $('.selectbox:checked').length;
	if(total == number)
	{
		$('.selectall').prop('checked', true);
	}else{
		$('.selectall').prop('checked', false);
	}
});