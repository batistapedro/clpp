  $(document).ready(function(){

  $("#tipo").click(function(){
    if($("#tipo").val()=="administrador")
    {
      $("#nombre").attr("title","Digite su nombre")
      $("#nombre").attr("placeholder","Nombre")
    }
    else if($("#tipo").val()=="consejos")
    {
      $("#nombre").attr("title","Digite el Rif del consejo comunal")
      $("#nombre").attr("placeholder","Rif ejemplo: j-00000000-0")

    }
    else if($("#tipo").val()=="comunas")
    {
      $("#nombre").attr("title","Digite el Rif de la comuna")
      $("#nombre").attr("placeholder","Rif ejemplo: j-00000000-0")
    }
    else if($("#tipo").val()=="movimientos")
    {
      $("#nombre").attr("title","Digite el Rif del movimientos social")
      $("#nombre").attr("placeholder","Rif ejemplo: j-00000000-0")
    }
    else if($("#tipo").val()=="concejales")
    {
      $("#nombre").attr("title","Digite cedula")
      $("#nombre").attr("placeholder","Cedula ejemplo: v-00000000")
    }
  })

  $("#acceso").on("submit",function(e){
      e.preventDefault();
  nombre= $("#nombre").val();
  clave = $("#clave").val();
  tipo =  $("#tipo").val();
  codigo= $("#codigo").val()
  $.ajax({
  type:"POST",
  url:"administrador/validarusuario.php",
  data:{nombre : nombre, clave : clave , tipo : tipo, codigo : codigo},
  beforeSend:function(){
  $("#mensajedeusuario").fadeIn(300).css("display","block").html("<img  src='imagenes/loading.gif' id='imgno'>");
  },
  success:function(respuesta){
  $("#mensajedeusuario").html(respuesta).fadeOut(5000);
  }

  });
  });

  });
