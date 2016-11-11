<?php
/**
*Database connection helper
*/
include_once("settings.php");
/**
* Database connection helper class
*/
class wrapper{
	var $db=null;
	var $result=null;
	
	function wrapper(){
	}
	/**
	*Connect to database 
	*@return boolean true if connected else false
	*/
	
	function connect(){
		//connect
		try{
		$this->db=new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME,DB_USERNAME,DB_PASSWORD);
		return true;
	} catch (PDOException $e){
		echo "Connection failed. Try again";
	}
	}
	
	/**
	*Query the database 
	*@param string $strQuery sql string to execute
	*/
	function query($strQuery){
		if(!$this->connect()){
			return false;
		}
		if($this->db==null){
			return false;
		}
		$this->result=$this->db->query($strQuery);
		if($this->result==false){
			return false;
		}
		return true;
	}
	/*
	* Fetch from the current data set and return
	*@return array one record
	*/
	function fetch(){
		//Complete this funtion to fetch from the $this->result
		if($this->result==null){
			return false;
		}
		
		if($this->result==false){
			return false;
		}
		
		return $this->result->fetch(PDO::FETCH_ASSOC);
	}
}
?>
