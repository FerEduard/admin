<?php

class Connection{
	private $co;
	
	public function __construct(){
		$servername = "localhost";
		$username = "root";
		$password = "";
		
		try {
			$conn = new PDO("mysql:host=$servername;dbname=wux;charset=utf8", $username, $password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->co = $conn;
			
		}
		catch(PDOException $e) {
			echo '<div class="alert alert-danger" role="alert">Oh! Parece que hay un problema</div>';
		}
	}
	
	public function co(){
		return $this->co;
	}
}

?>