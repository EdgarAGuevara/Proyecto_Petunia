<?php
include_once 'Mascota.php';

if( isset($_GET['solicitud']) ) {
 switch ($_GET['solicitud']) {
 	case 'setMascotaNueva':
  		setMascotaNueva($_GET['nombre'],$_GET['raza'],$_GET['color'],$_GET['tamano'],$_GET['gps'],$_GET['num_iden_dueno']);
 		break;
 	case 'getMascotasDeDueno':
  		getMascotasDeDueno($_GET['idDueno']);
 		break;
	case 'delete':
  		delete($_GET['id_mascota']);
 		break;	
 	
 	default:
 		# code...
 		break;
 }
} else {
  die("Solicitud no válida.");
}

function setMascotaNueva($nombre="",$raza="",$color="",$tamano="",$gps="",$num_iden_dueno="")
{
	$mascota= new Mascota;
	// echo $nick;
	$mascota->setNombre_mascota($nombre);
	$mascota->setRaza($raza);
	$mascota->setColor($color);
	$mascota->setTamano($tamano);
	$mascota->setId_gps($gps);
	$mascota->setNum_id_dueno($num_iden_dueno);
	$res=$mascota->set();
	if ($res!=false) {
		$jsondata = array();
		$jsondata["success"] = true;
	    $jsondata["data"]["message"] = "Se registro con exito su mascota nueva";
	    // $jsondata["data"]["users"] = array();
	    // var_dump($res);
	} else {
		$jsondata["success"] = false;
	    $jsondata["data"] = array(
	      'message' => 'No se pudo ingresar su mascota.'
	    );
	}

	header('Content-type: application/json; charset=utf-8');
  	echo json_encode($jsondata, JSON_FORCE_OBJECT);	
}

function getMascotasDeDueno($idDueno="")
{
	$mascota= new Mascota;
	// echo $nick;
	$mascota->setNum_id_dueno($idDueno);
	$mascotas=$mascota->get("Mascota");
	if ($mascotas!=false) {
		$jsondata = array();
		$jsondata["success"] = true;
	    $jsondata["data"]["message"] = "Se Consiguieron Mascotas ";
	    $jsondata["data"]["mascotas"] = array();
	    // var_dump($mascotas);
		for ($i=0; $i <(count($mascotas)) ; $i++) { 
			// print("<br>NOMBRE User: ".$users[$i]->getNombre());
			$jsondata["data"]["mascotas"][$i]["id_mascota"] = $mascotas[$i]->getId_mascota();
			$jsondata["data"]["mascotas"][$i]["nombre_mascota"] = $mascotas[$i]->getNombre_mascota();
			$jsondata["data"]["mascotas"][$i]["raza"] = $mascotas[$i]->getRaza();
			$jsondata["data"]["mascotas"][$i]["color"] = $mascotas[$i]->getColor();
			$jsondata["data"]["mascotas"][$i]["tamano"] = $mascotas[$i]->getTamano();
			$jsondata["data"]["mascotas"][$i]["id_gps"] = $mascotas[$i]->getId_gps();
			$jsondata["data"]["mascotas"][$i]["num_id_dueno"] = $mascotas[$i]->getNum_id_dueno();
			// var_dump($jsondata["data"]["users"]);
			// var_dump($users[$i]->getNombre());
		}
	} else {
		$jsondata["success"] = false;
	    $jsondata["data"] = array(
	      'message' => 'No se consiguieron Mascotas.'
	    );
	}

	header('Content-type: application/json; charset=utf-8');
  	echo json_encode($jsondata, JSON_FORCE_OBJECT);	
}

function delete($id_mascota="")
{
	$mascota= new Mascota;
	// echo $nick;
	$mascota->setId_mascota($id_mascota);
	$res=$mascota->delete();
	if ($res!=false) {
		$jsondata = array();
		$jsondata["success"] = true;
	    $jsondata["data"]["message"] = "Se registro fue eliminado con exito";
	    // $jsondata["data"]["users"] = array();
	    // var_dump($res);
	} else {
		$jsondata["success"] = false;
	    $jsondata["data"] = array(
	      'message' => 'No se pudo eliminar su mascota.'
	    );
	}

	header('Content-type: application/json; charset=utf-8');
  	echo json_encode($jsondata, JSON_FORCE_OBJECT);	
}

exit();

?>