$(window).load(function () {
	// PARALLAX
	$.stellar({
          verticalOffset: -50
        });

	// ALTURA CONTENTOR PRINCIPAL
	var alt_contentor = $("aside").height();
	$(".container").css({"height": alt_contentor + 50});

	// SCROLL TO
	$('a[href*=#]').click(function() {
	 
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
		 
			var $target = $(this.hash);
			 
			$target = $target.length && $target || $('[name=' + this.hash.slice(1) +']');
			 
			if ($target.length) {
			 
				var targetOffset = $target.offset().top;
			 
				$('html,body').animate({scrollTop: targetOffset}, 2000);
			 
				return false;
				 
			}
			
		}
	});

	// NEWSLETTER FORM
	$("form.newsletter").hover(function() {
		$('.socials').toggleClass('elementHovered');
	});

	$('input.newsletter').blur(function() {
	    $('input.newsletter').not('#submit_newsletter').removeClass('active');
		$('.socials').removeClass('elementFocused');
	});

	$('input.newsletter').focus(function() {
	    $('input.newsletter').not('#submit_newsletter').addClass('active');
		$('.socials').addClass('elementFocused');
	});

	//
	$('form.newsletter').hover(function(){
        	$('#name_newsletter').attr("placeholder", "Nome");
         }, function(){
         	$('#name_newsletter').attr("placeholder", "Newsletter");
    });


    // PLACEHOLDER OLD BROWSERS SUPPORT
    function add() {
	    if($(this).val() === ''){
	      $(this).val($(this).attr('placeholder')).addClass('placeholder');
	    }
	  }

	  function remove() {
	    if($(this).val() === $(this).attr('placeholder')){
	      $(this).val('').removeClass('placeholder');
	    }
	  }

	  // Create a dummy element for feature detection
	  if (!('placeholder' in $('<input>')[0])) {

	    // Select the elements that have a placeholder attribute
	    $('input[placeholder], textarea[placeholder]').blur(add).focus(remove).each(add);

	    // Remove the placeholder text before the form is submitted
	    $('form').submit(function(){
	      $(this).find('input[placeholder], textarea[placeholder]').each(remove);
	    });
	  }

   	



	// FORM VALIDATOR
	required = ["name", "email", "message"];
	email = $("#email");
	errornotice = $("#error");
	emptyerror = "Este campo é de preenchimento obrigatório.";
	emailerror = "Por favor, introduza um endereço de email válido.";

	$(".form").submit(function(){	
		
			if (!/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(email.val())) {
				email.addClass("required");
				email.val(emailerror);
			}
			
			for (i=0;i<required.length;i++) {
				var input = $('#'+required[i]);
				if ((input.val() == "") || (input.val() == emptyerror)) {
					input.addClass("required");
					input.val(emptyerror);
					errornotice.fadeIn(750);
				}
			}
			
			if ($(":input").hasClass("required")) {
				return false;
			} else {
				errornotice.hide();
				return true;
			}
			
		});
		$(":input").focus(function(){		
		   if ($(this).hasClass("required") ) {
				$(this).val("");
				$(this).removeClass("required");
		   }
		});			
	
});


