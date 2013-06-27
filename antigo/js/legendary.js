// FORM VALIDATOR
	required = ["name", "email", "telefone"];
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
	


