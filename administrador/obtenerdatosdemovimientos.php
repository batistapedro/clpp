<?php
session_start();
if(isset($_SESSION['tipo']) && !empty($_SESSION['tipo'])){
$id=null;
$id=intval(trim(htmlspecialchars($_POST['id'])));
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../css/obtenerdatosdemovimientos.css">
</head>
<body>
<?php
if($_SESSION['tipo']=="administrador"){
require("../php/conexion.php");
$sqlver ="select fecha_vecimiento,estado from gestion_social  where idgestion_social='$id' and tipo_gestion='movimiento'";
$base = new Conexion();
$base->conectar();
$datos = $base->extraer($sqlver);
while ($fila= $datos->fetch_array()){
$fechavencimiento = $fila['fecha_vecimiento'];
$estado= $fila['estado'];
}
if($estado=="activo"){
if(date("Y-m-d")>=$fechavencimiento){
$versql12="update gestion_social set estado='vencido' where idgestion_social='$id' and tipo_gestion='movimiento'";
$base->actualizar2($versql12);
}
}else if($estado=="vencido"){
if(date("Y-m-d")<$fechavencimiento){
$versql12="update gestion_social set estado='activo' where idgestion_social='$id' and tipo_gestion='movimiento'";
$base->actualizar2($versql12);
}
}
$datos->close();
$base->cerrar();
?>
<div id="todosmovimientos"></div>
<div id="eliminarusuariomovimientos">
<h3>Deseas Eliminar Datos de Integrantes ?</h3>
<button class="btn btn-success" type="button" value="si" id="si" title="Aceptar"><span class="glyphicon glyphicon-ok-sign"></span> Aceptar</button>
<button class="btn btn-danger" type="button" value="no" id="no" title="Cancelar"><span class="glyphicon glyphicon-remove-sign"></span> Cancelar</button>
</div>
<div id="mensajedatosmovimientos"></div>
<input type="hidden" value="<?php echo $id;?>" id="idpdfmovimientos">
<button class="btn btn-danger btn-lg" type="button" id="generarpdfmovimientos"  title="Generar PDF"><span class="glyphicon glyphicon-cloud-download"></span> Generar Pdf</button>
<?php
$sql="select * from gestion_social where idgestion_social='$id' and tipo_gestion='movimiento'";
$base = new Conexion();
$base->conectar();
$datos = $base->extraer($sql);

while($fila = $datos->fetch_array()){
	$idgestion_social=$fila['idgestion_social'];
	$parroquia=$fila['parroquia'];
	$sector=$fila['sector'];
	$sede=$fila['sede'];
	$nombre_gestion=$fila['nombre_gestion'];
	$tipo=$fila['tipo'];
	$rif=$fila['rif'];
	$codigo_gestion=$fila['codigo_gestion'];
	$clave_gestion=$fila['clave_gestion'];
	$fecha_inicio = $fila['fecha_inicio'];
	$fecha_registro=$fila['fecha_registro'];
	$fecha_vencimiento=$fila['fecha_vecimiento'];
	$acta=$fila['acta'];
	$cedulas=$fila['cedulas'];
	$constancia=$fila['constancia'];
	$nomina=$fila['nomina'];
	$estado=$fila['estado'];
}
$datos->close();
?>
<div class="table-responsive">
<table class="table">
<caption><h2 class="text-center">Direccion De Movimientos</h2></caption>
<tr>
<thead>
<th id="id">id</th>
<th id="tipo">tipo</th>
<th>Parroquia</th>
<th>sector</th>
<th>sede</th>
</thead>
</tr>
<tr>
<tbody>
<td id="id"><?php echo $idgestion_social;?></td>
<td id="tipo"><?php echo "movimientos";?></td>
<td class="editable" data-campo="parroquia"><span><?php echo $parroquia;?></span></td>
<td class="editable" data-campo="sector"><span><?php echo $sector;?></span></td>
<td class="editable" data-campo="sede"><span><?php echo $sede;?></span></td>
</tbody>
</tr>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2 class="text-center">Datos De Movimientos</h2></caption>
<tr>
<thead>
<th id="id">Id</th>
<th id="tipo">tipo</th>
<th>Nombre</th>
<th>Tipo</th>
<th>Rif</th>
<th>Codigo</th>
<th>Clave</th>
</thead>
</tr>
<tr>
<tbody>
<td id="id"><?php echo $idgestion_social;?></td>
<td id="tipo"><?php echo "movimientos";?></td>
<td class="editable" data-campo="nombre_gestion"><span><?php echo $nombre_gestion;?></span></td>
<td class="editable" data-campo="tipo"><span><?php echo $tipo;?></span></td>
<td class="editable" data-campo="rif"><span><?php echo $rif;?></span></td>
<td> <?php echo $codigo_gestion;?></td>
<td class="editable" data-campo="clave_gestion"><span><?php echo $clave_gestion;?></span></td>
</tbody>
</tr>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2 class="text-center">Fecha de Movimientos</h2></caption>
<tr>
<thead>
<th id="id">Id</th>
<th id="tipo">tipo</th>
<th>Fecha de Registro</th>
<th>Fecha de Adecuacion</th>
<th>Fecha de Vencimiento</th>
<th>Estado</th>
</thead>
</tr>
<tr>
<tbody>
<td id="id"><?php echo $idgestion_social;?></td>
<td id="tipo"><?php echo "movimientos";?></td>
<td class="editable" data-campo="fecha_inicio"><span><?php echo $fecha_inicio;?></span></td>
<td class="editable" data-campo="fecha_registro"><span><?php echo $fecha_registro;?></span></td>
<td class="editable" data-campo="fecha_vecimiento"><span><?php echo $fecha_vencimiento;?></span></td>
<td><?php echo $estado;?></td>
</tbody>
</tr>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2 class="text-center">Anexo De Documentos</h2></caption>
<tr>
<thead>
<th id="id">id</th>
<th id="tipo">Tipo</th>
<th>Acta Constitutiva</th>
<th>Nomina de Integrantes</th>
<th>Constancia de Eleccion</th>
<th>Cedulas de Integrantes</th>
</thead>
</tr>
<tr>
<tbody>
<td id="id"><?php echo $idgestion_social;?></td>
<td id="tipo"><?php echo "documentos";?></td>
<td class="editable" data-campo="acta"><span><?php echo $acta;?></span></td>
<td class="editable" data-campo="nomina"><span><?php echo $nomina;?></span></td>
<td class="editable" data-campo="constancia"><span><?php echo $constancia;?></span></td>
<td class="editable" data-campo="cedulas"><span><?php echo $cedulas;?></span></td>
</tbody>
</tr>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2 class="text-center">Integrantes Principales<h2></caption>
<tr>
<thead>
<th id="idmovimiento">idmovimiento</th>
<th id="id">Id</th>
<th id="tipo">tipo</th>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Telefono</th>
<th>Cargo</th>
<th>Eliminar</th>
</thead>
</tr>
<?php
$sql4="select i.idintegrantes_gestion, i.nombre, i.apellido,i.cedula,i.telefono,ci.cargo,ci.tipo from integrantes_gestion i inner join cargo_integrantes_gestion ci on i.idintegrantes_gestion=ci.idintegrantes_gestion where i.movimiento=1 and ci.idgestion_social='$id' and ci.tipo='principal'";
$ver = $base->extraer($sql4);
while($fila = $ver->fetch_array()){
?>
<tr>
<tbody>
<td id="idmovimiento"><?php echo $idgestion_social;?></td>
<td id='id'><?php echo $fila['idintegrantes_gestion'];?></td>
<td id="tipo"><?php echo "integrantes";?></td>
<td class="editable" data-campo="nombre"><span><?php echo $fila['nombre'];?></span></td>
<td class="editable" data-campo="apellido"><span><?php echo $fila['apellido'];?></span></td>
<td class="editable" data-campo="cedula"><span><?php echo $fila['cedula'];?></span></td>
<td class="editable" data-campo="telefono"><span><?php echo $fila['telefono'];?></span></td>
<td class="editable" data-campo="cargo"><span><?php echo $fila['cargo'];?></span></td>
<td>
	<button class="btn btn-danger glyphicon glyphicon-remove-sign" type="button" id="eliminarintegrantesmovimientos" title="Borrar"> </button>
</td>
</tbody>
</tr>
<?php
}
$ver->close();
?>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2 class="text-center">Integrantes Suplentes<h2></caption>
<tr>
<thead>
<th id="idmovimiento">idmovimiento</th>
<th id="id">Id</th>
<th id="tipo">tipo</th>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Telefono</th>
<th>Cargo</th>
<th>Eliminar</th>
</thead>
</tr>
<?php
$sql5="select i.idintegrantes_gestion, i.nombre, i.apellido,i.cedula,i.telefono,ci.cargo,ci.tipo from integrantes_gestion i inner join cargo_integrantes_gestion ci on i.idintegrantes_gestion=ci.idintegrantes_gestion where i.movimiento=1 and ci.idgestion_social='$id' and ci.tipo='suplente'";
$ver = $base->extraer($sql5);
while($fila = $ver->fetch_array()){
?>
<tr>
<tbody>
<td id="idmovimiento"><?php echo $idgestion_social;?></td>
<td id='id'><?php echo $fila['idintegrantes_gestion'];?></td>
<td id="tipo"><?php echo "integrantes";?></td>
<td class="editable" data-campo="nombre"><span><?php echo $fila['nombre'];?></span></td>
<td class="editable" data-campo="apellido"><span><?php echo $fila['apellido'];?></span></td>
<td class="editable" data-campo="cedula"><span><?php echo $fila['cedula'];?></span></td>
<td class="editable" data-campo="telefono"><span><?php echo $fila['telefono'];?></span></td>
<td class="editable" data-campo="cargo"><span><?php echo $fila['cargo'];?></span></td>
<td>
	<button class="btn btn-danger glyphicon glyphicon-remove-sign" type="button" id="eliminarintegrantesmovimientos" title="Borrar"></button>
</td>
</tbody>
</tr>
<?php
}
$ver->close();
$base->cerrar();
?>
</table>
</div>
</body>
</html>
<?php
}else if($_SESSION['tipo']=="operador"){
require("../php/conexion.php");
$sqlver ="select fecha_vecimiento,estado from gestion_social  where idgestion_social='$id' and tipo_gestion='movimiento'";
$base = new Conexion();
$base->conectar();
$datos = $base->extraer($sqlver);
while ($fila= $datos->fetch_array()){
$fechavencimiento = $fila['fecha_vecimiento'];
$estado= $fila['estado'];
}
if($estado=="activo"){
if(date("Y-m-d")>=$fechavencimiento){
$versql12="update gestion_social set estado='vencido' where idgestion_social='$id' and tipo_gestion='movimiento'";
$base->actualizar2($versql12);
}
}else if($estado=="vencido"){
if(date("Y-m-d")<$fechavencimiento){
$versql12="update gestion_social set estado='activo' where idgestion_social='$id' and tipo_gestion='movimiento'";
$base->actualizar2($versql12);
}
}
$datos->close();
$base->cerrar();
?>
<div id="mensajedatosmovimientos"></div>
<input type="hidden" value="<?php echo $id;?>" id="idpdfmovimientos">
<button type="button" class="btn btn-danger btn-lg" id="generarpdfmovimientos" title="Generar PDF"><span class="glyphicon glyphicon-cloud-download"></span> Generar Pdf</button>
<?php
$sql="select * from gestion_social where idgestion_social='$id' and tipo_gestion='movimiento'";
$base = new Conexion();
$base->conectar();
$datos = $base->extraer($sql);

while($fila = $datos->fetch_array()){
	$idgestion_social=$fila['idgestion_social'];
	$parroquia=$fila['parroquia'];
	$sector=$fila['sector'];
	$sede=$fila['sede'];
	$nombre_gestion=$fila['nombre_gestion'];
	$tipo=$fila['tipo'];
	$rif=$fila['rif'];
	$codigo_gestion=$fila['codigo_gestion'];
	$clave_gestion=$fila['clave_gestion'];
	$fecha_inicio = $fila['fecha_inicio'];
	$fecha_registro=$fila['fecha_registro'];
	$fecha_vencimiento=$fila['fecha_vecimiento'];
	$acta=$fila['acta'];
	$cedulas=$fila['cedulas'];
	$constancia=$fila['constancia'];
	$nomina=$fila['nomina'];
	$estado=$fila['estado'];
}
$datos->close();
?>
<div class="table-responsive">
<table class="table">
<caption><h2 class="text-center">Direccion De Movimientos</h2></caption>
<tr>
<thead>
<th id="id">id</th>
<th id="tipo">tipo</th>
<th>Parroquia</th>
<th>sector</th>
<th>sede</th>
</thead>
</tr>

<tr>
<tbody>
<td id="id"><?php echo $idgestion_social;?></td>
<td id="tipo"><?php echo "movimientos";?></td>
<td class="editable" data-campo="parroquia"><span><?php echo $parroquia;?></span></td>
<td class="editable" data-campo="sector"><span><?php echo $sector;?></span></td>
<td class="editable" data-campo="sede"><span><?php echo $sede;?></span></td>
</tbody>
</tr>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2 class="text-center">Datos De Movimientos</h2></caption>
<tr>
<thead>
<th id="id">Id</th>
<th id="tipo">tipo</th>
<th>Nombre</th>
<th>Tipo</th>
<th>Rif</th>
<th>Codigo</th>
<th>Clave</th>
</thead>
</tr>
<tr>
<tbody>
<td  id="id"><?php echo $idgestion_social;?></td>
<td  id="tipo"><?php echo "movimientos";?></td>
<td  class="editable" data-campo="nombre_gestion"><span><?php echo $nombre_gestion;?></span></td>
<td  class="editable" data-campo="tipo"><span><?php echo $tipo;?></span></td>
<td  class="editable" data-campo="rif"><span><?php echo $rif;?></span></td>
<td ><?php echo $codigo_gestion;?></td>
<td  class="editable" data-campo="clave_gestion"><span><?php echo $clave_gestion;?></span></td>
</tbody>
</tr>
</table>
</div>
<div class="table-responsive">
<table class="table"><caption><h2 class="text-center">Fecha de Movimientos</h2></caption>
<tr>
<thead>
<th id="id">Id</th>
<th id="tipo">tipo</th>
<th>Fecha de Registro</th>
<th>Fecha de Adecuacion</th>
<th>Fecha de Vencimiento</th>
<th>Estado</th>
</thead>
</tr>
<tr>
<tbody>
<td id="id"><?php echo $idgestion_social;?></td>
<td id="tipo"><?php echo "movimientos";?></td>
<td class="editable" data-campo="fecha_inicio"><span><?php echo $fecha_inicio;?></span></td>
<td class="editable" data-campo="fecha_registro"><span><?php echo $fecha_registro;?></span></td>
<td class="editable" data-campo="fecha_vecimiento"><span><?php echo $fecha_vencimiento;?></span></td>
<td ><?php echo $estado;?></td>
</tbody>
</tr>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2 class="text-center">Anexo De Documentos</h2></caption>
<tr>
<thead>
<th id="id">id</th>
<th id="tipo">Tipo</th>
<th>Acta Constitutiva</th>
<th>Nomina de Integrantes</th>
<th>Constancia de Eleccion</th>
<th>Cedulas de Integrantes</th>
</thead>
</tr>
<tr>
<tbody>
<td id="id"><?php echo $idgestion_social;?></td>
<td id="tipo"><?php echo "documentos";?></td>
<td class="editable" data-campo="acta"><span><?php echo $acta;?></span></td>
<td class="editable" data-campo="nomina"><span><?php echo $nomina;?></span></td>
<td class="editable" data-campo="constancia"><span><?php echo $constancia;?></span></td>
<td class="editable" data-campo="cedulas"><span><?php echo $cedulas;?></span></td>
</tbody>
</tr>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2 class="text-center">Integrantes Principales<h2></caption>
<tr>
<thead>
<th id="id">Id</th>
<th id="tipo">tipo</th>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Telefono</th>
<th>Cargo</th>
</thead>
</tr>
<?php
$sql4="select i.idintegrantes_gestion,i.nombre, i.apellido,i.cedula,i.telefono,ci.cargo,ci.tipo from integrantes_gestion i inner join cargo_integrantes_gestion ci on i.idintegrantes_gestion=ci.idintegrantes_gestion where i.movimiento=1 and ci.idgestion_social='$id' and ci.tipo='principal'";
$ver = $base->extraer($sql4);
while($fila = $ver->fetch_array()){
?>
<tr>
<tbody>
<td id='id'><?php echo $fila['idintegrantes_gestion'];?></td>
<td id="tipo"><?php echo "integrantes";?></td>
<td class="editable" data-campo="nombre"><span><?php echo $fila['nombre'];?></span></td>
<td class="editable" data-campo="apellido"><span><?php echo $fila['apellido'];?></span></td>
<td class="editable" data-campo="cedula"><span><?php echo $fila['cedula'];?></span></td>
<td class="editable" data-campo="telefono"><span><?php echo $fila['telefono'];?></span></td>
<td class="editable" data-campo="cargo"><span><?php echo $fila['cargo'];?></span></td>
</tbody>
</tr>
<?php
}
$ver->close();
?>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2 class="text-center">Integrantes Suplentes<h2></caption>
<tr>
<thead>
<th id="idmovimiento">idmovimiento</th>
<th id="id">Id</th>
<th id="tipo">tipo</th>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Telefono</th>
<th>Cargo</th>
</thead>
</tr>
<?php
$sql5="select i.idintegrantes_gestion,i.nombre, i.apellido,i.cedula,i.telefono,ci.cargo,ci.tipo from integrantes_gestion i inner join cargo_integrantes_gestion ci on i.idintegrantes_gestion=ci.idintegrantes_gestion where i.movimiento=1 and ci.idgestion_social='$id' and ci.tipo='suplente'";
$base = new Conexion();
$base->conectar();
$ver = $base->extraer($sql5);
while($fila = $ver->fetch_array()){
?>
<tr>
<tbody>
<td id="idmovimiento"><?php echo $idgestion_social;?></td>
<td id='id'><?php echo $fila['idintegrantes_gestion'];?></td>
<td id="tipo"><?php echo "integrantes";?></td>
<td class="editable" data-campo="nombre"><span><?php echo $fila['nombre'];?></span></td>
<td class="editable" data-campo="apellido"><span><?php echo $fila['apellido'];?></span></td>
<td class="editable" data-campo="cedula"><span><?php echo $fila['cedula'];?></span></td>
<td class="editable" data-campo="telefono"><span><?php echo $fila['telefono'];?></span></td>
<td class="editable" data-campo="cargo"><span><?php echo $fila['cargo'];?></span></td>
</tbody>
</tr>
<?php
}
$ver->close();
$base->cerrar();
?>
</table>
</div>
</body>
</html>

<?php
}else if($_SESSION['tipo']=="concejal"){
require("../php/conexion.php");
$base = new Conexion();
$base->conectar();
?>
<button type="button" class="btn btn-lg btn-danger" id="generarpdfmovimientos" title="Generar PDF"><span class="glyphicon glyphicon-cloud-download"></span> Generar Pdf</button>
<input type="hidden" value="<?php echo $id;?>" id="idpdfmovimientos">
<?php
$sql="select * from gestion_social where idgestion_social='$id' and tipo_gestion='movimiento'";

$datos = $base->extraer($sql);

while($fila = $datos->fetch_array()){
	$parroquia=$fila['parroquia'];
	$sector=$fila['sector'];
	$sede=$fila['sede'];
	$nombre_gestion=$fila['nombre_gestion'];
	$tipo=$fila['tipo'];
	$rif=$fila['rif'];
	$codigo_gestion=$fila['codigo_gestion'];
	$fecha_inicio = $fila['fecha_inicio'];
	$fecha_registro=$fila['fecha_registro'];
	$fecha_vencimiento=$fila['fecha_vecimiento'];
	$acta=$fila['acta'];
	$cedulas=$fila['cedulas'];
	$constancia=$fila['constancia'];
	$nomina=$fila['nomina'];
	$estado=$fila['estado'];
}
$datos->close();
?>
<div class="table-responsive">
<table class="table">
<caption><h2 class="text-center">Direccion De Movimientos</h2></caption>
<tr>
<thead>
<th>Parroquia</th>
<th>sector</th>
<th>sede</th>
</thead>
</tr>
<tr>
<tbody>
<td><?php echo $parroquia;?></td>
<td><?php echo $sector;?></td>
<td><?php echo $sede;?></td>
</tbody>
</tr>
</table>
<table class="table">
<caption><h2 class="text-center">Datos De Movimientos</h2></caption>
<tr>
<thead>
<th>Nombre</th>
<th>Tipo</th>
<th>Rif</th>
<th>Codigo</th>
</thead>
</tr>
<tr>
<tbody>
<td><?php echo $nombre_gestion;?></td>
<td><?php echo $tipo;?></td>
<td><?php echo $rif;?></td>
<td><?php echo $codigo_gestion;?></td>
</tbody>
</tr>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2 class="text-center">Fecha de Movimientos</h2></caption>
<tr>
<thead>
<th>Fecha de Registro</th>
<th>Fecha de Adecuacion</th>
<th>Fecha de Vencimiento</th>
<th>Estado</th>
</thead>
</tr>
<tr>
<tbody>
<td><?php echo $fecha_inicio;?></td>
<td><?php echo $fecha_registro;?></td>
<td><?php echo $fecha_vencimiento;?></td>
<td><?php echo $estado;?></td>
</tbody>
</tr>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2 class="text-center">Anexo De Documentos</h2></caption>
<tr>
<thead>
<th>Acta Constitutiva</th>
<th>Nomina de Integrantes</th>
<th>Constancia de Eleccion</th>
<th>Cedulas de Integrantes</th>
</thead>
</tr>
<tr>
<tbody>
<td><?php echo $acta;?></td>
<td><?php echo $nomina;?></td>
<td><?php echo $constancia;?></td>
<td><?php echo $cedulas;?></td>
</tbody>
</tr>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2 class="text-center">Integrantes Principales<h2></caption>
<tr>
<thead>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Telefono</th>
<th>Cargo</th>
</thead>
</tr>
<?php
$sql4="select i.nombre, i.apellido,i.cedula,i.telefono,ci.cargo,ci.tipo from integrantes_gestion i inner join cargo_integrantes_gestion ci on i.idintegrantes_gestion=ci.idintegrantes_gestion where i.movimiento=1 and ci.idgestion_social='$id' and ci.tipo='principal'";
$ver = $base->extraer($sql4);
while($fila = $ver->fetch_array()){
?>
<tr>
<tbody>
<td><?php echo $fila['nombre'];?></td>
<td><?php echo $fila['apellido'];?></td>
<td><?php echo $fila['cedula'];?></td>
<td><?php echo $fila['telefono'];?></td>
<td><?php echo $fila['cargo'];?></td>
</tbody>
</tr>
<?php
}
$ver->close();
?>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2 class="text-center">Integrantes Suplentes<h2></caption>
<tr>
<thead>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Telefono</th>
<th>Cargo</th>
</thead>
</tr>
<?php
$sql5="select i.nombre, i.apellido,i.cedula,i.telefono,ci.cargo,ci.tipo from integrantes_gestion i inner join cargo_integrantes_gestion ci on i.idintegrantes_gestion=ci.idintegrantes_gestion where i.movimiento=1 and ci.idgestion_social='$id' and ci.tipo='suplente'";
$ver = $base->extraer($sql5);
while($fila = $ver->fetch_array()){
?>
<tr>
<tbody>
<td><?php echo $fila['nombre'];?></td>
<td><?php echo $fila['apellido'];?></td>
<td><?php echo $fila['cedula'];?></td>
<td><?php echo $fila['telefono'];?></td>
<td><?php echo $fila['cargo'];?></td>
</tbody>
</tr>
<?php
}
$ver->close();
$base->cerrar();
?>
</table>
</div>
<?php
}
?>
<script src="../javascript/obtenerdatosdemovimientos.js"></script>
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
