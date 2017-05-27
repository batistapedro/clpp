<?php
session_start();

if(isset($_POST['tituloeditada'])&& !empty($_POST['tituloeditada']) && isset($_POST['noticiaeditada'])&&
!empty($_POST['noticiaeditada'])&& isset($_POST['idnoticiaseditada'])&& !empty($_POST['idnoticiaseditada'])){

$id      = intval(trim(htmlspecialchars($_POST['idnoticiaseditada'])));
$titulo  = trim(htmlspecialchars($_POST['tituloeditada']));
$noticia = nl2br(trim(htmlspecialchars($_POST['noticiaeditada'])));

$sqlver  = "select * from noticias where id=$id limit 1";
$sqlver2 = "update noticias set titulo='$titulo', noticia='$noticia' where id='$id'";

require("../php/conexion.php");
$base = new Conexion();
$base->conectar();
$datos = $base->consultar($sqlver);
if($datos==1){
$base->actualizar($sqlver2);

}
$base->cerrar();
$datos->close();



}else{

echo "<h3>Error todos los datos son obligatorios</h3>";
}



?>
