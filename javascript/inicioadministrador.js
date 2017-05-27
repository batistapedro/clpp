$(document).ready(function(){
$("#borrar").on({"click" : function(){
$("#noticia, #titulo, #imagenes").val("");
}, "mouseover" : function(){$("#borrar").attr("title","Limpiar");}
});

$("#bpublicar").on({"click" : function(){
 titulo= $("#titulo").val();
 imagenes= document.querySelector("#imagenes");
 imagen=imagenes.files[0];
 datos = $("#noticia").val();
 dato = new FormData();
 dato.append('titulo',titulo);
 dato.append('imagen',imagen);
 dato.append('datos',datos);
$.ajax({
type : "POST",
contentType:false,
url : "enviarnoticias.php",
data : dato,
processData:false,
cache:false,

beforeSend : function(){
$(".mensaje").css("display","block").html("<img src=../imagenes/loading.gif>");
},
success : function(respuesta){
if(respuesta=="<h3>datos agregados con exito</h3>"){
$(".mensaje").css("background-color","green").html(respuesta).fadeOut(6000);
$("#noticia, #titulo, #imagenes").val("");
setInterval(function(){
window.location.reload();
},4000);
}else{
$(".mensaje").css("background-color", "red").html(respuesta).fadeOut(6000);
}

}
});
$(".mensaje").fadeOut(4000);
}, "mouseover" : function(){$("#bpublicar").attr("title","Publicar");}
});
//comienzo del menu de navegacion

$("#inicio").click(function(e){
	e.preventDefault();
window.location.reload();
});


$("#salir").click(function(e){
	e.preventDefault();

	$("#mensajesalirdesession").css("display","block");
	$("#salirdesessiontodo").css("display","block");

	$("#no, #si").click(function(){
		var validar = $(this).val();
		if(validar=="si"){
			window.location="cerrraseccion.php";

		}else if(validar=="no"){
			$("#mensajesalirdesession").css("display","none");
			$("#salirdesessiontodo").css("display","none");
		}
	});
});

$("#datosmovimientos").load("obtener5ultimosmovimientos.php");
$("#datoscomunas").load("obtener5ultimascomunas.php");
$("#datosconsejos").load("obtener5ultimosconsejos.php");

$("#buscar").click(function(e){
	e.preventDefault();
$.ajax({
type:"get",
url:"buscar.php",
beforeSend: function(){
$("#contenido").html("<img src='../imagenes/loading.gif'>");
},
success:function(respuesta){
$("#contenido").html(respuesta);
}
});
});

$("#datoss").click(function(e){
	e.preventDefault();
 tipo = $("#gestionsocialtipo").val();
 id = $("#gestionsocialid").val();
$.ajax({
type:"post",
url:"gestionsocialdatos.php",
data:{tipo:tipo,id:id},
beforeSend: function(){
$("#contenido").html("<img src='../imagenes/loading.gif'>");
},
success:function(respuesta){
$("#contenido").html(respuesta);
}
});
});

$("#registrar").click(function(e){
e.preventDefault();
$.ajax({
type:"get",
url:"registrar.php",
beforeSend : function(){
$("#contenido").html("<img src='../imagenes/loading.gif'>");
},
success : function(respuesta){
$("#contenido").html(respuesta);
}

});
});

$("#configurar").click(function(e){
e.preventDefault();
$.ajax({
type:"get",
url:"configurar.php",
beforeSend:function(){
$("#contenido").html("<img src='../imagenes/loading.gif'>");
},
success: function(respuesta){
$("#contenido").html(respuesta);
}
});
});
//fin del menu de navegacion

$("#respaldarbase").click(function(e){
	e.preventDefault();

    window.location="respaldodebase.php";
});
});
