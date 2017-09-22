<?php

session_start();

error_reporting(E_STRICT | E_ALL);
date_default_timezone_set('Etc/UTC');
require '../PHPMailer-master/PHPMailerAutoload.php';
$mail = new PHPMailer;

$compID = $_POST['compID'];
$divID = $_POST['divID'];
$teamName = $_POST['teamName'];

include 'Database.php';
$pdo = Database::connect();


$sql_comp = "select comp_ID, comp_name, comp_start_date, comp_end_date, comp_start_time, comp_end_time,comp_banner, comp_terms, comp_desc_long,comp_start_time, comp_location_name, comp_facebook_link, comp_desc_short, comp_regcode, comp_active, comp_street, comp_zip, comp_city, comp_country, comp_logo, comp_main_color, comp_accent_color, fk_host_ID from tbl_competition where comp_id = ?";
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$q_comp = $pdo->prepare($sql_comp);
$q_comp->execute(array($compID));


while ($zeile = $q_comp->fetch(/* PDO::FETCH_ASSOC */)) {
    $hostID = $zeile['fk_host_ID'];
    $compName = $zeile['comp_name'];
    $compStartDate = $zeile['comp_start_date'];
}

$sql_host = "select * from tbl_host "
        . "where tbl_host.host_ID = ?";

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$q_host = $pdo->prepare($sql_host);
$q_host->execute(array($hostID));


while ($zeile = $q_host->fetch(/* PDO::FETCH_ASSOC */)) {
    $hostFirstname = $zeile["host_firstname"];
    $hostLastname = $zeile["host_lastname"];
    $hostEmail = $zeile["host_email"];
}

if (($_POST['isTeam'])) {

//auf alle nutzer prüfen, UserID is
    /*  $sql_sel_team = "select comp_ID, comp_name, comp_start_date, comp_logo, comp_city, comp_country, comp_active, div_is_team from tbl_competition "
      . " join tbl_division on tbl_competition.comp_ID = tbl_division.fk_comp_ID"
      . " join tbl_team_division on tbl_division.div_ID = tbl_team_division.fk_div_ID"
      . " join tbl_team on tbl_team_division.fk_team_ID = tbl_team.team_ID"
      . " join tbl_team_member on tbl_team.team_ID = tbl_team_member.fk_team_ID"
      . " where tbl_team_member.fk_user_ID =?";

      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $q_sel_team = $pdo->prepare($sql_sel_team);
      $q_sel_team->execute(array($userID));

      while ($zeile = $q_sel_team->fetch(/* PDO::FETCH_ASSOC )) {
      header("Location:registrationView_1.php?comp_id=$compID&user_id=$userID");
      exit();
      } */

    $sql_team = "INSERT INTO `tbl_team` ( `team_name`) VALUES (?)";
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $q_team = $pdo->prepare($sql_team);
    $q_team->execute(array($teamName));

    $lastTeamID = $pdo->lastInsertId();

    $sql_td = "INSERT INTO `tbl_team_division` ( `fk_team_ID`, `fk_div_ID`) VALUES (?,?)";
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $q_td = $pdo->prepare($sql_td);
    $q_td->execute(array($lastTeamID, $divID));


    foreach ($_POST as $key => $value) {

        if (is_array($value) || is_object($value)) {
            foreach ($value as $value1 => $key2) {


                $athleteEmail = $key2;

                $sql_athlete = "SELECT athlete_ID, athlete_email, athlete_firstname, athlete_lastname FROM `tbl_athlete` where athlete_email=?";
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $q_athlete = $pdo->prepare($sql_athlete);
                $q_athlete->execute(array($athleteEmail));



                while ($zeile = $q_athlete->fetch()) {


                    //Send confirmation Mail
                    $athleteEmail = $zeile['athlete_email'];
                    $athleteFirstname = $zeile['athlete_firstname'];
                    $athleteLastname = $zeile['athlete_lastname'];


                    $mail->isSMTP();                                      // Set mailer to use SMTP
                    $mail->Host = 'mail.cyon.ch';  // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true;                               // Enable SMTP authentication
                    $mail->Username = 'info@champscore.ch';                 // SMTP username
                    $mail->Password = 'c3162_pax_';                           // SMTP password
                    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
                    $mail->Port = 465;                                    // TCP port to connect to

                    $mail->setFrom('info@champscore.ch', 'champscore');
                    $mail->addAddress($athleteEmail, $athleteFirstname + " " + $athleteLastname);     // Add a recipient
                    $mail->addReplyTo('info@champscore.ch', 'Information');


                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->AddEmbeddedImage('img/text_dark.png', 'cs');
                    $mail->Subject = 'You are registered for ' . $compName;
                    $mail->Body = 'Hello ' . $athleteFirstname . '<br><br>You are now registered for the Competition <b>' . $compName . '</b>, which is held on ' . $compStartDate . '<br><br>You can sit back now until you get further instructions from the Competition Organization<br><br>Best Wishes,<br><br><a href = "http://www.champscore.ch/"><img src="cid:cs" alt="www.champscore.ch" height="30" /></a><br>';

                    $mail->AltBody = "Hello " . $athleteFirstname
                            . "\n\nYou are now registered for the Competition " . $compName . ", which is held on " . $compStartDate . "
               \nYou can sit back now until you get further instructions from the Competition Organization
               \n\nBest Wishes,\n\nchampscore\nwww.champscore.ch";

                    if (!$mail->send()) {
                        echo 'Message could not be sent.';
                        echo 'Mailer Error: ' . $mail->ErrorInfo;
                    } else {
                        echo 'Message has been sent';
                    }

                    $athleteID = $zeile['athlete_ID'];
                    $athleteFirstName = $zeile['athlete_firstname'];
                    $athleteLastName = $zeile['athlete_lastname'];

                    $sql_tm = "INSERT INTO `tbl_team_member` ( `fk_athlete_ID`, `fk_team_ID`) VALUES (?,?)";
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $q_tm = $pdo->prepare($sql_tm);
                    $q_tm->execute(array($athleteID, $lastTeamID));
                }
            }
        }
    }




    //Send confirmation Mail to Host
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'mail.cyon.ch';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'info@champscore.ch';                 // SMTP username
    $mail->Password = 'c3162_pax_';                           // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to

    $mail->setFrom('info@champscore.ch', 'champscore');
    $mail->addAddress($hostEmail, $hostFirstname + " " + $hostLastname);     // Add a recipient
    $mail->addReplyTo('info@champscore.ch', 'Information');


    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->AddEmbeddedImage('img/text_dark.png', 'cs');
    $mail->Subject = 'New Team Registration for ' . $compName . '!';
    $mail->Body = 'Hello ' . $hostFirstname . '<br><br>A Team just registered for the Competition <b>' . $compName . '!</b><br><br><b>Team Name:</b><br>' . $teamName . '<br><br>You can see further details in your Host Account. Click <a href = "http://www.champscore.ch/php/hostLogin.php">here</a> to Log in <br><br>Best Wishes,<br><br><a href = "http://www.champscore.ch/"><img src="cid:cs" alt="www.champscore.ch" height="30" /></a><br>';

    $mail->AltBody = "Hello " . $hostFirstname
            . "\n\nA new Team Registration for the Competition $compName just went in!
      \nTeam Name: $teamName
      \nYou can see and further details in your Host Account. \n
      Best Wishes,\n\nchampscore\nwww.champscore.ch";

    if (!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message has been sent';
    }
} else {

    /* $sql_indiv = "select comp_ID, comp_name, comp_start_date, comp_logo, comp_city, comp_country, comp_active, div_is_team from tbl_competition "
      . " join tbl_division on tbl_competition.comp_ID = tbl_division.fk_comp_ID"
      . " join tbl_user_division on tbl_division.div_ID = tbl_user_division.fk_div_ID"
      . " where tbl_user_division.fk_user_ID =?";

      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $q_indiv = $pdo->prepare($sql_indiv);
      $q_indiv->execute(array($userID));

      while ($zeile = $q_indiv->fetch(/* PDO::FETCH_ASSOC )) {

      header("Location:registrationView_1.php?comp_id=$compID&user_id=$userID");
      exit();
      } */

    foreach ($_POST as $key => $value) {

        if (is_array($value) || is_object($value)) {
            foreach ($value as $value1 => $key2) {

                $athleteEmail = $key2;

                $sql = "SELECT athlete_ID, athlete_email, athlete_firstname FROM `tbl_athlete` where athlete_email=?";
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $q = $pdo->prepare($sql);
                $q->execute(array($athleteEmail));


                while ($zeile = $q->fetch(/* PDO::FETCH_ASSOC */)) {

                    $athleteID = $zeile['athlete_ID'];
                    $athleteFirstName = $zeile['athlete_firstname'];
                    $athleteLastName = $zeile['athlete_lastname'];

                    $sql = "INSERT INTO `tbl_athlete_division` ( `fk_athlete_ID`, `fk_div_ID`) VALUES (?,?)";
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $q = $pdo->prepare($sql);
                    $q->execute(array($athleteID, $divID));


                    //Send Mail to Host
//Send confirmation Mail
                    $athleteEmail = $zeile['athlete_email'];

                    $betreff = "Competition Registration";
                    $inhalt = "Hello  $athleteFirstName
                             \n\nYou are now registered for the Competition $compName, which is held on $compStartDate.
                             \n\nYou can sit back now until you get further instructions from the Competition Organization. \n
Best Wishes\nchampscore\nwww.champscore.ch";
                    $header = "From: info@champscore.ch";
                    mail($athleteEmail, $betreff, $inhalt, $header);
                }
            }
        }
    }
}




Database::disconnect();
header("Location:registrationViewConfirm.php?comp_id=$compID");
exit();
?>

