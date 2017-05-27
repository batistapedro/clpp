<?php
session_start();
if(isset($_SESSION['tipo'])&& !empty($_SESSION['tipo'])){
if($_SESSION['tipo']=="administrador"||($_SESSION['tipo']=="operador" ||($_SESSION['tipo']=="movimientos" ||($_SESSION['tipo']=="concejal" ||($_SESSION['tipo']="comunas"))))){
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
$this->Cell(0,10,'Consejo Local De Planificacion Publica, Registros De Los Movimientos Sociales, Municipio Heres','T',0,'C');
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
$this->Cell(0,5,'Registros De Los Movimientos Sociales',0,1,'C');
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
        $this->Cell(0,7,"Direccion del Movimiento Social",0,0,'C');
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
        $this->Cell(0,7,"Datos del Movimiento Social",0,0,'C');
        $this->Ln();
        $this->SetFont('Arial','B',11);
        $this->SetFillColor(219,32,32);//Fondo rojo de celda
        $this->SetTextColor(240, 255, 240); //Letra color blanco

         $this->CellFitSpace(120,7, utf8_decode($cabeza[0]),1, 0 , 'C', true);
         $this->CellFitSpace(45,7, utf8_decode($cabeza[1]),1, 0 , 'C', true);
 	    $this->CellFitSpace(35,7,utf8_decode($cabeza[2]),1,0,'C',true);
	    $this->CellFitSpace(55,7,utf8_decode($cabeza[3]),1,1,'C',true);
    }

        function datosmovimiento($datoss){
         $this->SetXY(10,83);
        $this->SetFont('Arial','I',10);
        $this->SetFillColor(245, 245, 245); //Gris tenue de cada fila
        $this->SetTextColor(0, 0, 0); //Color del texto: Negro
        $bandera = false; //Para alternar el relleno
        foreach($datoss as $fila)
        {
            //Usaremos CellFitSpace en lugar de Cell
            $this->CellFitSpace(120,8, utf8_decode($fila['Nombre']),1, 0 , 'C', $bandera );
             $this->CellFitSpace(45,8, utf8_decode($fila['Tipo']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(35,8, utf8_decode($fila['Rif']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(55,8, utf8_decode($fila['Codigo']),1, 0 , 'C', $bandera );
            $this->Ln();//Salto de lÃ­nea para generar otra fila
            $bandera = !$bandera;//Alterna el valor de la bandera
        }
    }

    function cabezafechas($cabeza){
    	   $this->SetXY(10,93);
        $this->SetFont('Arial','I',15);
        $this->SetTextColor(219,39,39);
        $this->Cell(0,7,"Fecha del Movimiento Social",0,0,'C');
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
        $this->Cell(0,7,"Documentos del Movimiento Social",0,0,'C');
        $this->Ln();
        $this->SetFont('Arial','B',11);
        $this->SetFillColor(219,32,32);//Fondo rojo de celda
        $this->SetTextColor(240, 255, 240); //Letra color blanco

         $this->CellFitSpace(64,7, utf8_decode($cabeza[0]),1, 0 , 'C', true);
 	    $this->CellFitSpace(64,7,utf8_decode($cabeza[1]),1,0,'C',true);
 	    $this->CellFitSpace(64,7,utf8_decode($cabeza[2]),1,0,'C',true);
	    $this->CellFitSpace(64,7,utf8_decode($cabeza[3]),1,1,'C',true);
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
            $this->CellFitSpace(64,8, utf8_decode($fila['Nomina de Integrantes']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(64,8, utf8_decode($fila['Constancia de Eleccion']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(64,8, utf8_decode($fila['Cedulas de Integrantes']),1, 0 , 'C', $bandera );
            $this->Ln();//Salto de lÃ­nea para generar otra fila
            $bandera = !$bandera;//Alterna el valor de la bandera
        }
   }

   function cabezavoceros($cabeza){
	 // $this->SetXY(10,148);
        $this->SetFont('Arial','I',15);
        $this->SetTextColor(219,39,39);
        $this->Cell(0,7,"Integrantes Principales",0,0,'C');
        $this->Ln();
        $this->SetFont('Arial','B',11);
        $this->SetFillColor(219,32,32);//Fondo rojo de celda
        $this->SetTextColor(240, 255, 240); //Letra color blanco

         $this->CellFitSpace(41,7, utf8_decode($cabeza[0]),1, 0 , 'C', true);
 	    $this->CellFitSpace(41,7,utf8_decode($cabeza[1]),1,0,'C',true);
 	    $this->CellFitSpace(41,7,utf8_decode($cabeza[2]),1,0,'C',true);
 	    $this->CellFitSpace(41,7,utf8_decode($cabeza[3]),1,0,'C',true);
	    $this->CellFitSpace(91,7,utf8_decode($cabeza[4]),1,1,'C',true);

   }

   function datosintvoceros($datos){

       // $this->SetXY(10,162);
        $this->SetFont('Arial','I',10);
        $this->SetFillColor(245, 245, 245); //Gris tenue de cada fila
        $this->SetTextColor(0, 0, 0); //Color del texto: Negro
        $bandera = false; //Para alternar el relleno
        foreach($datos as $fila)
        {
            //Usaremos CellFitSpace en lugar de Cell
            $this->CellFitSpace(41,8, utf8_decode($fila['Nombre']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(41,8, utf8_decode($fila['Apellido']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(41,8, utf8_decode($fila['Cedula']),1, 0 , 'C', $bandera );
             $this->CellFitSpace(41,8, utf8_decode($fila['Telefono']),1, 0 , 'C', $bandera );
             $this->CellFitSpace(91,8,utf8_decode($fila['Cargo']),1,0,'C',$bandera);
            $this->Ln();//Salto de lÃ­nea para generar otra fila
            $bandera = !$bandera;//Alterna el valor de la bandera
        }
   }

   function cabezavocerosuple($cabeza){
    // $this->SetXY(10,148);
        $this->SetFont('Arial','I',15);
        $this->SetTextColor(219,39,39);
        $this->Cell(0,7,"Integrantes Suplentes",0,0,'C');
        $this->Ln();
        $this->SetFont('Arial','B',11);
        $this->SetFillColor(219,32,32);//Fondo rojo de celda
        $this->SetTextColor(240, 255, 240); //Letra color blanco

         $this->CellFitSpace(41,7, utf8_decode($cabeza[0]),1, 0 , 'C', true);
 	    $this->CellFitSpace(41,7,utf8_decode($cabeza[1]),1,0,'C',true);
 	    $this->CellFitSpace(41,7,utf8_decode($cabeza[2]),1,0,'C',true);
 	    $this->CellFitSpace(41,7,utf8_decode($cabeza[3]),1,0,'C',true);
	    $this->CellFitSpace(91,7,utf8_decode($cabeza[4]),1,1,'C',true);
   }
   function datosintvocerossuple($datos){
      // $this->SetXY(10,162);
        $this->SetFont('Arial','I',10);
        $this->SetFillColor(245, 245, 245); //Gris tenue de cada fila
        $this->SetTextColor(0, 0, 0); //Color del texto: Negro
        $bandera = false; //Para alternar el relleno
        foreach($datos as $fila)
        {
            //Usaremos CellFitSpace en lugar de Cell
            $this->CellFitSpace(41,8, utf8_decode($fila['Nombre']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(41,8, utf8_decode($fila['Apellido']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(41,8, utf8_decode($fila['Cedula']),1, 0 , 'C', $bandera );
             $this->CellFitSpace(41,8, utf8_decode($fila['Telefono']),1, 0 , 'C', $bandera );
             $this->CellFitSpace(91,8,utf8_decode($fila['Cargo']),1,0,'C',$bandera);
            $this->Ln();//Salto de lÃ­nea para generar otra fila
            $bandera = !$bandera;//Alterna el valor de la bandera
        }
   }

       function tablaHorizontal($cabeceraHorizontal, $datosHorizontal){
        $this->cabeceraHorizontal($cabeceraHorizontal);
        $this->datosHorizontal($datosHorizontal);
    }
     function datosmovimientos($cabeceradatos,$datosmovimiento){
      $this->cabeceradatos($cabeceradatos);
      $this->datosmovimiento($datosmovimiento);
    }
   function fechamovimientos($cabezafecha,$datosfecha){
   $this->cabezafechas($cabezafecha);
   $this->datosfechas($datosfecha);
   }
   function documentosmovimientos($cabezadocumento,$datodocumento){
   $this->cabezadocumentos($cabezadocumento);
   $this->datosdocumentos($datodocumento);
   }
   function datosvoceros($vocerosmovimientos,$datovocero){
   $this->cabezavoceros($vocerosmovimientos);
   $this->datosintvoceros($datovocero);
   }
   function datosvocerossu($vocerosmovimientos,$datosvoceros){
   $this->cabezavocerosuple($vocerosmovimientos);
   $this->datosintvocerossuple($datosvoceros);
   }



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
$cabezafecha=array('Fecha de Registro','Fecha de Adecuacion','Fecha de Vencimiento','Estado');
$cabeza = array('Nombre','Tipo','Rif','Codigo');
$cabezadocumentos=array('Acta Constitutiva','Nomina de Integrantes','Constancia de Eleccion','Cedulas de Integrantes');
$datodocumentos=array();
$base = new Conexion();
$base->conectar();

$sqlver="select * from gestion_social where idgestion_social='$id' and tipo_gestion='movimiento'";
$datos = $base->extraer($sqlver);
while($ver = $datos->fetch_array()){
$misDatos[]= array('Parroquia'=>$ver['parroquia'],
'Sector'=>$ver['sector'],
'Sede'=>$ver['sede']
);
$Datos[]=array(
'Nombre'=>$ver['nombre_gestion'],
'Tipo'=>$ver['tipo'],
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
'Nomina de Integrantes'=>$ver['nomina'],
'Constancia de Eleccion'=>$ver['constancia'],
'Cedulas de Integrantes'=>$ver['cedulas']
);
}
$datos->close();

$vocerosmovimientos=array('Nombre','Apellido','Cedula','Telefono','Cargo');
$datovocero=array();
$sqlver3="select i.nombre, i.apellido,i.cedula,i.telefono,ci.cargo from integrantes_gestion i inner join cargo_integrantes_gestion ci on i.idintegrantes_gestion=ci.idintegrantes_gestion where i.movimiento=1 and ci.idgestion_social='$id' and ci.tipo='principal'";
$datos = $base->extraer($sqlver3);
while($ver3=$datos->fetch_array()){
$datovocero[]=array(
'Nombre'=>$ver3['nombre'],
'Apellido'=>$ver3['apellido'],
'Cedula'=>$ver3['cedula'],
'Telefono'=>$ver3['telefono'],
'Cargo'=>$ver3['cargo']
);
}
$datos->close();
$datosvoceros=array();
$sqlver4="select i.nombre, i.apellido,i.cedula,i.telefono,ci.cargo from integrantes_gestion i inner join cargo_integrantes_gestion ci on i.idintegrantes_gestion=ci.idintegrantes_gestion where i.movimiento=1 and ci.idgestion_social='$id' and ci.tipo='suplente'";
$dato = $base->extraer($sqlver4);
while($ver4=$dato->fetch_array()){
$datosvoceros[]=array(
'Nombre'=>$ver4['nombre'],
'Apellido'=>$ver4['apellido'],
'Cedula'=>$ver4['cedula'],
'Telefono'=>$ver4['telefono'],
'Cargo'=>$ver4['cargo']
);
}
$dato->close();
$pdf->tablaHorizontal($miCabecera,$misDatos);
$pdf->datosmovimientos($cabeza,$Datos);
$pdf->fechamovimientos($cabezafecha,$datosfecha);
$pdf->documentosmovimientos($cabezadocumentos,$datodocumentos);
$pdf->Ln(2);
$pdf->datosvoceros($vocerosmovimientos,$datovocero);
$pdf->Ln(2);
$pdf->datosvocerossu($vocerosmovimientos,$datosvoceros);

$sqlver5="select nombre_gestion from gestion_social where idgestion_social='$id' and tipo_gestion='movimiento'";
$datos= $base->extraer($sqlver5);
while($ver5=$datos->fetch_array()){
$nombregestion=$ver5['nombre_gestion'];
}
$datos->close();
$base->cerrar();
$pdf->Output("Datos Del movimiento Social ".$nombregestion.".pdf","D");
}
}
?>
