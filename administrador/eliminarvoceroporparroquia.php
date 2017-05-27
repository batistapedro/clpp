<?php
session_start();
if(isset($_SESSION['tipo']) && !empty($_SESSION['tipo'])){
	if($_SESSION['tipo']=="administrador" || $_SESSION['tipo']=="operador"){
if(isset($_POST["ver"])&& !empty($_POST['ver'])){
$base=null;
$sql=null;
$id=intval(trim(htmlspecialchars($_POST['ver'])));

require("../php/conexion.php");
$sql="delete from voceros_parroquia where idvoceros='$id'";
$base = new Conexion();
$base->conectar();
$base->eliminar($sql);
$base->cerrar();
}
}
}
?>
