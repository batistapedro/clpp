<?php
session_start();
if(isset($_SESSION['tipo'])&&!empty($_SESSION['tipo'])){
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="../css/obtenerdatosdeconsejales.css">
</head>
<body>
<div id="mensajeconsejales"></div>
<button type="button" id="pdfconsejales" title="Generar PDF" class="btn btn-lg btn-danger">
	<span class="glyphicon glyphicon-cloud-download"></span> Generar Pdf
</button>
<?php
if($_SESSION['tipo']=="administrador"){
?>
<div id="todosconsejales"></div>
<div id="eliminarusuariosconsejales">
	<h3>
		Deseas Eliminar Datos de Concejales ?
	</h3>
	<button id="si" value="si" title="Aceptar" class="btn btn-success">
		<span class="glyphicon glyphicon-ok-sign"></span> Aceptar
	</button>
	<button  id="no" value="no" title="Cancelar" class="btn btn-danger">
		<span class="glyphicon glyphicon-remove-sign"></span> Cancelar
	</button>
</div>
<div id="mensajeconsejales"></div>
<div class="table-responsive">
<table class="tablaeditable table">
<caption><h2 class="text-center">Registro de Los Concejales</h2></caption>
	<tr>
		<thead>
		<th id="thid" class="hidden">Id</th>
		<th>Nombres</th>
		<th>Apellidos</th>
		<th>Cedulas</th>
		<th>Telefonos</th>
		<th>Claves</th>
		<th>Eliminar</th>
		</thead>
	</tr>

	<?php
	require("../php/conexion.php");
	$sqlver ="select * from usuarios where tipo='concejal'";
	$base = new Conexion();
	$base->conectar();
	$data = $base->extraer($sqlver);

	while($filas = $data->fetch_array()){
	?>
	<tr>
	<tbody>
	<td class="id hidden"><?php echo $filas['idusuario'];?></td>
	<td class="editable" data-campo="nombre"><span><?php echo $filas['nombre'];?></span></td>
	<td class="editable" data-campo="apellido"><span><?php echo $filas['apellido'];?></span></td>
	<td class="editable" data-campo="cedula"><span><?php echo $filas['cedula'];?></span></td>
	<td class="editable" data-campo="telefono"><span><?php echo $filas['telefono'];?></span></td>
	<td class="editable" data-campo="clave"><span><?php echo $filas['clave'];?></span></td>
	<td>
		<button type="button" class="btn btn-danger" title='Eliminar' id='eliminarconsejales'>
			Eliminar
		</button>
	</td>
	</tbody>
	</tr>
	<?php
	}
	$data->close();
	$base->cerrar();
	?>
	</table>
</div>
	<br><br>
	<?php
	}else if($_SESSION['tipo']=="operador"){
	?>
	<div class="table-responsive">
	<table class="tablaeditable table">
<caption><h2 class="text-center">Registro de Los Concejales</h2></caption>
	<tr>
	<thead>
		<th id="thid" class="hidden">Id</th>
		<th>Nombres</th>
		<th>Apellidos</th>
		<th>Cedulas</th>
		<th>Telefonos</th>
		<th>Clave</th>
	</thead>
	</tr>

	<?php
	require("../php/conexion.php");
	$sqlver ="select * from usuarios where tipo='concejal'";
	$base = new Conexion();
	$base->conectar();
	$data = $base->extraer($sqlver);

	while($filas = $data->fetch_array()){
	?>
	<tr>
	<tbody>
		<td class="id hidden"><?php echo $filas['idusuario'];?></td>
		<td class="editable" data-campo="nombre"><span><?php echo $filas['nombre'];?></span></td>
		<td class="editable" data-campo="apellido"><span><?php echo $filas['apellido'];?></span></td>
		<td class="editable" data-campo="cedula"><span><?php echo $filas['cedula'];?></span></td>
		<td class="editable" data-campo="telefono"><span><?php echo $filas['telefono'];?></span></td>
		<td class="editable" data-campo="clave"><span><?php echo $filas['clave'];?></span></td>
	</tbody>
	</tr>
	<?php
	}
	$data->close();
	$base->cerrar();
	?>
	</table>
</div>
	<br><br>

	<?php
	}else if($_SESSION['tipo']=="concejal"){
	?>
	<div class="table-responsive">
	<table class="tablaeditable table">
<caption><h2 class="text-center">Registro de Los Concejales</h2></caption>
	<tr>
		<thead>
		<th>Nombres</th>
		<th>Apellidos</th>
		<th>Cedulas</th>
		<th>Telefonos</th>
		</thead>
	</tr>

	<?php
	require("../php/conexion.php");
	$sqlver ="select nombre,apellido,cedula,telefono from usuarios where tipo='concejal'";
	$base = new Conexion();
	$base->conectar();
	$data = $base->extraer($sqlver);

	while($filas = $data->fetch_array()){
	?>
	<tr>
	<tbody>
		<td><?php echo $filas['nombre'];?></td>
		<td><?php echo $filas['apellido'];?></td>
		<td><?php echo $filas['cedula'];?></td>
		<td><?php echo $filas['telefono'];?></td>
		</tbody>
	</tr>
	<?php
	}
	$data->close();
	$base->cerrar();
	?>
	</table>
</div>
	<br><br>

	<?php
	}else{
	?>
	<script>
	window.location="../index.php";
	</script>

	<?php
	}
	?>
<script src="../javascript/obtenerdatosdeconsejales.js"></script>

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
