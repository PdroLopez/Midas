function BuscarServiciosSucursal(id) {
	var ruta = $("#ruta").val();
	$("#kt_select2_3").empty();
	$("#kt_select2_3").append(`<option value = "">Seleccione`);
	$.get(ruta+"/buscar-servicio-sucursal/"+id, function(data, status){
		data.forEach(element => {
			$("#kt_select2_3").append(`<option value=${element.id}> ${element.nombre} </option>`);
		});
	});
}