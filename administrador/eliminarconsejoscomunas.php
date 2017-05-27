<?php
session_start();
if(isset($_SESSION['tipo'])&& !empty($_SESSION['tipo'])){
if($_SESSION['tipo']=="administrador"){
if(isset($_POST['ver'])&& !empty($_POST['ver']) && isset($_POST['idcomuna']) && !empty($_POST['idcomuna']) && isset($_POST['idconsejo']) && !empty($_POST['idconsejo'])){
$id = intval(trim(htmlspecialchars($_POST['ver'])));
$idcomuna= intval(trim(htmlspecialchars($_POST['idcomuna'])));
$idconsejo=intval(trim(htmlspecialchars($_POST['idconsejo'])));


require("../php/conexion.php");
$base = new Conexion();
$trans =$base->conectar();
$sq="select idintegrantes_gestion from integrantes_gestion where idconsejo='$idconsejo' and idcomuna='$idcomuna' and comuna=1 and consejo=1";

$sql2="update integrantes_gestion set comuna=0, idcomuna=NULL where idcomuna='$idcomuna' and idconsejo='$idconsejo'";
$sqlver="delete from consejos_comunas where idconsejoscomunas='$id'";

$extrae = $base->extraer($sq);

$elimina = array();
$i=0;
while($ver =$extrae->fetch_array()){
$elimina[$i]=$ver['idintegrantes_gestion'];
$i=$i+1;
}
	$trans->autocommit(false);
foreach ($elimina as $key => $value) {
	try{
	$sql="delete from cargo_integrantes_gestion where idintegrantes_gestion=$value and idgestion_social=$idcomuna";
	$base->eliminar2($sql);
	$trans->commit();
}catch(Exeption $e){
	$trans->rollback();
	}
	$trans->autocommit(true);
}
$trans->autocommit(false);
try{
$base->actualizar2($sql2);
$base->eliminar($sqlver);
$trans->commit();
}catch (Exeption $e){
	$trans->rollback();
}
$trans->autocommit(true);
$base->cerrar();
}
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
