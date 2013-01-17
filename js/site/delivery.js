$(document).ready(function(){
	
	$("#modal-prod").dialog({
        autoOpen: false,
        height: 500,
        width: 800,
        show: "blind",
        hide: "explode",
        close: function() {
            allFields.val( "" ).removeClass( "ui-state-error" );
        }
	});
	
	 $("#open-prod").click(function() {
         $("#modal-prod").dialog("open");
         return false;
     });
	 
	 $("#setdelivery").click(function() {
         $("#delivery").val($("#address").val());
     });
	 
	 $("#setdeliveryPhone").click(function() {
         $("#deliveryPhone").val($("#movil").val());
     });
	
	$(":checkbox").click(function() {
		sumar();
	});
	
	$(".cant").change(function() {
		sumar();
	});
	
});

function sumar() {
	var monto = Number(0);
	$("#product:checked").each(function (i) { 	
		id = $(this).val();
		cant = $("#cant_" + id).val();

		if (cant == 0) {
			cant = 1;
		}
		$("#cant_" + id).val(cant);
		// Sumamos los totales
		monto += Number($(this).attr('amount')) * cant;
	});
	
	$("#monto").val(monto);
}