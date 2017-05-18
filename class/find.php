<?php
include_once ("tabla.php");
include_once ("lib.php");
include_once ("co.php");

class Find{
	public function select($tabla, &$atributos){
		$lib = new lib();
		$query = "select ";
		$part2 = "where ";
		$c = count($atributos) - 1;
		$cc = 0;
		
		foreach ($atributos as $clave => $valor) {
			$part2 = $part2.($lib->desencriptar($clave))." = '".$valor."'".(($cc < $c)?" and ":"");
			$cc++;
		}
		
		$query = $query." * from ".$tabla." ".$part2;
		
		try{
			$co = new Connection();	
			$cn = $co->co();
			$stmt = $cn->prepare($query); 
			$stmt->execute();
	
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
			$rows = $stmt->fetchAll();
			if(!empty($rows)){
				$data = $lib->convert($rows);
								
				return $data;
			}
			$val['mensaje'] = "El registro no existe.";
			return $val;
		}catch(PDOException $e){
			$val['mensaje'] = "No fue posible acceder al registro";
			return $val;
		}
	}
}

$lib = new lib();
$op = new Find();
$tabla = $lib->desencriptar($_POST['tabla']);

unset($_POST['tabla']);
$val = $op->select($tabla, $_POST);

header('Content-type: application/json; charset=utf-8');
echo json_encode($val);
?>