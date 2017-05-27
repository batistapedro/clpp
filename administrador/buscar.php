<?php session_start();
if(isset($_SESSION['nombre']) && isset($_SESSION['tipo'])&& isset($_SESSION['id'])){
?>
<!DOCTYPE HTML>
<html lang="es">
<head><title>Buscar</title>
<meta charset="UTF-8"/>
<link rel="stylesheet" type="text/css" href="../css/buscarcomunas.css">
<link rel="stylesheet" type="text/css" href="../css/buscarcomunasporcodigo.css">
<link rel="stylesheet" type="text/css" href="../css/buscarconsejos.css">
<link rel="stylesheet" type="text/css" href="../css/buscarconsejosporcodigo.css">
<link rel="stylesheet" type="text/css" href="../css/buscarmovimientossociales.css">
<link rel="stylesheet" type="text/css" href="../css/buscarmovimientossocialesporcodigo.css">
</head>
<body>
<?php
if($_SESSION['tipo']=="administrador" || ($_SESSION['tipo']=="operador")){
?>
<!--formulario de busqueda del administrado y operador-->
	<form class="form-vertical" id="formulariodebusqueda" role="form">
		<h2 class="text-center">Buscar Datos</h2>
		<div class="form-group input-group">
			<span class="input-group-addon glyphicon glyphicon-search"></span>
			<select class="form-control" name="iopcion" id="iopcion" required>
				<option value="">Elegir Busqueda</option>
				<option value="consejos">Consejo Comunales</option>
				<option value="comunas">Comunas</option>
				<option value="movimientos">Movimientos sociales</option>
				<option value="voceros">Voceros Electo por parroquia</option>
				<option value="consejales">Concejales</option>
				<option value="operador">Operador</option>
			</select>
		</div>
		<label for="iopcion1">Buscar por</label>
		<div class="form-group input-group">
			<span class="input-group-addon glyphicon glyphicon-search"></span>
			<select class="form-control" name="iopcion1" id="iopcion1" required>
				<option value="">Buscar Por</option>
			</select>
		</div>
		<div class="form-group" id="elegirparroquias">
			<label for="parroquia">Elija Parroquia</label>
			<select id="parroquias" class="form-control">
	  			<option value="">Elija Parroquia</option>
				<option value="marhuanta">Marhuanta</option>
				<option value="agua salada">Agua Salada</option>
			    <option value="sabanita">Sabanita</option>
			    <option value="catedral">Catedral</option>
			    <option value="vista hermosa">Vista Hermosa</option>
				<option value="jose antonio paez">Jose Antonio Paez</option>
				<option value="zea">Zea</option>
				<option value="orinoco">Orinoco</option>
				<option value="panapana">Panapana</option>
			</select>
			</div>
			<div class="form-group">
				<input class="form-control" type="text" id="codigo" placeholder="introduzca codigo">
			</div>
		<button type="submit" class="btn btn-lg btn-success" title="Buscar"><span class="glyphicon glyphicon-search"></span> Buscar</button>
		<button type="reset" class="btn btn-lg btn-danger" title="Limpiar"><span class="glyphicon glyphicon-remove-sign"></span> Limpiar</button>
	</form>


	<div class="alert alert-danger" role="alert" id="respuestagestionsocial"></div>
	<div id="idconsejal"></div>
	<div id="movimientos_sociales"></div>
	<?php
	}else if($_SESSION['tipo']=="concejal"){
	?>
<!--formulario de busqueda del concejal-->
	<form class="form-vertical" id="formulariodebusqueda" role="form">
	<h2>Buscar Datos</h2>
	<div class="form-group input-group">
		<span class="input-group-addon glyphicon glyphicon-search"></span>
		<select name="iopcion" id="iopcion" class="form-control" required>
			<option value="">Elejir Busqueda</option>
			<option value="consejos">Consejo Comunales</option>
			<option value="comunas">Comunas</option>
			<option value="movimientos">Movimientos sociales</option>
			<option value="voceros">Voceros Electo por parroquia</option>
			<option value="consejales">Concejales</option>
		</select>
	</div>
	<label>Buscar por</label>
	<div class="form-group input-group">
		<span class="input-group-addon glyphicon glyphicon-search"></span>
		<select name="iopcion1" id="iopcion1" class="form-control" required>

		</select>
	</div>
	<div class="form-group" id="elegirparroquias">
		<label for="parroquia">Elija Parroquia</label>
		<select id="parroquias" class="form-control">
	  		<option value=""></option>
	 		<option value="marhuanta">Marhuanta</option>
	 		<option value="agua salada">Agua Salada</option>
      		<option value="sabanita">Sabanita</option>
      		<option value="catedral">Catedral</option>
      		<option value="vista hermosa">Vista Hermosa</option>
	  		<option value="jose antonio paez">Jose Antonio Paez</option>
	  		<option value="zea">Zea</option>
	  		<option value="orinoco">Orinoco</option>
	  		<option value="panapana">Panapana</option>
		</select>
	</div>
	<div class="form-group">
	<input type="text" class="form-control" id="codigo" placeholder="introduzca codigo">
	</div>
	<button type="submit" class="btn btn-lg btn-success" title="Buscar"><span class="glyphicon glyphicon-search"></span> Buscar</button>
	<button type="reset" class="btn btn-lg btn-danger"  title="Limpiar"><span class="glyphicon glyphicon-remove-sign"></span> Limpiar</button>
	</form>

	<div class="alert alert-danger" role="alert" id="respuestagestionsocial"></div>
	<div id="idconsejal"></div>
	<div id="movimientos_sociales"></div>

	<?php
}

   ?>
<!-- llamando al erchivo javascript-->
	<script src="../javascript/buscar.js"></script>
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
