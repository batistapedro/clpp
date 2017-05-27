<?php
if(isset($_POST['ver']) && !empty($_POST['ver'])){

$ids =intval(trim(htmlspecialchars($_POST['ver'])));

require("../php/conexion.php");
$base  = new Conexion();

$sqlver="select * from noticias where id='$ids'";
$base->conectar();
$datos = $base->consultar($sqlver);
if($datos== 1){
$verdata = $base->extraer($sqlver);
while($ver2 = $verdata->fetch_array()){
$ver=array(
$ver2['fecha'],
$ver2['titulo'],
$ver2['direccion'],
$ver2['noticia']
);
}
$base->cerrar();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/vernoticiasfuera.css">
</head>
<body>

<div id="noticiasfuerastitulos"><?php echo $ver[1];?></div>
<div id="noticiasfuerasfecha"> Fecha : <?php echo $ver[0];?></div>
<img src="<?php echo $ver[2];?>" id="noticiasfuerasimage">
<div id="noticiasfueras"><?php echo $ver[3];?></div>
</body>
</html>

<?php
}else{
echo "<h3>Error al obtener noticias</h3>";
}
}

?>
