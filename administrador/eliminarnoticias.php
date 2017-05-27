<?php
session_start();
if(isset($_SESSION['tipo'])&& ($_SESSION['tipo']=="administrador") || ($_SESSION['tipo']=="operador")){
if(isset($_POST['id'])&& !empty($_POST['id'])){
$base = null;
$sqlver=null;
$sqlver1=null;
$fotos=null;
$id=null;
$ver=null;
$id= intval(trim(htmlspecialchars($_POST['id'])));
require("../php/conexion.php");
$base = new Conexion();
$base->conectar();
$sqlver="select direccion from noticias where id='$id'";
$sqlver1="delete from noticias where id='$id'";
$datos = $base->consultar($sqlver);
if($datos==1){
$datos3 = $base->extraer($sqlver);
$ver = $datos3->fetch_array();
$fotos = $ver['direccion'];
if(file_exists("../".$fotos)){
unlink("../".$fotos);
}
$base->eliminar($sqlver1);
}
$base->cerrar();
}else{
echo "<h3>Error al eliminar noticias</h3>";
}
}else{
?>
<script>
window.location="../index.php";
</script>
<?php
}

?>
