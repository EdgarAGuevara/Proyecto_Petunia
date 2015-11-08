$(document).ready(function(){
//getdeails será nuestra función para enviar la solicitud ajax
var getdetails = function(nick,pass){
  return $.ajax({
    // En data puedes utilizar un objeto JSON, un array o un query string
    data: {"solicitud" : "getConParametros", "nick" : nick,"pass" : pass},
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
$('#formIngresar').submit(function(e){
    //Detenemos el comportamiento normal del evento click sobre el elemento clicado
    e.preventDefault();
    //Mostramos texto de que la solicitud está en curso
    // $("#response-container").html("<p>Buscando...</p>");
    //this hace referencia al elemento que ha lanzado el evento click
    //con el método .data('user') obtenemos el valor del atributo data-user de dicho elemento y lo pasamos a la función getdetails definida anteriormente
    getdetails($('#txtNick').val(),$('#txtPass').val())
        .done( function( response ) {
            //done() es ejecutada cuándo se recibe la respuesta del servidor. response es el objeto JSON recibido
            if( response.success ) {
	      
                // var output = "<h1>" + response.data.message + "</h1>";
                // //recorremos cada usuario
                // $.each(response.data.users, function( key, value ) {
                //     output += "<h2>Detalles del usuario " + value['ID'] + "</h2>";
                //     //recorremos los valores de cada usuario
                //     $.each( value, function ( userkey, uservalue) {
                //         output += '<ul>';
                //         output += '<li>' + userkey + ': ' + uservalue + "</li>";
                //         output += '</ul>';
                //     });
                // });

                // //Actualizamos el HTML del elemento con id="#response-container"
                // $("#response-container").html(output);
                console.log(response.data);
                console.log(response.data.message);
                mostrarMensaje(response.data.message,'alert-success');
                localStorage.clear();
                sessionStorage.clear();
                sessionStorage.setItem("userNombre", response.data.users[0].nombre);
                sessionStorage.setItem("userApellido", response.data.users[0].apellido);
                sessionStorage.setItem("userNum_identificacion", response.data.users[0].num_identificacion);
                sessionStorage.setItem("userCorreo", response.data.users[0].correo);
                sessionStorage.setItem("userTelefono", response.data.users[0].telefono);
                sessionStorage.setItem("userTipo_identifiacion", response.data.users[0].tipo_identificacion);
                
                $('#formIngresar').unbind('submit').submit();
            } else {
                mostrarMensaje(response.data.message,'alert-danger');
                console.log(response.data.message);
            }
        })
        .fail(function( jqXHR, textStatus, errorThrown ) {
            mostrarMensaje("Algo ha fallado: " +  textStatus,'alert-danger');
            console.log(textStatus);
        });
    });
});