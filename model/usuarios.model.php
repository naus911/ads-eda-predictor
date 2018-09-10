<?php
require_once 'conexion.php';
class ModelUsuarios
{
    /**
     * summary
     */

    static public function MdlMostrarUsuarios($tabla,$item,$valor){

  	if ($item!=null) {
  		$stmt=Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item=:$item");
    $stmt-> bindParam(":".$item,$valor, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt-> fetch();
  	}else{
  		$stmt=Conexion::conectar()->prepare("SELECT * FROM $tabla");
        $stmt->execute();
        return $stmt-> fetchAll();
  	}
    $stmt->close();
    $stmt=null;
  }
  /*
  agregar usuario
   */
   public function mdlAgregarUsuario($tabla,$data)
  {
    $stmt=Conexion::conectar()->prepare("INSERT INTO $tabla
      (usuario,password,aPaterno_user,aMaterno_user,nombre_user,tipoUsuario,foto_user,fcreacion_user,departamento) VALUES
      (:usuario,:password,:aPaterno_user,:aMaterno_user,:nombre_user,:tipoUsuario,:foto_user,:fcreacion_user,:departamento);");
    $stmt->bindParam(":usuario",$data['usuario'],PDO::PARAM_STR);
    $stmt->bindParam(":password",$data['password'],PDO::PARAM_STR);
    $stmt->bindParam(":aPaterno_user",$data['aPaterno'],PDO::PARAM_STR);
    $stmt->bindParam(":aMaterno_user",$data['aMaterno'],PDO::PARAM_STR);
    $stmt->bindParam(":nombre_user",$data['nombre'],PDO::PARAM_STR);
    $stmt->bindParam(":tipoUsuario",$data['tipoUsuario'],PDO::PARAM_STR);
    $stmt->bindParam(":foto_user",$data['foto'],PDO::PARAM_STR);
    $stmt->bindParam(":fcreacion_user",$data['fcreacion'],PDO::PARAM_STR);
    $stmt->bindParam(":departamento",$data['area'],PDO::PARAM_STR);
    if ($stmt->execute()) {
      return("ok");
    }else{
      return("error");
    }

  }
  public function mdlEditarUsuario($tabla, $data){

$sql="UPDATE ".$tabla." SET aPaterno_user=:aPaterno_user,aMaterno_user=:aMaterno_user,nombre_user=:nombre_user,tipoUsuario=:tipoUsuario,departamento=:departamento";
if (isset($data['foto'])&&$data['foto']!=null){
  $sql.=", foto_user=:foto_user";

}
if (isset($data['password'])&&$data['password']!=null){
  $sql.=", password=:password ";
}$sql.=" WHERE rowid_users= :rowid_users";
    $stmt = Conexion::conectar()->prepare($sql);
    $stmt->bindParam(":aPaterno_user",$data['aPaterno'],PDO::PARAM_STR);
    $stmt->bindParam(":aMaterno_user",$data['aMaterno'],PDO::PARAM_STR);
    $stmt->bindParam(":nombre_user",$data['nombre'],PDO::PARAM_STR);
    $stmt->bindParam(":tipoUsuario",$data['tipoUsuario'],PDO::PARAM_STR);
    $stmt->bindParam(":departamento",$data['area'],PDO::PARAM_STR);
    if(isset($data['foto'])&&$data['foto']!=null){$stmt->bindParam(":foto_user",$data['foto'],PDO::PARAM_STR);}
    if(isset($data['password'])&&$data['password']!=null){$stmt->bindParam(":password",$data['password'],PDO::PARAM_STR);}
     $stmt->bindParam(":rowid_users",$data['idUsuario'],PDO::PARAM_STR);
    if($stmt -> execute()){
      return "ok";
      $stmt->close();

        $stmt = null;
    }else{
      return "error";
    }
    $stmt -> close();
    $stmt = null;
  }
  public function mdlActualizarEstado($tabla, $item1, $valor1, $item2, $valor2){

    $stmt = $this->db->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

    $stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
    $stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

    if($stmt -> execute()){

      return true;
      $stmt->close();

        $stmt = null;

    }else{

      return "error";

    }

    $stmt -> close();

    $stmt = null;

  }

}?>
