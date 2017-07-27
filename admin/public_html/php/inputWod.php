<?php

session_start();

include 'Database.php';
$pdo = Database::connect();

$userID = $_SESSION['user_id']; //aus Session Variable nehmen
$wodName = $_POST['wodName'];
$wodType = $_POST['wodType'];
$wodDesc = $_POST['wodDescription'];
$wodDuration = ($_POST['wodDurationMin'] * 60) + $_POST['wodDurationSec'];
$wodMaxReps = $_POST['wodMaxReps'];
$evtID = $_POST['evtID'];
$compID = $_POST['compID'];


if (isset($_POST['wodIsPublished'])) {

    $sql = "INSERT INTO `tbl_wod` ( `wod_name`, `wod_type`, `wod_desc`, `wod_duration`, `wod_max_reps`, `wod_is_published`, `fk_evt_id`) VALUES (?, ?, ?, ?,?,?,?)";

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $q = $pdo->prepare($sql);
    $q->execute(array($wodName, $wodType, $wodDesc, $wodDuration, $wodMaxReps, TRUE, $evtID));
} else {

    $sql = "INSERT INTO `tbl_wod` ( `wod_name`, `wod_type`, `wod_desc`, `wod_duration`, `wod_max_reps`, `wod_is_published`, `fk_evt_id`) VALUES (?, ?, ?, ?,?,?,?)";

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $q = $pdo->prepare($sql);
    $q->execute(array($wodName, $wodType, $wodDesc, $wodDuration, $wodMaxReps, FALSE, $evtID));
}



Database::disconnect();
header("Location:wodCustomize.php?comp_id=$compID");
?>
   
