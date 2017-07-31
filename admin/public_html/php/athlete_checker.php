<?php

session_start();
if (isset($_POST["athlete_email"])) {

    if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
        die();
    }

    $athleteEmail = filter_var($_POST["athlete_email"], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);

    include 'Database.php';
    $pdo = Database::connect();

    $sql = "SELECT athlete_email, athlete_firstname,athlete_lastname FROM tbl_athlete WHERE athlete_email=?";

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $q = $pdo->prepare($sql);
    $q->execute(array($athleteEmail));

    $arr = array();
    $arr[0] = 0;
    $arr[1] = "";
    $arr[2] = "";

    while ($zeile = $q->fetch(/* PDO::FETCH_ASSOC */)) {
        $arr[0] = 1;
        $arr[1] = $zeile['athlete_firstname'];
        $arr[2] = $zeile['athlete_lastname'];
    }

    echo json_encode($arr);

    Database::disconnect();

    
}
?>
   
