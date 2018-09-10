<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
#print_r($db);
/**
* 
*/

class Conexion
{
		
	 public function  conectar(){
		$hostname_Conexion = "localhost";
		$database_Conexion = "sipemo_visita";
		$username_Conexion = "root";
		$password_Conexion = "toor81";

		try {
			$db=new PDO('mysql:host='.$hostname_Conexion.';dbname='.$database_Conexion,$username_Conexion,$password_Conexion);
							$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 
							#$db->exec("SET NAMES Cuft8");
		} catch (Exception $e) {
			print("Error de conexión ".$e);
			die(); 
			
		}

		 

			return $db;
	}
}


?>
