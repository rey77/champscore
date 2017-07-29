<?php

session_start();
if (isset($_POST["athlete_email"])) {

    if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
        die();
    }

    $athleteEmail = filter_var($_POST["athlete_email"], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);

    include 'Database.php';
    $pdo = Database::connect();

    $sql = "SELECT athlete_email FROM tbl_athlete WHERE athlete_email=?";

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $q = $pdo->prepare($sql);
    $q->execute(array($athleteEmail));

    $athleteExists = false;
    while ($zeile = $q->fetch(/* PDO::FETCH_ASSOC */)) {
        $athleteExists = true;
    }

    Database::disconnect();


    die($athleteExists);
}
?>
   
