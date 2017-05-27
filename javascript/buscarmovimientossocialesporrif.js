$(document).ready(function(){

	$(document).on("click","#elegirmovimientosporrif",function(){

		id=$(this).closest("tr").find(".idmovimientos").text();

		$.ajax({

					type:"post",
					url:"obtenerdatosdemovimientos.php",
					data:{id:id},
					beforeSend: function()
					{
	            		$("#contenido").html("<img src='../imagenes/loading.gif'>");
	            	},
	            	success:function(respuesta)
	            	{
	            		$("#contenido").html(respuesta);
	            	}
				});
	});
});