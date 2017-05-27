<?php
session_start();
if(isset($_SESSION['tipo']) && !empty($_SESSION['tipo'])){
if($_SESSION['tipo']=="administrador" || ($_SESSION['tipo']=="operador")){
if(isset($_POST['sede'])&& !empty($_POST['sede']) && isset($_POST['sector'])&& !empty($_POST['sector'])&& isset($_POST['rif'])&& !empty($_POST['rif']) &&
isset($_POST['nombre'])&& !empty($_POST['nombre'])&& isset($_POST['anio'])&& !empty($_POST['anio']) && isset($_POST['mes'])&& !empty($_POST['mes']) && isset($_POST['dia'])&& !empty($_POST['dia']) && isset($_POST['clave'])&& !empty($_POST['clave'])&& isset($_POST['parroquia'])&& !empty($_POST['parroquia'])&& isset($_POST['tipo'])&& !empty($_POST['tipo'])&& isset($_POST['acta'])&& !empty($_POST['acta'])&& isset($_POST['constancia']) && !empty($_POST['constancia'])&& isset($_POST['miembro']) && !empty($_POST['miembro'])&& isset($_POST['cedulas'])&& !empty($_POST['cedulas'])){

$parroquia = ucwords(trim(htmlspecialchars($_POST['parroquia'])));
$sector    = ucwords(trim(htmlspecialchars($_POST['sector'])));
$sede      = ucwords(trim(htmlspecialchars($_POST['sede'])));
$nombre    = ucwords(trim(htmlspecialchars($_POST['nombre'])));
$tipo      = trim(htmlspecialchars($_POST['tipo']));
$rif       = ucwords(trim(htmlspecialchars($_POST['rif'])));
$fecha     = $_POST['anio']."-".$_POST['mes']."-".$_POST['dia'];
$acta      = trim(htmlspecialchars($_POST['acta']));
$nomina    = trim(htmlspecialchars($_POST['miembro']));
$cedula    = trim(htmlspecialchars($_POST['cedulas']));
$constancia= trim(htmlspecialchars($_POST['constancia']));
$clave     = hash('ripemd160',$_POST['clave']);
$fechainicio = date("Y-m-d");
$fechavencimiento = $_POST['anio']+5;
$fechavencimiento = $fechavencimiento."-".$_POST['mes']."-".$_POST['dia'];
$estado="activo";
$tipo_gestion="movimiento";

if(!preg_match("/^[a-zA-Zñ-Ñ0-9\s]+$/",$sector)){
	echo "error en datos del sector no se permite caracteres raros";
	exit();
}
if(strlen($sector)>60){
	echo "error sector no puede ser mayor a 60 caracteres";
	exit();
	}
if(!preg_match("/^[a-zA-Zñ-Ñ0-9\s]+$/",$sede)){
	echo "error en datos de la sede, no se permite caracteres raros";
	exit();
}
if(strlen($sede)>60){
	echo "error sede no puede ser mayor a 60 caracteres";
	exit();
}
if(!preg_match("/^[A-Za-zÑ-Ñ0-9\s]+$/",$nombre)){
	echo "error en nombre, no se permite caracateres raros";
	exit();
}
if(strlen($nombre)>100){
	echo "error en nombre, nombre no puede ser mayor a 100 carcateres";
	exit();
}
if($cedula!="si" and $cedula!="no"){
	echo "error en anexo de documento, cedula ";
	exit();
}
if($acta!="si" and $acta!="no"){
	echo "error en anexo de documento, acta";
	exit();
}
if($nomina!="si" and $nomina!="no"){
	echo "error en anexo de documento, constancia";
	exit();
}
if($constancia!="si" and $constancia!="no"){
	echo "error en anexo de documento, registro";
	exit();
}


if($fecha>$fechainicio){
echo "<h3>Error fecha de registro no puede ser mayor a fecha actual</h3>";
exit();
}else{
if(!preg_match("/^[J]{1}[\-]{1}[0-9]{8}[\-][0-9]{1}+$/",$rif)){
echo "<h3>Error en datos del rif,  ejemplo J-12345678-1</h3>";
exit();
}else{
$sql="select rif from gestion_social where rif='$rif' and tipo_gestion='movimiento'";
require("../php/conexion.php");
$base = new Conexion();
$base->conectar();
$datos = $base->consultar($sql);
if($datos==1){
echo "<h3>Error movimientos sociales ya existe</h3>";
exit();
$base->cerrar();
}else{
$sq="select max(idgestion_social) from gestion_social where tipo_gestion='movimiento'";
$ver = $base->extraer($sq);
if($ver2= $ver->fetch_row()){
$idm=trim($ver2[0]);
}
$idm=$idm+1;
$codigo ="ms-".date("Ymd")."-"."$idm";


$sql2="INSERT INTO gestion_social(idgestion_social,parroquia,sector,sede,nombre_gestion,codigo_gestion,clave_gestion,tipo_gestion,rif,tipo,acta,nomina,constancia,cedulas,fecha_inicio,fecha_registro,fecha_vecimiento,estado) VALUES('','$parroquia','$sector','$sede','$nombre','$codigo','$clave','$tipo_gestion','$rif','$tipo','$acta','$constancia','$nomina','$cedula','$fechainicio','$fecha','$fechavencimiento','$estado')";
$base->agregar($sql2);
$ver->close();
$base->cerrar();
}
}
}
}else{
echo "<h3> error todos los datos son obligatorios</h3>";
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
