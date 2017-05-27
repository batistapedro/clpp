<?php
session_start();
if(isset($_SESSION['tipo'])&& !empty($_SESSION['tipo'])){

if($_SESSION['tipo']=="administrador"){

require("../php/conexion.php");

$base =  new Conexion();
$base->respaldo();
}else{
echo "<script>
        window.location='../index.php';
    </script>
";


}




}else{

echo "<script>
        window.location='../index.php';
    </script>
";
}



?>
