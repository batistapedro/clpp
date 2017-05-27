$(document).ready(function(){

$(document).on('click',"#notat",function(e){
   e.preventDefault();
   ver=$(this).attr("href");
   
   
 $.ajax({
 type:"post",
 url:"vernoticiasdentro.php",
 data:{ver:ver},
 beforeSend:function(){
 $("#section").html("<img src='../imagenes/loading.gif'>");
 },
 success:function(respuesta){
 $("#contenido").html(respuesta);
 }
 });

});

$(document).on("click",".editarnoticias",function(e){
	e.preventDefault();
	id = $(this).val();
	$.ajax({
	type:"post",
	url:"editarnoticias.php",
	data:{id:id},
	beforeSend: function(){
	$("#carpanoticias").css("display","block");
	$("#capaeditarnoticias").css("display","block").html("<img src='../imagenes/loading.gif'>");
	},
	success: function(respuesta){
	$("#capaeditarnoticias").html(respuesta);
	
	}
	});
	});	
	
	
	

$(document).on("click",".eliminarnoticias",function(){
	var id =$(this).val();
$("#carpanoticias").css("display","block");
$("#eliminanoticia").css("display","block");

$("#si , #no").click(function(){
	datos = $(this).val();
if(datos == 'no'){
$("#carpanoticias").css("display","none");
$("#eliminanoticia").css("display","none");
}else if(datos=='si'){  
     $("#carpanoticias").css("display","none");
     $("#eliminanoticia").css("display","none");
     $.ajax({
        type:"POST",
        url:"eliminarnoticias.php",
        data:{id:id},
        beforeSend: function(){
        $("#respuestanoticias").fadeIn(200).css("display","block").html("<img src='../imagenes/loading.gif'>");
        },
        success:function(respuesta){
        if(respuesta=="<h3>datos eliminado con exito</h3>"){
        $("#respuestanoticias").css("background-color","green").html(respuesta).fadeOut(6000);
        	setInterval(function(){
				window.location.reload();
				},4000);
        }else{
        $("#respuestanoticias").css("background-color","red").html(respuesta).fadeOut(6000);
            }
            }
     });
     
}
});
});



});
