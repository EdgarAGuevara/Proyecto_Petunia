
$(document).ready(function(){
    //getdeails será nuestra función para enviar la solicitud ajax
    $(btnBuscar).click(function(e){
        buscarDataTable();
    });
});

var getDueno = function(idMascota){
  return $.ajax({
    // En data puedes utilizar un objeto JSON, un array o un query string
    data: {"solicitud" : "getDueno", "idMascota" : idMascota},
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

function llenarTabla (data) {
    var datos="";
    $('#bodyTable').html('');    
    for (var i = 0; i < Object.keys(data).length; i++) {
        // alert("HOLA");
        datos+='<tr> \
          <td><span id=lblnombre'+data[i].num_identificacion+'>'+data[i].nombre+'</span></td>\
          <td><span id=lblraza'+data[i].num_identificacion+'>'+data[i].apellido+'</span></td>\
          <td><span id=lblcolor'+data[i].num_identificacion+'>'+data[i].correo+'</span></td>\
          <td><span id=lbltamano'+data[i].num_identificacion+'>'+data[i].telefono+'</span></td>\
        </tr>'
    };
    console.log(datos);
    $('#bodyTable').append(datos);
}

function buscarDataTable () {
    getDueno($('#txtIdMascota').val())
    .done( function( response ) {
        //done() es ejecutada cuándo se recibe la respuesta del servidor. response es el objeto JSON recibido
        if( response.success ) {
            console.log(response.data);
            console.log(Object.keys(response.data.users).length);
            mostrarMensaje(response.data.message,'alert-success');
            llenarTabla(response.data.users);
        } else {
            mostrarMensaje(response.data.message,'alert-danger');
            console.log(response.data.message);
        }
    })
    .fail(function( jqXHR, textStatus, errorThrown ) {
        mostrarMensaje("Algo ha fallado: " +  textStatus,'alert-danger');
        console.log(textStatus);
    });
}
