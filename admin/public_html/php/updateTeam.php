<?php

session_start();

$teamID = $_POST['teamID'];
$teamName = $_POST['teamName'];
$teamBox = $_POST['teamBox'];
$compID = $_POST['compID'];

include 'Database.php';
$pdo = Database::connect();

$sql = "UPDATE tbl_team SET team_name = ?, team_box =? WHERE team_id = ?";

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$q = $pdo->prepare($sql);
$q->execute(array($teamName, $teamBox, $teamID));

$sql_tm = "select team_member_ID, team_member_name from tbl_team_member where fk_team_ID = ?";
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$q_tm = $pdo->prepare($sql_tm);
$q_tm->execute(array($teamID));


if (isset($_POST["teamMember"]) && is_array($_POST["teamMember"])) {

    while ($zeile = $q_tm->fetch(/* PDO::FETCH_ASSOC */)) {

        $teamMemberID = $zeile['team_member_ID'];
        $teamMemberName = $zeile['team_member_name'];

        foreach ($_POST["teamMember"] as $key => $teamMemberName) {

            if ($_POST["teamMember"][$teamMemberID] != $teamMemberName || $_POST["teamMember"][$teamMemberID] != "") {

                $sql = "UPDATE `tbl_team_member` SET team_member_name = ? WHERE team_member_id = ?";

                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $q = $pdo->prepare($sql);
                $q->execute(array($teamMemberName, $teamID));
            }
            if ($_POST["teamMember"][$teamMemberID] == "") {

                $sql = "DELETE FROM tbl_team_member WHERE team_member_ID = ?";
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $q = $pdo->prepare($sql);
                $q->execute(array($teamMemberID));
            }


            $sql = "UPDATE `tbl_team_member` SET team_member_name = ? WHERE team_member_id = ?";

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $q = $pdo->prepare($sql);
            $q->execute(array($teamMemberName, $teamID));
        }
    }
}

$res_score = $_POST[$key]['sco'];
$min = $_POST[$key]['min'];
$sec = $_POST[$key]['sec'];

Database::disconnect();
header("Location:athletesCustomize.php?comp_id=$compID");
?>
   
