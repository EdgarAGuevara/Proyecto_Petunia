function mostrarMensaje (mensaje,tipoMsj) {
	$('#msg').text(mensaje);	
	$('#msgInfo').addClass(tipoMsj );
	$('#msgInfo').removeClass('sr-only' );
}

function OcultarMensaje () {
	$('#msg').text("");
	$('#msgInfo').addClass('sr-only' )
}