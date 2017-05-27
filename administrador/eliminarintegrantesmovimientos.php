<?php
session_start();
if($_SESSION['tipo']=="administrador"||($_SESSION['tipo']=="operador")){
if(isset($_POST['ver']) && !empty($_POST['ver']) && isset($_POST['idmovimiento']) && !empty($_POST['idmovimiento'])){

$base=null;
$sql=null;
$id=intval(trim(htmlspecialchars($_POST['ver'])));
$idmovimiento=intval(trim(htmlspecialchars($_POST['idmovimiento'])));

require("../php/conexion.php");
$base = new Conexion();
$trans = $base->conectar();
$sql2="select idintegrantes_gestion from integrantes_gestion where idintegrantes_gestion='$id' and consejo=1 and movimiento=1";
$sql="delete from integrantes_gestion where idintegrantes_gestion='$id' and movimiento=1 and not consejo=1";
$sql3="update integrantes_gestion set movimiento=0 where idintegrantes_gestion='$id' ";
$sql4="delete from cargo_integrantes_gestion where idintegrantes_gestion='$id' and idgestion_social='$idmovimiento' ";
$sql5="select idintegrantes_gestion from  voceros_parroquia where idintegrantes_gestion='$id' and movimiento=1 and not consejo=1 ";
$sql6="delete from voceros_parroquia where idintegrantes_gestion='$id' and movimiento=1 and not consejo=1 ";
$consult=$base->consultar($sql5);
if($consult==1){
$base->eliminar2($sql6);
}

$consulta=$base->consultar($sql2);
if($consulta==1){
	$trans->autocommit(false);
	try{
$base->actualizar2($sql3);
$base->eliminar($sql4);
	$trans->commit();
$base->cerrar();
	}catch(Exeption $e)
	{
		$trans->rollback();
	}
	$trans->autocommit(true);
}else{
	$trans->autocommit(false);
	try{
$base->eliminar2($sql4);
$base->eliminar($sql);
$trans->commit();
$base->cerrar();
	}catch(Exeption $e){
		$trans->rollback();
	}
	$trans->autocommit(true);
}
}else{
	echo "<h3>Error al eliminar integrantes</h3>";
}
}else{
	echo "<script>document.window.location='../index.php'</script>";
}
?>
