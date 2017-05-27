<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<style type="text/css">
#loginn{
width:220px;
height:50px;
}
#acceso{
max-width: 70%;
margin: auto;
background-color: #e7e7e7;
padding:0px 5px 0px 5px;
border-radius: 7px;
box-shadow: 0px 0px 12px rgba(0,0,0,0.9);
}
#mensajedeusuario{
  display: none;
}
</style>

</head>
<body>
  <div class="alert alert-danger" role="alert" id="mensajedeusuario"></div>
  <form class="form" id="acceso" role="form">
  	<h3 class="text-danger">Ingresar Al Sistema</h3>
    <div class="form-group input-group">
    <span class="input-group-addon" title="tipo de usuarios"><img src="imagenes/users.png" width="20px" height="15px"></span>
  		<select class="form-control" id="tipo" title="Eliga tipo de Usuario" required>
  		  <option value=""> Tipo de Usuario</option>
  		  <option value="consejos">Consejos Comunales</option>
  		  <option value="comunas">Comunas</option>
  		  <option value="movimientos">Movimientos Sociales</option>
  		  <option value="concejales">Concejales</option>
  		  <option value="administrador">Administrador</option>
  		</select>
    </div>
    <div class="form-group input-group">
      <span class="input-group-addon glyphicon glyphicon-user"></span>
  		<input class="form-control" type="text" name="nombre" placeholder="Nombre"  title="Introduzca Nombre" id="nombre" required>
  	</div>
    <div class="form-group input-group">
      <span class="input-group-addon glyphicon glyphicon-lock"></span>
      <input class="form-control" type="password" name="clave" placeholder="Clave"  title="Introduzca Clave" id="clave" required>
  	</div>
    <div class="form-group">
      <img src="administrador/capchapt.php" id="loginn" class="img img-responsive center-block">
    </div>
    <div class="form-group input-group">
      <span class="input-group-addon glyphicon glyphicon-search"></span>
		  <input class="form-control" type="text" id="codigo" name="codigo" placeholder="datos de la imagen" title="digite datos de la imagen" required>
  	</div>
    <div class="form-group">
      <button class="btn btn-success" type="submit" title="enviar"><span class="glyphicon glyphicon-ok-sign"></span> Enviar</button>
      <button class="btn btn-danger" type="reset"  title="limpiar"><span class="glyphicon glyphicon-remove-sign"></span> Limpiar</button>
    </div>
  </form>
<script src="javascript/login.js"></script>
</body>
</html>
