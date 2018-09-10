<?php
/**
 *
 */
 require_once 'conexion.php';
class CatalogoModel
{
  public function mdlMostrarEstados($tabla){
    $db=Conexion::conectar();
    $stmt=$db->prepare("SELECT * FROM $tabla;");
    $stmt->execute();
    $respuesta=$stmt->fetchAll();
    return $respuesta;
  }public function mdlMostrarEdoCivil($tabla){
    $db=Conexion::conectar();
    $stmt=$db->prepare("SELECT * FROM $tabla;");
    $stmt->execute();
    $respuesta=$stmt->fetchAll();
    return $respuesta;
  }public function mdlMostrarParentesco($tabla){
    $db=Conexion::conectar();
    $stmt=$db->prepare("SELECT * FROM $tabla;");
    $stmt->execute();
    $respuesta=$stmt->fetchAll();
    return $respuesta;
  }
}
 ?>
