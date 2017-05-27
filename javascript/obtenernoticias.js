$(document).ready(function(){

$(document).on('click',"#notat",function(e){
   e.preventDefault();
   ver=$(this).attr("href");

 $.ajax({
 type:"post",
 url:"administrador/vernoticiasfuera.php",
 data:{ver:ver},
 beforeSend:function(){
 $("#section").html("<img src='imagenes/loading.gif'>");
 },
 success:function(respuesta){
 $("#section").html(respuesta);
 }
 });
});

});
