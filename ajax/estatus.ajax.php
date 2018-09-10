<?php

require_once '../model/estatus.model.php';

class AjaxEstatus
{
  public $activarUsuario;
	public $activarId;
  public $TipoUsuario;


	public function ajaxActivarUsuario(){
    switch ($this->TipoUsuario) {
      case 'PPL':
        $tabla = "spo_ppl";
        $item1 = "status_ppl";
        $item2 = "rowid_ppl";

        break;
        case 'user':
          $tabla = "spo_users";
          $item1 = "status_user";
          $item2 = "rowid_users";
          break;
          case 'persona':
            $tabla = "spo_persona";
            $item1 = "status_persona";
            $item2 = "rowid_persona";
            break;
    }
		$valor1 = $this->activarUsuario;
		$valor2 = $this->activarId;
		$respuesta = EstatusModel::mdlActualizarEstatus($tabla, $item1, $valor1, $item2, $valor2);
	}
}
  if(isset($_POST["activarUsuario"])){
	$activarUsuario = new AjaxEstatus();
	$activarUsuario -> activarUsuario = $_POST["activarUsuario"];
	$activarUsuario -> activarId = $_POST["activarId"];
  $activarUsuario -> TipoUsuario = $_POST["TipoUsuario"];
	$activarUsuario -> ajaxActivarUsuario();

} ?>
