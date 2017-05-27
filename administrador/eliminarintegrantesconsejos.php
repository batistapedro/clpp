<?php
session_start();
if($_SESSION['tipo']=="administrador"||($_SESSION['tipo']=="operador")){
if(isset($_POST['ver']) && !empty($_POST['ver']) && isset($_POST['idconsejo']) && !empty($_POST['idconsejo'])){

$base=null;
$sql=null;

$id=intval(trim(htmlspecialchars($_POST['ver'])));
$idconsejo=intval(trim(htmlspecialchars($_POST['idconsejo'])));

require("../php/conexion.php");
$sql1="select idintegrantes_gestion from voceros_parroquia where idintegrantes_gestion='$id' and consejo=1";
$sql2="delete from voceros_parroquia where idintegrantes_gestion='$id' and consejo=1";
$sql3="select idintegrantes_gestion from integrantes_gestion where idintegrantes_gestion='$id' and consejo=1 and movimiento=1";
$sql="delete from integrantes_gestion where idintegrantes_gestion='$id' and consejo=1 and not movimiento=1";
$sql4="update integrantes_gestion set consejo=0,comuna=0,idconsejo=NULL,idcomuna=NULL where idintegrantes_gestion='$id' and idconsejo='$idconsejo'";
$sql5="select idcomuna from integrantes_gestion where idintegrantes_gestion='$id' and consejo=1 and comuna=1 and idconsejo='$idconsejo'";
$sql7="delete from cargo_integrantes_gestion where idintegrantes_gestion='$id' and idgestion_social='$idconsejo'";
$base = new Conexion();
$trans = $base->conectar();
$traer=$base->extraer($sql5);
while($datos = $traer->fetch_array()){
$idcomuna=$datos['idcomuna'];
}
$consulta=$base->consultar($sql1);
if($consulta==1){
	try{
		$trans->autocommit(false);
	$sql6="delete from cargo_integrantes_gestion where idintegrantes_gestion='$id' and idgestion_social='$idcomuna'";
	$base->eliminar2($sql6);
	$base->eliminar2($sql7);
	$base->eliminar2($sql2);
		$trans->commit();
	}catch(Exeception $e){
		$trans->rollback();
	}
	$trans->autocommit(true);
}
$consult=$base->consultar($sql3);
if($consult==1){
$base->eliminar($sql4);
$base->cerrar();
}else{
	$trans->autocommit(false);
	try{
$sql6="delete from cargo_integrantes_gestion where idintegrantes_gestion='$id' and idgestion_social='$idcomuna'";
$base->eliminar2($sql6);
$base->eliminar2($sql7);
$base->eliminar($sql);
$trans->commit();
$base->cerrar();
	}catch(Exepcion $e){
		$trans->rollback();
	}
	$trans->autocommit(true);
}
}else{
	echo "<h3>Error al eliminar datos</h3>";
}
}else{
	echo "<script>document.window.location='../index.php'</script>";
}
?>
