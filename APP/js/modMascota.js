$(document).ready(function(){
    if (sessionStorage.getItem("userNombre")==null) {
        alert("Por favor identifiquese");
        window.location.href="bienvenida.html";
    } else{
        //getdeails será nuestra función para enviar la solicitud ajax
        var editMascota= function(nombre,raza,color,tamano,gps,num_iden_dueno){
          return $.ajax({
            // En data puedes utilizar un objeto JSON, un array o un query string
            data: {"solicitud" : "edit", "nombre":nombre,"raza":raza,"color":color,"tamano":tamano,"gps":gps,"num_iden_dueno":num_iden_dueno},
            //Cambiar a type: POST si necesario
            type: "GET",
            // Formato de datos que se espera en la respuesta
            dataType: "json",
            crossDomain :true,
            headers:{"Access-Control-Allow-Origin": "*"},
            // URL a la que se enviará la solicitud Ajax
            url: "http://192.168.1.109/webservices/webservices/crudMascota.php",
            });
    };
    llenarTabla();
}


//al hacer click sobre cualquier elemento que tenga el atributo data-user.....
$('#segMascota').submit(function(e){
    //Detenemos el comportamiento normal del evento click sobre el elemento clicado
    e.preventDefault();
    //Mostramos texto de que la solicitud está en curso
    // $("#response-container").html("<p>Buscando...</p>");
    //this hace referencia al elemento que ha lanzado el evento click
    editMascota($('#txtNombre').val(),$('#txtRaza').val(),$('#txtColor').val(),$('#cmbTamano').val(),localStorage.getItem("mascotaEdit_IDGPS"),sessionStorage.userNum_identificacion)
        .done( function( response ) {
            //done() es ejecutada cuándo se recibe la respuesta del servidor. response es el objeto JSON recibido
            if( response.success ) {
	            console.log(response.data);
                console.log(response.data.message);
                mostrarMensaje(response.data.message,'alert-success');
                alert(response.data.message);
                cancelar();
                // $('#segMascota')[0].reset();
            } else {
                console.log(response.data.message);
                mostrarMensaje(response.data.message,'alert-danger');
            }
        })
        .fail(function( jqXHR, textStatus, errorThrown ) {
             mostrarMensaje("Algo ha fallado: " + textStatus,'alert-danger');
             console.log(textStatus);
        });
    });

});

function salir () {
    /*Limpiar el session Storage*/
    sessionStorage.clear();   
    /*Reedireccionar a la pantalla principal*/
    window.location.href="bienvenida.html";   
}
function cancelar () {
    /*Limpiar el session Storage*/
    localStorage.clear();   
    /*Reedireccionar a la pantalla principal*/
    window.location.href="consultar.html";   
}


function llenarTabla () {
    var datos="";
    var tamano="";
    $('#bodyTable').html('');    
    // alert("HOLA");
    /*cableamos el tamaño de la mascota*/
    switch(localStorage.getItem("mascotaEdit_Tamano")){
        case "PEQUEÑO":
            tamano=1;
        break;
        case "MEDIANO":
            tamano=2;
        break;
        case "GRANDE":
            tamano=3;
        break;
    }
   $('#txtNombre').val(localStorage.getItem("mascotaEdit_Nombre"));
   $('#txtRaza').val(localStorage.getItem("mascotaEdit_Raza"));
   $('#txtColor').val(localStorage.getItem("mascotaEdit_Color"));
   $('#cmbTamano option[value="'+tamano+'"]').attr('selected','selected');
   $('#txtIdMascota').val(localStorage.getItem("mascotaEdit_IDGPS"));
}
