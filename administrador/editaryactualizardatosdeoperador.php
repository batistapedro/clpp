<?php
session_start();
if(isset($_POST['id'])&& !empty($_POST['id'])&& isset($_POST['campo'])&& !empty($_POST['campo'])&& isset($_POST['nuevovalor'])&& !empty($_POST['nuevovalor'])){

$id= intval(trim(htmlspecialchars($_POST['id'])));
$campo = trim(htmlspecialchars($_POST['campo']));
$valor = trim(htmlspecialchars($_POST['nuevovalor']));

require("../php/conexion.php");
$base = new Conexion();
$base->conectar();

if($campo=="clave"){
$valor = hash('ripemd160',$valor);
}else if($campo=="nombre"){
if(!preg_match("/^[a-zA-Zñ-Ñ]+$/",$valor)){
echo "<h3>Error en nombre, nombre solo debe poseer letras</h3>";
exit();
}
if(strlen($valor)>15){
echo "<h3>Error nombre no debe ser mayor a 15 carcateres</h3>";
exit();
}
$sql1="select nombre from usuarios where nombre='$valor'and tipo='operador'";
$ver =$base->consultar($sql1);
if($ver==1){
	echo "<h3>Error en nombre, ya existe un operador con ese nombre</h3>";
	$base->cerrar();
	exit();
}
}
$sql = "update usuarios set ".$campo."='".$valor."' where idusuario='".$id."' and tipo='operador' limit 1";

$base->actualizar($sql);
$base->cerrar();

}else{
echo "<h3>Error al actualizar datos</h3>";
}

?>
