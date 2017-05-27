$(document).ready(function(){

var valor=null;
    $(document).on("click","td.editable span",function(e){
		e.preventDefault();
		$("td:not(#id)").removeClass("editable");
	    td=$(this).closest("td");
	    campo = $(this).closest("td").data("campo");
        valor = $(this).text();
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
			
			 nuevovalor = $(this).closest("td").find("input").val();
			 tipo       = $(this).closest("tr").find("#tipo").text();
			 campo      = $(this).closest("td").data("campo");
			 td         = $(this).closest("td");
			 id = $(this).closest("tr").find("#id").text();
			 idcomuna=$(this).closest("tr").find("#idcomuna").text();
			 
			 
			 
			if(nuevovalor.trim()!="")
			{

				$.ajax({

					type: "POST",
					url: "editaryactualizardatosdecomunas.php",
					data: { campo: campo, nuevovalor: nuevovalor, id : id, tipo : tipo,idcomuna:idcomuna },
					beforeSend: function(){
					$("#mensajedatoscomunas").css("display","block").html("<img src='../imagenes/loading.gif'>");
					}
				})
				.done(function(msg){
				
				if(msg=="<h3>datos actualizado con exito</h3>"){
				$("#mensajedatoscomunas").css("background","green").html(msg).fadeOut(6000);
				    td.text("").html("<span>"+nuevovalor+"</span>");
					}else{
					$("#mensajedatoscomunas").css("background","red").html(msg).fadeOut(6000);
					td.text("").html("<span>"+valor+"</span>");
					}
					
				$("td:not(#id)").addClass("editable");
				});
				
			
		}
			
		});
		$(document).on("click","#eliminarintegrantescomunas",function(){
			 
			 ver = $(this).closest("tr").find("#id").text();
			 idcomuna = $(this).closest("tr").find("#idcomuna").text();
		       tr = $(this).closest("tr");
		       $("#todoscomunas").fadeIn(300).css("display","block");
		       $("#eliminarusuariocomunas").fadeIn(300).css("display","block");
		       $("#si , #no").click(function(){
		 datos =$(this).val();
		if(datos=='si'){
		   $("#todoscomunas").css("display","none").fadeOut(100);
		   $("#eliminarusuariocomunas").css("display","none").fadeOut(100);
		 
		$.ajax({
		type: "post",
		url: "eliminarintegrantescomunas.php",
		data:{ver:ver,idcomuna:idcomuna},
		beforeSend: function(){
		$("#mensajedatoscomunas").fadeIn(300).css("display","block").html("<img src='../imagenes/loading.gif'>");
		},
		success: function(respuesta){
		if(respuesta=="<h3>datos eliminado con exito</h3>"){
		$("#mensajedatoscomunas").css("background","green").html(respuesta).fadeOut(6000);
		tr.fadeOut(300).html("");
		}else{
		$("#mensajedatoscomunas").css("background","red").html(respuesta).fadeOut(6000);
		}
		}
		});
		}else if(datos=="no"){
		 $("#todoscomunas").css("display","none").fadeOut(100);
		   $("#eliminarusuariocomunas").css("display","none").fadeOut(100);
		}
		});
		});
		
		
		$(document).on("click","#eliminarconsejoscomunas",function(){
		ver = $(this).closest("tr").find("#idconsejocomuna").text();
		idcomuna =$(this).closest("tr").find("#idcomuna").text();
		idconsejo = $(this).closest('tr').find("#idconsejos").text();
		tr= $(this).closest("tr");

		 
		 $("#todoscomunas").fadeIn(300).css("display","block");
		 $("#eliminarusuarioconsejoscomunales").fadeIn(300).css("display","block");
		
		$("#sielimnar, #noeliminar").click(function(){
		 datos = $(this).val();
		if(datos=="si"){
		 $("#todoscomunas").css("display","none").fadeOut(100);
		 $("#eliminarusuarioconsejoscomunales").css("display","none").fadeOut(100);
		 
		$.ajax({
		type: "POST",
		url:"eliminarconsejoscomunas.php",
		data:{ver:ver,idcomuna:idcomuna,idconsejo:idconsejo},
		beforeSend: function(){
		$("#mensajedatoscomunas").fadeIn(300).css("display","block").html("<img src='../imagenes/loading.gif'>");
		},
		success: function(respuesta){
		if(respuesta=="<h3>datos eliminado con exito</h3>"){
		$("#mensajedatoscomunas").css("background","green").html(respuesta).fadeOut(6000);
		tr.fadeOut(300).html("");
			setTimeout(function(){
		$.post("obtenerdatosdecomunas.php",{id:idcomuna},function(respuesta){
		$("#contenido").html(respuesta);
		});
			},6000);
		}else{
		$("#mensajedatoscomunas").css("background","red").html(respuesta).fadeOut(6000);
		}
		}
		});

		}else if(datos=="no"){
		$("#todoscomunas").css("display","none").fadeOut(100);
		$("#eliminarusuarioconsejoscomunales").css("display","none").fadeOut(100);
		}
		});
		});
		
		$(document).on("click","#elegirconsejos",function(){
		 id = $(this).closest("tr").find("#idconsejos").text();
		$.ajax({
		type:"POST",
		url:"obtenerdatosdeconsejos.php",
		data:{id:id},
		beforeSend: function(){
		$("#contenido").fadeIn(300).css("display","block").html("<img src='../imagenes/loading.gif'>");
		},
		success: function(respuesta){
		$("#contenido").html(respuesta);
		}
		});
		});
		
		
		$(document).on('click',"#generarpdfcomunas",function(){
		no= $("#idpdfcomunas").val();
		window.location="pdfobtenerdatosdecomunas.php?ver="+no;
		});
});

