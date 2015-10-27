<?php
require_once 'DBAbstractModel.php';

Class Mascota extends DBAbstractModel  {
	private $id_mascota	;
	private $nombre_mascota;
	private $raza;	
	private $color;	
	private $tamano;	
	private $id_gps;


	public getId_mascota(){
		return $this->id_mascota;
	}	
	public setId_mascota($id_mascota){
		$this->id_mascota=$id_mascota;	
	}	
	public getNombre_mascota(){
		return $this->nombre_mascota;
	}
	public setNombre_mascota($nombre_mascota){
		$this->nombre_mascota=$nombre_mascota;
	}
	public getRaza(){
		return $this->raza;
	}
	public setRaza($raza){
		$this->raza=$raza;
	}	
	public getColor(){
		return $this->color;
	}
	public setColor($color){
		$this->color=$color;
	}	
	public getTamano(){
		return $this->tamano;
	}
	public setTamano($tamano){
		$this->tamano=$tamano;
	}	
	public getId_gps(){
		return $this->id_gps;
	}
	public setId_gps($id_gps){
		$this->id_gps=$id_gps;
	}
}

?>