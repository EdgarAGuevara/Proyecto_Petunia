
$(document).ready(function(){
    //getdeails será nuestra función para enviar la solicitud ajax
    $(window).load(function(e){
        if (sessionStorage.getItem("userNombre")==null) {
        	alert("Por favor identifiquese");
        	window.location.href="bienvenida.html";
        } else{
        	mostrarNombre();
       	};
    });
});

function mostrarNombre (data) {
    var datos="";
    $('#lblNombreUser').html('');    
    datos=sessionStorage.userNombre+" "+sessionStorage.userApellido;
    $('#lblNombreUser').html(datos.toUpperCase().bold());
}

function salir () {
    /*Limpiar el session Storage*/
    sessionStorage.clear();   
    /*Reedireccionar a la pantalla principal*/
    window.location.href="bienvenida.html";   
}