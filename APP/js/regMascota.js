$(document).ready(function(){
//getdeails será nuestra función para enviar la solicitud ajax
var setMascotaNueva = function(nombre,raza,color,tamano,gps,num_iden_dueno){
  return $.ajax({
    // En data puedes utilizar un objeto JSON, un array o un query string
    data: {"solicitud" : "setMascotaNueva", "nombre":nombre,"raza":raza,"color":color,"tamano":tamano,"gps":gps,"num_iden_dueno":num_iden_dueno},
    //Cambiar a type: POST si necesario
    type: "GET",
    // Formato de datos que se espera en la respuesta
    dataType: "json",
    crossDomain :true,
    headers:{"Access-Control-Allow-Origin": "*"},
    // URL a la que se enviará la solicitud Ajax
    url: "http://192.168.1.109/webservices/webservices/crudMascota.php",
	});
}


//al hacer click sobre cualquier elemento que tenga el atributo data-user.....
$('#segMascota').submit(function(e){
    //Detenemos el comportamiento normal del evento click sobre el elemento clicado
    e.preventDefault();
    //Mostramos texto de que la solicitud está en curso
    // $("#response-container").html("<p>Buscando...</p>");
    //this hace referencia al elemento que ha lanzado el evento click
    setMascotaNueva($('#txtNombre').val(),$('#txtRaza').val(),$('#txtColor').val(),$('#cmbTamano').val(),$('#txtIdMascota').val(),sessionStorage.userNum_identificacion)
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
                $('#segMascota')[0].reset();
            } else {
                //response.success no es true
                // $("#response-container").html('No ha habido suerte: ' + response.data.message);
                console.log(response.data.message);
            }
        })
        .fail(function( jqXHR, textStatus, errorThrown ) {
            $("#response-container").html("Algo ha fallado: " +  textStatus);
             console.log(textStatus);
        });
    });

});

/*Funcion limpiar*/