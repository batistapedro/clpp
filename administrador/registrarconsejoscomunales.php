<?php
session_start();
if(isset($_SESSION['tipo']) && !empty($_SESSION['tipo'])){
if($_SESSION['tipo']=="administrador" || ($_SESSION['tipo']=="operador")){
if(isset($_POST['sede'])&& !empty($_POST['sede']) && isset($_POST['sector'])&& !empty($_POST['sector'])&& isset($_POST['rif'])&& !empty($_POST['rif']) &&
isset($_POST['nombre'])&& !empty($_POST['nombre'])&& isset($_POST['anio'])&& !empty($_POST['anio']) && isset($_POST['mes'])&& !empty($_POST['dia']) &&
isset($_POST['dia'])&& !empty($_POST['dia']) && isset($_POST['clave'])&& !empty($_POST['clave'])&& isset($_POST['parroquia'])&& !empty($_POST['parroquia'])&&
 isset($_POST['acta'])&& !empty($_POST['acta'])&& isset($_POST['miembro']) && !empty($_POST['miembro'])&& isset($_POST['cedulas'])&& !empty($_POST['cedulas'])&& isset($_POST['certificado'])&& !empty($_POST['certificado'])){

$parroquia = ucwords(trim(htmlspecialchars($_POST['parroquia'])));
$sector= ucwords(trim(htmlspecialchars($_POST['sector'])));
$sede= ucwords(trim(htmlspecialchars($_POST['sede'])));
$nombre = ucwords(trim(htmlspecialchars($_POST['nombre'])));
$rif = ucwords(trim(htmlspecialchars($_POST['rif'])));
$fecha = $_POST['anio']."-".$_POST['mes']."-".$_POST['dia'];
$acta=trim(htmlspecialchars($_POST['acta']));
$certificado= trim(htmlspecialchars($_POST['certificado']));
$cedula= trim(htmlspecialchars($_POST['cedulas']));
$nomina = trim(htmlspecialchars($_POST['miembro']));
$clave=hash('ripemd160',$_POST['clave']);
$fechainicio=date("Y-m-d");
$fechavencimiento= $_POST['anio']+2;
$fechavencimiento=$fechavencimiento."-".$_POST['mes']."-".$_POST['dia'];
$estado="activo";
$tipo_gestion="consejo";


if(!preg_match("/^[a-zA-Zñ-Ñ0-9\s]+$/",$sector)){
	echo "<h3>error en datos del sector no se permite caracteres raros</h3>";
	exit();
}
if(strlen($sector)>60){
	echo "<h3>error sector no puede ser mayor a 60 caracteres</h3>";
	exit();
	}
if(!preg_match("/^[a-zA-Zñ-Ñ0-9\s]+$/",$sede)){
	echo "<h3>error en datos de la sede, no se permite caracteres raros</h3>";
	exit();
}
if(strlen($sede)>60){
	echo "error sede no puede ser mayor a 60 caracteres</h3>";
	exit();
}
if(!preg_match("/^[A-Za-zÑ-Ñ0-9\s]+$/",$nombre)){
	echo "<h3>error en nombre, no se permite caracateres raros</h3>";
	exit();
}
if(strlen($nombre)>100){
	echo "<h3>error en nombre, nombre no puede ser mayor a 100 carcateres</h3>";
	exit();
}
if($cedula!="si" and $cedula!="no"){
	echo "<h3>error en anexo de documento, cedula </h3>";
	exit();
}
if($acta!="si" and $acta!="no"){
	echo "<h3>error en anexo de documento, acta</h3>";
	exit();
}
if($nomina!="si" and $nomina!="no"){
	echo "<h3>error en anexo de documento, constancia</h3>";
	exit();
}
if($certificado!="si" and $certificado!="no"){
	echo "<h3>error en anexo de documento, registro</h3>";
	exit();
}
if($fecha>$fechainicio){
echo "<h3>Error fecha de registro no puede ser mayor a fecha actual</h3>";
exit();
}else{

if(!preg_match("/^[J]{1}[\-]{1}[0-9]{8}[\-]{1}[0-9]{1}+$/",$rif)){
echo "<h3>Error en datos del rif,  ejemplo J-12345678-1</h3>";
exit();
}else{
$sql="select rif from gestion_social where rif='$rif' and tipo_gestion='consejo'";
require("../php/conexion.php");
$base = new Conexion();
$base->conectar();
$datos = $base->consultar($sql);
if($datos==1){
echo "<h3>Error consejo comunal ya existe</h3>";
exit();
$base->cerrar();
}else{
$sq="select max(idgestion_social) from gestion_social where tipo_gestion='consejos'";
$ver = $base->extraer($sq);
if($ver2= $ver->fetch_row()){
$idm=trim($ver2[0]);
}
$idm=$idm+1;
$codigo ="cc-".date("Ymd")."-"."$idm";

$sql2="INSERT INTO gestion_social(idgestion_social,parroquia,sector,sede,nombre_gestion,codigo_gestion,clave_gestion,tipo_gestion,rif,tipo,acta,nomina,constancia,cedulas,fecha_inicio,fecha_registro,fecha_vecimiento,estado) VALUES('','$parroquia','$sector','$sede','$nombre','$codigo','$clave','$tipo_gestion','$rif',NULL,'$acta','$certificado','$nomina','$cedula','$fechainicio','$fecha','$fechavencimiento','$estado')";
$base->agregar($sql2);

//$sql3 ="update consejos_comunales set codigo='$codigo' where rif='$rif'";
//$base->actualizar2($sql3);
/*$sql4="insert into anexo_consejos(idanexo,acta,certificado,nomina,cedulas,idconsejos) value('','$acta','$certificado','$nomina','$cedula','$idm')";
$base->agregar2($sql4);
*/
$ver->close();
$base->cerrar();
}
}
}

}else{
echo "<h3> error hay datos que son obligatorios</h3>";
}

}else{
?>
<script>
window.location="index.php";
</script>
<?php
}
}else{
?>
<script>
window.location="index.php";
</script>
<?php
}

?>
