<?php
session_start();
if(isset($_POST['ver'])&& !empty($_POST['ver'])){

$base=null;
$sql=null;
$id=intval(trim(htmlspecialchars($_POST['ver'])));

$campo="estatu";
$valor="noactivo";

require("../php/conexion.php");
$sql = "DELETE FROM usuarios WHERE idusuario='$id' and tipo='operador' limit 1";
$base = new Conexion();
$base->conectar();
$base->eliminar($sql);
$base->cerrar();

}

?>
