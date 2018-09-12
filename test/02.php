<?php
require_once('lib/nusoap.php');
 if (isset($_POST['id_Personal'])) {
 $resultado=validation();	
 }
 if (isset($_POST['codigo'])) {
 $resultadoInsert=insert();	
 }
 
/*if (isset($resultado)) {
 var_dump($resultado);
 }
if (isset($resultadoInsert)) {
 var_dump($resultadoInsert);
 }*/

  //RFC utilizado para el ambiente de pruebas

function validation(){
//Archivos del CSD de prueba proporcionados por el SAT.
  //ver http://developers.facturacionmoderna.com/webroot/CertificadosDemo-FacturacionModerna.zip
if (isset($_POST['id_Personal'])) {
//$numero_certificado ="00001000000300431906";//dulmich
    
  
  $cliente = new nusoap_client('http://cspmichoacan.sytes.net/checador/ajax/idPersonal.ajax.php');
     
    $datos_persona_entrada = array( "datos_persona_entrada" => array(   
                                                                    'id_Personal'=>$_POST['id_Personal'], )    );
$resultado = $cliente->call('autorizar',$datos_persona_entrada);

return $resultado;
} 

}  
function insert(){
//Archivos del CSD de prueba proporcionados por el SAT.
  //ver http://developers.facturacionmoderna.com/webroot/CertificadosDemo-FacturacionModerna.zip
if (isset($_POST['codigo'])) {
//$numero_certificado ="00001000000300431906";//dulmich
    
  
  $cliente = new nusoap_client('http://cspmichoacan.sytes.net/checador/ajax/Checar.ajax.php');
     
    $datos_persona_entrada = array( "datos_persona_entrada" => array(   
                                                                    'id_Personal'=>$_POST['perso'], 'Codigo_personal'=>$_POST['codigo'] )    );
    
$resultadoInsert = $cliente->call('autorizar',$datos_persona_entrada);

return $resultadoInsert;
} 

}  
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<a href="index.php">Inicio</a>
	<?php if (isset($resultadoInsert)) {
		print'<h2 style="color:red;"> '.$resultadoInsert['mensaje'].'<br>'.$resultadoInsert['certificado'].'</h2>';
	} ?>
<form action="02.php" method="POST">
	<label><h2><?php if (isset($resultado)) {print $resultado['mensaje'].' '.$resultado['user'];  } ?></h2></label><br>
	<label>
		<?php  if (isset($resultado)) { ?>
	Verifique el nombre de la persona</label><br>
	<input type="hidden" name="codigo" value="<?php print $resultado['certificado'];  ?>">
	<input type="hidden" name="perso" value="<?php print $_POST['id_Personal']; ?>">
	
	<br>
	<button type="reset">cancelar</button>
	<button type="submit">Aceptar</button>
<?php  } ?>
</form>
</body>
</html>
