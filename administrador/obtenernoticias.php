<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/obtenernoticias.css">
<head>
<body>
<div id="obtenernoticiasprincipal">
<?php
$limite = intval(trim(htmlspecialchars($_POST['limite'])));

require("../php/conexion.php");
$con = new Conexion();
$con->conectar();

$sqlver = "select id from noticias";
$result = $con->extraer($sqlver);
$total = $result->num_rows;


$sql="select id,fecha,titulo,direccion from noticias order by id desc limit $limite ,10";
$resultado = $con->extraer($sql); 

?>
<h1 id="cabeceranoticias">Noticias</h1>
<?php
if($resultado->num_rows > 0){

while($nnoticia= $resultado->fetch_array()){
?>
<a href="<?php echo $nnoticia['id'];?>" id="notat">
<table id="ultimasnoticias">

<tr><td class='fecha'><?php echo $nnoticia['fecha'];?></td>
</tr>
<tr>
<td id='td'><img id='imagenoti' src="<?php echo $nnoticia['direccion'];?>" title="<?php echo $nnoticia['titulo'];?>"></td>
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
echo "<button type='button' class='btn btn-success' id='atras'  onclick='cargarnoticias(".$limit.")'><span class='glyphicon glyphicon-triangle-left'></span> Atras</button>";
}

if($limite<$total-10){
$limit = $limite+10;
echo "<button type='button' class='btn btn-success'  id='siguiente' onclick='cargarnoticias(".$limit.")'><span class='glyphicon glyphicon-triangle-right'></span> Siguientes</button>";
}
echo "</div>";
$resultado->close();
$con->cerrar();

?>
<script src="javascript/obtenernoticias.js"></script>
</body>
</html>

