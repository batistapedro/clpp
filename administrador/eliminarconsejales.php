<?php
session_start();
if(isset($_POST["ver"])&& !empty($_POST['ver'])){
$base=null;
$sql=null;
$id=intval(trim(htmlspecialchars($_POST['ver'])));

require("../php/conexion.php");
$campo="estatu";
$valor="noactivo";
$sql = "DELETE FROM usuarios WHERE idusuario='$id' and tipo='concejal' limit 1";
$base = new Conexion();
$base->conectar();
$base->eliminar($sql);
$base->cerrar();
}


?>
