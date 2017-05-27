$(document).ready(function(){
var valor=null;
$(document).on("click","td.editable span",function(e){
		e.preventDefault();
			$("td:not(#id)").removeClass("editable");
			td=$(this).closest("td");
			campo=$(this).closest("td").data("campo");
			valor=$(this).text();
			id=$(this).closest("tr").find("#id").text();
			td.text("").html("<input type='text' name='"+campo+"' value='"+valor+"'><a class='enlace guardar' href='#'>Guardar</a>");/*<a class='enlace cancelar' href='#'>Cancelar</a>");*/
		});
			/*$(document).on("click",".cancelar",function(e){
			e.preventDefault();
			td.text("").html("<span>"+valor+"</span>");
			$("td:not(#id)").addClass("editable");
		});*/
		$(document).on("click",".guardar",function(e)
		{
			e.preventDefault();
			$("#mensaje").css("display","block").html("<img src='../imagenes/loading.gif'>");
			
			 nuevovalor=$(this).closest("td").find("input").val();
			 id=$(this).closest("tr").find("#id").text();
			 campo=$(this).closest("td").data("campo");
			 td= $(this).closest("td");
			if(nuevovalor.trim()!="")
			{
				$.ajax({
					type: "POST",
					url: "editaryactualizardatosdeoperador.php",
					data: { campo: campo, nuevovalor: nuevovalor, id : id},
					beforeSend: function(){
					$("#mensajeoperador").css("display","block").html("<img src='../imagenes/loading.gif'>");
					}
				})
				.done(function(msg){
				
				if(msg=="<h3>datos actualizado con exito</h3>"){
				$("#mensajeoperador").css("background","green").html(msg).fadeOut(6000);
					td.text("").html("<span>"+nuevovalor+"</span>");
					}else{
					$("#mensajeoperador").css("background","red").html(msg).fadeOut(6000);
					td.text("").html("<span>"+valor+"</span>");
					}
					
				$("td:not(#id)").addClass("editable");
				});
				
			}else{
		 $("#mensajeoperador").fadeIn(300).css("background","red","display","block").html("<h3>error no puede enviar campos vacios</h3>").fadeOut(6000);
			}
			
		});
		$(document).on("click","#eliminaroperador",function(){
		
		ver = $(this).closest("tr").find("#id").text();
	     tr = $(this).closest("tr");
	     
	     $("#todosoperador").fadeIn(300).css("display","block");
	     $("#eliminarusuariooperador").fadeIn(300).css("display","block");
	     $("#si, #no").click(function(){
		datos = $(this).val();
		if(datos=="si"){
	      $("#todosoperador").css("display","none").fadeOut(100);
	     $("#eliminarusuariooperador").css("display","none").fadeOut(100);
		$.ajax({
		type: "post",
		url: "eliminaroperador.php",
		data:{ver:ver},
		beforeSend: function(){
		$("#mensajeoperador").fadeIn(300).css("display","block").html("<img src='../imagenes/loading.gif'>");
		},
		success: function(respuesta){
		if(respuesta=="<h3>datos eliminado con exito</h3>"){
		$("#mensajeoperador").css("background","green").html(respuesta).fadeOut(6000);
		tr.fadeOut(300).html("");
		}else{
		$("#mensajeoperador").css("background","red").html(respuesta).fadeOut(6000);
		}
		}
		});
		}else if(datos=="no"){
		  $("#todosoperador").css("display","none").fadeOut(100);
	       $("#eliminarusuariooperador").css("display","none").fadeOut(100);
		}
		});
		});
		
		
});
