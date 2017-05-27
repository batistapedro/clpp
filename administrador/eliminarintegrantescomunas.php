<?php
session_start();
if(isset($_SESSION['tipo']) && (!empty($_SESSION['tipo']))){
if($_SESSION['tipo']=="administrador"){
if(isset($_POST['ver']) && !empty($_POST['ver']) && isset($_POST['idcomuna']) && !empty($_POST['idcomuna'])){

$base=null;
$sql=null;
$id=intval(trim(htmlspecialchars($_POST['ver'])));
$idcomuna=intval(trim(htmlspecialchars($_POST['idcomuna'])));

require("../php/conexion.php");
$base = new Conexion();
$base->conectar();
$sql2="select idintegrantes_gestion from integrantes_gestion where idintegrantes_gestion='$id' and comuna=1 and consejo=1 and idcomuna='$idcomuna'";
$sql="delete from cargo_integrantes_gestion where idintegrantes_gestion='$id' and idgestion_social='$idcomuna' ";
$sql3="update integrantes_gestion set comuna=0, idcomuna=NULL where idintegrantes_gestion='$id' and idcomuna='$idcomuna'";
$consulta=$base->consultar($sql2);
if($consulta==1){
	$base->actualizar2($sql3);
}
$base->eliminar($sql);
$base->cerrar();
}
}
}
?>
