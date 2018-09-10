<?php
/**
 *
 */
class Utilcontroller
{

  public function PassEncrypt($pass)
  {
    require('model/FuncionBlowfish.php');
    $encryp=encriptar_blowfish($pass);
  return $encryp;
  }
  public function ImageProcess()
  {

             list($ancho,$alto)= getimagesize($_FILES['nuevaFoto']['tmp_name']);//obtine el tamaño de la foto en un list
             $nuevoAncho= 500;
             $nuevoAlto =500;
             if(isset($_POST['nuevoUsuario']))
             {
               $folder="users";
               $name=$_POST['nuevoUsuario'];
             }elseif (isset($_POST['nuevoNombrePPL'])) {
               $folder="ppls";
               $name=$_POST['nuevoNombrePPL'];
             }else{
               $folder="personas";
               $name=$_POST['nuevoNombrePersona'];
             }
            $directorio="views/images/".$folder;

            if ($_FILES['nuevaFoto']['type']== "image/jpeg") {//valida extension
                $aleatorio=mt_rand(100,999);//creamos un # aleatorio
                $ruta=$directorio."/".$name."-".$aleatorio.".jpg";//guardamso ruta
                $origen=imagecreatefromjpeg($_FILES['nuevaFoto']['tmp_name']);
                $destino=imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);//recorta la foto
                imagejpeg($destino,$ruta);
            }
            if ($_FILES['nuevaFoto']['type']== "image/png") {
                $aleatorio=mt_rand(100,999);
                $ruta=$directorio."/".$name."-".$aleatorio.".png";
                $origen=imagecreatefrompng( $_FILES['nuevaFoto']['tmp_name']);
                $destino=imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                                              //ejes x,y de la foto
                imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                imagepng($destino,$ruta);
            }
    return $ruta;

  }
}
