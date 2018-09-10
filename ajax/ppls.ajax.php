<?php
/**
  * summary
  */
 require_once '../controller/ppl.controller.php';
 require_once '../model/ppl.model.php';


 class AjaxPPL
 {
     /**
      * summary
      */
     public $idPPL;
     public $activarPPL;
     public $activarId;

     public function ajaxEditarPPL()
     {
     	$item="rowid_ppl";
     	$valor=$this->idPPL;
     	$respuesta= PPLController::ctrMostrarPPLs($item, $valor);
     	echo json_encode($respuesta);

     }
     public function ajaxEditarProceso()
     {
       $item="fk_ppl";
       $valor=$this->idPPL;
       $respuesta= PPLController::ctrMostrarProceso($item, $valor);
       echo json_encode($respuesta);

     }


	 public function ajaxActivarPPL()
	{
		$tabla="spo_ppl";
		$item1="status_ppl";
		$valor1=$this->activarPPL;
		$item2="rowid_ppl";
		$valor2=$this->activarId;
		$respuesta = ModelPPL::mdlActualizarEstado($tabla,$item1,$valor1,$item2,$valor2);
    echo json_encode($respuesta);
	}


 }


  if (isset($_POST['idPPL'])) {
  $editar= new AjaxPPL();
  $editar -> idPPL=$_POST["idPPL"];
  $editar -> ajaxEditarPPL();
  }
  if (isset($_POST['idPPLp'])) {
  $editar= new AjaxPPL();
  $editar -> idPPL=$_POST["idPPLp"];
  $editar -> ajaxEditarProceso();
  }
  if(isset($_POST["activarPPL"])){

  $activarUsuario = new AjaxUsuarios();
  $activarUsuario -> activarUsuario = $_POST["activarPPL"];
  $activarUsuario -> activarId = $_POST["activarId"];
  $activarUsuario -> ajaxActivarPPL();

}

 ?>
