<?php	
include_once 'DBAbstractModel.php';
/**
* 
*/
class UserDueno extends DBAbstractModel
{
	private $num_identificacion;
	private $nombre	;
	private $apellido;
	private $correo	;
	private $telefono;
	private $tipo_identificacion;
	private $pass;

	public function getNum_identificacion	(){
		return $this->num_identificacion;
	}
	public function setNum_identificacion($num_identificacion){
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
	public function getTipo_identificacion(){
		return $this->tipo_identificacion;

	}
	public function setTipo_identificacion($tipo_identificacion){
		$this->tipo_identificacion=$tipo_identificacion;

	}
	public function getPass(){
		return $this->pass;
	}
	public function setPass($pass){
		$this->pass=$pass;

	}

	public function get($class='')
	{
		$this->query="select * from user_dueno  where num_identificacion=".$this->getNum_identificacion().";";
		// var_dump($this->query);
		if ($this->getResult($class)) {
			// var_dump();
			return $this->rows;
		} else {
			return false;
		}
	}
	
	public function getConParametros($class='',$user)
	{
		$this->query="select * from user_dueno  
			where num_identificacion= ".$user->getNum_identificacion()." and tipo_identificacion= ".$this->getTipo_identificacion;
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
		$this->query="INSERT INTO user_dueno (num_identificacion,nombre,apellido,correo,telefono,tipo_identificacion,pass) 
						VALUES (?,?,?,?,?,?,?)";
		$values= array($this->getNum_identificacion(),
			$this->getNombre(),
			$this->getApellido(),
			$this->getCorreo(),
			$this->getTelefono(),
			$this->getTipo_identificacion(),
			$this->getPass());
		// var_dump($values);
		if ($this->setDatos($values)) {
			// var_dump();
			return true;
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

	public function __construct() {
    	// allocate your stuff
    }
}
?>