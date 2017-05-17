<?php 
class lib{
	const KEY = 'wux';
	
	public function show($value){
		if(!isset($value)){
			echo "";
		}elseif($value != null){
			echo $value;
		}
	}
	
	public function encriptar($cadena){
		$encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5(self::KEY), $cadena, MCRYPT_MODE_CBC, md5(md5(self::KEY))));
		return $encrypted; //Devuelve el string encriptado
	 
	}
	 
	public function desencriptar($cadena){
			 $decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5(self::KEY), base64_decode($cadena), MCRYPT_MODE_CBC, md5(md5(self::KEY))), "\0");
			return $decrypted;  //Devuelve el string desencriptado
		}
	
	
	public function textField($label, $holder, $atrib, $df = false){
		$id = ($df)?"slc":"";
		$comp = '<div class="form-group">
					<label>'.$label.'</label>
					<input type="text" class="form-control frm '.$id.'" id='.$this->encriptar($atrib).'" name='.$this->encriptar($atrib).'" placeholder="'.$holder.'">
				  </div>';
				  
		echo $comp;
	}
}
?>