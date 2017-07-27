<?php

session_start();

include 'Database.php';
$pdo = Database::connect();

$compID = $_POST['compID'];
$count_res = count($_POST) - 1;
$count = 1;
$valid = true;
if ($_POST['resType'] == 'athlete') {
    foreach ($_POST as $key => $value) {

        if (is_array($value) || is_object($value)) {
            foreach ($value as $value1 => $key2) {



                if ($value1 == 'sco') {
                    $res_score = $key2;
                }
                if ($value1 == 'min') {

                    $res_time = ($key2 * 60);
                }
                if ($value1 == 'sec') {
                    $res_time += $key2;
                }
            }

            /* $res_score = $_POST[$key]['sco'];
              $min = $_POST[$key]['min'];
              $sec = $_POST[$key]['sec'];

              $res_time = ($min * 60) + $sec; */

            $dataString = "X" . $key . "<br/>";

            list ($score, $res_ID, $athlete_div_ID, $wod_ID) = explode('X', $dataString);

            if ($valid && $res_ID == 0 && $wod_ID != 0) {
                $sql = "INSERT INTO `tbl_result` (`fk_wod_ID`, `fk_athlete_div_ID`, `res_score`, `res_time`) "
                        . "VALUES (?,?,?,?)";

                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $q = $pdo->prepare($sql);
                $q->execute(array($wod_ID, $athlete_div_ID, $res_score, $res_time));
            }

            if ($valid && $res_ID != 0) {
                $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "UPDATE `tbl_result` SET `res_score` = ?, `res_time` = ? WHERE `res_id` = ?";
                $q = $pdo->prepare($sql);
                $q->execute(array($res_score, $res_time, $res_ID));
            }

            if ($count == $count_res) {
                break;
            }

            $count++;
        }
    }
} else {

    foreach ($_POST as $key => $value) {


        if (is_array($value) || is_object($value)) {
            foreach ($value as $value1 => $key2) {



                if ($value1 == 'sco') {
                    $res_score = $key2;
                }
                if ($value1 == 'min') {

                    $res_time = ($key2 * 60);
                }
                if ($value1 == 'sec') {
                    $res_time += $key2;
                }
            }

            /* $res_score = $_POST[$key]['sco'];
              $min = $_POST[$key]['min'];
              $sec = $_POST[$key]['sec']; */


            $dataString = "X" . $key . "<br/>";

            list ($score, $res_ID, $team_div_ID, $wod_ID) = explode('X', $dataString);


            if ($valid && $res_ID == 0 && $wod_ID != 0) {
                $sql = "INSERT INTO `tbl_result_team` (`fk_wod_ID`, `fk_team_div_ID`, `res_score`, `res_time`) "
                        . "VALUES (?,?,?,?)";

                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $q = $pdo->prepare($sql);
                $q->execute(array($wod_ID, $team_div_ID, $res_score, $res_time));
            }

            if ($valid && $res_ID != 0) {
                $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "UPDATE `tbl_result_team` SET `res_score` = ?, `res_time` = ? WHERE `res_id` = ?";
                $q = $pdo->prepare($sql);
                $q->execute(array($res_score, $res_time, $res_ID));
            }

            if ($count == $count_res) {
                break;
            }

            $count++;
        }
    }
}

Database::disconnect();
header("Location:competitionAddScore.php?comp_ID=$compID");
?>

