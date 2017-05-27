<?php session_start();
if(isset($_SESSION['nombre']) && isset($_SESSION['tipo'])&& isset($_SESSION['id'])){
?>
<!DOCTYPE html>

<html lang="es">
<head><title>Inicio</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link rel="icon" href="../imagenes/logo2.ico" />
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../css/inicioadministrador.css">
<link rel="stylesheet" type="text/css" href="../css/buscar.css">
</head>
<body>
<!--
contenedor-->
<div class="container-fluid master" style="margin:0px; padding:0px;">
	<div class="nav navbar-fixed-top">
		<div id="usuario"><?php echo $_SESSION['tipo']." : <span class='glyphicon glyphicon-user'></span> : ".$_SESSION['nombre']?></div>

	</div>
<div id="mensaje-respaldo"></div>
<div id="salirdesessiontodo"></div>
<div id="mensajesalirdesession">
	<h3>Desea Salir del sistema ?</h3>
		<button id="si" type="button" value="si" class="btn btn-success"><span class="glyphicon glyphicon-ok-sign"></span> Aceptar</button>
		<button id="no" type="button" value="no" class="btn btn-danger"><span class="glyphicon glyphicon-remove-sign"></span> Cancelar</button>
</div>
<!--class row-->
<div class="row-fluid master" style="margin:0px;padding:0px;">
<!-- -->
<?php
if($_SESSION['tipo']=="administrador"){
?>
<div class="col-lg-12">
<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-top:30px;">

<div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menub">
        <span class="sr-only"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
			<div class="navbar-brand"><p style="color:black; font-weght:bold; font-size:1.2em;">CLPP</p></div>
    </div>

    <div class="collapse navbar-collapse" id="menub">

    <ul class="nav nav-pills nav-justified">
		<li>
			<a class="btn btn-lg" href="#" id="inicio" title="Inicio"><span class="glyphicon glyphicon-home"></span> Inicio</a>
		</li>
		<li>
			<a class="btn btn-lg" href="#" id="buscar" title="Buscar"><span class="glyphicon glyphicon-search"></span> Buscar</a>
		</li>
		<li>
			<a class="btn btn-lg" href="#" id="registrar" title="Registrar"><span class="glyphicon glyphicon-pencil"></span> Registrar</a>
		</li>
		<li>
			<a class="btn btn-lg" href="#" id="configurar" title="Configurar"><span class="glyphicon glyphicon-wrench"></span> Configurar</a>
		</li>
		<li>
			<a class="btn btn-lg" href="#" id="respaldarbase" title="Respaldar Base De Datos"><span class="glyphicon glyphicon-cloud-download"></span> Respaldar</a>
		</li>
		<li>
			<a class="btn btn-lg" href="../manuales de usuarios/Manual de Usuario Admistrador CLPP.pdf" title="Manual de Usuario"><span class="glyphicon glyphicon-book"></span> Manual</a>
		</li>
		<li>
			<a class="btn btn-lg" href="#" id="salir" title="Salir"><span class="glyphicon glyphicon-log-out"></span> Salir</a>
		</li>
	</ul>
	</div>
</nav>
</div>
<?php
}else

if($_SESSION['tipo']=="operador"){
?>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-top:30px;">

<div navbar-header>
	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menub">
		<span class="sr-only"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	</button>
</div>

    <div class="collapse navbar-collapse" id="menub">

    <ul class="nav nav-pills nav-justified">
		<li>
			<a class="btn btn-lg" href="#" id="inicio" title="Inicio"><span class="glyphicon glyphicon-home"></span> Inicio</a>
		</li>
		<li>
			<a class="btn btn-lg" href="#" id="buscar" title="Buscar"><span class="glyphicon glyphicon-search"></span> Buscar</a>
		</li>
		<li>
			<a class="btn btn-lg" href="#" id="registrar" title="Registrar"><span class="glyphicon glyphicon-pencil"></span> Registrar</a>
		</li>
		<li>
			<a class="btn btn-lg" href="#" id="configurar" title="Configurar"><span class="glyphicon glyphicon-wrench"></span> Configurar</a>
		</li>
		<li>
			<a class="btn btn-lg" href="../manuales de usuarios/manual de usuario del operador del clpp.pdf"  title="Manual de Usuario"><span class="glyphicon glyphicon-book"></span> Manual</a>
		</li>
		<li>
			<a class="btn btn-lg" href="#" id="salir" title="Salir"><span class="glyphicon glyphicon-log-out"></span> Salir</a>
		</li>
	</ul>
	</div>
</nav>
</div>
<?php
}else
if($_SESSION['tipo']=="concejal"){
?>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-top:30px;">

<div navbar-header>
	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menub">
		<span class="sr-only"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	</button>
	<div class="navbar-brand"><p style="color:black; font-size:1em;">CLPP</p></div>
</div>

    <div class="collapse navbar-collapse" id="menub" >

    <ul class="nav nav-pills nav-justified">
		<li>
			<a class="btn btn-lg" href="#" id="inicio" title="Inicio"><span class="glyphicon glyphicon-home"></span> Inicio</a>
		</li>
		<li>
			<a class="btn btn-lg" href="#" id="buscar" title="Buscar"><span class="glyphicon glyphicon-search"></span> Buscar</a>
		</li>
		<li>
			<a class="btn btn-lg" href="#" id="configurar" title="Configurar"><span class="glyphicon glyphicon-wrench"></span> Configurar</a>
		</li>
		<li>
			<a class="btn btn-lg" href="../manuales de usuarios/Manual de Usuario de Consejales CLPP.pdf"  title="Manual de Usuario"><span class="glyphicon glyphicon-book"></span> Manual</a>
		</li>
		<li>
			<a class="btn btn-lg" href="#" id="salir" title="Salir"><span class="glyphicon glyphicon-log-out"></span> Salir</a>
		</li>
	</ul>
	</div>
</nav>
</div>
<?php
}else
if($_SESSION['tipo']=="consejos"){
?>
<div class="col-lg-12" style="background-color:#e7e7e7; padding:0px; margin:0px;">
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-top:30px;">
		<div navbar-header>
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menub">
				<span class="sr-only"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>

		</div>
		<div class="collapse navbar-collapse" id="menub" >
		<ul class="nav nav-pills nav-justified">
			<li>
				<a class="btn btn-lg" href="#" id="inicio" title="Inicio"><span class="glyphicon glyphicon-home"></span> inicio</a>
			</li>
			<li>
				<a class="btn btn-lg" href="#" id="datoss" title="Ver Datos"><span class="glyphicon glyphicon-eye-open"></span> Ver Datos</a>
			</li>
			<li>
				<a class="btn btn-lg" href="#" id="configurar" title="Configurar"><span class="glyphicon glyphicon-wrench"></span> Configurar</a>
			</li>
			<li>
				<a class="btn btn-lg" href="../manuales de usuarios/Manuales de usuarios de los consejos comunales.pdf" title="Manual de Usuario"><span class="glyphicon glyphicon-book"></span> Manual</a>
			</li>
			<li>
				<a class="btn btn-lg" href="#" id="salir" title="salir"><span class="glyphicon glyphicon-log-out"></span> Salir</a>
			</li>
		</ul>
		</div>
	</nav>
</div>
<input type="hidden" id="gestionsocialtipo" value="<?php echo $_SESSION['tipo'];?>">
<input type="hidden" id="gestionsocialid" value="<?php echo $_SESSION['id']?>">
<?php
}else if($_SESSION['tipo']=="comunas"){
?>
<div class="col-lg-12" style="background-color:#e7e7e7; padding:0px; margin:0px;">
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-top:30px;">
		<div navbar-header>
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menub">
				<span class="sr-only"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>

		</div>
		<div class="collapse navbar-collapse" id="menub" >
		<ul class="nav nav-pills nav-justified">
			<li>
				<a class="btn btn-lg" href="#" id="inicio" title="Inicio"><span class="glyphicon glyphicon-home"></span> inicio</a>
			</li>
			<li>
				<a class="btn btn-lg" href="#" id="datoss" title="Ver Datos"><span class="glyphicon glyphicon-eye-open"></span> Ver Datos</a>
			</li>
			<li>
				<a class="btn btn-lg" href="#" id="configurar" title="Configurar"><span class="glyphicon glyphicon-wrench"></span> Configurar</a>
			</li>
			<li>
				<a class="btn btn-lg" href="../manuales de usuarios/Manual de usuario de las comunas socialista.pdf "  title="Manual de Usuario"><span class="glyphicon glyphicon-book"></span> Manual</a>
			</li>
			<li>
				<a class="btn btn-lg" href="#" id="salir" title="salir"><span class="glyphicon glyphicon-log-out"></span> Salir</a>
			</li>
		</ul>
		</div>
	</nav>
</div>
<input type="hidden" id="gestionsocialtipo" value="<?php echo $_SESSION['tipo'];?>">
<input type="hidden" id="gestionsocialid" value="<?php echo $_SESSION['id']?>">
<?php
}else if($_SESSION['tipo']=="movimientos"){
?>
<div class="col-lg-12" style="background-color:#e7e7e7; padding:0px; margin:0px;">
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-top:30px;">
		<div navbar-header>
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menub">
				<span class="sr-only"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>

		</div>
		<div class="collapse navbar-collapse" id="menub" >
		<ul class="nav nav-pills nav-justified">
			<li>
				<a class="btn btn-lg" href="#" id="inicio" title="Inicio"><span class="glyphicon glyphicon-home"></span> inicio</a>
			</li>
			<li>
				<a class="btn btn-lg" href="#" id="datoss" title="Ver Datos"><span class="glyphicon glyphicon-eye-open"></span> Ver Datos</a>
			</li>
			<li>
				<a class="btn btn-lg" href="#" id="configurar" title="Configurar"><span class="glyphicon glyphicon-wrench"></span> Configurar</a>
			</li>
			<li>
				<a class="btn btn-lg" href="../manuales de usuarios/Manual de usuario de los movimientos sociales.pdf"  title="Manual de Usuario"><span class="glyphicon glyphicon-book"></span> Manual</a>
			</li>
			<li>
				<a class="btn btn-lg" href="#" id="salir" title="salir"><span class="glyphicon glyphicon-log-out"></span> Salir</a>
			</li>
		</ul>
		</div>
	</nav>
</div>
<input type="hidden" id="gestionsocialtipo" value="<?php echo $_SESSION['tipo'];?>">
<input type="hidden" id="gestionsocialid" value="<?php echo $_SESSION['id']?>">
<?php
}
?>
<!--
inicio del contenido
-->
<div class="col-sm-9 col-md-9 col-lg-9" style="padding:5px;">
<div id="contenido">
<?php
if($_SESSION['tipo']=="administrador" || ($_SESSION['tipo']=="operador")){
?>
<div class="mensaje"></div>
<form id="publicar" role="form">
	<h2>Publicar Noticias </h2>
	<div class="form-group">
		<input type="text" class="form-control" name="titulo" maxlength="87" id="titulo" placeholder="Digite Titulo...">
	</div>
	<div class="form-group">
		<input type="file" name="imagenes" id="imagenes">
	</div>
	<div class="form-group">
		<textarea class="form-control" rows="5" id="noticia" maxlength="3000"  placeholder="Digiste Las Noticias aqui...."></textarea>
	</div>
	<button type="button" class="btn btn-success btn-lg" id="bpublicar"><span class="glyphicon glyphicon-ok-sign"></span> Publicar</button>
	<button type="button" class="btn btn-danger btn-lg" id="borrar"><span class="glyphicon glyphicon-remove-sign"></span> Limpiar</button>

</form>
<?php
}
?>
<div class="row">
<div class="col-lg-12">
<div id="noticias"></div>
</div>
</div>
</div>
</div>
<!--
fin del contenido
-->
<!--
inicio de los datos
-->
<div class="col-sm-3 col-md-3 col-lg-3" style="margin:0px; padding:0px; background-color:white">
<div id="dato">
<?php
if($_SESSION['tipo']=="administrador" || ($_SESSION['tipo']=="operador" || $_SESSION['tipo']=="concejal")){
?>
<div id="consejos"><div class="consejos">Consejos Comunales</div>
<div id="datosconsejos"></div>
</div>
<div id="comunas"><div class="comunas">Comunas</div>
<div id="datoscomunas"></div>
</div>
<div id="movimientos"><div class="movimientos">Movimientos Sociales</div>
<div id="datosmovimientos"></div>
</div>
<?php
}else if($_SESSION['tipo']=="consejos"|| ($_SESSION['tipo']=="comunas" || ($_SESSION['tipo']=="movimientos"))){
?>
<div id="consejos"><div class="consejos">Consejos Comunales</div>
<div id="datosconsejos"></div>
</div>
<div id="comunas"><div class="comunas">Comunas</div>
<div id="datoscomunas"></div>
</div>
<div id="movimientos"><div class="movimientos">Movimientos Sociales</div>
<div id="datosmovimientos"></div>
</div>

<?php
}
?>
</div>
</div>
<!--
fin de los datos
-->

<!---->
</div>
<!--fin del row-->
<!-- fin de el contenedor-->
</div>
<!---->
<script type="text/javascript" src="../jquery/jquery.js"></script>
<script type="text/javascript" src="../javascript/inicioadministrador.js"></script>
<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
<script>

$(document).ready(cargarnoticias(0));
  function cargarnoticias(limite){
  var url="obtenernoticiasdentro.php";
  $.post(url,{limite:limite},function(responseText){
  $("#noticias").html(responseText);
  });
  }

</script>
</body>

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
