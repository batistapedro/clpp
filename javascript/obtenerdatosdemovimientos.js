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
			$("#mensajeconsejales").css("display","block").html("<img src='../imagenes/loading.gif'>");
			
			 nuevovalor=$(this).closest("td").find("input").val();
			 tipo = $(this).closest("tr").find("#tipo").text();
			 id=$(this).closest("tr").find("#id").text();
			 idmovimiento=$(this).closest("tr").find("#idmovimiento").text();
			 campo=$(this).closest("td").data("campo");
			td= $(this).closest("td");
			if(nuevovalor.trim()!="")
			{
				$.ajax({
					type: "POST",
					url: "editaryactualizardatosdemovimientos.php",
					data: { campo: campo, nuevovalor: nuevovalor, id : id, tipo : tipo,idmovimiento:idmovimiento },
					beforeSend: function(){
					$("#mensajedatosmovimientos").css("display","block").html("<img src='../imagenes/loading.gif'>");
					}
				})
				.done(function(msg){
				
				if(msg=="<h3>datos actualizado con exito</h3>"){
				$("#mensajedatosmovimientos").css("background","green").html(msg).fadeOut(6000);
				    td.text("").html("<span>"+nuevovalor+"</span>");
					}else{
					$("#mensajedatosmovimientos").css("background","red").html(msg).fadeOut(6000);
					td.text("").html("<span>"+valor+"</span>");
					}
					
				$("td:not(#id)").addClass("editable");
				});
				
			}
			
		});
		$(document).on("click","#eliminarintegrantesmovimientos",function(){
		
		ver = $(this).closest("tr").find("#id").text();
		idmovimiento = $(this).closest("tr").find("#idmovimiento").text();
		 tr = $(this).closest("tr");
		$("#todosmovimientos").fadeIn(300).css("display","block");
		$("#eliminarusuariomovimientos").fadeIn(300).css("display","block");
		
		$("#si, #no").click(function(){
		dato = $(this).val()
		if(dato=='si'){
		 $("#todosmovimientos").css("display","none").fadeOut(100);
		 $("#eliminarusuariomovimientos").css("display","none").fadeOut(100);
		
		$.ajax({
		type: "post",
		url: "eliminarintegrantesmovimientos.php",
		data: {ver:ver,idmovimiento:idmovimiento},
		beforeSend:function(){
		$("#mensajedatosmovimientos").fadeIn(300).css("display","block").html("<img src='../imagenes/loading.gif'>");
		},
		success: function(respuesta){
		if(respuesta == "<h3>datos eliminado con exito</h3>"){
		$("#mensajedatosmovimientos").css("background","green").html(respuesta).fadeOut(6000);
		tr.fadeOut(300).html("");
		}else{
		$("#mensajedatosmovimientos").css("background","red").html(respuesta).fadeOut(6000);
		}
		}
		});
		}else if(dato=="no"){
		 $("#todosmovimientos").css("display","none").fadeOut(100);
		 $("#eliminarusuariomovimientos").css("display","none").fadeOut(100);
		}
		});
		});
		$(document).on('click',"#generarpdfmovimientos",function(){
		
		 no=$("#idpdfmovimientos").val();
		window.location="pdfobtenerdatosdemovimientos.php?ver="+no;
		});
});

