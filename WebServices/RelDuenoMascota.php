<?php	
include_once 'DBAbstractModel.php';

/**
* 
*/
class ClassName extends AnotherClass
{
	
	private $id_dueno_mascota;
	private $num_identifiacion_dueno;
	private $id_mascota;

	public  function getId_dueno_mascota(){
		return $this->id_dueno_mascota;
	}
	public  function setId_dueno_mascota($id_dueno_mascota){
		$this->id_dueno_mascota=$id_dueno_mascota;
	}
	public  function getNum_identifiacion_dueno	(){
		return $this->num_identifiacion_dueno;
	}
	public  function setNum_identifiacion_dueno($num_identifiacion_dueno){
		$this->num_identifiacion_dueno=$num_identifiacion_dueno;
	}	
	public  function getId_mascota(){
		return $this->id_mascota;
	}
	public  function setId_mascota($id_mascota){
		$this->id_mascota=$id_mascota;
	}
	
	// function __construct(argument)
	// {
	// 	# code...
	// }
}
?>