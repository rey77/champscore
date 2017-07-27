<?php

session_start();

$compID = $_POST['compID'];
$divID = $_POST['divID'];
$teamName = $_POST['teamName'];

include 'Database.php';
$pdo = Database::connect();

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
    }*/

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


                $userEmail = $key2;

                $sql_user = "SELECT user_ID, user_email, user_firstname, user_lastname, user_name FROM `tbl_user` where user_email=?";
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $q_user = $pdo->prepare($sql_user);
                $q_user->execute(array($userEmail));

                while ($zeile = $q_user->fetch()) {

                    $userID = $zeile['user_ID'];
                    $userFirstName = $zeile['user_firstname'];
                    $userLastName = $zeile['user_lastname'];

                    $sql_tm = "INSERT INTO `tbl_team_member` ( `fk_user_ID`, `fk_team_ID`) VALUES (?,?)";
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $q_tm = $pdo->prepare($sql_tm);
                    $q_tm->execute(array($userID, $lastTeamID));
                }
            }
        }
    }
} else {

    /*$sql_indiv = "select comp_ID, comp_name, comp_start_date, comp_logo, comp_city, comp_country, comp_active, div_is_team from tbl_competition "
            . " join tbl_division on tbl_competition.comp_ID = tbl_division.fk_comp_ID"
            . " join tbl_user_division on tbl_division.div_ID = tbl_user_division.fk_div_ID"
            . " where tbl_user_division.fk_user_ID =?";

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $q_indiv = $pdo->prepare($sql_indiv);
    $q_indiv->execute(array($userID));

    while ($zeile = $q_indiv->fetch(/* PDO::FETCH_ASSOC )) {

        header("Location:registrationView_1.php?comp_id=$compID&user_id=$userID");
        exit();
    }*/

    foreach ($_POST as $key => $value) {

        if (is_array($value) || is_object($value)) {
            foreach ($value as $value1 => $key2) {

                $userEmail = $key2;

                $sql = "SELECT user_ID, user_email FROM `tbl_user` where user_email=?";
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $q = $pdo->prepare($sql);
                $q->execute(array($userEmail));


                while ($zeile = $q->fetch(/* PDO::FETCH_ASSOC */)) {

                    $userID = $zeile['user_ID'];
                    $userFirstName = $zeile['user_firstname'];
                    $userLastName = $zeile['user_lastname'];

                    $sql = "INSERT INTO `tbl_user_division` ( `fk_user_ID`, `fk_div_ID`) VALUES (?,?)";
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $q = $pdo->prepare($sql);
                    $q->execute(array($userID, $divID));
                }
            }
        }
    }
}

Database::disconnect();
header("Location:registrationViewConfirm.php?comp_id=$compID");
exit();
?>

