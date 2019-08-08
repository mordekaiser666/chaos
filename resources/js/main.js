
jQuery(document).ready(function($){

	// create toggle text function
	$.fn.extend({
	    toggleText: function(a, b){
	        return this.text(this.text() == b ? a : b);
	    }
	});

	// scroll to id
	$('a[href*="#"]').on('click', function (e) {
		e.preventDefault();

		$('html, body').animate({
			scrollTop: $($(this).attr('href')).offset().top
		}, 500, 'linear');
	});

	// validation
	$(".contact-form form").validate({
		rules: {
			name: {
				required: true,
      			minlength: 2
			},
			email: {
		    	required: true,
		    	email: true
			}
		},
		messages: {
		    name: "Please specify your name",
		    email: {
		    	required: "We need your email address to contact you",
		      	email: "Your email address must be in the format of name@domain.com"
		    }
		},
		wrapper: "p",
		success: function(label) {
			label.parent().prev().removeClass('error-input').addClass('success-input')
			label.hide()
		},
		highlight: function(element, errorClass) {
			$(element).parent().removeClass('success-input').addClass('error-input')
		},
		errorPlacement: function(error, element) {
			error.insertAfter(element.parent());
		},
		submitHandler: function(form) {
			// submit form via ajax
			var formData = $(form).serialize();
	        $.ajax({
	            url: 'email.php',
	            type: 'POST',
	            dataType: "json",
	            data: formData,
	            success: function(response) { 
	                // alert(response.success);
	                $('.success-msg').fadeIn();
	                $('.contact-form form p').removeClass('success-input');
	                $('.contact-form form').trigger('reset');
	            },
	            error: function(xhr, status, error){
	                console.log(xhr); 
	            }         
	        });
		}
	});

	// back to top
	$('.backToTop').on('click', function(e) {
		e.preventDefault();
		$('html, body').animate({scrollTop:0})
	});
	
	
});