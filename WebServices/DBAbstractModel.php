<?php
abstract class DBAbstractModel{
	private static $servername = "localhost";
	private static $username = "lookin";
	private static $password = "lookin123";
	protected $dbname = "lookin";
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
		try {
		    $this->conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		    // set the PDO error mode to exception
		    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    echo "Connected successfully"; 
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

	/*TODO ver si funciona esta vaina*/
	private function getResult()
	{
		$return;
		if ($this->open_conn()) {
			$result=$this->conn->query($this->query);
			$this->rows=$result;
	    	$return=true;
			$this->close_conn();
		} else {
			$return=false;
		}		
	    return $return;
	}
}

?>