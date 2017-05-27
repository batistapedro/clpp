<?php
session_start();
if(isset($_SESSION['tipo']) && !empty($_SESSION['tipo'])){
$id=null;
$id=intval(trim(htmlspecialchars($_POST['id'])));
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../css/obtenerdatosdecomunas.css">
</head>
<body>
<?php
if($_SESSION['tipo']=="administrador"){
require("../php/conexion.php");
$sqlver = "select fecha_vecimiento,estado from gestion_social where idgestion_social='$id' and tipo_gestion='comuna'";
$base=  new Conexion();
$base->conectar();
$datos = $base->extraer($sqlver);
while ($fila = $datos->fetch_array()){
$fechavencimiento = $fila['fecha_vecimiento'];
$estado=$fila['estado'];
}
if($estado=="activo"){
if(date("Y-m-d")>=$fechavencimiento){
$versql12="update gestion_social set estado='vencido' where idgestion_social='$id' and tipo_gestion='comuna'";
$base->actualizar2($versql12);
}
}else if($estado=="vencido"){
if(date("Y-m-d")<$fechavencimiento){
$versql12="update gestion_social set estado='activo' where idgestion_social='$id' and tipo_gestion='comuna'";
$base->actualizar2($versql12);
}
}
?>
<div id="todoscomunas"></div>
<div id="eliminarusuariocomunas">
<h3>Deseas Eliminar Datos de Integrantes ?</h3>
<button value="si" id="si" title="Aceptar" type="button" class="btn btn-success"><span class="glyphicon glyphicon-ok-sign"></span> Aceptar</button>
<button value="no" id="no" title="Cancelar" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove-sign"></span> Cancelar</button>
</div>
<div id="eliminarusuarioconsejoscomunales">
<h3>Deseas Eliminar Consejo Comunal?</h3>
<button type="button" class="btn btn-success" value="si" id="sielimnar" title="Aceptar"><span class="glyphicon glyphicon-ok-sign"></span> Aceptar</button>
<button type="button" class="btn btn-danger" value="no" id="noeliminar" title="Cancelar"><span class="glyphicon glyphicon-remove-sign"></span> Cancelar</button>
</div>
<div id="mensajedatoscomunas"></div>
<input type="hidden" value="<?php echo $id;?>" id="idpdfcomunas">
<button class="btn btn-lg btn-danger" type="button" title="Generar PDF" id='generarpdfcomunas'><span class="glyphicon glyphicon-cloud-download"></span> Generar Pdf</button>
<?php
$sql="select * from gestion_social where idgestion_social='$id' and tipo_gestion='comuna'";
$datos = $base->extraer($sql);

while($fila = $datos->fetch_array()){
	$idgestion_social=$fila['idgestion_social'];
	$parroquia=$fila['parroquia'];
	$sede = $fila['sede'];
	$sector= $fila['sector'];
	$nombre_gestion=$fila['nombre_gestion'];
	$rif=$fila['rif'];
	$codigo_gestion=$fila['codigo_gestion'];
	$clave_gestion=$fila['clave_gestion'];
	$fecha_inicio= $fila['fecha_inicio'];
	$fecha_registro= $fila['fecha_registro'];
	$fecha_vencimiento= $fila['fecha_vecimiento'];
	$acta=$fila['acta'];
	$cedulas=$fila['cedulas'];
	$constancia=$fila['constancia'];
	$nomina = $fila['nomina'];
	$estado=$fila['estado'];
}
?>
<div class="table-responsive">
<table class="table">
<caption><h2>Direccion De Comuna</h2></caption>
<tr>
<thead>
<th id="id">id</th>
<th>Parroquia</th>
<th>sector</th>
<th>sede</th>
</thead>
</tr>
<tr>
<tbody>
<td id="id"><?php echo $idgestion_social;?></td>
<td id="tipo"><?php echo "comuna";?></td>
<td class="editable" data-campo="parroquia"><span><?php echo $parroquia;?></span></td>
<td class="editable" data-campo="sector"><span><?php echo $sector;?></span></td>
<td class="editable" data-campo="sede"><span><?php echo $sede;?></span></td>
</tbody>
</tr>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2>Datos De Comuna</h2></caption>
<tr>
<thead>
<th id="id">Id</th>
<th id="tipo">tipo</th>
<th>Nombre</th>
<th>Rif</th>
<th>Codigo</th>
<th>Clave</th>
</thead>
</tr>
<tr>
<tbody>
<td id="id"><?php echo $idgestion_social;?></td>
<td id="tipo"><?php echo "comuna";?></td>
<td class="editable" data-campo="nombre_gestion"><span><?php echo $nombre_gestion;?></span></td>
<td class="editable" data-campo="rif"><span><?php echo $rif;?></span></td>
<td><?php echo $codigo_gestion;?></td>
<td class="editable" data-campo="clave_gestion"><span><?php echo $clave_gestion;?></span></td>
</tbody>
</tr>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2>Fecha de Comuna</h2></caption>
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
<td id="tipo"><?php echo "comuna";?></td>
<td class="editable" data-campo="fecha_inicio"><span><?php echo $fecha_inicio;?></span></td>
<td class="editable" data-campo="fecha_registro"><span><?php echo $fecha_registro;?></span></td>
<td class="editable" data-campo="fecha_vencimiento"><span><?php echo $fecha_vencimiento;?></span></td>
<td><?php echo $estado;?></td>
</tbody>
</tr>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2>Anexo De Documentos</h2></caption>
<tr>
<thead>
<th id="id">id</th>
<th id="tipo">Tipo</th>
<th>Acta Constitutiva</th>
<th>Constancia de Eleccion</th>
<th>Cedulas de Integrantes</th>
<th>Certificado de Registro</th>
</thead>
</tr>
<tr>
<tbody>
<td id="id"><?php echo $idgestion_social;?></td>
<td id="tipo"><?php echo "documentos";?></td>
<td class="editable" data-campo="acta"><span><?php echo $acta;?></span></td>
<td class="editable" data-campo="constancia"><span><?php echo $constancia;?></span></td>
<td class="editable" data-campo="cedulas"><span><?php echo $cedulas;?></span></td>
<td class="editable" data-campo="nomina"><span><?php echo $nomina;?></span></td>
</tbody>
</tr>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2>Consejos Comunales que la Integran</h2></caption>
<tr>
<thead>
<th id="idcomuna"></th>
<th id="idconsejocomuna"></th>
<th>Nombre del Consejo Comunal</th>
<th id="idconsejos"></th>
<th>Elegir</th>
<th>Eliminar</th>
</thead>
</tr>
<?php
$sqlver13="select gs.nombre_gestion,cc.idconsejoscomunas,cc.idconsejos from gestion_social gs inner join consejos_comunas cc on gs.idgestion_social=cc.idconsejos where gs.tipo_gestion='consejo' and cc.idgestion_social='$id' order by gs.nombre_gestion asc";
$datos13 = $base->extraer($sqlver13);
while($fila = $datos13->fetch_array()){
?>
<tr>
<tbody>
<td id="idcomuna"><?php echo $idgestion_social;?></td>
<td id="idconsejocomuna"><?php echo $fila['idconsejoscomunas'];?></td>
<td><?php echo $fila['nombre_gestion'];?></td>
<td id="idconsejos"><?php echo $fila['idconsejos'];?></td>
<td><button type="button" class="btn btn-success glyphicon glyphicon-ok-sign" id="elegirconsejos" title="Elegir"> Elegir</button></td>
<td><button type="button" class="btn btn-danger glyphicon glyphicon-remove-sign" id="eliminarconsejoscomunas" title="Eliminar"> Eliminar</button></td>
</tbody>
</tr>
<?php
}
$datos13->close();
?>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2>Parlamento Comunal</h2></caption>
<tr>
<thead>
<th id="idcomuna">idcomuna</th>
<th id="id">id</th>
<th id="tipo">tipo</th>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Tipo</th>
<th>Nombre del consejos comunal</th>
<th>Eliminar</th>
</thead>
</tr>
<?php
$sql4="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion,i.idintegrantes_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='parlamento' and ci.idgestion_social='$id' order by ci.tipo asc";
$ver = $base->extraer($sql4);
while($fila = $ver->fetch_array()){
?>
<tr>
<tbody>
<td id='idcomuna'><?php echo $idgestion_social;?></td>
<td id="id"><?php echo $fila['idintegrantes_gestion'];?></td>
<td id="tipo"><?php echo "integrantes";?></td>
<td class="editable" data-campo="nombre"><span><?php echo $fila['nombre'];?></span></td>
<td class="editable" data-campo="apellido"><span><?php echo $fila['apellido'];?></span></td>
<td class="editable" data-campo="cedula"><span><?php echo $fila['cedula'];?></span></td>
<td class="editable" data-campo="tipo"><span><?php echo $fila['tipo'];?></span></td>
<td><?php echo $fila['nombre_gestion'];?></td>
<td>
	<button type="button" class="btn btn-danger glyphicon glyphicon-remove-sign" id="eliminarintegrantescomunas" title="Borrar"></button>
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
<caption><h2>Consejo Ejecutivo</h2></caption>
<tr>
<thead>
<th id="idcomuna">Idcomuna</th>
<th id="id">id</th>
<th id="tipo">tipo</th>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Tipo</th>
<th>Nombre del consejos comunal</th>
<th>Eliminar</th>
</thead>
</tr>
<?php

$sql5="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion,i.idintegrantes_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='ejecutivo' and ci.idgestion_social='$id' order by ci.tipo asc";
$ver = $base->extraer($sql5);
while($fila = $ver->fetch_array()){
?>
<tr>
<tbody>
<td id='idcomuna'><?php echo $idgestion_social;?></td>
<td id="id"><?php echo $fila['idintegrantes_gestion'];?></td>
<td id="tipo"><?php echo "integrantes";?></td>
<td class="editable" data-campo="nombre"><span><?php echo $fila['nombre'];?></span></td>
<td class="editable" data-campo="apellido"><span><?php echo $fila['apellido'];?></span></td>
<td class="editable" data-campo="cedula"><span><?php echo $fila['cedula'];?></span></td>
<td class="editable" data-campo="tipo"><span><?php echo $fila['tipo'];?></span></td>
<td><?php echo $fila['nombre_gestion']?></td>
<td>
	<button type="button" class="btn btn-danger glyphicon glyphicon-remove-sign" id="eliminarintegrantescomunas" title="Borrar"></button>
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
<caption><h2>Comite de Derechos Humanos</h2></caption>
<tr>
<thead>
<th id="idcomuna">Idcomuna</th>
<th id="id">id</th>
<th id="tipo">tipo</th>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Tipo</th>
<th>Nombre del consejos comunal</th>
<th>Eliminar</th>
</thead>
</tr>
<?php

$sql4="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion,i.idintegrantes_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='derechos humanos' and ci.idgestion_social='$id' order by ci.tipo asc";
$ver = $base->extraer($sql4);
while($fila = $ver->fetch_array()){
?>
<tr>
<tbody>
<td id='idcomuna'><?php echo $idgestion_social;?></td>
<td id="id"><?php echo $fila['idintegrantes_gestion'];?></td>
<td id="tipo"><?php echo "integrantes";?></td>
<td class="editable" data-campo="nombre"><span><?php echo $fila['nombre'];?></span></td>
<td class="editable" data-campo="apellido"><span><?php echo $fila['apellido'];?></span></td>
<td class="editable" data-campo="cedula"><span><?php echo $fila['cedula'];?></span></td>
<td class="editable" data-campo="tipo"><span><?php echo $fila['tipo'];?></span></td>
<td><?php echo $fila['nombre_gestion'];?></td>
<td>
	<button type="button" class="btn btn-danger glyphicon glyphicon-remove-sign" id="eliminarintegrantescomunas" title="Borrar"></button>
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
<caption><h2>Comite de Salud</h2></caption>
<tr>
<thead>
<th id="idcomuna">Id</th>
<th id="id"></th>
<th id="tipo">tipo</th>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Tipo</th>
<th>Nombre del consejos comunal</th>
<th>Eliminar</th>
</thead>
</tr>
<?php
$sql4="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion,i.idintegrantes_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='comite salud' and ci.idgestion_social='$id' order by ci.tipo asc";
$ver = $base->extraer($sql4);
while($fila = $ver->fetch_array()){
?>
<tr>
<tbody>
<td id='idcomuna'><?php echo $idgestion_social;?></td>
<td id="id"><?php echo $fila['idintegrantes_gestion'];?></td>
<td id="tipo"><?php echo "integrantes";?></td>
<td class="editable" data-campo="nombre"><span><?php echo $fila['nombre'];?></span></td>
<td class="editable" data-campo="apellido"><span><?php echo $fila['apellido'];?></span></td>
<td class="editable" data-campo="cedula"><span><?php echo $fila['cedula'];?></span></td>
<td class="editable" data-campo="tipo"><span><?php echo $fila['tipo'];?></span></td>
<td><?php echo $fila['nombre_gestion'];?></td>
<td>
	<button type="button" class="btn btn-danger glyphicon glyphicon-remove-sign" id="eliminarintegrantescomunas" title="Eliminar datos"></button>
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
<caption><h2>Comite de Tierra Urbana,Vivienda y Habitat</h2></caption>
<tr>
<th id="idcomuna">Idcomuna</th>
<th id="id">id</th>
<th id="tipo">tipo</th>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Tipo</th>
<th>Nombre del consejos comunal</th>
<th>Eliminar</th>
</tr>
<?php
$sql4="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion,i.idintegrantes_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='tierra' and ci.idgestion_social='$id' order by ci.tipo asc";
$ver = $base->extraer($sql4);
while($fila = $ver->fetch_array()){
?>
<tr>
<td id='idcomuna'><?php echo $idgestion_social;?></td>
<td id="id"><?php echo $fila['idintegrantes_gestion'];?></td>
<td id="tipo"><?php echo "integrantes";?></td>
<td class="editable" data-campo="nombre"><span><?php echo $fila['nombre'];?></span></td>
<td class="editable" data-campo="apellido"><span><?php echo $fila['apellido'];?></span></td>
<td class="editable" data-campo="cedula"><span><?php echo $fila['cedula'];?></span></td>
<td class="editable" data-campo="tipo"><span><?php echo $fila['tipo'];?></span></td>
<td><?php echo $fila['nombre_gestion'];?></td>
<td>
	<button type="button" class="btn btn-danger glyphicon glyphicon-remove-sign" id="eliminarintegrantescomunas" title="Borrar"></button>
</td>
</tr>
<?php
}
$ver->close();
?>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2>Comite de Defensa de las Personas en el Acceso de Bienes y Servicios</h2></caption>
<tr>
<th id="idcomuna"></th>
<th id="id"></th>
<th id="tipo">tipo</th>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Tipo</th>
<th>Nombre del consejos comunal</th>
<th>Eliminar</th>
</tr>
<?php
$sql4="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion,i.idintegrantes_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='bienes' and ci.idgestion_social='$id' order by ci.tipo asc";
$ver = $base->extraer($sql4);
while($fila = $ver->fetch_array()){
?>
<tr>
<td id='idcomuna'><?php echo $idgestion_social;?></td>
<td id="id"><?php echo $fila['idintegrantes_gestion'];?></td>
<td id="tipo"><?php echo "integrantes";?></td>
<td class="editable" data-campo="nombre"><span><?php echo $fila['nombre'];?></span></td>
<td class="editable" data-campo="apellido"><span><?php echo $fila['apellido'];?></span></td>
<td class="editable" data-campo="cedula"><span><?php echo $fila['cedula'];?></span></td>
<td class="editable" data-campo="tipo"><span><?php echo $fila['tipo'];?></span></td>
<td><?php echo $fila['nombre_gestion'];?></td>
<td>
	<button type="button" class="btn btn-danger glyphicon glyphicon-remove-sign" id="eliminarintegrantescomunas" title="Borrar"></button>
</td>
</tr>
<?php
}
$ver->close();
?>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2>Comite de Economia y Produccion Comunal</h2></caption>
<tr>
<th id="idcomuna"></th>
<th id="id"></th>
<th id="tipo">tipo</th>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Tipo</th>
<th>Nombre del consejos comunal</th>
<th>Eliminar</th>
</tr>
<?php
$sql4="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion,i.idintegrantes_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='econimia y produccion' and ci.idgestion_social='$id' order by ci.tipo asc";
$ver = $base->extraer($sql4);
while($fila = $ver->fetch_array()){
?>
<tr>
<td id='idcomuna'><?php echo $idgestion_social;?></td>
<td id="id"><?php echo $fila['idintegrantes_gestion'];?></td>
<td id="tipo"><?php echo "integrantes";?></td>
<td class="editable" data-campo="nombre"><span><?php echo $fila['nombre'];?></span></td>
<td class="editable" data-campo="apellido"><span><?php echo $fila['apellido'];?></span></td>
<td class="editable" data-campo="cedula"><span><?php echo $fila['cedula'];?></span></td>
<td class="editable" data-campo="tipo"><span><?php echo $fila['tipo'];?></span></td>
<td><?php echo $fila['nombre_gestion'];?></td>
<td>
	<button type="button" class="btn btn-danger glyphicon glyphicon-remove-sign" id="eliminarintegrantescomunas" title="Borrar"></button>
</td>
</tr>
<?php
}
$ver->close();
?>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2>Comite de la Mujer E Iguldad de Genero</h2></caption>
<tr>
<th id="idcomuna"></th>
<th id="id"></th>
<th id="tipo">tipo</th>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Tipo</th>
<th>Nombre del consejos comunal</th>
<th>Eliminar</th>
</tr>
<?php
$sql4="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion,i.idintegrantes_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='mujer' and ci.idgestion_social='$id' order by ci.tipo asc";
$ver = $base->extraer($sql4);
while($fila = $ver->fetch_array()){
?>
<tr>
<td id='idcomuna'><?php echo $idgestion_social;?></td>
<td id="id"><?php echo $fila['idintegrantes_gestion'];?></td>
<td id="tipo"><?php echo "integrantes";?></td>
<td class="editable" data-campo="nombre"><span><?php echo $fila['nombre'];?></span></td>
<td class="editable" data-campo="apellido"><span><?php echo $fila['apellido'];?></span></td>
<td class="editable" data-campo="cedula"><span><?php echo $fila['cedula'];?></span></td>
<td class="editable" data-campo="tipo"><span><?php echo $fila['tipo'];?></span></td>
<td><?php echo $fila['nombre_gestion'];?></td>
<td>
	<button type="button" class="btn btn-danger glyphicon glyphicon-remove-sign" id="eliminarintegrantescomunas" title="Borrar"></button>
</td>
</tr>
<?php
}
$ver->close();
?>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2>Comite de Defensa y Seguridad Integral</h2></caption>
<tr>
<th id="idcomuna"></th>
<th id="id"></th>
<th id="tipo">tipo</th>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Tipo</th>
<th>Nombre del consejos comunal</th>
<th>Eliminar</th>
</tr>
<?php
$sql4="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion,i.idintegrantes_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='defensa y seguridad' and ci.idgestion_social='$id' order by ci.tipo asc";
$ver = $base->extraer($sql4);
while($fila = $ver->fetch_array()){
?>
<tr>
<td id='idcomuna'><?php echo $idgestion_social;?></td>
<td id="id"><?php echo $fila['idintegrantes_gestion'];?></td>
<td id="tipo"><?php echo "integrantes";?></td>
<td class="editable" data-campo="nombre"><span><?php echo $fila['nombre'];?></span></td>
<td class="editable" data-campo="apellido"><span><?php echo $fila['apellido'];?></span></td>
<td class="editable" data-campo="cedula"><span><?php echo $fila['cedula'];?></span></td>
<td class="editable" data-campo="tipo"><span><?php echo $fila['tipo'];?></span></td>
<td><?php echo $fila['nombre_gestion'];?></td>
<td>
	<button type="button" class="btn btn-danger glyphicon glyphicon-remove-sign" id="eliminarintegrantescomunas" title="Borrar"></button>
</td>
</tr>
<?php
}
$ver->close();
?>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2>Comite de Familia y proteccion de niños,niñas y Adolecentes</h2></caption>
<tr>
<th id="idcomuna"></th>
<th id="id"></th>
<th id="tipo">tipo</th>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Tipo</th>
<th>Nombre del consejos comunal</th>
<th>Eliminar</th>
</tr>
<?php
$sql4="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion,i.idintegrantes_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='familia' and ci.idgestion_social='$id' order by ci.tipo asc";
$ver = $base->extraer($sql4);
while($fila = $ver->fetch_array()){
?>
<tr>
<td id='idcomuna'><?php echo $idgestion_social;?></td>
<td id="id"><?php echo $fila['idintegrantes_gestion'];?></td>
<td id="tipo"><?php echo "integrantes";?></td>
<td class="editable" data-campo="nombre"><span><?php echo $fila['nombre'];?></span></td>
<td class="editable" data-campo="apellido"><span><?php echo $fila['apellido'];?></span></td>
<td class="editable" data-campo="cedula"><span><?php echo $fila['cedula'];?></span></td>
<td class="editable" data-campo="tipo"><span><?php echo $fila['tipo'];?></span></td>
<td><?php echo $fila['nombre_gestion'];?></td>
<td>
	<button type="button" class="btn btn-danger glyphicon glyphicon-remove-sign" id="eliminarintegrantescomunas" title="Borrar"></button>
</td>
</tr>
<?php
}
$ver->close();
?>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2>Comite de Recreacion y Deporte</h2></caption>
<tr>
<th id="idcomuna">Id</th>
<th id="id"></th>
<th id="tipo">tipo</th>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Tipo</th>
<th>Nombre del consejos comunal</th>
<th>Eliminar</th>
</tr>
<?php
$sql4="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion,i.idintegrantes_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='deporte' and ci.idgestion_social='$id' order by ci.tipo asc";
$ver = $base->extraer($sql4);
while($fila = $ver->fetch_array()){
?>
<tr>
<td id='idcomuna'><?php echo $idgestion_social;?></td>
<td id="id"><?php echo $fila['idintegrantes_gestion'];?></td>
<td id="tipo"><?php echo "integrantes";?></td>
<td class="editable" data-campo="nombre"><span><?php echo $fila['nombre'];?></span></td>
<td class="editable" data-campo="apellido"><span><?php echo $fila['apellido'];?></span></td>
<td class="editable" data-campo="cedula"><span><?php echo $fila['cedula'];?></span></td>
<td class="editable" data-campo="tipo"><span><?php echo $fila['tipo'];?></span></td>
<td><?php echo $fila['nombre_gestion'];?></td>
<td>
	<button type="button" class="btn btn-danger glyphicon glyphicon-remove-sign" id="eliminarintegrantescomunas" title="Borrar"></button>
</td>
</tr>
<?php
}
$ver->close();
?>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2>Comite de Educacion, Cultura y Formacion Socialista</h2></caption>
<tr>
<th id="idcomuna">Id</th>
<th id="id"></th>
<th id="tipo">tipo</th>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Tipo</th>
<th>Nombre del consejos comunal</th>
<th>Eliminar</th>
</tr>
<?php
$sql4="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion,i.idintegrantes_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='educacion' and ci.idgestion_social='$id' order by ci.tipo asc";
$ver = $base->extraer($sql4);
while($fila = $ver->fetch_array()){
?>
<tr>
<td id='idcomuna'><?php echo $fila['idintegrantes'];?></td>
<td id="id"><?php echo $fila['idintegrantes_gestion'];?></td>
<td id="tipo"><?php echo "integrantes";?></td>
<td class="editable" data-campo="nombre"><span><?php echo $fila['nombre'];?></span></td>
<td class="editable" data-campo="apellido"><span><?php echo $fila['apellido'];?></span></td>
<td class="editable" data-campo="cedula"><span><?php echo $fila['cedula'];?></span></td>
<td class="editable" data-campo="tipo"><span><?php echo $fila['tipo'];?></span></td>
<td><?php echo $fila['nombre_gestion'];?></td>
<td>
	<button type="button" class="btn btn-danger glyphicon glyphicon-remove-sign" id="eliminarintegrantescomunas" title="Borrar"></button>
</td>
</tr>
<?php
}
$ver->close();
?>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2>Consejo de Planificacion Comunal</h2></caption>
<tr>
<th id="idcomuna">Id</th>
<th id="id"></th>
<th id="tipo">tipo</th>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Tipo</th>
<th>Nombre del consejos comunal</th>
<th>Eliminar</th>
</tr>
<?php
$sql4="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion,i.idintegrantes_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='planificacion' and ci.idgestion_social='$id' order by ci.tipo asc";
$ver = $base->extraer($sql4);
while($fila = $ver->fetch_array()){
?>
<tr>
<td id='idcomuna'><?php echo $idgestion_social;?></td>
<td id="id"><?php echo $fila['idintegrantes_gestion'];?></td>
<td id="tipo"><?php echo "integrantes";?></td>
<td class="editable" data-campo="nombre"><span><?php echo $fila['nombre'];?></span></td>
<td class="editable" data-campo="apellido"><span><?php echo $fila['apellido'];?></span></td>
<td class="editable" data-campo="cedula"><span><?php echo $fila['cedula'];?></span></td>
<td class="editable" data-campo="tipo"><span><?php echo $fila['tipo'];?></span></td>
<td><?php echo $fila['nombre_gestion'];?></td>
<td>
	<button type="button" class="btn btn-danger glyphicon glyphicon-remove-sign" id="eliminarintegrantescomunas" title="Borrar"></button>
</td>
</tr>
<?php
}
$ver->close();
?>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2>Consejo de Economia Comunal</h2></caption>
<tr>
<th id="idcomuna">Id</th>
<th id="id"></th>
<th id="tipo">tipo</th>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Tipo</th>
<th>Nombre del consejos comunal</th>
<th>Eliminar</th>
</tr>
<?php
$sql4="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion,i.idintegrantes_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='economia comunal' and ci.idgestion_social='$id' order by ci.tipo asc";
$ver = $base->extraer($sql4);
while($fila = $ver->fetch_array()){
?>
<tr>
<td id='idcomuna'><?php echo $idgestion_social;?></td>
<td id="id"><?php echo $fila['idintegrantes_gestion'];?></td>
<td id="tipo"><?php echo "integrantes";?></td>
<td class="editable" data-campo="nombre"><span><?php echo $fila['nombre'];?></span></td>
<td class="editable" data-campo="apellido"><span><?php echo $fila['apellido'];?></span></td>
<td class="editable" data-campo="cedula"><span><?php echo $fila['cedula'];?></span></td>
<td class="editable" data-campo="tipo"><span><?php echo $fila['tipo'];?></span></td>
<td><?php echo $fila['nombre_gestion'];?></td>
<td>
	<button type="button" class="btn btn-danger glyphicon glyphicon-remove-sign" id="eliminarintegrantescomunas" title="Borrar"></button>
</td>
</tr>
<?php
}
$ver->close();
?>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2>Banco de la Comuna Coordinacion de Administracion</h2></caption>
<tr>
<th id="idcomuna"></th>
<th id="id"></th>
<th id="tipo">tipo</th>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Tipo</th>
<th>Nombre del consejos comunal</th>
<th>Eliminar</th>
</tr>
<?php
$sql4="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion,i.idintegrantes_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='administracion' and ci.idgestion_social='$id' order by ci.tipo asc";
$ver = $base->extraer($sql4);
while($fila = $ver->fetch_array()){
?>
<tr>
<td id='idcomuna'><?php echo $idgestion_social;?></td>
<td id="id"><?php echo $fila['idintegrantes_gestion'];?></td>
<td id="tipo"><?php echo "integrantes";?></td>
<td class="editable" data-campo="nombre"><span><?php echo $fila['nombre'];?></span></td>
<td class="editable" data-campo="apellido"><span><?php echo $fila['apellido'];?></span></td>
<td class="editable" data-campo="cedula"><span><?php echo $fila['cedula'];?></span></td>
<td class="editable" data-campo="tipo"><span><?php echo $fila['tipo'];?></span></td>
<td><?php echo $fila['nombre_gestion'];?></td>
<td>
	<button type="button" class="btn btn-danger glyphicon glyphicon-remove-sign" id="eliminarintegrantescomunas" title="Borrar"></button>
</td>
</tr>
<?php
}
$ver->close();
?>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2>Banco de la Comuna Comite de aprobacion</h2></caption>
<tr>
<th id="idcomuna">Id</th>
<th id="id"></th>
<th id="tipo">tipo</th>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Tipo</th>
<th>Nombre del consejos comunal</th>
<th>Eliminar</th>
</tr>
<?php
$sql4="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion,i.idintegrantes_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='aprobacion' and ci.idgestion_social='$id' order by ci.tipo asc";
$ver = $base->extraer($sql4);
while($fila = $ver->fetch_array()){
?>
<tr>
<td id='idcomuna'><?php echo $idgestion_social;?></td>
<td id="id"><?php echo $fila['idintegrantes_gestion'];?></td>
<td id="tipo"><?php echo "integrantes";?></td>
<td class="editable" data-campo="nombre"><span><?php echo $fila['nombre'];?></span></td>
<td class="editable" data-campo="apellido"><span><?php echo $fila['apellido'];?></span></td>
<td class="editable" data-campo="cedula"><span><?php echo $fila['cedula'];?></span></td>
<td class="editable" data-campo="tipo"><span><?php echo $fila['tipo'];?></span></td>
<td><?php echo $fila['nombre_gestion'];?></td>
<td>
	<button type="button" class="btn btn-danger glyphicon glyphicon-remove-sign" id="eliminarintegrantescomunas" title="Borrar"></button>
</td>
</tr>
<?php
}
$ver->close();
?>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2>Banco de la Comuna Comite de seguimiento y control</h2></caption>
<tr>
<th id="idcomuna">Id</th>
<th id="id"></th>
<th id="tipo">tipo</th>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Tipo</th>
<th>Nombre del consejos comunal</th>
<th>Eliminar</th>
</tr>
<?php
$sql4="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion,i.idintegrantes_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='seguimiento y control' and ci.idgestion_social='$id' order by ci.tipo asc";
$ver = $base->extraer($sql4);
while($fila = $ver->fetch_array()){
?>
<tr>
<td id='idcomuna'><?php echo $idgestion_social;?></td>
<td id="id"><?php echo $fila['idintegrantes_gestion'];?></td>
<td id="tipo"><?php echo "integrantes";?></td>
<td class="editable" data-campo="nombre"><span><?php echo $fila['nombre'];?></span></td>
<td class="editable" data-campo="apellido"><span><?php echo $fila['apellido'];?></span></td>
<td class="editable" data-campo="cedula"><span><?php echo $fila['cedula'];?></span></td>
<td class="editable" data-campo="tipo"><span><?php echo $fila['tipo'];?></span></td>
<td><?php echo $fila['nombre_gestion'];?></td>
<td>
	<button type="button" class="btn btn-danger glyphicon glyphicon-remove-sign" id="eliminarintegrantescomunas" title="Borrar"></button>
</td>
</tr>
<?php
}
$ver->close();
?>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2>Banco de la Comuna Comite de seguimiento y control por las organizaciones socio-productiva</h2></caption>
<tr>
<th id="idcomuna">Id</th>
<th id="id"></th>
<th id="tipo">tipo</th>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Tipo</th>
<th>Nombre del consejos comunal</th>
<th>Eliminar</th>
</tr>
<?php
$sql4="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion,i.idintegrantes_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='organizaciones socio productiva' and ci.idgestion_social='$id' order by ci.tipo asc";
$ver = $base->extraer($sql4);
while($fila = $ver->fetch_array()){
?>
<tr>
<td id='idcomuna'><?php echo $idgestion_social;?></td>
<td id="id"><?php echo $fila['idintegrantes_gestion'];?></td>
<td id="tipo"><?php echo "integrantes";?></td>
<td class="editable" data-campo="nombre"><span><?php echo $fila['nombre'];?></span></td>
<td class="editable" data-campo="apellido"><span><?php echo $fila['apellido'];?></span></td>
<td class="editable" data-campo="cedula"><span><?php echo $fila['cedula'];?></span></td>
<td class="editable" data-campo="tipo"><span><?php echo $fila['tipo'];?></span></td>
<td><?php echo $fila['nombre_gestion'];?></td>
<td>
	<button type="button" class="btn btn-danger glyphicon glyphicon-remove-sign" id="eliminarintegrantescomunas" title="Borrar"></button>
</td>
</tr>
<?php
}
$ver->close();
?>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2>Banco de la Comuna Comite de seguimiento y control designado por el parlamento comunal</h2></caption>
<tr>
<th id="idcomuna">Id</th>
<th id="id"></th>
<th id="tipo">tipo</th>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Tipo</th>
<th>Nombre del consejos comunal</th>
<th>Eliminar</th>
</tr>
<?php
$sql4="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion,i.idintegrantes_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='seguimiento y control del parlamento' and ci.idgestion_social='$id' order by ci.tipo asc";
$ver = $base->extraer($sql4);
while($fila = $ver->fetch_array()){
?>
<tr>
<td id='idcomuna'><?php echo $idgestion_social;?></td>
<td id="id"><?php echo $fila['idintegrantes_gestion'];?></td>
<td id="tipo"><?php echo "integrantes";?></td>
<td class="editable" data-campo="nombre"><span><?php echo $fila['nombre'];?></span></td>
<td class="editable" data-campo="apellido"><span><?php echo $fila['apellido'];?></span></td>
<td class="editable" data-campo="cedula"><span><?php echo $fila['cedula'];?></span></td>
<td class="editable" data-campo="tipo"><span><?php echo $fila['tipo'];?></span></td>
<td><?php echo $fila['nombre_gestion'];?></td>
<td>
	<button type="button" class="btn btn-danger glyphicon glyphicon-remove-sign" id="eliminarintegrantescomunas" title="Borrar"></button>
</td>
</tr>
<?php
}
$ver->close();
?>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2>Consejo de Contraloria Comunal</h2></caption>
<tr>
<th id="idcomuna">Id</th>
<th id="id"></th>
<th id="tipo">tipo</th>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Tipo</th>
<th>Nombre del consejos comunal</th>
<th>Eliminar</th>
</tr>
<?php
$sql4="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion,i.idintegrantes_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='contraloria' and ci.idgestion_social='$id' order by ci.tipo asc";
$ver = $base->extraer($sql4);
while($fila = $ver->fetch_array()){
?>
<tr>
<td id='idcomuna'><?php echo $idgestion_social;?></td>
<td id="id"><?php echo $fila['idintegrantes_gestion'];?></td>
<td id="tipo"><?php echo "integrantes";?></td>
<td class="editable" data-campo="nombre"><span><?php echo $fila['nombre'];?></span></td>
<td class="editable" data-campo="apellido"><span><?php echo $fila['apellido'];?></span></td>
<td class="editable" data-campo="cedula"><span><?php echo $fila['cedula'];?></span></td>
<td class="editable" data-campo="tipo"><span><?php echo $fila['tipo'];?></span></td>
<td><?php echo $fila['nombre_gestion'];?></td>
<td>
	<button type="button" class="btn btn-danger glyphicon glyphicon-remove-sign" id="eliminarintegrantescomunas" title="Borrar"></button>
</td>
</tr>
<?php
}
$ver->close();
$base->cerrar();
?>
</table>
</div>
<?php
//////////////////////----operador---//////////////////////////////
/////////////////////////   ///////////////////////////////
}else if($_SESSION['tipo']=="operador"){
require("../php/conexion.php");
$sqlver = "select fecha_vecimiento,estado from gestion_social where idgestion_social='$id' and tipo_gestion='comuna'";
$base=  new Conexion();
$base->conectar();
$datos = $base->extraer($sqlver);
while ($fila = $datos->fetch_array()){
$fechavencimiento = $fila['fecha_vecimiento'];
$estado=$fila['estado'];
}
if($estado=="activo"){
if(date("Y-m-d")>=$fechavencimiento){
$versql12="update gestion_social set estado='vencido' where idgestion_social='$id' and tipo_gestion='comuna'";
$base->actualizar2($versql12);
}
}else if($estado=="vencido"){
if(date("Y-m-d")<$fechavencimiento){
$versql12="update gestion_social set estado='activo' where idgestion_social='$id' and tipo_gestion='comuna'";
$base->actualizar2($versql12);
}
}
?>
<div id="mensajedatoscomunas"></div>
<input type="hidden" value="<?php echo $id;?>" id="idpdfcomunas">
<button class="btn btn-lg btn-danger" type="button" title="Generar PDF" id="generarpdfcomunas"><span class="glyphicon glyphicon-cloud-download"></span> Generar Pdf</button>
<?php
$sql="select * from gestion_social where idgestion_social='$id' and tipo_gestion='comuna'";

$datos = $base->extraer($sql);

while($fila = $datos->fetch_array()){
	$idgestion_social=$fila['idgestion_social'];
	$parroquia=$fila['parroquia'];
	$sede = $fila['sede'];
	$sector= $fila['sector'];
	$nombre_gestion=$fila['nombre_gestion'];
	$rif=$fila['rif'];
	$codigo_gestion=$fila['codigo_gestion'];
	$clave_gestion=$fila['clave_gestion'];
	$fecha_inicio= $fila['fecha_inicio'];
	$fecha_registro= $fila['fecha_registro'];
	$fecha_vencimiento= $fila['fecha_vecimiento'];
	$acta=$fila['acta'];
	$cedulas=$fila['cedulas'];
	$constancia=$fila['constancia'];
	$nomina = $fila['nomina'];
	$estado=$fila['estado'];
}
?>
<div class="table-responsive">
<table class="table">
<caption><h2>Direccion De Comuna</h2></caption>
<tr>
<thead>
<th id="id">id</th>
<th>Parroquia</th>
<th>sector</th>
<th>sede</th>
</thead>
</tr>
<tr>
<tbody>
<td id="id"><?php echo $idgestion_social;?></td>
<td id="tipo"><?php echo "comuna";?></td>
<td class="editable" data-campo="parroquia"><span><?php echo $parroquia;?></span></td>
<td class="editable" data-campo="sector"><span><?php echo $sector;?></span></td>
<td class="editable" data-campo="sede"><span><?php echo $sede;?></span></td>
</tbody>
</tr>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2>Datos De Comuna</h2></caption>
<tr>
<thead>
<th id="id">Id</th>
<th id="tipo">tipo</th>
<th>Nombre</th>
<th>Rif</th>
<th>Codigo</th>
<th>Clave</th>
</thead>
</tr>
<tr>
<tbody>
<td id="id"><?php echo $idgestion_social;?></td>
<td id="tipo"><?php echo "comuna";?></td>
<td class="editable" data-campo="nombre_gestion"><span><?php echo $nombre_gestion;?></span></td>
<td class="editable" data-campo="rif"><span><?php echo $rif;?></span></td>
<td><?php echo $codigo_gestion;?></td>
<td class="editable" data-campo="clave_gestion"><span><?php echo $clave_gestion;?></span></td>
</tbody>
</tr>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2>Fecha de Comuna</h2></caption>
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
<td id="tipo"><?php echo "comuna";?></td>
<td class="editable" data-campo="fecha_inicio"><span><?php echo $fecha_inicio;?></span></td>
<td class="editable" data-campo="fecha_registro"><span><?php echo $fecha_registro;?></span></td>
<td class="editable" data-campo="fecha_vencimiento"><span><?php echo $fecha_vencimiento;?></span></td>
<td><?php echo $estado;?></td>
</tbody>
</tr>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2>Anexo De Documentos</h2></caption>
<tr>
<thead>
<th id="id">id</th>
<th id="tipo">Tipo</th>
<th>Acta Constitutiva</th>
<th>Constancia de Eleccion</th>
<th>Cedulas de Integrantes</th>
<th>Certificado de Registro</th>
</thead>
</tr>
<tr>
<tbody>
<td id="id"><?php echo $idgestion_social;?></td>
<td id="tipo"><?php echo "documentos";?></td>
<td class="editable" data-campo="acta"><span><?php echo $acta;?></span></td>
<td class="editable" data-campo="constancia"><span><?php echo $constancia;?></span></td>
<td class="editable" data-campo="cedulas"><span><?php echo $cedulas;?></span></td>
<td class="editable" data-campo="registro"><span><?php echo $nomina;?></span></td>
</tbody>
</tr>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2>Consejos Comunales que la Integran</h2></caption>
<tr>
<thead>
<th id="idconsejocomuna"></th>
<th>Nombre del Consejo Comunal</th>
<th id="idconsejos"></th>
<th>Elegir</th>
</thead>
</tr>
<?php
$sqlver13="select gs.nombre_gestion,cc.idconsejoscomunas,cc.idconsejos from gestion_social gs inner join consejos_comunas cc on gs.idgestion_social=cc.idconsejos where gs.tipo_gestion='consejo' and cc.idgestion_social='$id' order by gs.nombre_gestion asc";
$datos13 = $base->extraer($sqlver13);
while($fila = $datos13->fetch_array()){
?>
<tr>
<tbody>
<td id="idconsejocomuna"><?php echo $fila['idconsejoscomunas'];?></td>
<td><?php echo $fila['nombre_gestion'];?></td>
<td id="idconsejos"><?php echo $fila['idconsejos'];?></td>
<td><button type="button" class="btn btn-success glyphicon glyphicon-ok-sign" id="elegirconsejos" title="Elegir"> Elegir</button></td>
</tbody>
</tr>
<?php
}
$datos13->close();
?>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2>Parlamento Comunal</h2></caption>
<tr>
<thead>
<th id="idcomuna"></th>
<th id="id"></th>
<th id="tipo">tipo</th>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Tipo</th>
<th>Nombre del consejos comunal</th>
</thead>
</tr>
<?php
$sql4="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion,i.idintegrantes_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='parlamento' and ci.idgestion_social='$id' order by ci.tipo asc";
$ver = $base->extraer($sql4);
while($fila = $ver->fetch_array()){
?>
<tr>
<tbody>
<td id='idcomuna'><?php echo $idgestion_social;?></td>
<td id="id"><?php echo $fila['idintegrantes_gestion'];?></td>
<td id="tipo"><?php echo "integrantes";?></td>
<td class="editable" data-campo="nombre"><span><?php echo $fila['nombre'];?></span></td>
<td class="editable" data-campo="apellido"><span><?php echo $fila['apellido'];?></span></td>
<td class="editable" data-campo="cedula"><span><?php echo $fila['cedula'];?></span></td>
<td class="editable" data-campo="tipo"><span><?php echo $fila['tipo'];?></span></td>
<td><?php echo $fila['nombre_gestion'];?></td>
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
<caption><h2>Consejo Ejecutivo</h2></caption>
<tr>
<thead>
<th id="idcomuna"></th>
<th id="id"></th>
<th id="tipo">tipo</th>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Tipo</th>
<th>Nombre del consejos comunal</th>
</thead>
</tr>
<?php
$sql5="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion,i.idintegrantes_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='ejecutivo' and ci.idgestion_social='$id' order by ci.tipo asc";
$ver = $base->extraer($sql5);
while($fila = $ver->fetch_array()){
?>
<tr>
<tbody>
<td id='idcomuna'><?php echo $idgestion_social;?></td>
<td id="id"><?php echo $fila['idintegrantes_gestion'];?></td>
<td id="tipo"><?php echo "integrantes";?></td>
<td class="editable" data-campo="nombre"><span><?php echo $fila['nombre'];?></span></td>
<td class="editable" data-campo="apellido"><span><?php echo $fila['apellido'];?></span></td>
<td class="editable" data-campo="cedula"><span><?php echo $fila['cedula'];?></span></td>
<td class="editable" data-campo="tipo"><span><?php echo $fila['tipo'];?></span></td>
<td><?php echo $fila['nombre_gestion']?></td>
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
<caption><h2>Comite de Derechos Humanos</h2></caption>
<tr>
<thead>
<th id="idcomuna"></th>
<th id="id"></th>
<th id="tipo">tipo</th>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Tipo</th>
<th>Nombre del consejos comunal</th>
</thead>
</tr>
<?php
$sql4="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion,i.idintegrantes_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='derechos humanos' and ci.idgestion_social='$id' order by ci.tipo asc";
$ver = $base->extraer($sql4);
while($fila = $ver->fetch_array()){
?>
<tr>
<tbody>
<td id='idcomuna'><?php echo $idgestion_social;?></td>
<td id="id"><?php echo $fila['idintegrantes_gestion'];?></td>
<td id="tipo"><?php echo "integrantes";?></td>
<td class="editable" data-campo="nombre"><span><?php echo $fila['nombre'];?></span></td>
<td class="editable" data-campo="apellido"><span><?php echo $fila['apellido'];?></span></td>
<td class="editable" data-campo="cedula"><span><?php echo $fila['cedula'];?></span></td>
<td class="editable" data-campo="tipo"><span><?php echo $fila['tipo'];?></span></td>
<td><?php echo $fila['nombre_gestion'];?></td>
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
<caption><h2>Comite de Salud</h2></caption>
<tr>
<thead>
<th id="idcomuna"></th>
<th id="id"></th>
<th id="tipo">tipo</th>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Tipo</th>
<th>Nombre del consejos comunal</th>
</thead>
</tr>
<?php
$sql4="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion,i.idintegrantes_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='comite salud' and ci.idgestion_social='$id' order by ci.tipo asc";
$ver = $base->extraer($sql4);
while($fila = $ver->fetch_array()){
?>
<tr>
<tbody>
<td id='idcomuna'><?php echo $idgestion_social;?></td>
<td id="id"><?php echo $fila['idintegrantes_gestion'];?></td>
<td id="tipo"><?php echo "integrantes";?></td>
<td class="editable" data-campo="nombre"><span><?php echo $fila['nombre'];?></span></td>
<td class="editable" data-campo="apellido"><span><?php echo $fila['apellido'];?></span></td>
<td class="editable" data-campo="cedula"><span><?php echo $fila['cedula'];?></span></td>
<td class="editable" data-campo="tipo"><span><?php echo $fila['tipo'];?></span></td>
<td><?php echo $fila['nombre_gestion'];?></td>
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
<caption><h2>Comite de Tierra Urbana,Vivienda y Habitat</h2></caption>
<tr>
<th id="idcomuna"></th>
<th id="id"></th>
<th id="tipo">tipo</th>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Tipo</th>
<th>Nombre del consejos comunal</th>
</tr>
<?php
$sql4="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion,i.idintegrantes_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='tierra' and ci.idgestion_social='$id' order by ci.tipo asc";
$ver = $base->extraer($sql4);
while($fila = $ver->fetch_array()){
?>
<tr>
<td id='idcomuna'><?php echo $idgestion_social;?></td>
<td id="id"><?php echo $fila['idintegrantes_gestion'];?></td>
<td id="tipo"><?php echo "integrantes";?></td>
<td classdpo="nombre"><span><?php echo $fila['nombre'];?></span></td>
<td class="editable" data-campo="apellido"><span><?php echo $fila['apellido'];?></span></td>
<td class="editable" data-campo="cedula"><span><?php echo $fila['cedula'];?></span></td>
<td class="editable" data-campo="tipo"><span><?php echo $fila['tipo'];?></span></td>
<td><?php echo $fila['nombre_gestion'];?></td>
</tr>
<?php
}
$ver->close();
?>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2>Comite de Defensa de las Personas en el Acceso de Bienes y Servicios</h2></caption>
<tr>
<th id="idcomuna"></th>
<th id="id"></th>
<th id="tipo">tipo</th>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Tipo</th>
<th>Nombre del consejos comunal</th>
</tr>
<?php
$sql4="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion,i.idintegrantes_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='bienes' and ci.idgestion_social='$id' order by ci.tipo asc";
$ver = $base->extraer($sql4);
while($fila = $ver->fetch_array()){
?>
<tr>
<td id='idcomuna'><?php echo $idgestion_social;?></td>
<td id="id"><?php echo $fila['idintegrantes_gestion'];?></td>
<td id="tipo"><?php echo "integrantes";?></td>
<td classdpo="nombre"><span><?php echo $fila['nombre'];?></span></td>
<td class="editable" data-campo="apellido"><span><?php echo $fila['apellido'];?></span></td>
<td class="editable" data-campo="cedula"><span><?php echo $fila['cedula'];?></span></td>
<td class="editable" data-campo="tipo"><span><?php echo $fila['tipo'];?></span></td>
<td><?php echo $fila['nombre_gestion'];?></td>
</tr>
<?php
}
$ver->close();
?>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2>Comite de Economia y Produccion Comunal</h2></caption>
<tr>
<th id="idcomuna"></th>
<th id="id"></th>
<th id="tipo">tipo</th>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Tipo</th>
<th>Nombre del consejos comunal</th>
</tr>
<?php
$sql4="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion,i.idintegrantes_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='econimia y produccion' and ci.idgestion_social='$id' order by ci.tipo asc";
$ver = $base->extraer($sql4);
while($fila = $ver->fetch_array()){
?>
<tr>
<td id='idcomuna'><?php echo $idgestion_social;?></td>
<td id="id"><?php echo $fila['idintegrantes_gestion'];?></td>
<td id="tipo"><?php echo "integrantes";?></td>
<td classdpo="nombre"><span><?php echo $fila['nombre'];?></span></td>
<td class="editable" data-campo="apellido"><span><?php echo $fila['apellido'];?></span></td>
<td class="editable" data-campo="cedula"><span><?php echo $fila['cedula'];?></span></td>
<td class="editable" data-campo="tipo"><span><?php echo $fila['tipo'];?></span></td>
<td><?php echo $fila['nombre_gestion'];?></td>
</tr>
<?php
}
$ver->close();
?>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2>Comite de la Mujer E Iguldad de Genero</h2></caption>
<tr>
<th id="idcomuna"></th>
<th id="id"></th>
<th id="tipo">tipo</th>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Tipo</th>
<th>Nombre del consejos comunal</th>
</tr>
<?php
$sql4="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion,i.idintegrantes_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='mujer' and ci.idgestion_social='$id' order by ci.tipo asc";
$ver = $base->extraer($sql4);
while($fila = $ver->fetch_array()){
?>
<tr>
<td id='idcomuna'><?php echo $idgestion_social;?></td>
<td id="id"><?php echo $fila['idintegrantes_gestion'];?></td>
<td id="tipo"><?php echo "integrantes";?></td>
<td classdpo="nombre"><span><?php echo $fila['nombre'];?></span></td>
<td class="editable" data-campo="apellido"><span><?php echo $fila['apellido'];?></span></td>
<td class="editable" data-campo="cedula"><span><?php echo $fila['cedula'];?></span></td>
<td class="editable" data-campo="tipo"><span><?php echo $fila['tipo'];?></span></td>
<td><?php echo $fila['nombre_gestion'];?></td>
</tr>
<?php
}
$ver->close();
?>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2>Comite de Defensa y Seguridad Integral</h2></caption>
<tr>
<th id="idcomuna"></th>
<th id="id"></th>
<th id="tipo">tipo</th>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Tipo</th>
<th>Nombre del consejos comunal</th>
</tr>
<?php
$sql4="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion,i.idintegrantes_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='defensa y seguridad' and ci.idgestion_social='$id' order by ci.tipo asc";
$ver = $base->extraer($sql4);
while($fila = $ver->fetch_array()){
?>
<tr>
<td id='idcomuna'><?php echo $idgestion_social;?></td>
<td id="id"><?php echo $fila['idintegrantes_gestion'];?></td>
<td id="tipo"><?php echo "integrantes";?></td>
<td classdpo="nombre"><span><?php echo $fila['nombre'];?></span></td>
<td class="editable" data-campo="apellido"><span><?php echo $fila['apellido'];?></span></td>
<td class="editable" data-campo="cedula"><span><?php echo $fila['cedula'];?></span></td>
<td class="editable" data-campo="tipo"><span><?php echo $fila['tipo'];?></span></td>
<td><?php echo $fila['nombre_gestion'];?></td>
</tr>
<?php
}
$ver->close();
?>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2>Comite de Familia y proteccion de niños,niñas y Adolecentes</h2></caption>
<tr>
<th id="idcomuna"></th>
<th id="id"></th>
<th id="tipo">tipo</th>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Tipo</th>
<th>Nombre del consejos comunal</th>
</tr>
<?php
$sql4="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion,i.idintegrantes_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='familia' and ci.idgestion_social='$id' order by ci.tipo asc";
$ver = $base->extraer($sql4);
while($fila = $ver->fetch_array()){
?>
<tr>
<td id='idcomuna'><?php echo $idgestion_social;?></td>
<td id="id"><?php echo $fila['idintegrantes_gestion'];?></td>
<td id="tipo"><?php echo "integrantes";?></td>
<td classdpo="nombre"><span><?php echo $fila['nombre'];?></span></td>
<td class="editable" data-campo="apellido"><span><?php echo $fila['apellido'];?></span></td>
<td class="editable" data-campo="cedula"><span><?php echo $fila['cedula'];?></span></td>
<td class="editable" data-campo="tipo"><span><?php echo $fila['tipo'];?></span></td>
<td><?php echo $fila['nombre_gestion'];?></td>
</tr>
<?php
}
$ver->close();
?>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2>Comite de Recreacion y Deporte</h2></caption>
<tr>
<th id="idcomuna"></th>
<th id="id"></th>
<th id="tipo">tipo</th>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Tipo</th>
<th>Nombre del consejos comunal</th>
</tr>
<?php
$sql4="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion,i.idintegrantes_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='deporte' and ci.idgestion_social='$id' order by ci.tipo asc";
$ver = $base->extraer($sql4);
while($fila = $ver->fetch_array()){
?>
<tr>
<td id='idcomuna'><?php echo $idgestion_social;?></td>
<td id="id"><?php echo $fila['idintegrantes_gestion'];?></td>
<td id="tipo"><?php echo "integrantes";?></td>
<td classdpo="nombre"><span><?php echo $fila['nombre'];?></span></td>
<td class="editable" data-campo="apellido"><span><?php echo $fila['apellido'];?></span></td>
<td class="editable" data-campo="cedula"><span><?php echo $fila['cedula'];?></span></td>
<td class="editable" data-campo="tipo"><span><?php echo $fila['tipo'];?></span></td>
<td><?php echo $fila['nombre_gestion'];?></td>
</tr>
<?php
}
$ver->close();
?>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2>Comite de Educacion, Cultura y Formacion Socialista</h2></caption>
<tr>
<th id="idcomuna"></th>
<th id="id"></th>
<th id="tipo">tipo</th>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Tipo</th>
<th>Nombre del consejos comunal</th>
</tr>
<?php
$sql4="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion,i.idintegrantes_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='educacion' and ci.idgestion_social='$id' order by ci.tipo asc";
$ver = $base->extraer($sql4);
while($fila = $ver->fetch_array()){
?>
<tr>
<td id='idcomuna'><?php echo $fila['idintegrantes'];?></td>
<td id="id"><?php echo $fila['idintegrantes_gestion'];?></td>
<td id="tipo"><?php echo "integrantes";?></td>
<td classdpo="nombre"><span><?php echo $fila['nombre'];?></span></td>
<td class="editable" data-campo="apellido"><span><?php echo $fila['apellido'];?></span></td>
<td class="editable" data-campo="cedula"><span><?php echo $fila['cedula'];?></span></td>
<td class="editable" data-campo="tipo"><span><?php echo $fila['tipo'];?></span></td>
<td><?php echo $fila['nombre_gestion'];?></td>
</tr>
<?php
}
$ver->close();
?>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2>Consejo de Planificacion Comunal</h2></caption>
<tr>
<th id="idcomuna"></th>
<th id="id"></th>
<th id="tipo">tipo</th>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Tipo</th>
<th>Nombre del consejos comunal</th>
</tr>
<?php
$sql4="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion,i.idintegrantes_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='planificacion' and ci.idgestion_social='$id' order by ci.tipo asc";
$ver = $base->extraer($sql4);
while($fila = $ver->fetch_array()){
?>
<tr>
<td id='idcomuna'><?php echo $idgestion_social;?></td>
<td id="id"><?php echo $fila['idintegrantes_gestion'];?></td>
<td id="tipo"><?php echo "integrantes";?></td>
<td classdpo="nombre"><span><?php echo $fila['nombre'];?></span></td>
<td class="editable" data-campo="apellido"><span><?php echo $fila['apellido'];?></span></td>
<td class="editable" data-campo="cedula"><span><?php echo $fila['cedula'];?></span></td>
<td class="editable" data-campo="tipo"><span><?php echo $fila['tipo'];?></span></td>
<td><?php echo $fila['nombre_gestion'];?></td>
</tr>
<?php
}
$ver->close();
?>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2>Consejo de Economia Comunal</h2></caption>
<tr>
<th id="idcomuna"></th>
<th id="id"></th>
<th id="tipo">tipo</th>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Tipo</th>
<th>Nombre del consejos comunal</th>
</tr>
<?php
$sql4="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion,i.idintegrantes_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='economia comunal' and ci.idgestion_social='$id' order by ci.tipo asc";
$ver = $base->extraer($sql4);
while($fila = $ver->fetch_array()){
?>
<tr>
<td id='idcomuna'><?php echo $idgestion_social;?></td>
<td id="id"><?php echo $fila['idintegrantes_gestion'];?></td>
<td id="tipo"><?php echo "integrantes";?></td>
<td classdpo="nombre"><span><?php echo $fila['nombre'];?></span></td>
<td class="editable" data-campo="apellido"><span><?php echo $fila['apellido'];?></span></td>
<td class="editable" data-campo="cedula"><span><?php echo $fila['cedula'];?></span></td>
<td class="editable" data-campo="tipo"><span><?php echo $fila['tipo'];?></span></td>
<td><?php echo $fila['nombre_gestion'];?></td>
</tr>
<?php
}
$ver->close();
?>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2>Banco de la Comuna Coordinacion de Administracion</h2></caption>
<tr>
<th id="idcomuna"></th>
<th id="id"></th>
<th id="tipo">tipo</th>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Tipo</th>
<th>Nombre del consejos comunal</th>
</tr>
<?php
$sql4="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion,i.idintegrantes_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='administracion' and ci.idgestion_social='$id' order by ci.tipo asc";
$ver = $base->extraer($sql4);
while($fila = $ver->fetch_array()){
?>
<tr>
<td id='idcomuna'><?php echo $idgestion_social;?></td>
<td id="id"><?php echo $fila['idintegrantes_gestion'];?></td>
<td id="tipo"><?php echo "integrantes";?></td>
<td classdpo="nombre"><span><?php echo $fila['nombre'];?></span></td>
<td class="editable" data-campo="apellido"><span><?php echo $fila['apellido'];?></span></td>
<td class="editable" data-campo="cedula"><span><?php echo $fila['cedula'];?></span></td>
<td class="editable" data-campo="tipo"><span><?php echo $fila['tipo'];?></span></td>
<td><?php echo $fila['nombre_gestion'];?></td>
</tr>
<?php
}
$ver->close();
?>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2>Banco de la Comuna Comite de aprobacion</h2></caption>
<tr>
<th id="idcomuna"></th>
<th id="id"></th>
<th id="tipo">tipo</th>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Tipo</th>
<th>Nombre del consejos comunal</th>
</tr>
<?php
$sql4="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion,i.idintegrantes_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='aprobacion' and ci.idgestion_social='$id' order by ci.tipo asc";
$ver = $base->extraer($sql4);
while($fila = $ver->fetch_array()){
?>
<tr>
<td id='idcomuna'><?php echo $idgestion_social;?></td>
<td id="id"><?php echo $fila['idintegrantes_gestion'];?></td>
<td id="tipo"><?php echo "integrantes";?></td>
<td classdpo="nombre"><span><?php echo $fila['nombre'];?></span></td>
<td class="editable" data-campo="apellido"><span><?php echo $fila['apellido'];?></span></td>
<td class="editable" data-campo="cedula"><span><?php echo $fila['cedula'];?></span></td>
<td class="editable" data-campo="tipo"><span><?php echo $fila['tipo'];?></span></td>
<td><?php echo $fila['nombre_gestion'];?></td>
</tr>
<?php
}
$ver->close();
?>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2>Banco de la Comuna Comite de seguimiento y control</h2></caption>
<tr>
<th id="idcomuna"></th>
<th id="id"></th>
<th id="tipo">tipo</th>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Tipo</th>
<th>Nombre del consejos comunal</th>
</tr>
<?php
$sql4="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion,i.idintegrantes_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='seguimiento y control' and ci.idgestion_social='$id' order by ci.tipo asc";
$ver = $base->extraer($sql4);
while($fila = $ver->fetch_array()){
?>
<tr>
<td id='idcomuna'><?php echo $idgestion_social;?></td>
<td id="id"><?php echo $fila['idintegrantes_gestion'];?></td>
<td id="tipo"><?php echo "integrantes";?></td>
<td classdpo="nombre"><span><?php echo $fila['nombre'];?></span></td>
<td class="editable" data-campo="apellido"><span><?php echo $fila['apellido'];?></span></td>
<td class="editable" data-campo="cedula"><span><?php echo $fila['cedula'];?></span></td>
<td class="editable" data-campo="tipo"><span><?php echo $fila['tipo'];?></span></td>
<td><?php echo $fila['nombre_gestion'];?></td>
</tr>
<?php
}
$ver->close();
?>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2>Banco de la Comuna Comite de seguimiento y control por las organizaciones socio-productiva</h2></caption>
<tr>
<th id="idcomuna"></th>
<th id="id"></th>
<th id="tipo">tipo</th>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Tipo</th>
<th>Nombre del consejos comunal</th>
</tr>
<?php
$sql4="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion,i.idintegrantes_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='organizaciones socio productiva' and ci.idgestion_social='$id' order by ci.tipo asc";
$ver = $base->extraer($sql4);
while($fila = $ver->fetch_array()){
?>
<tr>
<td id='idcomuna'><?php echo $idgestion_social;?></td>
<td id="id"><?php echo $fila['idintegrantes_gestion'];?></td>
<td id="tipo"><?php echo "integrantes";?></td>
<td classdpo="nombre"><span><?php echo $fila['nombre'];?></span></td>
<td class="editable" data-campo="apellido"><span><?php echo $fila['apellido'];?></span></td>
<td class="editable" data-campo="cedula"><span><?php echo $fila['cedula'];?></span></td>
<td class="editable" data-campo="tipo"><span><?php echo $fila['tipo'];?></span></td>
<td><?php echo $fila['nombre_gestion'];?></td>
</tr>
<?php
}
$ver->close();
?>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2>Banco de la Comuna Comite de seguimiento y control designado por el parlamento comunal</h2></caption>
<tr>
<th id="idcomuna"></th>
<th id="id"></th>
<th id="tipo">tipo</th>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Tipo</th>
<th>Nombre del consejos comunal</th>
</tr>
<?php
$sql4="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion,i.idintegrantes_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='seguimiento y control del parlamento' and ci.idgestion_social='$id' order by ci.tipo asc";
$ver = $base->extraer($sql4);
while($fila = $ver->fetch_array()){
?>
<tr>
<td id='idcomuna'><?php echo $idgestion_social;?></td>
<td id="id"><?php echo $fila['idintegrantes_gestion'];?></td>
<td id="tipo"><?php echo "integrantes";?></td>
<td classdpo="nombre"><span><?php echo $fila['nombre'];?></span></td>
<td class="editable" data-campo="apellido"><span><?php echo $fila['apellido'];?></span></td>
<td class="editable" data-campo="cedula"><span><?php echo $fila['cedula'];?></span></td>
<td class="editable" data-campo="tipo"><span><?php echo $fila['tipo'];?></span></td>
<td><?php echo $fila['nombre_gestion'];?></td>
</tr>
<?php
}
$ver->close();
?>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2>Consejo de Contraloria Comunal</h2></caption>
<tr>
<th id="idcomuna"></th>
<th id="id"></th>
<th id="tipo">tipo</th>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Tipo</th>
<th>Nombre del consejos comunal</th>
</tr>
<?php
$sql4="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion,i.idintegrantes_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='contraloria' and ci.idgestion_social='$id' order by ci.tipo asc";
$ver = $base->extraer($sql4);
while($fila = $ver->fetch_array()){
?>
<tr>
<td id='idcomuna'><?php echo $idgestion_social;?></td>
<td id="id"><?php echo $fila['idintegrantes_gestion'];?></td>
<td id="tipo"><?php echo "integrantes";?></td>
<td classdpo="nombre"><span><?php echo $fila['nombre'];?></span></td>
<td class="editable" data-campo="apellido"><span><?php echo $fila['apellido'];?></span></td>
<td class="editable" data-campo="cedula"><span><?php echo $fila['cedula'];?></span></td>
<td class="editable" data-campo="tipo"><span><?php echo $fila['tipo'];?></span></td>
<td><?php echo $fila['nombre_gestion'];?></td>
</tr>
</table>
</div>
<?php
}
$ver->close();
$base->cerrar();
?>

<?php
	////////////////////----concejal---///////////////////////

}else if($_SESSION['tipo']=="concejal"){

require("../php/conexion.php");
$base = new Conexion();
$base->conectar();
?>
<input type="hidden" value="<?php echo $id;?>" id="idpdfcomunas">
<button class="btn btn-lg btn-danger" type="button" title="Generar PDF" id="generarpdfcomunas"><span class="glyphicon glyphicon-cloud-download"></span> Generar Pdf</button>
<?php
$sql="select * from gestion_social where idgestion_social='$id' and tipo_gestion='comuna'";

$datos = $base->extraer($sql);

while($fila = $datos->fetch_array()){
	$idgestion_social=$fila['idgestion_social'];
	$parroquia=$fila['parroquia'];
	$sede = $fila['sede'];
	$sector= $fila['sector'];
	$nombre_gestion=$fila['nombre_gestion'];
	$rif=$fila['rif'];
	$codigo_gestion=$fila['codigo_gestion'];
	$clave_gestion=$fila['clave_gestion'];
	$fecha_inicio= $fila['fecha_inicio'];
	$fecha_registro= $fila['fecha_registro'];
	$fecha_vencimiento= $fila['fecha_vecimiento'];
	$acta=$fila['acta'];
	$cedulas=$fila['cedulas'];
	$constancia=$fila['constancia'];
	$nomina = $fila['nomina'];
	$estado=$fila['estado'];
}
?>
<div class="table-responsive">
<table class="table">
<caption><h2>Direccion De Comuna</h2></caption>
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
</div>
<div class="table-responsive">
<table class="table">
<caption><h2>Datos De Comuna</h2></caption>
<tr>
<thead>
<th>Nombre</th>
<th>Rif</th>
<th>Codigo</th>
</thead>
</tr>
<tr>
<tbody>
<td><?php echo $nombre_gestion;?></td>
<td><?php echo $rif;?></td>
<td><?php echo $codigo_gestion;?></td>
</tbody>
</tr>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2>Fecha de Comuna</h2></caption>
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
<caption><h2>Anexo De Documentos</h2></caption>
<tr>
<thead>
<th>Acta Constitutiva</th>
<th>Constancia de Eleccion</th>
<th>Cedulas de Integrantes</th>
<th>Certificado de Registro</th>
</thead>
</tr>
<tr>
<tbody>
<td><?php echo $acta;?></td>
<td><?php echo $constancia;?></td>
<td><?php echo $cedulas;?></td>
<td><?php echo $nomina;?></td>
</tbody>
</tr>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2>Consejos Comunales que la Integran</h2></caption>
<tr>
<thead>
<th id="idconsejocomuna"></th>
<th>Nombre del Consejo Comunal</th>
<th id="idconsejos"></th>
<th>Elegir</th>
</thead>
</tr>
<?php
$sqlver13="select gs.nombre_gestion,cc.idconsejoscomunas,cc.idconsejos from gestion_social gs inner join consejos_comunas cc on gs.idgestion_social=cc.idconsejos where gs.tipo_gestion='consejo' and cc.idgestion_social='$id' order by gs.nombre_gestion asc";
$datos13 = $base->extraer($sqlver13);
while($fila = $datos13->fetch_array()){
?>
<tr>
<tbody>
<td id="idconsejocomuna"><?php echo $fila['idconsejoscomunas'];?></td>
<td><?php echo $fila['nombre_gestion'];?></td>
<td id="idconsejos"><?php echo $fila['idconsejos'];?></td>
<td><button type="button" class="btn btn-success glyphicon glyphicon-ok-sign" id="elegirconsejos" title="Elegir"> Elegir</button></td>
</tbody>
</tr>
<?php
}
$datos13->close();
?>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2>Parlamento Comunal</h2></caption>
<tr>
<thead>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Tipo</th>
<th>Nombre del consejos comunal</th>
</thead>
</tr>
<?php
$sql4="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion,i.idintegrantes_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='parlamento' and ci.idgestion_social='$id' order by ci.tipo asc";
$ver = $base->extraer($sql4);
while($fila = $ver->fetch_array()){
?>
<tr>
<tbody>
<td><?php echo $fila['nombre'];?></td>
<td><?php echo $fila['apellido'];?></td>
<td><?php echo $fila['cedula'];?></td>
<td><?php echo $fila['tipo'];?></td>
<td><?php echo $fila['nombre_gestion'];?></td>
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
<caption><h2>Consejo Ejecutivo</h2></caption>
<tr>
<thead>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Tipo</th>
<th>Nombre del consejos comunal</th>
</thead>
</tr>
<?php

$sql5="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion,i.idintegrantes_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='ejecutivo' and ci.idgestion_social='$id' order by ci.tipo asc";
$ver = $base->extraer($sql5);
while($fila = $ver->fetch_array()){
?>
<tr>
<tbody>
<td><?php echo $fila['nombre'];?></td>
<td><?php echo $fila['apellido'];?></td>
<td><?php echo $fila['cedula'];?></td>
<td><?php echo $fila['tipo'];?></td>
<td><?php echo $fila['nombre_gestion']?></td>
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
<caption><h2>Comite de Derechos Humanos</h2></caption>
<tr>
<thead>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Tipo</th>
<th>Nombre del consejos comunal</th>
</thead>
</tr>
<?php

$sql4="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion,i.idintegrantes_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='derechos humanos' and ci.idgestion_social='$id' order by ci.tipo asc";
$ver = $base->extraer($sql4);
while($fila = $ver->fetch_array()){
?>
<tr>
<tbody>
<td><?php echo $fila['nombre'];?></td>
<td><?php echo $fila['apellido'];?></td>
<td><?php echo $fila['cedula'];?></td>
<td><?php echo $fila['tipo'];?></td>
<td><?php echo $fila['nombre_gestion'];?></td>
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
<caption><h2>Comite de Salud</h2></caption>
<tr>
<thead>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Tipo</th>
<th>Nombre del consejos comunal</th>
</thead>
</tr>
<?php
$sql4="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion,i.idintegrantes_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='comite salud' and ci.idgestion_social='$id' order by ci.tipo asc";
$ver = $base->extraer($sql4);
while($fila = $ver->fetch_array()){
?>
<tr>
<tbody>
<td><?php echo $fila['nombre'];?></td>
<td><?php echo $fila['apellido'];?></td>
<td><?php echo $fila['cedula'];?></td>
<td><?php echo $fila['tipo'];?></td>
<td><?php echo $fila['nombre_gestion'];?></td>
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
<caption><h2>Comite de Tierra Urbana,Vivienda y Habitat</h2></caption>
<tr>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Tipo</th>
<th>Nombre del consejos comunal</th>
</tr>
<?php
$sql4="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion,i.idintegrantes_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='tierra' and ci.idgestion_social='$id' order by ci.tipo asc";
$ver = $base->extraer($sql4);
while($fila = $ver->fetch_array()){
?>
<tr>
<td><?php echo $fila['nombre'];?></td>
<td><?php echo $fila['apellido'];?></td>
<td><?php echo $fila['cedula'];?></td>
<td><?php echo $fila['tipo'];?></td>
<td><?php echo $fila['nombre_gestion'];?></td>
</tr>
<?php
}
$ver->close();
?>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2>Comite de Defensa de las Personas en el Acceso de Bienes y Servicios</h2></caption>
<tr>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Tipo</th>
<th>Nombre del consejos comunal</th>
</tr>
<?php
$sql4="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion,i.idintegrantes_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='bienes' and ci.idgestion_social='$id' order by ci.tipo asc";
$ver = $base->extraer($sql4);
while($fila = $ver->fetch_array()){
?>
<tr>
<td><?php echo $fila['nombre'];?></td>
<td><?php echo $fila['apellido'];?></td>
<td><?php echo $fila['cedula'];?></td>
<td><?php echo $fila['tipo'];?></td>
<td><?php echo $fila['nombre_gestion'];?></td>
</tr>
<?php
}
$ver->close();
?>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2>Comite de Economia y Produccion Comunal</h2></caption>
<tr>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Tipo</th>
<th>Nombre del consejos comunal</th>
</tr>
<?php
$sql4="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion,i.idintegrantes_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='econimia y produccion' and ci.idgestion_social='$id' order by ci.tipo asc";
$ver = $base->extraer($sql4);
while($fila = $ver->fetch_array()){
?>
<tr>
<td><?php echo $fila['nombre'];?></td>
<td><?php echo $fila['apellido'];?></td>
<td><?php echo $fila['cedula'];?></td>
<td><?php echo $fila['tipo'];?></td>
<td><?php echo $fila['nombre_gestion'];?></td>
</tr>
<?php
}
$ver->close();
?>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2>Comite de la Mujer E Iguldad de Genero</h2></caption>
<tr>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Tipo</th>
<th>Nombre del consejos comunal</th>
</tr>
<?php
$sql4="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion,i.idintegrantes_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='mujer' and ci.idgestion_social='$id' order by ci.tipo asc";
$ver = $base->extraer($sql4);
while($fila = $ver->fetch_array()){
?>
<tr>
<td><?php echo $fila['nombre'];?></td>
<td><?php echo $fila['apellido'];?></td>
<td><?php echo $fila['cedula'];?></td>
<td><?php echo $fila['tipo'];?></td>
<td><?php echo $fila['nombre_gestion'];?></td>
</tr>
<?php
}
$ver->close();
?>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2>Comite de Defensa y Seguridad Integral</h2></caption>
<tr>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Tipo</th>
<th>Nombre del consejos comunal</th>
</tr>
<?php
$sql4="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion,i.idintegrantes_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='defensa y seguridad' and ci.idgestion_social='$id' order by ci.tipo asc";
$ver = $base->extraer($sql4);
while($fila = $ver->fetch_array()){
?>
<tr>
<td><?php echo $fila['nombre'];?></td>
<td><?php echo $fila['apellido'];?></td>
<td><?php echo $fila['cedula'];?></td>
<td><?php echo $fila['tipo'];?></td>
<td><?php echo $fila['nombre_gestion'];?></td>
</tr>
<?php
}
$ver->close();
?>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2>Comite de Familia y proteccion de niños,niñas y Adolecentes</h2></caption>
<tr>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Tipo</th>
<th>Nombre del consejos comunal</th>
</tr>
<?php
$sql4="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion,i.idintegrantes_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='familia' and ci.idgestion_social='$id' order by ci.tipo asc";
$ver = $base->extraer($sql4);
while($fila = $ver->fetch_array()){
?>
<tr>
<td><?php echo $fila['nombre'];?></td>
<td><?php echo $fila['apellido'];?></td>
<td><?php echo $fila['cedula'];?></td>
<td><?php echo $fila['tipo'];?></td>
<td><?php echo $fila['nombre_gestion'];?></td>
</tr>
<?php
}
$ver->close();
?>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2>Comite de Recreacion y Deporte</h2></caption>
<tr>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Tipo</th>
<th>Nombre del consejos comunal</th>
</tr>
<?php
$sql4="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion,i.idintegrantes_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='deporte' and ci.idgestion_social='$id' order by ci.tipo asc";
$ver = $base->extraer($sql4);
while($fila = $ver->fetch_array()){
?>
<tr>
<td><?php echo $fila['nombre'];?></td>
<td><?php echo $fila['apellido'];?></td>
<td><?php echo $fila['cedula'];?></td>
<td><?php echo $fila['tipo'];?></td>
<td><?php echo $fila['nombre_gestion'];?></td>
</tr>
<?php
}
$ver->close();
?>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2>Comite de Educacion, Cultura y Formacion Socialista</h2></caption>
<tr>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Tipo</th>
<th>Nombre del consejos comunal</th>
</tr>
<?php
$sql4="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion,i.idintegrantes_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='educacion' and ci.idgestion_social='$id' order by ci.tipo asc";
$ver = $base->extraer($sql4);
while($fila = $ver->fetch_array()){
?>
<tr>
<td><?php echo $fila['nombre'];?></td>
<td><?php echo $fila['apellido'];?></td>
<td><?php echo $fila['cedula'];?></td>
<td><?php echo $fila['tipo'];?></td>
<td><?php echo $fila['nombre_gestion'];?></td>
</tr>
<?php
}
$ver->close();
?>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2>Consejo de Planificacion Comunal</h2></caption>
<tr>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Tipo</th>
<th>Nombre del consejos comunal</th>
</tr>
<?php
$sql4="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion,i.idintegrantes_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='planificacion' and ci.idgestion_social='$id' order by ci.tipo asc";
$ver = $base->extraer($sql4);
while($fila = $ver->fetch_array()){
?>
<tr>
<td><?php echo $fila['nombre'];?></td>
<td><?php echo $fila['apellido'];?></td>
<td><?php echo $fila['cedula'];?></td>
<td><?php echo $fila['tipo'];?></td>
<td><?php echo $fila['nombre_gestion'];?></td>
</tr>
<?php
}
$ver->close();
?>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2>Consejo de Economia Comunal</h2></caption>
<tr>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Tipo</th>
<th>Nombre del consejos comunal</th>
</tr>
<?php
$sql4="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion,i.idintegrantes_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='economia comunal' and ci.idgestion_social='$id' order by ci.tipo asc";
$ver = $base->extraer($sql4);
while($fila = $ver->fetch_array()){
?>
<tr>
<td><?php echo $fila['nombre'];?></td>
<td><?php echo $fila['apellido'];?></td>
<td><?php echo $fila['cedula'];?></td>
<td><?php echo $fila['tipo'];?></td>
<td><?php echo $fila['nombre_gestion'];?></td>
</tr>
<?php
}
$ver->close();
?>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2>Banco de la Comuna Coordinacion de Administracion</h2></caption>
<tr>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Tipo</th>
<th>Nombre del consejos comunal</th>
</tr>
<?php
$sql4="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion,i.idintegrantes_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='administracion' and ci.idgestion_social='$id' order by ci.tipo asc";
$ver = $base->extraer($sql4);
while($fila = $ver->fetch_array()){
?>
<tr>
<td><?php echo $fila['nombre'];?></td>
<td><?php echo $fila['apellido'];?></td>
<td><?php echo $fila['cedula'];?></td>
<td><?php echo $fila['tipo'];?></td>
<td><?php echo $fila['nombre_gestion'];?></td>
</tr>
<?php
}
$ver->close();
?>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2>Banco de la Comuna Comite de aprobacion</h2></caption>
<tr>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Tipo</th>
<th>Nombre del consejos comunal</th>
</tr>
<?php
$sql4="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion,i.idintegrantes_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='aprobacion' and ci.idgestion_social='$id' order by ci.tipo asc";
$ver = $base->extraer($sql4);
while($fila = $ver->fetch_array()){
?>
<tr>
<td><?php echo $fila['nombre'];?></td>
<td><?php echo $fila['apellido'];?></td>
<td><?php echo $fila['cedula'];?></td>
<td><?php echo $fila['tipo'];?></td>
<td><?php echo $fila['nombre_gestion'];?></td>
</tr>
<?php
}
$ver->close();
?>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2>Banco de la Comuna Comite de seguimiento y control</h2></caption>
<tr>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Tipo</th>
<th>Nombre del consejos comunal</th>
</tr>
<?php
$sql4="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion,i.idintegrantes_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='seguimiento y control' and ci.idgestion_social='$id' order by ci.tipo asc";
$ver = $base->extraer($sql4);
while($fila = $ver->fetch_array()){
?>
<tr>
<td><?php echo $fila['nombre'];?></td>
<td><?php echo $fila['apellido'];?></td>
<td><?php echo $fila['cedula'];?></td>
<td><?php echo $fila['tipo'];?></td>
<td><?php echo $fila['nombre_gestion'];?></td>
</tr>
<?php
}
$ver->close();
?>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2>Banco de la Comuna Comite de seguimiento y control por las organizaciones socio-productiva</h2></caption>
<tr>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Tipo</th>
<th>Nombre del consejos comunal</th>
</tr>
<?php
$sql4="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion,i.idintegrantes_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='organizaciones socio productiva' and ci.idgestion_social='$id' order by ci.tipo asc";
$ver = $base->extraer($sql4);
while($fila = $ver->fetch_array()){
?>
<tr>
<td><?php echo $fila['nombre'];?></td>
<td><?php echo $fila['apellido'];?></td>
<td><?php echo $fila['cedula'];?></td>
<td><?php echo $fila['tipo'];?></td>
<td><?php echo $fila['nombre_gestion'];?></td>
</tr>
<?php
}
$ver->close();
?>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2>Banco de la Comuna Comite de seguimiento y control designado por el parlamento comunal</h2></caption>
<tr>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Tipo</th>
<th>Nombre del consejos comunal</th>
</tr>
<?php
$sql4="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion,i.idintegrantes_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='seguimiento y control del parlamento' and ci.idgestion_social='$id' order by ci.tipo asc";
$ver = $base->extraer($sql4);
while($fila = $ver->fetch_array()){
?>
<tr>
<td><?php echo $fila['nombre'];?></td>
<td><?php echo $fila['apellido'];?></td>
<td><?php echo $fila['cedula'];?></td>
<td><?php echo $fila['tipo'];?></td>
<td><?php echo $fila['nombre_gestion'];?></td>
</tr>
<?php
}
$ver->close();
?>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2>Consejo de Contraloria Comunal</h2></caption>
<tr>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Tipo</th>
<th>Nombre del consejos comunal</th>
</tr>
<?php
$sql4="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion,i.idintegrantes_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='contraloria' and ci.idgestion_social='$id' order by ci.tipo asc";
$ver = $base->extraer($sql4);
while($fila = $ver->fetch_array()){
?>
<tr>
<td><?php echo $fila['nombre'];?></td>
<td><?php echo $fila['apellido'];?></td>
<td><?php echo $fila['cedula'];?></td>
<td><?php echo $fila['tipo'];?></td>
<td><?php echo $fila['nombre_gestion'];?></td>
</tr>
</table>
</div>
<?php
}
$ver->close();
$base->cerrar();
}
?>
<script src="../javascript/obtenerdatosdecomunas.js"></script>
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
