<?php
session_start();
if(isset($_SESSION['nombre']) && !empty($_SESSION['nombre']) && isset($_SESSION['id']) && !empty($_SESSION['id']) &&
isset($_SESSION['tipo']) && !empty($_SESSION['tipo'])){
if(isset($_POST['nombre']) &&  !empty($_POST['nombre']) && isset($_POST['clave']) && !empty($_POST['clave'])&& isset($_POST['id']) && !empty($_POST['id'])){
$nombre = trim(htmlspecialchars($_POST['nombre']));
$clave =hash('ripemd160',$_POST['clave']);
$id= intval(trim(htmlspecialchars($_POST['id'])));

if(!preg_match('/^[A-Za-z]+$/',$nombre)){
echo "<h3>Error en nombre, nombre debe ser solo letras </h3>";
exit();
}
if(strlen($nombre)<3){
	echo "<h3>Error nombre debe ser mayor o igual 3 letras</h3>";
	exit();
}
if(strlen($nombre)>15){
	echo "<h3>Error nombre no puede ser mayor a 15 letras</h3>";
	exit();
}

require("../php/conexion.php");
$ql="select * from usuarios where nombre='$nombre' and not idusuario='$id' and not tipo='concejal'";
$sql="select * from usuarios where idusuario='$id' and clave='$clave' and not tipo='concejal'";
$sql2="update usuarios set nombre='$nombre' where idusuario='$id' and clave='$clave' and not tipo='concejal'";

$base = new Conexion();
$base->conectar();
$resultado = $base->consultar($sql);
if($resultado == 1){
	$result = $base->consultar($ql);
	 	if($result == 1){
			echo "<h3>Error ya exites un operador con esa clave</h3>";
			exit();
		}
$base->actualizar($sql2);
$_SESSION['nombre']=$nombre;
$resultado->close();
$base->cerrar();
}else{
echo "<h3>Error Clave Invalida</h3>";
}

}else{
echo "<h3>error todos los datos son obligatorios</h3>";
}
}else{
header("Location: index.php");
}
?>
