<?php
require_once 'conexion.php';
/**
 *
 */
class PersonasModel
{

  function __construct()
  {
    // code...
  }
  public function MdlMostrarPersonas($tabla,$item,$valor){

   if ($item!=null) {
   $stmt=Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item=:$item");
   $stmt-> bindParam(":".$item,$valor, PDO::PARAM_STR);
   $stmt->execute();
   return $stmt-> fetch();
   }else{
    $stmt=Conexion::conectar()->prepare("SELECT * FROM $tabla;");
    $stmt->execute();
    return $stmt-> fetchAll();
   }
   $stmt->close();
   $stmt=null;
   }
   public function MdlMostrarPersonaDetalle($tabla,$tabla2,$tabla3,$item,$valor){

    $stmt=Conexion::conectar()->prepare("select * from $tabla a
LEFT OUTER JOIN $tabla2 b on a.rowid_persona = b.fk_persona
LEFT OUTER JOIN $tabla3 c on a.rowid_persona = c.fk_persona
 WHERE a.$item=:$item");
    $stmt-> bindParam(":".$item,$valor, PDO::PARAM_STR);
   $stmt->execute();
    return $stmt-> fetch();
    $stmt->close();
    $stmt=null;
    }

   public function MdlCrearPersona($tablas,$data)
  {
    $db=Conexion::conectar();
    try {

     $stmt=$db->prepare("INSERT INTO ".$tablas['tabla']."
      (aPaterno_persona,aMaterno_persona,nombre_persona,edad_persona,foto_persona,sexo_persona,fNacimiento_persona,lNacimiento_persona,edoCivil_persona,ocupacion_persona,nHijos_persona,fcreacion_persona,escolaridad_persona) VALUES
    (:aPaterno_persona,:aMaterno_persona,:nombre_persona,:edad_persona,:foto_persona,:sexo_persona,:fNacimiento_persona,:lNacimiento_persona,:edoCivil_persona,:ocupacion_persona,:nHijos_persona,:fcreacion_persona,:escolaridad_persona);");
    $stmt->bindParam(":aPaterno_persona",$data['aPaterno'],PDO::PARAM_STR);
    $stmt->bindParam(":aMaterno_persona",$data['aMaterno'],PDO::PARAM_STR);
    $stmt->bindParam(":nombre_persona",$data['nombre'],PDO::PARAM_STR);
    $stmt->bindParam(":edad_persona",$data['edad'],PDO::PARAM_STR);
    $stmt->bindParam(":foto_persona",$data['foto'],PDO::PARAM_STR);
    $stmt->bindParam(":sexo_persona",$data['sexo'],PDO::PARAM_STR);
    $stmt->bindParam(":fNacimiento_persona",$data['fNacimiento'],PDO::PARAM_STR);
    $stmt->bindParam(":lNacimiento_persona",$data['lNacimiento'],PDO::PARAM_STR);
    $stmt->bindParam(":edoCivil_persona",$data['edoCivil'],PDO::PARAM_STR);
    $stmt->bindParam(":ocupacion_persona",$data['ocupacion'],PDO::PARAM_STR);
    $stmt->bindParam(":nHijos_persona",$data['nHijos'],PDO::PARAM_STR);
    $stmt->bindParam(":fcreacion_persona",$data['fcreacion'],PDO::PARAM_STR);
    $stmt->bindParam(":escolaridad_persona",$data['escolaridad'],PDO::PARAM_STR);

      if ($stmt->execute()) {
        $lastid=$db->lastInsertid();
        $stmt=$db->prepare("INSERT INTO ".$tablas['tabla2']."
         (fk_persona) VALUES
       (:fk_persona);");
       $stmt->bindParam(":fk_persona",$lastid,PDO::PARAM_STR);
       $stmt->execute();
       $stmt=$db->prepare("INSERT INTO ".$tablas['tabla3']."
        (fk_persona) VALUES
      (:fk_persona);");
      $stmt->bindParam(":fk_persona",$lastid,PDO::PARAM_STR);
      $stmt->execute();

        return("ok");
      }else{
        return("error");
      }
    }
    catch (\Exception $e) {

    }

  }
  public function mdlEditarPersona($tablas,$data)
  {
    try {
      $db=Conexion::conectar();

      $sql="UPDATE ".$tablas['tabla']." SET
      aPaterno_persona=:aPaterno_persona,
      aMaterno_persona=:aMaterno_persona,
      nombre_persona=:nombre_persona,
      sexo_persona=:sexo_persona,
      edad_persona=:edad_persona,
      foto_persona=:foto_persona,
      fNacimiento_persona=:fNacimiento_persona,
      lNacimiento_persona=:lNacimiento_persona,
      edoCivil_persona=:edoCivil_persona,
      ocupacion_persona=:ocupacion_persona,
      nHijos_persona=:nHijos_persona,
      escolaridad_persona=:escolaridad_persona WHERE rowid_persona=:rowid_persona";
      $stmt = $db->prepare($sql);
      $stmt->bindParam(":aPaterno_persona",$data['aPaterno'],PDO::PARAM_STR);
      $stmt->bindParam(":aMaterno_persona",$data['aMaterno'],PDO::PARAM_STR);
      $stmt->bindParam(":nombre_persona",$data['nombre'],PDO::PARAM_STR);
      $stmt->bindParam(":sexo_persona",$data['sexo'],PDO::PARAM_STR);
      $stmt->bindParam(":edad_persona",$data['edad'],PDO::PARAM_STR);
      $stmt->bindParam(":foto_persona",$data['foto'],PDO::PARAM_STR);
      $stmt->bindParam(":fNacimiento_persona",$data['fNacimiento'],PDO::PARAM_STR);
      $stmt->bindParam(":lNacimiento_persona",$data['lNacimiento'],PDO::PARAM_STR);
      $stmt->bindParam(":edoCivil_persona",$data['edoCivil'],PDO::PARAM_STR);
      $stmt->bindParam(":ocupacion_persona",$data['ocupacion'],PDO::PARAM_STR);
      $stmt->bindParam(":nHijos_persona",$data['nHijos'],PDO::PARAM_STR);
      $stmt->bindParam(":escolaridad_persona",$data['escolaridad'],PDO::PARAM_STR);
      $stmt->bindParam(":rowid_persona",$data['idPersona'],PDO::PARAM_STR);

      if ($stmt->execute()) {
        $result=PersonasModel::mdlEditarPersonaUbicacion($tablas,$data);
        $result=PersonasModel::mdlEditarPersonaDetalles($tablas,$data,$db);
        return$result;
      }
      else{
        return "error personales";
      }

    } catch (\Exception $e) {
print $e;
    }
  }
  public function mdlEditarPersonaUbicacion($tablas,$data)
  {
    $db=Conexion::conectar();
    try {
    $sql="UPDATE ".$tablas['tabla2']." SET
    estado=:estado,
    ciudad=:ciudad,
    calle=:calle,
    numero=:numero,
    colonia=:colonia,
    cPostal=:cPostal,
    telefono=:telefono,
    celular=:celular
     WHERE fk_persona=:fk_persona;";


    $stmt = $db->prepare($sql);
    $stmt->bindParam(":estado",$data['estado'],PDO::PARAM_STR);
    $stmt->bindParam(":ciudad",$data['ciudad'],PDO::PARAM_STR);
    $stmt->bindParam(":calle",$data['calle'],PDO::PARAM_STR);
    $stmt->bindParam(":numero",$data['numero'],PDO::PARAM_STR);
    $stmt->bindParam(":colonia",$data['colonia'],PDO::PARAM_STR);
    $stmt->bindParam(":cPostal",$data['codigoPostal'],PDO::PARAM_STR);
    $stmt->bindParam(":telefono",$data['telefono'],PDO::PARAM_STR);
    $stmt->bindParam(":celular",$data['celular'],PDO::PARAM_STR);
    $stmt->bindParam(":fk_persona",$data['idPersona'],PDO::PARAM_STR);

    $res=$stmt->execute();
    if ($res!=0) {
      return "ok";
    }
    else{
      return"error ubicacion";
    }
  } catch (\Exception $e) {
print $e;
  }
}public function mdlEditarPersonaDetalles($tablas,$data,$db)
  {

    try {
    $sql="UPDATE ".$tablas['tabla3']." SET
    sSocial_persona=:sSocial_persona,
    dDetalle_persona=:dDetalle_persona,
    enfermedades_persona=:enfermedades_persona,
    discapacidad_persona=:discapacidad_persona,
    eDetalle_persona=:eDetalle_persona,
    observaciones_persona=:observaciones_persona
     WHERE fk_persona=:fk_persona;";

    $stmt = $db->prepare($sql);
    $stmt->bindParam(":sSocial_persona",$data['numeroSocial'],PDO::PARAM_STR);
    $stmt->bindParam(":dDetalle_persona",$data['espDiscapacidad'],PDO::PARAM_STR);
    $stmt->bindParam(":enfermedades_persona",$data['enfermedades'],PDO::PARAM_STR);
    $stmt->bindParam(":discapacidad_persona",$data['discapacidad'],PDO::PARAM_STR);
    $stmt->bindParam(":eDetalle_persona",$data['espEnfermedad'],PDO::PARAM_STR);
    $stmt->bindParam(":observaciones_persona",$data['observaciones'],PDO::PARAM_STR);
    $stmt->bindParam(":fk_persona",$data['idPersona'],PDO::PARAM_STR);

    $res=$stmt->execute();
    if ($res!=0) {
      return "ok";
    }
    else{
      return"error detalle medico";
    }
  } catch (\Exception $e) {
     print $e;
  }
  }
}


 ?>
