$(document).ready(function () {

if ($("#example_filter").length>0) {
$("#example_filter").html('');  // hiding global search box	
}

	const loader = $('#loader');
	setTimeout(() => {
		loader.addClass('fadeOut');
		loader.html('');
	}, 300);

	// Aqui pongo el gif cuando se hace una peticion AJAX
	$(document).ajaxStart(function () {
		$("#todo").hide();
		$('#loader3').html('<i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i><h2>Espera un momento...</h2>');
	}).ajaxStop(function () {
		$('#loader3').html('');
		$("#todo").show();
	});

	// Animacion de carga inicial cuando entra el usuario
	setTimeout(function () {
		blur = $(".blur");
		blur.removeClass("animacionInicial");
		blur.removeClass('d-none');
	}, 1500);

if ($('#id_campo').length>0) {
	$('#id_campo').selectpicker();
}

	// Validaciones
	if ($('#idTipoDocumento').length > 0) {
		$('#idTipoDocumento').selectpicker();
		// Aqui hago el llamado a todas las categorias en la tabla tipodocumento 
		$.post("Controlador/misarchivos.php?op=selectCategoria", function (r) {
			$("#idTipoDocumento").html(r);
			$("#idTipoDocumento").selectpicker('refresh');
		});
	}

	$('input.phone_number').formance('format_phone_number');
	$('input.correo').formance('validate_email');
	// Lo que hace al cargar la pagina
	$("#listarEstado0_length").html("");
	$("#listarEstado1_length").html("");

	$(".highcharts-credits").html("");

	// // Validación para campos de texto exclusivo, sin caracteres especiales ni números
	// var nameregex = /^[a-zA-Z ]+$/;

	// $.validator.addMethod("validname", function( value, element ) {
	// return this.optional( element ) || nameregex.test( value );
	// });

	// Máscara para validación de Email
	var eregex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;



	// mensaje: {
	// required: true,
	// minlength: 20,
	// maxlength: 300
	// },

	// Validar registro
	$("#frmRegistro").validate({
		rules: {
			email1: {
				required: true,
				validemail: true,
				email: true
			},
			nombres: {
				required: true,
				minlength: 2
			},
			apellidos: {
				required: true,
				minlength: 2
			},
			telefono: "required",
			password1: {
				required: true,
				minlength: 5
			},
			confirm_password1: {
				required: true,
				minlength: 5,
				equalTo: "#password1"
			}
		},
		messages: {
			email1: {
				required: "Por Favor, introduzca una dirección de correo",
				validemail: "Introduzca correctamente su correo",
				email: "Introduzca correctamente su correo"
			},
			nombres: {
				required: "Escribe tu nombre",
				minlength: "Tu Nombre es demasiado corto"
			},
			apellidos: {
				required: "Escribe tu apellido",
				minlength: "Tu Nombre es demasiado corto"
			},
			telefono: "Escribe tu telefono",
			password1: {
				required: "Escribe tu contraseña",
				minlength: "Tu contraseña debe tener más de 5 letras"
			},
			confirm_password1: {
				required: "Escribe tu contraseña",
				minlength: "Tu contraseña debe tener más de 5 letras",
				equalTo: "Tus contraseñas deben coincidir"
			}
		},
		errorElement: "em",
		errorPlacement: function (error, element) {
			// Add the `help-block` class to the error element
			error.addClass("alert-danger");

			// Add `has-feedback` class to the parent div.form-group
			// in order to add icons to inputs
			element.parents(".input").addClass("has-feedback");

			// if ( element.prop( "type" ) === "checkbox" ) {
			// 	error.insertAfter( element.parent( "label" ) );
			// } else {
			// 	error.insertAfter( element );
			// }

			// Add the span element, if doesn't exists, and apply the icon classes to it.
			if (!element.next("span")[0]) {
				$("<span class='form-control-feedback'></span>").insertAfter(element);
			}
		},
		success: function (label, element) {
			// Add the span element, if doesn't exists, and apply the icon classes to it.
			if (!$(element).next("span")[0]) {
				$("<span class='form-control-feedback'></span>").insertAfter($(element));
			}
		},
		highlight: function (element, errorClass, validClass) {
			$(element).addClass("is-invalid").removeClass("is-valid");
		},
		unhighlight: function (element, errorClass, validClass) {
			$(element).addClass("is-valid").removeClass("is-invalid");
		}
	});

	// Validar Enviar correo 

	$("#frmEnviar").validate({
		rules: {
			email2: {
				required: true,
				validemail: true,
				email: true
			},
			messages: {
				email2: {
					required: "Por Favor, introduzca una dirección de correo",
					validemail: "Introduzca correctamente su correo",
					email: "Introduzca correctamente su correo"
				}
			},
			errorElement: "em",
			errorPlacement: function (error, element) {
				// Add the `help-block` class to the error element
				error.addClass("alert-danger");

				// Add `has-feedback` class to the parent div.form-group
				// in order to add icons to inputs
				element.parents(".input").addClass("has-feedback");

				// Add the span element, if doesn't exists, and apply the icon classes to it.
				if (!element.next("span")[0]) {
					$("<span class='form-control-feedback'></span>").insertAfter(element);
				}
			},
			success: function (label, element) {
				// Add the span element, if doesn't exists, and apply the icon classes to it.
				if (!$(element).next("span")[0]) {
					$("<span class='form-control-feedback'></span>").insertAfter($(element));
				}
			},
			highlight: function (element, errorClass, validClass) {
				$(element).addClass("is-invalid").removeClass("is-valid");
			},
			unhighlight: function (element, errorClass, validClass) {
				$(element).addClass("is-valid").removeClass("is-invalid");
			}
		}
	});


	// Editar usuario 
	$("#formeditarUsuario").validate({
		rules: {
			email: {
				required: true,
				validemail: true,
				email: true
			},
			nombres: {
				required: true,
				minlength: 2
			},
			apellidos: {
				required: true,
				minlength: 2
			},
			telefono: "required",
			password: {
				required: true,
				minlength: 5
			},
			confirm_password: {
				required: true,
				minlength: 5,
				equalTo: "#password"
			}
		},
		messages: {
			email: {
				required: "Por Favor, introduzca una dirección de correo",
				validemail: "Introduzca correctamente su correo",
				email: "Introduzca correctamente su correo"
			},
			nombres: {
				required: "Escribe tu nombre",
				minlength: "Tu Nombre es demasiado corto"
			},
			apellidos: {
				required: "Escribe tu apellido",
				minlength: "Tu Nombre es demasiado corto"
			},
			telefono: "Escribe tu telefono",
			password: {
				required: "Escribe tu contraseña",
				minlength: "Tu contraseña debe tener más de 5 letras"
			},
			confirm_password: {
				required: "Escribe tu contraseña",
				minlength: "Tu contraseña debe tener más de 5 letras",
				equalTo: "Tus contraseñas deben coincidir"
			}
		},
		errorElement: "em",
		errorPlacement: function (error, element) {
			// Add the `help-block` class to the error element
			error.addClass("alert-danger");

			// Add `has-feedback` class to the parent div.form-group
			// in order to add icons to inputs
			element.parents(".input").addClass("has-feedback");

			// if ( element.prop( "type" ) === "checkbox" ) {
			// 	error.insertAfter( element.parent( "label" ) );
			// } else {
			// 	error.insertAfter( element );
			// }

			// Add the span element, if doesn't exists, and apply the icon classes to it.
			if (!element.next("span")[0]) {
				$("<span class='form-control-feedback'></span>").insertAfter(element);
			}
		},
		success: function (label, element) {
			// Add the span element, if doesn't exists, and apply the icon classes to it.
			if (!$(element).next("span")[0]) {
				$("<span class='form-control-feedback'></span>").insertAfter($(element));
			}
		},
		highlight: function (element, errorClass, validClass) {
			$(element).addClass("is-invalid").removeClass("is-valid");
		},
		unhighlight: function (element, errorClass, validClass) {
			$(element).addClass("is-valid").removeClass("is-invalid");
		}
	});

	// Esto es para los tabs del datatable
	if ($('#tabs').length > 0) {
		$("#tabs").tabs({
			"show": function (event, ui) {
				var table = $.fn.dataTable.fnTables(true);
				if (table.length > 0) {
					$(table).dataTable().fnAdjustColumnSizing();
				}
			}
		});
	}


});
// Fin del document ready

$.validator.addMethod("validemail", function (value, element) {
	return this.optional(element) || eregex.test(value);
});

$.validator.setDefaults({
	submitHandler: function () {
		alert("submitted!");
	}
});
// Aqui ejecuto las funciones del datatable

if ($("#mostrarNotificacionNormal").length > 0) {
	mostrarNotificacionNormal();
}

if ($('#example').length > 0) {
	listarIndex();
}

if ($("#listarTodosEn0").length > 0) {
	listarTodos0();
	listarTodos1();
	mostrarTipoDocumento();
}

if ($("#listarEstado0").length > 0) {
	listar0();
	listar1();
}

if ($("#verUsuarioNormal").length > 0) {
	verUsuarioAdministrador();
	verUsuarioNormal();
}
if ($(".notification-count").length>0) {
	mostrarCantidadNotificaciones();
}

// Subida de la foto del usuario con Fine uploader
$("#fine-uploader-validation").fineUploader({
	// Aqui me muestra la plantilla personalizada
	template: 'qq-template-validation',
	// Aqui me muestra los mensajes en la consola
	// debug: true,
	multiple: false,
	autoUpload: false,
	request: {
		endpoint: 'assets/FineUploader/FotoUsuario.php'
	},
	thumbnails: {
		placeholders: {
			waitingPath: 'assets/js/placeholders/waiting-generic.png',
			notAvailablePath: 'assets/js/placeholders/not_available-generic.png'
		}
	},
	validation: {
		itemLimit: 1,
		sizeLimit: 512000, // 50 kB = 50 * 1024 bytes
		acceptFiles: "image/jpeg, image/jpeg, image/png, image/gif",
		allowedExtensions: ['jpeg', 'jpg', 'png', 'gif']
	},
	resume: {
		enabled: true
	},
	retry: {
		enableAuto: true,
		showButton: true
	},
	deleteFile: {
		enabled: true,
		endpoint: "assets/FineUploader/FotoUsuario.php"
	}
}).on('error', function (event, id, name, reason) {
	console.log(event);
	console.log(reason);
}).on('complete', function (event, id, name, response) {
	ubicacionFoto = response.uuid + "/" + response.uploadName;
	valorFoto = $('#foto_usuario').val(ubicacionFoto);
});

// Subida de los archivos del usuario con Fine uploader
$("#fine-uploader-validation2").fineUploader({
	// Aqui me muestra la plantilla personalizada
	template: 'qq-template-validation',
	// Aqui me muestra los mensajes en la consola
	// debug: true,
	multiple: false,
	// autoUpload: false,
	request: {
		endpoint: 'assets/FineUploader/ArchivosUsuario.php'
	},
	thumbnails: {
		placeholders: {
			waitingPath: 'assets/js/placeholders/waiting-generic.png',
			notAvailablePath: 'assets/js/placeholders/not_available-generic.png'
		}
	},
	validation: {
		itemLimit: 1,
		sizeLimit: 5120000, // 50 kB = 50 * 1024 bytes
		acceptFiles: "application/pdf, text/plain, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint",
		allowedExtensions: ['pdf', 'txt', 'docx', 'doc', 'xls', 'ppt']
	},
	resume: {
		enabled: true
	},
	retry: {
		enableAuto: true,
		showButton: true
	},
	deleteFile: {
		enabled: true,
		endpoint: "assets/FineUploader/ArchivosUsuario.php"
	}
}).on('error', function (event, id, name, reason) {
	console.log(event);
	console.log(reason);

}).on('complete', function (event, id, name, response) {
	ubicacionArchivo = response.uuid + "/" + response.uploadName;
	$('#url_archivo').val(ubicacionArchivo);

});



var swalWithBootstrapButtons = swal.mixin({
	confirmButtonClass: 'btn btn-success',
	cancelButtonClass: 'btn btn-danger',
	buttonsStyling: false
});


// Funcion de autorefrescar los datos en pantalla Archivos del usuario de la sesion administrador
function autoRefrescar() {
	if ($("#mostrarTipoDocumento").length>0){
	$("#listarTodosEn1").DataTable().ajax.reload(null, false); // user paging is not reset on reload
	$("#listarTodosEn0").DataTable().ajax.reload(null, false);
	$("#mostrarTipoDocumento").DataTable().ajax.reload(null, false);
	}
}

// Funcion de autorefrescar los datos en pantalla todos usuarios del administrador
function autoRefrescar3() {
	if ($("#verUsuarioNormal").length>0) {
	$("#verUsuarioAdministrador").DataTable().ajax.reload(null, false);
	$("#verUsuarioNormal").DataTable().ajax.reload(null, false); // user paging is not reset on reload
	}
}

// Funcion de autorefrescar los datos en pantalla todas las notificaciones del usuario normal
function autoRefrescar4() {
	if ($("#mostrarNotificacionNormal").length>0) {
	$("#mostrarNotificacionNormal").DataTable().ajax.reload(null, false); // user paging is not reset on reload
	}
}

// Autrorefrescar datables del usuario normal
function autoRefrescar2() {
	if ($("#listarEstado0").length>0) {
	$("#listarEstado0").DataTable().ajax.reload(null, false); // user paging is not reset on reload
	$("#listarEstado1").DataTable().ajax.reload(null, false);
	}
}

// Aqui muestra el swall alert del tipo error
function alertaError(valorestado, valormsg) {
	swal({
		type: valorestado,
		title: 'Error',
		text: valormsg,
		showConfirmButton: false,
		timer: 3000
	});
}
// Aqui muestra el swall alert del tipo success
function alertaSuccess(valorestado, valormsg) {
	swal({
		type: valorestado,
		title: 'Exito',
		text: valormsg,
		showConfirmButton: false,
		timer: 3000
	});
}

// Este codigo borra todo cuando se cierra el modal
$('#dataRegister').on('hidden.bs.modal', function () {
	$("#error1").html('');
	$("#error1").hide();
	$('.modal-body input').val('');
});

// Este codigo borra todo cuando se cierra el modal
$('#dataUpdate').on('hidden.bs.modal', function () {
	$("#error").html('');
	$("#error").hide();
	$('.modal-body input').val('');
});

// Este codigo borra todo cuando se cierra el modal
$('#editarDocumento').on('hidden.bs.modal', function () {
	$("#error").html('');
	$("#error").hide();
	$('.modal-body input').val('');
	$('.modal-body textarea').val('');

	if ($('#url_archivo').val().trim() == '') {
		elimininarDespuesde();
	} else {

	}
});

$("#modalMensaje").on('hidden.bs.modal', function () {
	$("#modalNotificacion").html('');
    $("#parrafo").html('');
});

// Este codigo borra todo cuando se cierra el modal
$('#enviarMensajeAdministrador').on('hidden.bs.modal', function () {
	$('.modal-body input').val('');
	$('.modal-body textarea').val('');
});


// Este codigo borra todo cuando se cierra el modal
$('#editarUsuario').on('hidden.bs.modal', function () {
	$("#error").html('');
	$("#error").hide();
	$('.modal-body input').val('');

	if ($('#foto_usuario').val().trim() == '') {
		elimininarDespuesde();
	} else {

	}
});

// Este codigo borra todo cuando se cierra el modal
$('#registroUsuario').on('hidden.bs.modal', function () {
	$("#error").html('');
	$("#error").hide();
	$('.modal-body input').val('');

	if ($('#foto_usuario').val().trim() == '') {
		elimininarDespuesde();
	} else {

	}
});

// Este codigo borra todo cuando se cierra el modal
$('#enviarCorreo').on('hidden.bs.modal', function () {
	$("#error").html('');
	$("#error").hide();
	$('.modal-body input').val('');
});

// Este codigo borra todo cuando se cierra el modal
$('#enviarMensajeAdministrador').on('hidden.bs.modal', function () {
	$('.modal-body input').val('');
});



$('#eliminarImagenForm').on('click', eliminarImagen());

function eliminarImagen() {
	$('#foto_usuario').val('');
	$('#url_archivo').val('');
}

function recargarPagina(direccion) {
	if (direccion.length > 0) {
		setTimeout(function () {
			window.location.replace(direccion);
		}, 2000);
	} else {
		setTimeout(function () {
			window.location.reload(true);
		}, 2000);
	}

}

function elimininarDespuesde() {
	setTimeout(function () {
		$("#eliminarImagenForm").click();
	}, 4000);
}

// Funcion para guardar tipo de documento en la ventana modal
$("#guardarDatos").on('click', function (event) {
	event.preventDefault();
	nombreTipo = $("#nombreTipo").val();
	descripcionTipo = $("#descripcionTipo").val();

	if (nombreTipo.trim() == '') {
		$('#nombreTipo').focus();
		$("#error1").html('Ingresa el nombre del tipo de documento');
		$("#error1").show();
		return false;
	} else if (descripcionTipo.trim() == '') {
		$("#descripcionTipo").focus();
		$("#error1").html('Ingresa la descripción del tipo de documento');
		$("#error1").show();
		return false;
	} else if (descripcionTipo.trim() == '' && nombreTipo.trim() == '') {
		$("#error1").html('Todos los campos deben ser llenados');
		$("#error1").show();
		return false;
	} else {

		$.post("Controlador/misarchivos.php?op=guardarTipoDocumento", {
			"nombreTipo": nombreTipo,
			"descripcionTipo": descripcionTipo
		}, function () {

		}).done(function (data) {
			datos = JSON.parse(data);
			valorestado = datos.estado.type;
			valormsg = datos.estado.msg;

			switch (valorestado) {
				case 'success':
					$('#loader3').html('');
					$('#dataRegister').modal('hide');
					alertaSuccess(valorestado, valormsg);
					autoRefrescar();
					break;
				case 'error':
					$('#loader3').html('');
					$('#dataRegister').modal('hide');
					alertaError(valorestado, valormsg);
					break;
				default:
					break;
			}
			$("#error1").html('');
			$("#error1").hide();


		}).fail(function () {
			valorestado = 'error';
			valormsg = 'Hubo un error al hacer la petición';
			alertaError(valorestado, valormsg);
		});
	}
});


// Formulario con varios pasos
var $sections = $('.form-section');

function navigateTo(index) {
	// Mark the current section with the class 'current'
	$sections
		.removeClass('current')
		.eq(index)
		.addClass('current');
	// Show only the navigation buttons that make sense for the current section:
	$('.form-navigation .previous').toggle(index > 0);
	var atTheEnd = index >= $sections.length - 1;
	$('.form-navigation .next').toggle(!atTheEnd);
	$('.form-navigation [type=submit]').toggle(atTheEnd);
	$('.form-navigation #botonRegistro').toggle(atTheEnd);
}

function curIndex() {
	// Return the current index by looking at which section has the class 'current'
	return $sections.index($sections.filter('.current'));
}
// Previous button is easy, just go back
$('.form-navigation .previous').click(function () {
	navigateTo(curIndex() - 1);
});
// Next button goes forward iff current block validates
$('.form-navigation .next').click(function () {
	$('.demo-form').parsley().whenValidate({
		group: 'block-' + curIndex()
	}).done(function () {
		navigateTo(curIndex() + 1);
	});
});
// Prepare sections by setting the `data-parsley-group` attribute to 'block-0', 'block-1', etc.
$sections.each(function (index, section) {
	$(section).find(':input').attr('data-parsley-group', 'block-' + index);
});
navigateTo(0); // Start at the beginning

// Salir del sistema
$('#logout').on('click', function (e) {
	e.preventDefault();
	url = 'index.php';
	valorestado = 'success';
	valormsg = 'Has salido correctamente del sistema';
	$.post("Controlador/micuenta.php?op=salir", {}, function () {}).done(function () {
		$('body').html("");
		alertaSuccess(valorestado, valormsg);
		direccion = 'index.php';
		recargarPagina(direccion);
	});
});

// Eliminar archivos viejos del sistema
$('#EliminarArchivosViejos').on('click', function (e) {
	e.preventDefault();

	swalWithBootstrapButtons({
		title: 'Estas seguro de borrar los archivos basura del sistema',
		type: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Si, deseo hacerlo',
		cancelButtonText: 'No',
		reverseButtons: true
	}).then((result) => {
		if (result.value) {

			$.post("Controlador/FuncionBorrarArchvivos.php?op=EliminarArchivosViejos", function () {}).done(function (datos) {
				var cadena = datos;
    			patron = "}{";
    			nuevoValor    = ",";
    			nuevaCadena = cadena.replace(patron, nuevoValor);

				data = JSON.parse(nuevaCadena);
				valorestado = data.estado.type;
				valormsg = data.estado.msg;
				valormsg1 = data.estado1.msg;
				mensajeMostrar = valormsg+" "+valormsg1;
				alertaSuccess(valorestado, mensajeMostrar);

			}).fail(function (datos) {
				valorestado = 'error';
				valormsg = 'No se ha podido realizar el borrado, intentelo de nuevo';
				alertaError(valorestado, valormsg);
			});


		} else if (result.dismiss === swal.DismissReason.cancel) {
			swalWithBootstrapButtons(
				'Eliminación cancelada',
				'Los archivos no fueron eliminados',
				'error',
			);
		}
	});

});


// Accesando al sistema como un usuario normal
$("#frmAcceso").on('submit', function (e) {
	e.preventDefault();
	email = $("#email").val();
	password = $("#password").val();


	$.post("Controlador/micuenta.php?op=entrar", {
		"email": email,
		"password": password
	}, function () {}).done(function (data) {

		datos = JSON.parse(data);
		valorestado = datos.estado.type;
		valormsg = datos.estado.msg;

		switch (valorestado) {
			case 'success':
				$('#loader3').html('');
				$("body").html("");
				$(location).attr("href", "index.php");
				break;
			case 'error':
				$('#loader3').html('');
				alertaError(valorestado, valormsg);
				break;
			default:
				break;
		}
	}).fail(function (dato) {
		valorestado = 'error';
		valormsg = 'Hubo un error al hacer la petición';
		alertaError(valorestado, valormsg);
	});
});

// Accesando al sistema como administrador
$("#frmAcceso2").on('submit', function (e) {
	e.preventDefault();
	email = $("#email").val();
	password = $("#password").val();

	$.post("Controlador/micuenta.php?op=entrar2", {
		"email": email,
		"password": password
	}, function () {}).done(function (data) {

		datos = JSON.parse(data);
		valorestado = datos.estado.type;
		valormsg = datos.estado.msg;

		switch (valorestado) {
			case 'success':
				$('#loader3').html('');
				$("body").html("");
				$(location).attr("href", "index.php");
				break;
			case 'error':
				$('#loader3').html('');
				alertaError(valorestado, valormsg);
				break;
			default:

				break;
		}


	}).fail(function () {
		valorestado = 'error';
		valormsg = 'Hubo un error al hacer la petición';
		alertaError(valorestado, valormsg);
	});
});


// Registrando el usuario normal
$("#botonRegistro").on('click', function (e) {
	e.preventDefault();
	nombres = $("#nombres").val();
	apellidos = $("#apellidos").val();
	email = $("#email1").val();
	telefono = $("#telefono").val();
	password = $("#password1").val();
	confirm_password = $("#confirm_password1").val();
	foto_usuario = $('#foto_usuario').val();

	var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;


	if (email == '') {
		navigateTo(0);
	} else if (!regex.test($('#email1').val().trim())) {
		navigateTo(0);
	} else if (nombres == '' || apellidos == '') {
		navigateTo(0);
	} else if (password == '' || confirm_password == '' || telefono == '') {
		navigateTo(1);
	} else {

		$.post("Controlador/micuenta.php?op=registrar", {
			"nombres": nombres,
			"apellidos": apellidos,
			"email": email,
			"telefono": telefono,
			"password": password,
			"confirm_password": confirm_password,
			"foto_usuario": foto_usuario
		}, function () {

		}).done(function (data) {
			datos = JSON.parse(data);
			valorestado = datos.estado.type;
			valormsg = datos.estado.msg;

			switch (valorestado) {
				case 'success':
					alertaSuccess(valorestado, valormsg);
					direccion = '';
					recargarPagina(direccion);
					break;
				case 'error':
					$('#loader3').html('');

					switch (valormsg) {
						case 'Confirmar que la contraseña debe coincidir con la contraseña.':
							alertaError(valorestado, valormsg);
							navigateTo(1);
							break;
						case 'Email existe, Por favor otro email.':
							alertaError(valorestado, valormsg);
							navigateTo(0);
							break;

						case 'El correo no es valido':
							alertaError(valorestado, valormsg);
							navigateTo(0);
							break;
						default:
							alertaError(valorestado, valormsg);
							navigateTo(0);
							break;
					}

					break;
				default:

					break;
			}
		}).fail(function () {
			valorestado = 'error';
			valormsg = 'Hubo un error al hacer la petición';
			alertaError(valorestado, valormsg);
		});
	}
});


// Enviar email para restaurar contraseña
$("#enviarcontrasena").on('click', function (e) {
	e.preventDefault();
	email = $("#email2").val();

	if (email.trim() == '') {
		$("#email2").focus();
	} else {

		$.post("Controlador/micuenta.php?op=restauracontrasena", {
			"email": email
		}, function () {}).done(function (data) {
			datos = JSON.parse(data);
			valorestado = datos.estado.type;
			valormsg = datos.estado.msg;

			switch (valorestado) {
				case 'success':
					alertaSuccess(valorestado, valormsg);
					direccion = '';
					recargarPagina(direccion);
					break;
				case 'error':
					$('#loader3').html('');
					alertaError(valorestado, valormsg);
					break;
				default:

					break;
			}
		}).fail(function () {
			valorestado = 'error';
			valormsg = 'Hubo un error al hacer la petición';
			alertaError(valorestado, valormsg);
		});
	}
});

$('#frmReinciarPassword').on('click', function (e) {
	e.preventDefault();

	password = $("#password").val();
	confirm_password = $("#confirm_password").val();
	fp_code = $("#fp_code").val();

	$.post("Controlador/micuenta.php?op=enviarContrasena", {
		"password": password,
		"confirm_password": confirm_password,
		"fp_code": fp_code
	}, function () {}).done(function (data) {
		datos = JSON.parse(data);
		valorestado = datos.estado.type;
		valormsg = datos.estado.msg;

		switch (valorestado) {
			case 'success':
				$('body').html('');
				direccion = 'index.php';
				alertaSuccess(valorestado, valormsg);
				recargarPagina(direccion);
				break;
			case 'error':
				$('#loader3').html('');
				alertaError(valorestado, valormsg);
				break;
			default:

				break;
		}


	}).fail(function () {
		valorestado = 'error';
		valormsg = 'Hubo un error al hacer la petición';
		alertaError(valorestado, valormsg);
	});
});


// Guardando el documento
$("#frmRegistroDocumento").on('submit', function (e) {
	e.preventDefault();
	titulo = $("#titulo").val();
	autor = $("#autor").val();
	resumen = $("#resumen").val();
	ubicacionfisica = $("#ubicacionfisica").val();
	url_archivo = $("#url_archivo").val();
	idTipoDocumento = $("#idTipoDocumento").val();


	if (titulo == '') {
		navigateTo(0);
	} else if (autor == '') {
		navigateTo(0);
	} else if (resumen == '') {
		navigateTo(0);
	} else if (ubicacionfisica == '') {
		navigateTo(1);
	} else if (url_archivo == '') {
		navigateTo(1);
	} else {

		$.post("Controlador/misarchivos.php?op=subirDocumentos", {
			"titulo": titulo,
			"autor": autor,
			"resumen": resumen,
			"ubicacionfisica": ubicacionfisica,
			"url_archivo": url_archivo,
			"idTipoDocumento": idTipoDocumento
		}, function () {}).done(function (data) {

			datos = JSON.parse(data);
			valorestado = datos.estado.type;
			valormsg = datos.estado.msg;

			switch (valorestado) {
				case 'success':
					// $('body').html('');
					$('#loader3').html('');
					direccion = "index.php";
					alertaSuccess(valorestado, valormsg);
					recargarPagina(direccion);
					break;
				case 'error':
					$('#loader3').html('');

					alertaError(valorestado, valormsg);

					break;
				default:

					break;
			}
		}).fail(function () {
			valorestado = 'error';
			valormsg = 'Hubo un error al hacer la petición';
			alertaError(valorestado, valormsg);
		});
	}
});

// if ($("#listarEstado0").length>0) {
// funcion listar todos los documentos con estado 0 del usuario en la session
function listar0() {
	tabla0 = $("#listarEstado0").dataTable({
		"iDisplayLength": 5, //Paginacion
		language: {
			"url": "assets/js/Spanish.json"
		},
		"bDestroy": true,
		"bProcessing": true,
		"bServerSide": true,
		"bPaginate": true,
		"ajax": {
			url: 'Controlador/misarchivos.php?op=listar0',
			type: "post",
			dataType: "json",
			beforeSend: function () {
				$("body").show();
				$("#todo").show();
				$('#loader3').html('');
				$(".cuerpo").css('filter', 'blur(2px)');
			},
			error: function (e) {
				console.log(e.responseText);
			},
			complete: function () {
				$(".cuerpo").css('filter', 'blur(0px)');
			}
		},
		"order": [
			[0, "desc"]
		]
	}).dataTable();
}

// funcion listar todos los documentos con estado 1 del usuario en la session
function listar1() {
	tabla1 = $("#listarEstado1").dataTable({
		"iDisplayLength": 5, //Paginacion
		language: {
			"url": "assets/js/Spanish.json"
		},
		"bDestroy": true,
		"bProcessing": true,
		"bServerSide": true,
		"bPaginate": true,
		"ajax": {
			url: 'Controlador/misarchivos.php?op=listar1',
			type: "post",
			dataType: "json",
			beforeSend: function () {
				$("body").show();
				$("#todo").show();
				$('#loader3').html('');
				$(".cuerpo").css('filter', 'blur(2px)');
			},
			error: function (e) {
				console.log(e.responseText);
			},
			complete: function (e) {
				$(".cuerpo").css('filter', 'blur(0px)');
			}
		},
		"order": [
			[0, "desc"]
		]
	}).dataTable();
}
// }

function verMensaje(idMensaje){
	$('#modalMensaje').modal('show');
	$.post('Controlador/mismensajes.php?op=verMensaje', {'idMensaje': idMensaje}, function() {}).done(function(data){
		$('#loader3').html('');
		datos = JSON.parse(data);
    	valorestado = datos.datos.tipoDeUsuario;
		valormsg = datos.datos.msg;
		$("#parrafo").html(valorestado);
		$("#modalNotificacion").html(valormsg);	
	}).fail(function(data){
	console.log(data.responseText);
	});
}

// if ($("#mostrarNotificacionNormal").length>0) {
// Aqui muestro unicamente todos los mensajes del usuario normal
function mostrarNotificacionNormal() {
	tablaindex = $("#mostrarNotificacionNormal").dataTable({
		"asProcessing": true, //Activamos el procesamiento del datatables
		"aServerSide": true, //Paginacion y filtrado realizados por el servidor

		language: {
			"url": "assets/js/Spanish.json"
		},

		"ajax": {
			url: 'Controlador/mismensajes.php?op=mostrarNotificacionNormal',
			type: "get",
			dataType: "json",
			error: function (e) {
				console.log(e.responseText);
			}
		},
		"bDestroy": true,
		"iDisplayLength": 5, //Paginacion
		"order": [
			[0, "desc"]
		], //ordenar columna, orden 
	}).dataTable();
}
// }

// if ($('#example').length>0) {
// Aqui muestro unicamente todos los documentos con estado 1
function listarIndex() {
datosEnviar = $('#id_campo').val();
	var tablaindex = $("#example").dataTable({
		"iDisplayLength": 5, //Paginacion
		language: {
			"url": "assets/js/Spanish.json"
		},
		"bFilter": true, // show search input 
		"bDestroy": true,
		"bProcessing": true,
		"bServerSide": true,
		"bPaginate": true,
		"ajax": {
			url: 'Controlador/misarchivos.php?op=listarSoloEstado1',
			type: "post",
			dataType: "json",
			data: {'datos':datosEnviar},
			beforeSend: function () {
				$("body").show();
				$("#todo").show();
				$('#loader3').html('');
				$(".cuerpo").css('filter', 'blur(2px)');
			},
			error: function (e) {
				console.log(e.responseText);
			},
			complete: function (e) {
				$(".cuerpo").css('filter', 'blur(0px)');
				$("#example_filter").css("display","none");
			}
		},
		"order": [
			[0, "desc"]
		]
	}).dataTable();

/* Si se pulsa el botón de reset. */
$('#boton_resetear').on('click', function(){
	$('#id_campo, #id_operacion').prop('value', '0');
	$('#id_campo').selectpicker('refresh');
	$('#valor_a_comparar').prop('value', '');
	$('#boton_buscar').prop('disabled', true);
	$('#boton_resetear').prop('disabled', true);
	tablaindex.api().search('').draw();
});

/* Si se pulsa el botón de buscar. */
$('#boton_buscar').on('click', function(){
datosEnviar2 = $('#id_campo').val();
tablaindex.fnDestroy();
listarIndex();
tablaindex.api().search($("#valor_a_comparar").prop("value")).draw();
});

// Cuando cambio de option se borrara el input
$('#id_campo, #id_operacion').on('change', function(){
	$('#boton_resetear').prop('disabled', ($('#id_campo').prop('value') == "0" && $('#id_operacion').prop('value') == "0" && $('#valor_a_comparar').prop('value') == ""));
});
/* Si se empieza a escribir. */
$('#valor_a_comparar').on('keyup keypress change', function(){
	$('#boton_buscar').prop('disabled', ($('#valor_a_comparar').prop('value') == ""));
	$('#boton_resetear').prop('disabled', ($('#valor_a_comparar').prop('value') == ""));
});

}

// }


// if ($("#listarTodosEn0").length>0) {
// Aqui muestro unicamente todos los documentos con estado 0 en la vista administrador
function listarTodos0() {
	tablaindex = $("#listarTodosEn0").dataTable({
		"iDisplayLength": 5,
		language: {
			"url": "assets/js/Spanish.json"
		},
		"bDestroy": true,
		"bProcessing": true,
		"bServerSide": true,
		"bPaginate": true,
		"ajax": {
			url: 'Controlador/misarchivos.php?op=listarTodosEn0',
			type: "post",
			dataType: "json",
			beforeSend: function () {
				$("body").show();
				$("#todo").show();
				$('#loader3').html('');
				$(".cuerpo").css('filter', 'blur(2px)');
			},
			error: function (e) {
				console.log(e.responseText);
			},
			complete: function () {
				$(".cuerpo").css('filter', 'blur(0px)');
			}
		},
		"order": [
			[0, "desc"]
		]
	}).dataTable();
}


// Aqui muestro unicamente todos los documentos con estado 0 en la vista administrador
function listarTodos1() {
	tablaindex = $("#listarTodosEn1").dataTable({
		"iDisplayLength": 5,
		language: {
			"url": "assets/js/Spanish.json"
		},
		"bDestroy": true,
		"bProcessing": true,
		"bServerSide": true,
		"bPaginate": true,
		"ajax": {
			url: 'Controlador/misarchivos.php?op=listarTodosEn1',
			type: "post",
			dataType: "json",
			beforeSend: function () {
				$("body").show();
				$("#todo").show();
				$('#loader3').html('');
				$(".cuerpo").css('filter', 'blur(2px)');
			},
			error: function (e) {
				console.log(e.responseText);
			},
			complete: function () {
				$(".cuerpo").css('filter', 'blur(0px)');
			}
		},
		"order": [
			[0, "desc"]
		]
	}).dataTable();
}


// Aqui muestro unicamente todos los documentos con estado 0 en la vista administrador
function mostrarTipoDocumento() {
	tablaindex = $("#mostrarTipoDocumento").dataTable({
		"iDisplayLength": 5, //Paginacion
		language: {
			"url": "assets/js/Spanish.json"
		},
		"bDestroy": true,
		"bProcessing": true,
		"bServerSide": true,
		"bPaginate": true,
		"ajax": {
			url: 'Controlador/misarchivos.php?op=mostrarTipoDocumentoAdministrador',
			type: "post",
			dataType: "json",
			beforeSend: function () {
				$("body").show();
				$("#todo").show();
				$('#loader3').html('');
				$(".cuerpo").css('filter', 'blur(2px)');
			},
			error: function (e) {
				console.log(e.responseText);
			},
			complete: function () {
				$(".cuerpo").css('filter', 'blur(0px)');
			}
		},
		"order": [
			[0, "desc"]
		]
	}).dataTable();
}
// }

// if ($("#verUsuarioNormal").length>0) {
// Aqui muestro unicamente todos los usuarios normales en la vista del administrador
function verUsuarioNormal() {
	tablaindex = $("#verUsuarioNormal").dataTable({
		"iDisplayLength": 5,
		language: {
			"url": "assets/js/Spanish.json"
		},
		"bDestroy": true,
		"bProcessing": true,
		"bServerSide": true,
		"bPaginate": true,
		"ajax": {
			url: 'Controlador/micuenta.php?op=verUsuarioNormal',
			type: "post",
			dataType: "json",
			beforeSend: function () {
				$("body").show();
				$("#todo").show();
				$('#loader3').html('');
				$(".cuerpo").css('filter', 'blur(2px)');
			},
			error: function (e) {
				console.log(e.responseText);
			},
			complete: function () {
				$(".cuerpo").css('filter', 'blur(0px)');
			}
		},
		"order": [
			[0, "desc"]
		]
	}).dataTable();
}

// Aqui muestro unicamente todos los usuarios administradores en la vista del administrador
function verUsuarioAdministrador() {
	tablaindex = $("#verUsuarioAdministrador").dataTable({
		"iDisplayLength": 5,
		language: {
			"url": "assets/js/Spanish.json"
		},
		"bDestroy": true,
		"bProcessing": true,
		"bServerSide": true,
		"bPaginate": true,
		"ajax": {
			url: 'Controlador/micuenta.php?op=verUsuarioAdministrador',
			type: "post",
			dataType: "json",
			beforeSend: function () {
				$("body").show();
				$("#todo").show();
				$('#loader3').html('');
				$(".cuerpo").css('filter', 'blur(2px)');
			},
			error: function (e) {
				console.log(e.responseText);
			},
			complete: function () {
				$(".cuerpo").css('filter', 'blur(0px)');
			}
		},
		"order": [
			[0, "desc"]
		]

	}).dataTable();
}
// }


function aprobar(idDocumento) {
	swalWithBootstrapButtons({
		title: 'Estas seguro de aprobar el Documento?',
		type: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Si, deseo aprobarlo',
		cancelButtonText: 'No, cancelar aprobación',
		reverseButtons: true
	}).then((result) => {
		if (result.value) {

			$.post("Controlador/misarchivos.php?op=aprobar", {
				"idDocumento": idDocumento
			}, function () {}).done(function (data) {
				autoRefrescar();
				datos = JSON.parse(data);
				valorestado = datos.estado.type;
				valormsg = datos.estado.msg;
				alertaSuccess(valorestado, valormsg);
			});

		} else if (result.dismiss === swal.DismissReason.cancel) {
			swalWithBootstrapButtons(
				'Aprobación cancelada',
				'El documento no fue aprobado',
				'error'
			)
		}
	});
}


function desaprobar(idDocumento) {

	swalWithBootstrapButtons({
		title: 'Estas seguro de desaprobar el Documento?',
		type: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Si, deseo desaprobarlo',
		cancelButtonText: 'No, cancelar desaprobación',
		reverseButtons: true
	}).then((result) => {
		if (result.value) {

			$.post("Controlador/misarchivos.php?op=desaprobar", {
				"idDocumento": idDocumento
			}, function () {}).done(function (data) {
				autoRefrescar();

				datos = JSON.parse(data);
				valorestado = datos.estado.type;
				valormsg = datos.estado.msg;
				alertaSuccess(valorestado, valormsg);

			});

		} else if (result.dismiss === swal.DismissReason.cancel) {
			swalWithBootstrapButtons(
				'Desaprobación cancelada',
				'El documento no fue desaprobado',
				'error',
			);
		}
	});

}


function eliminarDocumento(idDocumento) {
	swalWithBootstrapButtons({
		title: 'Estas seguro de eliminar el Documento?',
		type: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Si, deseo eliminarlo',
		cancelButtonText: 'No, cancelar eliminación',
		reverseButtons: true
	}).then((result) => {
		if (result.value) {

			$.post("Controlador/misarchivos.php?op=eliminarDocumento", {
				"idDocumento": idDocumento
			}, function () {}).done(function (data) {
				autoRefrescar2();

				datos = JSON.parse(data);
				valorestado = datos.estado.type;
				valormsg = datos.estado.msg;
				alertaSuccess(valorestado, valormsg);

			});

		} else if (result.dismiss === swal.DismissReason.cancel) {
			swalWithBootstrapButtons(
				'Eliminación cancelada',
				'El documento no fue eliminado',
				'error',
			);
		}
	});

}


function eliminarTipoDocumento(idTipoDocumento) {
	swalWithBootstrapButtons({
		title: 'Estas seguro de eliminar el tipo de Documento?',
		type: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Si, deseo eliminarlo',
		cancelButtonText: 'No, cancelar eliminación',
		reverseButtons: true
	}).then((result) => {
		if (result.value) {

			$.post("Controlador/misarchivos.php?op=eliminarTipoDocumento", {
				"idTipoDocumento": idTipoDocumento
			}, function () {}).done(function (data) {
				autoRefrescar();

				datos = JSON.parse(data);
				valorestado = datos.estado.type;
				valormsg = datos.estado.msg;
				alertaSuccess(valorestado, valormsg);

			});

		} else if (result.dismiss === swal.DismissReason.cancel) {
			swalWithBootstrapButtons(
				'Eliminación cancelada',
				'El tipo de documento no fue eliminado',
				'error',
			);
		}
	});

}

function editarTipoDocumento(idTipoDocumento) {

	$.post("Controlador/misarchivos.php?op=mostrarTipoDocumento", {
		"idTipoDocumento": idTipoDocumento
	}, function () {}).done(function (data) {

		data = JSON.parse(data);
		idTipoDocumento = data.datos[0];
		nombreTipo = data.datos[1];
		descripcion = data.datos[2];


		$("#idTipoDocumento").val(idTipoDocumento);
		$("#nombreTipo2").attr('placeholder', nombreTipo);
		$("#descripcionTipo2").attr('placeholder', descripcion);


	}).fail(function () {
		valorestado = 'error';
		valormsg = 'Hubo un error al hacer la petición';
		alertaError(valorestado, valormsg);
	});
}


function editarDocumento(idDocumento) {

	$.post("Controlador/misarchivos.php?op=mostrarDocumento", {
		"idDocumento": idDocumento
	}, function () {}).done(function (data) {

		data = JSON.parse(data);

		idDocumento = data.datos[0];
		titulo = data.datos[1];
		autor = data.datos[2];
		resumen = data.datos[3];
		ubicacion_fisica_documento = data.datos[4];
		tipoDocumento = data.datos[5];

		$("#idDocumento").val(idDocumento);
		$("#titulo").attr('placeholder', titulo);
		$("#autor").attr('placeholder', autor);
		$("#resumen").attr('placeholder', resumen);
		$("#ubicacionfisica").attr('placeholder', ubicacion_fisica_documento);
		$("#idTipoDocumento").val(tipoDocumento);
		$('#idTipoDocumento').change();

	}).fail(function () {
		valorestado = 'error';
		valormsg = 'Hubo un error al hacer la petición';
		alertaError(valorestado, valormsg);
	});
}

function editarUsuario(idUsuario) {

	$.post("Controlador/micuenta.php?op=mostrarUsuario", {
		"idUsuario": idUsuario
	}, function () {}).done(function (data) {

		data = JSON.parse(data);

		idUsuario = data.datos[0];
		nombres = data.datos[1];
		apellidos = data.datos[2];
		email = data.datos[3];
		telefono = data.datos[4];

		$("#idUsuario").val(idUsuario);
		$("#nombres").attr('placeholder', nombres);
		$("#apellidos").attr('placeholder', apellidos);
		$("#email").attr('placeholder', email);
		$("#telefono").attr('placeholder', telefono);


	}).fail(function () {
		valorestado = 'error';
		valormsg = 'Hubo un error al hacer la petición';
		alertaError(valorestado, valormsg);
	});
}


// Funcion para editar documento en la ventana modal
$("#guardarDatos3").on('click', function (event) {
	event.preventDefault();

	idDocumento = $("#idDocumento").val();
	titulo = $("#titulo").val();
	autor = $("#autor").val();
	resumen = $("#resumen").val();
	ubicacionfisica = $("#ubicacionfisica").val();
	url_archivo = $("#url_archivo").val();
	idTipoDocumento = $("#idTipoDocumento").val();

	if (titulo.trim() == '') {
		$('#nombreTipo').focus();
		$("#error").html('Ingresa el titulo del documento');
		$("#error").show();
		return false;
	} else if (autor.trim() == '') {
		$("#descripcionTipo").focus();
		$("#error").html('Ingrese el autor del documento');
		$("#error").show();
		return false;

	} else if (resumen.trim() == '') {
		$("#descripcionTipo").focus();
		$("#error").html('Ingrese el resumen del documento');
		$("#error").show();
		return false;


	} else if (ubicacionfisica.trim() == '') {
		$("#descripcionTipo").focus();
		$("#error").html('Ingrese la ubicación física del documento');
		$("#error").show();
		return false;

	} else if (titulo.trim() == '' && autor.trim() == '' && resumen.trim() == '' && ubicacionfisica.trim() == '') {
		$("#error").html('Todos los campos deben ser llenados');
		$("#error").show();
		return false;
	} else if (url_archivo.trim() == '') {
		$.post("Controlador/misarchivos.php?op=editarDocumento", {
			"idDocumento": idDocumento,
			"titulo": titulo,
			"autor": autor,
			"resumen": resumen,
			"ubicacionfisica": ubicacionfisica,
			"url_archivo": url_archivo,
			"idTipoDocumento": idTipoDocumento
		}, function () {

		}).done(function (data) {
			datos = JSON.parse(data);
			valorestado = datos.estado.type;
			valormsg = datos.estado.msg;

			switch (valorestado) {
				case 'success':
					$('#loader3').html('');
					alertaSuccess(valorestado, valormsg);
					autoRefrescar2();
					$('#editarDocumento').modal('hide');
					break;
				case 'error':
					$('#loader3').html('');
					alertaError(valorestado, valormsg);
					$('#editarDocumento').modal('hide');
					break;
				default:
					break;
			}
			$("#error").html('');
			$("#error").hide();


		}).fail(function () {
			valorestado = 'error';
			valormsg = 'Hubo un error al hacer la petición';
			alertaError(valorestado, valormsg);
		});
	} else {

		$.post("Controlador/misarchivos.php?op=editarDocumento", {
			"idDocumento": idDocumento,
			"titulo": titulo,
			"autor": autor,
			"resumen": resumen,
			"ubicacionfisica": ubicacionfisica,
			"url_archivo": url_archivo,
			"idTipoDocumento": idTipoDocumento
		}, function () {

		}).done(function (data) {
			datos = JSON.parse(data);
			valorestado = datos.estado.type;
			valormsg = datos.estado.msg;

			switch (valorestado) {
				case 'success':
					$('#loader3').html('');
					alertaSuccess(valorestado, valormsg);
					autoRefrescar2();
					$('#editarDocumento').modal('hide');
					direccion = '';
					recargarPagina(direccion);
					break;
				case 'error':
					$('#loader3').html('');
					alertaError(valorestado, valormsg);
					$('#editarDocumento').modal('hide');
					break;
				default:
					break;
			}
			$("#error").html('');
			$("#error").hide();


		}).fail(function () {
			valorestado = 'error';
			valormsg = 'Hubo un error al hacer la petición';
			alertaError(valorestado, valormsg);
		});
	}
});


// Funcion para guardar tipo de documento en la ventana modal
$("#guardarDatos2").on('click', function (event) {
	event.preventDefault();
	idTipoDocumento = $("#idTipoDocumento").val();
	nombreTipo = $("#nombreTipo2").val();
	descripcionTipo = $("#descripcionTipo2").val();

	if (nombreTipo.trim() == '') {
		$('#nombreTipo').focus();
		$("#error").html('Ingresa el nombre del tipo de documento');
		$("#error").show();
		return false;
	} else if (descripcionTipo.trim() == '') {
		$("#descripcionTipo").focus();
		$("#error").html('Ingresa la descripción del tipo de documento');
		$("#error").show();
		return false;
	} else if (descripcionTipo.trim() == '' && nombreTipo.trim() == '') {
		$("#error").html('Todos los campos deben ser llenados');
		$("#error").show();
		return false;
	} else {

		$.post("Controlador/misarchivos.php?op=editarTipoDocumento", {
			"idTipoDocumento": idTipoDocumento,
			"nombreTipo": nombreTipo,
			"descripcionTipo": descripcionTipo
		}, function () {

		}).done(function (data) {
			datos = JSON.parse(data);
			valorestado = datos.estado.type;
			valormsg = datos.estado.msg;

			switch (valorestado) {
				case 'success':
					$('#loader3').html('');
					$('#dataUpdate').modal('hide');
					alertaSuccess(valorestado, valormsg);
					autoRefrescar();
					break;
				case 'error':
					$('#loader3').html('');
					$('#dataUpdate').modal('hide');
					alertaError(valorestado, valormsg);
					break;
				default:
					break;
			}
			$("#error").html('');
			$("#error").hide();


		}).fail(function () {
			valorestado = 'error';
			valormsg = 'Hubo un error al hacer la petición';
			alertaError(valorestado, valormsg);
		});
	}
});


// Funcion para editar Usuario en la ventana modal
$("#guardarDatos4").on('click', function (event) {
	event.preventDefault();

if ($(".qq-thumbnail-selector").length>0) {
// Si se sube imagen
nuevosmas = 0;
do {
console.log("do-while"+nuevosmas);
if (nuevosmas==0) {
$("#fine-uploader-validation").fineUploader('uploadStoredFiles');
console.log('do-whileCero');
nuevosmas++;
	

	swalWithBootstrapButtons({
		title: 'Estas seguro de guardar los datos en el sistema',
		type: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Si, deseo hacerlo',
		cancelButtonText: 'No',
		reverseButtons: true
	}).then((result) => {
		if (result.value) {
	idUsuario = $("#idUsuario").val();
	email = $("#email").val();
	nombres = $("#nombres").val();
	apellidos = $("#apellidos").val();
	telefono = $("#telefono").val();
	password = $("#password").val();
	confirm_password = $("#confirm_password").val();
	foto_usuario = $("#foto_usuario").val();
	
if (email.trim() == '') {
		$('#email').focus();
		$("#error3").html('Ingresa el email del Usuario');
		$("#error3").show();
		return false;
	} else if (nombres.trim() == '') {
		$("#nombres").focus();
		$("#error3").html('Ingrese el nombre del Usuario');
		$("#error3").show();
		return false;

	} else if (apellidos.trim() == '') {
		$("#apellidos").focus();
		$("#error3").html('Ingrese el apellido del Usuario');
		$("#error3").show();
		return false;


	} else if (telefono.trim() == '') {
		$("#telefono").focus();
		$("#error3").html('Ingrese el telefono del Usuario');
		$("#error3").show();
		return false;

	} else if (password.trim() == '') {
		$("#password").focus();
		$("#error3").html('Ingrese la contraseña del Usuario');
		$("#error3").show();
		return false;

	} else if (confirm_password.trim() == '') {
		$("#confirm_password").focus();
		$("#error3").html('Repite la contraseña del Usuario');
		$("#error3").show();
		return false;

	} else if (password != confirm_password) {
		$("#password").focus();
		$("#confirm_password").focus();
		$("#error3").html('Ambas contraseñas deben coincidir');
		$("#error3").show();
		$("#ambascontrasena").show();
		// 	contrasena
		// repitecontrasena
		return false;
	} else if (email.trim() == '' && nombres.trim() == '' && apellidos.trim() == '' && telefono.trim() == '' && password.trim() == '' && confirm_password.trim() == '') {
		$("#error3").html('Todos los campos deben ser llenados');
		$("#error3").show();
		return false;

	} else {

		$.post("Controlador/micuenta.php?op=editarUsuarioCompleto", {
			"idUsuario": idUsuario,
			"email": email,
			"nombres": nombres,
			"apellidos": apellidos,
			"telefono": telefono,
			"password": password,
			"foto_usuario": foto_usuario
		}, function () {

		}).done(function (data) {
			datos = JSON.parse(data);
			valorestado = datos.estado.type;
			valormsg = datos.estado.msg;

			switch (valorestado) {
				case 'success':
					$('#loader3').html('');
					alertaSuccess(valorestado, valormsg);
					autoRefrescar2();
					$('#editarUsuario').modal('hide');
					direccion = '';
					recargarPagina(direccion);
					break;
				case 'error':
					$('#loader3').html('');
					switch (valormsg) {

						case 'Este email ya esta en uso en el sistema por favor ingresa otro email.':
							$('#email').val('');
							alertaError(valorestado, valormsg);
							$('#email').focus();
							$("#error3").html('Ingrese un correo diferente');
							$("#error3").show();

							break;
						default:
							alertaError(valorestado, valormsg);
							$('#editarUsuario').modal('hide');
							break;
					}
					break;
				default:
					break;
			}
			$("#error3").html('');
			$("#error3").hide();


		}).fail(function () {
			valorestado = 'error';
			valormsg = 'Hubo un error al hacer la petición';
			alertaError(valorestado, valormsg);
		});
	}


		// setTimeout(() => {
		// 	$("#editarUsuario").modal('hide');
		// }, 800);
		} else if (result.dismiss === swal.DismissReason.cancel) {
			swalWithBootstrapButtons(
				'Editar usuario cancelado',
				'No se guardaron los cambios en el sistema ',
				'error',
			);
			$("#editarUsuario").modal('hide');
		}
	});

	break;


}else{break;}
} while (nuevosmas < 2);
}else{

	// Si no se sube imagen
	idUsuario = $("#idUsuario").val();
	email = $("#email").val();
	nombres = $("#nombres").val();
	apellidos = $("#apellidos").val();
	telefono = $("#telefono").val();
	password = $("#password").val();
	confirm_password = $("#confirm_password").val();
if (email.trim() == '') {
		$('#email').focus();
		$("#error3").html('Ingresa el email del Usuario');
		$("#error3").show();
		return false;
	} else if (nombres.trim() == '') {
		$("#nombres").focus();
		$("#error3").html('Ingrese el nombre del Usuario');
		$("#error3").show();
		return false;

	} else if (apellidos.trim() == '') {
		$("#apellidos").focus();
		$("#error3").html('Ingrese el apellido del Usuario');
		$("#error3").show();
		return false;


	} else if (telefono.trim() == '') {
		$("#telefono").focus();
		$("#error3").html('Ingrese el telefono del Usuario');
		$("#error3").show();
		return false;

	} else if (password.trim() == '') {
		$("#password").focus();
		$("#error3").html('Ingrese la contraseña del Usuario');
		$("#error3").show();
		return false;

	} else if (confirm_password.trim() == '') {
		$("#confirm_password").focus();
		$("#error3").html('Repite la contraseña del Usuario');
		$("#error3").show();
		return false;

	} else if (password != confirm_password) {
		$("#password").focus();
		$("#confirm_password").focus();
		$("#error3").html('Ambas contraseñas deben coincidir');
		$("#error3").show();
		$("#ambascontrasena").show();

		// 	contrasena
		// repitecontrasena
		return false;
	} else if (email.trim() == '' && nombres.trim() == '' && apellidos.trim() == '' && telefono.trim() == '' && password.trim() == '' && confirm_password.trim() == '') {
		$("#error3").html('Todos los campos deben ser llenados');
		$("#error3").show();
		return false;

	}else {

		$.post("Controlador/micuenta.php?op=editarUsuarioCompleto", {
			"idUsuario": idUsuario,
			"email": email,
			"nombres": nombres,
			"apellidos": apellidos,
			"telefono": telefono,
			"password": password
		}, function () {

		}).done(function (data) {
			datos = JSON.parse(data);
			valorestado = datos.estado.type;
			valormsg = datos.estado.msg;

			switch (valorestado) {
				case 'success':
					$('#loader3').html('');
					alertaSuccess(valorestado, valormsg);
					$('#editarUsuario').modal('hide');
					direccion = '';
					recargarPagina(direccion);
					break;
				case 'error':
					$('#loader3').html('');
					switch (valormsg) {
						case 'Este email ya esta en uso en el sistema por favor ingresa otro email.':
							alertaError(valorestado, valormsg);

							$('#email').focus();
							$("#error3").html('Ingrese un correo diferente');
							$("#error3").show();

							break;
						default:
							alertaError(valorestado, valormsg);
							$('#editarUsuario').modal('hide');
							break;
					}

					break;
				default:
					break;
			}
			$("#error3").html('');
			$("#error3").hide();


		}).fail(function () {
			valorestado = 'error';
			valormsg = 'Hubo un error al hacer la petición';
			alertaError(valorestado, valormsg);
		});
	} 
}


	// ///////
});


function mostrarCantidadNotificaciones() {
	$.post("Controlador/mismensajes.php?op=mostrarCantidadNotificaciones", {}, function () {

	}).done(function (data) {
		if (data == '') {
			$(".notification-count").remove();
		} else {
			$(".badge-warning").removeClass('d-none');
			$(".notification-count").html(data);
		}

	}).fail(function () {

	});
}

function cargarNotificaciones() {
	$.ajax({
		url: "Controlador/mismensajes.php?op=cargarNotificaciones",
		type: "POST",
		processData: false,
		beforeSend: function () {
			$("#todo").show();
			$('#loader3').html('');
		},
		cache: false
	}).done(function (data) {

		$(".notification-count").remove();
		$("#notification-latest").show();
		$("#notification-latest").html(data);
	}).fail(function () {

	});

}

$("#botonMensajes").on('click', function (e) {
	e.preventDefault();
	cargarNotificaciones();
});


function cambiarAdministrador(idUsuario) {

	swalWithBootstrapButtons({
		title: 'Estas seguro de cambiar los permisos del usuario?',
		type: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Si, deseo cambiar',
		cancelButtonText: 'No, cancelar cambio',
		reverseButtons: true
	}).then((result) => {
		if (result.value) {

			$.post("Controlador/micuenta.php?op=cambiarAdministrador", {
				"idUsuario": idUsuario
			}, function () {}).done(function (data) {

				datos = JSON.parse(data);
				valorestado = datos.estado.type;
				valormsg = datos.estado.msg;

				switch (valorestado) {
					case 'success':
						$('#loader3').html('');
						alertaSuccess(valorestado, valormsg);
						autoRefrescar3();
						break;
					case 'error':
						$('#loader3').html('');
						alertaError(valorestado, valormsg);
						break;
					default:
						break;
				}


			}).fail(function () {
				valorestado = 'error';
				valormsg = 'Hubo un error al hacer la petición';
				alertaError(valorestado, valormsg);
			});

		} else if (result.dismiss === swal.DismissReason.cancel) {
			swalWithBootstrapButtons(
				'Operación Cancelada',
				'El permiso del usuario sigue igual',
				'error'
			)
		}
	});

}


function cambiarNormal(idUsuario) {

	swalWithBootstrapButtons({
		title: 'Estas seguro de cambiar los permisos del usuario?',
		type: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Si, deseo cambiar',
		cancelButtonText: 'No, cancelar cambio',
		reverseButtons: true
	}).then((result) => {
		if (result.value) {

			$.post("Controlador/micuenta.php?op=cambiarNormal", {
				"idUsuario": idUsuario
			}, function () {}).done(function (data) {

				datos = JSON.parse(data);
				valorestado = datos.estado.type;
				valormsg = datos.estado.msg;

				switch (valorestado) {
					case 'success':
						$('#loader3').html('');
						alertaSuccess(valorestado, valormsg);
						autoRefrescar3();
						break;
					case 'error':
						$('#loader3').html('');
						alertaError(valorestado, valormsg);
						break;
					default:
						break;
				}


			}).fail(function () {
				valorestado = 'error';
				valormsg = 'Hubo un error al hacer la petición';
				alertaError(valorestado, valormsg);
			});

		} else if (result.dismiss === swal.DismissReason.cancel) {
			swalWithBootstrapButtons(
				'Operación Cancelada',
				'El permiso del usuario sigue igual',
				'error'
			)
		}
	});

}


function DesactivarUsuario(idUsuario) {

	swalWithBootstrapButtons({
		title: 'Estas seguro de desactivar el usuario?',
		type: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Si, deseo desactivarlo',
		cancelButtonText: 'No, cancelar desactivación',
		reverseButtons: true
	}).then((result) => {
		if (result.value) {

			$.post("Controlador/micuenta.php?op=DesactivarUsuario", {
				"idUsuario": idUsuario
			}, function () {}).done(function (data) {

				datos = JSON.parse(data);
				valorestado = datos.estado.type;
				valormsg = datos.estado.msg;

				switch (valorestado) {
					case 'success':
						$('#loader3').html('');
						alertaSuccess(valorestado, valormsg);
						autoRefrescar3();
						break;
					case 'error':
						$('#loader3').html('');
						alertaError(valorestado, valormsg);
						break;
					default:
						break;
				}
			}).fail(function () {
				valorestado = 'error';
				valormsg = 'Hubo un error al hacer la petición';
				alertaError(valorestado, valormsg);
			});

		} else if (result.dismiss === swal.DismissReason.cancel) {
			swalWithBootstrapButtons(
				'Desactivación cancelada',
				'El usuario no fue desactivado',
				'error'
			)
		}
	});

}

function ActivarUsuario(idUsuario) {

	swalWithBootstrapButtons({
		title: 'Estas seguro de activar el usuario?',
		type: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Si, deseo activarlo',
		cancelButtonText: 'No, cancelar activación',
		reverseButtons: true
	}).then((result) => {
		if (result.value) {

			$.post("Controlador/micuenta.php?op=ActivarUsuario", {
				"idUsuario": idUsuario
			}, function () {}).done(function (data) {

				datos = JSON.parse(data);
				valorestado = datos.estado.type;
				valormsg = datos.estado.msg;

				switch (valorestado) {
					case 'success':
						$('#loader3').html('');
						alertaSuccess(valorestado, valormsg);
						autoRefrescar3();
						break;
					case 'error':
						$('#loader3').html('');
						alertaError(valorestado, valormsg);
						break;
					default:
						break;
				}
			}).fail(function () {
				valorestado = 'error';
				valormsg = 'Hubo un error al hacer la petición';
				alertaError(valorestado, valormsg);
			});

		} else if (result.dismiss === swal.DismissReason.cancel) {
			swalWithBootstrapButtons(
				'Activación cancelada',
				'El usuario no fue activado',
				'error'
			)
		}
	});

}


function eliminarMensaje(idMensaje) {

	swalWithBootstrapButtons({
		title: 'Estas seguro de eliminar el mensaje?',
		type: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Si, deseo eliminarlo',
		cancelButtonText: 'No, cancelar eliminación',
		reverseButtons: true
	}).then((result) => {
		if (result.value) {

			$.post("Controlador/mismensajes.php?op=eliminarMensaje", {
				"idMensaje": idMensaje
			}, function () {}).done(function (data) {

				datos = JSON.parse(data);
				valorestado = datos.estado.type;
				valormsg = datos.estado.msg;

				switch (valorestado) {
					case 'success':
						$('#loader3').html('');
						alertaSuccess(valorestado, valormsg);
						autoRefrescar4();
						if ($('#modalMensaje').length>0) {
						$('#modalMensaje').modal('hide');
						}
						break;
					case 'error':
						$('#loader3').html('');
						alertaError(valorestado, valormsg);
						break;
					default:
						break;
				}
			}).fail(function () {
				valorestado = 'error';
				valormsg = 'Hubo un error al hacer la petición';
				alertaError(valorestado, valormsg);
			});

		} else if (result.dismiss === swal.DismissReason.cancel) {
			swalWithBootstrapButtons(
				'Eliminación cancelada',
				'El mensaje no fue eliminado',
				'error'
			)
		}
	});

}


// Me falta arreglar esto
function verDocumentos(id) {
	$.post('Controlador/micuenta.php?op=VerArchivosDelUsuario', {
		"id": id
	}, function () {}).done(function (data) {
		$("#documentosTotalUsuario").html(data);
	}).fail(function (data) {});
}

function enviarMensaje(id) {
	$("#idUsuarioDelMensaje").val(id);
	$("#modalMensaje").modal('hide');
}

$("#enviar").on("click", function (event) {
	event.preventDefault();
	idUsuarioDelMensaje = $("#idUsuarioDelMensaje").val();
	mensaje = $("#mensaje").val();

	$.post('Controlador/mismensajes.php?op=EnviarMensajeAdministrador', {'idUsuarioDelMensaje':idUsuarioDelMensaje,'mensaje':mensaje }, function() {
	}).done(function(data){
	datos = JSON.parse(data);
	valorestado = datos.estado.type;
	valormsg = datos.estado.msg;
	alertaSuccess(valorestado, valormsg);
	$('#enviarMensajeAdministrador').modal('hide');

	}).fail(function(data){
	datos = JSON.parse(data);
	valorestado = datos.estado.type;
	valormsg = datos.estado.msg;
	alertaError(valorestado, valormsg);
	});
});

if ($("#graficaTotalArchivosAdministrador").length > 0 || $("#graficaTotalArchivos").length > 0) {
	// Radialize the colors
	Highcharts.setOptions({
		colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
			return {
				radialGradient: {
					cx: 0.5,
					cy: 0.3,
					r: 0.7
				},
				stops: [
					[0, color],
					[1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
				]
			};
		})
	});
}


if ($("#graficaTotalArchivosAdministrador").length > 0) {
	// Graficas del administrador solo los archivos
	var chart = new Highcharts.Chart({
		chart: {
			renderTo: 'graficaTotalArchivosAdministrador',
			type: 'column',
			events: {
				drilldown: function (e) {
					if (!e.seriesOptions) {
						var chart = this;

						this.setTitle(null, {
							text: 'Archivos total en el año: ' + e.point.name
						});

						$.ajax({
							url: "Controlador/misarchivos.php?op=MostrarGraficaArchivosMes&SeleccionarAno=" + e.point.name,
							method: "POST",
							dataType: "json",
							beforeSend: function () { //before make the ajax call
								$("#todo").show();
								$('#loader3').html('');
								chart.showLoading('<i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i><h2>Espera un momento...</h2>');
							}
						}).done(function (data) {
							drilldowns = {
								name: 'Archivos por Mes',
								id: e.point.name,
								data: data[0]
							}
							series = drilldowns;
							chart.addSeriesAsDrilldown(e.point, series);
							chart.hideLoading();
						});

					}
				},
				drillup: function (e) {
					this.setTitle(null, {
						text: 'Archivos total por año'
					});
				}
			}
		},
		title: {
			text: 'Archivos subidos al sistema'
		},
		subtitle: {
			text: 'Archivos total por año'
		},
		xAxis: {
			type: 'category'
		},
		yAxis: {
			className: 'highcharts-color',
			title: {
				text: 'Total de archivos'
			}

		},
		legend: {
			enabled: false
		},
		plotOptions: {
			column: {
				borderRadius: 5
			},
			series: {
				borderWidth: 0,
				dataLabels: {
					enabled: true
				}
			}
		},
		exporting: {
			enabled: true
		},
		tooltip: {
			headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
			pointFormat: '<span>En </span><span style="color:{point.color}">{point.name}</span>: Se subieron <b>{point.y}</b> archivos<br/>'
		}
	});
}

if ($("#graficaGeneralAdministrador").length > 0) {
	// Graficas del administrador general
	var chart2 = new Highcharts.Chart({
		chart: {
			renderTo: 'graficaGeneralAdministrador',
			type: 'pie'
		},
		title: {
			text: 'Información general del sistema'
		},
		subtitle: {
			text: 'Cantidad de archivos y usuarios registrados en el sistema'
		},
		xAxis: {
			categories: ['Usuarios', 'Archivos']
		},
		yAxis: {
			className: 'highcharts-color',
			title: {
				text: 'Total de registros'
			}

		},
		legend: {
			enabled: false
		},
		plotOptions: {
			column: {
				borderRadius: 5
			},
			series: {
				borderWidth: 0,
				dataLabels: {
					enabled: true
				}
			}
		},
		exporting: {
			enabled: true
		},
		tooltip: {
			headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
			pointFormat: '<span>Existen un total de </span><b>{point.y} </b> <strong>{point.name}</strong> registrados en el sistema<br/>'
		}
	});
}

if ($("#graficaFechaArchivos").length > 0) {

	// Graficas del usuario normal solo los archivos con fechas
	var chart4 = new Highcharts.Chart('graficaFechaArchivos', {
		chart: {
			// renderTo: 'graficaFechaArchivos',
			type: 'column',
			events: {
				drilldown: function (e) {
					if (!e.seriesOptions) {
						var chart = this;

						this.setTitle(null, {
							text: 'Archivos total en el año: ' + e.point.name
						});

						$.ajax({
							url: "Controlador/misarchivos.php?op=MostrarGraficaArchivosMesNormal&SeleccionarAno=" + e.point.name,
							method: "POST",
							dataType: "json",
							beforeSend: function () { //before make the ajax call
								$("#todo").show();
								$('#loader3').html('');
								chart.showLoading('<i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i><h2>Espera un momento...</h2>');
							}
						}).done(function (data) {
							drilldowns = {
								name: 'Archivos por Mes',
								id: e.point.name,
								data: data[0]
							}
							series = drilldowns;
							chart.addSeriesAsDrilldown(e.point, series);
							chart.hideLoading();
						}).fail(function (data) {
							console.log(data);
						});

					}
				},
				drillup: function (e) {
					this.setTitle(null, {
						text: 'Archivos total por año'
					});
				}
			}
		},
		title: {
			text: 'Archivos subidos al sistema'
		},
		subtitle: {
			text: 'Archivos total por año'
		},
		xAxis: {
			type: 'category'
		},
		yAxis: {
			className: 'highcharts-color',
			title: {
				text: 'Total de archivos'
			}

		},
		legend: {
			enabled: false
		},
		plotOptions: {
			column: {
				borderRadius: 5
			},
			series: {
				borderWidth: 0,
				dataLabels: {
					enabled: true
				}
			}
		},
		exporting: {
			enabled: true
		},
		tooltip: {
			headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
			pointFormat: '<span>En </span><span style="color:{point.color}">{point.name}</span>: Se subieron <b>{point.y}</b> archivos<br/>'
		}
	});

}

if ($("#graficaTotalArchivos").length > 0) {

	// Graficas del usuario normal
	var chart3 = new Highcharts.Chart('graficaTotalArchivos', {
		chart: {
			// renderTo: 'graficaTotalArchivos',
			type: 'pie'
		},
		title: {
			text: 'Información general del sistema'
		},
		subtitle: {
			text: 'Cantidad de archivos aprobados y no aprobados en el sistema'
		},
		xAxis: {
			categories: ['Usuarios', 'Archivos']
		},
		yAxis: {
			className: 'highcharts-color',
			title: {
				text: 'Total de registros'
			}

		},
		legend: {
			enabled: false
		},
		plotOptions: {
			column: {
				borderRadius: 5
			},
			series: {
				borderWidth: 0,
				dataLabels: {
					enabled: true
				}
			}
		},
		exporting: {
			enabled: true
		},
		tooltip: {
			headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
			pointFormat: '<span>Existen un total de </span><b>{point.y} </b> <strong>{point.name}</strong> en el sistema<br/>'
		}
	});

}


function graficarArchivos() {
	$.ajax({
			url: "Controlador/misarchivos.php?op=MostrarGraficaArchivos",
			method: "POST",
			dataType: "json",
			beforeSend: function () { //before make the ajax call
				chart.showLoading();
			}
		})
		.done(function (datos) {
			chart.addSeries({
				name: "Archivos por año",
				"colorByPoint": true,
				data: datos[0]
			});
			chart.hideLoading();

		});
}

function graficaGeneralAdministrador() {
	$.ajax({
			url: "Controlador/misarchivos.php?op=graficaGeneralAdministrador",
			method: "POST",
			dataType: "json",
			beforeSend: function () { //before make the ajax call
				chart2.showLoading();
			}
		})
		.done(function (datos) {
			chart2.addSeries({
				name: "Total de Registros",
				"colorByPoint": true,
				data: datos[0]
			});
			chart2.addSeries({
				name: "Total de registros",
				"colorByPoint": true,
				data: datos[1]
			});
			chart2.hideLoading();

		});
}

function graficarArchivosNormal() {
	$.ajax({
			url: "Controlador/misarchivos.php?op=MostrarGraficaArchivosNormal",
			method: "POST",
			dataType: "json",
			beforeSend: function () { //before make the ajax call
				chart4.showLoading();
			}
		})
		.done(function (datos) {
			chart4.addSeries({
				name: "Archivos por año",
				"colorByPoint": true,
				data: datos[0]
			});
			chart4.hideLoading();

		});
}


function graficaTotalArchivosNormal() {
	$.ajax({
			url: "Controlador/misarchivos.php?op=graficaTotalArchivosNormal",
			method: "POST",
			dataType: "json",
			beforeSend: function () { //before make the ajax call
				chart3.showLoading();
			}
		})
		.done(function (datos) {
			chart3.addSeries({
				name: "Total de Registros",
				"colorByPoint": true,
				data: datos[0]
			});
			chart3.addSeries({
				name: "Total de registros",
				"colorByPoint": true,
				data: datos[1]
			});
			chart3.hideLoading();

		}).fail(function (datos) {
			console.log(datos);
		});
}


if ($("#graficaTotalDocmentos").length > 0) {
	// Graficas de la cantidad de tipos de archivos subidos al sistema
	var chartTipo = new Highcharts.Chart('graficaTotalDocmentos', {
		chart: {
			type: 'pie'
		},
		title: {
			text: 'Información general de los documentos subidos por los usuarios'
		},
		subtitle: {
			text: 'Porcentaje de los tipos de archivos subidos al sistema'
		},
		xAxis: {
			categories: ['TXT', 'PDF', 'WORD', 'EXCEL', 'POWERPOINT']
		},
		yAxis: {
			className: 'highcharts-color',
			title: {
				text: 'Total de registros'
			}

		},
		legend: {
			enabled: false
		},
		plotOptions: {
			pie: {
				allowPointSelect: true,
				cursor: 'pointer'
			},
			column: {
				borderRadius: 5
			},
			series: {
				borderWidth: 0,
				dataLabels: {
					enabled: true,
					color: true,
					format: '<b>{point.name}</b>: {point.percentage:.1f}%'
				}
			}
		},
		exporting: {
			enabled: true
		},
		tooltip: {
			headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
			pointFormat: '<span>Hay un </span><b>{point.percentage:.1f}% </b> de archivos en formato <strong>{point.name}</strong> registrados en el sistema<br/>'
		}
	});
}


function graficaTotalDocmentos() {
	$.ajax({
			url: "Controlador/misarchivos.php?op=contarTipoDocumentos",
			method: "POST",
			dataType: "json",
			beforeSend: function () { //before make the ajax call
				chartTipo.showLoading();
			}
		})
		.done(function (datos) {
			chartTipo.addSeries({
				name: "Total de Registros",
				"colorByPoint": true,
				data: datos[0]
			});
			chartTipo.addSeries({
				name: "Total de registros",
				"colorByPoint": true,
				data: datos[1]
			});
			chartTipo.addSeries({
				name: "Total de registros",
				"colorByPoint": true,
				data: datos[2]
			});
			chartTipo.addSeries({
				name: "Total de registros",
				"colorByPoint": true,
				data: datos[3]
			});
			chartTipo.addSeries({
				name: "Total de registros",
				"colorByPoint": true,
				data: datos[4]
			});
			chartTipo.hideLoading();

		}).fail(function (e) {
			console.log(e.responseText);
		});
}


if ($("#graficaTotalDocmentos").length > 0) {
	graficaTotalDocmentos();
}
if ($("#graficaGeneralAdministrador").length > 0) {
	graficaGeneralAdministrador();
}
if ($("#graficaTotalArchivosAdministrador").length > 0) {
	graficarArchivos();
}
if ($("#graficaFechaArchivos").length > 0) {
	graficarArchivosNormal();
}
if ($("#graficaTotalArchivos").length > 0) {
	graficaTotalArchivosNormal();
}