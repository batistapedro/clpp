<?php
session_start();
if(isset($_SESSION['tipo'])){
if(isset($_POST['ver']) && !empty($_POST['ver'])){
//capturando la variable enviada por le metodo post
//saniando todos los datos que viene por el metodo post
$ids =intval(trim(htmlspecialchars($_POST['ver'])));
// llamando al archivo de conexion
require("../php/conexion.php");
//creando un objeto de la clase conexion
$base  = new Conexion();
//seleccionamos todos guardado en la tabla noticias donde el id seas igual al dato enviado por el metodo post
$sqlver="select * from noticias where id='$ids'";
//ejecutamos la funcion conectar
$base->conectar();
$datos = $base->consultar($sqlver);
if($datos==1){
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
<meta charset="utf-8">
<!--<link rel="stylesheet" href="../css/vernoticiasdentro.css">-->
<style type="text/css">

#noticiasfuerasfecha{
font:bold 0.8em sans;
color:rgba(0,0,244,0.9);
width:200px;
height:22px;
text-align:left;
margin-left:12px;
}
#noticiasfueras{
font:1.3em Liberation Serif;
color:rgba(0,0,0,0.7);
text-align:left;
margin:12px;
padding:5px;
}
#noticiasfuerastitulos{
font: 1.8em Liberation Serif;
color:rgba(244,1,1,0.7);
margin:5px 0px 5px 0px;
text-align:center;
padding:10px;
}
#noticiasfuerasimage{
width:75%;
height:340px;
text-align:center;
}
</style>
</head>
<body>

<div id="noticiasfuerastitulos"><?php echo $ver[1];?></div>
<div id="noticiasfuerasfecha"> Fecha : <?php echo $ver[0];?></div>
<img style="margin:auto;" class="img img-resposive" src="<?php echo '../'.$ver[2];?>" id="noticiasfuerasimage">
<div id="noticiasfueras"><?php echo $ver[3];?></div>
</body>
</html>

<?php
}else{
echo "<h3>Error al obtener noticias</h3>";
}
}
}else{
	echo "
			<script>
				window.location='../index.php';
			</script>
		 ";
}

?>
