$(document).ready(function(){
	$("#form").submit(function(event ){
		event.preventDefault();

			$.ajax({
				type: 'POST',
				//public/js
				url:'js/send.php',
				data:$(this).serialize(),
				success: function(data){
					$("#respuesta").slideDown();
					$("#respuesta").html(data);
				}

			});

		return false;
	});



});