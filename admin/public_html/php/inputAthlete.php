<?php

session_start();

include 'Database.php';
$pdo = Database::connect();

$athleteName = $_POST['athleteName'];
$athleteBox = $_POST['athleteBox'];
$divID = $_POST['divID'];
$compID = $_POST['compID'];
$teamMember = $_POST['teamMember'];

$sql = "INSERT INTO `tbl_athlete` ( `athlete_name`, `athlete_box`) VALUES (?,?)";
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$q = $pdo->prepare($sql);
$q->execute(array($athleteName, $athleteBox));

$lastAthleteID = $pdo->lastInsertId();

$sql = "INSERT INTO `tbl_athlete_division` ( `fk_athlete_ID`, `fk_div_ID`) VALUES (?,?)";
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$q = $pdo->prepare($sql);
$q->execute(array($lastAthleteID, $divID));

Database::disconnect();
header("Location:athletesCustomize.php?comp_id=$compID");
?>
   
