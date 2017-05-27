<?php
session_start();
if(isset($_SESSION['tipo'])&& !empty($_SESSION['tipo'])){
	if($_SESSION['tipo']=="administrador" || $_SESSION['tipo']=="operador"){
require("../php/conexion.php");
$sql="select nombre_gestion from gestion_social where tipo_gestion='comuna' order by idgestion_social desc limit 0,5";
$sqlver="select count(*) from gestion_social where tipo_gestion='comuna'";
$base = new Conexion();
$base->conectar();
$ver = $base->extraer($sql);
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>

<table class="ultimos">
<?php
while($datos = $ver->fetch_array()){
?>
<tr><td style="text-align:center;" id="ultimostd"><?php echo $datos['nombre_gestion'];?></td></tr>
<?php
}
$datos2= $base->extraer($sqlver);
while($datos3 =$datos2->fetch_row()){
$datos4=$datos3[0];
}
?>
<tr><td style="text-align:center;" id="ultimostd"><?php echo "<strong>Cantidad Total : <div class='badge'> ".$datos4." </div></strong>";?></td></tr>
</table>
</body>
</html>

<?php
}else if($_SESSION['tipo']=="comunas" || $_SESSION['tipo']=="consejos" || $_SESSION['tipo']=="movimientos" || $_SESSION['tipo']=="concejal"){
	require("../php/conexion.php");
	$sqlver="select count(*) from gestion_social where tipo_gestion='comuna'";
	$base = new Conexion();
	$base->conectar();
	$datos2 = $base->extraer($sqlver);
	while($datos3 = $datos2->fetch_row()){
		$datos4 = $datos3[0];
	}
	echo "<strong>Cantidad Total : <span class='badge'>".$datos4." </span></strong>";
}else{
	?>
	<script>
	window.location="../index.php";
	</script>
	<?php
}
}else{
	?>
	<script>
	window.location="../index.php";
	</script>
	<?php
}
?>
