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
});
$(".btnEditarPPL").click(function(){
  var idPPL= $(this).attr("idPPL");
	var datos = new FormData();

  datos.append("idPPL",idPPL);
   $.ajax({
    url: "ajax/ppls.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType:false,
    processData: false,
    dataType: "json",
    success: function(respuesta) {

		 $("#idPPL").val(respuesta['rowid_ppl']);
     $("#editarNombre").val(respuesta['nombre_ppl']);
   	 $("#editarApaterno").val(respuesta['aPaterno_ppl']);
   	 $("#editarAmaterno").val(respuesta['aMaterno_ppl']);
   	 $(".fNacimiento").val(respuesta['fNacimiento_ppl']);
		 $(".fIngreso").val(respuesta['fIngreso_ppl']);
		 $("#edad").val(respuesta['edad_ppl']);
		$("#editarSexo").val(respuesta['sexo_ppl']);
		 if (respuesta['sexo_ppl']=="M") {
		 $("#editarSexo").html('MASCULINO');
	 }else {
	 	$("#editarSexo").html('FEMEMINO');
	 }
     $("#fotoActual").val(respuesta['foto_ppl']);
     if (respuesta['foto'] != "") {
      $(".previsualizar").attr("src",respuesta['foto_ppl']);
     }
    }
  });
})

$(".btnEditarProceso").click(function(){
  var idPPLp= $(this).attr("idPPLp");
	var datos = new FormData();
	datos.append("idPPLp",idPPLp);
   $.ajax({
    url: "ajax/ppls.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType:false,
    processData: false,
    dataType: "json",
    success: function(respuesta) {
		 $("#idPPLp").val(respuesta['fk_ppl']);
     $("#editarProceso").val(respuesta['no_proceso']);
   	 $("#editarDelito").val(respuesta['delito']);
   	 $("#editarSituacion").val(respuesta['situacion']);
		 if (respuesta['situacion']=="S") {
		 $("#editarSituacion").html('SENTENCIADO');
	 }else {
	 	$("#editarSituacion").html('PROCESADO');
	 }
	 $("#editarFuero").val(respuesta['fuero']);
	 if (respuesta['fuero']=="C") {
	 $("#editarFuero").html('COMUN');
 }else {
	$("#editarFuero").html('FEDERAL');
 }
  $("#editarDelito").val(respuesta['delito']);

    }
  });
})

$(document).on("click", ".btnActivar", function(){
	var idUsuario = $(this).attr("idPPL");
	var TypeUsuario = 'PPL';
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
		        	window.location = "ppls/list";
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
