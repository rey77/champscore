<?php

session_start();

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

                    $betreff = "Competition Registration";
                    $inhalt = "Hello  $athleteFirstname
                             \n\nYou are now registered for the Competition $compName, which is held on $compStartDate.
                             \nYou can sit back now until you get further instructions from the Competition Organization. \n
Best Wishes\nchampscore\nwww.champscore.ch";
                    $header = "From: info@champscore.ch";
                    mail($athleteEmail, $betreff, $inhalt, $header);

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


    $betreff = "New Team registered!";
    $inhalt = "Hello " . $hostFirstname
            . "\n\nA new Team registration for the Competition $compName just went in!
               \nTeam Name: $teamName
               \nYou can see the Team Members and further details in your Host Account. \n
Best Wishes\nchampscore\nwww.champscore.ch";
    $header = "From: info@champscore.ch";
    mail($hostEmail, $betreff, $inhalt, $header);
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

