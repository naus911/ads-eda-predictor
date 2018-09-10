<?php
if(isset($_POST['fNacimiento'])){
  $fn=$_POST['fNacimiento'];list($ano,$mes,$dia) = explode("-",$fn);
  	$ano_diferencia  = date("Y") - $ano;
  	$mes_diferencia = date("m") - $mes;
  	$dia_diferencia   = date("d") - $dia;
  	if ($dia_diferencia < 0 && $mes_diferencia < 0)
  		$ano_diferencia--;
      echo $ano_diferencia;
}
?>
