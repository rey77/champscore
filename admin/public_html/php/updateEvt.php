<?php

session_start();

$evtID = $_POST['evtID'];
$evtName = $_POST['evtName'];
$compID = $_POST['compID'];

include 'Database.php';
$pdo = Database::connect();

$sql = "UPDATE tbl_event SET evt_name = ? WHERE evt_id = ?";

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$q = $pdo->prepare($sql);
$q->execute(array($evtName, $evtID));

Database::disconnect();
header("Location:wodCustomize.php?comp_id=$compID#tabWod");
?>
   
