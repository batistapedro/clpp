<?php
session_start();
$base=null;
$sql2=null;

require("../php/conexion.php");
if(isset($_GET) && count($_GET)>0){
$sql2="select *from consejales order by idconsejal asc";
$base = new Conexion();
$base->conectar();
$ver = $base->extraer($sql2);
$datos = array();
while($consejal=$ver->fetch_array()){
$datos[]=array(
				"id"=>$consejal["idconsejal"],
				"nombre"=>$consejal["nombre"],
				"apellido"=>$consejal["apellido"],
				"cedula"=>$consejal["cedula"],
				"telefono"=>$consejal["telefono"],
				"clave"=>$consejal["clave"],
				"parroquia"=>$consejal['parroquia']
);
}
$base->cerrar();
echo json_encode($datos);
}



?>
