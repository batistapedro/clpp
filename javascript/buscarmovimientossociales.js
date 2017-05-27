$(document).ready(function(){

$(document).on('click',"#elegirmovimientos",function(){
var id= $(this).closest("tr").find(".idmovi").text();
$.ajax({
type:"POST",
url:"obtenerdatosdemovimientos.php",
data:{id : id},
beforeSend:function(){
$("#contenido").html("<img src='../imagenes/loading.gif'>");
},
success: function(respuesta){
$("#contenido").html(respuesta);
}

});

});

$(document).on('click',"#pdfmovimientosparroquia",function(){
var parroquia = $("#parroquias").val()
window.location="pdfmovimientossocialesporparroquia.php?parroquia="+parroquia;
});

});
