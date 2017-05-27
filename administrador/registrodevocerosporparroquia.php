<?php
session_start();
if(isset($_POST['tipo'])&& !empty($_POST['tipo'])&& isset($_POST['cedula'])&& !empty($_POST['cedula'])){
$tipo= trim(htmlspecialchars($_POST['tipo']));
$cedula= trim(htmlspecialchars($_POST['cedula']));

$a=str_split($cedula);
if($a[0]!="V" && ($a[0]!="E")){
	echo "<h3>Error en la nacionalidad de la cedula</h3>";
	exit();
}

if(!preg_match("/^[E-Ve-v]{1}[\-]{1}[0-9]+$/",$cedula)){
echo "<h3>Error cedula invalida, cedula debe poseer solo numero</h3>";
exit();
}else if(strlen($cedula)>10 ||(strlen($cedula)<9)){
echo "<h3>error cedula debe ser igual a 8 digitos o a 7 digitos, ejemplo 19871554</h3>";
exit();
}else{
if($tipo=="consejos"){
$sqlver ="select idintegrantes_gestion from integrantes_gestion where cedula='$cedula' and consejo=1";
require("../php/conexion.php");
$base = new Conexion();
$base->conectar();
$datos = $base->consultar($sqlver);
if($datos==1){
	$datos1= $base->extraer($sqlver);
	while($fila=$datos1->fetch_array()){
		$idintegrantes_gestion=$fila['idintegrantes_gestion'];
	}
$sqlver2="select * from voceros_parroquia where idintegrantes_gestion='$idintegrantes_gestion' and  consejo=1";
$datos2=$base->consultar($sqlver2);
if($datos2==1){
	echo "<h3>error integrante ya esta registrado en el sistema</h3>";
$datos->close();
$datos2->close();
$datos1->close();
$base->cerrar();
exit();
}else{
$sqlver4="INSERT INTO voceros_parroquia(idvoceros,idintegrantes_gestion,consejo,movimiento) VALUES ('','$idintegrantes_gestion',1,0)";
$base->agregar($sqlver4);
$base->cerrar();
}
}else{
echo "<h3>Error vocero no esta registrado en el sistema</h3>";
exit();
}

}else if($tipo=="movimientos"){
$sqlver ="select idintegrantes_gestion from integrantes_gestion where cedula='$cedula' and movimiento=1";
require("../php/conexion.php");
$base = new Conexion();
$base->conectar();
$datos = $base->consultar($sqlver);
if($datos==1){
	$datos1 = $base->extraer($sqlver);
	while($fila=$datos1->fetch_array()){
		$idintegrantes_gestion=$fila['idintegrantes_gestion'];
	}
$sqlver2="select * from voceros_parroquia where idintegrantes_gestion='$idintegrantes_gestion' and movimiento=1";
$datos2=$base->consultar($sqlver2);
if($datos2==1){
	echo "<h3>Error integrante ya esta registrado</h3>";
$datos->close();
$datos2->close();
$datos1->close();
$base->cerrar();
exit();
}else{
$sqlver4="INSERT INTO voceros_parroquia(idvoceros,idintegrantes_gestion,consejo,movimiento) VALUES ('','$idintegrantes_gestion',0,1)";
$base->agregar($sqlver4);
$base->cerrar();
}

}else{
echo "<h3>Error vocero no esta registrado en el sistema</h3>";
exit();
}
}else{
	echo "<h3>Error datos erroneos en elegir getion social</h3>";
}
}

}else{
echo "<h3>Error todos los datos son obligatorios</h3>";
exit();
}
?>
