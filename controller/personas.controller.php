<?php
/**
 *
 */
class PersonasController
{

  public  $Util;
  function __construct()
  {

    $this->Util = new Utilcontroller();
    #$this->tabla="spo_persona";
  }
  public function ctrMostrarPersonas($item,$valor)
  {
    $tablas=PersonasController::tablasName();
    $respuesta=PersonasModel::MdlMostrarPersonas($tablas['tabla'], $item, $valor);
    return $respuesta;
  }
  public function ctrMostrarPersonaDetalle($item,$valor)
  {
    $tablas=PersonasController::tablasName();
    $respuesta=PersonasModel::MdlMostrarPersonaDetalle($tablas['tabla'],$tablas['tabla2'],$tablas['tabla3'], $item, $valor);
    return $respuesta;
  }
  public function ctrCrearPersona()
  {

  $tablas=PersonasController::tablasName();

      if (isset($_POST['nuevoNombrePersona'])) {
         if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ]+$/',$_POST["nuevoNombrePersona"])){
           $fcreacion=date("Y-m-d H:i:s");
           $ruta="";
            if (isset($_FILES['nuevaFoto']["tmp_name"])) {

              $ruta=$this->Util->ImageProcess();
              }
           else{
            $ruta="views/images/default/anonymous.png";
           }
       		$datos = array('nombre' =>$_POST['nuevoNombrePersona'],
       						      'aPaterno' =>$_POST['aPaterno'],
       						      'aMaterno' =>$_POST['aMaterno'],
       						      'fNacimiento' =>$_POST['fNacimiento'],
       						      'edad'=>$_POST['edad'],
                        'sexo'=>$_POST['sexo'],
                        'lNacimiento' =>$_POST['lNacimiento'],
                        'edoCivil'=>$_POST['edoCivil'],
                        'ocupacion'=>$_POST['ocupacion'],
                        'escolaridad'=>$_POST['escolaridad'],
                        'nHijos'=>$_POST['nHijos'],
                        'fcreacion'=>$fcreacion,
                        'foto'=>$ruta
       						       );

                   $respuesta=PersonasModel::MdlCrearPersona($tablas,$datos);
                   if ($respuesta=='ok') {
              		   print'<script>
              		   swal({
              		     type:"success",
              		     title: "Persona agregada correntamente.!!",
              		     showConfirmButton: true,
              		     confirmButtonText:"Cerrar",
              		     closeOnConfirm: false
              		   }).then((result)=>{
              		     if(result.value){
              		       window.location="personas/list";
              		     }
              		   });
              		   </script>';
              		 }
                 }else {
                     print'<script>
                     swal({
                       type:"error",
                       title: "Error Ingresar Persona",
                       showConfirmButton: true,
                       confirmButtonText:"Cerrar",
                       closeOnConfirm: false
                     }).then((result)=>{
                       if(result.value){
                         window.location="personas/list";
                       }
                     });
                     </script>';
                   }

        }
      }
      public function ctrEditarPersona(){
        $tablas=PersonasController::tablasName();

      			$ruta=null;
     			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombrePersona"])){

     				if(isset($_FILES["nuevaFoto"]["tmp_name"]) && !empty($_FILES["nuevaFoto"]["tmp_name"])){
     					$ruta=$this->Util->ImageProcess();
     				}

     				$datos = array('idPersona' =>$_POST['idPersona'],
              'nombre' =>$_POST['nuevoNombrePersona'],
         						      'aPaterno' =>$_POST['aPaterno'],
         						      'aMaterno' =>$_POST['aMaterno'],
         						      'fNacimiento' =>$_POST['fNacimiento'],
         						      'edad'=>$_POST['edad'],
                          'sexo'=>$_POST['sexo'],
                          'lNacimiento' =>$_POST['lNacimiento'],
                          'edoCivil'=>$_POST['edoCivil'],
                          'ocupacion'=>$_POST['ocupacion'],
                          'escolaridad'=>$_POST['escolaridad'],
                          'nHijos'=>$_POST['nHijos'],
                          //ubicacion
                          'estado'=>$_POST['estado'],
                          'ciudad'=>$_POST['ciudad'],
                          'calle'=>$_POST['calle'],
                          'numero'=>$_POST['numero'],
                          'colonia'=>$_POST['colonia'],
                          'codigoPostal'=>$_POST['codigoPostal'],
                          'telefono'=>$_POST['telefono'],
                          'celular'=>$_POST['celular'],
                          //medico
                          'enfermedades'=>$_POST['enfermedades'],
                          'espEnfermedad'=>$_POST['espEnfermedad'],
                          'discapacidad'=>$_POST['discapacidad'],
                          'espDiscapacidad'=>$_POST['espDiscapacidad'],
                          'numeroSocial'=>$_POST['numeroSocial'],
                          'observaciones'=>$_POST['observaciones'],
                          'foto'=>''
     						       );
                       if ($ruta!=null) {
                			  	$datos['foto']=$ruta;
                			  }else{
                          	$datos['foto']=$_POST['imgPersona'];
                        }

     				$respuesta =PersonasModel::mdlEditarPersona($tablas, $datos);
     				if($respuesta == "ok"){
     					echo'<script>
     					swal({
     						  type: "success",
     						  title: "El usuario ha sido editado correctamente",
     						  showConfirmButton: true,
     						  confirmButtonText: "Cerrar"
     						  }).then(function(result){
     									if (result.value) {
     									window.location = "personas/edit?idPersona='.$datos['idPersona'].'";
     									}
     								})
     					</script>';
     				}
     			}else{
     				echo'<script>
     					swal({
     						  type: "error",
     						  title: "¡error '.$respuesta.'",
     						  showConfirmButton: true,
     						  confirmButtonText: "Cerrar"
     						  }).then(function(result){
     							if (result.value) {
     							window.location = "personas/list";
     							}
     						})
     			  	</script>';
     			}
     	}
      public function ctrCrearPersonaVisita(){
        $tablas=PersonasController::tablasName();

            $ruta=null;
          if(isset($_POST["idPersona"])&&$_POST['idPersona']!=null&&isset($_POST["idPPL"])&&$_POST['idPPL']!=null){

            $datos = array('idPersona' =>$_POST['idPersona'],
                          'idPPL' =>$_POST['idPPL'],
                          'parentesco' =>$_POST['parentesco'],
                          'tVisita' =>$_POST['tVisita'],
                          'cParentesco' =>$_POST['cParentesco'],
                          'cElector' =>$_POST['cElector'],
                          'curp' =>$_POST['curp'],
                          'fotos' =>$_POST['fotos'],
                          'acta' =>$_POST['acta'],
                          'cDom' =>$_POST['cDom'],
                          'dia' =>$_POST['dia'],
                          'eMedico' =>$_POST['eMedico'],
                          'fMedico' =>$_POST['fMedico'],
                          'ePapa' =>$_POST['ePapa'],
                          'fPapa' =>$_POST['fPapa'],
                          'eVih' =>$_POST['eVih'],
                          'fVih' =>$_POST['fVih'],
                          'temporal' =>$_POST['temporal']
                       );


            $respuesta =PersonasModel::mdlCrearPersonaVisita($tablas, $datos);
            if($respuesta == "ok"){
              echo'<script>
              swal({
                  type: "success",
                  title: "El usuario ha sido editado correctamente",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar"
                  }).then(function(result){
                      if (result.value) {
                      window.location = "personas/edit?idPersona='.$datos['idPersona'].'";
                      }
                    })
              </script>';
            }
          }else{
            echo'<script>
              swal({
                  type: "error",
                  title: "¡error '.$respuesta.'",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar"
                  }).then(function(result){
                  if (result.value) {
                  window.location = "personas/list";
                  }
                })
              </script>';
          }
      }


private function tablasName()
{
  $tablas = array('tabla' =>"spo_persona" ,
'tabla2' => "spo_personaUbicacion",
'tabla3' => "spo_personaDetalles" );
  return $tablas;
}


}



 ?>
