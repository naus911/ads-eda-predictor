

$("#datepickerNacimiento").datepicker({
format:"yyyy-mm-dd",
		 maxViewMode: 3,
    language: "es",
    autoclose: true,
    defaultViewDate: { year: 1940 }

});

$(".fNacimiento").change(function() {
var datos	 = new FormData();
datos.append("fNacimiento", $(".fNacimiento").val());
$
$.ajax({
	url:"ajax/fnacimiento.ajax.php",
	method: "POST",
	data:datos,
	cache:false,
	contentType: false,
	processData: false,
	dataType:"json",
	success:function(respuesta){
		$("#edad").val(respuesta);
	}
})
});

$(".datepicker").datepicker({
	format:"yyyy-mm-dd",
	maxViewMode: 2,
	todayBtn: true,
	language: "es",
	orientation: "top auto",
	autoclose: true,
	todayHighlight: true
});
 $(function () {
    $(".tablas").DataTable({
      "language":{
        "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
    "sFirst":    "Primero",
    "sLast":     "Último",
    "sNext":     "Siguiente",
    "sPrevious": "Anterior"
    },
    "oAria": {
      "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
      "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }
      }
    })

})
