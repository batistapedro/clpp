<?php
session_start();
$base = null;
if(isset($_POST['campo'])&& !empty($_POST['campo']) && isset($_POST['nuevovalor'])&& !empty($_POST['nuevovalor'])&& isset($_POST['id'])&& !empty($_POST['id'])&&
isset($_POST['tipo'])&& !empty($_POST['tipo']) && isset($_POST['idcomuna'])){

$campo = trim(htmlspecialchars($_POST['campo']));
$valor = trim(htmlspecialchars($_POST['nuevovalor']));
$id = intval(trim(htmlspecialchars($_POST['id'])));
$tipo = trim(htmlspecialchars($_POST['tipo']));
$idcomuna=intval(trim(htmlspecialchars($_POST['idcomuna'])));
if($campo=="clave_gestion"){
$valor = hash('ripemd160',$valor);
}
require("../php/conexion.php");
if($tipo=="comuna"){

    if($campo=="parroquia"){
        if(!preg_match("/^[a-zA-Z\s]+$/",$valor)){
            echo "<h3>Error en parroquia</h3>";
            exit();
        }
$tgh= array("MARHUANTA","Marhuanta","marhuanta","Zea","zea","ZEA","sabanita","Sabanita","SABANITA",
"Catedral","catedral","CATEDRAL","orinoco","Orinoco","ORINOCO","Panapana","panapana","PANAPANA",
"Agua Salada","agua salada","AGUA SALADA","Agua salada","agua Salada","Vista Hermosa","vista Hermosa",
"Vista hermosa","VISTA HERMOSA","vista hermosa","jose antonio paez","Jose Antonio Paez","jose Antonio Paez","jose antonio Paez","Jose antonio paez","Jose Antonio paez");
$conntadd = 0;
for($i=0;$i<count($tgh);$i++){
    if($valor!=$tgh[$i]){
    $conntadd=$conntadd+1;
    }
    }
    if($conntadd==count($tgh)){
    echo "<h3>Error en parroquia, parroquia no existe</h3>";
    exit();
    }
    }else if($campo=="rif"){
        if(!preg_match("/^[J]{1}[\-]{1}[0-9]{8}[\-]{1}[0-9]{1}+$/",$valor)){
        echo "<h3>Error en rif</h3>";
        exit();
        }
         $sql="select rif from gestion_social where rif='$valor' and tipo_gestion='comuna' and not idgestion_social='$id'";
         $base = new Conexion();
         $base->conectar();
         $consulta= $base->consultar($sql);
         if($consulta==1){
            echo "<h3>Error rif ya estas registrado en una comuna</h3>";
            $base->cerrar();
            exit();
         }

    }else if($campo=="fecha_inicio"){
        if(!preg_match("/^[0-9]{4}[\-]{1}[0-9]{2}[\-]{1}[0-9]{2}+$/",$valor)){
        echo "<h3>Error en fecha de inicio</h3>";
        exit();
        }else{
        $nuevafecha= Date("Y-m-d");
        if($valor > $nuevafecha){
        echo "<h3>Error fecha no puede ser mayor a fecha actual</h3>";
        exit();
        }

        }
    }else if($campo=="fecha_registro"){
        if(!preg_match("/^[0-9]{4}[\-]{1}[0-9]{2}[\-]{1}[0-9]{2}+$/",$valor)){
        echo "<h3>Error en fecha de adecuacion</h3>";
        exit();
        }else{
        $nuevafecha= Date("Y-m-d");
        if($valor > $nuevafecha){
        echo "<h3>Error fecha no puede ser mayor a fecha actual</h3>";
        exit();
        }

        }
    }else if($campo=="fecha_vencimiento"){
         if(!preg_match("/^[0-9]{4}[\-]{1}[0-9]{2}[\-]{1}[0-9]{2}+$/",$valor)){
        echo "<h3>Error en fecha de adecuacion</h3>";
        exit();
        }
    }

$sql = "update gestion_social set ".$campo."='".$valor."' where idgestion_social='".$id."' and tipo_gestion='comuna' limit 1";
$base = new Conexion();
$base->conectar();
$base->actualizar($sql);
$base->cerrar();
}else if($tipo=="documentos"){

    if($campo=="acta"){
        if(!preg_match("/^[a-zA-Z]{2}+$/",$valor)){
            echo "<h3>Error en acta</h3>";
            exit();
        }
    if($valor!="SI" && ($valor!="si" && ($valor!="Si" &&($valor!="no"&&($valor!="NO"&&($valor!="No")))))){
    echo "<h3>Error en acta</h3>";
    exit();
        }
    }else if($campo=="constancia"){
        if(!preg_match("/^[a-zA-Z]{2}+$/",$valor)){
            echo "<h3>Error en constancia</h3>";
            exit();
        }
    if($valor!="SI" && ($valor!="si" && ($valor!="Si" &&($valor!="no"&&($valor!="NO"&&($valor!="No")))))){
    echo "<h3>Error en constancia</h3>";
    exit();
        }

    }else if($campo=="cedulas"){
        if(!preg_match("/^[a-zA-Z]{2}+$/",$valor)){
            echo "<h3>Error en documentos cedula</h3>";
            exit();
        }
    if($valor!="SI" && ($valor!="si" && ($valor!="Si" &&($valor!="no"&&($valor!="NO"&&($valor!="No")))))){
    echo "<h3>Error en documentos cedulas</h3>";
    exit();
        }

    }else if($campo=="nomina"){
        if(!preg_match("/^[a-zA-Z]{2}+$/",$valor)){
            echo "<h3>Error en registro</h3>";
            exit();
        }
    if($valor!="SI" && ($valor!="si" && ($valor!="Si" &&($valor!="no"&&($valor!="NO"&&($valor!="No")))))){
    echo "<h3>Error en registro</h3>";
    exit();
        }

    }


$base = new Conexion();
$sql = "update gestion_social set ".$campo."='".$valor."' where idgestion_social='".$id."' and tipo_gestion='comuna' limit 1";
$base->conectar();
$base->actualizar($sql);
$base->cerrar();

}else if($tipo=="integrantes"){

if($campo=="nombre"){

    if(!preg_match("/^[a-zA-Z]+$/",$valor)){
        echo "<h3>Error en nombre</h3>";
        exit();
    }
    if(strlen($valor)>15){
    echo "<h3>Error nombre no debe poseer mas de 15 caracteres</h3>";
    exit();
    }
$base = new Conexion();
$base->conectar();
$sql="update integrantes_gestion set ".$campo."='".$valor."' where idintegrantes_gestion='".$id."' and comuna=1 limit 1";
$base->actualizar($sql);
$base->cerrar();
}else if($campo=="apellido"){
    if(!preg_match("/^[a-zA-ZÑ-ñ\s]+$/",$valor)){
        echo "<h3>Error en apellido</h3>";
        exit();
    }
    if(strlen($valor)>20){
    echo "<h3>Error apellido no debe poseer mas de 20 caracteres</h3>";
    exit();
    }
$base = new Conexion();
$base->conectar();

$sql="update integrantes_gestion set ".$campo."='".$valor."' where idintegrantes_gestion='".$id."' and comuna=1 limit 1";
$base->actualizar($sql);
$base->cerrar();
}else if($campo=="cedula"){
    if(!preg_match("/^[E-V]{1}[\-]{1}[0-9]+$/",$valor)){
        echo "<h3>Error en cedula</h3>";
        exit();
    }
    if(strlen($valor)>10 || strlen($valor)<9){
        echo "<h3>Error en cedula</h3>";
    exit();
    }

    $sql="select cedula from integrantes_gestion where cedula='$valor' and not idintegrantes_gestion='$id'";
    $base = new Conexion();
    $base->conectar();
    $consult=$base->consultar($sql);
    if($consult==1){
        echo "<h3>Error cedula ya exite en el sistema</h3>";
        $base->cerrar();
        exit();

    }

$sql="update integrantes_gestion set ".$campo."='".$valor."' where idintegrantes_gestion='".$id."' and comuna=1 limit 1";
$base->actualizar($sql);
$base->cerrar();
}else if($campo=="telefono"){
    if(!preg_match("/^[0-9]{11}+$/",$valor)){
        echo "<h3>Error en telefono</h3>";
        exit();
    }
    if($valor=="00000000000"){

    }else{
    $codigo = substr($valor,0,4);

	if($codigo!="0412" &&($codigo!="0416" &&($codigo!="0426" &&($codigo!="0414"
	&&($codigo!="0424" &&($codigo!="0285"))))))
	{
	echo "<h3>Error en codigo del campo {$campo} no es valido</h3>";
	exit();
	}
}

$base = new Conexion();
$sql="update integrantes_gestion set ".$campo."='".$valor."' where idintegrantes_gestion='".$id."' and comuna=1 limit 1";
$base->actualizar($sql);
$base->cerrar();

}else{
    if($campo=="tipo"){
        if(!preg_match("/^[a-zA-Z]+$/",$valor)){
            echo "<h3>Error en tipo</h3>";
            exit();
        }
    if($valor!="suplente" && $valor!="principal"){
    echo "<h3>Error en tipo de integrantes</h3>";
    exit();
    }

$base = new Conexion();
$sql="update cargo_integrantes_gestion set ".$campo."='".$valor."' where  idintegrantes_gestion='".$id."' and idgestion_social='$idcomuna' limit 1";
$base->conectar();
$base->actualizar($sql);
$base->cerrar();
}
}
}
}else{
echo "<h3>Error al actualizar datos</h3>";
}
?>
