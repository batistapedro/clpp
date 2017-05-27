$("#cancelarnoticiaseditada, #enviarnoticiaseditada").click(function(){
	
	noticiaeditada = $("#textareanoticia").val();
	tituloeditada = $("#textareatitulo").val();
	idnoticiaseditada= $("#inputid").val();
	datoseditados = $(this).val();
	if(datoseditados=="Enviar"){
	$.ajax({
	type:"post",
	url:"cambioeditarnoticias.php",
	data:{noticiaeditada:noticiaeditada,tituloeditada:tituloeditada,idnoticiaseditada:idnoticiaseditada},
	beforeSend: function(){
	    $("#respuestanoticias").css("display","block").html("<img src='../imagenes/loading.gif'>");
	},
	success:function(respuesta){
	if(respuesta=="<h3>datos actualizado con exito</h3>"){
	$("#carpanoticias").css("display","none");
	$("#capaeditarnoticias").css("display","none");
	$("#respuestanoticias").css("background","green").html(respuesta).fadeOut(6000);
	setInterval(function(){
	window.location.reload();
	},4000);
	}else{
	$("#carpanoticias").css("display","none");
	$("#capaeditarnoticias").css("display","none");
	$("#respuestanoticias").css("background","red").html(respuesta).fadeOut(6000);
	}
	}
	
	});
	
	}else if(datoseditados=="Cancelar"){
	
	$("#carpanoticias").css("display","none");
	$("#capaeditarnoticias").css("display","none");
	}
	
	});
