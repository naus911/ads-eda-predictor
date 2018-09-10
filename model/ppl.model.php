<?php
require_once 'conexion.php';
class PPLModel
{
 public function MdlMostrarPPLs($tabla,$item,$valor){

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
  public function mdlCrearPPL($tabla,$tabla2,$data)  {
try {
  $db=Conexion::conectar();

  $stmt=$db->prepare("INSERT INTO $tabla
    (nombre_ppl,aPaterno_ppl,aMaterno_ppl,fNacimiento_ppl,sexo_ppl,edad_ppl,fcreacion,fIngreso_ppl,foto_ppl) VALUES
  (:nombre_ppl,:aPaterno_ppl,:aMaterno_ppl,:fNacimiento_ppl,:sexo_ppl,:edad_ppl,:fcreacion,:fIngreso_ppl,:foto_ppl);");
  $stmt->bindParam(":nombre_ppl",$data['nombre'],PDO::PARAM_STR);
  $stmt->bindParam(":aPaterno_ppl",$data['aPaterno'],PDO::PARAM_STR);
  $stmt->bindParam(":aMaterno_ppl",$data['aMaterno'],PDO::PARAM_STR);
  $stmt->bindParam(":fNacimiento_ppl",$data['fNacimiento'],PDO::PARAM_STR);
  $stmt->bindParam(":sexo_ppl",$data['sexo'],PDO::PARAM_STR);
  $stmt->bindParam(":edad_ppl",$data['edad'],PDO::PARAM_STR);
  $stmt->bindParam(":fcreacion",$data['fcreacion'],PDO::PARAM_STR);
  $stmt->bindParam(":fIngreso_ppl",$data['fIngreso'],PDO::PARAM_STR);
  $stmt->bindParam(":foto_ppl",$data['foto'],PDO::PARAM_STR);
  if ($stmt->execute()) {
    $lastid=$db->lastInsertid();
    print $lastid;
    if ($lastid!=0) {
      try {
        $stmt=$db->prepare("INSERT INTO $tabla2 (fuero,situacion,delito,no_proceso,fk_ppl) VALUES
        (:fuero,:situacion,:delito,:no_proceso,:fk_ppl);");
        $stmt->bindParam(":fuero",$data['fuero'],PDO::PARAM_STR);
        $stmt->bindParam(":situacion",$data['situacion'],PDO::PARAM_STR);
        $stmt->bindParam(":delito",$data['delito'],PDO::PARAM_STR);
        $stmt->bindParam(":no_proceso",$data['proceso'],PDO::PARAM_STR);
        $stmt->bindParam(":fk_ppl",$lastid,PDO::PARAM_STR);

        if ($stmt->execute()) {

          return("ok");


          }else {
            return("error proceso");
          }
      } catch (\Exception $e) {
    echo $e;
      }
      return $result;
    }
  }
  else{
    return("error ppl");
  }

} catch (\Exception $e) {
echo $e;
}
}
  public function mdlEditarPPL($tabla,$data)
  {
        $db=Conexion::conectar();
    $sql="UPDATE ".$tabla." SET aPaterno_ppl=:aPaterno_ppl,aMaterno_ppl=:aMaterno_ppl,nombre_ppl=:nombre_ppl,sexo_ppl=:sexo_ppl,edad_ppl=:edad_ppl,fIngreso_ppl=:fIngreso_ppl,fNacimiento_ppl=:fNacimiento_ppl,foto_ppl=:foto_ppl WHERE rowid_ppl=:rowid_ppl;";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":aPaterno_ppl",$data['aPaterno'],PDO::PARAM_STR);
    $stmt->bindParam(":aMaterno_ppl",$data['aMaterno'],PDO::PARAM_STR);
    $stmt->bindParam(":nombre_ppl",$data['nombre'],PDO::PARAM_STR);
    $stmt->bindParam(":sexo_ppl",$data['sexo'],PDO::PARAM_STR);
    $stmt->bindParam(":edad_ppl",$data['edad'],PDO::PARAM_STR);
    $stmt->bindParam(":fIngreso_ppl",$data['fIngreso'],PDO::PARAM_STR);
    $stmt->bindParam(":fNacimiento_ppl",$data['fNacimiento'],PDO::PARAM_STR);
    $stmt->bindParam(":foto_ppl",$data['foto'],PDO::PARAM_STR);
    $stmt->bindParam(":rowid_ppl",$data['idPPL'],PDO::PARAM_STR);
    if($stmt -> execute()){
      return "ok";
      $stmt->close();

        $stmt = null;
    }else{
      return "error";
    }
  }
  public function mdlEditarProceso($tabla,$data)
  {
    try {



    $db=Conexion::conectar();
    $sql="UPDATE ".$tabla." SET fuero=:fuero,situacion=:situacion,delito=:delito,no_proceso=:no_proceso WHERE fk_ppl=:fk_ppl;";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":fuero",$data['fuero'],PDO::PARAM_STR);
    $stmt->bindParam(":situacion",$data['situacion'],PDO::PARAM_STR);
    $stmt->bindParam(":delito",$data['Delito'],PDO::PARAM_STR);
    $stmt->bindParam(":no_proceso",$data['proceso'],PDO::PARAM_STR);
   $stmt->bindParam(":fk_ppl",$data['idPPL'],PDO::PARAM_STR);
    if($stmt -> execute()){
      return "ok";
      $stmt->close();

        $stmt = null;
    }
  } catch (\Exception $e) {
    echo $e;
  return "error";
  }
  }
}
 ?>
