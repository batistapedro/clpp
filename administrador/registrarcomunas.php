<?php
session_start();
if(isset($_SESSION['tipo']) && !empty($_SESSION['tipo'])){
if($_SESSION['tipo']=="administrador" || ($_SESSION['tipo']=="operador")){
if(isset($_POST['sede'])&& !empty($_POST['sede']) && isset($_POST['sector'])&& !empty($_POST['sector'])&& isset($_POST['rif'])&& !empty($_POST['rif']) && 
isset($_POST['nombre'])&& !empty($_POST['nombre'])&& isset($_POST['anio'])&& !empty($_POST['anio']) && isset($_POST['mes'])&& !empty($_POST['mes']) && isset($_POST['dia'])&& !empty($_POST['dia']) && isset($_POST['clave'])&& !empty($_POST['clave'])&&isset($_POST['parroquia'])&&
!empty($_POST['parroquia'])&& isset($_POST['constancia'])&& !empty($_POST['constancia'])&&
isset($_POST['acta'])&& !empty($_POST['acta'])&& isset($_POST['registro']) && !empty($_POST['registro'])&&
 isset($_POST['cedulas'])&& !empty($_POST['cedulas'])){

$parroquia = ucwords(trim(htmlspecialchars($_POST['parroquia'])));
$sector= ucwords(trim(htmlspecialchars($_POST['sector'])));
$sede= ucwords(trim(htmlspecialchars($_POST['sede'])));
$nombre = ucwords(trim(htmlspecialchars($_POST['nombre'])));
$rif = ucwords(trim(htmlspecialchars($_POST['rif'])));
$fecha = $_POST['anio']."-".$_POST['mes']."-".$_POST['dia'];
$acta=trim(htmlspecialchars($_POST['acta']));
$cedula= trim(htmlspecialchars($_POST['cedulas']));
$constancia= trim(htmlspecialchars($_POST['constancia']));
$registro= trim(htmlspecialchars($_POST['registro']));
$clave=hash('ripemd160',$_POST['clave']);
$fechainicio=date("Y-m-d");
$fechavencimiento = $_POST['anio']+2;
$fechavencimiento = $fechavencimiento."-".$_POST['mes']."-".$_POST['dia'];
$estado="activo";
$tipo_gestion="comuna";

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
if($constancia!="si" and $constancia!="no"){
	echo "error en anexo de documento, constancia";
	exit();
}
if($registro!="si" and $registro!="no"){
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
$sql="select rif from gestion_social where tipo_gestion='comuna' and rif='$rif'";
require("../php/conexion.php");
$base = new Conexion();
$base->conectar();
$datos = $base->consultar($sql);
if($datos==1){
echo "<h3>Error la comuna ya existe en el sistema</h3>";
exit();
$base->cerrar();
}else{
$sq="select max(idgestion_social) from gestion_social where tipo_gestion='comuna'"; 
$ver = $base->extraer($sq);
while($ver2=$ver->fetch_row()){
$idm=trim($ver2[0]);
}
$idm=$idm+1;
$codigo ="cm-".date("Ymd")."-"."$idm";

//$sql3 ="update gestion_social set codigo_gestion='$codigo' where tipo_gestion='comuna' and rif='$rif'";
//$base->actualizar2($sql3);


$sql2="INSERT INTO gestion_social(idgestion_social,parroquia,sector,sede,nombre_gestion,codigo_gestion,clave_gestion,tipo_gestion,rif,tipo,acta,nomina,constancia,cedulas,fecha_inicio,fecha_registro,fecha_vecimiento,estado) VALUES ('','$parroquia','$sector','$sede','$nombre','$codigo','$clave','$tipo_gestion','$rif',NULL,'$acta','$registro','$constancia','$cedula','$fechainicio','$fecha','$fechavencimiento','$estado')";
$base->agregar($sql2);

//$sql4="insert into anexo_comunas(idanexo,acta,rif,constancia,registro,cedulas,idcomuna) value('','$acta','$rifanexo','$constancia','$registro','$cedula','$idm')";
//$base->agregar2($sql4);

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
