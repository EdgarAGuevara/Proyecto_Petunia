<?php
include_once 'UserDueno.php';
include_once 'Mascota.php';

if( isset($_GET['solicitud']) ) {
 switch ($_GET['solicitud']) {
 	case 'getConParametros':
  		getUserValidado($_GET['nick'],$_GET['pass']);
 		break;
 	case 'setUserNuevo':
  		setUserNuevo($_GET['nombre'],$_GET['apellido'],$_GET['tipo_documento'],$_GET['num_identificacion'],$_GET['telefono'],$_GET['correo'],$_GET['pass']);
 		break;
 	case 'getDueno':
  		getDueno($_GET['idMascota']);
 		break;
 	default:
 		# code...
 		break;
 }
} else {
  die("Solicitud no válida.");
}

function getUserValidado($nick='',$pass='')
{
	$user= new UserDueno;
	// echo $nick;
	$users=$user->getUserValidado("UserDueno",$nick,$pass);
	if ($users!=false) {
		$jsondata = array();
		$jsondata["success"] = true;
	    $jsondata["data"]["message"] = "Se han encontrado usuarios";
	    $jsondata["data"]["users"] = array();

		for ($i=0; $i <(count($users)) ; $i++) { 
			// print("<br>NOMBRE User: ".$users[$i]->getNombre());
			$jsondata["data"]["users"][$i]["nombre"] = $users[$i]->getNombre();
			$jsondata["data"]["users"][$i]["apellido"] = $users[$i]->getApellido();
			$jsondata["data"]["users"][$i]["num_identificacion"] = $users[$i]->getNum_identificacion();
			$jsondata["data"]["users"][$i]["correo"] = $users[$i]->getCorreo();
			$jsondata["data"]["users"][$i]["telefono"] = $users[$i]->getTelefono();
			$jsondata["data"]["users"][$i]["tipo_identificacion"] = $users[$i]->getTipo_identificacion();
			// var_dump($jsondata["data"]["users"]);
			// var_dump($users[$i]->getNombre());
		}
	} else {
		$jsondata["success"] = false;
	    $jsondata["data"] = array(
	      'message' => 'No se encontró ningún resultado.'
	    );
	}

	header('Content-type: application/json; charset=utf-8');
  	echo json_encode($jsondata, JSON_FORCE_OBJECT);	
}

function setUserNuevo($nombre="",$apellido="",$tipo_documento="",$num_identificacion="",$telefono="",$correo="",$pass="")
{
	$UserDueno= new UserDueno;
	// echo $nick;
	$UserDueno->setNum_identificacion($num_identificacion);
	$UserDueno->setNombre($nombre);
	$UserDueno->setApellido($apellido);
	$UserDueno->setCorreo($correo);
	$UserDueno->setTelefono($telefono);
	$UserDueno->setTipo_identificacion($tipo_documento);
	$UserDueno->setPass($pass);
	$res=$UserDueno->set();
	if ($res!=false) {
		$jsondata = array();
		$jsondata["success"] = true;
	    $jsondata["data"]["message"] = "Se registro con exito";
	    // $jsondata["data"]["users"] = array();
	    // var_dump($res);
	} else {
		$jsondata["success"] = false;
	    $jsondata["data"] = array(
	      'message' => 'No se pudo ingresar su usuario nuevo.'
	    );
	}

	header('Content-type: application/json; charset=utf-8');
  	echo json_encode($jsondata, JSON_FORCE_OBJECT);	
}

function getDueno($idMascota)
{
	$mascota= new Mascota;
	$user= new UserDueno;
	$mascota->setId_gps($idMascota);
	$res=$mascota->getDueno("Mascota");
	if ($res!=false) {
		// var_dump($res[0]);
		for ($i=0; $i <(count($res)) ; $i++) { 
			// print("<br>NOMBRE User: ".$res[$i]->getNum_id_dueno());
			$user->setNum_identificacion($res[$i]->num_identificacion_dueno);
			// var_dump($jsondata["data"]["res"]);
			// var_dump($res[$i]->getNombre());
		}
		// var_dump($user);
		$users=$user->get("UserDueno");
		if ($users!=false) {
			$jsondata = array();
			$jsondata["success"] = true;
		    $jsondata["data"]["message"] = "Se ha encontrado su usuario con exito";
		    $jsondata["data"]["users"] = array();

			for ($i=0; $i <(count($users)) ; $i++) { 
				// print("<br>NOMBRE User: ".$users[$i]->getNombre());
				$jsondata["data"]["users"][$i]["nombre"] = $users[$i]->getNombre();
				$jsondata["data"]["users"][$i]["apellido"] = $users[$i]->getApellido();
				$jsondata["data"]["users"][$i]["num_identificacion"] = $users[$i]->getNum_identificacion();
				$jsondata["data"]["users"][$i]["correo"] = $users[$i]->getCorreo();
				$jsondata["data"]["users"][$i]["telefono"] = $users[$i]->getTelefono();
				$jsondata["data"]["users"][$i]["tipo_identificacion"] = $users[$i]->getTipo_identificacion();
				// var_dump($jsondata["data"]["users"]);
				// var_dump($users[$i]->getNombre());
			}
		} else {
			$jsondata["success"] = false;
		    $jsondata["data"] = array(
		      'message' => 'No se encontró ningún resultado.');
		}    
	} else {
		$jsondata["success"] = false;
	    $jsondata["data"] = array(
	      'message' => 'No se encontró ninguna mascota con ese id.'
	    );
	}

	header('Content-type: application/json; charset=utf-8');
  	echo json_encode($jsondata, JSON_FORCE_OBJECT);	
}

exit();

?>