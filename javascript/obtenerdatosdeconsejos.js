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
			 idconsejo=$(this).closest("tr").find("#idconsejo").text();
			 campo=$(this).closest("td").data("campo");
			 td= $(this).closest("td");
			if(nuevovalor.trim()!="")
			{
				$.ajax({
					type: "POST",
					url: "editaryactualizardatosdeconsejos.php",
					data: { campo: campo, nuevovalor: nuevovalor, id : id, tipo : tipo,idconsejo:idconsejo },
					beforeSend: function(){
					$("#mensajedatosconsejos").css("display","block").html("<img src='../imagenes/loading.gif'>");
					}
				})
				.done(function(msg){
				
				if(msg=="<h3>datos actualizado con exito</h3>"){
				$("#mensajedatosconsejos").css("background","green").html(msg).fadeOut(6000);
				td.text("").html("<span>"+nuevovalor+"</span>");
					}else{
					$("#mensajedatosconsejos").css("background","red").html(msg).fadeOut(6000);
					td.text("").html("<span>"+valor+"</span>");
					}
					
				$("td:not(#id)").addClass("editable");
				});
				
			}
			
		});
		$(document).on("click","#eliminarintegrantesconsejos",function(){
		
		
		 ver = $(this).closest("tr").find("#id").text();
		 idconsejo=$(this).closest("tr").find("#idconsejo").text();
		 tr = $(this).closest("tr");
		 
		 $("#todos").fadeIn(300).css("display","block");
		$("#eliminarusuarioconsejos").fadeIn(300).css("display","block");
		$("#si, #no").click(function(){
		 dato = $(this).val();
		
		
		if(dato=="si"){
		 $("#todos").css("display","none").fadeOut(100);
		 $("#eliminarusuarioconsejos").css("display","none").fadeOut(100);
		 
		$.ajax({
		type:"post",
		url: "eliminarintegrantesconsejos.php",
		data:{ver:ver,idconsejo:idconsejo},
		beforeSend: function(){
		$("#mensajedatosconsejos").fadeIn(300).css("display","block").html("<img src='../imagenes/loading.gif'>");
		},
		success: function(respuesta){
		if(respuesta=="<h3>datos eliminado con exito</h3>"){
		$("#mensajedatosconsejos").css("background","green").html(respuesta).fadeOut(6000);
		tr.fadeOut(300).html("");
		}else{
		$("#mensajedatosconsejos").css("background","red").html(respuesta).fadeOut(6000);
		}		
		}
		});
		}else if(dato=="no"){
		$("#todos").css("display","none").fadeOut(300);
		$("#eliminarusuarioconsejos").css("display","none").fadeOut(300);
		}
		});
		});
		
		$(document).on('click',"#generarpdfconsejos",function(){
		 no = $("#idpdfconsejos").val();
		window.location="pdfobtenerdatosconsejos.php?ver="+no;
		});
		

});

