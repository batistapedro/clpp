$(document).ready(function(){
$("#iopcion").on("click",function(e)
{
	e.preventDefault();
 opcion = $(this).val();
	if(opcion=="consejales" || (opcion=="operador" ||(opcion=="voceros" || (opcion==""))))
	{
		$("#iopcion1").html("<option value='todos'>Todos</option>");
		$("#elegirparroquias").css("display","none");
		$("#codigo").css("display","none");
		$("#movimientos_sociales").css("display","none");

	}
	else
	{
		$("#iopcion1").html("<option value=''></option><option value='parroquia'>Parroquia</option><option value='codigo'>Codigo</option><option value='rif'>Rif</option>");
		//$("#elegirparroquias").fadeIn(300).css("display","block");
		//$("#idconsejal").css("display", "none");
	}
});

$("#iopcion1").on("click",function(e)
{
	e.preventDefault();
	busqueda = $(this).val();
	if(busqueda=="parroquia")
	{
		$("#elegirparroquias").fadeIn(300).css("display","block");
		$("#codigo").css("display","none");
	}
	else if(busqueda=="codigo")
	{
		$("#elegirparroquias").css("display","none");
		$("#codigo").attr("placeholder"," introduszca codigo");
		$("#codigo").attr("title","introduzca Codigo");
		$("#codigo").fadeIn(300).css("display","block");
	}
	else if(busqueda=="rif")
	{
		$("#elegirparroquias").css("display","none");
		$("#codigo").attr("placeholder"," introduszca Rif ejemplo: j-00000000-0");
		$("#codigo").attr("title","introduzca Rif");
		$("#codigo").fadeIn(300).css("display","block");
	}

});


$("#formulariodebusqueda").on("submit", function(e)
{
	e.preventDefault();
	opcion = $("#iopcion").val();
	if(opcion =="consejales")
	{
		$.ajax({
					type:"get",
					url:"obtenerdatosdeconsejales.php",
					beforeSend: function()
					{
						$("#contenido").html("<img src='../imagenes/loading.gif'>");
					},
					success:function(respuesta)
					{
						$("#contenido").html(respuesta);
					}
			 	 });

	}
	else if(opcion =="movimientos")
	{
 		parroquia = $("#parroquias").val();
    	if($("#iopcion1").val()=="parroquia")
    	{
			if(parroquia.trim()!="")
			{
				$.ajax({
							type : "POST",
							url : "buscarmovimientossociales.php",
							data : { parroquia : parroquia },
							beforeSend:function()
							{
								$("#movimientos_sociales").html("<img src='../imagenes/loading.gif'>");
							},
							success:function(respuesta)
							{
								$("#movimientos_sociales").css("display","block").html(respuesta);
							}
						});

			}
			else
			{
				$("#movimientos_sociales").fadeIn(300).html("<h3>error debes elegir una parroquia</h3>").fadeOut(4000);
			}
		}
		else if($("#iopcion1").val()=="codigo")
		{
			codigomovimientos = $("#codigo").val();
			if(codigomovimientos.trim()!="")
			{
				$.ajax({
							type:"POST",
							url:"buscarmovimientossocialesporcodigo.php",
							data: {codigomovimientos: codigomovimientos},
							beforeSend: function()
							{
								$("#movimientos_sociales").html("<img src='../imagenes/loading.gif'>");

							},
							success: function(respuesta)
							{
								$("#movimientos_sociales").css("display","block").html(respuesta);

							}
						});

			}
			else
			{
				$("#movimientos_sociales").fadeIn(300).html("<h3>error debes digitar el codigo del movimiento social</h3>").fadeOut(4000);
			}

		}
		else if($("#iopcion1").val()=="rif")
		{
			rifmovimientos = $("#codigo").val();
			if(rifmovimientos.trim()!="")
			{
				$.ajax({
							type:"post",
							url:"buscarmovimientossocialesporrif.php",
							data :{rifmovimientos:rifmovimientos},
							beforeSend: function()
							{
								$("#movimientos_sociales").html("<img src='../imagenes/loading.gif'>");
							},
							success: function(respuesta)
							{
								$("#movimientos_sociales").css("display","block").html(respuesta);
							}

						});
			}
			else
			{
				$("#movimientos_sociales").fadeIn(300).html("<h3>error debes digitar el rif del movimiento social</h3>").fadeOut(4000);
			}
		}
	}
	else if(opcion=="comunas")
	{
 		parroquia = $("#parroquias").val();
    	if($("#iopcion1").val()=="parroquia")
    	{
			if(parroquia.trim()!="")
			{
				$.ajax({
							type :"POST",
							url :"buscarcomunas.php",
							data : {parroquia:parroquia},
							beforeSend : function()
							{
								$("#movimientos_sociales").html("<img src='../imagenes/loading.gif'>");
							},
							success : function(respuesta)
							{
								$("#movimientos_sociales").css("display","block").html(respuesta);
							}
						});

			}
			else
			{
				$("#movimientos_sociales").fadeIn(300).html("<h3>error debes elegir una parroquia</h3>").fadeOut(4000);
			}
		}
		else if($("#iopcion1").val()=="codigo")
		{
			codigocomuna = $("#codigo").val();
			if(codigocomuna.trim()!="")
			{
				$.ajax({
							type:"POST",
							url:"buscarcomunasporcodigo.php",
							data: {codigocomuna:codigocomuna},
							beforeSend: function()
							{
								$("#movimientos_sociales").html("<img src='../imagenes/loading.gif'>");
							},
							success: function(respuesta)
							{
								$("#movimientos_sociales").css("display","block").html(respuesta);
							}
						});
			}
			else
			{
				$("#movimientos_sociales").fadeIn(300).html("<h3>error debes digitar el codigo de la comunas</h3>").fadeOut(4000);
			}
		}
		else if($("#iopcion1").val()=="rif")
		{
			rifcomuna = $("#codigo").val();
			if(rifcomuna.trim()!="")
			{
				$.ajax({
						type:"post",
						url:"buscarcomunasporrif.php",
						data:{rifcomuna:rifcomuna},
						beforeSend : function()
						{
							$("#movimientos_sociales").html("<img src='../imagenes/loading.gif'>");
						},
						success: function(respuesta)
						{
							$("#movimientos_sociales").css("display","block").html(respuesta);
						}
				});
			}
			else
			{
				$("#movimientos_sociales").fadeIn(300).html("<h3>error debes digitar el rif de la comunas</h3>").fadeOut(4000);
			}
		}
	}
	else if(opcion=="consejos")
	{
 		parroquia =$("#parroquias").val();
    	if($("#iopcion1").val()=="parroquia")
    	{
			if(parroquia.trim()!="")
			{
				$.ajax({
							type:"post",
							url:"buscarconsejos.php",
							data:{parroquia:parroquia},
							beforeSend: function()
							{
								$("#movimientos_sociales").html("<img src='../imagenes/loading.gif'>");
							},
							success: function(respuesta)
							{
								$("#movimientos_sociales").css("display","block").html(respuesta);
							}
						});

			}
			else
			{
				$("#movimientos_sociales").fadeIn(300).html("<h3>error debes elegir una parroquia</h3>").fadeOut(4000);
			}
		}
		else if($("#iopcion1").val()=="codigo")
		{

			codigoconsejos = $("#codigo").val();
			if(codigoconsejos.trim()!="")
			{
				$.ajax({
							type:"POST",
							url:"buscarconsejosporcodigo.php",
							data:{codigoconsejos:codigoconsejos},
							beforeSend:function()
							{
								$("#movimientos_sociales").html("<img src='../imagenes/loading.gif'>");
							},
							success:function(respuesta)
							{
								$("#movimientos_sociales").css("display","block").html(respuesta);
							}
						});
			}
			else
			{
				$("#movimientos_sociales").fadeIn(300).html("<h3>error debes digitar el codigo del consejo comunal</h3>").fadeOut(4000);
			}
		}
		else if($("#iopcion1").val()=="rif")
		{
			rifconsejo = $("#codigo").val();
			if(rifconsejo.trim()!="")
			{
				$.ajax({
							type:"post",
							url:"buscarconsejosporrif.php",
							data:{rifconsejo:rifconsejo},
							beforeSend: function()
							{
								$("#movimientos_sociales").html("<img src='../imagenes/loading.gif'>");
							},
							success: function(respuesta)
							{
								$("#movimientos_sociales").css("display","block").html(respuesta);
							}
						})
			}
			else
			{
				$("#movimientos_sociales").fadeIn(300).html("<h3>error debes digitar el rif del consejo comunal</h3>").fadeOut(4000);
			}
		}
	}
	else if(opcion=="operador")
	{
		$.ajax({
					type:"get",
					url:"obtenerdatosdeoperador.php",
					beforeSend: function()
					{
						$("#contenido").html("<img src='../imagenes/loading.gif'>");
					},
					success:function(respuesta)
					{
						$("#contenido").html(respuesta);
					}
				});
	}
	else if(opcion=="voceros")
	{
		$.ajax({
					type:"get",
					url:"obtenerdatosdevocerosporparroquia.php",
					beforeSend: function()
					{
						$("#contenido").html("<img src='../imagenes/loading.gif'>");
					},
					success:function(respuesta)
					{
						$("#contenido").html(respuesta);
					}
				});
	}
	else
	{

	}

});


});
