<?php
session_start();
if(isset($_SESSION['tipo'])&& !empty($_SESSION['tipo'])){
if($_SESSION['tipo']=="administrador"){
$base=null;
$sql=null;
if(isset($_POST['ver'])&& !empty($_POST['ver'])){
    $ver = intval(trim(htmlspecialchars($_POST['ver'])));
$sql="select idusuario from usuarios where idusuario='$ver' and tipo='concejal' and estatu='activo'";
    require("../php/conexion.php");
    $base = new Conexion();
    $base->conectar();
    $consult=$base->consultar($sql);
    if($consult==1){
        echo "<h3>Error concejal esta activo en el sistema</h3>";
        $base->cerrar();
        exit();
    }

    $base->cerrar();
    $campo="estatu";
    $valor="activo";
$sql = "update usuarios set ".$campo."='".$valor."' where idusuario='".$ver."' limit 1";
$base = new Conexion();
$base->conectar();
$base->recuperar($sql);
$base->cerrar();

}else{
echo "<h3>Error al capturar datos</h3>";
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
