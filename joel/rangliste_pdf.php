<?php

 list ($selected_wod, $divison) = explode('X', $_POST['btn_pdf']);



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

$pdf->Cell(7,5,"".$timestamp."", FALSE); // Ausgabe als Zelle für eine Tabelle ohne Rahmen änderst Du FALSE in TRUE hast du einen Rahmen



 $pdf->Ln();
  $pdf->Ln();
  
$sql = "SELECT `comp_name` as Competition , div_name as Division FROM `tbl_competition` join tbl_division on comp_ID = fk_comp_ID where div_id = ".$divison;

 $pdf->Table( $sql);
 $pdf->Ln();
 


if ($selected_wod == 'overall123'){

    $head = "Overall Ranking";
    
    $pdf->Cell(7,5,"".$head."", FALSE); // Ausgabe als Zelle für eine Tabelle ohne Rahmen änderst Du FALSE in TRUE hast du einen Rahmen



 $pdf->Ln();
 
 
    $sql = "Select @rownum := @rownum + 1 as Rank, t1.Name, t1.Box, t1.Points From (SELECT u.user_name as Name, u.user_box as Box, SUM(r.res_score) as Points FROM\n"
    . "tbl_user u inner\n"
    . "join tbl_user_division d\n"
    . "on u.user_ID = d.fk_user_ID inner \n"
    . "join tbl_result r on d.user_div_ID = r.fk_user_div_ID \n"
    . "WHERE d.fk_div_ID = ".$divison." GROUP by Name\n"
    . "Order by Points) as t1\n"
    . "cross join (select @rownum := 0) r ";
    
 $pdf->Table( $sql);
        


    

} else{

    
$pdf->Table("SELECT wod_name AS WOD, wod_desc AS Description from tbl_wod where wod_ID =".$selected_wod);

$pdf->Ln();

$pdf->Table("Select @rownum := @rownum + 1 as Rank, t1.Name, t1.Box, t1.Points From ("
        . "SELECT u.user_name as Name, u.user_box as Box, r.res_score as Points "
        . "FROM tbl_user u inner join tbl_user_division d \n"
    . "on u.user_ID = d.fk_user_ID inner join tbl_result r on d.user_div_ID = r.fk_user_div_ID "
        . "where r.fk_wod_ID =".$selected_wod." ORDER BY Points ASC) as t1\n"
    . "cross join (select @rownum := 0) r ");


    
}


 $pdf->Output();


?>
