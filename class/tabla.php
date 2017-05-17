<?php
class Tabla{
	public $name;
	public $co;
	
	public function __construct($co, $name){
		$this->name = $name;
		$this->co = $co;
	}
	
	public function select($id){
		try {
			$query = "SELECT * FROM $this->name where cod_$this->name = $id";
			$co = $this->co;
			$stmt = $co->prepare($query); 
			$stmt->execute();
	
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
			$rows = $stmt->fetchAll();
			if(!empty($rows)){
				return $rows[0];
			}
		}
		catch(PDOException $e) {
			echo '<div class="alert alert-danger" role="alert">Oh! Parece que hay un problema</div>';
		}
		
		return null;
	}
	
	public function selectFirst($columna, $valor){
		try {
			$query = "SELECT * FROM $this->name where $columna = $valor order by cod_$this->name limit 1";
			$co = $this->co;
			$stmt = $co->prepare($query); 
			$stmt->execute();

			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
			$rows = $stmt->fetchAll();
			if(!empty($rows)){
				return $rows[0];
			}
		}
		catch(PDOException $e) {
			echo '<div class="alert alert-danger" role="alert">Oh! Parece que hay un problema</div>';
		}
		
		return null;
	}
	
	
	public function selectNext($columna, $valor, $id){
		try {
			$query = "SELECT * FROM $this->name where $columna = $valor and cod_$this->name > $id order by cod_$this->name limit 1";
			
			$co = $this->co;
			$stmt = $co->prepare($query); 
			$stmt->execute();

			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
			$rows = $stmt->fetchAll();
			if(!empty($rows)){
				return $rows[0];
			}
		}
		catch(PDOException $e) {
			echo '<div class="alert alert-danger" role="alert">Oh! Parece que hay un problema</div>';
		}
		
		return null;
	}
	
	public function getName(){
		return $this->name;	
	}
}
?>
