<?php
session_start();
if(isset($_SESSION['tipo'])&& !empty($_SESSION['tipo'])){
if($_SESSION['tipo']=="administrador" ||($_SESSION['tipo']=="operador")){

if(isset($_POST['tipocodigocomunas'])&& !empty($_POST['tipocodigocomunas'])&& isset($_POST['relacioncomunas'])&& !empty($_POST['relacioncomunas'])&& isset($_POST['tipocodigoconsejos'])&& !empty($_POST['tipocodigoconsejos'])&& isset($_POST['relacionconsejos'])&& !empty($_POST['relacionconsejos'])){

$tipocomunas=trim(htmlspecialchars($_POST['tipocodigocomunas']));
$relacioncomunas =trim(htmlspecialchars($_POST['relacioncomunas']));
$tipoconsejos = trim(htmlspecialchars($_POST['tipocodigoconsejos']));
$relacionconsejos = trim(htmlspecialchars($_POST['relacionconsejos']));

if($tipocomunas=="rif"){
if(!preg_match("/^[J]{1}[\-]{1}[0-9]{8}[\-]{1}[0-9]{1}+$/",ucwords($relacioncomunas))){
echo "<h3>Error en datos rif  de comuna debe poseer 12 digitos, ejemplo: J-12345678-1</h3>";
exit();
}else{
if($tipoconsejos=="rif"){
if(!preg_match("/^[J]{1}[\-]{1}[0-9]{8}[\-]{1}[0-9]{1}+$/",ucwords($relacionconsejos))){
echo "<h3>Error en datos rif de consejos debe poseer 12 digitos, ejemplo: J-12345678-1</h3>";
exit();
}else{
require("../php/conexion.php");
$base = new Conexion();
$sqlver="select idgestion_social from gestion_social where rif='$relacioncomunas' and tipo_gestion='comuna' limit 1";
$base->conectar();
$datos = $base->consultar($sqlver);
if($datos==1){
$datos2 = $base->extraer($sqlver);
while($filas = $datos->fetch_array()){
$idgestion_social=$filas['idgestion_social'];
}
$sqlver3="select idgestion_social from gestion_social where rif='$relacionconsejos' and tipo_gestion='consejo' limit 1";
$datos3 =$base->consultar($sqlver3);
if($datos3==1){
//$sqlver4="select idconsejos from consejos_comunales where rif='$relacionconsejos' limit 1";
$datos4 = $base->extraer($sqlver3);
while($filas = $datos4->fetch_array()){
$idconsejos = $filas['idgestion_social'];
}
$sqlver6="select idconsejos from consejos_comunas where idconsejos='$idconsejos' limit 1";
$datos5=$base->consultar($sqlver6);
if($datos5==1){
echo "<h3>Error Consejos comunal ya se encuentra registrado en la comunas</h3>";
$base->cerrar();
exit();
}else{
$sqlver5="insert into consejos_comunas(idconsejoscomunas,idgestion_social,idconsejos) value('','$idgestion_social','$idconsejos')";
$base->agregar($sqlver5);
$base->cerrar();
}
}else{
echo "<h3>Rif no encontrado, consejos comunales no esta registrado en el sistema</h3>";
$base->cerrar();
exit();
}
}else{
echo "<h3>Rif no encontrado, comuna no esta registrada en el sistema</h3>";
$base->cerrar();
exit();
}
}
}else if($tipoconsejos=="codigo"){
if(!preg_match("/^[c]{1}[c]{1}[\-]{1}[0-9]{8}[\-]{1}[0-9]+$/",$relacionconsejos)){
echo "<h3>Error en datos codigo de los consejos debe poseer 13 digitos minimo , ejemplo: cc-20101216-1</h3>";
}else{
require("../php/conexion.php");
$base = new Conexion();
$sqlver="select idgestion_social  from gestion_social where rif='$relacioncomunas' and tipo_gestion='comuna' limit 1";
$base->conectar();
$datos = $base->consultar($sqlver);
if($datos==1){
//$sqlver2="select idcomuna from comunas where rif='$relacioncomunas' limit 1";
$datos2 = $base->extraer($sqlver);
while($filas = $datos->fetch_array()){
$idgestion_social=$filas['idgestion_social'];
}
$sqlver3="select idgestion_social from gestion_social where codigo_gestion='$relacionconsejos' and tipo_gestion='consejo' limit 1";
$datos3 =$base->consultar($sqlver3);
if($datos3==1){
//$sqlver4="select idconsejos,nombre from consejos_comunales where codigo='$relacionconsejos' limit 1";
$datos4 = $base->extraer($sqlver3);
while($filas = $datos4->fetch_array()){
$idconsejos = $filas['idgestion_social'];
}
$sqlver6="select idconsejos from consejos_comunas where idconsejos='$idconsejos' limit 1";
$datos5=$base->consultar($sqlver6);
if($datos5==1){
echo "<h3>Error Consejos comunal ya se encuentra registrado en la comunas</h3>";
$base->cerrar();
exit();
}else{
$sqlver5="insert into consejos_comunas(idconsejoscomunas,idgestion_social,idconsejos) value('','$idgestion_social','$idconsejos')";
$base->agregar($sqlver5);
$base->cerrar();
}
}else{
echo "<h3>codigo no encontrado, consejos comunales no esta registrado en el sistema</h3>";
$base->cerrar();
exit();
}
}else{
echo "<h3>Rif no encontrado, comuna no esta registrada en el sistema</h3>";
$base->cerrar();
exit();
}
}
}
}

}else if($tipocomunas=="codigo"){
if(!preg_match("/^[c]{1}[m]{1}[\-]{1}[0-9]{8}[\-]{1}[0-9]+$/",$relacioncomunas)){
echo "<h3>Error en datos, codigo comunas debe poseer 13 digitos minimos, ejemplo: cm-20101210-1</h3>";
exit();
}else{
if($tipoconsejos=="rif"){
if(!preg_match("/^[J]{1}[\-]{1}[0-9]{8}[\-]{1}[0-9]{1}+$/",ucwords($relacionconsejos))){
echo "<h3>Error en datos, rif debe poseer 12 digitos, ejemplo: J-12345678-1</h3>";
exit();
}else{
require("../php/conexion.php");
$base = new Conexion();
$sqlver="select idgestion_social  from gestion_social where codigo_gestion='$relacioncomunas' and tipo_gestion='comuna' limit 1";
$base->conectar();
$datos = $base->consultar($sqlver);
if($datos==1){
//$sqlver2="select idcomunas from comunas where codigo='$relacioncomunas' limit 1";

$datos2 = $base->extraer($sqlver);
while($filas = $datos->fetch_array()){
$idgestion_social=$filas['idgestion_social'];
}
$sqlver3="select idgestion_social from gestion_social where rif='$relacionconsejos' and tipo_gestion='consejo' limit 1";
$datos3 =$base->consultar($sqlver3);

if($datos3==1){

//$sqlver4="select idconsejos,nombre from consejos_comunales where rif='$relacionconsejos' limit 1";
$datos4 = $base->extraer($sqlver3);
while($filas = $datos4->fetch_array()){
$idconsejos = $filas['idgestion_social'];
}
$sqlver6="select * from consejos_comunas where idconsejos='$idconsejos'";
$datos5=$base->consultar($sqlver6);
if($datos5==1){
echo "<h3>Error Consejos comunal ya se encuentra registrado en la comunas</h3>";
$base->cerrar();
exit();
}else{
$sqlver5="insert into consejos_comunas(idconsejoscomunas,idgestion_social,idconsejos) value('','$idgestion_social','$idconsejos')";
$base->agregar($sqlver5);
$base->cerrar();
}
}else{
echo "<h3>Rif no encontrado, consejos comunales no esta registrado en el sistema</h3>";
$base->cerrar();
exit();
}
}else{
echo "<h3>codigo no encontrado, comuna no esta registrada en el sistema</h3>";
$base->cerrar();
exit();
}
}
}else if($tipoconsejos=="codigo"){
if(!preg_match("/^[c]{1}[c]{1}[\-]{1}[0-9]{8}[\-]{1}[0-9]+$/",$relacionconsejos)){
echo "<h3>Error en datos codigo de los consejos debe poseer 13 digitos minimo , ejemplo: cc-20101216-1</h3>";
exit();
}else{
require("../php/conexion.php");
$base = new Conexion();
$sqlver="select idgestion_social  from gestion_social where codigo_gestion='$relacioncomunas' and tipo_gestion='comuna' limit 1";
$base->conectar();
$datos = $base->consultar($sqlver);
if($datos==1){
//$sqlver2="select idcomuna from comunas where codigo='$relacioncomunas' limit 1";
$datos2 = $base->extraer($sqlver);
while($filas = $datos->fetch_array()){
$idgestion_social=$filas['idgestion_social'];
}
$sqlver3="select idgestion_social from gestion_social where codigo_gestion='$relacionconsejos' and tipo_gestion='consejo' limit 1";
$datos3 =$base->consultar($sqlver3);
if($datos3==1){
//$sqlver4="select idconsejos,nombre from consejos_comunales where codigo='$relacionconsejos' limit 1";
$datos4 = $base->extraer($sqlver3);
while($filas = $datos4->fetch_array()){
$idconsejos = $filas['idgestion_social'];
}
$sqlver6="select idconsejos from consejos_comunas where idconsejos='$idconsejos' limit 1";
$datos5=$base->consultar($sqlver6);
if($datos5==1){
echo "<h3>Error Consejos comunal ya se encuentra registrado en la comunas</h3>";
$base->cerrar();
exit();
}else{
$sqlver5="insert into consejos_comunas(idconsejoscomunas,idgestion_social,idconsejos) value('','$idgestion_social','$idconsejos')";
$base->agregar($sqlver5);
$base->cerrar();
}
}else{
echo "<h3>Codigo no encontrado, consejos comunales no esta registrado en el sistema</h3>";
$base->cerrar();
exit();
}
}else{
echo "<h3>Codigo no encontrado, comuna no esta registrada en el sistema</h3>";
$base->cerrar();
exit();
}
}
}
}

}


}else{
echo "<h3>Error Todos los datos son obligatorios</h3>";
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
