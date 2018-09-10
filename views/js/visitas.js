  $('.select2').select2();
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
        if (respuesta['foto_persona'] != "") {
    		 $(".previsualizar").attr("src",respuesta['foto_persona']);
    		}
      }

    });
  }
  function getParameterByName(name) {
      name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
      var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
      results = regex.exec(location.search);
      return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
  }
  loadDataPersona();
