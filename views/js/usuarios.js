$(".pass2").change(function(){
var pass1 =$(".pass1").val();
if(pass1 != $(".pass2").val()){
$(".gpass").addClass('has-error');
$(".aviso").show();
$(".aviso2").hide();
}else{
	$(".gpass").removeClass('has-error');
	$(".gpass").addClass('has-success');
	$(".pass2").attr('id','inputSuccess');
	$(".aviso").hide();
	$(".aviso2").show();
}

})
/*valida tamño foto*/
$(".nuevaFoto").change(function() {
	var imagen = this.files[0];
	/*
	validando ext
	 */

	if (imagen["type"]!="image/jpeg" && imagen["type"]!="image/png") {
		$(".nuevaFoto").val();
		swal({
     type:"error",
     title: "Tipo de imagen no permitida.!!",
     showConfirmButton: true,
     confirmButtonText:"Cerrar",
     closeOnConfirm: false
   });

	}else if(imagen["size"]>2000000){
		$(".nuevaFoto").val();
		swal({
     type:"error",
     title: "imagen mayor tamaño de lo permitido",
     showConfirmButton: true,
     confirmButtonText:"Cerrar",
     closeOnConfirm: false
   });
  	}
  	else{
  		var datosImagen = new FileReader; //clase de js
  		datosImagen.readAsDataURL(imagen);//lee los datos de imagen
  		$(datosImagen).on("load",function (event) {//carga los datos deimagne
  			var rutaImagen= event.target.result;// guarda ruta de imagen
  			$(".previsualizar"). attr('src', rutaImagen);//muestra la nueva imagen en el elmento
  		});
  	}
})

/*
editar usuario
 */

$(".btnEditarUsuario").click(function(){
  var idUsuario= $(this).attr("idUsuario");
  var datos = new FormData();
  datos.append("idUsuario",idUsuario);
   $.ajax({
    url: "ajax/usuarios.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType:false,
    processData: false,
    dataType: "json",
    success: function(respuesta) {
		 $("#userId").val(respuesta['rowid_users']);
     $("#nuevoUsuario").val(respuesta['usuario']);
     $("#editarNombre").val(respuesta['nombre_user']);
   	 $("#editarApaterno").val(respuesta['aPaterno_user']);
   	 $("#editarAmaterno").val(respuesta['aMaterno_user']);
   	 $("#editarArea").val(respuesta['departamento']);
     $("#editarPerfil").html(respuesta['tipoUsuario']);
     $("#editarPerfil").val(respuesta['tipoUsuario']);
     $("#fotoActual").val(respuesta['foto_user']);
     if (respuesta['foto'] != "") {
      $(".previsualizar").attr("src",respuesta['foto']);
     }

    }
  });

})
 //Activar Usuarios

 $(document).on("click", ".btnActivar", function(){

	 var idUsuario = $(this).attr("idUsuario");
	 var TypeUsuario = 'user';
	 var estadoUsuario = $(this).attr("estadoUsuario");

	 var datos = new FormData();
	 datos.append("activarId", idUsuario);
		 datos.append("activarUsuario", estadoUsuario);
		 datos.append("TipoUsuario", TypeUsuario);
		 $.ajax({
		 url:"ajax/estatus.ajax.php",
		 method: "POST",
		 data: datos,
		 cache: false,
			 contentType: false,
			 processData: false,
			 success: function(respuesta){
						swal({
						 title: "Registro ha sido actualizado",
						 type: "success",
						 confirmButtonText: "¡Cerrar!"
					 }).then(function(result) {
							 if (result.value) {
							 window.location = "users/list";
						 }
					 });
			 }
		 })
		 if(estadoUsuario == 0){
			 $(this).removeClass('btn-success');
			 $(this).addClass('btn-danger');
			 $(this).html('Desactivado');
			 $(this).attr('estadoUsuario',1);
		 }else{
			 $(this).addClass('btn-success');
			 $(this).removeClass('btn-danger');
			 $(this).html('Activado');
			 $(this).attr('estadoUsuario',0);
		 }
 })
