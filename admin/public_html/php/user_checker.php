<?php

session_start();
if (isset($_POST["user_email"])) {

    if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
        die();
    }

    $userEmail = filter_var($_POST["user_email"], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);

    include 'Database.php';
    $pdo = Database::connect();

    $sql = "SELECT user_email FROM tbl_user WHERE user_email=?";

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $q = $pdo->prepare($sql);
    $q->execute(array($userEmail));

    $userExists = false;
    while ($zeile = $q->fetch(/* PDO::FETCH_ASSOC */)) {
        $userExists = true;
    }

    Database::disconnect();


    die($userExists);
}
?>
   
