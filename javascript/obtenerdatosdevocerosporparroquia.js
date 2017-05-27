$(document).ready(function(){
		
		$(document).on("click","#eliminarvocero",function(){
		 ver = $(this).closest("tr").find("#id").text();
		 tr = $(this).closest("tr");
		 
		 $("#todosvoceros").fadeIn(300).css("display","block");
		 $("#eliminarusuariosvocerosparroquia").fadeIn(300).css("display","block");
		 
		 $("#si, #no").click(function(){
		datos = $(this).val();
		if(datos=="si"){
		$("#todosvoceros").css("display","none").fadeOut(100);
		$("#eliminarusuariosvocerosparroquia").css("display","none").fadeOut(100);
		$.ajax({
		type: "POST",
		url: "eliminarvoceroporparroquia.php",
		data:{ver:ver},
		beforeSend: function(){
		$("#mensajevocero").fadeIn(300).css("display","block").html("<img src='../imagenes/loading.gif'>");
		},
		success: function(respuesta){
		if(respuesta=="<h3>datos eliminado con exito</h3>"){
		$("#mensajevocero").css("background","green").html(respuesta).fadeOut(6000);
		tr.fadeOut(300).html("");
		}else{
		$("#mensajevocero").css("background","red").html(respuesta).fadeOut(6000);
		}
		}
		});
		}else if(datos=="no"){
		$("#todosvoceros").css("display","none").fadeOut(100);
		$("#eliminarusuariosvocerosparroquia").css("display","none").fadeOut(100);
		}
		});
		});
		$(document).on("click","#elegirgestion",function(){
		 id = $(this).closest("tr").find("#idgestion").text();
		 tipo = $(this).closest("tr").find("#tipo1").text();
		if(tipo=="consejo"){
		$.ajax({
		type:"POST",
		url:"obtenerdatosdeconsejos.php",
		data:{id : id},
		beforeSend: function(){
		$("#contenido").html("<img src='../imagenes/loading.gif'>");
		},
		success: function(respuesta){
		$("#contenido").html(respuesta);
		}
		});
		
		}else if(tipo=="movimiento"){
		$.ajax({
		type:"post",
		url:"obtenerdatosdemovimientos.php",
		data:{id:id},
		beforeSend: function(){
		$("#contenido").html("<img src='../imagenes/loading.gif'>");
		},
		success: function(respuesta){
		$("#contenido").html(respuesta);
		}
		
		});
		}
		});
		
		$(document).on('click',"#generarpdfvocerosparrquia",function(){
		window.location="pdfobtenerdatosdevocerosporparroquia.php";
		});
});
