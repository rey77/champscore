<?php

session_start();

include 'Database.php';
$pdo = Database::connect();

$teamID = $_POST['teamID'];
$divID = $_POST['divID'];
$teamMember = $_POST['teamMemberName'];
$compID = $_POST['compID'];


$sql = "INSERT INTO `tbl_team_member` ( `team_member_name`, `fk_team_ID`) VALUES (?,?)";
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$q = $pdo->prepare($sql);
$q->execute(array($teamMember, $teamID));





Database::disconnect();
header("Location:teamEdit.php?comp_id=$compID&divID=$divID&teamID=$teamID");
?>
   
