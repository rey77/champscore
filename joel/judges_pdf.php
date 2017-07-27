<?php

 list ($selected_wod, $divison) = explode('X', $_POST['judges_pdf']);



require('mysql_table.php');

class PDF extends PDF_MySQL_Table
{
function Header()
{
	//Title
	$this->SetFont('Arial','',18);
	$this->Cell(0,6,'ChampScore.Net',0,1,'C');
	$this->Ln(10);
	//Ensure table header is output
	parent::Header();
}
}

//Connect to database
mysql_connect('localhost','root','');
mysql_select_db('champscore_net');

$pdf=new PDF();
$pdf->AddPage();

$timestamp = date("d.m.Y",time());

$pdf->Cell(7,5,"".$timestamp." Judge Sheet - Athlete: "."", FALSE); // Ausgabe als Zelle für eine Tabelle ohne Rahmen änderst Du FALSE in TRUE hast du einen Rahmen



 $pdf->Ln();
  $pdf->Ln();
  
$sql = "SELECT `comp_name` as Competition , div_name as Division FROM `tbl_competition` join tbl_division on comp_ID = fk_comp_ID where div_id = ".$divison;

 $pdf->Table( $sql);
 $pdf->Ln();
 


$pdf->Table("SELECT wod_name AS WOD, wod_desc AS Description from tbl_wod where wod_ID =".$selected_wod);



 $pdf->Output();


?>
