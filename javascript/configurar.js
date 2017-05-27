$(document).ready(function(){
  $("#editarnombre").on({ "click" : function(){
  $("#contrasena").fadeOut(300).css("display","none");
  $("#nombreuser").fadeIn(300).css("display","block");
  }, "mouseover" : function(){$("#editarnombre").attr("title","cambiar nombre");}
  });

  $("#editarclave").on({ "click" : function(){
  $("#nombreuser").fadeOut(300).css("display","none");
  $("#contrasena").fadeIn(300).css("display","block");
  }, "mouseover" : function(){$("#editarclave").attr("title","cambiar clave");}
  });

  $("#limpiarcontrasena").on({ "click" : function(){
  $("#actual, #nueva, #nueva1").val("");
  $("#nueva1").css({"background-color":"white","color":"black"});
   $("#nueva").css({"background-color":"white","color":"black"});
  $("#actual").css({"background-color":"white","color":"black"});
  }, "mouseover" : function(){$("#limpiarcontrasena").attr("title","limpiar");}
  });

  $("#contrasena").on( "submit", function(e){
      e.preventDefault();
  var clave = $("#actual").val();
  var nueva = $("#nueva").val();
  var nueva1 = $("#nueva1").val();
  var id = $("#iduser").val();
  var tipo = $("#tipo").val();
  $.ajax({
  type : "POST",
  url : "configurarclave.php",
  data : {clave:clave , nueva:nueva , nueva1:nueva1, id:id , tipo:tipo},
  beforeSend : function(){
  $("#mensajeconfiguracion").fadeIn(300).css("display","block").html("<img src='../imagenes/loading.gif'>");
  },
  success : function(respuesta){
  if(respuesta == "<h3>datos actualizado con exito</h3>"){
  $("#mensajeconfiguracion").css("background","green").html(respuesta).fadeOut(5000);
  $("#actual, #nueva, #nueva1").val("");
  $("#nueva1").css({"background-color":"white","color":"black"});
  $("#actual").css({"background-color":"white","color":"black"});
   $("#nueva").css({"background-color":"white","color":"black"});

  }else if(respuesta == "<h3>error la nueva clave no son iguales</h3>"){
    $("#mensajeconfiguracion").css("background","red").html(respuesta).fadeOut(5000);
    $("#nueva1").css({"background-color":"rgba(254,0,0,0.2)","color":"white"});
    $("#nueva").css({"background-color":"white","color":"black"});
    $("#actual").css({"background-color":"white","color":"black"});

  }else if(respuesta == "<h3>error clave actual invalida</h3>"){
  $("#mensajeconfiguracion").css("background","red").html(respuesta).fadeOut(5000);
  $("#actual").css({"background-color":"rgba(200,0,0,0.2)","color":"white"});
  $("#nueva1").css({"background-color":"white", "color":"black"});
  $("#nueva").css({"background-color":"white", "color":"black"});

  }else if(respuesta == "<h3>error clave debe ser igual o mayor a 6 digitos</h3>"){
     $("#mensajeconfiguracion").css("background","red").html(respuesta).fadeOut(5000);
     $("#nueva").css({"background-color":"rgba(254,0,0,0.2)","color":"white"});
     $("#nueva1").css({"background-color":"rgba(254,0,0,0.2)","color":"white"});
     $("#actual").css({"background-color":"white","color":"black"});

  }else if(respuesta == "<h3>error clave no puede ser mayor a 12 digitos</h3>"){
   $("#mensajeconfiguracion").css("background","red").html(respuesta).fadeOut(5000);
   $("#nueva").css({"background-color":"rgba(254,0,0,0.2)","color":"white"});
   $("#nueva1").css({"background-color":"rgba(254,0,0,0.2)","color":"white"});
   $("#actual").css({"background-color":"white","color":"black"});

  }else{
    $("#mensajeconfiguracion").css("background","red").html(respuesta).fadeOut(5000);
  }
  }
  });
  });

  $("#nombreuser").on("submit", function(e){
      e.preventDefault();
  var nombre = $("#nombreadmin").val();
  var clave = $("#contrasenanombre").val();
  var id = $("#idadmin").val();

  $.ajax({
  type : "POST",
  url : "configurarnombre.php",
  data : {nombre : nombre , clave : clave , id : id },
  beforeSend : function(){
  $("#mensajeconfiguracion").fadeIn(300).css("display","block").html("<img src='../imagenes/loading.gif'>");
  },
  success : function(respuesta){
  if(respuesta =="<h3>datos actualizado con exito</h3>" ){
    $("#nombreadmin").css({"background-color":"white","color":"black"});
    $("#contrasenanombre").css({"background-color":"white","color":"black"});
  $("#mensajeconfiguracion").fadeIn(300).css("background","green").html(respuesta).fadeOut(5000);
  $("#nombreadmin,#contrasenanombre").val('');
  setInterval(function(){
  window.location.reload();
  },5000);

  }else if(respuesta == "<h3>Error en nombre, nombre debe ser solo letras </h3>"){
    $("#nombreadmin").css({"background-color":"rgba(254,0,0,0.2)","color":"white"});
    $("#mensajeconfiguracion").fadeIn(300).css("background","red").html(respuesta).fadeOut(5000);
    $("#contrasenanombre").css({"background-color":"white","color":"black"});

  }else if(respuesta == "<h3>Error nombre debe ser mayor o igual 3 letras</h3>"){
    $("#mensajeconfiguracion").fadeIn(300).css("background","red").html(respuesta).fadeOut(5000);
     $("#nombreadmin").css({"background-color":"rgba(254,0,0,0.2)","color":"white"});
    $("#contrasenanombre").css({"background-color":"white","color":"black"});

  }else if (respuesta == "<h3>Error nombre no puede ser mayor a 15 letras</h3>"){
     $("#mensajeconfiguracion").fadeIn(300).css("background","red").html(respuesta).fadeOut(5000);
     $("#nombreadmin").css({"background-color":"rgba(254,0,0,0.2)","color":"white"});
     $("#contrasenanombre").css({"background-color":"white","color":"black"});


  }else if(respuesta == "<h3>Error Clave Invalida</h3>"){
    $("#contrasenanombre").css({"background-color":"rgba(254,0,0,0.2)","color":"white"});
    $("#nombreadmin").css({"background-color":"white","color":"black"});
    $("#mensajeconfiguracion").fadeIn(300).css("background","red").html(respuesta).fadeOut(5000);
  }else{
  $("#mensajeconfiguracion").fadeIn(300).css("background","red").html(respuesta).fadeOut(5000);
  }
  }
  });
  });

  });
