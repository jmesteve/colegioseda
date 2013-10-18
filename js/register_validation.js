$(document).ready(function(){
/*
	// validate signup form on keyup and submit
	$("#regForm").validate({
		errorPlacement: function(error, element) {
		     error.appendTo( element.parent() );
		   },
		rules: {
			name: {
				required: true
			},
			lastname: {
				required: true
			},
			nick: {
				required: true,
				minlength: 3,
				remote: {
					url : CI_ROOT+"members/check_free_username",
					type : 'post'
				}
			},
			pass: {
				required: true,
				minlength: 6,
				maxlength: 24
			},
			pass2: {
				required: true,
				minlength: 6,
				maxlength: 24,
				equalTo: "#pass"
			},
			mail: {
				required: true,
				email: true,
				remote: {
					url : CI_ROOT+"members/check_free_mail",
					type : 'post'
				}
			}
		},
		messages: {
			name: {
				required: "Por favor, introduzca su nombre"
			},
			lastname: {
				required: "Por favor, introduzca sus apellidos"
			},
			nick: {
				required: "Por favor, introduzca un nombre de usuario",
				minlength: "Su nick debe de tener al menos 3 caracteres",
				remote: jQuery.format('Nombre de usuario {0} ya en uso')
			},
			pass: {
				required: "Porfavor proporcione una contraseña",
				minlength: "Debe contener al menos 5 caracteres",
				maxlength: "Debe contener un maximo de 24 caracteres"
			},
			pass2: {
				required: "Porfavor proporcione una contraseña",
				minlength: "Debe contener al menos 5 caracteres",
				maxlength: "Debe contener un maximo de 24 caracteres",
				equalTo: "Porfavor, su contraseña debe coincidir con la de arriba"
			},
			mail: {
				required: "Por favor, introduzca una direccion email valida",
				remote: jQuery.format('La direccion email {0} ya ha sido registrada')
			}		
		}
	});
*/	
	// validate signup form on keyup and submit
	$("#signInForm").validate({
		errorPlacement: function(error, element) {
		     error.appendTo( element.parent().lastChild() );
		},
		rules: {
			username: {
				required: true
			},
			password: {
				required: true
			}
		},
		messages: {
			username: {
				required: "Campo Obligatorio"
			},
			password: {
				required: "Campo Obligatorio"
			}		
		}
	});
/*
	// validate signup form on keyup and submit
	$("#commentForm").validate({
		errorPlacement: function(error, element) {
		     error.appendTo( element.parent() );
		},
		rules: {
			name: {
				required: true
			},
			mail: {
				required: true,
				email: true
			},
			url: {
				required: false,
				//complete_url: false
			},
			contenido: {
				required: true
			}
		},
		messages: {
			name: {
				required: "Campo Obligatorio"
			},
			mail: {
				required: "Campo Obligatorio"
			},
			url: "Por favor, introduzca una direccion valida",
			contenido: {
				required: "Campo Obligatorio"
			}		
		}
	});
*/
/*	
	$("#contactForm").validate({
		errorPlacement: function(error, element) {
		     error.appendTo( element.parent() );
		},
		rules: {
			name: {
				required: true
			},
			email: {
				required: true,
				email: true
			},
			comment: {
				required: true
			}
		},
		messages: {
			name: {
				required: "Campo Obligatorio"
			},
			email: {
				required: "Campo Obligatorio",
				email: "Introduzca una direccion email valida"
			},
			comment: {
				required: "Campo Obligatorio"
			}		
		}
	});
*/	
});
