<?php
include_once ("tabla.php");
include_once ("lib.php");
include_once ("co.php");

class Operaciones{
	public function select($tabla, &$atributos){
		$lib = new lib();
		$query = "select ";
		$part1 = "where ";
		$c = count($atributos) - 1;
		$cc = 0;
		
		foreach ($atributos as $clave => $valor) {
			$part1 = $part1.($lib->desencriptar($clave))." = '".$valor."'".(($cc < $c)?" and ":"");
			$cc++;
		}
		
		$query = $query." * from ".$tabla." ".$part1." LIMIT 1";
		
		try{
			$co = new Connection();	
			$cn = $co->co();
			$stmt = $cn->prepare($query); 
			$stmt->execute();
	
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
			$rows = $stmt->fetchAll();
			if(!empty($rows)){
				$data = $lib->convert($rows);
				$data['ok'] = "S";
				$data['mensaje'] = "El registro ha sigo guardado con éxito.";		
				return $data;
			}
			$val['mensaje'] = "El registro no existe.";
			return $val;
		}catch(PDOException $e){
			$val['mensaje'] = "No fue posible acceder al registro";
			return $val;
		}
	}
	
	public function insert($tabla, &$atributos){
		$lib = new lib();
		$query = "insert into ".$tabla;
		$part1 = "";
		$part2 = "";
		$c = count($atributos) - 1;
		$cc = 0;
		
		foreach ($atributos as $clave => $valor) {
			$part1 = $part1.($lib->desencriptar($clave)).(($cc < $c)?", ":"");
			$part2 = $part2."'".$valor."'".(($cc < $c)?", ":"");
			$cc++;
		}
		
		$query = $query." (".$part1.") values (".$part2.")";
		
		try{
			$co = new Connection();	
			$cn = $co->co();
			$st = $cn->prepare($query);
			$st->execute();
			
			$val = $this->select($tabla, $atributos);
			return $val;
		}catch(PDOException $e){
			//$val['mensaje'] = "No fue posible insertar el registro.";
			$val['mensaje'] = $query;
			return $val;
		}
	}
	
	public function update($tabla, &$atributos, &$id){
		$lib = new lib();
		$query = "update ".$tabla;
		$part1 = "set ";
		$part2 = "where ";
		$c = count($atributos) - 1;
		$ci = count($id) - 1;
		$cc = 0;
		
		
		foreach ($atributos as $clave => $valor) {
			$part1 = $part1.($lib->desencriptar($clave))." = '".$valor."'".(($cc < $c)?", ":"");
			$cc++;
		}
		
		$cc = 0;
		 
		foreach ($id as $clave => $valor) {
			$part2 = $part2.($lib->desencriptar($clave))." = '".$valor."'".(($cc < $ci)?" and ":"");
			$cc++;
		}
		
		$query = $query." ".$part1." ".$part2;
		
		try{
			$co = new Connection();	
			$cn = $co->co();
			$st = $cn->prepare($query);
			$st->execute();
			
			if($st->rowCount() > 0){
				$val['mensaje'] = "El registro ha sido guardado con éxito.";
				$val['ok'] = "S";
			} else {
				$val['mensaje'] = "Ningún registro actulizado.";
			}
			
			return $val;
		}catch(PDOException $e){
			$val['mensaje'] = "No fue posible actualizar el registro.";
			return $val;
		}
	}
	
	public function delete($tabla, $id){
	
	}
}

$lib = new lib();
$op = new Operaciones();
$tabla = $lib->desencriptar($_POST['tabla']);

unset($_POST['tabla']);

if(isset($_POST['UP'])){
	unset($_POST['UP']);
	foreach ($_POST as $clave => $valor) {
		if($lib->startsWith("(id)",$clave)){
			$nKey = str_replace("(id)","",$clave);
			$id[$nKey] = $valor;
			unset($_POST[$clave]);
		}
	}
	
	if(!empty($id)){
		$val = $op->update($tabla, $_POST, $id);
	} else {
		$val["mensaje"] = "No es posible actualizar el registro.*";
	}
	
	
}else{
	$val = $op->insert($tabla, $_POST);
}

header('Content-type: application/json; charset=utf-8');
echo json_encode($val);

?>