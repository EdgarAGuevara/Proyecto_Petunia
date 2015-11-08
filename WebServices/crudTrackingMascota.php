<?php
include_once 'TrackingMascota.php';

if( isset($_GET['solicitud']) ) {
 switch ($_GET['solicitud']) {
 	case 'setTrackingNueva':
  		setTrackingNueva($_GET['id_mascota'],$_GET['id_gps'],$_GET['lat'],$_GET['lng']);
 		break;
 	case 'getMascotacnId':
  		getMascotacnId($_GET['idMascota'],$_GET['ultimo']);
 		break;
 	default:
 		# code...
 		break;
 }
} else {
  die("Solicitud no válida.");
}

function setTrackingNueva($id_mascota="",$id_gps="",$lat="",$lng="")
{
	$tracking= new TrackingMascota;
	// echo $nick;
	$tracking->setId_mascota($id_mascota);
	$tracking->setId_gps($id_gps);
	$tracking->setLongitud_localizacion($lng);
	$tracking->setLatitud_localizacion($lat);
	$res=$tracking->set();
	if ($res!=false) {
		$jsondata = array();
		$jsondata["success"] = true;
	    $jsondata["data"]["message"] = "Se registro con exito su tracking nueva";
	    // $jsondata["data"]["users"] = array();
	    // var_dump($res);
	} else {
		$jsondata["success"] = false;
	    $jsondata["data"] = array(
	      'message' => 'No se pudo ingresar su tracking.'
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

function getMascotacnId($idMascota="",$ultimo="")
{
	$TrackingMascota= new TrackingMascota;
	// echo $nick;
	$TrackingMascota->setId_mascota($idMascota);
	$TrackingMascotas=$TrackingMascota->get("TrackingMascota");
	if ($TrackingMascotas!=false) {
		$jsondata = array();
		$jsondata["success"] = true;
	    $jsondata["data"]["message"] = "Se Consiguio Tracking";
	    $jsondata["data"]["TrackingMascotas"] = array();
	    // var_dump($TrackingMascotas);
		for ($i=0; $i <(count($TrackingMascotas)) ; $i++) { 
			// print("<br>NOMBRE User: ".$users[$i]->getNombre());
			$jsondata["data"]["mascota"][$i]["tracking_mascota"] = $TrackingMascotas[$i]->getId_tracking_mascota();
			$jsondata["data"]["mascota"][$i]["id_mascota"] = $TrackingMascotas[$i]->getId_mascota();
			$jsondata["data"]["mascota"][$i]["id_gps"] = $TrackingMascotas[$i]->getId_gps();
			$jsondata["data"]["mascota"][$i]["lng"] = $TrackingMascotas[$i]->getLongitud_localizacion();
			$jsondata["data"]["mascota"][$i]["lat"] = $TrackingMascotas[$i]->getLatitud_localizacion();
			if ($ultimo== "S") {
				break;
			}
			// var_dump($jsondata["data"]["users"]);
			// var_dump($users[$i]->getNombre());
		}
	} else {
		$jsondata["success"] = false;
	    $jsondata["data"] = array(
	      'message' => 'No se consiguio Tracking.'
	    );
	}

	header('Content-type: application/json; charset=utf-8');
  	echo json_encode($jsondata, JSON_FORCE_OBJECT);	
}
exit();

?>