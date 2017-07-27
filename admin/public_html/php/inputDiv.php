<?php

session_start();

include 'Database.php';
$pdo = Database::connect();

// INSERT COMPETITION IN DB

$userID = $_SESSION['user_id']; //aus Session Variable nehmen
$divisionName = $_POST['divName'];
$teamSize = $_POST['teamSize'];
$compID = $_POST['compID'];

if (isset($_POST['divIsTeam'])) {

    $sql = "INSERT INTO `tbl_division` ( `div_name`,  `fk_comp_id`, `div_is_team`, `div_team_size`) VALUES (?, ?, ?, ?)";

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $q = $pdo->prepare($sql);
    $q->execute(array($divisionName, $compID, TRUE, $teamSize));
} else {

    $sql = "INSERT INTO `tbl_division` ( `div_name`, `fk_comp_id`) VALUES (?, ?)";

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $q = $pdo->prepare($sql);
    $q->execute(array($divisionName, $compID));
}

Database::disconnect();
header("Location:wodCustomize.php?comp_id=$compID");
?>
   
