<?php
session_start();
if(isset($_POST['cedula'])&& !empty($_POST['cedula'])&& isset($_POST['cargo'])&& !empty($_POST['cargo'])&& isset($_POST['tipo'])&& !empty($_POST['tipo'])&& isset($_POST['relacion']) && !empty($_POST['relacion'])&& isset($_POST['codigo'])&& !empty($_POST['codigo'])&& isset($_POST['gestion'])&& !empty($_POST['gestion'])){


$cedula = trim(htmlspecialchars($_POST['cedula']));
$cargo = trim(htmlspecialchars($_POST['cargo']));
$tipo = trim(htmlspecialchars($_POST['tipo']));
$relacion = trim(htmlspecialchars($_POST['relacion']));
$codigo = trim(htmlspecialchars($_POST['codigo']));
$gestion = trim(htmlspecialchars($_POST['gestion']));

if($gestion=="consejos"){
     if($relacion=="rif"){

    if(!preg_match("/^[J]{1}[\-]{1}[0-9]{8}[\-]{1}[0-9]{1}+$/",ucwords($codigo))){
    echo "<h3>Error en Rif, Rif debe ser igual ejemplo: J-12345678-1</h3>";
    exit();
    }else if(!preg_match("/^[e-vE-V]{1}[\-]{1}[0-9]+$/",$cedula)){
	echo "<h3>error cedula invalida</h3>";
	exit();
	}else if(strlen($cedula)>10 || strlen($cedula)<9){
	echo "<h3>error cedula debe ser igual a 8 digitos o a 7 digitos, ejemplo 19871554</h3>";
	exit();
	}else{
	if(!preg_match("/^[a-zA-Zñ-Ñ\s\,]+$/",$cargo)){
	echo "<h3>error cargo solo debe poseer letras</h3>";
	exit();
	}else{
$sqlver="select * from integrantes_gestion where cedula='$cedula' and consejo=1 limit 1";
$sqlver2="select idintegrantes_gestion from integrantes_gestion where cedula='$cedula' and consejo=1 limit 1";
$sql="select idgestion_social from gestion_social where rif ='$codigo' and tipo_gestion='comuna'";
require("../php/conexion.php");
$base = new Conexion();
$base->conectar();
$ver2=$base->consultar($sqlver);
if($ver2==1){
$ver3= $base->extraer($sqlver2);
while($fila= $ver3->fetch_array()){
$idintegrantes_gestion = $fila['idintegrantes_gestion'];
}
$ver = $base->consultar($sql);
if($ver==1){
$datos = $base->extraer($sql);
while($fila = $datos->fetch_array()){
$idgestion_social = $fila['idgestion_social'];
}
$sql3="select idintegrantes_gestion from integrantes_gestion where idintegrantes_gestion='$idintegrantes' and comuna=1";
$nuevo = $base->consultar($sql3);
if($nuevo==1){
echo "<h3>error integrantes ya esta registrado en la comuna</h3>";
$base->cerrar();
exit();
}else{

$sqlver7="select * from integrantes_gestion where cedula='$cedula' and  comuna=1 and consejo=1";
$verr=$base->consultar($sqlver7);
if($verr==1){
echo "<h3>Error integrantes ya esta registrado en comuna</h3>";
exit();
}else{

$sqlwer="UPDATE integrantes_gestion SET comuna=1, idcomuna='$idgestion_social' WHERE cedula='$cedula'";
$base->agregar($sqlwer);

$sql2="INSERT INTO cargo_integrantes_gestion(idcargos_integrantes_gestion,cargo,tipo,unidad,idintegrantes_gestion,idgestion_social) VALUES ('','$cargo','$tipo',NULL,'$idintegrantes_gestion','$idgestion_social')";
$base->agregar2($sql2);
$base->cerrar();
}
}
}else{
echo "<h3>error ".$relacion." no existe en el sistema</h3>";
$base->cerrar();
exit();
}
}else{
echo "<h3>Error integrante no esta registrado en un Consejos Comunal</h3>";
$base->cerrar();
}
}
}



    }else if($relacion=="codigo"){
    if(!preg_match("/^[c]{1}[m]{1}[\-]{1}[0-9]{8}[\-]{1}[0-9]+$/",$codigo)){
    echo "<h3>Error en Codigo codigo debe ser igual ejemplo: cm-20120112-1</h3>";
    exit();
    }else if(!preg_match("/^[E-Ve-v]{1}[\-]{1}[0-9]+$/",$cedula)){
	echo "<h3>error cedula invalida</h3>";
	exit();
	}else if(strlen($cedula)>10 || strlen($cedula)<9){
	echo "<h3>error cedula debe ser igual a 8 digitos o a 7 digitos, ejemplo 19871554</h3>";
	exit();
	}else{
	if(!preg_match("/^[a-zA-Z\s]+$/",$cargo)){
	echo "<h3>error cargo solo debe poseer letras</h3>";
	exit();
	}else{
$sqlver="select * from integrantes_gestion where cedula='$cedula' and consejo=1";
$sqlver2="select idintegrantes_gestion from integrantes_gestion where cedula='$cedula' and consejo=1";
$sql="select idgestion_social from gestion_social where codigo_gestion='$codigo' and tipo_gestion='comuna'";

require("../php/conexion.php");
$base = new Conexion();
$base->conectar();
$ver2=$base->consultar($sqlver);

if($ver2==1){
$ver3= $base->extraer($sqlver2);
while($fila= $ver3->fetch_array()){
$idintegrantes_gestion = $fila['idintegrantes_gestion'];
}
$ver = $base->consultar($sql);
if($ver==1){
$datos = $base->extraer($sql);
while($fila = $datos->fetch_array()){
$idgestion_social = $fila['idgestion_social'];
}
$sql3="select * from integrantes_gestion where idintegrantes_gestion='$idintegrantes_gestion' and comuna=1";
$nuevo = $base->consultar($sql3);
if($nuevo==1){
echo "<h3>error integrante ya esta registrado  en la comuna</h3>";
$base->cerrar();
exit();
}else{
$sqlwer="UPDATE integrantes_gestion SET comuna=1,idcomuna='$idgestion_social' WHERE cedula='$cedula'";
$base->agregar($sqlwer);
$sql2="INSERT INTO cargo_integrantes_gestion(idcargos_integrantes_gestion,cargo,tipo,unidad,idintegrantes_gestion,idgestion_social) VALUES ('','$cargo','$tipo',NULL,'$idintegrantes_gestion','$idgestion_social')";
$base->agregar2($sql2);
$base->cerrar();
}
}else{
echo "<h3>error ".$relacion." no existe en el sistema</h3>";
$base->cerrar();
exit();
}
}else{
echo "<h3>Error integrante no esta registrado en un consejos comunal</h3>";
$base->cerrar();


    }
    }
    }
    }


}else{
	echo "<h3>Error En Datos</h3>";
}

}else{
echo "<h3>Error todos los datos son obligatorios</h3>";
}

?>
