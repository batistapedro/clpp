<?php
session_start();
if(isset($_SESSION['tipo'])&& !empty($_SESSION['tipo'])){
if($_SESSION['tipo']=="administrador" || $_SESSION['tipo']=="operador"){
$base=null;
$sql=null;
if(isset($_POST['campo'])&& !empty($_POST['campo']) && isset($_POST['nuevovalor'])&& !empty($_POST['nuevovalor'])&& isset($_POST['id']) && !empty($_POST['id'])){
$campo= trim(htmlspecialchars($_POST['campo']));
$valor= trim(htmlspecialchars($_POST['nuevovalor']));
$id= intval(trim(htmlspecialchars($_POST['id'])));
require("../php/conexion.php");
if($campo=="clave"){
$valor = hash('ripemd160',$valor);
}else if($campo=="nombre"){
if(!preg_match("/^[a-zA-Zñ-Ñ]+$/",$valor)){
echo "<h3>Error en nombres</h3>";
exit();
}
if(strlen($valor)>15){
echo "<h3>Error nombre no debe ser mayor a 15 caracteres</h3>";
exit();
}
}else if($campo=="apellido"){
if(!preg_match("/^[a-zA-Zñ-Ñ\s]+$/",$valor)){
echo "<h3>Error en apellido</h3>";
exit();
}
if(strlen($valor)>20){
echo "<h3>Error apellido no debe ser mayor a 20 caracteres</h3>";
exit();
}
}else if($campo=="cedula"){
if(!preg_match("/^[E-Ve-v]{1}[\-]{1}[0-9]+$/",$valor)){
echo "<h3>Error en cedula</h3>";
exit();
}
if(strlen($valor)>10){
echo "<h3>Error en cedula no puede ser mayor a 10 digitos</h3>";
exit();
}
$a=str_split($valor);
if($a[0]!="v" and ($a[0]!="e" and ($a[0]!='V' and ($a[0]!="E")))){
	echo "<h3>Error en la nacionalida de la cedula</h3>";
	exit();
}
$sql="select cedula from usuarios where cedula='$valor' and tipo='concejal' and not idusuario='$id'";
    $base = new Conexion();
    $base->conectar();
    $consult=$base->consultar($sql);
    if($consult==1){
        echo "<h3>Error cedula ya exite en el sistema</h3>";
        $base->cerrar();
        exit();
    }
    $base->cerrar();

}else if($campo=="telefono"){
if(!preg_match("/^[0-9]{11}+$/",$valor)){
echo "<h3>Error en telefono</h3>";
exit();
}
if($valor=="00000000000"){

}else{
$codigo = substr($valor,0,4);

if($codigo!="0412" &&($codigo!="0416" &&($codigo!="0426" &&($codigo!="0414"
&&($codigo!="0424" &&($codigo!="0285"))))))
{
echo "<h3>Error en codigo del campo {$campo} no es valido</h3>";
exit();
}
}
}
$sql = "update usuarios set ".$campo."='".$valor."' where idusuario='".$id."' limit 1";
$base = new Conexion();
$base->conectar();
$base->actualizar($sql);
$base->cerrar();

}else{
echo "<h3>Error debes de darle valor a los campos</h3>";
}

}else{
echo "<script>
window.location='../index.php';
</script>";

}
}else{

echo "

<script>
window.location='../index.php';
</script>

";
}


?>
