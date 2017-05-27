<?php
session_start();
if(isset($_SESSION['tipo']) && !empty($_SESSION['tipo'])){
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="../css/obtenerdatosdeoperador.css">
</head>
<body>
<div id="mensajeoperador"></div>
<?php if($_SESSION['tipo']=="administrador"){
?>
<div id="todosoperador"></div>
<div id="eliminarusuariooperador">
<h3>Deseas Eliminar Operador ?</h3>
<button type="button" value="si" id="si" title="Aceptar" class="btn btn-success">
	<span class="glyphicon glyphicon-ok-sign"></span> Aceptar
</button>
<button type="button" value="no" id="no" title="Cancelar" class="btn btn-danger">
	<span class="glyphicon glyphicon-remove-sign"></span> Cancelar
</button>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2 class="text-center">Datos de Operadores</h2></caption>
<tr>
	<thead>
	<th id="id" class="hidden">
	<th>Nombre del operador</th>
	<th>Clave</th>
	<th>Eliminar</th>
	</thead>
</tr>
<?php
require("../php/conexion.php");
$sql="select idusuario,nombre,clave from usuarios where tipo='operador'";
$base = new Conexion();
$base->conectar();
$datos = $base->extraer($sql);
while($fila = $datos->fetch_array()){
?>
<tr>
<td id="id" class="hidden"><?php echo $fila['idusuario'];?></td>
<td class="editable" data-campo="nombre"><span><?php echo $fila['nombre'];?></span></td>
<td class="editable" data-campo="clave"><span><?php echo $fila['clave'];?></span></td>
<td>
	<button type="button" id="eliminaroperador" title="Eliminar" class="btn btn-danger">Eliminar</button>
</td>
</tr>

<?php
}
$datos->close();
$base->cerrar();
?>
</table>
</div>
<br><br>
<?php
}else if($_SESSION['tipo']=="operador"){
require("../php/conexion.php");
?>
<div class="table-responsive">
<table class="table">
<caption><h2 class="text-center">Datos de Operadores</h2></caption>
<tr>
<thead>
<th>Nombre del operador</th>
</thead>
</tr>
<?php
$sql="select nombre from usuarios where tipo='operador'";
$base = new Conexion();
$base->conectar();
$datos = $base->extraer($sql);
while($fila = $datos->fetch_array()){
?>
<tr>
<tbody>
<td><?php echo $fila['nombre'];?></td>
</tbody>
</tr>

<?php
}
$datos->close();
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
<script src="../javascript/obtenerdatosdeoperador.js"></script>
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
