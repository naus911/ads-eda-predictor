<?php



//Checar si version de php ejecuta blow
if(defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH) {
//Funcion para encriptar los datos con Blowfish
function encriptar_blowfish ($password, $digito = 7) {  
	$set_salt = './1234567890ABCDEFGHIJKLMNÑOPQRSTUVWXYZabcdefghijklmnñopqrstuvwxyz*#!%&$';  
	$salt = sprintf('$2a$%02d$', $digito);  
	for($i = 0; $i < 22; $i++)  
	{  
		$salt .= $set_salt[mt_rand(0, 63)];  
	}  

	  $password=password_hash($password, PASSWORD_BCRYPT);

		return $password;

	}
}
else{
	echo "no activo blow";
}
#echo encriptar_blowfish('pollo')."<br>";

?>