<?php
session_start();
if(isset($_POST['nombre'])&& !empty($_POST['nombre'])&& isset($_POST['clave'])&& !empty($_POST['clave'])){
$nombre = trim(htmlspecialchars($_POST['nombre']));

if(strlen($_POST['clave'])<6){
	echo "<h3>Error en clave, clave debe ser mayor a 5 digitos</h3>";
	exit();
}
$clave = hash('ripemd160',$_POST['clave']);
$tipo="operador";
if(!preg_match("/^[a-zA-Zñ-Ñ]+$/",$nombre)){
echo "<h3>Error nombre solo debe poseer letras</h3>";
exit();
}
require("../php/conexion.php");
$sql="select nombre, clave from usuarios where nombre='$nombre' and tipo='operador'";
$sql2="insert into usuarios(idusuario,nombre,apellido,cedula,telefono,clave,tipo) value('','$nombre',NULL,NULL,NULL,'$clave','$tipo')";
$base = new Conexion();
$base->conectar();
$ver = $base->consultar($sql);
if($ver==1){
echo "<h3>Error  nombre del operador ya esta registrado en el sistema</h3>";
exit();
$base->cerrar();
}else{
$base->agregar($sql2);
$base->cerrar();
}
}else{
echo "<h3>Error todos los datos son obligatorios</h3>";
}
?>
