$(document).ready( function() { 
	$('#add_bill').validate({
		rules:{
			date:{
				required: true,
				dateISO: true
			},
			number:{
				required: true,
				number: true,
				min: 0,
				step: 1
			},
			description:{
				required: true,
			},
			quantity:{
				required: true,
				number: true,
				min: 0,
			},
			amount_free_iva:{
				required: true,
				number: true,
				min: 0,
				step: 0.01
			},
			amount_with_iva:{
				required: true,
				number: true,
				min: 0,
				step: 0.01
			},
			total_with_iva:{
				required: true,
				number: true,
				min: 0,
				step: 0.01
			}
		},
		messages: {
			date: {
				required: "Please, enter a date.",
				dateISO: "Please, enter a valid date in ISO standard."
			},
			number:{
				required: "Please, enter a number.",
				number: "Please, enter a valid number.",
				min: "You must enter a number from 0.",
			},
			description:{
				required: "Please, enter a description."
			},
			quantity:{
				required: "Please, enter a quantity.",
				number: "Please, enter a valid number",
				min: "You must enter a number from 0.", 
			},
			amount_free_iva:{
				required: "Please, enter an amount without IVA",
				number: "Please, enter a valid number",
				min: "You must enter a number from 0",
			},
			amount_with_iva:{
				required: "Please, enter an amount with IVA",
				number: "Please, enter a valid number",
				min: "You must enter a number from 0",
			},
			total_with_iva:{
				required: "Please, enter the total with IVA",
				number: "Please, enter a valid number",
				min: "You must enter a number from 0",
			},
		},
		submitHandler: function () {
  			var saveButton = $('#save_bill');
  			//saveButton.prop('disabled', true);
  			
  			$.ajax({ 
  				type: "POST",
  				url: "/save_bill",
  				data: $('#add_bill').serialize(),
  				dataType: 'json',
  				success: function (response) {
  					if(response.result) 
					{
						$.toast({
				            heading: 'Success',
				            text: response.message,
				            position: 'top-right',
				            loader: false,
				            icon: 'Success',
				            hideAfter: 3000, 
				            stack: 6
				        });
				        setTimeout(function () {
							location.href = '/'; 
						}, 3000);
					}
  					else 
					{
  						$.toast({
				            heading: 'Error',
				            text: response.message,
				            position: 'top-right',
				            loader: false,
				            icon: 'Error',
				            hideAfter: 3000, 
				            stack: 6
				        });
  	  					saveButton.prop('disabled', false);
					}
  				},
  				fail: function (err) {
  					$.toast({
			            heading: 'Errore',
			            text: 'The system encountered an error ... Please try again.',
			            position: 'top-right',
			            loader: false,
			            icon: 'Error',
			            hideAfter: 3000, 
			            stack: 6
			        });
  					saveButton.prop('disabled', false);
  				}
  			})
  		},
	    errorClass: "mt-2 invalid-feedback animated fadeInDown",
	    errorElement: "div",
	    errorPlacement: function(e, a) {
	        a.parent().append(e)
	    },
	    highlight: function(e) {
	        $(e).closest(".form-group").addClass("is-invalid")
	    },
	    success: function(e) {
	        $(e).closest(".form-group").removeClass("is-invalid"), $(e).remove()
	    }
	});

	$(".delete-bill").click(function() {
	    var bill_id = $(this).attr('data-id');

		$( "#delete-bill-button" ).on( "click", function() {
		         
		    $.ajax({
		        type: "GET",
		        url: "delete_bill/"+bill_id,
	          	success: function(response){
	             	if( response.status ) {
	             		if(response.response > 0){
		              		$('.delete_bill').modal("hide");
		              		
					        $.toast({
					            heading: 'Success',
					            text: response.message,
					            position: 'top-right',
					            loader: false,
					            icon: 'Success',
					            hideAfter: 3000, 
					            stack: 6
					        });
							setTimeout(function () {
								location.href = '/'; 
							}, 2000);
	             		}
	             		else{
	             			$.toast({
					            heading: 'Error',
					            text: response.message,
					            position: 'top-right',
					            loader: false,
					            icon: 'Error',
					            hideAfter: 3000, 
					            stack: 6
					        });
	             		}
	            	}
	            	else{
	            		$.toast({
				            heading: 'Error',
				            text: response.message,
				            position: 'top-right',
				            loader: false,
				            icon: 'Error',
				            hideAfter: 3000, 
				            stack: 6
				        });
	            	}
	          	},
	          	error: function(response){
	              	console.log("RESPONSE: " + response);   
	          	}
	      	});
	  	});
  	});
});