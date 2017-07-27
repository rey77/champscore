<?php

session_start();

$athleteID = $_POST['athleteID'];
$athleteName = $_POST['athleteName'];
$athleteBox = $_POST['athleteBox'];
$compID = $_POST['compID'];

include 'Database.php';
$pdo = Database::connect();

$sql = "UPDATE tbl_athlete SET athlete_name = ?, athlete_box =? WHERE athlete_id = ?";

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$q = $pdo->prepare($sql);
$q->execute(array($athleteName, $athleteBox, $athleteID));

Database::disconnect();
header("Location:wodCustomize.php?comp_id=$compID");
?>
   
