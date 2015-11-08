var map="";
var mascotas="";

$(window).load(function(e){
    // $("#map").toggle();
    if (sessionStorage.getItem("userNombre")==null) {
        alert("Por favor identifiquese");
        window.location.href="bienvenida.html";
    } else{
        buscarDataMascota();
    };
});

$(document).ready(function(){
    //getdeails será nuestra función para enviar la solicitud ajax
   
});

/*BUSCAR MASCOTAS*/
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

function buscarDataMascota () {
    getMascotas(sessionStorage.userNum_identificacion)
    .done( function( response ) {
        //done() es ejecutada cuándo se recibe la respuesta del servidor. response es el objeto JSON recibido
        if( response.success ) {
            console.log(response.data);
            console.log(Object.keys(response.data.mascotas).length);
            mostrarMensaje(response.data.message,'alert-success');
            llenarCombo(response.data.mascotas);
        } else {  
            mostrarMensaje("Usted no posee mascotas registradas",'alert-warning');
            console.log(response.data.message);
        }
    })
    .fail(function( jqXHR, textStatus, errorThrown ) {
        mostrarMensaje("Algo ha fallado: " +  textStatus,'alert-danger');
        console.log(textStatus);
    });
}

function llenarCombo(data) {
    var datos="";

    $('#cmbMascotas').find('option').remove();
    $('#cmbMascotas').append(datos)
    for (var i = 0; i < Object.keys(data).length; i++) {
        // alert("HOLA");
        datos='<option value="'+data[i].id_mascota+'">'+data[i].nombre_mascota+'</option>'
    	$('#cmbMascotas').append(datos)
    };
    console.log(datos);;
}
/*FIN BUSCAR MASCOTAS*/

function initMap() {
  // Create a map object and specify the DOM element for display.
  map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: 10.5004352, lng: -66.9511459},
    scrollwheel: true,
    zoom: 10
  });
}



/* OBENER LOCATION DE MASCOTA*/
function getLoca () {
	getLocaMascota();
    // colocarMarcador1();
}

var getMascota = function(idMascota){
  return $.ajax({
    // En data puedes utilizar un objeto JSON, un array o un query string
    data: {"solicitud" : "getMascotacnId", "idMascota" : idMascota,"ultimo": "S"},
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

function getLocaMascota () {
    getMascota($("#cmbMascotas").val())
    .done( function( response ) {
        //done() es ejecutada cuándo se recibe la respuesta del servidor. response es el objeto JSON recibido
        if( response.success ) {
            console.log(response.data);
            console.log(Object.keys(response.data.mascota).length);
            // mostrarMensaje(response.data.message,'alert-success');
            // colocarMarcador1();
            for (var i = 0; i < Object.keys(response.data.mascota).length; i++) {
		        // alert("HOLA");
		        colocarMarcador(response.data.mascota[i]);
		    };
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

function colocarMarcador (mascota) {
	// console.log(Number(mascota.lng));
	// console.log(Number(mascota.lat));
	var lat=Number(mascota.lat);	
	var lng=Number(mascota.lng);
	var marker= new google.maps.Marker({
		position: new google.maps.LatLng(lat,lng),
		// position: {lat: Number(mascota.lat), lng: Number(mascota.lng)},
		map: map
	});
	marker.setMap(map);
    // $("#map").toggle();
}
// function colocarMarcador1 () {
// 	var marker= new google.maps.Marker({
// 		position: new google.maps.LatLng(Number(10.507222562835883),Number(-66.90821863320309)),
// 		// position: {lat: Number(mascota.lat), lng: Number(mascota.lng)},
// 		map: map
// 	});
// 	marker.setMap(map);
// }

/*OBTNER POSITION*/
// function getLoca () {
// 	var pos;
// 	if (navigator.geolocation) {
// 		pos=navigator.geolocation.getCurrentPosition(showPosition);
// 	}
// }

// function showPosition (pos) {
// 	// alert("LAT: "+pos.coords.latitude+ " LON: "+pos.coords.longitude);
// 	var lat=pos.coords.latitude;
// 	var lng=pos.coords.longitude;
// 	var marker= new google.maps.Marker({
// 		position: {lat: pos.coords.latitude, lng:pos.coords.longitude},
// 		map: map,
// 		title: 'Mascota: FIFI',
// 		label: 'F'
// 	});

// }
/*FIN OBTENER POSITION*/

function salir () {
    /*Limpiar el session Storage*/
    sessionStorage.clear();   
    /*Reedireccionar a la pantalla principal*/
    window.location.href="bienvenida.html";   
}