<?php
require('../fpdf.php');
$d=date('d_m_Y');

class PDF extends FPDF
{

function Header()
{
   // Logo
    $this->Image('images.png',12,10,40);
    // Arial bold 15
    $this->SetFont('Arial','B',16);
    // Move to the right
    $this->Cell(80);
    // Title
	$this->SetFillColor(0,255,0);
    $this->Cell(40,10,'Ashland Hotel Booking System',0,1,'C');
	
    // Line break
    $this->Ln(20);
	
}

//Page footer
function Footer()
{
 // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',11);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'',0,0,'C');
    $this->SetTextColor(128);
}

//Load data
function LoadData($file)
{
	//Read file lines
	$lines=file($file);
	$data=array();
	foreach($lines as $line)
		$data[]=explode(';',chop($line));
	return $data;
}

//Simple table
function BasicTable($header,$data)
{ 
$this->SetTextColor(0);
$this->SetFillColor(0,255,0);
$this->SetDrawColor(128,0,0);
$w=array(15,15,20,20,20,25,15,15,25,25,12);

	//Header
	for($i=0;$i<count($header);$i++)
		$this->Cell($w[$i],7,$header[$i],1,0,'C',true);
	$this->Ln();
	//Data
	foreach ($data as $eachResult) 
	{ //width
		$this->Cell(15,10,$eachResult["iduser_info"],1);
		$this->Cell(15,10,$eachResult["surname"],1);
		$this->Cell(20,10,$eachResult["othername"],1);
		$this->Cell(20,10,$eachResult["phoneno"],1);
	    $this->Cell(20,10,$eachResult["address"],1);
		$this->Cell(25,10,$eachResult["postalcode"],1);
		$this->Cell(15,10,$eachResult["idno"],1);
		$this->Cell(15,10,$eachResult["gender"],1);
		$this->Cell(25,10,$eachResult["occupation"],1);
		$this->Cell(25,10,$eachResult["email"],1);
		$this->Cell(12,10,$eachResult["rolename"],1);
		$this->Ln();
		 	 	 	 	
	}
}

//Better table
}

$pdf=new PDF();


$header=array('ID','NAME','OTHERNAME','PHONE NO','ADDRESS','POSTAL CODE','ID NO','GENDER','OCCUPATION','EMAIL','ROLE');
//Data loading
//*** Load MySQL Data ***//
$objConnect = mysql_connect("localhost","root","") or die("Error:Please check your database username & password");
$objDB = mysql_select_db("hoteldb");
$strSQL = "SELECT iduser_info,surname,othername,phoneno,address,postalcode,idno,gender,occupation,email,idrole,rolename FROM user_info INNER JOIN role ON user_info.role_idrole=role.idrole";
$objQuery = mysql_query($strSQL);
$resultData = array();
for ($i=0;$i<mysql_num_rows($objQuery);$i++) {
	$result = mysql_fetch_array($objQuery);
	array_push($resultData,$result);
}
//************************//


function forme()

{
$d=date('d_m_Y');
echo "PDF generated successfully. To download document click on the link >> <a href=".$d.".pdf>Print</a>";
}


$pdf->SetFont('Arial','',9);

//*** Table 1 ***//
$pdf->AddPage();
$pdf->Ln(35);
$pdf->BasicTable($header,$resultData);


forme();
$pdf->Output("$d.pdf","F");

?>