<?php
/**
  * summary
  */
 require_once '../controller/usuarios.controller.php';
 require_once '../model/usuarios.model.php';
 class AjaxUsuarios
 {
     /**
      * summary
      */
     public $idUsuario;
     public $activarUsuario;
     public $activarId;

     public function ajaxConsultaUsuario()
     {
     	$item="rowid_users";
     	$valor=$this->idUsuario;
     	$respuesta= UsuariosController::ctrMostrarUsuarios($item, $valor);
     	echo json_encode($respuesta);

     }


	 public function ajaxActivarUsuario()
	{
		$tabla="spo_users";
		$item1="status_user";
		$valor1=$this->activarUsuario;
		$item2="rowid_users";
		$valor2=$this->activarId;
		$respuesta = ModelUsuarios::mdlActualizarEstado($tabla,$item1,$valor1,$item2,$valor2);
    echo json_encode($respuesta);
	}


 }


  if (isset($_POST['idUsuario'])) {
  $editar= new AjaxUsuarios();
  $editar -> idUsuario=$_POST["idUsuario"];
  $editar -> ajaxConsultaUsuario();
  }
  if(isset($_POST["activarUsuario"])){

  $activarUsuario = new AjaxUsuarios();
  $activarUsuario -> activarUsuario = $_POST["activarUsuario"];
  $activarUsuario -> activarId = $_POST["activarId"];
  $activarUsuario -> ajaxActivarUsuario();

}

 ?>
