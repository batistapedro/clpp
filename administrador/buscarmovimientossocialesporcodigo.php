<?php
session_start();
if(isset($_SESSION['tipo'])&& !empty($_SESSION['tipo'])){
if(isset($_POST['codigomovimientos'])&& !empty($_POST['codigomovimientos'])){

$codigo=trim(htmlspecialchars($_POST['codigomovimientos']));
if(!preg_match("/^[m]{1}[s]{1}[\-]{1}[0-9]{8}[\-]{1}[0-9]+$/",$codigo)){
echo "<h3>Error en datos ejemplo datos debe contener ms-20041212-12</h3>";
exit();
}
}else{
echo "<h3>Error codigo es obligatorio</h3>";
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

if($_SESSION['tipo']=="administrador"|| $_SESSION['tipo']=="operador" || $_SESSION['tipo']=="concejal"){
$base = new Conexion();
$base->conectar();
$sqlver="select idgestion_social,parroquia,sector,nombre_gestion,tipo from gestion_social where codigo_gestion='$codigo' and tipo_gestion='movimiento'";
$ver = $base->consultar($sqlver);
if($ver==1){
$datos = $base->extraer($sqlver);
?>
<div class="table-responsive">
<table class="table" id="resultadomovimientosporcodigo">
    <caption><h2 class="text-center">Resultado del Movimientos Social</h2></caption>
    <tr>
    <thead>
        <th id="idmovimientos" class="hidden">id</th>
        <th>Parroquia</th>
        <th>Sector</th>
        <th>Nombre</th>
        <th>Tipo</th>
        <th>Elegir</th>
    </thead>
    <tr>
<?php
while($datoss = $datos->fetch_array()){
?>
<tr>
    <tbody>
    <td class="idmovimientos hidden"><?php echo $datoss['idgestion_social'];?></td>
    <td><?php echo $datoss['parroquia'];?></td>
    <td><?php echo $datoss['sector'];?></td>
    <td><?php echo $datoss['nombre_gestion'];?></td>
    <td><?php echo $datoss['tipo'];?></td>
    <td>
        <button type="button" id="elegirmovimientosporcodigo" class="btn btn-success">
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

}else{
echo "<center><h2>Error codigo no esta registrado en el sistema</h2></center>";
}
?>
<script src="../javascript/buscarmovimientossocialesporcodigo.js"> </script>
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
