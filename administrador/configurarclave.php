<?php
session_start();
if(isset($_SESSION['nombre']) && !empty($_SESSION['nombre']) && isset($_SESSION['tipo']) && !empty($_SESSION['tipo']) && isset($_SESSION['id'])&& !empty($_SESSION['id'])){
$mensaje = null;
if(isset($_POST['clave'])&& !empty($_POST['clave']) && isset($_POST['nueva'])&& !empty($_POST['nueva']) && isset($_POST['nueva1']) && !empty($_POST['nueva1'])
&& isset($_POST['id'])&& !empty($_POST['id'])&& isset($_POST['tipo'])&& !empty($_POST['tipo'])){

$clave = hash('ripemd160',$_POST['clave']);
$nueva = hash('ripemd160',$_POST['nueva']);
$nueva1 =hash('ripemd160',$_POST['nueva1']);
$nnueva=trim(htmlspecialchars($_POST['nueva']));
$nnueva1=trim(htmlspecialchars($_POST['nueva1']));
$id = intval(trim(htmlspecialchars($_POST['id'])));
$tipo = trim(htmlspecialchars($_POST['tipo']));

if($nueva !=$nueva1){
$mensaje="<h3>error la nueva clave no son iguales</h3>";
}else if(strlen($nnueva)&& strlen($nnueva1)<6){
$mensaje="<h3>error clave debe ser igual o mayor a 6 digitos</h3>";
}else if(strlen($nnueva)>12){
$mensaje="<h3>error clave no puede ser mayor a 12 digitos</h3>";
}else{
require("../php/conexion.php");
switch($tipo){

case "administrador":
	$sql="select * from usuarios where idusuario='$id' and clave='$clave' and tipo='administrador'";
	$sql2="update usuarios set clave='$nueva' where idusuario='$id' and clave='$clave' and tipo='administrador' ";
	$base = new Conexion();
	$base->conectar();
	$ver = $base->consultar($sql);
	if($ver==1){
	$base->actualizar($sql2);
	$ver->close();
	$base->cerrar();
	}else{
	echo "<h3>error clave actual invalida</h3>";
	}
break;
case "operador":
	$sql="select * from usuarios where idusuario='$id' and clave='$clave' and tipo='operador'";
	$sql2="update usuarios set clave='$nueva' where idusuario='$id' and clave='$clave' and tipo='operador'";
	$base = new Conexion();
	$base->conectar();
	$ver = $base->consultar($sql);
	if($ver==1){
	$base->actualizar($sql2);
	$ver->close();
	$base->cerrar();
	}else{
	echo "<h3>error clave actual invalida</h3>";
	}
	break;
case "concejal":
	$sql="select *from usuarios where idusuario='$id' and clave='$clave' and tipo='concejal'";
	$sql2="update usuarios set clave='$nueva' where idusuario='$id' and clave='$clave' and tipo='concejal'";
	$base = new Conexion();
	$base->conectar();
	$ver = $base->consultar($sql);
	if($ver==1){
	$base->actualizar($sql2);
	$ver->close();
	$base->cerrar();
	}else{
	echo "<h3>error clave actual invalida</h3>";
	}
break;
case "consejos":
$sql ="select * from gestion_social where idgestion_social='$id' and clave_gestion ='$clave' and tipo_gestion='consejo'";
$sql2="update gestion_social set clave_gestion='$nueva' where idgestion_social='$id' and clave_gestion='$clave' and tipo_gestion='consejo'";
$base = new Conexion();
$base->conectar();
$ver = $base->consultar($sql);
if($ver==1){
$base->actualizar($sql2);
$ver->close();
$base->cerrar();
}else{
echo "<h3>error clave actual invalida</h3>";
}
break;
case "comunas":
$sql="select * from gestion_social where idgestion_social='$id' and clave_gestion='$clave' and tipo_gestion='comuna'";
$sql2="update gestion_social set clave_gestion='$nueva' where idgestion_social='$id' and clave_gestion='$clave' and tipo_gestion='comuna'";
$base = new Conexion();
$base->conectar();
$ver = $base->consultar($sql);
if($ver==1){
$base->actualizar($sql2);
$ver->close();
$base->cerrar();
}else{
echo "<h3>error clave actual invalida</h3>";
}
break;
case "movimientos":
$sql="select * from gestion_social where idgestion_social='$id' and clave_gestion='$clave' and tipo_gestion='movimiento'";
$sql2="update gestion_social set clave_gestion='$nueva' where idgestion_social='$id' and clave_gestion='$clave' and tipo_gestion='movimiento'";
$base = new Conexion();
$base->conectar();
$ver = $base->consultar($sql);
if($ver==1){
$base->actualizar($sql2);
$ver->close();
$base->cerrar();
}else{
echo "<h3>error clave actual invalida</h3>";
}
break;
default :
echo "error";
break;
}
}

}else{
$mensaje="<h3>Error todos los campo son obigatorios</h3>";
}
echo $mensaje;
}else{
header("Location:index.php");
}
?>
