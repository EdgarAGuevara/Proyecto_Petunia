<?php	
include_once 'DBAbstractModel.php';

/**
* 
*/
class ClassName extends DBAbstractModel
{
	private $num_identificacion;
	private $nombre	;
	private $apellido;
	private $correo	;
	private $telefono;
	private $tipo_identifiacion;

	public function getNum_identificacion	(){
		return $this->num_identificacion;
	}
	public function setNum_identificacion	($num_identificacion){
		$this->num_identificacion=$num_identificacion;
	}
	public function getNombre	(){
		return $this->nombre;
	}
	public function setNombre	($nombre){
		$this->nombre=$nombre;

	}
	public function getApellido	(){
		return $this->apellido;

	}
	public function setApellido	($apellido){
		$this->apellido=$apellido;

	}
	public function getCorreo(){
		return $this->correo;

	}
	public function setCorreo	($correo){
		$this->correo=$correo;

	}
	public function getTelefono	(){
		return $this->telefono;

	}
	public function setTelefono	($telefono){
		$this->telefono=$telefono;

	}
	public function getTipo_identifiacion(){
		return $this->tipo_identifiacion;

	}
	public function setTipo_identifiacion($tipo_identifiacion){
		$this->tipo_identifiacion=$tipo_identifiacion;

	}

	// function __construct(argument)
	// {
	// 	# code...
	// }
}
?>