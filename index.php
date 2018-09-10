<base href="http://localhost/srva/"/>
<?php
require_once "controller/template.controller.php";
require_once "controller/util.controller.php";
require_once "controller/ppl.controller.php";
require_once "controller/personas.controller.php";
require_once "controller/usuarios.controller.php";
require_once "controller/catalogoController.php";
require_once 'model/usuarios.model.php';
require_once 'model/personas.model.php';
require_once 'model/ppl.model.php';
require_once 'model/catalogo.model.php';

  $template = new ControllerTemplate();
  $template->ctrTemplate();
 ?>
