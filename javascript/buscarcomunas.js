$(document).ready(function(){

$(document).on('click',"#elegircomuna",function(){
var id= $(this).closest("tr").find(".idcomuna").text();
$.ajax({
type:"POST",
url:"obtenerdatosdecomunas.php",
data:{id : id},
beforeSend:function(){
$("#contenido").html("<img src='../imagenes/loading.gif'>");
},
success: function(respuesta){
$("#contenido").html(respuesta);
}

});

});
$(document).on('click',"#pdfcomunaparroquia",function(){
var parroquia = $("#parroquias").val()
window.location="pdfcomunasporparriquia.php?parroquia="+parroquia;
});

});
