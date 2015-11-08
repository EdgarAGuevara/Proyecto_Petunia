var map="";
var mascotas="";


$(document).ready(function(){
    //getdeails será nuestra función para enviar la solicitud ajax
    $(window).load(function(e){
        buscarMascota();
        setInterval("getLoca()",50000);
    });
});

var getMascotas = function(idMascota){
  return $.ajax({
    // En data puedes utilizar un objeto JSON, un array o un query string
    data: {"solicitud" : "getMascotacnId", "idMascota" : idMascota},
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

function buscarMascota () {
    var idMascota="123456";
    getMascotas(idMascota)
    .done( function( response ) {
        //done() es ejecutada cuándo se recibe la respuesta del servidor. response es el objeto JSON recibido
        if( response.success ) {
            console.log(response.data);
            mostrarMensaje(response.data.message,'alert-success');
            $("#lblNombreMascota").html(response.data.mascota[0].nombre_mascota.toUpperCase().bold());
            $("#lblGPSMascota").html(response.data.mascota[0].id_gps);
            localStorage.setItem("idMascota",response.data.mascota[0].id_mascota.toUpperCase().bold());
        } else {  
            mostrarMensaje("No se consiguio mascota registrada",'alert-warning');
            console.log(response.data.message);
        }
    })
    .fail(function( jqXHR, textStatus, errorThrown ) {
        mostrarMensaje("Algo ha fallado: " +  textStatus,'alert-danger');
        console.log(textStatus);
    });
}

/* OBENER LOCATION DE MASCOTA*/
var setMascota = function(idMascota,id_gps,lat,lng){
  return $.ajax({
    // En data puedes utilizar un objeto JSON, un array o un query string
    data: {"solicitud" : "setTrackingNueva", "id_mascota" : idMascota,"id_gps" : id_gps,"lat": lat,"lng":lng},
    //Cambiar a type: POST si necesario
    type: "GET",
    // Formato de datos que se espera en la respuesta
    dataType: "json",
    crossDomain :true,
    headers:{"Access-Control-Allow-Origin": "*"},
    // URL a la que se enviará la solicitud Ajax
    url: "http://192.168.1.109/webservices/webservices/crudTrackingMascota.php",
    });
}

function setLocaMascota () {
    setMascota(localStorage.getItem("idMascota"),$("#lblGPSMascota").val(),localStorage.getItem("lat"),localStorage.getItem("lng"))
    .done( function( response ) {
        //done() es ejecutada cuándo se recibe la respuesta del servidor. response es el objeto JSON recibido
        if( response.success ) {
            console.log(response.data);
            // mostrarMensaje(response.data.message,'alert-success');
            // colocarMarcador1();
        } else {  
            mostrarMensaje("No se puede conseguir Mascota con id, por favor comuniquese con el administrador",'alert-warning');
            console.log(response.data.message);
        }
    })
    .fail(function( jqXHR, textStatus, errorThrown ) {
        mostrarMensaje("Algo ha fallado: " +  textStatus,'alert-danger');
        console.log(textStatus);
    });
}
/*FIN OBENER LOCATION DE MASCOTA*/


/*OBTNER POSITION*/
function getLoca () {
    // console.log("HOLA");
	var pos;
	if (navigator.geolocation) {
		pos=navigator.geolocation.watchPosition(guardarpos);
	}
}

function guardarpos (pos) {
	// alert("LAT: "+pos.coords.latitude+ " LON: "+pos.coords.longitude);
	var lat=pos.coords.latitude;
	var lng=pos.coords.longitude;
    localStorage.setItem("lat",lat);
    localStorage.setItem("lng",lng);
    setLocaMascota();
}
/*FIN OBTENER POSITION*/



