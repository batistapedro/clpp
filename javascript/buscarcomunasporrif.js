$(document).ready(function(){

$(document).on("click","#elegircomunaporrif",function()
{
	id=$(this).closest("tr").find(".idcomuna").text();

	$.ajax({
		type:"post",
		url :"obtenerdatosdecomunas.php",
		data:{id:id},
		beforeSend: function()
		{
			$("#contenido").html("<img src='../imagenes/loading.gif'>");
		},
		success: function(respuesta)
		{
			$("#contenido").html(respuesta);
		}
	})


});


});