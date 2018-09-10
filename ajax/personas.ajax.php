<?php
require_once '../controller/personas.controller.php';
require_once '../model/personas.model.php';
class AjaxPersonas
{
    /**
     * summary
     */
    public $idPersona;
    public $activarPersona;
    public $activarId;

    public function ajaxConsultaPersonaDetalle()
    {
     $item="rowid_persona";
     $valor=$this->idUsuario;
     $respuesta= PersonasController::ctrMostrarPersonaDetalle($item, $valor);
     echo json_encode($respuesta);

    }

}

if (isset($_POST['idUsuario'])) {
$editar= new AjaxPersonas();
$editar -> idUsuario=$_POST["idUsuario"];
$editar -> ajaxConsultaPersonaDetalle();
}
