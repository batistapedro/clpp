  $(document).ready(function(){
            
            $(document).on('click',"#elegircomunaporcodigo",function(){
            
            id=$(this).closest('tr').find(".idcomuna").text()
            
            $.ajax({
            type:"POST",
            url:"obtenerdatosdecomunas.php",
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
