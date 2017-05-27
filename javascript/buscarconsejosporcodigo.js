 $(document).ready(function(){
            
            $(document).on('click',"#elegirconsejosporcodigo",function(){
            
            id=$(this).closest('tr').find(".idconsejos").text()
            
            $.ajax({
            type:"POST",
            url:"obtenerdatosdeconsejos.php",
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
