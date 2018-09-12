
$("#e-radio").click(function(){
		if($("#e-radio").is(":checked")){
	$("#e-radio").addClass('iradio_minimal-blue');
		$("#e-text").show();
	}

			});

			$("#ex-radio").click(function(){
				if($("#ex-radio").is(":checked")){
					$("#e-radio").removeClass('iradio_minimal-blue');
					$("#ex-radio").addClass('iradio_minimal-blue');
					$("#e-text").hide();
				}
						});
						// radio discapacidad
				$("#d-radio").click(function(){
						if($("#d-radio").is(":checked")){
							$("#d-radio").addClass('iradio_minimal-blue');
							$("#d-text").show();
							}
					});
					$("#dx-radio").click(function(){
						if($("#dx-radio").is(":checked")){
								$("#d-radio").removeClass('iradio_minimal-blue');
								$("#dx-radio").addClass('iradio_minimal-blue');
								$("#d-text").hide();
								}
					});

$(".nuevaFoto").change(function(){
	var imagen = this.files[0];

	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/

  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

  		$(".nuevaFoto").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else if(imagen["size"] > 2000000){

  		$(".nuevaFoto").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else{

  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagen);

  		$(datosImagen).on("load", function(event){

  			var rutaImagen = event.target.result;

  			$(".previsualizar").attr("src", rutaImagen);

  		})

  	}
})
$(".btnEditarPersona").click(function() {
	var idUsuario= $(this).attr("idUsuario");
	window.location="personas/edit?idPersona="+idUsuario;

});
$(".btnAsignarPPL").click(function() {
	var idUsuario= $(this).attr("idUsuario");
	window.location="visitas/asignar?idPersona="+idUsuario;

});
$(".btnProfilePersona").click(function() {
	var idUsuario= $(this).attr("idUsuario");
	window.location="profile/persona?idPersona="+idUsuario;

});

function loadDataPersona(){
	var prodId = getParameterByName('idPersona');
	var datos = new FormData();
  datos.append("idUsuario",prodId);
   $.ajax({
    url: "ajax/personas.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType:false,
    processData: false,
    dataType: "json",
    success: function(respuesta) {

			$("#formEditar").attr('action','personas/edit?idPersona='+prodId);
		$("#idPersona").val(respuesta['rowid_persona']);

		$(".profile-username").append(respuesta['nombre_persona']);
		$("#Nombre").val(respuesta['nombre_persona']);
		$("#Apaterno").val(respuesta['aPaterno_persona']);
		$("#Amaterno").val(respuesta['aMaterno_persona']);
    $(".profile-lastname").append(respuesta['aPaterno_persona']+' '+respuesta['aMaterno_persona']);
		$(".fNacimiento").val(respuesta['fNacimiento_persona']);
		$("#edad").val(respuesta['edad_persona']);
		$("#sexo").val(respuesta['sexo_persona']);
     $("#lNacimiento").val(respuesta['lNacimiento_persona']);
		$("#edoCivil").val(respuesta['edoCivil_persona']);
		$("#escolaridad").val(respuesta['escolaridad_persona']);
		$("#ocupacion").val(respuesta['ocupacion_persona']);
		$("#nHijos").val(respuesta['nHijos_persona']);
		if (respuesta['foto_persona'] != "") {
		 $(".previsualizar").attr("src",respuesta['foto_persona']);
		 $("#imgPersona").val(respuesta['foto_persona']);
		}
			$("#estado").val(respuesta['estado']);
			$("#ciudad").val(respuesta['ciudad']);
			$("#calle").val(respuesta['calle']);
			$("#numero").val(respuesta['numero']);
			$("#colonia").val(respuesta['colonia']);
			$("#codigoPostal").val(respuesta['cPos']);
			$("#telefono").val(respuesta['telefono']);
			$("#celular").val(respuesta['celular']);
			//medico
			$("#numeroSocial").val(respuesta['sSocial_persona']);

			$("#espDiscapacidad").val(respuesta['dDetalle_persona']);
			if(respuesta['enfermedades_persona']!=0){
				$("#e-radio").attr('checked','true');
				$("#e-text").show();
				$("#espEnfermedad").val(respuesta['eDetalle_persona']);
			}else{
					$("#ex-radio").attr('checked','true');
			}
			if(respuesta['discapacidad_persona']!=0){
				$("#d-radio").attr('checked','true');
				$("#d-text").show();
				$("#espDiscapacidad").val(respuesta['dDetalle_persona']);
			}else{
					$("#dx-radio").attr('checked','true');
			}
			$("#observaciones").val(respuesta['observaciones_persona']);

		}
  });
}
function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

$(".btnCancelar").click(function() {
		window.location="personas/list";
});
$(document).on("click", ".btnActivar", function(){
	var idUsuario = $(this).attr("idPersona");
	var TypeUsuario = 'persona';
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
		        	window.location = "personas/list";
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
	});
