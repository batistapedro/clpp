<?php
//declaracion de la clase conexion
class Conexion{
//declarando los tipos de datos de la clase conexion
private static $host;
private static $user;
private static $clave;
private static $bd;
private $cone;
private $sql;
private $consulta;
private $actualiza;
private $elimina;
private $agrega;
private  $extrae;
//inicializando el metodo constructor
function __construct(){
self::$host="localhost";
self::$user="root";
self::$clave="271188pmbs";
self::$bd="clpp";
$this->cone=null;
$this->sql=null;
$this->consulta=null;
$this->actualiza=null;
$this->elimina=null;
$this->extrae=null;
}
//declarando metodo del destructor el cual limpiara la memoria del servidos una ves dejada de usuar esta clase
function __destruct(){

}
//metodo que conecta el sistema con la base de datos
function conectar(){
$this->cone = new mysqli(self::$host,self::$user,self::$clave,self::$bd);
//condicion en caso que la conexion falle
if(mysqli_connect_errno()){
echo "errror al conectar server";
exit();
}
//devolviendo el el objeto de la clase mysqli que es el conector de la base de datos
return $this->cone;
}
//metodo agregar el cual silve para registrar datos en una tabla de la base de datos
//este metodo pasa un argumento el cual tiene la consulta sql.
function agregar($sql){
//condicional que comprueba la consulta
if($this->agrega = $this->cone->query($sql)){
echo "<h3>datos agregados con exito</h3>";
}else{
echo "<h3>error al agregar datos</h3>";
exit();
}
}
// metodo extraer el cual recibe como argumento una consulta tipo sql.
//para  extraer informacion de una base de datos.
function extraer($sql){
if($this->extrae = $this->cone->query($sql)){
if($this->extrae){
return $this->extrae;
}else{
echo "<h3>error al extraer datos</h3>";
exit();
}
}
}
//metodo consultar el cual recibe como parametro una consulta sql
//este metodo es para consultar si un datos esta registrado en el sistema o no.
function consultar($sql){
if($this->consulta = $this->cone->query($sql)){
if(mysqli_num_rows($this->consulta)==1){
return $this->consulta;
$this->consulta->close();
}
}else{
echo "<h3>error en consulta</h3>";
exit();
}
}
//metodo el cual actualiza datos de la base de datos este metodo recibe como parametro una
//consulta sql.
function actualizar($sql){
if($this->actualiza = $this->cone->query($sql)){
echo "<h3>datos actualizado con exito</h3>";
}else{
echo "<h3>error al actualizar</h3>";
}
}

//metodo eliminar el cual recibe como parametro una consulta sql
//este metodo es utilizado para elimnar datos de la base de datos.
function eliminar($sql){
$this->elimina = $this->cone->query($sql);
if($this->elimina){
echo "<h3>datos eliminado con exito</h3>";
}else{
echo "<h3>error al eliminar datos</h3>";
}
}
//metodo para actualizar informacion a nivel de cascada en la base de datos.
function actualizar2($sql){
$this->cone->query($sql);
}
// metodo para agregar informacion en la base de datos a nivel de cascada.
function agregar2($sql){
$this->cone->query($sql);
}
//metodo para eliminar datos de la base de datos en forma de cascada.
function eliminar2($sql){
$this->cone->query($sql);
}
//metodo para respaldar informacion de la base de datos.
//este metodo crea un archivo .sql con la informacion de la base de datos en el
//en la url del sistema clpp4/administrador/respaldo_db/
//y despues descarga dicho archivo de la url clpp4/administrador/respaldo_db/
function respaldo(){

$FileName="clpp-".date("Y-m-d").".sql";
$localhost= self::$host;
$user=self::$user;
$passwd=self::$clave;
$db=self::$bd;
$backupRoute="/var/www/html/clpp/administrador/respaldo_db/";
$command = "mysqldump --opt --host='$localhost' --user='$user' --pass='$passwd' '$db' > ".$backupRoute.$FileName;
exec($command);

header("Content-disposition: attachment; filename='$FileName'");
header("Content-type: application/octet-stream");
readfile($backupRoute.$FileName);
}


//metodo cerrar este metodo cierra la conexion a la base de datos
function cerrar(){
$this->cone->close();
}

}

?>
