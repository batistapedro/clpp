<?php
session_start();
if(isset($_SESSION['tipo'])&& !empty($_SESSION['tipo'])){
if($_SESSION['tipo']=="administrador" ||($_SESSION['tipo']=="operador" ||($_SESSION['tipo']=="comunas" ||($_SESSION['tipo']=="concejal")))){
$id=intval(trim(htmlspecialchars($_GET['ver'])));

require("../fpdf/fpdf.php");
require("../php/conexion.php");

class PDF extends FPDF
{

function Footer(){
$this->SetY(-22);
$this->SetDrawColor(230,0,12);
$this->SetLineWidth(0,8);
$this->SetFont('Arial','I',8);
$this->Cell(0,10,'Pagina '.$this->PageNo(),0,1,'I');
$this->Cell(0,10,'Consejo Local De Planificacion Publica, Registros De Las Comunas Socialistas, Municipio Heres','T',0,'C');
}

function Header(){
$Fecha = Date("d-m-Y");
$this->SetFont('Arial','B',16);
$this->SetDrawColor(230,0,12);
$this->SetLineWidth(0,8);
$this->Line(10,40.5,265,40.5);
$this->Cell(0,5,'',0,1,$this->Image('../imagenes/bannerr.jpg',20,11,240,17));
$this->Ln(14);
$this->SetTextColor(219,32,32);
$this->Cell(0,5,'Registros De Las Comunas Socialistas',0,1,'C');
$this->Ln(3);
$this->SetFont('Arial','I',12);
$this->SetTextColor(0,0,0);
$this->Cell(0,1,'Fecha : '.$Fecha,0,0,'R');
$this->Ln(12);
}
function cabeceraHorizontal($cabecera)
    {
        $this->SetXY(10, 45);
        $this->SetFont('Arial','I',15);
        $this->Cell(0,7,"Direccion de la Comuna Socialista",0,0,'C');
        $this->Ln();
        $this->SetFont('Arial','B',11);
        $this->SetFillColor(219,32,32);//Fondo rojo de celda
        $this->SetTextColor(240, 255, 240); //Letra color blanco

         $this->CellFitSpace(55,7, utf8_decode($cabecera[0]),1, 0 , 'C', true);
 	    $this->CellFitSpace(100,7,utf8_decode($cabecera[1]),1,0,'C',true);
	    $this->CellFitSpace(100,7,utf8_decode($cabecera[2]),1,1,'C',true);

    }

    function datosHorizontal($datos)
    {
        $this->SetXY(10,59);
        $this->SetFont('Arial','I',10);
        $this->SetFillColor(245, 245, 245); //Gris tenue de cada fila
        $this->SetTextColor(0, 0, 0); //Color del texto: Negro
        $bandera = false; //Para alternar el relleno
        foreach($datos as $fila)
        {
            //Usaremos CellFitSpace en lugar de Cell
            $this->CellFitSpace(55,8, utf8_decode($fila['Parroquia']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(100,8, utf8_decode($fila['Sector']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(100,8, utf8_decode($fila['Sede']),1, 0 , 'C', $bandera );
            $this->Ln();//Salto de lÃ­nea para generar otra fila
            $bandera = !$bandera;//Alterna el valor de la bandera
        }
    }

    function cabeceradatos($cabeza){
    	$this->SetXY(10,69);
        $this->SetFont('Arial','I',15);
        $this->SetTextColor(219,39,39);
        $this->Cell(0,7,"Datos de la Comuna Socialista",0,0,'C');
        $this->Ln();
        $this->SetFont('Arial','B',11);
        $this->SetFillColor(219,32,32);//Fondo rojo de celda
        $this->SetTextColor(240, 255, 240); //Letra color blanco

        $this->CellFitSpace(160,7, utf8_decode($cabeza[0]),1, 0 , 'C', true);
 	    $this->CellFitSpace(40,7,utf8_decode($cabeza[1]),1,0,'C',true);
	    $this->CellFitSpace(55,7,utf8_decode($cabeza[2]),1,1,'C',true);
    }

   function datocomuna($datoss){
         $this->SetXY(10,83);
        $this->SetFont('Arial','I',10);
        $this->SetFillColor(245, 245, 245); //Gris tenue de cada fila
        $this->SetTextColor(0, 0, 0); //Color del texto: Negro
        $bandera = false; //Para alternar el relleno
        foreach($datoss as $fila)
        {
            //Usaremos CellFitSpace en lugar de Cell
            $this->CellFitSpace(160,8, utf8_decode($fila['Nombre']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(40,8, utf8_decode($fila['Rif']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(55,8, utf8_decode($fila['Codigo']),1, 0 , 'C', $bandera );
            $this->Ln();//Salto de lÃ­nea para generar otra fila
            $bandera = !$bandera;//Alterna el valor de la bandera
        }
    }

    function cabezafechas($cabeza){
    	   $this->SetXY(10,93);
        $this->SetFont('Arial','I',15);
        $this->SetTextColor(219,39,39);
        $this->Cell(0,7,"Fecha de la Comuna Socialista",0,0,'C');
        $this->Ln();
        $this->SetFont('Arial','B',11);
        $this->SetFillColor(219,32,32);//Fondo rojo de celda
        $this->SetTextColor(240, 255, 240); //Letra color blanco

         $this->CellFitSpace(64,7, utf8_decode($cabeza[0]),1, 0 , 'C', true);
 	    $this->CellFitSpace(64,7,utf8_decode($cabeza[1]),1,0,'C',true);
 	    $this->CellFitSpace(64,7,utf8_decode($cabeza[2]),1,0,'C',true);
	    $this->CellFitSpace(64,7,utf8_decode($cabeza[3]),1,1,'C',true);
    }
    function datosfechas($datos){
       $this->SetXY(10,107);
        $this->SetFont('Arial','I',10);
        $this->SetFillColor(245, 245, 245); //Gris tenue de cada fila
        $this->SetTextColor(0, 0, 0); //Color del texto: Negro
        $bandera = false; //Para alternar el relleno
        foreach($datos as $fila)
        {
            //Usaremos CellFitSpace en lugar de Cell
            $this->CellFitSpace(64,8, utf8_decode($fila['Fecha de Registro']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(64,8, utf8_decode($fila['Fecha de Adecuacion']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(64,8, utf8_decode($fila['Fecha de Vencimiento']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(64,8, utf8_decode($fila['Estado']),1, 0 , 'C', $bandera );
            $this->Ln();//Salto de lÃ­nea para generar otra fila
            $bandera = !$bandera;//Alterna el valor de la bandera
        }
    }
    function cabezadocumentos($cabeza){
    $this->SetXY(10,117);
        $this->SetFont('Arial','I',15);
        $this->SetTextColor(219,39,39);
        $this->Cell(0,7,"Documentos de la Comuna Socialista",0,0,'C');
        $this->Ln();
        $this->SetFont('Arial','B',11);
        $this->SetFillColor(219,32,32);//Fondo rojo de celda
        $this->SetTextColor(240, 255, 240); //Letra color blanco

         $this->CellFitSpace(64,7, utf8_decode($cabeza[0]),1, 0 , 'C', true);
 	    $this->CellFitSpace(63,7,utf8_decode($cabeza[1]),1,0,'C',true);
 	    $this->CellFitSpace(63,7,utf8_decode($cabeza[2]),1,0,'C',true);
 	    $this->CellFitSpace(65,7,utf8_decode($cabeza[3]),1,0,'C',true);
    }
    function datosdocumentos($datos){
     $this->SetXY(10,131);
        $this->SetFont('Arial','I',10);
        $this->SetFillColor(245, 245, 245); //Gris tenue de cada fila
        $this->SetTextColor(0, 0, 0); //Color del texto: Negro
        $bandera = false; //Para alternar el relleno
        foreach($datos as $fila)
        {
            //Usaremos CellFitSpace en lugar de Cell
            $this->CellFitSpace(64,8, utf8_decode($fila['Acta Constitutiva']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(63,8, utf8_decode($fila['Constancia de Eleccion']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(63,8, utf8_decode($fila['Cedulas de Integrantes']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(65,8, utf8_decode($fila['Certificado de Registro']),1, 0 , 'C', $bandera );

            $this->Ln();//Salto de lÃ­nea para generar otra fila
            $bandera = !$bandera;//Alterna el valor de la bandera
        }
    }

    function cabezaconsejo($cabeza){
    //  $this->SetXY(10,117);
        $this->SetFont('Arial','I',15);
        $this->SetTextColor(219,39,39);
        $this->Cell(0,7,"Consejos Comunales Que Lo Integran",0,0,'C');
        $this->Ln();
        $this->SetFont('Arial','B',11);
        $this->SetFillColor(219,32,32);//Fondo rojo de celda
        $this->SetTextColor(240, 255, 240); //Letra color blanco

	    $this->CellFitSpace(255,7,utf8_decode($cabeza[0]),1,1,'C',true);
    }

    function datosconsejo($datos){
      //$this->SetXY(10,131);
        $this->SetFont('Arial','I',10);
        $this->SetFillColor(245, 245, 245); //Gris tenue de cada fila
        $this->SetTextColor(0, 0, 0); //Color del texto: Negro
        $bandera = false; //Para alternar el relleno
        foreach($datos as $fila)
        {
            //Usaremos CellFitSpace en lugar de Cell
            $this->CellFitSpace(255,8, utf8_decode($fila['Nombre']),1, 0 , 'C', $bandera );
            $this->Ln();//Salto de lÃ­nea para generar otra fila
            $bandera = !$bandera;//Alterna el valor de la bandera
        }

    }

    function cabezaintegrantes($cabeza){
       //$this->SetXY(10,93);
        $this->SetFont('Arial','I',15);
        $this->SetTextColor(219,39,39);
        $this->Cell(0,7,"Parlamento Comunal",0,0,'C');
        $this->Ln();
        $this->SetFont('Arial','B',11);
        $this->SetFillColor(219,32,32);//Fondo rojo de celda
        $this->SetTextColor(240, 255, 240); //Letra color blanco

         $this->CellFitSpace(40,7, utf8_decode($cabeza[0]),1, 0 , 'C', true);
 	    $this->CellFitSpace(40,7,utf8_decode($cabeza[1]),1,0,'C',true);
 	    $this->CellFitSpace(35,7,utf8_decode($cabeza[2]),1,0,'C',true);
 	    $this->CellFitSpace(35,7,utf8_decode($cabeza[3]),1,0,'C',true);
	    $this->CellFitSpace(105,7,utf8_decode($cabeza[4]),1,1,'C',true);

    }

   function datosintegrantes($datos){
     // $this->SetXY(10,107);
        $this->SetFont('Arial','I',10);
        $this->SetFillColor(245, 245, 245); //Gris tenue de cada fila
        $this->SetTextColor(0, 0, 0); //Color del texto: Negro
        $bandera = false; //Para alternar el relleno
        foreach($datos as $fila)
        {
            //Usaremos CellFitSpace en lugar de Cell
            $this->CellFitSpace(40,8, utf8_decode($fila['Nombre']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(40,8, utf8_decode($fila['Apellido']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(35,8, utf8_decode($fila['Cedula']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(35,8, utf8_decode($fila['Tipo']),1, 0 , 'C', $bandera );
             $this->CellFitSpace(105,8, utf8_decode($fila['Nombre de la Gestion Social']),1, 0 , 'C', $bandera );
            $this->Ln();//Salto de lÃ­nea para generar otra fila
            $bandera = !$bandera;//Alterna el valor de la bandera
        }
    }

    function cabezaintegrantes2($cabeza){
    //$this->SetXY(10,93);
        $this->SetFont('Arial','I',15);
        $this->SetTextColor(219,39,39);
        $this->Cell(0,7,"Consejo Ejecutivo",0,0,'C');
        $this->Ln();
        $this->SetFont('Arial','B',11);
        $this->SetFillColor(219,32,32);//Fondo rojo de celda
        $this->SetTextColor(240, 255, 240); //Letra color blanco

         $this->CellFitSpace(40,7, utf8_decode($cabeza[0]),1, 0 , 'C', true);
 	    $this->CellFitSpace(40,7,utf8_decode($cabeza[1]),1,0,'C',true);
 	    $this->CellFitSpace(35,7,utf8_decode($cabeza[2]),1,0,'C',true);
 	    $this->CellFitSpace(35,7,utf8_decode($cabeza[3]),1,0,'C',true);
	    $this->CellFitSpace(105,7,utf8_decode($cabeza[4]),1,1,'C',true);


    }
	function datosintegrantes2($datos){
	 // $this->SetXY(10,107);
        $this->SetFont('Arial','I',10);
        $this->SetFillColor(245, 245, 245); //Gris tenue de cada fila
        $this->SetTextColor(0, 0, 0); //Color del texto: Negro
        $bandera = false; //Para alternar el relleno
        foreach($datos as $fila)
        {
            //Usaremos CellFitSpace en lugar de Cell
            $this->CellFitSpace(40,8, utf8_decode($fila['Nombre']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(40,8, utf8_decode($fila['Apellido']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(35,8, utf8_decode($fila['Cedula']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(35,8, utf8_decode($fila['Tipo']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(105,8, utf8_decode($fila['Nombre de la Gestion Social']),1, 0 , 'C', $bandera );
            $this->Ln();//Salto de lÃ­nea para generar otra fila
            $bandera = !$bandera;//Alterna el valor de la bandera
        }

	}

	function cabezaintegrantesdechos($cabeza){
	 $this->SetFont('Arial','I',15);
        $this->SetTextColor(219,39,39);
        $this->Cell(0,7,"Comite de Derechos Humanos",0,0,'C');
        $this->Ln();
        $this->SetFont('Arial','B',11);
        $this->SetFillColor(219,32,32);//Fondo rojo de celda
        $this->SetTextColor(240, 255, 240); //Letra color blanco

        $this->CellFitSpace(40,7, utf8_decode($cabeza[0]),1, 0 , 'C', true);
 	    $this->CellFitSpace(40,7,utf8_decode($cabeza[1]),1,0,'C',true);
 	    $this->CellFitSpace(35,7,utf8_decode($cabeza[2]),1,0,'C',true);
 	    $this->CellFitSpace(35,7,utf8_decode($cabeza[3]),1,0,'C',true);
	    $this->CellFitSpace(105,7,utf8_decode($cabeza[4]),1,1,'C',true);


	}

	function datosintegrantesderechos($datos){
	   $this->SetFont('Arial','I',10);
        $this->SetFillColor(245, 245, 245); //Gris tenue de cada fila
        $this->SetTextColor(0, 0, 0); //Color del texto: Negro
        $bandera = false; //Para alternar el relleno
        foreach($datos as $fila)
        {
            //Usaremos CellFitSpace en lugar de Cell
            $this->CellFitSpace(40,8, utf8_decode($fila['Nombre']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(40,8, utf8_decode($fila['Apellido']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(35,8, utf8_decode($fila['Cedula']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(35,8, utf8_decode($fila['Tipo']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(105,8, utf8_decode($fila['Nombre de la Gestion Social']),1, 0 , 'C', $bandera );
            $this->Ln();//Salto de lÃ­nea para generar otra fila
            $bandera = !$bandera;//Alterna el valor de la bandera
        }
	}

	function cabezaintegrantessalud($cabeza){
	 $this->SetFont('Arial','I',15);
        $this->SetTextColor(219,39,39);
        $this->Cell(0,7,"Comite de Salud",0,0,'C');
        $this->Ln();
        $this->SetFont('Arial','B',11);
        $this->SetFillColor(219,32,32);//Fondo rojo de celda
        $this->SetTextColor(240, 255, 240); //Letra color blanco

        $this->CellFitSpace(40,7, utf8_decode($cabeza[0]),1, 0 , 'C', true);
 	    $this->CellFitSpace(40,7,utf8_decode($cabeza[1]),1,0,'C',true);
 	    $this->CellFitSpace(35,7,utf8_decode($cabeza[2]),1,0,'C',true);
 	    $this->CellFitSpace(35,7,utf8_decode($cabeza[3]),1,0,'C',true);
	    $this->CellFitSpace(105,7,utf8_decode($cabeza[4]),1,1,'C',true);
	}

	function datosintegrantessalud($datos){
	$this->SetFont('Arial','I',10);
        $this->SetFillColor(245, 245, 245); //Gris tenue de cada fila
        $this->SetTextColor(0, 0, 0); //Color del texto: Negro
        $bandera = false; //Para alternar el relleno
        foreach($datos as $fila)
        {
            //Usaremos CellFitSpace en lugar de Cell
            $this->CellFitSpace(40,8, utf8_decode($fila['Nombre']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(40,8, utf8_decode($fila['Apellido']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(35,8, utf8_decode($fila['Cedula']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(35,8, utf8_decode($fila['Tipo']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(105,8, utf8_decode($fila['Nombre de la Gestion Social']),1, 0 , 'C', $bandera );
            $this->Ln();//Salto de lÃ­nea para generar otra fila
            $bandera = !$bandera;//Alterna el valor de la bandera
        }

	}

	function cabezaintegrantestierra($cabeza){
	 $this->SetFont('Arial','I',15);
        $this->SetTextColor(219,39,39);
        $this->Cell(0,7,"Comite de Tierra Urbana,Vivienda y Habitat",0,0,'C');
        $this->Ln();
        $this->SetFont('Arial','B',11);
        $this->SetFillColor(219,32,32);//Fondo rojo de celda
        $this->SetTextColor(240, 255, 240); //Letra color blanco

        $this->CellFitSpace(40,7, utf8_decode($cabeza[0]),1, 0 , 'C', true);
 	    $this->CellFitSpace(40,7,utf8_decode($cabeza[1]),1,0,'C',true);
 	    $this->CellFitSpace(35,7,utf8_decode($cabeza[2]),1,0,'C',true);
 	    $this->CellFitSpace(35,7,utf8_decode($cabeza[3]),1,0,'C',true);
	    $this->CellFitSpace(105,7,utf8_decode($cabeza[4]),1,1,'C',true);

	}
	function datosintegrantestierra($datos){
	$this->SetFont('Arial','I',10);
        $this->SetFillColor(245, 245, 245); //Gris tenue de cada fila
        $this->SetTextColor(0, 0, 0); //Color del texto: Negro
        $bandera = false; //Para alternar el relleno
        foreach($datos as $fila)
        {
            //Usaremos CellFitSpace en lugar de Cell
            $this->CellFitSpace(40,8, utf8_decode($fila['Nombre']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(40,8, utf8_decode($fila['Apellido']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(35,8, utf8_decode($fila['Cedula']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(35,8, utf8_decode($fila['Tipo']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(105,8, utf8_decode($fila['Nombre de la Gestion Social']),1, 0 , 'C', $bandera );
            $this->Ln();//Salto de lÃ­nea para generar otra fila
            $bandera = !$bandera;//Alterna el valor de la bandera
        }
	}

	function cabezaintegrantesbienes($cabeza){
	$this->SetFont('Arial','I',15);
        $this->SetTextColor(219,39,39);
        $this->Cell(0,7,"Comite de Defensa de las Personas en el Acceso de Bienes y Servicios",0,0,'C');
        $this->Ln();
        $this->SetFont('Arial','B',11);
        $this->SetFillColor(219,32,32);//Fondo rojo de celda
        $this->SetTextColor(240, 255, 240); //Letra color blanco

        $this->CellFitSpace(40,7, utf8_decode($cabeza[0]),1, 0 , 'C', true);
 	    $this->CellFitSpace(40,7,utf8_decode($cabeza[1]),1,0,'C',true);
 	    $this->CellFitSpace(35,7,utf8_decode($cabeza[2]),1,0,'C',true);
 	    $this->CellFitSpace(35,7,utf8_decode($cabeza[3]),1,0,'C',true);
	    $this->CellFitSpace(105,7,utf8_decode($cabeza[4]),1,1,'C',true);
	}
	function datosintegrantesbienes($datos){
	$this->SetFont('Arial','I',10);
        $this->SetFillColor(245, 245, 245); //Gris tenue de cada fila
        $this->SetTextColor(0, 0, 0); //Color del texto: Negro
        $bandera = false; //Para alternar el relleno
        foreach($datos as $fila)
        {
            //Usaremos CellFitSpace en lugar de Cell
            $this->CellFitSpace(40,8, utf8_decode($fila['Nombre']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(40,8, utf8_decode($fila['Apellido']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(35,8, utf8_decode($fila['Cedula']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(35,8, utf8_decode($fila['Tipo']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(105,8, utf8_decode($fila['Nombre de la Gestion Social']),1, 0 , 'C', $bandera );
            $this->Ln();//Salto de lÃ­nea para generar otra fila
            $bandera = !$bandera;//Alterna el valor de la bandera
        }

	}

	function cabezaintegranteseconomia($cabeza){
	$this->SetFont('Arial','I',15);
        $this->SetTextColor(219,39,39);
        $this->Cell(0,7,"Comite de Economia y Produccion Comunal",0,0,'C');
        $this->Ln();
        $this->SetFont('Arial','B',11);
        $this->SetFillColor(219,32,32);//Fondo rojo de celda
        $this->SetTextColor(240, 255, 240); //Letra color blanco

        $this->CellFitSpace(40,7, utf8_decode($cabeza[0]),1, 0 , 'C', true);
 	    $this->CellFitSpace(40,7,utf8_decode($cabeza[1]),1,0,'C',true);
 	    $this->CellFitSpace(35,7,utf8_decode($cabeza[2]),1,0,'C',true);
 	    $this->CellFitSpace(35,7,utf8_decode($cabeza[3]),1,0,'C',true);
	    $this->CellFitSpace(105,7,utf8_decode($cabeza[4]),1,1,'C',true);

	}

	function datosintegranteseconomia($datos){
	$this->SetFont('Arial','I',10);
        $this->SetFillColor(245, 245, 245); //Gris tenue de cada fila
        $this->SetTextColor(0, 0, 0); //Color del texto: Negro
        $bandera = false; //Para alternar el relleno
        foreach($datos as $fila)
        {
            //Usaremos CellFitSpace en lugar de Cell
            $this->CellFitSpace(40,8, utf8_decode($fila['Nombre']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(40,8, utf8_decode($fila['Apellido']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(35,8, utf8_decode($fila['Cedula']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(35,8, utf8_decode($fila['Tipo']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(105,8, utf8_decode($fila['Nombre de la Gestion Social']),1, 0 , 'C', $bandera );
            $this->Ln();//Salto de lÃ­nea para generar otra fila
            $bandera = !$bandera;//Alterna el valor de la bandera
        }

	}

	function cabezaintegrantesmujeres($cabeza){
	$this->SetFont('Arial','I',15);
        $this->SetTextColor(219,39,39);
        $this->Cell(0,7,"Comite de la Mujer E Iguldad de Genero",0,0,'C');
        $this->Ln();
        $this->SetFont('Arial','B',11);
        $this->SetFillColor(219,32,32);//Fondo rojo de celda
        $this->SetTextColor(240, 255, 240); //Letra color blanco

        $this->CellFitSpace(40,7, utf8_decode($cabeza[0]),1, 0 , 'C', true);
 	    $this->CellFitSpace(40,7,utf8_decode($cabeza[1]),1,0,'C',true);
 	    $this->CellFitSpace(35,7,utf8_decode($cabeza[2]),1,0,'C',true);
 	    $this->CellFitSpace(35,7,utf8_decode($cabeza[3]),1,0,'C',true);
	    $this->CellFitSpace(105,7,utf8_decode($cabeza[4]),1,1,'C',true);
	}
	function datosintegrantesmujeres($datos){
	$this->SetFont('Arial','I',10);
        $this->SetFillColor(245, 245, 245); //Gris tenue de cada fila
        $this->SetTextColor(0, 0, 0); //Color del texto: Negro
        $bandera = false; //Para alternar el relleno
        foreach($datos as $fila)
        {
            //Usaremos CellFitSpace en lugar de Cell
            $this->CellFitSpace(40,8, utf8_decode($fila['Nombre']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(40,8, utf8_decode($fila['Apellido']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(35,8, utf8_decode($fila['Cedula']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(35,8, utf8_decode($fila['Tipo']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(105,8, utf8_decode($fila['Nombre de la Gestion Social']),1, 0 , 'C', $bandera );
            $this->Ln();//Salto de lÃ­nea para generar otra fila
            $bandera = !$bandera;//Alterna el valor de la bandera
        }
	}

	function cabezaintegrantesdefensa($cabeza){
	$this->SetFont('Arial','I',15);
        $this->SetTextColor(219,39,39);
        $this->Cell(0,7,"Comite de Defensa y Seguridad Integral",0,0,'C');
        $this->Ln();
        $this->SetFont('Arial','B',11);
        $this->SetFillColor(219,32,32);//Fondo rojo de celda
        $this->SetTextColor(240, 255, 240); //Letra color blanco

        $this->CellFitSpace(40,7, utf8_decode($cabeza[0]),1, 0 , 'C', true);
 	    $this->CellFitSpace(40,7,utf8_decode($cabeza[1]),1,0,'C',true);
 	    $this->CellFitSpace(35,7,utf8_decode($cabeza[2]),1,0,'C',true);
 	    $this->CellFitSpace(35,7,utf8_decode($cabeza[3]),1,0,'C',true);
	    $this->CellFitSpace(105,7,utf8_decode($cabeza[4]),1,1,'C',true);

	}
	function datosintegrantesdefensa($datos){
	$this->SetFont('Arial','I',10);
        $this->SetFillColor(245, 245, 245); //Gris tenue de cada fila
        $this->SetTextColor(0, 0, 0); //Color del texto: Negro
        $bandera = false; //Para alternar el relleno
        foreach($datos as $fila)
        {
            //Usaremos CellFitSpace en lugar de Cell
            $this->CellFitSpace(40,8, utf8_decode($fila['Nombre']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(40,8, utf8_decode($fila['Apellido']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(35,8, utf8_decode($fila['Cedula']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(35,8, utf8_decode($fila['Tipo']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(105,8, utf8_decode($fila['Nombre de la Gestion Social']),1, 0 , 'C', $bandera );
            $this->Ln();//Salto de lÃ­nea para generar otra fila
            $bandera = !$bandera;//Alterna el valor de la bandera
        }
	}

	function cabezaintegrantesfamilia($cabeza){
	$this->SetFont('Arial','I',15);
        $this->SetTextColor(219,39,39);
        $this->Cell(0,7,utf8_decode("Comite de Familia y proteccion de niños,niñas y Adolecentes"),0,0,'C');
        $this->Ln();
        $this->SetFont('Arial','B',11);
        $this->SetFillColor(219,32,32);//Fondo rojo de celda
        $this->SetTextColor(240, 255, 240); //Letra color blanco

        $this->CellFitSpace(40,7, utf8_decode($cabeza[0]),1, 0 , 'C', true);
 	    $this->CellFitSpace(40,7,utf8_decode($cabeza[1]),1,0,'C',true);
 	    $this->CellFitSpace(35,7,utf8_decode($cabeza[2]),1,0,'C',true);
 	    $this->CellFitSpace(35,7,utf8_decode($cabeza[3]),1,0,'C',true);
	    $this->CellFitSpace(105,7,utf8_decode($cabeza[4]),1,1,'C',true);
	}
	function datosintegrantesfamilia($datos){
	$this->SetFont('Arial','I',10);
        $this->SetFillColor(245, 245, 245); //Gris tenue de cada fila
        $this->SetTextColor(0, 0, 0); //Color del texto: Negro
        $bandera = false; //Para alternar el relleno
        foreach($datos as $fila)
        {
            //Usaremos CellFitSpace en lugar de Cell
            $this->CellFitSpace(40,8, utf8_decode($fila['Nombre']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(40,8, utf8_decode($fila['Apellido']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(35,8, utf8_decode($fila['Cedula']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(35,8, utf8_decode($fila['Tipo']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(105,8, utf8_decode($fila['Nombre de la Gestion Social']),1, 0 , 'C', $bandera );
            $this->Ln();//Salto de lÃ­nea para generar otra fila
            $bandera = !$bandera;//Alterna el valor de la bandera
        }

	}

	function cabezaintegrantesdeporte($cabeza){
	$this->SetFont('Arial','I',15);
        $this->SetTextColor(219,39,39);
        $this->Cell(0,7,utf8_decode("Comite de Recreacion y Deporte"),0,0,'C');
        $this->Ln();
        $this->SetFont('Arial','B',11);
        $this->SetFillColor(219,32,32);//Fondo rojo de celda
        $this->SetTextColor(240, 255, 240); //Letra color blanco

        $this->CellFitSpace(40,7, utf8_decode($cabeza[0]),1, 0 , 'C', true);
 	    $this->CellFitSpace(40,7,utf8_decode($cabeza[1]),1,0,'C',true);
 	    $this->CellFitSpace(35,7,utf8_decode($cabeza[2]),1,0,'C',true);
 	    $this->CellFitSpace(35,7,utf8_decode($cabeza[3]),1,0,'C',true);
	    $this->CellFitSpace(105,7,utf8_decode($cabeza[4]),1,1,'C',true);
	}
	function datosintegrantesdeporte($datos){
	$this->SetFont('Arial','I',10);
        $this->SetFillColor(245, 245, 245); //Gris tenue de cada fila
        $this->SetTextColor(0, 0, 0); //Color del texto: Negro
        $bandera = false; //Para alternar el relleno
        foreach($datos as $fila)
        {
            //Usaremos CellFitSpace en lugar de Cell
            $this->CellFitSpace(40,8, utf8_decode($fila['Nombre']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(40,8, utf8_decode($fila['Apellido']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(35,8, utf8_decode($fila['Cedula']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(35,8, utf8_decode($fila['Tipo']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(105,8, utf8_decode($fila['Nombre de la Gestion Social']),1, 0 , 'C', $bandera );
            $this->Ln();//Salto de lÃ­nea para generar otra fila
            $bandera = !$bandera;//Alterna el valor de la bandera
        }
	}

	function cabezaintegranteseducacion($cabeza){
	$this->SetFont('Arial','I',15);
        $this->SetTextColor(219,39,39);
        $this->Cell(0,7,utf8_decode("Comite de Educacion, Cultura y Formacion Socialista"),0,0,'C');
        $this->Ln();
        $this->SetFont('Arial','B',11);
        $this->SetFillColor(219,32,32);//Fondo rojo de celda
        $this->SetTextColor(240, 255, 240); //Letra color blanco

        $this->CellFitSpace(40,7, utf8_decode($cabeza[0]),1, 0 , 'C', true);
 	    $this->CellFitSpace(40,7,utf8_decode($cabeza[1]),1,0,'C',true);
 	    $this->CellFitSpace(35,7,utf8_decode($cabeza[2]),1,0,'C',true);
 	    $this->CellFitSpace(35,7,utf8_decode($cabeza[3]),1,0,'C',true);
	    $this->CellFitSpace(105,7,utf8_decode($cabeza[4]),1,1,'C',true);
	}
	function datosintegranteseducacion($datos){
	$this->SetFont('Arial','I',10);
        $this->SetFillColor(245, 245, 245); //Gris tenue de cada fila
        $this->SetTextColor(0, 0, 0); //Color del texto: Negro
        $bandera = false; //Para alternar el relleno
        foreach($datos as $fila)
        {
            //Usaremos CellFitSpace en lugar de Cell
            $this->CellFitSpace(40,8, utf8_decode($fila['Nombre']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(40,8, utf8_decode($fila['Apellido']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(35,8, utf8_decode($fila['Cedula']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(35,8, utf8_decode($fila['Tipo']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(105,8, utf8_decode($fila['Nombre de la Gestion Social']),1, 0 , 'C', $bandera );
            $this->Ln();//Salto de lÃ­nea para generar otra fila
            $bandera = !$bandera;//Alterna el valor de la bandera
        }
	}

	function cabezaintegrantesplanificacion($cabeza){
	$this->SetFont('Arial','I',15);
        $this->SetTextColor(219,39,39);
        $this->Cell(0,7,utf8_decode("Consejo de Planificacion Comunal"),0,0,'C');
        $this->Ln();
        $this->SetFont('Arial','B',11);
        $this->SetFillColor(219,32,32);//Fondo rojo de celda
        $this->SetTextColor(240, 255, 240); //Letra color blanco

        $this->CellFitSpace(40,7, utf8_decode($cabeza[0]),1, 0 , 'C', true);
 	    $this->CellFitSpace(40,7,utf8_decode($cabeza[1]),1,0,'C',true);
 	    $this->CellFitSpace(35,7,utf8_decode($cabeza[2]),1,0,'C',true);
 	    $this->CellFitSpace(35,7,utf8_decode($cabeza[3]),1,0,'C',true);
	    $this->CellFitSpace(105,7,utf8_decode($cabeza[4]),1,1,'C',true);
	}
	function datosintegrantesplanificacion($datos){
		$this->SetFont('Arial','I',10);
        $this->SetFillColor(245, 245, 245); //Gris tenue de cada fila
        $this->SetTextColor(0, 0, 0); //Color del texto: Negro
        $bandera = false; //Para alternar el relleno
        foreach($datos as $fila)
        {
            //Usaremos CellFitSpace en lugar de Cell
            $this->CellFitSpace(40,8, utf8_decode($fila['Nombre']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(40,8, utf8_decode($fila['Apellido']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(35,8, utf8_decode($fila['Cedula']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(35,8, utf8_decode($fila['Tipo']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(105,8, utf8_decode($fila['Nombre de la Gestion Social']),1, 0 , 'C', $bandera );
            $this->Ln();//Salto de lÃ­nea para generar otra fila
            $bandera = !$bandera;//Alterna el valor de la bandera
        }
	}

	function cabezaintegranteseconomiacomunal($cabeza){
	$this->SetFont('Arial','I',15);
        $this->SetTextColor(219,39,39);
        $this->Cell(0,7,utf8_decode("Consejo de Economia Comunal"),0,0,'C');
        $this->Ln();
        $this->SetFont('Arial','B',11);
        $this->SetFillColor(219,32,32);//Fondo rojo de celda
        $this->SetTextColor(240, 255, 240); //Letra color blanco

        $this->CellFitSpace(40,7, utf8_decode($cabeza[0]),1, 0 , 'C', true);
 	    $this->CellFitSpace(40,7,utf8_decode($cabeza[1]),1,0,'C',true);
 	    $this->CellFitSpace(35,7,utf8_decode($cabeza[2]),1,0,'C',true);
 	    $this->CellFitSpace(35,7,utf8_decode($cabeza[3]),1,0,'C',true);
	    $this->CellFitSpace(105,7,utf8_decode($cabeza[4]),1,1,'C',true);
	}
	function datosintegranteseconomiacomunal($datos){
	$this->SetFont('Arial','I',10);
        $this->SetFillColor(245, 245, 245); //Gris tenue de cada fila
        $this->SetTextColor(0, 0, 0); //Color del texto: Negro
        $bandera = false; //Para alternar el relleno
        foreach($datos as $fila)
        {
            //Usaremos CellFitSpace en lugar de Cell
            $this->CellFitSpace(40,8, utf8_decode($fila['Nombre']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(40,8, utf8_decode($fila['Apellido']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(35,8, utf8_decode($fila['Cedula']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(35,8, utf8_decode($fila['Tipo']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(105,8, utf8_decode($fila['Nombre de la Gestion Social']),1, 0 , 'C', $bandera );
            $this->Ln();//Salto de lÃ­nea para generar otra fila
            $bandera = !$bandera;//Alterna el valor de la bandera
        }
	}

	function cabezaintegrantesadministrador($cabeza){
	    $this->SetFont('Arial','I',15);
        $this->SetTextColor(219,39,39);
        $this->Cell(0,7,utf8_decode("Banco de la Comuna Coordinacion de Administracion"),0,0,'C');
        $this->Ln();
        $this->SetFont('Arial','B',11);
        $this->SetFillColor(219,32,32);//Fondo rojo de celda
        $this->SetTextColor(240, 255, 240); //Letra color blanco

        $this->CellFitSpace(40,7, utf8_decode($cabeza[0]),1, 0 , 'C', true);
 	    $this->CellFitSpace(40,7,utf8_decode($cabeza[1]),1,0,'C',true);
 	    $this->CellFitSpace(35,7,utf8_decode($cabeza[2]),1,0,'C',true);
 	    $this->CellFitSpace(35,7,utf8_decode($cabeza[3]),1,0,'C',true);
	    $this->CellFitSpace(105,7,utf8_decode($cabeza[4]),1,1,'C',true);
	}
	function datosintegrantesadministrador($datos){
	$this->SetFont('Arial','I',10);
        $this->SetFillColor(245, 245, 245); //Gris tenue de cada fila
        $this->SetTextColor(0, 0, 0); //Color del texto: Negro
        $bandera = false; //Para alternar el relleno
        foreach($datos as $fila)
        {
            //Usaremos CellFitSpace en lugar de Cell
            $this->CellFitSpace(40,8, utf8_decode($fila['Nombre']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(40,8, utf8_decode($fila['Apellido']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(35,8, utf8_decode($fila['Cedula']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(35,8, utf8_decode($fila['Tipo']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(105,8, utf8_decode($fila['Nombre de la Gestion Social']),1, 0 , 'C', $bandera );
            $this->Ln();//Salto de lÃ­nea para generar otra fila
            $bandera = !$bandera;//Alterna el valor de la bandera
        }
	}

	function cabezaintegrantesaprobacion($cabeza){
	$this->SetFont('Arial','I',15);
        $this->SetTextColor(219,39,39);
        $this->Cell(0,7,utf8_decode("Banco de la Comuna Comite de aprobacion"),0,0,'C');
        $this->Ln();
        $this->SetFont('Arial','B',11);
        $this->SetFillColor(219,32,32);//Fondo rojo de celda
        $this->SetTextColor(240, 255, 240); //Letra color blanco

        $this->CellFitSpace(40,7, utf8_decode($cabeza[0]),1, 0 , 'C', true);
 	    $this->CellFitSpace(40,7,utf8_decode($cabeza[1]),1,0,'C',true);
 	    $this->CellFitSpace(35,7,utf8_decode($cabeza[2]),1,0,'C',true);
 	    $this->CellFitSpace(35,7,utf8_decode($cabeza[3]),1,0,'C',true);
	    $this->CellFitSpace(105,7,utf8_decode($cabeza[4]),1,1,'C',true);

	}
	function datosintegrantesaprobacion($datos){
	$this->SetFont('Arial','I',10);
        $this->SetFillColor(245, 245, 245); //Gris tenue de cada fila
        $this->SetTextColor(0, 0, 0); //Color del texto: Negro
        $bandera = false; //Para alternar el relleno
        foreach($datos as $fila)
        {
            //Usaremos CellFitSpace en lugar de Cell
            $this->CellFitSpace(40,8, utf8_decode($fila['Nombre']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(40,8, utf8_decode($fila['Apellido']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(35,8, utf8_decode($fila['Cedula']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(35,8, utf8_decode($fila['Tipo']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(105,8, utf8_decode($fila['Nombre de la Gestion Social']),1, 0 , 'C', $bandera );
            $this->Ln();//Salto de lÃ­nea para generar otra fila
            $bandera = !$bandera;//Alterna el valor de la bandera
        }
	}

	function cabezaintegrantesseguimiento($cabeza){
	$this->SetFont('Arial','I',15);
        $this->SetTextColor(219,39,39);
        $this->Cell(0,7,utf8_decode("Banco de la Comuna Comite de seguimiento y control"),0,0,'C');
        $this->Ln();
        $this->SetFont('Arial','B',11);
        $this->SetFillColor(219,32,32);//Fondo rojo de celda
        $this->SetTextColor(240, 255, 240); //Letra color blanco

        $this->CellFitSpace(40,7, utf8_decode($cabeza[0]),1, 0 , 'C', true);
 	    $this->CellFitSpace(40,7,utf8_decode($cabeza[1]),1,0,'C',true);
 	    $this->CellFitSpace(35,7,utf8_decode($cabeza[2]),1,0,'C',true);
 	    $this->CellFitSpace(35,7,utf8_decode($cabeza[3]),1,0,'C',true);
	    $this->CellFitSpace(105,7,utf8_decode($cabeza[4]),1,1,'C',true);
	}
	function datosintegrantesseguimiento($datos){
	$this->SetFont('Arial','I',10);
        $this->SetFillColor(245, 245, 245); //Gris tenue de cada fila
        $this->SetTextColor(0, 0, 0); //Color del texto: Negro
        $bandera = false; //Para alternar el relleno
        foreach($datos as $fila)
        {
            //Usaremos CellFitSpace en lugar de Cell
            $this->CellFitSpace(40,8, utf8_decode($fila['Nombre']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(40,8, utf8_decode($fila['Apellido']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(35,8, utf8_decode($fila['Cedula']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(35,8, utf8_decode($fila['Tipo']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(105,8, utf8_decode($fila['Nombre de la Gestion Social']),1, 0 , 'C', $bandera );
            $this->Ln();//Salto de lÃ­nea para generar otra fila
            $bandera = !$bandera;//Alterna el valor de la bandera
        }

	}

	function cabezaintegrantesorganizacion($cabeza){
	$this->SetFont('Arial','I',15);
        $this->SetTextColor(219,39,39);
        $this->Cell(0,7,utf8_decode("Banco de la Comuna Comite de seguimiento y control por las organizaciones socio-productiva"),0,0,'C');
        $this->Ln();
        $this->SetFont('Arial','B',11);
        $this->SetFillColor(219,32,32);//Fondo rojo de celda
        $this->SetTextColor(240, 255, 240); //Letra color blanco

        $this->CellFitSpace(40,7, utf8_decode($cabeza[0]),1, 0 , 'C', true);
 	    $this->CellFitSpace(40,7,utf8_decode($cabeza[1]),1,0,'C',true);
 	    $this->CellFitSpace(35,7,utf8_decode($cabeza[2]),1,0,'C',true);
 	    $this->CellFitSpace(35,7,utf8_decode($cabeza[3]),1,0,'C',true);
	    $this->CellFitSpace(105,7,utf8_decode($cabeza[4]),1,1,'C',true);
	}
	function datosintegrantesorganizacion($datos){
	$this->SetFont('Arial','I',10);
        $this->SetFillColor(245, 245, 245); //Gris tenue de cada fila
        $this->SetTextColor(0, 0, 0); //Color del texto: Negro
        $bandera = false; //Para alternar el relleno
        foreach($datos as $fila)
        {
            //Usaremos CellFitSpace en lugar de Cell
            $this->CellFitSpace(40,8, utf8_decode($fila['Nombre']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(40,8, utf8_decode($fila['Apellido']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(35,8, utf8_decode($fila['Cedula']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(35,8, utf8_decode($fila['Tipo']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(105,8, utf8_decode($fila['Nombre de la Gestion Social']),1, 0 , 'C', $bandera );
            $this->Ln();//Salto de lÃ­nea para generar otra fila
            $bandera = !$bandera;//Alterna el valor de la bandera
        }

	}

	function cabezaintegrantescontrol($cabeza){
	$this->SetFont('Arial','I',15);
        $this->SetTextColor(219,39,39);
        $this->Cell(0,7,utf8_decode("Banco de la Comuna Comite de seguimiento y control designado por el parlamento comunal"),0,0,'C');
        $this->Ln();
        $this->SetFont('Arial','B',11);
        $this->SetFillColor(219,32,32);//Fondo rojo de celda
        $this->SetTextColor(240, 255, 240); //Letra color blanco

        $this->CellFitSpace(40,7, utf8_decode($cabeza[0]),1, 0 , 'C', true);
 	    $this->CellFitSpace(40,7,utf8_decode($cabeza[1]),1,0,'C',true);
 	    $this->CellFitSpace(35,7,utf8_decode($cabeza[2]),1,0,'C',true);
 	    $this->CellFitSpace(35,7,utf8_decode($cabeza[3]),1,0,'C',true);
	    $this->CellFitSpace(105,7,utf8_decode($cabeza[4]),1,1,'C',true);
	}
	function datosintegrantescontrol($datos){
	$this->SetFont('Arial','I',10);
        $this->SetFillColor(245, 245, 245); //Gris tenue de cada fila
        $this->SetTextColor(0, 0, 0); //Color del texto: Negro
        $bandera = false; //Para alternar el relleno
        foreach($datos as $fila)
        {
            //Usaremos CellFitSpace en lugar de Cell
            $this->CellFitSpace(40,8, utf8_decode($fila['Nombre']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(40,8, utf8_decode($fila['Apellido']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(35,8, utf8_decode($fila['Cedula']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(35,8, utf8_decode($fila['Tipo']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(105,8, utf8_decode($fila['Nombre de la Gestion Social']),1, 0 , 'C', $bandera );
            $this->Ln();//Salto de lÃ­nea para generar otra fila
            $bandera = !$bandera;//Alterna el valor de la bandera
        }
	}

	function cabezaintegrantescontraloria($cabeza){
	$this->SetFont('Arial','I',15);
        $this->SetTextColor(219,39,39);
        $this->Cell(0,7,utf8_decode("Consejo de Contraloria Comunal"),0,0,'C');
        $this->Ln();
        $this->SetFont('Arial','B',11);
        $this->SetFillColor(219,32,32);//Fondo rojo de celda
        $this->SetTextColor(240, 255, 240); //Letra color blanco

        $this->CellFitSpace(40,7, utf8_decode($cabeza[0]),1, 0 , 'C', true);
 	    $this->CellFitSpace(40,7,utf8_decode($cabeza[1]),1,0,'C',true);
 	    $this->CellFitSpace(35,7,utf8_decode($cabeza[2]),1,0,'C',true);
 	    $this->CellFitSpace(35,7,utf8_decode($cabeza[3]),1,0,'C',true);
	    $this->CellFitSpace(105,7,utf8_decode($cabeza[4]),1,1,'C',true);
	}
	function datosintegrantescontraloria($datos){
	$this->SetFont('Arial','I',10);
        $this->SetFillColor(245, 245, 245); //Gris tenue de cada fila
        $this->SetTextColor(0, 0, 0); //Color del texto: Negro
        $bandera = false; //Para alternar el relleno
        foreach($datos as $fila)
        {
            //Usaremos CellFitSpace en lugar de Cell
            $this->CellFitSpace(40,8, utf8_decode($fila['Nombre']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(40,8, utf8_decode($fila['Apellido']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(35,8, utf8_decode($fila['Cedula']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(35,8, utf8_decode($fila['Tipo']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(105,8, utf8_decode($fila['Nombre de la Gestion Social']),1, 0 , 'C', $bandera );
            $this->Ln();//Salto de lÃ­nea para generar otra fila
            $bandera = !$bandera;//Alterna el valor de la bandera
        }
	}


    function tablaHorizontal($cabeceraHorizontal, $datosHorizontal)
    {
        $this->cabeceraHorizontal($cabeceraHorizontal);
        $this->datosHorizontal($datosHorizontal);
    }
    function datoscomunas($cabeceradatos,$datoscomuna){
    $this->cabeceradatos($cabeceradatos);
    $this->datocomuna($datoscomuna);
    }
   function fechacomunas($cabezafecha,$datosfecha){
   $this->cabezafechas($cabezafecha);
   $this->datosfechas($datosfecha);
   }
  function documentoscomuna($cabezadocumento,$datodocumento){
   $this->cabezadocumentos($cabezadocumento);
   $this->datosdocumentos($datodocumento);
   }
   function consejoscomunas($cabezaconsejos,$datosconsejos){
   $this->cabezaconsejo($cabezaconsejos);
   $this->datosconsejo($datosconsejos);
   }
   function integrantescomunas($voceroscomunas,$datovocero){
   $this->cabezaintegrantes($voceroscomunas);
   $this->datosintegrantes($datovocero);
   }
   function integrantescomunas2($voceroscomunas,$datosvoceros){
   $this->cabezaintegrantes2($voceroscomunas);
   $this->datosintegrantes2($datosvoceros);
   }

   function integrantescomunasderechos($voceroscomunas,$datosvocerosderechos){
   $this->cabezaintegrantesdechos($voceroscomunas);
   $this->datosintegrantesderechos($datosvocerosderechos);
   }
   function integrantescomunassalud($voceroscomunas,$datosvocerossalud){
   $this->cabezaintegrantessalud($voceroscomunas);
   $this->datosintegrantessalud($datosvocerossalud);
   }
   function integrantescomunastierra($voceroscomunas,$datosvocerostierra){
   $this->cabezaintegrantestierra($voceroscomunas);
   $this->datosintegrantestierra($datosvocerostierra);
   }
   function integrantescomunasbienes($voceroscomunas,$datosvocerosbienes){
   $this->cabezaintegrantesbienes($voceroscomunas);
   $this->datosintegrantesbienes($datosvocerosbienes);
   }
   function integrantescomunaseconomia($voceroscomunas,$datosvoceroseconomia){
   $this->cabezaintegranteseconomia($voceroscomunas);
   $this->datosintegranteseconomia($datosvoceroseconomia);
   }
   function integrantescomunasmujeres($voceroscomunas,$datosvocerosmujeres){
   $this->cabezaintegrantesmujeres($voceroscomunas);
   $this->datosintegrantesmujeres($datosvocerosmujeres);
   }
   function integrantescomunasdefensa($voceroscomunas,$datosvocerosdefensa){
   $this->cabezaintegrantesdefensa($voceroscomunas);
   $this->datosintegrantesdefensa($datosvocerosdefensa);
   }
   function integrantescomunasfamilia($voceroscomunas,$datosvocerosfamilia){
   $this->cabezaintegrantesfamilia($voceroscomunas);
   $this->datosintegrantesfamilia($datosvocerosfamilia);
   }
   function integrantescomunasdeporte($voceroscomunas,$datosvocerosdeporte){
   $this->cabezaintegrantesdeporte($voceroscomunas);
   $this->datosintegrantesdeporte($datosvocerosdeporte);
   }
   function integrantescomunaseducacion($voceroscomunas,$datosvoceroseducacion){
   $this->cabezaintegranteseducacion($voceroscomunas);
   $this->datosintegranteseducacion($datosvoceroseducacion);
   }
   function integrantescomunasplanificacion($voceroscomunas,$datosvocerosplanificacion){
   $this->cabezaintegrantesplanificacion($voceroscomunas);
   $this->datosintegrantesplanificacion($datosvocerosplanificacion);
   }
   function integrantescomunaseconomiacomunal($voceroscomunas,$datosvoceroseconomiacomunal){
   $this->cabezaintegranteseconomiacomunal($voceroscomunas);
   $this->datosintegranteseconomiacomunal($datosvoceroseconomiacomunal);
   }
   function integrantescomunasadministrador($voceroscomunas,$datosvocerosadministrador){
   $this->cabezaintegrantesadministrador($voceroscomunas);
   $this->datosintegrantesadministrador($datosvocerosadministrador);
   }
   function integrantescomunasaprobacion($voceroscomunas,$datosvocerosaprobacion){
   $this->cabezaintegrantesaprobacion($voceroscomunas);
   $this->datosintegrantesaprobacion($datosvocerosaprobacion);
   }
   function integrantescomunasseguimiento($voceroscomunas,$datosvocerosseguimiento){
   $this->cabezaintegrantesseguimiento($voceroscomunas);
   $this->datosintegrantesseguimiento($datosvocerosseguimiento);
   }
   function integrantescomunasorganizacion($voceroscomunas,$datosvocerosorganizaciones){
   $this->cabezaintegrantesorganizacion($voceroscomunas);
   $this->datosintegrantesorganizacion($datosvocerosorganizaciones);
   }
   function integrantescomunascontrol($voceroscomunas,$datosvoceroscontrol){
   $this->cabezaintegrantescontrol($voceroscomunas);
   $this->datosintegrantescontrol($datosvoceroscontrol);
   }
   function integrantescomunascontraloria($voceroscomunas,$datosvoceroscontraloria){
   $this->cabezaintegrantescontraloria($voceroscomunas);
   $this->datosintegrantescontraloria($datosvoceroscontraloria);
   }


    //***** AquÃ­ comienza cÃ³digo para ajustar texto *************
    //***********************************************************
    function CellFit($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='', $scale=false, $force=true)
    {
        //Get string width
        $str_width=$this->GetStringWidth($txt);

        //Calculate ratio to fit cell
        if($w==0)
            $w = $this->w-$this->rMargin-$this->x;
        $ratio = ($w-$this->cMargin*2)/$str_width;

        $fit = ($ratio < 1 || ($ratio > 1 && $force));
        if ($fit)
        {
            if ($scale)
            {
                //Calculate horizontal scaling
                $horiz_scale=$ratio*100.0;
                //Set horizontal scaling
                $this->_out(sprintf('BT %.2F Tz ET',$horiz_scale));
            }
            else
            {
                //Calculate character spacing in points
                $char_space=($w-$this->cMargin*2-$str_width)/max($this->MBGetStringLength($txt)-1,1)*$this->k;
                //Set character spacing
                $this->_out(sprintf('BT %.2F Tc ET',$char_space));
            }
            //Override user alignment (since text will fill up cell)
            $align='';
        }

        //Pass on to Cell method
        $this->Cell($w,$h,$txt,$border,$ln,$align,$fill,$link);

        //Reset character spacing/horizontal scaling
        if ($fit)
            $this->_out('BT '.($scale ? '100 Tz' : '0 Tc').' ET');
    }

    function CellFitSpace($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
    {
        $this->CellFit($w,$h,$txt,$border,$ln,$align,$fill,$link,false,false);
    }

    //Patch to also work with CJK double-byte text
    function MBGetStringLength($s)
    {
        if($this->CurrentFont['type']=='Type0')
        {
            $len = 0;
            $nbbytes = strlen($s);
            for ($i = 0; $i < $nbbytes; $i++)
            {
                if (ord($s[$i])<128)
                    $len++;
                else
                {
                    $len++;
                    $i++;
                }
            }
            return $len;
        }
        else
            return strlen($s);
    }
//************** Fin del cÃ³digo para ajustar texto *****************
//******************************************************************
 // FIN Class PDF
}


$pdf = new PDF('L','mm','letter');
$pdf->AddPage();

$pdf->SetFont('Arial','B',12);
$pdf->SetLineWidth(0,8);
$pdf->SetTextColor(219,32,32);
$pdf->SetDrawColor(217,215,213);

$miCabecera= array("Parroquia","Sector","Sede");
$misDatos= array();
$Datos= array();
$datosfecha=array();
$cabezadocumentos=array('Acta Constitutiva','Constancia de Eleccion','Cedulas de Integrantes','Certificado de Registro','Rif');
$datodocumentos=array();
$cabezafecha=array('Fecha de Registro','Fecha de Adecuacion','Fecha de Vencimiento','Estado');
$cabeza = array('Nombre','Rif','Codigo');
$base = new Conexion();
$base->conectar();
$sqlver="select * from gestion_social where idgestion_social='$id' and tipo_gestion='comuna'";
$dat = $base->extraer($sqlver);
while($ver = $dat->fetch_array()){
$misDatos[]= array('Parroquia'=>$ver['parroquia'],
'Sector'=>$ver['sector'],
'Sede'=>$ver['sede']
);
$Datos[]=array(
'Nombre'=>$ver['nombre_gestion'],
'Rif'=>$ver['rif'],
'Codigo'=>$ver['codigo_gestion']
);
$datosfecha[] = array(
'Fecha de Registro'=>$ver['fecha_inicio'],
'Fecha de Adecuacion'=>$ver['fecha_registro'],
'Fecha de Vencimiento'=>$ver['fecha_vecimiento'],
'Estado'=>$ver['estado']
);
$datodocumentos[]=array(
'Acta Constitutiva'=>$ver['acta'],
'Constancia de Eleccion'=>$ver['constancia'],
'Cedulas de Integrantes'=>$ver['cedulas'],
'Certificado de Registro'=>$ver['nomina']
);
}
$dat->close();
$cabezaconsejos=array('Consejos Comunales que lo Integran');
$datosconsejos=array();
$sqlver5="select gs.nombre_gestion from gestion_social gs inner join consejos_comunas cc on gs.idgestion_social=cc.idconsejos where gs.tipo_gestion='consejo' and cc.idgestion_social='$id' order by gs.nombre_gestion asc";
$datoss = $base->extraer($sqlver5);
while($ver5= $datoss->fetch_array()){
$datosconsejos[]=array(
'Nombre'=>$ver5['nombre_gestion']
);
}
$datoss->close();
$voceroscomunas=array('Nombre','Apellido','Cedula','Tipo','Nombre del consejos comunal');
$datovocero=array();
$sqlver3="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='parlamento' and ci.idgestion_social='$id' order by ci.tipo asc";
$datos = $base->extraer($sqlver3);
while($ver3=$datos->fetch_array()){
$datovocero[]=array(
'Nombre'=>$ver3['nombre'],
'Apellido'=>$ver3['apellido'],
'Cedula'=>$ver3['cedula'],
'Tipo'=>$ver3['tipo'],
'Nombre de la Gestion Social'=>$ver3['nombre_gestion']
);
}
$datos->close();
$datosvoceros=array();
$sqlver4="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='ejecutivo' and ci.idgestion_social='$id' order by ci.tipo asc";
$dato = $base->extraer($sqlver4);
while($ver4=$dato->fetch_array()){
$datosvoceros[]=array(
'Nombre'=>$ver4['nombre'],
'Apellido'=>$ver4['apellido'],
'Cedula'=>$ver4['cedula'],
'Tipo'=>$ver4['tipo'],
'Nombre de la Gestion Social'=>$ver4['nombre_gestion']
);
}
$dato->close();

$datosvocerosderechos=array();
$sqlver5="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='derechos humanos' and ci.idgestion_social='$id' order by ci.tipo asc";
$datos= $base->extraer($sqlver5);
while($ver5 =$datos->fetch_array()){
$datosvocerosderechos[]=array(
'Nombre'=>$ver5['nombre'],
'Apellido'=>$ver5['apellido'],
'Cedula'=>$ver5['cedula'],
'Tipo'=>$ver5['tipo'],
'Nombre de la Gestion Social'=>$ver5['nombre_gestion']
);
}
$datos->close();

$datosvocerossalud=array();
$sqlver6="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='comite salud' and ci.idgestion_social='$id' order by ci.tipo asc";
$datos= $base->extraer($sqlver6);
while($ver6 =$datos->fetch_array()){
$datosvocerossalud[]=array(
'Nombre'=>$ver6['nombre'],
'Apellido'=>$ver6['apellido'],
'Cedula'=>$ver6['cedula'],
'Tipo'=>$ver6['tipo'],
'Nombre de la Gestion Social'=>$ver6['nombre_gestion']
);
}
$datos->close();

$datosvocerostierra=array();
$sqlver7="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='tierra' and ci.idgestion_social='$id' order by ci.tipo asc";
$datos= $base->extraer($sqlver7);
while($ver7 =$datos->fetch_array()){
$datosvocerostierra[]=array(
'Nombre'=>$ver7['nombre'],
'Apellido'=>$ver7['apellido'],
'Cedula'=>$ver7['cedula'],
'Tipo'=>$ver7['tipo'],
'Nombre de la Gestion Social'=>$ver7['nombre_gestion']
);
}
$datos->close();

$datosvocerosbienes=array();
$sqlver8="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='bienes' and ci.idgestion_social='$id' order by ci.tipo asc";
$datos= $base->extraer($sqlver8);
while($ver8 =$datos->fetch_array()){
$datosvocerosbienes[]=array(
'Nombre'=>$ver8['nombre'],
'Apellido'=>$ver8['apellido'],
'Cedula'=>$ver8['cedula'],
'Tipo'=>$ver8['tipo'],
'Nombre de la Gestion Social'=>$ver8['nombre_gestion']
);
}
$datos->close();

$datosvoceroseconomia=array();
$sqlver9="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='econimia y produccion' and ci.idgestion_social='$id' order by ci.tipo asc";
$datos= $base->extraer($sqlver9);
while($ver9 =$datos->fetch_array()){
$datosvoceroseconomia[]=array(
'Nombre'=>$ver9['nombre'],
'Apellido'=>$ver9['apellido'],
'Cedula'=>$ver9['cedula'],
'Tipo'=>$ver9['tipo'],
'Nombre de la Gestion Social'=>$ver9['nombre_gestion']
);
}
$datos->close();

$datosvocerosmujeres=array();
$sqlver10="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='mujer' and ci.idgestion_social='$id' order by ci.tipo asc";
$datos= $base->extraer($sqlver10);
while($ver10 =$datos->fetch_array()){
$datosvocerosmujeres[]=array(
'Nombre'=>$ver10['nombre'],
'Apellido'=>$ver10['apellido'],
'Cedula'=>$ver10['cedula'],
'Tipo'=>$ver10['tipo'],
'Nombre de la Gestion Social'=>$ver10['nombre_gestion']
);
}
$datos->close();

$datosvocerosdefensa=array();
$sqlver11="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='defensa y seguridad' and ci.idgestion_social='$id' order by ci.tipo asc";
$datos= $base->extraer($sqlver11);
while($ver11 =$datos->fetch_array()){
$datosvocerosdefensa[]=array(
'Nombre'=>$ver11['nombre'],
'Apellido'=>$ver11['apellido'],
'Cedula'=>$ver11['cedula'],
'Tipo'=>$ver11['tipo'],
'Nombre de la Gestion Social'=>$ver11['nombre_gestion']
);
}
$datos->close();

$datosvocerosfamilia=array();
$sqlver12="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='familia' and ci.idgestion_social='$id' order by ci.tipo asc";
$datos= $base->extraer($sqlver12);
while($ver12 =$datos->fetch_array()){
$datosvocerosfamilia[]=array(
'Nombre'=>$ver12['nombre'],
'Apellido'=>$ver12['apellido'],
'Cedula'=>$ver12['cedula'],
'Tipo'=>$ver12['tipo'],
'Nombre de la Gestion Social'=>$ver12['nombre_gestion']
);
}
$datos->close();

$datosvocerosdeporte=array();
$sqlver13="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion,i.idintegrantes_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='deporte' and ci.idgestion_social='$id' order by ci.tipo asc";
$datos= $base->extraer($sqlver13);
while($ver13 =$datos->fetch_array()){
$datosvocerosdeporte[]=array(
'Nombre'=>$ver13['nombre'],
'Apellido'=>$ver13['apellido'],
'Cedula'=>$ver13['cedula'],
'Tipo'=>$ver13['tipo'],
'Nombre de la Gestion Social'=>$ver13['nombre_gestion']
);
}
$datos->close();

$datosvoceroseducacion=array();
$sqlver14="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion,i.idintegrantes_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='educacion' and ci.idgestion_social='$id' order by ci.tipo asc";
$datos= $base->extraer($sqlver14);
while($ver14 =$datos->fetch_array()){
$datosvoceroseducacion[]=array(
'Nombre'=>$ver14['nombre'],
'Apellido'=>$ver14['apellido'],
'Cedula'=>$ver14['cedula'],
'Tipo'=>$ver14['tipo'],
'Nombre de la Gestion Social'=>$ver14['nombre_gestion']
);
}
$datos->close();

$datosvocerosplanificacion=array();
$sqlver15="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='planificacion' and ci.idgestion_social='$id' order by ci.tipo asc";
$datos= $base->extraer($sqlver15);
while($ver15 =$datos->fetch_array()){
$datosvocerosplanificacion[]=array(
'Nombre'=>$ver15['nombre'],
'Apellido'=>$ver15['apellido'],
'Cedula'=>$ver15['cedula'],
'Tipo'=>$ver15['tipo'],
'Nombre de la Gestion Social'=>$ver15['nombre_gestion']
);
}
$datos->close();

$datosvoceroseconomiacomunal=array();
$sqlver16="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='economia comunal' and ci.idgestion_social='$id' order by ci.tipo asc";
$datos= $base->extraer($sqlver16);
while($ver16 =$datos->fetch_array()){
$datosvoceroseconomiacomunal[]=array(
'Nombre'=>$ver16['nombre'],
'Apellido'=>$ver16['apellido'],
'Cedula'=>$ver16['cedula'],
'Tipo'=>$ver16['tipo'],
'Nombre de la Gestion Social'=>$ver16['nombre_gestion']
);
}
$datos->close();

$datosvocerosadministrador=array();
$sqlver17="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='administracion' and ci.idgestion_social='$id' order by ci.tipo asc";
$datos= $base->extraer($sqlver17);
while($ver17 =$datos->fetch_array()){
$datosvocerosadministrador[]=array(
'Nombre'=>$ver17['nombre'],
'Apellido'=>$ver17['apellido'],
'Cedula'=>$ver17['cedula'],
'Tipo'=>$ver17['tipo'],
'Nombre de la Gestion Social'=>$ver17['nombre_gestion']
);
}
$datos->close();

$datosvocerosaprobacion=array();
$sqlver18="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='aprobacion' and ci.idgestion_social='$id' order by ci.tipo asc";
$datos= $base->extraer($sqlver18);
while($ver18 =$datos->fetch_array()){
$datosvocerosaprobacion[]=array(
'Nombre'=>$ver18['nombre'],
'Apellido'=>$ver18['apellido'],
'Cedula'=>$ver18['cedula'],
'Tipo'=>$ver18['tipo'],
'Nombre de la Gestion Social'=>$ver18['nombre_gestion']
);
}
$datos->close();

$datosvocerosseguimiento=array();
$sqlver19="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='seguimiento y control' and ci.idgestion_social='$id' order by ci.tipo asc";
$datos= $base->extraer($sqlver19);
while($ver19 =$datos->fetch_array()){
$datosvocerosseguimiento[]=array(
'Nombre'=>$ver19['nombre'],
'Apellido'=>$ver19['apellido'],
'Cedula'=>$ver19['cedula'],
'Tipo'=>$ver19['tipo'],
'Nombre de la Gestion Social'=>$ver19['nombre_gestion']
);
}
$datos->close();

$datosvocerosorganizaciones=array();
$sqlver20="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='organizaciones socio productiva' and ci.idgestion_social='$id' order by ci.tipo asc";
$datos= $base->extraer($sqlver20);
while($ver20 =$datos->fetch_array()){
$datosvocerosorganizaciones[]=array(
'Nombre'=>$ver20['nombre'],
'Apellido'=>$ver20['apellido'],
'Cedula'=>$ver20['cedula'],
'Tipo'=>$ver20['tipo'],
'Nombre de la Gestion Social'=>$ver20['nombre_gestion']
);
}
$datos->close();

$datosvoceroscontrol=array();
$sqlver21="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='seguimiento y control del parlamento' and ci.idgestion_social='$id' order by ci.tipo asc";
$datos= $base->extraer($sqlver21);
while($ver21 =$datos->fetch_array()){
$datosvoceroscontrol[]=array(
'Nombre'=>$ver21['nombre'],
'Apellido'=>$ver21['apellido'],
'Cedula'=>$ver21['cedula'],
'Tipo'=>$ver21['tipo'],
'Nombre de la Gestion Social'=>$ver21['nombre_gestion']
);
}
$datos->close();

$datosvoceroscontraloria=array();
$sqlver22="select i.nombre,i.apellido,i.cedula,ci.tipo,gs.nombre_gestion from integrantes_gestion i inner join cargo_integrantes_gestion ci on ci.idintegrantes_gestion=i.idintegrantes_gestion inner join gestion_social gs on i.idconsejo=gs.idgestion_social where gs.tipo_gestion='consejo' and i.idcomuna='$id' and ci.cargo='contraloria' and ci.idgestion_social='$id' order by ci.tipo asc";
$datos= $base->extraer($sqlver22);
while($ver22 =$datos->fetch_array()){
$datosvoceroscontraloria[]=array(
'Nombre'=>$ver22['nombre'],
'Apellido'=>$ver22['apellido'],
'Cedula'=>$ver22['cedula'],
'Tipo'=>$ver22['tipo'],
'Nombre de la Gestion Social'=>$ver22['nombre_gestion']
);
}
$datos->close();
$pdf->tablaHorizontal($miCabecera,$misDatos);
$pdf->datoscomunas($cabeza,$Datos);
$pdf->fechacomunas($cabezafecha,$datosfecha);
$pdf->documentoscomuna($cabezadocumentos,$datodocumentos);
$pdf->Ln(2);
$pdf->consejoscomunas($cabezaconsejos,$datosconsejos);
$pdf->Ln(2);
$pdf->integrantescomunas($voceroscomunas,$datovocero);
$pdf->Ln(2);
$pdf->integrantescomunas2($voceroscomunas,$datosvoceros);
$pdf->Ln(2);
$pdf->integrantescomunasderechos($voceroscomunas,$datosvocerosderechos);
$pdf->Ln(2);
$pdf->integrantescomunassalud($voceroscomunas,$datosvocerossalud);
$pdf->Ln(2);
$pdf->integrantescomunastierra($voceroscomunas,$datosvocerostierra);
$pdf->Ln(2);
$pdf->integrantescomunasbienes($voceroscomunas,$datosvocerosbienes);
$pdf->Ln(2);
$pdf->integrantescomunaseconomia($voceroscomunas,$datosvoceroseconomia);
$pdf->Ln(2);
$pdf->integrantescomunasmujeres($voceroscomunas,$datosvocerosmujeres);
$pdf->Ln(2);
$pdf->integrantescomunasdefensa($voceroscomunas,$datosvocerosdefensa);
$pdf->Ln(2);
$pdf->integrantescomunasfamilia($voceroscomunas,$datosvocerosfamilia);
$pdf->Ln(2);
$pdf->integrantescomunasdeporte($voceroscomunas,$datosvocerosdeporte);
$pdf->Ln(2);
$pdf->integrantescomunaseducacion($voceroscomunas,$datosvoceroseducacion);
$pdf->Ln(2);
$pdf->integrantescomunasplanificacion($voceroscomunas,$datosvocerosplanificacion);
$pdf->Ln(2);
$pdf->integrantescomunaseconomiacomunal($voceroscomunas,$datosvoceroseconomiacomunal);
$pdf->Ln(2);
$pdf->integrantescomunasadministrador($voceroscomunas,$datosvocerosadministrador);
$pdf->Ln(2);
$pdf->integrantescomunasaprobacion($voceroscomunas,$datosvocerosaprobacion);
$pdf->Ln(2);
$pdf->integrantescomunasseguimiento($voceroscomunas,$datosvocerosseguimiento);
$pdf->Ln(2);
$pdf->integrantescomunasorganizacion($voceroscomunas,$datosvocerosorganizaciones);
$pdf->Ln(2);
$pdf->integrantescomunascontrol($voceroscomunas,$datosvoceroscontrol);
$pdf->Ln(2);
$pdf->integrantescomunascontraloria($voceroscomunas,$datosvoceroscontraloria);

$sqlver6="select nombre_gestion from gestion_social where idgestion_social='$id' and tipo_gestion='comuna'";
$datos = $base->extraer($sqlver6);
while($ver6=$datos->fetch_array()){
$nombregestion = $ver6['nombre_gestion'];
}
$datos->close();
$base->cerrar();

$pdf->Output("Datos De La Comuna Socialista ".$nombregestion.".pdf","D");
}
}
?>
