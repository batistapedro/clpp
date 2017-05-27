<?php
session_start();
$sql=null;
$base=null;
$fila=null;
$ver = null;
//codicional para que los datos no pueda ser enviado vacio
if(isset($_POST['nombre']) && !empty($_POST['nombre']) && isset($_POST['clave']) && !empty($_POST['clave']) && isset($_POST['tipo']) && !empty($_POST['tipo'])&& isset($_POST['codigo'])&& !empty($_POST['codigo'])){
$codigo=trim(htmlspecialchars($_POST['codigo']));
//validando captcha
if($_SESSION['texto']!=$codigo){
echo "<h3>error datos no cohinciden con la imagen</h3>";
?>

<script>
// javascript en caso de no cohincidir me envia al usuario al index de lapagina
setInterval(function(){
window.location="index.php";
},6000);
</script>
<?php
}
else
{
	// capturando todos los datos del formualrio
	// saniando los datos, encriptando claves de usuarios
	$nombre = trim(htmlspecialchars($_POST['nombre']));
	$clave = hash('ripemd160',$_POST['clave']);
	$tipo = trim(htmlspecialchars($_POST['tipo']));
	//llamando al archivo de conexion a la base de datos
	require("../php/conexion.php");
	//creando un objeto
	$base = new Conexion();
	// switch para ver que tipo usuario desea iniciar session
	switch($tipo){
		// en caso de  que el usuario sea de consejo comunales
	case  "consejos":

	$nombre = ucwords($nombre);
	//validando el rif
	if(!preg_match("/^[J]{1}[-]{1}[0-9]{8}[-]{1}[0-9]{1}+$/",$nombre))
	{
		echo "<h3>Error en rif, verifique que el rif tenga 12 digito por ejemplo : j-00000000-0 </h3>";
		exit();
	}
	$sql="select nombre_gestion, idgestion_social from gestion_social where rif='$nombre' and clave_gestion='$clave' and tipo_gestion='consejo'";
	$base->conectar();
	$ver = $base->consultar($sql);
	//en caso de que exista
	if($ver==1)
	{
		//crenado variables de session
		while($fila = $ver->fetch_array()){
		$_SESSION['nombre']= $fila['nombre_gestion'];
		$_SESSION['id']= $fila['idgestion_social'];
	}
		$_SESSION['tipo']="consejos";
		$ver->close();
		$base->cerrar();
?>
<script>
//bienvenida al usuario y enviandolo a la pagina de inicio
alert("Bienvenido al sistema <?php echo $_SESSION['nombre'];?>");
window.location="administrador/inicio.php"</script>
<?php
}else{
echo "<h3>Usuario o Clave Invalido</h3>";
exit();
}
break;
//en caso de que se el  usuario de tipo comuna
case "comunas":
$nombre = ucwords($nombre);
	if(!preg_match("/^[J]{1}[-]{1}[0-9]{8}[-]{1}[0-9]{1}+$/",$nombre))
	{
		echo "<h3>Error en rif, verifique que el rif tenga 12 digito por ejemplo : j-00000000-0 </h3>";
		exit();
	}
$sql="select nombre_gestion, idgestion_social from gestion_social where rif='$nombre' and clave_gestion='$clave' and tipo_gestion='comuna'";
$base->conectar();
$ver = $base->consultar($sql);
	if($ver==1)
	{
		while($fila = $ver->fetch_array()){
		$_SESSION['nombre']= $fila['nombre_gestion'];
		$_SESSION['id']= $fila['idgestion_social'];
}
		$_SESSION['tipo']="comunas";
		$ver->close();
		$base->cerrar();
?>
<script>
alert("Bienvenido al sistema <?php echo $_SESSION['nombre'];?>");
window.location="administrador/inicio.php"
</script>
<?php
}else{
echo "<h3>Usuario o Clave Invalido</h3>";
exit();
}
break;
//en caso que el usuario sea de tipo movimientos sociales
case "movimientos":
$nombre = ucwords($nombre);
	if(!preg_match("/^[J]{1}[-]{1}[0-9]{8}[-]{1}[0-9]{1}+$/",$nombre))
	{
		echo "<h3>Error en rif, verifique que el rif tenga 12 digito por ejemplo : j-00000000-0 </h3>";
		exit();
	}
$sql="select nombre_gestion,idgestion_social from gestion_social where rif='$nombre' and clave_gestion='$clave' and tipo_gestion='movimiento'";
$base->conectar();
$ver = $base->consultar($sql);
if($ver==1){
while($fila = $ver->fetch_array()){
$_SESSION['nombre']= $fila['nombre_gestion'];
$_SESSION['id']= $fila['idgestion_social'];
}
$_SESSION['tipo']="movimientos";
$ver->close();
$base->cerrar();
?>
<script>
alert("Bienvenido al sistema <?php echo $_SESSION['nombre'];?>");
window.location="administrador/inicio.php"</script>
<?php
}else{
echo "<h3>Usuario o Clave Invalido</h3>";
exit();
}
break;
// en caso que el usuario sea un concejal que quiere iniciar session en el sistema
case "concejales":
$nombre = ucwords($nombre);

	if(strlen($nombre)>10 || (strlen($nombre)<9)){
		echo "<h3>error en cedula, cedula no pude ser mayor a 10 digito ni menor a 9  ejemplo : v-00000000</h3>";
		exit();
	}
	$a=str_split($nombre);
	if($a[0]!="v" and ($a[0]!="e" and ($a[0]!='V' and ($a[0]!="E")))){
		echo "<h3>Error en la nacionalida de la cedula</h3>";
		exit();
	}

$sql="select nombre, idusuario, tipo from usuarios where cedula='$nombre' and clave='$clave' and tipo='concejal'";
$base->conectar();
$ver = $base->consultar($sql);
if($ver==1){
while($fila = $ver->fetch_array()){
$_SESSION['nombre']= $fila['nombre'];
$_SESSION['tipo']= $fila['tipo'];
$_SESSION['id']= $fila['idusuario'];
}
$ver->close();
$base->cerrar();
?>
<script>
alert("Bienvenido al sistema <?php echo $_SESSION['nombre'];?>");
window.location="administrador/inicio.php";
</script>
<?php
}else{
echo "<h3>Usuario o Clave Invalido</h3>";
exit();
}
break;
//en caso que el usuario sea el administrador o perador.
case "administrador":
$sql="select nombre, idusuario, tipo from usuarios where nombre='$nombre' and clave='$clave' and not tipo='concejal'";
$base->conectar();
$ver = $base->consultar($sql);
if($ver==1){
while($fila= $ver->fetch_array()){
$_SESSION['nombre']=$fila['nombre'];
$_SESSION['tipo']= $fila['tipo'];
$_SESSION['id']=$fila['idusuario'];
}
$ver->close();
$base->cerrar();
?>
<script>
alert("Bienvenido al sistema <?php echo $nombre;?>");
window.location="administrador/inicio.php";
</script>
<?php
}else{
echo "<h3>Usuario o clave Invalido</h3>";
exit();
}
break;
}
}

}else{
echo "<h3>Todos Los Datos Son Obligatorios</h3>";
}
?>
