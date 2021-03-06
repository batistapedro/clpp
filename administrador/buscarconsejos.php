<?php
session_start();
if(isset($_POST['parroquia'])){
$parroquia=$_POST['parroquia'];
$datos=null;
$base=null;
$ver=null;
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<button type="button" id="pdfconsejosparroquia" title="Generar PDF" class="btn btn-lg btn-danger">
	<span class="glyphicon glyphicon-cloud-download"></span> Generar Pdf
</button>
	<div class="table-responsive">
	<table class="table table-hover">
	<caption><h2 class="text-center">Registro de Los Consejos Comunales</h2></caption>
	<tr>
		<thead>
		<th class="hidden" id="ididconsejos">Id</th>
		<th>Sector</th>
		<th>Nombre</th>
		<th>Codigo</th>
		<th>Elegir</th>
		</thead>
	</tr>
<?php
require("../php/conexion.php");
$sql="select idgestion_social, codigo_gestion, sector, nombre_gestion from gestion_social where parroquia = '$parroquia' and tipo_gestion='consejo'";
$base = new Conexion();
$base->conectar();
$ver = $base->extraer($sql);
while($datos = $ver->fetch_array()){
?>
    <tr>
	    <tbody>
	    <td class="idconsejos hidden"><?php echo $datos['idgestion_social'];?></td>
	    <td><?php echo $datos['sector'];?></td>
	   	<td><?php  echo $datos['nombre_gestion'];?></td>
	   	<td><?php echo $datos['codigo_gestion'];?></td>
	    <td>
	    	<button type="button" class="btn btn-success" id="elegirconsejos" title="Elegir">
	    		<span class="glyphicon glyphicon-ok-sign" ></span> Elegir</button>
	    </td>
	    </tbody>
    </tr>

<?php
}
$base->cerrar();
?>
</table>
</div>
<?php
$base3 = new Conexion();
$base3->conectar();
$sq="select count(*) from gestion_social where parroquia='$parroquia' and tipo_gestion='consejo'";
$ver2 = $base3->extraer($sq);
if($ver3 = mysqli_fetch_row($ver2)){
echo "<strong>Cantidad : ".$ver3[0]."</strong><br><br>";
}
$ver2->close();
$base3->cerrar();
?>

</body>
<script src="../javascript/buscarconsejos.js"></script>
</html>
<?php
}
?>
