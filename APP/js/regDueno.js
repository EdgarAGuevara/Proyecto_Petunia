$(document).ready(function(){
//getdeails será nuestra función para enviar la solicitud ajax
var setUserNuevo = function(nombre,apellido,tipo_documento,num_identificacion,telefono,correo,pass){
  return $.ajax({
    // En data puedes utilizar un objeto JSON, un array o un query string
    data: {"solicitud" : "setUserNuevo", "nombre":nombre,"apellido":apellido,"tipo_documento":tipo_documento,"num_identificacion":num_identificacion,"telefono":telefono,"correo":correo,"pass":pass},
    //Cambiar a type: POST si necesario
    type: "GET",
    // Formato de datos que se espera en la respuesta
    dataType: "json",
    crossDomain :true,
    headers:{"Access-Control-Allow-Origin": "*"},
    // URL a la que se enviará la solicitud Ajax
    url: "http://192.168.1.109/webservices/webservices/crudUserDueno.php",
	});
}


//al hacer click sobre cualquier elemento que tenga el atributo data-user.....
$('#regUser').submit(function(e){
    //Detenemos el comportamiento normal del evento click sobre el elemento clicado
    e.preventDefault();

    if ($('#txtCorreo').val()== $('#txtConfirmCorreo').val()) {
        // $("#response-container").html("<p>Buscando...</p>");
        setUserNuevo($('#txtNombre').val(),$('#txtApellido').val(),$('#cmbTipoIden').val(),$('#txtNumIden').val(),$('#txtTelefono').val(),$('#txtCorreo').val(),$('#txtPass').val())
            .done( function( response ) {
                //done() es ejecutada cuándo se recibe la respuesta del servidor. response es el objeto JSON recibido
                if( response.success ) {
                    console.log(response.data);
                    console.log(response.data.message);
                    mostrarMensaje(response.data.message,'alert-success');
                    $('#regUser')[0].reset();
                } else {
                    //response.success no es true
                    // $("#response-container").html('No ha habido suerte: ' + response.data.message);
                    console.log(response.data.message);
                    mostrarMensaje(response.data.message,'alert-danger');
                    $('#segMascota')[0].reset();
                }
            })
            .fail(function( jqXHR, textStatus, errorThrown ) {
                // $("#response-container").html("Algo ha fallado: " +  textStatus);
                console.log("Algo ha fallado: " + textStatus);
                mostrarMensaje("Algo ha fallado: " + textStatus,'alert-danger');
            });
    } else{
        alert("Por favor Valide el correo electoronico");
    };
});

});

/*Funcion limpiar*/