<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<?php
if($_SESSION['tipo']=="administrador"||($_SESSION['tipo']=="operador")){
if(isset($_POST['id']) && !empty($_POST['id'])){

$id = intval(trim(htmlspecialchars($_POST['id'])));

$sqlver = "select * from noticias where id='$id'";
require("../php/conexion.php");
$base = new Conexion();
$base->conectar();
$ver = $base->extraer($sqlver);

while($datos = $ver->fetch_array()){
?>
<form role="form">
	<div class="form-group hidden">
		<input type='text' value="<?php echo $datos['id'];?>" id="inputid">
	</div>
	<label for="textareatitulo">titulo:</label>
	<div class="form-group">
	 	<textarea class="form-control" id="textareatitulo" maxlength="87" rows="3" cols="70"><?php echo strip_tags($datos['titulo']);?></textarea>
	</div>
	<label for="textareanoticia">noticias:</label>
	<div class="form-group">
 		<textarea class="form-control" id='textareanoticia' maxlength="3000" rows="3" cols="70"><?php echo strip_tags($datos['noticia']);?></textarea>
	</div>
	<div class="form-group">
		<button type="button" class="btn btn-success" value="Enviar" id="enviarnoticiaseditada" title="Enviar"><span class="glyphicon glyphicon-ok-sign"></span> Enviar</button>
		<button type="button" class="btn btn-danger" value="Cancelar" id="cancelarnoticiaseditada" title="Cancelar"><span class="glyphicon glyphicon-remove-sign"></span> Cancelar</button>
	</div>
</form>
<?php
}
?>



<?php
}
?>
<script src="../javascript/editarnoticias.js"> </script>
</body>
</html>
<?php
}else{
echo "<script>
        window.location='../index.php';
    </script>";

}
?>
