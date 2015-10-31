<?php	
include_once 'DBAbstractModel.php';

/**
* 
*/
class RelDuenoMascota extends DBAbstractModel
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
	public function get($class='')
	{
		$this->query="select * from relacion_dueno_mascota ;";
		if ($this->getResult($class)) {
			// var_dump();
			return $this->rows;
		} else {
			return false;
		}
	}
	
	public function getConParametros($class='',$relacion)
	{
		$this->query="select * from relacion_dueno_mascota  
			where num_identificacion_dueno= ".$this->getId_dueno_mascota();
		if ($this->getResult($class)) {
			// var_dump();
			return $this->rows;
		} else {
			return false;
		}
	}

	public function getUserValidado($class,$nick='',$pass='')
	{
		$this->query="select * from user_dueno  
			where correo='".$nick."'"." and pass='".$pass."'";
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
		$this->query="INSERT INTO user_dueno (num_identificacion,nombre,apellido,correo,telefono,tipo_identifiacion) 
						VALUES (?,?,?,?,?,?)";
		$values= array($this->getNum_identificacion(),
			$this->getNombre(),
			$this->getApellido(),
			$this->getCorreo(),
			$this->getTelefono(),
			$this->getTipo_identificacion());
		var_dump($values);
		if ($this->setDatos($values)) {
			// var_dump();
			return $this->rows;
		} else {
			return false;
		}
	}
	/*TODO QUE FUNCIONE SOLO INDEPENDIENTEMENTE*/
	public function edit()
	{
		$this->query="UPDATE user_dueno SET num_identificacion=?,nombre=?,apellido=?,correo=?,telefono=?,tipo_identifiacion=? 
						WHERE num_identificacion=? AND tipo_identificacion=?";
		$values= array($this->getNum_identificacion(),
			$this->getNombre(),
			$this->getApellido(),
			$this->getCorreo(),
			$this->getTelefono(),
			$this->getTipo_identificacion(),
			$this->getNum_identificacion(),
			$this->getTipo_identificacion() );
		// var_dump($values);
		if ($this->setDatos($values)) {
			// var_dump();
			return $this->rows;
		} else {
			return false;
		}
	}

	public function delete()
	{
		$this->query="DELETE FROM user_dueno  
						WHERE  num_identificacion=? AND tipo_identificacion=?";
		$values= array($this->getNum_identificacion(),
			$this->getTipo_identificacion() );
		// var_dump($values);
		if ($this->setDatos($values)) {
			// var_dump();
			return $this->rows;
		} else {
			return false;
		}
	}
	// function __construct(argument)
	// {
	// 	# code...
	// }
}
?>