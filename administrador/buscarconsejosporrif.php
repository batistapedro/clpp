<?php
session_start();
if(isset($_SESSION['tipo'])&& !empty($_SESSION['tipo']))
{
	if(isset($_POST['rifconsejo'])&& !empty($_POST['rifconsejo']))
	{
		$rif = trim(htmlspecialchars(ucwords($_POST['rifconsejo'])));
		if(!preg_match("/^[J]{1}[-]{1}[0-9]{8}[-]{1}[0-9]{1}+$/",$rif))
		{
			echo "<h3>Error en rif , el rif debe poseer 12 dijito ejemplo: j-00000000-0</h3>";
			exit();
		}
	}
	else
	{
		echo "<h3>Error en rif , rif es obligatorio</h3>";
		exit();
	}
	require("../php/conexion.php");
?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    </head>
<body>
<?php

if($_SESSION['tipo']=="administrador"|| $_SESSION['tipo']=="operador" || $_SESSION['tipo']=="concejal")
{
	$base = new Conexion();
	$base->conectar();
	$sqlver="select idgestion_social,parroquia,sector,nombre_gestion from gestion_social where rif='$rif' and tipo_gestion='consejo'";
	$ver = $base->consultar($sqlver);
	if($ver==1)
	{
		$datos = $base->extraer($sqlver);
		?>
		<div class="table-responsive">
		<table id="resultadoconsejosporcodigo" class="table">
    		<caption><h2 class="text-center">Resultado del Consejo Comunal</h2></caption>
    		<tr>
        		<thead>
        			<th id="idconsejos" class="hidden">id</th>
        			<th>Parroquia</th>
        			<th>Sector</th>
        			<th>Nombre</th>
        			<th>Elegir</th>
        		</thead>
   			 </tr>
			<?php
			while($datoss = $datos->fetch_array()){
			?>
			<tr>
    		<tbody>
			    <td class="idconsejos hidden"><?php echo $datoss['idgestion_social'];?></td>
			    <td><?php echo $datoss['parroquia'];?></td>
			    <td><?php echo $datoss['sector'];?></td>
			    <td><?php echo $datoss['nombre_gestion'];?></td>
			    <td>
			    	<button class="btn btn-success" type="button" id="elegirconsejosporrif">
            			<span class="glyphicon glyphicon-ok-sign"></span> Elegir
        			</button>
    			</td>
			<?php
			}
			?>
				</tbody>
				</tr>
				</table>
			</div>
			<?php
	}
	else
	{
		echo "<center><h2>Error Rif no esta registrado en el sistema</h2></center>";
	}
?>
<script src="../javascript/buscarconsejosporrif.js"></script>
</body>
<?php
}else{
?>
</html>
<?php
 echo "
<script>
window.location='../index.php';
</script>
";

}




}else{
echo "
<script>
window.location='../index.php';
</script>
";
}
?>
