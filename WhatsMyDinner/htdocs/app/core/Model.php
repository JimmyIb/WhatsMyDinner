<?php
class Model {

	protected $_connection;

	function __construct(){
		$host = 'localhost';
		$dbname = 'Project';
		$user = 'root';
		$pass = '';
		try{
			$this->_connection = new PDO("mysql:host=$host; dbname=$dbname", $user, $pass);
			$this->_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}
}
