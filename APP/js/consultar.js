
$(document).ready(function(){
    //getdeails será nuestra función para enviar la solicitud ajax
    $(window).load(function(e){
        if (sessionStorage.getItem("userNombre")==null) {
            alert("Por favor identifiquese");
            window.location.href="bienvenida.html";
        } else{
            buscarDataTable();
        };
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
    var tamano="";
    $('#bodyTable').html('');    
    for (var i = 0; i < Object.keys(data).length; i++) {
        // alert("HOLA");
        /*cableamos el tamaño de la mascota*/
        switch(data[i].tamano){
            case "1":
                tamano="PEQUEÑO";
            break;
            case "2":
                tamano="MEDIANO";
            break;
            case "3":
                tamano="GRANDE";
            break;
        }
        datos+='<tr> \
          <td><span id=lblnombre'+data[i].id_mascota+'>'+data[i].nombre_mascota+'</span></td>\
          <td><span id=lblraza'+data[i].id_mascota+'>'+data[i].raza+'</span></td>\
          <td><span id=lblcolor'+data[i].id_mascota+'>'+data[i].color+'</span></td>\
          <td><span id=lbltamano'+data[i].id_mascota+'>'+tamano+'</span></td>\
          <td><span id=lblid_pgs'+data[i].id_mascota+'>'+data[i].id_gps+'</span></td>\
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
    var res=confirm("Seguro desea eliminar esta mascota");
    if (res) {
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
                mostrarMensaje(response.data.message,'alert-success');
                buscarDataTable();
            } else {
                mostrarMensaje(response.data.message,'alert-error');
                console.log(response.data.message);
            }
        })
        .fail(function( jqXHR, textStatus, errorThrown ) {
            mostrarMensaje("Algo ha fallado: " +  textStatus,'alert-error');
            console.log(textStatus);
        });
    };
    
}

function buscarDataTable () {
    getMascotas(sessionStorage.userNum_identificacion)
    .done( function( response ) {
        //done() es ejecutada cuándo se recibe la respuesta del servidor. response es el objeto JSON recibido
        if( response.success ) {
            console.log(response.data);
            console.log(Object.keys(response.data.mascotas).length);
            mostrarMensaje(response.data.message,'alert-success');
            llenarTabla(response.data.mascotas);
        } else {
            $('#bodyTable').html('');   
            mostrarMensaje("Usted no posee mascotas registradas",'alert-warning');
            console.log(response.data.message);
        }
    })
    .fail(function( jqXHR, textStatus, errorThrown ) {
        mostrarMensaje("Algo ha fallado: " +  textStatus,'alert-danger');
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
    window.location ="modmascota.html?editar=true";
}

function salir () {
    /*Limpiar el session Storage*/
    sessionStorage.clear();   
    /*Reedireccionar a la pantalla principal*/
    window.location.href="bienvenida.html";   
}