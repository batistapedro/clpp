<?php
session_start();
if(isset($_SESSION['tipo'])&& !empty($_SESSION['tipo'])){
$parroquia=$_GET['parroquia'];
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
$this->Cell(0,5,'Registros De Los Movimientos Sociales',0,1,'C');
$this->Ln(3);
$this->SetFont('Arial','I',12);
$this->SetTextColor(0,0,0);
$this->Cell(0,1,'Fecha : '.$Fecha,0,0,'R');
$this->Ln(12);
}

function cabeceraHorizontal($cabecera)
    {
        $this->SetXY(10, 60);
        $this->SetFont('Arial','B',11);
        $this->SetFillColor(219,32,32);//Fondo rojo de celda
        $this->SetTextColor(240, 255, 240); //Letra color blanco

            $this->CellFitSpace(100,7, utf8_decode($cabecera[0]),1, 0 , 'C', true);
 	    $this->CellFitSpace(32,7,utf8_decode($cabecera[1]),1,0,'C',true);
 	     $this->CellFitSpace(40,7,utf8_decode($cabecera[2]),1,0,'C',true);
	    $this->CellFitSpace(90,7,utf8_decode($cabecera[3]),1,1,'C',true);

    }

    function datosHorizontal($datos)
    {
        $this->SetXY(10,67);
        $this->SetFont('Arial','I',10);
        $this->SetFillColor(245, 245, 245); //Gris tenue de cada fila
        $this->SetTextColor(0, 0, 0); //Color del texto: Negro
        $bandera = false; //Para alternar el relleno
        foreach($datos as $fila)
        {
            //Usaremos CellFitSpace en lugar de Cell
            $this->CellFitSpace(100,8, utf8_decode($fila['Nombre']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(32,8,utf8_decode($fila['Tipo']),1,0,'C',$bandera);
            $this->CellFitSpace(40,8, utf8_decode($fila['Sector']),1, 0 , 'C', $bandera );
            $this->CellFitSpace(90,8, utf8_decode($fila['Sede']),1, 0 , 'C', $bandera );
            $this->Ln();//Salto de lÃ­nea para generar otra fila
            $bandera = !$bandera;//Alterna el valor de la bandera
        }
    }

    function tablaHorizontal($cabeceraHorizontal, $datosHorizontal)
    {
        $this->cabeceraHorizontal($cabeceraHorizontal);
        $this->datosHorizontal($datosHorizontal);
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



};

$pdf= new PDF('L','mm','letter');

$pdf->SetFont('Arial','B',16);

$pdf->SetTextColor(219,32,32);
$pdf->AddPage();
$pdf->SetLineWidth(0,8);
$base= new Conexion();
$base->conectar();
$sqlver="select nombre_gestion,sede,sector,tipo from gestion_social where parroquia='$parroquia' and tipo_gestion='movimiento'";
$ver = $base->extraer($sqlver);
$parroquia2=strtoupper($parroquia);
$pdf->SetTextColor(200,12,12);
$pdf->SetFont('Arial','I',14);
$pdf->Cell(0,6,"PARROQUIA : $parroquia2",0,1,'C');
$pdf->Ln();
$pdf->SetDrawColor(230,230,230);
$miCabecera =array('Nombre','Tipo','Sector','Sede');
$misDatos= array();
while($fila= $ver->fetch_array()){
$misDatos[]=array('Nombre'=>$fila['nombre_gestion'],
'Tipo'=>$fila['tipo'],
'Sector'=>$fila['sector'],
'Sede'=>$fila['sede']
);
}
$ver->close();
$pdf->tablaHorizontal($miCabecera,$misDatos);
$sqlver2="select count(*) from gestion_social where parroquia='$parroquia' and tipo_gestion='movimiento'";
$datos=$base->extraer($sqlver2);
$pdf->SetFont('Arial','I',13);
while($ver2= $datos->fetch_row()){

$pdf->Cell(0,8,'Cantidad : '.$ver2[0],0,1);
}
$datos->close();
$base->cerrar();
$pdf->Output("Registros De Los Movimientos Sociales Por La Parroquia ".$parroquia.".pdf","D");
}
?>
