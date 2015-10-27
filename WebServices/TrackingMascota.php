<?php
require_once 'DBAbstractModel.php';

/**
* 
*/
class TrackingMascota extends DBAbstractModel
{
	private $id_tracking_mascota;
	private $id_mascota;
	private $id_gps;
	private $longitud_localizacion;
	private $latitud_localizacion;

	public function getId_tracking_mascota(){
		return $this->id_tracking_mascota;
	}
	public function setId_tracking_mascota($id_tracking_mascota){
		$this->id_tracking_mascota=$id_tracking_mascota;
	}
	
	public function getId_mascota(){
		return $this->id_mascota;
	}
	public function setId_mascota($id_mascota){
		$this->id_mascota=$id_mascota;
	}	
	
	public function getId_gps(){
		return $this->id_gps;
	}
	public function setId_gps($id_gps){
		$this->id_gps=$id_gps;
	}
	
	public function getLongitud_localizacion(){
		return $this->longitud_localizacion;
	}
	public function setLongitud_localizacion($longitud_localizacion){
		$this->longitud_localizacion=$longitud_localizacion;
	}
	
	public function getLatitud_localizacion(){
		return $this->latitud_localizacion;
	}
	public function setLatitud_localizacion($latitud_localizacion){
		$this->latitud_localizacion=$latitud_localizacion;
	}

	
	// function __construct(argument)
	// {
	// 	# code...
	// }
}
?>