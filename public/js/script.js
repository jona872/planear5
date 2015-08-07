//para guardar dinamico, ejemplo con genero.
$("#registro").click(function()
{
	var dato = $("#genre").val();
	var route = "http://localhost/app/ejem/public/genero";
	var token = $("#token").val();

	$.ajax({
		url : route,
		headers : {'X-CSRF-TOKEN': token },
		type : 'POST',
		datatype : 'json',
		data : {genre : dato },
		success : function (){
						$("#msj-success").fadeIn();		
					}
	});
});

