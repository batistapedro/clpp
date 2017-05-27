<?php
session_start();
if(isset($_POST['id']) && !empty($_POST['id']) && isset($_POST['tipo'])&& !empty($_POST['tipo'])){
$id= intval(trim(htmlspecialchars($_POST['id'])));
$tipo = trim(htmlspecialchars($_POST['tipo']));
?>
<html>
<head>

<style type="text/css">
.id,#id,.idmovimiento,#idconsejocomuna,#idconsejos{
display:none;
}
.table{
		border-radius: 7px;
		border:1px solid silver;
		box-shadow: 0px 0px 12px rgba(0,0,0,0.5);
		padding: 0px;
		width: 100%;
	}
	th{
		background-color:#d9534f;
		color: white;
	}
	td{
		vertical-align: middle;
		text-align: left;
	}
	h2{
		text-align: center;
	}
</style>
<!--<link rel="stylesheet" type="text/css" href="../css/gestionsocialdatos.css">-->

</head>
<body>
<?php
if($tipo=="comunas"){
require("../php/conexion.php");
$base = new Conexion();
$base->conectar();
?>
<input type="hidden" value="<?php echo $id;?>" id="idpdfcomunas">
<button class="btn btn-lg btn-danger" id="generarpdfcomunas" type="button" title="Generar PDF"><span class="glyphicon glyphicon-cloud-download"></span> Generar Pdf</button>
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
<caption><h2>Direccion De la Comuna</h2></caption>
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
<th>Nombre del Consejo Comunal</th>
<th id="idconsejos"></th>
<th>Elegir</th>
</thead>
</tr>
<?php
$sqlver13="select gs.nombre_gestion,cc.idconsejos from gestion_social gs inner join consejos_comunas cc on gs.idgestion_social=cc.idconsejos where gs.tipo_gestion='consejo' and cc.idgestion_social='$id' order by gs.nombre_gestion asc";
$datos13 = $base->extraer($sqlver13);
while($fila = $datos13->fetch_array()){
?>
<tr>
<tbody>
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

}else if($tipo=="consejos"){
require("../php/conexion.php");
$base = new Conexion();
$base->conectar();
?>
<input type="hidden" value="<?php echo $id;?>" id="idpdfconsejos">
<button type="button" class="btn btn-lg btn-danger" id="generarpdfconsejos" title="Generar PDF"><span class="glyphicon glyphicon-cloud-download"></span> Generar Pdf</button>
<?php
$sql="select * from gestion_social where idgestion_social='$id' and tipo_gestion='consejo'";
$datos = $base->extraer($sql);

while($fila = $datos->fetch_array()){
$parroquia=$fila['parroquia'];
$sede = $fila['sede'];
$sector= $fila['sector'];
$nombre_gestion=$fila['nombre_gestion'];
$rif=$fila['rif'];
$codigo_gestion=$fila['codigo_gestion'];
$fecha_inicio= $fila['fecha_inicio'];
$fecha_registro= $fila['fecha_registro'];
$fecha_vencimiento= $fila['fecha_vecimiento'];
$acta=$fila['acta'];
$cedulas=$fila['cedulas'];
$constancia=$fila['constancia'];
$nomina = $fila['nomina'];
$estado=$fila['estado'];
}
$datos->close();
?>
<div class="table-responsive">
<table class="table">
<caption><h2 class="text-center">Direccion Del Consejo comunal</h2></caption>
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
<caption><h2 class="text-center">Datos Del Consejo</h2></caption>
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
<caption><h2 class="text-center">Fecha de Consejos</h2></caption>
<tr>
<thead>
<th>Fecha de Registro</th>
<th>Fecha de Adecuacion</th>
<th>Fecha de Vencimiento</th>
<th>Estado</th>
</thead>
</tr>
<tr>
<thead>
<td><?php echo $fecha_inicio;?></td>
<td><?php echo $fecha_registro;?></td>
<td><?php echo $fecha_vencimiento;?></td>
<td><?php echo $estado;?></td>
</thead>
</tr>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2 class="text-center">Anexo De Documentos</h2></caption>
<tr>
<thead>
<th>Acta Constitutiva</th>
<th>Certificado de Registro</th>
<th>Cedulas de Integrantes</th>
<th>Nomina Actualizada</th>
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
<?php
$datos->close();
?>
</table>
</div>
<div class="table-responsive">
<table class="table">
<caption><h2 class="text-center">Unidad Administrativa y Financiera<h2></caption>
<tr>
<thead>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Telefono</th>
<th>tipo</th>
</thead>
</tr>
<?php
$sql4="select i.nombre, i.apellido,i.cedula,i.telefono,ci.cargo,ci.tipo,ci.unidad from integrantes_gestion i inner join cargo_integrantes_gestion ci on i.idintegrantes_gestion=ci.idintegrantes_gestion where i.consejo=1 and ci.idgestion_social='$id' and ci.unidad='administrativa' order by ci.tipo asc";
$ver = $base->extraer($sql4);
while($fila = $ver->fetch_array()){
?>
<tr>
<tbody>
<td><?php echo $fila['nombre'];?></td>
<td><?php echo $fila['apellido'];?></td>
<td><?php echo $fila['cedula'];?></td>
<td><?php echo $fila['telefono'];?></td>
<td><?php echo $fila['tipo'];?></td>
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
<caption><h2 class="text-center">Unidad de Contraloria Social<h2></caption>
<tr>
<thead>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Telefono</th>
<th>tipo</th>
</thead>
</tr>
<?php
$sql5="select i.nombre, i.apellido,i.cedula,i.telefono,ci.cargo,ci.tipo,ci.unidad from integrantes_gestion i inner join cargo_integrantes_gestion ci on i.idintegrantes_gestion=ci.idintegrantes_gestion where i.consejo=1 and ci.idgestion_social='$id' and ci.unidad='contraloria' order by ci.tipo asc";
$ver = $base->extraer($sql5);
while($fila = $ver->fetch_array()){
?>
<tr>
<tbody>
<td><?php echo $fila['nombre'];?></td>
<td><?php echo $fila['apellido'];?></td>
<td><?php echo $fila['cedula'];?></td>
<td><?php echo $fila['telefono'];?></td>
<td><?php echo $fila['tipo'];?></td>
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
<caption><h2 class="text-center">Unidad Ejecutiva<h2></caption>
<tr>
<thead>
<th>Nombre</th>
<th>Apellido</th>
<th>Cedula</th>
<th>Telefono</th>
<th>Voceria</th>
<th>Tipo</th>
</thead>

</tr>
<?php
$sql6="select i.nombre, i.apellido,i.cedula,i.telefono,ci.cargo,ci.tipo,ci.unidad from integrantes_gestion i inner join cargo_integrantes_gestion ci on i.idintegrantes_gestion=ci.idintegrantes_gestion where i.consejo=1 and ci.idgestion_social='$id' and ci.unidad='ejecutiva' order by ci.tipo asc";
$ver = $base->extraer($sql6);
while($fila = $ver->fetch_array()){
?>
<tr>
<tbody>
<td><?php echo $fila['nombre'];?></td>
<td><?php echo $fila['apellido'];?></td>
<td><?php echo $fila['cedula'];?></td>
<td><?php echo $fila['telefono'];?></td>
<td><?php echo $fila['cargo']?></td>
<td><?php echo $fila['tipo'];?></td>
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
}else if($tipo=="movimientos"){
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
</div>
<div class="table-responsive">
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
</body>
</html>
<?php
}
?>
</body>

<script src="../jquery/jquery.js"></script>
<script src="../javascript/gestionsocialdatos.js"> </script>
</html>
<?php
}else{
echo "<h3>Error en datos</h3>";
}
?>
