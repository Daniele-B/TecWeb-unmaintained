<?php
class DbConnector {
	const USER = 'root';
	const PWD = '';
	const DBNAME = 'tecweb';
	const HOST = 'localhost';
	
	public $connected = false;//used to know current status
	public $connectionErro;
	private $db;
	
	public function openDBConnection() {
		
		$this->db = new mysqli(static::HOST, static::USER, static::PWD, static::DBNAME);
		if($this->db->connect_error)
		{
			$this->connected =false;
			$this->connectionErro='Err n. '.$this->db->connect_errno." - ".$this->db->connect_error;
			return false;
		}else
		$this->connected= true;
		$this->db->set_charset('utf8');
		return true;
	}
	public function disconnect(){
		$this->connected=false;
		$this->db->close();
	}	
	//do the query and return the result
	public function doQuery($q){
		$query=mysqli_real_escape_string($this->db, $q);
		$result = $this->db->query($q);
		return $result;
	}
	
}
?>