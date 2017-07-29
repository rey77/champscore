<?php

session_start();

include 'Database.php';
$pdo = Database::connect();

$hostID = $_SESSION['host_id']; //aus Session Variable nehmen
$eventName = $_POST['evtName'];
$divID = $_POST['divID'];
$compID = $_POST['compID'];

$sql = "INSERT INTO `tbl_event` ( `evt_name`, `fk_div_id`) VALUES (?, ?)";
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$q = $pdo->prepare($sql);
$q->execute(array($eventName, $divID));


Database::disconnect();
header("Location:wodCustomize.php?comp_id=$compID");
?>
   
