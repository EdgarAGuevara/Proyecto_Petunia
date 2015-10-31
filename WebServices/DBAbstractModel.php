<?php
abstract class DBAbstractModel{
	private static $servername = "localhost";
	private static $username = "lookin";
	private static $password = "lookin123";
	private static $dbname = "lookin";
	protected $query;
	protected $rows=array();
	private $conn;
	public $mensaje="Hecho";

	abstract protected function get();
	abstract protected function set();
	abstract protected function edit();
	abstract protected function delete();

	private function open_conn()
	{
		$return;
		$server=self::$servername;
		$db=self::$dbname;
		try {
		    $this->conn = new PDO("mysql:host=$server;dbname=$db", self::$username, self::$password);
		    // set the PDO error mode to exception
		    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    // echo "Connected successfully"; 
		    $return=true;
		}catch(PDOException $e){
		    $this->mensaje= "Connection failed: " . $e->getMessage();
		    $return=false;
	    }
	    return $return;
	}

	private function close_conn()
	{
		$this->conn=null;
	}

	private function ejecutar_query()
	{
		$return;
		if ($this->open_conn()) {
			if ($this->conn->query($this->query) === TRUE) {
	    		$this->mensaje=  "Cambio Sin problema";
		    	$return=true;
			} else {
			    $this->mensaje= "Error: " . $this->query . "<br>" . $this->conn->error;
			    $return=false;
			}
			$this->close_conn();
		} else {
			$return=false;
		}		
	    return $return;
	}

	/*FUNCION PARA CONSULTAS=SELECT*/
	protected function getResult($class="")
	{
		$return;
		if ($this->open_conn()) {
			$sth = $this->conn->prepare($this->query);
			/* create instance automatically */
			// $sth->setFetchMode( PDO::FETCH_CLASS, 'Mascota');
			$sth->execute();
			$this->rows = $sth->fetchAll( PDO::FETCH_CLASS , $class);
			$sth->closeCursor();
	    	$return=true;
			$this->close_conn();
		} else {
			$return=false;
		}		
	    return $return;
	}

	/*FUNCION PARA QUERYS SIMPLES DE TIPO  INSERT,DELETE,UPDATE*/
	protected function setDatos($values)
	{
		$return;
		if ($this->open_conn()) {
			$sth = $this->conn->prepare($this->query);
			$sth->execute($values);
			$sth->closeCursor();
	    	$return=true;
			$this->close_conn();
		} else {
			$return=false;
		}		
	    return $return;
	}
}

?>