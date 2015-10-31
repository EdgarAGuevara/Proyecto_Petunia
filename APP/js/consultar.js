
$(document).ready(function(){
    //getdeails será nuestra función para enviar la solicitud ajax
    $(window).load(function(e){
        buscarDataTable();
    });
});

var getMascotas = function(idDueno){
  return $.ajax({
    // En data puedes utilizar un objeto JSON, un array o un query string
    data: {"solicitud" : "getMascotasDeDueno", "idDueno" : idDueno},
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

function llenarTabla (data) {
    var datos="";
    $('#bodyTable').html('');    
    for (var i = 0; i < Object.keys(data).length; i++) {
        // alert("HOLA");
        datos+='<tr> \
          <td><span id=lblnombre'+data[i].id_mascota+'>'+data[i].nombre_mascota+'</span></td>\
          <td><span id=lblraza'+data[i].id_mascota+'>'+data[i].raza+'</span></td>\
          <td><span id=lblcolor'+data[i].id_mascota+'>'+data[i].color+'</span></td>\
          <td><span id=lbltamano'+data[i].id_mascota+'>'+data[i].tamano+'</span></td>\
          <td><span id=lblid_pgs'+data[i].id_mascota+'>'+data[i].id_gps+'</span></td>\
          <td><span id=lblidmascota'+data[i].id_mascota+'>'+data[i].id_mascota+'</span></td>\
          <td>\
              <button type="button" id="btnModificar'+data[i].id_mascota+'" class="btn btn-info" onclick="editar('+data[i].id_mascota+')">\
                <span class="glyphicon glyphicon-tasks" aria-hidden="true"></span>\
              </button>\
          </td>\
          <td>\
              <button type="button" id="btnBorrar'+data[i].id_mascota+'" class="btn btn-danger" onclick="eliminar('+data[i].id_mascota+')">\
                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>\
              </button>\
          </td>\
        </tr>'
    };
    console.log(datos);
    $('#bodyTable').append(datos);
}

function eliminar (id_mascota) {
    $.ajax({
    // En data puedes utilizar un objeto JSON, un array o un query string
    data: {"solicitud" : "delete", "id_mascota" : id_mascota},
    //Cambiar a type: POST si necesario
    type: "GET",
    // Formato de datos que se espera en la respuesta
    dataType: "json",
    crossDomain :true,
    headers:{"Access-Control-Allow-Origin": "*"},
    // URL a la que se enviará la solicitud Ajax
    url: "http://192.168.1.109/webservices/webservices/crudMascota.php",
    })
    .done( function( response ) {
        //done() es ejecutada cuándo se recibe la respuesta del servidor. response es el objeto JSON recibido
        if( response.success ) {
            console.log(response.data);
            buscarDataTable();
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
}

function buscarDataTable () {
    getMascotas(sessionStorage.userNum_identificacion)
    .done( function( response ) {
        //done() es ejecutada cuándo se recibe la respuesta del servidor. response es el objeto JSON recibido
        if( response.success ) {
            console.log(response.data);
            console.log(Object.keys(response.data.mascotas).length);
            llenarTabla(response.data.mascotas);
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
}

function editar (id_mascota) {
    localStorage.clear();
    localStorage.setItem("mascotaEdit_Nombre", $('#lblnombre'+id_mascota).text()    );
    localStorage.setItem("mascotaEdit_Raza", $('#lblraza'+id_mascota).text()   );
    localStorage.setItem("mascotaEdit_Color", $('#lblcolor'+id_mascota).text()   );
    localStorage.setItem("mascotaEdit_Tamano", $('#lbltamano'+id_mascota).text()   );
    localStorage.setItem("mascotaEdit_IDGPS", $('#lblid_pgs'+id_mascota).text()   );
    localStorage.setItem("mascotaEdit_IdMascota", $('#lblidmascota'+id_mascota).text()   );
    window.location ="regMascota.html?editar=true";
}