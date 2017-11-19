<?php

session_start();

include 'Database.php';
$pdo = Database::connect();

// INSERT COMPETITION IN DB

$hostID = $_SESSION['host_id']; //aus Session Variable nehmen
$divisionName = $_POST['divName'];
$divRegFee = $_POST['divRegFee'];
$teamSize = $_POST['teamSize'];
$compID = $_POST['compID'];

if (isset($_POST['divIsTeam'])) {

    $sql = "INSERT INTO `tbl_division` ( `div_name`, `div_reg_fee`, `fk_comp_id`, `div_is_team`, `div_team_size`) VALUES (?, ?, ?, ?)";

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $q = $pdo->prepare($sql);
    $q->execute(array($divisionName, $divRegFee, $compID, TRUE, $teamSize));
} else {

    $sql = "INSERT INTO `tbl_division` ( `div_name`, `div_reg_fee`, `fk_comp_id`) VALUES (?, ?)";

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $q = $pdo->prepare($sql);
    $q->execute(array($divisionName, $divRegFee, $compID));
}

Database::disconnect();
header("Location:wodCustomize.php?comp_id=$compID");
?>
   
