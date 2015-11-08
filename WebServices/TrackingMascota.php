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

	
	public function get($class='')
	{
		$this->query="SELECT * FROM tracking_mascota WHERE id_mascota=".$this->getId_mascota()." order by id_tracking_mascota DESC";
		// var_dump($this->query);
		if ($this->getResult($class)) {
			// var_dump();
			return $this->rows;
		} else {
			return false;
		}
	}


	public function set()
	{

		$this->query="INSERT INTO tracking_mascota (id_mascota,id_gps,longitud_localizacion,latitud_localizacion) 
						VALUES (?,?,?,?)";
		$values= array($this->getId_mascota(),
			$this->getId_gps(),
			$this->getLongitud_localizacion(),
			$this->getLatitud_localizacion()
		);
		// echo "O";
		// var_dump($values);
		if ($this->setDatos($values)) {
			// var_dump($this->rows);
			return true;
		} else {
			return false;
		}
	}

	public function edit(){

	}

	public function delete(){

	}

	// function __construct(argument)
	// {
	// 	# code...
	// }
}
?>