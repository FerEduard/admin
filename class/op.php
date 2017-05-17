<?php
include_once ("tabla.php");
include_once ("lib.php");
include_once ("co.php");

class Operaciones{
	private $co;
	private $lib;

	public function insert($tabla, &$atributos){
		$lib = new lib();
		$query = "insert into ".$tabla;
		$part1 = "";
		$part2 = "";
		$c = count($atributos) - 1;
		$cc = 0;
		
		foreach ($atributos as $clave => $valor) {
			$part1 = $part1.($lib->desencriptar($clave)).(($cc < $c)?", ":"");
			$part2 = $part2.$valor.(($cc < $c)?", ":"");
			$cc++;
		}
		
		$query = $query." (".$part1.") values (".$part2.");";
		
		try{
			$co = new Connection();	
			$co->exec($query);
			return "Nuevo registro";
		}catch(PDOException $e){
			return false;
		}
	}
	
	public function update($tabla, &$atributo, $id){
	
	}
	
	public function delete($tabla, $id){
	
	}
}

$lib = new lib();
$op = new Operaciones();
$tabla = $lib->desencriptar($_POST['tabla']);

unset($_POST['tabla']);
$val['query'] = $op->insert($tabla, $_POST);

header('Content-type: application/json; charset=utf-8');
echo json_encode($val);

?>