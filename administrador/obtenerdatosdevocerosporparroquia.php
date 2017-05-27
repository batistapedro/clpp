<?php
session_start();
if(isset($_SESSION['tipo']) && !empty($_SESSION['tipo'])){
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="../css/obtenerdatosdevocerosporparroquia.css">
</head>
<body>
<div id="mensajevocero"></div>
<?php if($_SESSION['tipo']=="administrador"){
?>
<button type="button" id="generarpdfvocerosparrquia"title="Generar PDF" class="btn btn-lg btn-danger">
	<span class="glyphicon glyphicon-cloud-download"></span> Generar Pdf
</button>
<div id="todosvoceros"></div>
<div id="eliminarusuariosvocerosparroquia">
<h3>Deseas Eliminar Datos de Voceros ?</h3>
<button type="button" class="btn btn-success" value="si" id="si" title="Aceptar">
	<span class="glyphicon glyphicon-ok-sign"></span> Aceptar
</button>
<button type="button" class="btn btn-danger" value="no" id="no" title="Cancelar">
	<span class="glyphicon glyphicon-remove-sign"></span> Cancelar
</button>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2 class="text-center">Voceros De Los Consejos Comunales Electos Por Parroquia</h2></caption>
<tr>
<thead>
<th id="id" class="hidden"></th>
<th id="tipo1" class="hidden"></th>
<th id="idgestion" class="hidden"></th>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Parroquia</th>
<th>Nombre de Gestion Social</th>
<th>Elegir</th>
<th>Eliminar</th>
</thead>
</tr>
<?php
require("../php/conexion.php");
$sql="select i.nombre,i.apellido,i.cedula,gs.parroquia,gs.nombre_gestion,vp.idvoceros,gs.idgestion_social,gs.tipo_gestion from integrantes_gestion i inner join voceros_parroquia vp on i.idintegrantes_gestion=vp.idintegrantes_gestion inner join cargo_integrantes_gestion cig on cig.idintegrantes_gestion=vp.idintegrantes_gestion inner join gestion_social gs on gs.idgestion_social=cig.idgestion_social where vp.consejo=1 and gs.tipo_gestion='consejo'";
$base = new Conexion();
$base->conectar();
$datos = $base->extraer($sql);
while($fila = $datos->fetch_array()){
?>
<tr>
<tbody>
<td id="id" class="hidden"><?php echo $fila['idvoceros'];?></td>
<td id="tipo1" class="hidden"><?php echo $fila['tipo_gestion']?></td>
<td id="idgestion" class="hidden"><?php echo $fila['idgestion_social'];?></td>
<td><?php echo $fila['nombre'];?></td>
<td><?php echo $fila['apellido'];?></td>
<td><?php echo $fila['cedula'];?></td>
<td><?php echo $fila['parroquia'];?></td>
<td><?php echo $fila['nombre_gestion'];?></td>
<td><button type="button" class="btn btn-success" id="elegirgestion" title="Elegir gestion social">
	<span class="glyphicon glyphicon-ok-sign"></span>
</button></td>
<td style="text-align:left; vertical-align:middle;"><button type="button" class="btn btn-danger"id="eliminarvocero" title="Eliminar">
	<span class="glyphicon glyphicon-remove-sign"></span>
</button></td>
</tbody>
</tr>

<?php
}
$datos->close();
?>
</table>
</div>
<br><br><br>
<div class="table-responsive">
<table class="table">
<caption><h2 class="text-center">Voceros De Los Movientos Sociales Electos Por Parroquia</h2></caption>
<tr>
<thead>
<th id="id" class="hidden"></th>
<th id="tipo1" class="hidden"></th>
<th id="idgestion" class="hidden"></th>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Parroquia</th>
<th>Nombre de Gestion Social</th>
<th>Elegir</th>
<th>Eliminar</th>
</thead>
</tr>
<?php
$sql="select i.nombre,i.apellido,i.cedula,gs.parroquia,gs.tipo_gestion,gs.nombre_gestion,vp.idvoceros,gs.idgestion_social from integrantes_gestion i inner join voceros_parroquia vp on i.idintegrantes_gestion=vp.idintegrantes_gestion inner join cargo_integrantes_gestion cig on cig.idintegrantes_gestion=vp.idintegrantes_gestion inner join gestion_social gs on gs.idgestion_social=cig.idgestion_social where vp.movimiento=1 and gs.tipo_gestion='movimiento'";
$datos = $base->extraer($sql);
while($fila = $datos->fetch_array()){
?>
<tr>
<tbody>
<td id="id" class="hidden"><?php echo $fila['idvoceros'];?></td>
<td id="tipo1" class="hidden"><?php echo $fila['tipo_gestion'] ?></td>
<td id="idgestion" class="hidden"><?php echo $fila['idgestion_social'];?></td>
<td><?php echo $fila['nombre'];?></td>
<td><?php echo $fila['apellido'];?></td>
<td><?php echo $fila['cedula'];?></td>
<td><?php echo $fila['parroquia'];?></td>
<td><?php echo $fila['nombre_gestion'];?></td>
<td>
	<button type="button" class="btn btn-success" id="elegirgestion"title="Elegir gestion social">
		<span class="glyphicon glyphicon-ok-sign"></span>
	</button>
</td>
<td style="text-align:left; vertical-align:middle;">
	<button type="button" class="btn btn-danger"  id="eliminarvocero"title="Eliminar">
		<span class="glyphicon glyphicon-remove-sign"></span>
	</button>
</td>
</tbody>
</tr>

<?php
}
$datos->close();
$base->cerrar();
?>
</table>
</div>
<br><br><br>
<?php
}else if($_SESSION['tipo']=="operador" || ($_SESSION['tipo']=="concejal")){
?>
<button type="button" id="generarpdfvocerosparrquia"title="Generar PDF" class="btn btn-lg btn-danger">
	<span class="glyphicon glyphicon-cloud-download"></span> Generar Pdf
</button>
<div class="responsive">
<table class="table">
<caption><h2 class="text-center">Voceros De Los Consejos Comunales  Electos por Parroquia</h2></caption>
<tr>
<thead>
<th id="id" class="hidden"></th>
<th id="tipo1" class="hidden"></th>
<th id="idgestion" class="hidden"></th>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Parroquia</th>
<th>Nombre de Gestion Social</th>
<th>Elegir</th>
</thead>
</tr>
<?php
require("../php/conexion.php");
$sql="select i.nombre,i.apellido,i.cedula,gs.parroquia,gs.nombre_gestion,vp.idvoceros,gs.idgestion_social,gs.tipo_gestion from integrantes_gestion i inner join voceros_parroquia vp on i.idintegrantes_gestion=vp.idintegrantes_gestion inner join cargo_integrantes_gestion cig on cig.idintegrantes_gestion=vp.idintegrantes_gestion inner join gestion_social gs on gs.idgestion_social=cig.idgestion_social where vp.consejo=1 and gs.tipo_gestion='consejo'";
$base = new Conexion();
$base->conectar();
$datos = $base->extraer($sql);
while($fila = $datos->fetch_array()){
?>
<tr>
<tbody>
<td id="id" class="hidden"><?php echo $fila['idvoceros'];?></td>
<td id="tipo1" class="hidden"><?php echo $fila['tipo_gestion'];?></td>
<td id="idgestion" class="hidden"><?php echo $fila['idgestion_social'];?></td>
<td><?php echo $fila['nombre'];?></td>
<td><?php echo $fila['apellido'];?></td>
<td><?php echo $fila['cedula'];?></td>
<td><?php echo $fila['parroquia'];?></td>
<td><?php echo $fila['nombre_gestion'];?></td>
<td>
	<button type="button" class="btn btn-success" title="Elegir gestion social" id="elegirgestion">
		<span class="glyphicon glyphicon-ok-sign"></span>
	</button>
</td>
</tbody>
</tr>

<?php
}
$datos->close();
?>
</table>
</div>
<br><br><br>
<div class="table-responsive">
<table class="table">
<caption><h2 class="text-center">Voceros De Los Movientos Sociales  Electos por Parroquia</h2></caption>
<tr>
<thead>
<th id="id" class="hidden"></th>
<th id="tipo1" class="hidden"></th>
<th id="idgestion" class="hidden"></th>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Parroquia</th>
<th>Nombre de Gestion Social</th>
<th>Elegir</th>
</thead>
</tr>
<?php
$sql="select i.nombre,i.apellido,i.cedula,gs.parroquia,gs.nombre_gestion,vp.idvoceros,gs.idgestion_social,gs.tipo_gestion from integrantes_gestion i inner join voceros_parroquia vp on i.idintegrantes_gestion=vp.idintegrantes_gestion inner join cargo_integrantes_gestion cig on cig.idintegrantes_gestion=vp.idintegrantes_gestion inner join gestion_social gs on gs.idgestion_social=cig.idgestion_social where vp.movimiento=1 and gs.tipo_gestion='movimiento'";
$datos = $base->extraer($sql);
while($fila = $datos->fetch_array()){
?>
<tr>
<tbody>
<td id="id" class="hidden"><?php echo $fila['idvoceros'];?></td>
<td id="tipo1" class="hidden"><?php echo $fila['tipo_gestion'];?></td>
<td id="idgestion" class="hidden"><?php echo $fila['idgestion_social'];?></td>
<td><?php echo $fila['nombre'];?></td>
<td><?php echo $fila['apellido'];?></td>
<td><?php echo $fila['cedula'];?></td>
<td><?php echo $fila['parroquia'];?></td>
<td><?php echo $fila['nombre_gestion'];?></td>
<td>
	<button type="button" class="btn btn-success" id="elegirgestion" title="Elegir gestion social">
		<span class="glyphicon glyphicon-ok-sign"></span>
	</button>
</td>

</tr>

<?php
}
$datos->close();
$base->cerrar();
?>
</table>
</table>
<br><br><br>

<?php
}else{
?>
<script>
window.location="../index.php";
</script>
<?php
}
?>
<script src="../javascript/obtenerdatosdevocerosporparroquia.js"></script>
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
