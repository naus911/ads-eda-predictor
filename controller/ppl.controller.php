<?php
/**
 *
 */

class PPLController
{
  public $tabla = "spo_users";
  public  $Util;
  function __construct(){
    $this->Util = new Utilcontroller();

  }
  public function ctrMostrarPPLs($item,$valor)
  {
   $tabla="spo_ppl";
   $respuesta=PPLModel::MdlMostrarPPLs($tabla, $item, $valor);
   return $respuesta;
 }
 public function ctrMostrarProceso($item,$valor)
 {
  $tabla="spo_ppl_proceso";
  $respuesta=PPLModel::MdlMostrarPPLs($tabla, $item, $valor);
  return $respuesta;
}
  public function ctrCrearPPL()
  {
    $tabla="spo_ppl";
    $tabla2="spo_ppl_proceso";
      if (isset($_POST['nuevoNombrePPL'])) {
         if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ]+$/',$_POST["nuevoNombrePPL"])){
           $fcreacion=date("Y-m-d H:i:s");
           $ruta="";
            if (isset($_FILES['nuevaFoto']["tmp_name"])) {

              $ruta=$this->Util->ImageProcess();
              }
           else{
            $ruta="views/images/default/anonymous.png";
           }
       		$datos = array('nombre' =>$_POST['nuevoNombrePPL'],
       						      'aPaterno' =>$_POST['aPaternoPPL'],
       						      'aMaterno' =>$_POST['aMaternoPPL'],
       						      'fNacimiento' =>$_POST['fNacimientoPPL'],
       						      'edad'=>$_POST['edadPPL'],
                        'sexo'=>$_POST['sexoPPL'],
                         'fcreacion'=>$fcreacion,
                         'proceso'=>$_POST['proceso'],
                         'fuero'=>$_POST['fuero'],
                         'situacion'=>$_POST['situacion'],
                         'delito'=>$_POST['delito'],
                         'fIngreso'=>$_POST['fIngresoPPL'],
                         'foto'=>$ruta
       						       );

                   $respuesta=PPLModel::mdlCrearPPL($tabla,$tabla2,$datos);
                   if ($respuesta=='ok') {
              		   print'<script>
              		   swal({
              		     type:"success",
              		     title: "Usuario agregado correntamente.!!",
              		     showConfirmButton: true,
              		     confirmButtonText:"Cerrar",
              		     closeOnConfirm: false
              		   }).then((result)=>{
              		     if(result.value){
              		       window.location="ppls/list";
              		     }
              		   });
              		   </script>';
              		 }
                 }elseif ($respuesta=='error proceso') {
                     print'<script>
                     swal({
                       type:"error",
                       title: "Error Ingresar datos Proceso",
                       showConfirmButton: true,
                       confirmButtonText:"Cerrar",
                       closeOnConfirm: false
                     }).then((result)=>{
                       if(result.value){
                         window.location="ppls/list";
                       }
                     });
                     </script>';
                   }else {
                     print'<script>
                     swal({
                       type:"error",
                       title: "Error Ingresar PPL",
                       showConfirmButton: true,
                       confirmButtonText:"Cerrar",
                       closeOnConfirm: false
                     }).then((result)=>{
                       if(result.value){
                         window.location="ppl/list";
                       }
                     });
                     </script>';
                   }

        }
      }
      public function ctrEditarPPL(){

      			$ruta=null;
     			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"])){

     				if(isset($_FILES["nuevaFoto"]["tmp_name"]) && !empty($_FILES["nuevaFoto"]["tmp_name"])){
     					$ruta=$this->Util->ImageProcess();
     				}

     				$datos = array('idPPL'=>$_POST['idPPL'],
     					           'nombre' =>$_POST['editarNombre'],
     						      'aPaterno' =>$_POST['editarApaterno'],
     						      'aMaterno' =>$_POST['editarAmaterno'],
     						      'sexo' =>$_POST['editarSexo'],
                      'edad' =>$_POST['editarEdad'],
                      'fIngreso' =>$_POST['editarfIngreso'],
     						    'fNacimiento' =>$_POST['editarfNacimiento'],
     							  'foto'=>$ruta
     						       );

     			  if(isset($passcrypt)&&$passcrypt!=null){
     			  	$datos['password']=$passcrypt;
     			  }elseif ($ruta!=null) {
     			  	$datos['foto']=$ruta;
     			  }
            $tabla="spo_ppl";
     				$respuesta =PPLModel::mdlEditarPPL($tabla, $datos);
     				if($respuesta == "ok"){
     					echo'<script>
     					swal({
     						  type: "success",
     						  title: "El usuario ha sido editado correctamente",
     						  showConfirmButton: true,
     						  confirmButtonText: "Cerrar"
     						  }).then(function(result){
     									if (result.value) {
     									window.location = "ppls/list";
     									}
     								})
     					</script>';
     				}
     			}else{
     				echo'<script>
     					swal({
     						  type: "error",
     						  title: "¡El nombre no puede ir vacío o llevar caracteres especiales!",
     						  showConfirmButton: true,
     						  confirmButtonText: "Cerrar"
     						  }).then(function(result){
     							if (result.value) {
     							window.location = "ppls/list";
     							}
     						})
     			  	</script>';
     			}
     	}
      public function ctrEditarProceso(){

 	    				$datos = array('idPPL'=>$_POST['idPPLp'],
     					           'situacion' =>$_POST['editarSituacion'],
     						      'fuero' =>$_POST['editarFuero'],
     						      'delito' =>$_POST['editarDelito'],
     						      'proceso' =>$_POST['editarProceso']
                      );


            $tabla="spo_ppl_proceso";
     				$respuesta =PPLModel::mdlEditarProceso($tabla, $datos);
     				if($respuesta == "ok"){
     					echo'<script>
     					swal({
     						  type: "success",
     						  title: "El proceso ha sido editado correctamente",
     						  showConfirmButton: true,
     						  confirmButtonText: "Cerrar"
     						  }).then(function(result){
     									if (result.value) {
     									window.location = "ppls/list";
     									}
     								})
     					</script>';

     			}else{
     				echo'<script>
     					swal({
     						  type: "error",
     						  title: "¡El nombre no puede ir vacío o llevar caracteres especiales!",
     						  showConfirmButton: true,
     						  confirmButtonText: "Cerrar"
     						  }).then(function(result){
     							if (result.value) {
     							window.location = "ppls/list";
     							}
     						})
     			  	</script>';
     			}
     	}

}
