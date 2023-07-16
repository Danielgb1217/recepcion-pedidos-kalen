<?php

require('../fpdf/fpdf.php');

class PDF extends FPDF
{
    
var $widths;
var $aligns;

function SetWidths($w)
{
    //Set the array of column widths
    $this->widths=$w;
}

function SetAligns($a)
{
    //Set the array of column alignments
    $this->aligns=$a;
}

function Row($data)
{
    //Calculate the height of the row
    $nb=0;
    for($i=0;$i<count($data);$i++)
        $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
    $h=5*$nb;
    //Issue a page break first if needed
    $this->CheckPageBreak($h);
    //Draw the cells of the row
    for($i=0;$i<count($data);$i++)
    {
        $w=$this->widths[$i];
        $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'C';
        //Save the current position
        $x=$this->GetX();
        $y=$this->GetY();
        //Draw the border
        $this->Rect($x,$y,$w,$h);
        //Print the text
        $this->MultiCell($w,5,$data[$i],0,$a);
        //Put the position to the right of the cell
        $this->SetXY($x+$w,$y);
    }
    //Go to the next line
    $this->Ln($h);
}

function CheckPageBreak($h)
{
    //If the height h would cause an overflow, add a new page immediately
    if($this->GetY()+$h>$this->PageBreakTrigger)
        $this->AddPage($this->CurOrientation);
}

function NbLines($w,$txt)
{
    //Computes the number of lines a MultiCell of width w will take
    $cw=&$this->CurrentFont['cw'];
    if($w==0)
        $w=$this->w-$this->rMargin-$this->x;
    $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
    $s=str_replace("\r",'',$txt);
    $nb=strlen($s);
    if($nb>0 and $s[$nb-1]=="\n")
        $nb--;
    $sep=-1;
    $i=0;
    $j=0;
    $l=0;
    $nl=1;
    while($i<$nb)
    {
        $c=$s[$i];
        if($c=="\n")
        {
            $i++;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
            continue;
        }
        if($c==' ')
            $sep=$i;
        $l+=$cw[$c];
        if($l>$wmax)
        {
            if($sep==-1)
            {
                if($i==$j)
                    $i++;
            }
            else
                $i=$sep+1;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
        }
        else
            $i++;
    }
    return $nl;
}

function Header()  //Encabeza que se repite en todas las paginas
{
    $this->SetFont('Times','B',32);
    $this->Image('../public/build/img/kalen.PNG',10,8,70);
    
    $this->setXY(80,10);     //Ubica la posicion donde va a ir el texto---->Titulo del Reporte
    
    $this->Cell(100,8,'Reporte de Ventas',0,0,'C',0);
    //         cell(ancho, largo, contenido, borde, salto de linea)
    
    $this->SetFont('Helvetica','B',18);
    $this->Ln(60);//espacio vertical del primer elemento Salto de lineas
    //Encabezado de la Tabla
    
    //color
    $this->SetFillColor(100, 149, 237);
    // $pdf->Rect(10, 79, 200, 200, 'F');// color de fondo
    
    $this->setY(70);  
    $this->Cell(25,8,'Nombre',1,0,'C',1);
    $this->Cell(25,8,'Apellido',1,0,'C',1);
    $this->Cell(22,8,'Cedula',1,0,'C',1);
    // $pdf->Cell(25,8,'Email',1,0,'C',0);
    $this->Cell(30,8,'Producto',1,0,'C',1);
    $this->Cell(25,8,'Costo',1,0,'C',1);
    $this->Cell(30,8,'Cantidad',1,0,'C',1);
    $this->Cell(30,8,'Fecha',1,1,'C',1);
    
    
    $this->SetTextColor(0,0,0);
    $this->SetDrawColor(0,0,0);       //color de linea
    $this->Ln(0.60);
    //echo($nombreUsuario->nombre);
    
    $this->SetFont('Helvetica','',11);
    $this->SetWidths(array(25,25,22,30,25,30,30));
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    // $this->SetY(-15);
    // // Arial italic 8
    // $this->SetFont('Arial','I',8);
    // // Número de página
    // $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}


}  

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetMargins(10,10,10);
$pdf->SetAutoPageBreak(true, 8);
//$pdf->SetFillColor(100, 149, 237);

if(!$reporte){
    $pdf->setXY(40,90);  
    $pdf->SetFont('Helvetica','',20);

    //echo($nombreUsuario->nombre);
    
   
    $pdf->Cell(100,8,'No hay Resultados del Mes Consultado',0,0,'C',0);

}else{


    foreach($reporte as $rep){
        
        $pdf->Row(array($rep["nombreUser"],$rep["apellido"],$rep["cedula"],utf8_decode( $rep["nombre"]),
        $rep["costo_unidad"],$rep["cantidad"],$rep["fecha_pedido"]));
        // $pdf->Cell(25,8,$rep["nombreUser"],1,0,'C',0);
        // $pdf->Cell(25,8,$rep["apellido"],1,0,'C',0);
        // $pdf->Cell(22,8,$rep["cedula"],1,0,'C',0);
        // $pdf->Cell(30,8,$rep["nombre"],1,0,'C',0);
        // $pdf->Cell(25,8,$rep["costo_unidad"],1,0,'C',0);
        // $pdf->Cell(30,8,$rep["cantidad"],1,0,'C',0);
        // $pdf->Cell(50,8,$rep["fecha_pedido"],1,0,'C',0);
        $pdf->Ln(0.1);
    // Datos
    } 
    
}
    
    // $pdf->AddPage();
    // $grafico = $_POST['variable'];

    // $img = explode(',', $grafico,2)[1];
    // $pic = 'data://text/plain;base64,' . $img;
    // $pdf->image($pic,15,70,250,0,'png');

$pdf->Output();