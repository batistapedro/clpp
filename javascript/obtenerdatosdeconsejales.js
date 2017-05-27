$(document).ready(function(){

var valor=null;

$(document).on("click","td.editable span",function(e){
		e.preventDefault();
			$("td:not(.id)").removeClass("editable");
			td=$(this).closest("td");
			campo=$(this).closest("td").data("campo");
			valor =$(this).text();
			id=$(this).closest("tr").find(".id").text();
			td.text("").html("<input type='text' name='"+campo+"' value='"+valor+"'><a class='enlace guardar' href='#'>Guardar</a>");/*<a class='enlace cancelar' href='#'>Cancelar</a>");*/
		});

		/*$(document).on("click",".cancelar",function(e){
			e.preventDefault();
			td.text("").html("<span>"+valor+"</span>");
			$("td:not(.id)").addClass("editable");
		});*/

$(document).on("click",".guardar",function(e)
		{
			e.preventDefault();
			$("#mensajeconsejales").css("display","block").html("<img src='../imagenes/loading.gif'>");
			 td=$(this).closest("td");
			 nuevovalor=$(this).closest("td").find("input").val();
		       id=$(this).closest("tr").find(".id").text();
			 campo = $(this).closest("td").data("campo");
			if(nuevovalor.trim()!="")
			{
				$.ajax({
					type: "POST",
					url: "actualizarconsejales.php",
					data: { campo: campo, nuevovalor: nuevovalor, id : id }
				})
				.done(function( msg ) {

				if(msg=="<h3>datos actualizado con exito</h3>"){
					$("#mensajeconsejales").css("background","green").html(msg).fadeOut(6000);
					td.text("").html("<span>"+nuevovalor+"</span>");
					}else{
					$("#mensajeconsejales").css("background","red").html(msg).fadeOut(6000);
					td.text("").html("<span>"+valor+"</span>");

					}
					$("td:not(.id)").addClass("editable");
				});

			}else{
		 $("#mensajeconsejales").css("background","red").html("<h3>error no puede enviar campos vacios</h3>").fadeOut(6000);
			}

		});

		$(document).on("click","#eliminarconsejales",function(){
	     ver=$(this).closest("tr").find(".id").text();
		 tr=$(this).closest("tr");

		$("#todosconsejales").fadeIn(300).css("display","block");
		$("#eliminarusuariosconsejales").fadeIn(300).css("display","block");

		 $("#si, #no").click(function(){
		dato = $(this).val();
		if(dato=="no"){
		$("#todosconsejales").css("display","none").fadeOut(100);
		$("#eliminarusuariosconsejales").css("display","none").fadeOut(100);
		}else if(dato=="si"){
		$("#todosconsejales").css("display","none").fadeOut(100);
		$("#eliminarusuariosconsejales").css("display","none").fadeOut(100);
		$.ajax({
		type:"POST",
		url:"eliminarconsejales.php",
		data:{ver:ver},
		beforeSend:function(){
		$("#mensajeconsejales").fadeIn(300).css("display","block").html("<img src='../imagenes/loading.gif'>");
		},
		success:function(respuesta){
		if(respuesta=="<h3>datos eliminado con exito</h3>"){
		$("#mensajeconsejales").css("background","green").html(respuesta).fadeOut(6000);
		tr.fadeOut(300).html("");
		}else{
		$("#mensajeconsejales").css("background","red").html(respuesta).fadeOut(6000);
		}
		}
		});
		}
		});

		});

		
		$(document).on("click","#pdfconsejales",function(){
		window.location="pdfconsejales.php";
		});
});
