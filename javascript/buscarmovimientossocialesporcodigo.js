$(document).ready(function(){
            
            $(document).on('click',"#elegirmovimientosporcodigo",function(){
            
            id=$(this).closest('tr').find(".idmovimientos").text()
            
            $.ajax({
            type:"POST",
            url:"obtenerdatosdemovimientos.php",
            data:{id:id},
            beforeSend: function(){
            $("#contenido").html("<img src='../imagenes/loading.gif'>");
            },
            success:function(respuesta){
            $("#contenido").html(respuesta);
            }
            
            });
            });
            
            });
