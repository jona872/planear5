
$(document).ready(function(){
	var tablaDatos = $("#datos");
	var route = "http://localhost/app/ejem/public/generos";


$.get(route, function(res){
		$(res).each(function(key,value){
			tablaDatos.append("<tr><td>"+value.idStock+"</td>"+
			"<td><button value="+value.id+" OnClick='Mostrar(this);' class='btn btn-primary' data-toggle='modal' data-target='#myModal' >Editar</button>"+
			"<button class='btn btn-danger'>Eliminar</button></td></tr>");
		});
	});

});
function Mostrar(btn){
	var route = "http://localhost/app/ejem/public/genero/"+btn.value+"/edit";

	$.get(route, function(res){
		$("#id").val(res.id);
	});
}