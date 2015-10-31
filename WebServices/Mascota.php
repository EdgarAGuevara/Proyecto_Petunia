<?php
require_once 'DBAbstractModel.php';

Class Mascota extends DBAbstractModel  {
	private $id_mascota	;
	private $nombre_mascota;
	private $raza;	
	private $color;	
	private $tamano;	
	private $id_gps;
	private $num_id_dueno;


	public function getId_mascota(){
		return $this->id_mascota;
	}	
	public function setId_mascota($id_mascota){
		$this->id_mascota=$id_mascota;	
	}	
	public function getNombre_mascota(){
		return $this->nombre_mascota;
	}
	public function setNombre_mascota($nombre_mascota){
		$this->nombre_mascota=$nombre_mascota;
	}
	public function getRaza(){
		return $this->raza;
	}
	public function setRaza($raza){
		$this->raza=$raza;
	}	
	public function getColor(){
		return $this->color;
	}
	public function setColor($color){
		$this->color=$color;
	}	
	public function getTamano(){
		return $this->tamano;
	}
	public function setTamano($tamano){
		$this->tamano=$tamano;
	}	
	public function getId_gps(){
		return $this->id_gps;
	}
	public function setId_gps($id_gps){
		$this->id_gps=$id_gps;
	}
	public function getNum_id_dueno(){
		return $this->num_id_dueno;
	}
	public function setNum_id_dueno($num_id_dueno){
		$this->num_id_dueno=$num_id_dueno;
	}

	public function get($class='')
	{
		$this->query="select * from mascota where num_identificacion_dueno=".$this->getNum_id_dueno();
		var_dump($this->query);
		if ($this->getResult($class)) {
			// var_dump();
			return $this->rows;
		} else {
			return false;
		}
	}

	public function getDueno($class='')
	{
		$this->query="select num_identificacion_dueno from mascota where id_gps=".$this->getId_gps();
		if ($this->getResult($class)) {
			// var_dump();
			return $this->rows;
		} else {
			return false;
		}
	}

	public function set()
	{
		$this->query="INSERT INTO mascota (nombre_mascota,raza,color,tamano,id_gps,num_identificacion_dueno) 
						VALUES (?,?,?,?,?,?)";
		$values= array($this->getNombre_mascota(),
			$this->getRaza(),
			$this->getColor(),
			$this->getTamano(),
			$this->getId_gps(),
			$this->getNum_id_dueno() );
		// echo "O";
		// var_dump($values);
		if ($this->setDatos($values)) {
			// var_dump($this->rows);
			return true;
		} else {
			return false;
		}
	}

	/*TODO QUE FUNCIONE SOLO INDEPENDIENTEMENTE*/
	public function edit()
	{
		$this->query="UPDATE mascota SET nombre_mascota=?,raza=?,color=?,tamano=?,id_gps=? 
						WHERE id_mascota=?";
		$values= array($this->getNombre_mascota(),
			$this->getRaza(),
			$this->getColor(),
			$this->getTamano(),
			$this->getId_gps(),
			$this->getId_mascota() );
		var_dump($values);
		if ($this->setDatos($values)) {
			// var_dump();
			return $this->rows;
		} else {
			return false;
		}
	}

	public function delete()
	{
		$this->query="DELETE FROM mascota  
						WHERE id_mascota=?";
		$values= array($this->getId_mascota() );
		// var_dump($values);
		if ($this->setDatos($values)) {
			// var_dump();
			return true;
		} else {
			return false;
		}
	}
}

?>