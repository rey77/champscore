<?php

// Session starten oder �bernehmen
session_start();

if (isset($_POST['email']) AND ( $_POST['email'] != '')) {
    $email = $_POST['email'];

    $chars = ("abcdefghijklmnopqrstuvwxyz1234567890");
    $newpwd = 'x';
    for ($i = 0; $i < 7; $i++) {
        @$newpwd .= $chars{mt_rand(0, strlen($chars))};
    }


    include '../Database.php';
    $pdo = Database::connect();

    $sql_athlete = "select athlete_firstname, athlete_lastname from tbl_athlete "
            . "where tbl_athlete.athlete_email = ?";

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $q_athlete = $pdo->prepare($sql_athlete);
    $q_athlete->execute(array($email));


    while ($zeile = $q_athlete->fetch(/* PDO::FETCH_ASSOC */)) {
        $athleteFirstname = $zeile["athlete_firstname"];
    }

    $passwort = $newpwd;
    $betreff = "New Password for Athlete Login";
    $inhalt = 
            "Hello " . $athleteFirstname
            . "\n\nThis is your new Password: $passwort\n
Best Wishes\nchampscore\nwww.champscore.ch";
    $header = "From: info@champscore.ch";
    mail($email, $betreff, $inhalt, $header);


    $pass = md5($newpwd);

    $sql_athlete = "UPDATE\n"
            . " tbl_athlete\n"
            . "SET\n"
            . " athlete_password =?\n"
            . "WHERE\n"
            . " athlete_email =?";

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $qu_athlete = $pdo->prepare($sql_athlete);
    $qu_athlete->execute(array($pass, $email));





    $_SESSION['message'] = 'You will get your new Password via Email';
    header("Location: ../athleteLogin.php");
    exit();

    /* echo "Das neue Passwort wurde eingetragen!<br/>";
      echo "Ihr Passwort lautet: " . $newpwd;
      echo "<br/> <a href=\"index.php\">Login</a><br/>";
      echo "<br/> <a href=\"login-anpassen-form.php\">Passwort anpassen</a><br/>";
     */
}
?>