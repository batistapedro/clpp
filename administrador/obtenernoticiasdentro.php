<?php
session_start();
if(isset($_SESSION['tipo'])){
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="../css/obtenernoticiasdentro.css">
<head>
<body>

<?php
$limite = intval(trim(htmlspecialchars($_POST['limite'])));
require("../php/conexion.php");
if($_SESSION['tipo']=="administrador"||($_SESSION['tipo']=="operador")){
$con = new Conexion();
$con->conectar();

$sqlver ="select id from noticias";

$result = $con->extraer($sqlver);
$total = $result->num_rows;
 
$sql="select id,fecha,titulo,direccion from noticias order by id desc limit $limite,10";
$resultado = $con->extraer($sql); 
?>
<div id="obtenernoticiasprincipal">
<h1 id="cabeceranoticias">Noticias</h1>

<?php
if($resultado->num_rows>0){
while($nnoticia= $resultado->fetch_array()){
?>
<div id="btdn">
<button type="button" class="eliminarnoticias btn btn-danger" value="<?php echo $nnoticia['id'];?>" title="Eliminar Noticia"><span class="glyphicon glyphicon-remove-sign"></span> Eliminar</button>  
<button type="button" class="editarnoticias btn btn-success" value="<?php echo $nnoticia['id'];?>" title="Editar Noticia"><span class="glyphicon glyphicon-pencil"></span> Editar</button>
</div>	
<a href="<?php echo $nnoticia['id'];?>" id="notat" title="<?php echo $nnoticia['titulo'];?>">
<table id="ultimasnoticias">
<tr>
	<td class='fecha'><?php echo $nnoticia['fecha'];?></td>
</tr>
<tr>
	<td id='td'><img id='imagenoti' src="<?php echo '../'.$nnoticia['direccion'];?>" title="<?php echo $nnoticia['titulo'];?>"></td>
</tr>
<tr>
	<td class='titulo'><?php echo $nnoticia['titulo'];?></td>
</tr>

</table>
</a>
</div>
<div id="carpanoticias"></div>
<div id="eliminanoticia">
	<h3>Deseas Eliminar noticias ?</h3>
	<button class="btn btn-success" type="button" title="aceptar" id="si" value="si"><span class="glyphicon glyphicon-ok-sign"></span> Aceptar</button>
	<button class="btn btn-danger" type="button" title="cancelar" id="no" value="no"><span class="glyphicon glyphicon-remove-sign"></span> Cancelar</button>
</div>
<div id="respuestanoticias"></div>
<div id="capaeditarnoticias"></div>
<?php
}
}
echo "<div id='capabotones'>";

if($limite>0){
$limit = $limite-10;
echo "<button class='btn btn-success' type='button' id='atras' onclick='cargarnoticias(".$limit.")'><span class='glyphicon glyphicon-triangle-left'></span> Atras</button>";
}

if($limite<$total-10){
$limit = $limite+10;
echo "<button class='btn btn-success' type='button'  id='siguiente' onclick='cargarnoticias(".$limit.")'><span class='glyphicon glyphicon-triangle-right'></span> Siguientes</button>";
echo "</div> <br><br><br>";
}

$resultado->close();
$con->cerrar();


}else{
$con = new Conexion();
$con->conectar();

$sqlver = "select id from noticias";
$result = $con->extraer($sqlver);
$total = $result->num_rows;
$sql="select id,fecha,titulo,direccion from noticias order by id desc limit $limite,10";
$resultado = $con->extraer($sql); 
?>
<div id="obtenernoticiasprincipal">
<h1 id="cabeceranoticias">Noticias</h1>

<?php
if($resultado->num_rows > 0){
while($nnoticia= $resultado->fetch_array()){
?>

<a href="<?php echo $nnoticia['id'];?>" id="notat" title="<?php echo $nnoticia['titulo'];?>">
<table id="ultimasnoticias">
<tr>
	<td class='fecha'><?php echo $nnoticia['fecha'];?></td>
</tr>
<tr>
	<td id='td'><img id='imagenoti' src="<?php echo '../'.$nnoticia['direccion'];?>" title="<?php echo $nnoticia['titulo'];?>"></td>
</tr>
<tr>
	<td class='titulo'><?php echo $nnoticia['titulo'];?></td>
</tr>

</table>
</a>
</div>

<?php
}
}
echo "<div id='capabotones'>";

if($limite>0){
$limit = $limite-10;
echo "<button type='button' class='btn btn-success'id='atras'  onclick='cargarnoticias(".$limit.")'><span class='glyphicon glyphicon-triangle-left'></span> Atras</button>";
}

if($limite<$total-10){
$limit = $limite+10;
echo "<button type='button' class='btn btn-success' id='siguiente' onclick='cargarnoticias(".$limit.")'><span class='glyphicon glyphicon-triangle-right'></span> Siguientes</button>";
echo "</div>";
}

$resultado->close();
$con->cerrar();



}
?>
<script src="../javascript/obtenernoticiasdentro.js"></script>
</body>
</html>
<?php
}else{
echo "<script>
window.location='../index.php';
</script>";
}
?>
