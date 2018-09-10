<?php
/**
 * Clase Usuarios
 */
class UsuariosController
{
  	public $tabla = "spo_users";
    public  $Util;
    function __construct(){
      $this->Util = new Utilcontroller();
    }
     public function ctrMostrarUsuarios($item,$valor)
  {
  	$tabla="spo_users";
    $respuesta=ModelUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);
    return $respuesta;
  }
  /* crear usuer*/

 public function ctrCrearUsuario(){
  if (isset($_POST["nuevoUsuario"])) {
     if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ]+$/',$_POST["nuevoNombre"])&&
     	preg_match('/^[a-zA-Z0-9]+$/',$_POST["nuevoUsuario"])&&
     	preg_match('/^[a-zA-Z0-9]+$/',$_POST["nuevoPassword"])){
		     $ruta="";
	       	if (isset($_FILES['nuevaFoto']["tmp_name"])) {

	       		$ruta=$this->Util->ImageProcess();
		        }
	       else{
	       	$ruta="views/images/default/anonymous.png";
	       }

		$tabla="spo_users";
		$passcrypt=$this->Util->PassEncrypt($_POST['nuevoPassword']);
		$fcreacion=date("Y-m-d H:i:s");
		$datos = array('nombre' =>$_POST['nuevoNombre'],
						      'aPaterno' =>$_POST['aPaterno'],
						      'aMaterno' =>$_POST['aMaterno'],
						      'area' =>$_POST['area'],
						      'usuario'=>$_POST['nuevoUsuario'],
							  'password'=>$passcrypt,
						      'tipoUsuario'=>$_POST['tipoUsuario'],
						      'fcreacion'=>$fcreacion,
						      'foto'=>$ruta );
		 $respuesta=ModelUsuarios::mdlAgregarUsuario($tabla,$datos);
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
		       window.location="users/list";
		     }
		   });
		   </script>';
		 }
    }else{
       print'<script>
       swal({
         type:"error",
         title: "El usuario no puede ir vacio o llevar caracteres especiales",
         showConfirmButton: true,
         confirmButtonText:"Cerrar",
         closeOnConfirm: false
       }).then((result)=>{
         if(result.value){
           window.location="users/list";
         }
       });
       </script>';
     }
  }
}
 public function ctrEditarUsuario(){

 			$ruta=null;
			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"])){

				if(isset($_FILES["nuevaFoto"]["tmp_name"]) && !empty($_FILES["nuevaFoto"]["tmp_name"])){
					$ruta=$this->Util->ImageProcess();
				}
				$tabla = "spo_users";
				if($_POST["editarPassword"] != ""){
					if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])){
						$passcrypt=$this->Util->PassEncrypt($_POST['nuevoPassword']);
					}else{
						echo'<script>
								swal({
									  type: "error",
									  title: "¡La contraseña no puede ir vacía o llevar caracteres especiales!",
									  showConfirmButton: true,
									  confirmButtonText: "Cerrar"
									  }).then(function(result){
										if (result.value) {
										window.location = "usuarios";
										}
									})
						  	</script>';
					}
				}
				$datos = array('idUsuario'=>$_POST['userId'],
					           'nombre' =>$_POST['editarNombre'],
						      'aPaterno' =>$_POST['editarApaterno'],
						      'aMaterno' =>$_POST['editarAmaterno'],
						      'area' =>$_POST['editarArea'],
						      //'usuario'=>$_POST['nuevoUsuario'],
							  'password'=>"",
						      'tipoUsuario'=>$_POST['editarPerfil'],
						      'foto'=>""
						       );
			  if(isset($passcrypt)&&$passcrypt!=null){
			  	$datos['password']=$passcrypt;
			  }elseif ($ruta!=null) {
			  	$datos['foto']=$ruta;
			  }
				$respuesta = ModelUsuarios::mdlEditarUsuario($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El usuario ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "users/list";

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

							window.location = "users/list";

							}
						})

			  	</script>';
			}
	}
	public static function alerta()
	{
		echo '<script>
		alert("hola mundo");</script>';
	}
}
