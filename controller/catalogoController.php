<?php

/**
 *
 */
class CatalogoController{

  public function ctrMostrarEstados(){
    $tabla="cat_estados";
    $respuesta=catalogoModel::mdlMostrarEstados($tabla);
    if ($respuesta!=false) {
      return $respuesta;
    }else {
      print'<script>
      swal({
        type:"error",
        title: "Error Cargar catalogo Estados",
        showConfirmButton: true,
        confirmButtonText:"Cerrar",
        closeOnConfirm: false
      }).then((result)=>{
        if(result.value){
          window.location="inicio";
        }
      });
      </script>';
    }
  }
  public function ctrMostrarEdoCivil(){
    $tabla="cat_edoCivil";
    $respuesta=catalogoModel::mdlMostrarEdoCivil($tabla);
    if ($respuesta!=false) {
      return $respuesta;
    }else {
      print'<script>
      swal({
        type:"error",
        title: "Error Cargar catalogo Estados",
        showConfirmButton: true,
        confirmButtonText:"Cerrar",
        closeOnConfirm: false
      }).then((result)=>{
        if(result.value){
          window.location="inicio";
        }
      });
      </script>';
    }
  }
  public function ctrMostrarParentesco(){
    $tabla="cat_parentesco";
    $respuesta=catalogoModel::mdlMostrarParentesco($tabla);
    if ($respuesta!=false) {
      return $respuesta;
    }else {
      print'<script>
      swal({
        type:"error",
        title: "Error Cargar catalogo Estados",
        showConfirmButton: true,
        confirmButtonText:"Cerrar",
        closeOnConfirm: false
      }).then((result)=>{
        if(result.value){
          window.location="inicio";
        }
      });
      </script>';
    }
  }
}

 ?>
