<?php

session_start();

include 'Database.php';
$pdo = Database::connect();

$hostID = $_SESSION['host_id']; //aus Session Variable nehmen
$wodName = $_POST['wodName'];
$wodType = $_POST['wodType'];
$wodDesc = $_POST['wodDescription'];
$wodDuration = ($_POST['wodDurationMin'] * 60) + $_POST['wodDurationSec'];
$wodMaxReps = $_POST['wodMaxReps'];
$divID = $_POST['divID'];
$compID = $_POST['compID'];


if (isset($_POST['wodIsPublished'])) {

    $sql = "INSERT INTO `tbl_wod` ( `wod_name`, `wod_type`, `wod_desc`, `wod_duration`, `wod_max_reps`, `wod_is_published`, `fk_div_id`) VALUES (?, ?, ?, ?,?,?,?)";

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $q = $pdo->prepare($sql);
    $q->execute(array($wodName, $wodType, $wodDesc, $wodDuration, $wodMaxReps, TRUE, $divID));
} else {

    $sql = "INSERT INTO `tbl_wod` ( `wod_name`, `wod_type`, `wod_desc`, `wod_duration`, `wod_max_reps`, `wod_is_published`, `fk_div_id`) VALUES (?, ?, ?, ?,?,?,?)";

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $q = $pdo->prepare($sql);
    $q->execute(array($wodName, $wodType, $wodDesc, $wodDuration, $wodMaxReps, FALSE, $divID));
}



Database::disconnect();
header("Location:wodCustomize.php?comp_id=$compID");
?>
   
