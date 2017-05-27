<?php
session_start();
if(isset($_SESSION['nombre']) && !empty($_SESSION['nombre']) && isset($_SESSION['id']) && !empty($_SESSION['id']) && isset($_SESSION['tipo']) && !empty($_SESSION['tipo'])){
?>

<!DOCTYPE html>
<html>
  <head>
  <title>Configuracion</title>
  <meta  charset="UTF-8"/>
  <link rel="stylesheet" type="text/css" href="../css/configurar.css">
  </head>
     <body>
     	<div id="contenedor">
     	<?php  if($_SESSION['tipo']=="administrador" || ($_SESSION['tipo']=="operador")){
     	 ?>
     	<table class="table">
               <caption><h2>Configurar Datos</h2></caption>
     	     <tr>
                    <td><p class="lead">Nombre</p></td>
                    <td><p class="lead"><?php echo $_SESSION['nombre']?></p></td>
                    <td>
     	              <button type="button" class="btn btn-success" id="editarnombre"><span class="glyphicon glyphicon-pencil"></span> Editar Nombre</button>
                    </td>
               </tr>
     	    <tr>
                    <td><p class="lead">Clave</p></td>
                    <td><p class="lead">***************</p></td>
                    <td><button type="button" class="btn btn-success"id="editarclave"><span class="glyphicon glyphicon-pencil"></span> Editar Clave</button>
     	         </td>
     	    </tr>
     	</table>
     	<?php
     	}else if($_SESSION['tipo']=="concejal" || $_SESSION['tipo']=="consejos" || $_SESSION['tipo']=="comunas" || $_SESSION['tipo']=="movimientos"){
     	?>
     	<table id="configurar1" class="table">
               <caption>
                    <h2>Configurar Datos</h2></caption>
     	    <tr>
                    <td ><p class="lead">Clave</p></td>
                    <td><p class="lead">**************</p></td>
                    <td id="icono"><button type="button" class="btn btn-success" id="editarclave"><span class="glyphicon glyphicon-pencil"></span> Editar Clave</button>
     	         </td>
     	    </tr>
     	</table>
     	<?php
     	}
     	?>
     	</div>
     	<div id = "mensajeconfiguracion"></div>
     	<form class="form" id="contrasena" role="form">
     	    <h2>Cambiar Clave</h2>
               <div class="form-group">

     	         <input class="form-control" type="password" name="actual" placeholder="Clave Actual" id="actual" required>
     	    </div>
               <div class="form-group">
                    <input class="form-control" type="password" name="nueva" placeholder="Nueva Clave" id="nueva" required>
     	    </div>
               <div class="form-group">
                    <input class="form-control" type="password" name="nueva1" placeholder="Confirmar Nueva Clave" id="nueva1" required>
     	    </div>
               <?php echo "<input type='hidden' value=".$_SESSION['id']." id='iduser'><input type='hidden' value=".$_SESSION['tipo']." id='tipo'>"; ?>
     	    <button type="submit" class="btn btn-success" title="Aceptar"><span class="glyphicon glyphicon-ok-sign"></span> Aceptar</button>
              <button type="reset" class="btn btn-danger" title="Limpiar" id="limpiarcontrasena"><span class="glyphicon glyphicon-remove-sign"></span> Limpiar</button>
     	</form>

     	<form class="form" id="nombreuser" role="form">
     	    <h2>Cambiar Nombre</h2>
               <div class="form-group">
     	         <input class="form-control" type="text" name="nombre" placeholder="Nuevo Nombre" id="nombreadmin" required>
     	    </div>
              <div class="form-group">
               <input class="form-control" type="password" name="clave" placeholder="Clave" id="contrasenanombre" required>
     	    </div>
          <?php echo "<input type='hidden' value=".$_SESSION['id']." id='idadmin'>";?>
     	    <button type="submit" class="btn btn-success" title="Aceptar"><span class="glyphicon glyphicon-ok-sign"></span> Aceptar</button>
               <button type="reset" class="btn btn-danger" title="Limpiar"><span class="glyphicon glyphicon-remove-sign"></span> Limpiar</button>
     	</form>
     </body>
     <script src="../javascript/configurar.js"></script>
</html>


<?php
}else{
?>
<script>
window.location="../index.php";
</script>
<?php
}

?>
