<?php
session_start();
if(isset($_SESSION['tipo'])&& !empty($_SESSION['tipo'])){
if($_SESSION['tipo']=="administrador" ||($_SESSION['tipo']=="operador" ||($_SESSION['tipo']=="consejos" ||($_SESSION['tipo']=="comunas" ||($_SESSION['tipo']=="concejal"))))){
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
$this->Cell(0,10,'Consejo Local De Planificacion Publica, Registros De Los Consejos comunales, Municipio Heres','T',0,'C');
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
$this->Cell(0,5,'Registros De Los Consejos Comunales',0,1,'C');
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
        $this->Cell(0,7,"Direccion del Consejo Comunal",0,0,'C');
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
        $this->Cell(0,7,"Datos del Consejo Comunal",0,0,'C');
        $this->Ln();
        $this->SetFont('Arial','B',11);
        $this->SetFillColor(219,32,32);//Fondo rojo de celda
        $this->SetTextColor(240, 255, 240); //Letra color blanco

         $this->CellFitSpace(160,7, utf8_decode($cabeza[0]),1, 0 , 'C', true);
 	    $this->CellFitSpace(40,7,utf8_decode($cabeza[1]),1,0,'C',true);
	    $this->CellFitSpace(55,7,utf8_decode($cabeza[2]),1,1,'C',true);
    }

   function datosconsejo($datoss){
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
        $this->Cell(0,7,"Fecha del Consejo Comunal",0,0,'C');
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
        $this->Cell(0,7,"Documentos del Consejo Comunal",0,0,'C');
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
            $this->CellFitSpace(64,8, utf8_decode($fila['Certificado de Registro']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(64,8, utf8_decode($fila['Cedulas de Integrantes']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(64,8, utf8_decode($fila['Nomina Actualizada']),1, 0 , 'C', $bandera );
            $this->Ln();//Salto de lÃ­nea para generar otra fila
            $bandera = !$bandera;//Alterna el valor de la bandera
        }
    }

    function cabezavocerosadministrativos($cabeza){
    $this->SetXY(10,148);
        $this->SetFont('Arial','I',15);
        $this->SetTextColor(219,39,39);
        $this->Cell(0,7,"Unidad Administrativa y Financiera",0,0,'C');
        $this->Ln();
        $this->SetFont('Arial','B',11);
        $this->SetFillColor(219,32,32);//Fondo rojo de celda
        $this->SetTextColor(240, 255, 240); //Letra color blanco

        $this->CellFitSpace(51,7, utf8_decode($cabeza[0]),1, 0 , 'C', true);
 	    $this->CellFitSpace(51,7,utf8_decode($cabeza[1]),1,0,'C',true);
 	    $this->CellFitSpace(51,7,utf8_decode($cabeza[2]),1,0,'C',true);
 	    $this->CellFitSpace(51,7,utf8_decode($cabeza[3]),1,0,'C',true);
	    $this->CellFitSpace(51,7,utf8_decode($cabeza[4]),1,1,'C',true);

    }

    function datosadministrativos($datos){
        $this->SetXY(10,162);
        $this->SetFont('Arial','I',10);
        $this->SetFillColor(245, 245, 245); //Gris tenue de cada fila
        $this->SetTextColor(0, 0, 0); //Color del texto: Negro
        $bandera = false; //Para alternar el relleno
        foreach($datos as $fila)
        {
            //Usaremos CellFitSpace en lugar de Cell
            $this->CellFitSpace(51,8, utf8_decode($fila['Nombre']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(51,8, utf8_decode($fila['Apellido']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(51,8, utf8_decode($fila['Cedula']),1, 0 , 'C', $bandera );
             $this->CellFitSpace(51,8, utf8_decode($fila['Telefono']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(51,8, utf8_decode($fila['Tipo']),1, 0 , 'C', $bandera );
            $this->Ln();//Salto de lÃ­nea para generar otra fila
            $bandera = !$bandera;//Alterna el valor de la bandera
        }

    }

    function cabezacontraloria($cabeza){
    // $this->SetXY(10,148);
        $this->SetFont('Arial','I',15);
        $this->SetTextColor(219,39,39);
        $this->Cell(0,7,"Unidad de Contraloria Social",0,0,'C');
        $this->Ln();
        $this->SetFont('Arial','B',11);
        $this->SetFillColor(219,32,32);//Fondo rojo de celda
        $this->SetTextColor(240, 255, 240); //Letra color blanco

         $this->CellFitSpace(51,7, utf8_decode($cabeza[0]),1, 0 , 'C', true);
 	    $this->CellFitSpace(51,7,utf8_decode($cabeza[1]),1,0,'C',true);
 	    $this->CellFitSpace(51,7,utf8_decode($cabeza[2]),1,0,'C',true);
 	    $this->CellFitSpace(51,7,utf8_decode($cabeza[3]),1,0,'C',true);
	    $this->CellFitSpace(51,7,utf8_decode($cabeza[4]),1,1,'C',true);


    }

    function datoscontraloria($datos){
   // $this->SetXY(10,162);
        $this->SetFont('Arial','I',10);
        $this->SetFillColor(245, 245, 245); //Gris tenue de cada fila
        $this->SetTextColor(0, 0, 0); //Color del texto: Negro
        $bandera = false; //Para alternar el relleno
        foreach($datos as $fila)
        {
            //Usaremos CellFitSpace en lugar de Cell
            $this->CellFitSpace(51,8, utf8_decode($fila['Nombre']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(51,8, utf8_decode($fila['Apellido']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(51,8, utf8_decode($fila['Cedula']),1, 0 , 'C', $bandera );
             $this->CellFitSpace(51,8, utf8_decode($fila['Telefono']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(51,8, utf8_decode($fila['Tipo']),1, 0 , 'C', $bandera );
            $this->Ln();//Salto de lÃ­nea para generar otra fila
            $bandera = !$bandera;//Alterna el valor de la bandera
        }
    }

    function cabezaejecutiva($cabeza){
      // $this->SetXY(10,148);
        $this->SetFont('Arial','I',15);
        $this->SetTextColor(219,39,39);
        $this->Cell(0,7,"Unidad de Ejecutiva",0,0,'C');
        $this->Ln();
        $this->SetFont('Arial','B',11);
        $this->SetFillColor(219,32,32);//Fondo rojo de celda
        $this->SetTextColor(240, 255, 240); //Letra color blanco

         $this->CellFitSpace(35,7, utf8_decode($cabeza[0]),1, 0 , 'C', true);
 	    $this->CellFitSpace(35,7,utf8_decode($cabeza[1]),1,0,'C',true);
 	    $this->CellFitSpace(30,7,utf8_decode($cabeza[2]),1,0,'C',true);
 	    $this->CellFitSpace(30,7,utf8_decode($cabeza[3]),1,0,'C',true);
 	    $this->CellFitSpace(95,7,utf8_decode($cabeza[4]),1,0,'C',true);
	    $this->CellFitSpace(30,7,utf8_decode($cabeza[5]),1,1,'C',true);


    }

    function datosejecutiva($datos){
     // $this->SetXY(10,162);
        $this->SetFont('Arial','I',10);
        $this->SetFillColor(245, 245, 245); //Gris tenue de cada fila
        $this->SetTextColor(0, 0, 0); //Color del texto: Negro
        $bandera = false; //Para alternar el relleno
        foreach($datos as $fila)
        {
            //Usaremos CellFitSpace en lugar de Cell
            $this->CellFitSpace(35,8, utf8_decode($fila['Nombre']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(35,8, utf8_decode($fila['Apellido']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(30,8, utf8_decode($fila['Cedula']),1, 0 , 'C', $bandera );
             $this->CellFitSpace(30,8, utf8_decode($fila['Telefono']),1, 0 , 'C', $bandera );
             $this->CellFitSpace(95,8,utf8_decode($fila['Voceria']),1,0,'C',$bandera);
            $this->CellFitSpace(30,8, utf8_decode($fila['Tipo']),1, 0 , 'C', $bandera );
            $this->Ln();//Salto de lÃ­nea para generar otra fila
            $bandera = !$bandera;//Alterna el valor de la bandera
        }

    }


    function tablaHorizontal($cabeceraHorizontal, $datosHorizontal)
    {
        $this->cabeceraHorizontal($cabeceraHorizontal);
        $this->datosHorizontal($datosHorizontal);
    }
    function datosconsejos($cabeceradatos,$datosconsejo){
    $this->cabeceradatos($cabeceradatos);
    $this->datosconsejo($datosconsejo);
    }
   function fechaconsejos($cabezafecha,$datosfecha){
   $this->cabezafechas($cabezafecha);
   $this->datosfechas($datosfecha);
   }
   function documentosconsejos($cabezadocumento,$datodocumento){
   $this->cabezadocumentos($cabezadocumento);
   $this->datosdocumentos($datodocumento);
   }
   function vocerosadministrativos($cabezavoceros,$administrativo){
   $this->cabezavocerosadministrativos($cabezavoceros);
   $this->datosadministrativos($administrativo);
   }
   function voceroscontralorias($cabezavoceros,$contraloria){
   $this->cabezacontraloria($cabezavoceros);
   $this->datoscontraloria($contraloria);
   }
   function vocerosejecutivas($cabezavoceros,$ejecutiva){
   $this->cabezaejecutiva($cabezavoceros);
   $this->datosejecutiva($ejecutiva);
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
$cabezafecha=array('Fecha de Registro','Fecha de Adecuacion','Fecha de Vencimiento','Estado');
$cabeza = array('Nombre','Rif','Codigo');
$cabezadocumentos=array('Acta Constitutiva','Certificado de Registro','Cedulas de Integrantes','Nomina Actualizada');
$datodocumentos=array();

$base = new Conexion();
$base->conectar();
$sqlver="select * from gestion_social where idgestion_social='$id' and tipo_gestion='consejo'";
$datos = $base->extraer($sqlver);
while($ver = $datos->fetch_array()){

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
'Certificado de Registro'=>$ver['constancia'],
'Cedulas de Integrantes'=>$ver['cedulas'],
'Nomina Actualizada'=>$ver['nomina']
);
}
$datos->close();
$cabezavoceros= array('Nombre','Apellido','Cedula','Telefono','tipo');
$administrativo= array();
$sqlver3="select i.nombre, i.apellido,i.cedula,i.telefono,ci.tipo from integrantes_gestion i inner join cargo_integrantes_gestion ci on i.idintegrantes_gestion=ci.idintegrantes_gestion where i.consejo=1 and ci.idgestion_social='$id' and ci.unidad='administrativa' order by ci.tipo asc";
$datos = $base->extraer($sqlver3);
while($ver3=$datos->fetch_array()){
$administrativo[]=array(
'Nombre'=>$ver3['nombre'],
'Apellido'=>$ver3['apellido'],
'Cedula'=>$ver3['cedula'],
'Telefono'=>$ver3['telefono'],
'Tipo'=>$ver3['tipo']
);
}
$datos->close();
$contraloria= array();
$sqlver4="select i.nombre, i.apellido,i.cedula,i.telefono,ci.tipo from integrantes_gestion i inner join cargo_integrantes_gestion ci on i.idintegrantes_gestion=ci.idintegrantes_gestion where i.consejo=1 and ci.idgestion_social='$id' and ci.unidad='contraloria' order by ci.tipo asc";
$dato = $base->extraer($sqlver4);
while($ver4=$dato->fetch_array()){
$contraloria[]=array(
'Nombre'=>$ver4['nombre'],
'Apellido'=>$ver4['apellido'],
'Cedula'=>$ver4['cedula'],
'Telefono'=>$ver4['telefono'],
'Tipo'=>$ver4['tipo']
);
}
$dato->close();

$cabezaejecutiva= array('Nombre','Apellido','Cedula','Telefono','Voceria','Tipo');
$ejecutiva= array();
$sqlver5="select i.nombre, i.apellido,i.cedula,i.telefono,ci.cargo,ci.tipo from integrantes_gestion i inner join cargo_integrantes_gestion ci on i.idintegrantes_gestion=ci.idintegrantes_gestion where i.consejo=1 and ci.idgestion_social='$id' and ci.unidad='ejecutiva' order by ci.tipo asc";
$datos = $base->extraer($sqlver5);
while($ver5=$datos->fetch_array()){
$ejecutiva[]=array(
'Nombre'=>$ver5['nombre'],
'Apellido'=>$ver5['apellido'],
'Cedula'=>$ver5['cedula'],
'Telefono'=>$ver5['telefono'],
'Voceria'=>$ver5['cargo'],
'Tipo'=>$ver5['tipo']
);
}
$datos->close();

$pdf->tablaHorizontal($miCabecera,$misDatos);
$pdf->datosconsejos($cabeza,$Datos);
$pdf->fechaconsejos($cabezafecha,$datosfecha);
$pdf->documentosconsejos($cabezadocumentos,$datodocumentos);
$pdf->vocerosadministrativos($cabezavoceros,$administrativo);
$pdf->Ln(2);
$pdf->voceroscontralorias($cabezavoceros,$contraloria);
$pdf->Ln(2);
$pdf->vocerosejecutivas($cabezaejecutiva,$ejecutiva);
$pdf->Ln(2);

$sqlver7="select nombre_gestion from gestion_social where idgestion_social='$id' and tipo_gestion='consejo'";
$ver7=$base->extraer($sqlver7);
while($as = $ver7->fetch_array()){
$nombregestion=$as['nombre_gestion'];
}
$ver7->close();
$base->cerrar();
$pdf->Output("Datos Del Consejo Comunal '$nombregestion'.pdf","D");
}
}
?>
