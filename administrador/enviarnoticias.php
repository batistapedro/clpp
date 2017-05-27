<?php
session_start();
if(isset($_POST['titulo'])&& !empty($_POST['titulo'])&& isset($_FILES['imagen']['name'])&& !empty($_FILES['imagen']['name'])&& isset($_POST['datos'])&& !empty($_POST['datos'])){
$datos=nl2br(trim(htmlspecialchars($_POST['datos'])));
$titulo=trim(htmlspecialchars($_POST['titulo']));
$ruta="../archivosnoticias/";
$rutas2="archivosnoticias/";
$fecha = date("Y-m-d");
if($_FILES['imagen']['error']== UPLOAD_ERR_OK ){
$nombre = $_FILES["imagen"]["name"];
$temporal = $_FILES["imagen"]["tmp_name"];
$tipo = $_FILES['imagen']['type'];

if(file_exists("../archivosnoticias/".$nombre)){
$temp=$nombre;
$nombre=chr(rand(65,90)).$temp;
}

if($tipo=="image/jpg"||($tipo=="image/png" || $tipo=="image/jpeg")){
move_uploaded_file($temporal, $ruta.$nombre);

}else{

	echo "<h3>Error formato de imagen no es permitida</h3>";
	exit();
}



}else{
echo "<h3>Error al subir imagen ".$_FILES['imagen']['error']."</h3>";
exit();
}

require("../php/conexion.php");
$con = new Conexion();
$con->conectar();
$url=$rutas2.$nombre;
$sql="insert into noticias(id,noticia,titulo,direccion,fecha)values('','$datos','$titulo','$url','$fecha')";
$con->agregar($sql);
$con->cerrar();
}else{
echo "<h3> error no puede enviar datos vacios </h3>";
}
?>
