<?php

session_start();

include 'Database.php';
$pdo = Database::connect();
var_dump($_POST);


// INSERT COMPETITION IN DB
$divName = $_POST['divName'];
$divID = $_POST['divID'];
$teamSize = $_POST['teamSize'];
$compID = $_POST['compID'];
$divIsTeam = $_POST['divIsTeam'];




if (isset($_POST['divIsTeam'])) {

   $sql = "UPDATE tbl_division SET div_name = ?, div_is_team = ?, div_team_size = ? WHERE div_id =?";

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$q = $pdo->prepare($sql);
$q->execute(array($divName, TRUE, $teamSize, $divID));

} else {

    $sql = "UPDATE tbl_division SET div_name = ?, div_is_team = ?, div_team_size = ? WHERE div_id =?";

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$q = $pdo->prepare($sql);
$q->execute(array($divName, FALSE, 0, $divID));
}

Database::disconnect();
header("Location:wodCustomize.php?comp_id=$compID#tabWod");
?>
   
