$(document).ready(function(){
		$(document).on('click',"#generarpdfconsejos",function(){
		var no = $("#idpdfconsejos").val();
		window.location="pdfobtenerdatosconsejos.php?ver="+no;
		});

		$(document).on('click',"#generarpdfcomunas",function(){
		var no=$("#idpdfcomunas").val();
		window.location="pdfobtenerdatosdecomunas.php?ver="+no;
		});
		
		$(document).on('click',"#generarpdfmovimientos",function(){
		var no=$("#idpdfmovimientos").val();
		window.location="pdfobtenerdatosdemovimientos.php?ver="+no;
		});

		$(document).on('click',"#elegirconsejos",function(){
		var id = $(this).closest('tr').find('#idconsejos').text();
		
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
		
		});
