<?php

require_once('fpdf.php');
include('dbconnect.php');


class PeoplePDF extends FPDF {

//Page header
function Header(){

	//$logo="images/logo.png";
	$title = "receipt";
 
	 
	  $date=date("Y-m-d H:i:s");
		 $y=date("Y");
		 $m=date("m");
		 $d=date("d");
		 $hr=date("H");
		 $min=date("i");
		$sec=date("s");
		$hcodes=$y.$m.$d.$hr;
			$mins=$min.$sec;
	
			$hcode=$hcodes.$mins;
		//$hcode=$_GET['hbar'];
 	//	 $barcode="images/barcode.PNG";
		 
	$this->SetFont('arial', '', 10);
	//$this->Image($logo,30,0,20,20);
	$this->Text(100,10,$title);
	$this->SetFont('arial', '', 7);
	//$this->Text(161, 25, $hcode);
	$this->SetFont('arial', '', 9);
	
    
    $this->Ln(20);
}
//Page footer
	function Footer(){
		//Position at 1.5 cm from bottom
		$this->SetY(-15);
		//Arial italic 8
		$this->SetFont('Arial','I',8);
		//Page number
		 $this->Cell(0,10,'Page '.$this->PageNo().' of {nb}',0,0,'C');
	}
	
	

}
$pdf = new FPDF();
$pdf = new PeoplePDF();
$pdf->AliasNbPages();//for page numbers
//$pdf->open();
$pdf->addPage();
$pdf->SetAutoPageBreak(false);
$pdf->SetFillColor(0, 0, 0); //black
$pdf->SetDrawColor(0, 0, 0); //black
 

//table header
$pdf->SetFillColor(128,128,128); //gray
$pdf->setFont("times","","9");
$pdf->setXY(0,20);
$pdf->Cell(10, 5, "#", 1, 0, "L", 1);
$pdf->Cell(20, 5, "index", 1, 0, "C", 1);
$pdf->Cell(20, 5, "itemindex", 1, 0, "C", 1);
$pdf->Cell(20, 5, "mpesacode", 1, 0, "C", 1);
$pdf->Cell(20, 5, "confirmed", 1, 0, "C", 1);
$pdf->Cell(20, 5, "phonenumber", 1, 0, "C", 1);
$pdf->Cell(20, 5, "amountpaid", 1, 0, "C", 1);




$pdf->Ln();
//gegevens van database
$y = $pdf->GetY();
$x = 40;
$pdf->setXY($x, $y);
 
session_start();
$num1=$_SESSION['phonenumber'];
//$item=$_SESSION['index'];

$sql = "SELECT * FROM payment";
//$sql1 = "SELECT * FROM founditems where index1='$item'";

//$result1 = mysql_query($sql1) or die(mysql_error());
//$row1=mysql_fetch_array($result1);


$result = mysql_query($sql);
$num=0;
while($row = mysql_fetch_array($result)){
$num++;

	$pdf->setFont("times","","8");
	$pdf->Cell(10, 5, $num, 1);
   
	//$pdf->Cell(40, 5, str_replace("&","'", $row['surname'])." ".str_replace("&","'",$row['othername']), 1);//string replace &

	$pdf->Cell(20, 5, $row['index'],1); 
	$pdf->Cell(20, 5, $row['itemindex'], 1);                 
	$pdf->Cell(20, 5, $row['mpesacode'], 1);
	$pdf->Cell(20, 5, $row['confirmed'], 1);
	$pdf->Cell(20, 5, $row['phonenumber'], 1);
	$pdf->Cell(30, 5, $row['amountpaid'], 1, 0, "R", 0);
	
	
	$y += 5;
	
	if ($y > 275)
	{
		$pdf->AddPage();
		$pdf->SetFillColor(128,128,128); //gray
		$pdf->setFont("times","","9");
		$pdf->setXY(0, 20);
		$pdf->Cell(0, 5, "index", 1, 0, "L", 1);
		$pdf->Cell(30, 5, "itemindex", 1, 0, "C", 1);
		$pdf->Cell(0, 5, "mpesacode", 1, 0, "C", 1);
		$pdf->Cell(30, 5, "confirmed", 1, 0, "C", 1);
		$pdf->Cell(30, 5, "phonenumber", 1, 0, "C", 1);
		$pdf->Cell(30, 5, "amountpaid", 1, 0, "C", 1);
        $pdf->Cell(30, 5, "itemname", 1, 0, "C", 1);
	
		
		$pdf->Ln();
		$y = 45;
	}
	
	$pdf->setXY($x, $y);
}
 
$pdf->Output();