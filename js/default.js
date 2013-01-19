var site = ""

$(document).ready(function(){
	
	jQuery("#formID").validationEngine();
	
	$( "#alert" ).hide();
	
	$( "#accordion" ).accordion({ 
		active: false,
		collapsible: true
	});
	
	$('.table_list').dataTable( {
	"oLanguage": {
                "sUrl": site + "/js/datatable.spanish.txt"
	},
        "bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth": false,
        "sPaginationType": "full_numbers"
    } );
	
	$('.table_list_detail').dataTable( {
	"oLanguage": {
                "sUrl": site + "/js/datatable.spanish.txt"
	},
        "bPaginate": false,
        "bLengthChange": true,
        "bFilter": false,
        "bSort": true,
        "bInfo": false,
        "bAutoWidth": false
    } );
	
	/**
	 * Botones para paginas sin modales
	 */
	$("html").delegate("#pf_btn_accept", "click", function() {
	//$("#pf_btn_accept").click( function() {
		if ($('#formID').validationEngine('validate')) {	
			//submit("formID", "content");
			$('#formID').submit();
		}
    });
	
	/**
	 * Botones para paginas en modales
	 */
	$("html").delegate("#pf_md_btn_accept", "click", function() {
		jQuery("#formIDModal").validationEngine();
		if ($('#formIDModal').validationEngine('validate')) {	
			submit("formIDModal", "content");
		}
    });
	
	$("html").delegate("#pf_md_btn_login", "click", function() {
		jQuery("#formIDModal").validationEngine();
		if ($('#formIDModal').validationEngine('validate')) {	
			var url =  $("#formIDModal").attr('action');
			var data = $("#formIDModal").serialize();
			
			var resp = callAjax(url, data);
			$("#alert_msg").html(resp);
			
			$("#alert").show( 'blind', {}, 500 );
			
			location.reload();
		}
    });
	
	$("html").delegate("#pf_md_btn_crud", "click", function() {
		if ($('#formID').validationEngine('validate')) {
			var url =  $("#formID").attr('action');
			var data = $("#formID").serialize();
			
			var resp = callAjax(url, data);
			$("#alert_msg").html(resp);
			
			$("#alert").show( 'blind', {}, 500 );

		}
    });
	
	$("html").delegate("#pf_md_btn_refresh", "click", function() {
			location.reload();
    });
	
	$("html").delegate("#delete", "click", function() {
		var url = $(this).attr("url");
		
		var resp = callAjax(url, {});
		$("#alert_msg").html(resp);
		
		$("#alert").show( 'blind', {}, 500 );
	});
	
	
	function submit(form, div) {
		var data = $("#" + form).serialize();
		var url =  $("#" + form).attr('action');
		
		load(url, data, div);
	}
	
	$( "#dialog-form" ).dialog({
		autoOpen: false,
		height: 500,
		width: 600,
		modal: true,
		show: "fade",
		hide: "explode"
	});
	
	$( "#date" ).datepicker({
		minDate: "-100y" ,
		maxDate: "+1d",
		showOn: "button",
		buttonImage: site + "/images/calendar.gif",
		buttonImageOnly: true,
		dateFormat: "dd/mm/yy",
		changeMonth: true,
		changeYear: true,
		showOtherMonths: true,
		selectOtherMonths: true,
		monthNamesShort: [ "Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic" ]
	});
	
	// Calendarios
	var dates = $( "#initDate, #endDate" ).datepicker({
		minDate: "-100y" ,
		maxDate: "+1m +1w",
		showOn: "button",
		buttonImage: site + "/images/calendar.gif",
		buttonImageOnly: true,
		dateFormat: "dd/mm/yy",
		changeMonth: true,
		changeYear: true,
		showOtherMonths: true,
		selectOtherMonths: true,
		monthNamesShort: [ "Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic" ],
		//showButtonPanel: true,
		onSelect: function( selectedDate ) {
			var option = this.id == initDateName ? "minDate" : "maxDate",
				instance = $( this ).data( "datepicker" ),
				date = $.datepicker.parseDate(
					instance.settings.dateFormat ||
					$.datepicker._defaults.dateFormat,
					selectedDate, instance.settings );
			dates.not( this ).datepicker( "option", option, date );
		}
	});
	
//	$( "#btn-login" ).click( function() {
//		loadModal(site + '/login');
//	});
	
//	$( "#lnk-notice" ).click( function() {
//		load(site + '/notices/list','', 'content');
//	});
	
	/* Function */
	function loadModal(url) {
		$( "#dialog-form" ).dialog( "open" );
		load(url, '', "form-data");
		return false;
	}
	
	function load(url, data, div) {
		var html = callAjax(url, data);
		
		$("#" + div).html(html); 
	}
	
	function callAjax(url, data) {
		 //start the ajax
		rq = $.ajax({
            url: url, 
            
            async: false,
             
            //GET method is used
            type: "POST",
 
            //pass the data         
            data: data,     
             
            //Do not cache the page
            cache: false,
             
            //success
            success: function (json, status, rq) {			   
    			if (!ajaxFailJson(json)) {
    				rq.data = json;				
    			};
    		}     
        });
		return rq.data;
	}
	
	function ajaxFailJson(json) {
		if (json == null || json.Status) {
			if (json == null) {
				// Error
				return true;
			} else if (json.Status.StatusCode != '') {
				// Error
				return true;
			}
		}
		return false;
	}
	
});

function checkRut(field, rules, i, options) {
	var rut = field.val();
	var dig = $.Rut.getDigito(rut);
	
	$("#dig").val(dig);

	rut = rut + '-' +  dig;

	if (!$.Rut.validar(rut)) {
		$("#dig").val('');
		return '* El rut ingresado es incorrecto';
	} 
}