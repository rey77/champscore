<?php

session_start();

include 'Database.php';
$pdo = Database::connect();

$wodID = $_POST['wodID'];
$wodName = $_POST['wodName'];
$wodType = $_POST['wodType'];
$wodDesc = $_POST['wodDescription'];
$wodDesc = $_POST['wodDescription'];
$wodDuration = ($_POST['wodDurationMin'] * 60) + $_POST['wodDurationSec'];
$wodMaxReps = $_POST['wodMaxReps'];
$compID = $_POST['compID'];

if (isset($_POST['wodIsPublished'])) {

    $sql = "UPDATE tbl_wod SET wod_name = ?, wod_type =?, wod_desc = ?,"
            . "wod_duration = ?, wod_max_reps = ?, wod_is_published =?  WHERE wod_id =?";

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $q = $pdo->prepare($sql);
    $q->execute(array($wodName, $wodType, $wodDesc, $wodDuration, $wodMaxReps, TRUE, $wodID));
} else {

    $sql = "UPDATE tbl_wod SET wod_name = ?, wod_type =?, wod_desc = ?,"
            . "wod_duration = ?, wod_max_reps = ?, wod_is_published =?  WHERE wod_id =?";

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $q = $pdo->prepare($sql);
    $q->execute(array($wodName, $wodType, $wodDesc, $wodDuration, $wodMaxReps, FALSE, $wodID));
}



Database::disconnect();
header("Location:wodCustomize.php?comp_id=$compID");
?>
   
