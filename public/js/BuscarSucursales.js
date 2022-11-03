function BuscarSucursales(id) {
	var ruta = $("#ruta").val();
	$("#sucursal").empty();
	$("#sucursal").append(`<option value = "">Seleccione`);
	$.get(ruta+"/buscar-sucursal/"+id, function(data, status){
		data.forEach(element => {
			$("#sucursal").append(`<option value=${element.id}> ${element.nombre} </option>`);
		});
	});
}