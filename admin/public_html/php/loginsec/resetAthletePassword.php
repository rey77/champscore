<?php

// Session starten oder �bernehmen
session_start();


error_reporting(E_STRICT | E_ALL);
date_default_timezone_set('Etc/UTC');
require '../../PHPMailer-master/PHPMailerAutoload.php';
$mail = new PHPMailer;


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
        $athleteLastname = $zeile["athlete_lastname"];
    }

    $passwort = $newpwd;

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'mail.cyon.ch';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'info@champscore.ch';                 // SMTP username
    $mail->Password = 'c3162_pax_';                           // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to

    $mail->setFrom('info@champscore.ch', 'champscore');
    $mail->addAddress($email, $athleteFirstname + " " + $athleteLastname);     // Add a recipient
    $mail->addReplyTo('info@champscore.ch', 'Information');


    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->AddEmbeddedImage('../img/text_dark.png', 'cs');
    $mail->Subject = 'New Password for Athlete Account';
    $mail->Body = 'Hello ' . $athleteFirstname . '<br><br> This is your new Password for your Athlete Login: <br><b>' . $passwort . '</b><br><br><br>Best Wishes<br><br><a href = "http://www.champscore.ch/"><img src="cid:cs" alt="www.champscore.ch" height="30" style="padding-left: 20px; padding-right: 20px; width: 100%" /></a><br>';

    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if (!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message has been sent';
    }

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

