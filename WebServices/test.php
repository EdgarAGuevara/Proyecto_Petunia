<?php
include_once 'Mascota.php';
include_once 'UserDueno.php';

$mascota= new Mascota();
$mascotas=$mascota->get("Mascota");
for ($i=0; $i <(count($mascotas)) ; $i++) { 
	print("<br>NOMBRE MASCOTA: ".$mascotas[$i]->getNombre_mascota());
	// var_dump($mascotas[$i]->getNombre_mascota());	
}

$user= new UserDueno();
$users=$user->get("UserDueno");
for ($i=0; $i <(count($users)) ; $i++) { 
	print("<br>NOMBRE User: ".$users[$i]->getNombre());
	// var_dump($users[$i]->getNombre());
}

// $mascota->setNombre_mascota("EDGAR");
// $mascota->setRaza("PEDIGRI");
// $mascota->setColor("BLANCO");
// $mascota->setTamano("");
// $mascota->setId_gps("");
// $mascota->set();

$mascota->setId_Mascota(1);
$mascota->setNombre_mascota("EDGAR");
$mascota->setRaza("PEDIGRI");
$mascota->setColor("BLANCO");
$mascota->setTamano("");
$mascota->setId_gps("");
$mascota->edit();

$mascota->setId_Mascota(10);
$mascota->delete();

?>