<?PHP
session_start();

$wod_ID = $_POST['wod_ID'];
$div_ID = $_POST['div_ID'];
$compID = $_POST['comp_ID'];


if ($wod_ID == 0) {
    $wodOverall = true;
} else {
    $wodOverall = false;
}

include 'Database.php';
$pdo = Database::connect();

$sql_div = "SELECT div_name, div_ID, div_is_team FROM `tbl_division` where div_ID = ?";

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$q_div = $pdo->prepare($sql_div);
$q_div->execute(array($div_ID));

while ($zeile = $q_div->fetch(/* PDO::FETCH_ASSOC */)) {
    $divIsTeam = $zeile['div_is_team'];
}

$sql_des = "select design_ID,
        design_body_bg_color,
        design_logo_frame_color,
        design_wod_btn_bg_color,
        design_wod_btn_font_color,
        design_wod_desc_color,
        design_table_header_bg_color,
        design_table_header_font_color,
        design_table_body_bg_color,
        design_score_color,
        design_competitor_color,
        design_rank_color,
        design_table_border_color from tbl_design where fk_comp_id = ?";


$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$q_des = $pdo->prepare($sql_des);
$q_des->execute(array($compID));


while ($zeile = $q_des->fetch(/* PDO::FETCH_ASSOC */)) {
    $desID = $zeile['design_ID'];
    $desBgColor = $zeile['design_body_bg_color'];
    $desLogoFrameColor = $zeile['design_logo_frame_color'];
    $desWodBtnBgColor = $zeile['design_wod_btn_bg_color'];
    $desWodBtnFontColor = $zeile['design_wod_btn_font_color'];
    $desWodDescColor = $zeile['design_wod_desc_color'];
    $desTableHeaderBgColor = $zeile['design_table_header_bg_color'];
    $desTableHeaderFontColor = $zeile['design_table_header_font_color'];
    $desTableBodyBgColor = $zeile['design_table_body_bg_color'];
    $desScoreColor = $zeile['design_score_color'];
    $desCompetitorColor = $zeile['design_competitor_color'];
    $desRankColor = $zeile['design_rank_color'];
    $desTableBorderColor = $zeile['design_table_border_color'];
}


if ($wodOverall) {

    echo "<center><h3><b>Total Score</b></h3></center><br>";


    if ($divIsTeam) {

        $competitor = "TEAM";

        $sql_wod = "SELECT distinct w.wod_ID as wodID FROM tbl_wod w inner join tbl_result_team rt on w.wod_ID = rt.fk_wod_ID inner join tbl_team_division td \n"
                . "on td.team_div_ID = rt.fk_team_div_ID where td.fk_div_ID =?";
    } else {
        $competitor = "ATHLETE";
        $sql_wod = "SELECT distinct w.wod_ID as wodID FROM tbl_wod w inner join tbl_result r on w.wod_ID = r.fk_wod_ID inner join tbl_athlete_division ad \n"
                . "on ad.athlete_div_ID = r.fk_athlete_div_ID where ad.fk_div_ID =?";
    }


    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $q_wod = $pdo->prepare($sql_wod);
    $q_wod->execute(array($div_ID));

    while ($zeile = $q_wod->fetch(/* PDO::FETCH_ASSOC */)) {
        $zeile['wodID'];

        if ($divIsTeam) {

            $sql_res = "SELECT t.team_ID, t.team_name as Name, rt.res_score as Punkte, rt.res_time as Time FROM tbl_team t inner join tbl_team_division td \n"
                    . "on t.team_ID = td.fk_team_ID inner join tbl_result_team rt on td.team_div_ID = rt.fk_team_div_ID inner join tbl_wod w \n"
                    . "on w.wod_ID = rt.fk_wod_ID where rt.fk_wod_ID =? ORDER BY Time = 0, Time, Punkte DESC";
        } else {

            $sql_res = "SELECT a.athlete_ID,a.athlete_name as Name, r.res_score as Punkte, r.res_time as Time FROM tbl_athlete a inner join tbl_athlete_division ad \n"
                    . "on a.athlete_ID = ad.fk_athlete_ID inner join tbl_result r on ad.athlete_div_ID = r.fk_athlete_div_ID inner join tbl_wod w \n"
                    . "on w.wod_ID = r.fk_wod_ID where r.fk_wod_ID =? ORDER BY Time = 0, Time, Punkte DESC";
        }

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $q_res = $pdo->prepare($sql_res);
        $q_res->execute(array($zeile['wodID']));

        $index_rank = 1;
        $lastScore = 0;
        $lastTime = 0;
        $score = array();
        while ($zeile = $q_res->fetch(/* PDO::FETCH_ASSOC */)) {


            $score[$zeile['Name']] = array();
        }
    }


    if ($divIsTeam) {

        $sql_wod = "SELECT distinct w.wod_ID as wodID FROM tbl_wod w inner join tbl_result_team rt on w.wod_ID = rt.fk_wod_ID inner join tbl_team_division td \n"
                . "on td.team_div_ID = rt.fk_team_div_ID where td.fk_div_ID =?";
    } else {
        $sql_wod = "SELECT distinct w.wod_ID as wodID FROM tbl_wod w inner join tbl_result r on w.wod_ID = r.fk_wod_ID inner join tbl_athlete_division ad \n"
                . "on ad.athlete_div_ID = r.fk_athlete_div_ID where ad.fk_div_ID =?";
    }

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $q_wod = $pdo->prepare($sql_wod);
    $q_wod->execute(array($div_ID));

    while ($zeile = $q_wod->fetch(/* PDO::FETCH_ASSOC */)) {
        $zeile['wodID'];


        if ($divIsTeam) {

            $sql_res = "SELECT t.team_ID, t.team_name as Name, rt.res_score as Punkte, rt.res_time as Time FROM tbl_team t inner join tbl_team_division td \n"
                    . "on t.team_ID = td.fk_team_ID inner join tbl_result_team rt on td.team_div_ID = rt.fk_team_div_ID inner join tbl_wod w \n"
                    . "on w.wod_ID = rt.fk_wod_ID where rt.fk_wod_ID =? ORDER BY Time = 0, Time, Punkte DESC";
        } else {
            $sql_res = "SELECT a.athlete_ID,a.athlete_name as Name, r.res_score as Punkte, r.res_time as Time FROM tbl_athlete a inner join tbl_athlete_division ad \n"
                    . "on a.athlete_ID = ad.fk_athlete_ID inner join tbl_result r on ad.athlete_div_ID = r.fk_athlete_div_ID inner join tbl_wod w \n"
                    . "on w.wod_ID = r.fk_wod_ID where r.fk_wod_ID =? ORDER BY Time = 0, Time, Punkte DESC";
        }


        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $q_res = $pdo->prepare($sql_res);
        $q_res->execute(array($zeile['wodID']));

        $index_rank = 1;
        $lastScore = 0;
        $lastTime = 0;
        $index_rank_counter = 0;
        while ($zeile = $q_res->fetch(/* PDO::FETCH_ASSOC */)) {


            if ($lastScore == $zeile['Punkte'] && $lastTime == $zeile['Time']) {

                $index_rank--;
                $index_rank_counter++;
            } else {
                $index_rank += $index_rank_counter;
                $index_rank_counter = 0;
            }

            array_push($score[$zeile['Name']], $index_rank);

            $lastScore = $zeile['Punkte'];
            $lastTime = $zeile['Time'];
            $index_rank++;
        }
    }

    /*     * ****echo "<thead>
      <tr>
      <th align=\"middle\" style=\"  min-width: 10%; color:#$desTableHeaderFontColor; background-color:#$desTableHeaderBgColor;\"><b>RANK</b></th>
      <th align=\"middle\" style=\"  min-width: 30%; color:#$desTableHeaderFontColor; background-color:#$desTableHeaderBgColor;\"><b>$competitor</b></th>
      <th align=\"middle\" style=\"  min-width: 30%; color:#$desTableHeaderFontColor; background-color:#$desTableHeaderBgColor;\"><b>SCORE</b></th>
      </tr>
      </thead>";


      echo"<tbody>"; */////

    $final = array();
    foreach ($score as $athleteName => $value) {

        $overallScore = 0;
        if (is_array($value)) {

            foreach ($value as $key => $value) {

                $overallScore += $value;
            }

            $final[$athleteName] = array();

            array_push($final[$athleteName], $overallScore);
        }
    }

    $index_rank = 1;
    $index_rank_counter = 0;
    $lastScore = 0;
    $lastTime = 0;
    $counter = 1;

    asort($final);
    $arrayCount = count($final);
    $arrayCount++;
    echo"<br>";
    echo"<div class=\"col-lg-6 col-md-12 col-md-12 col-md-12\">";
    foreach ($final as $athleteName => $value) {


        $overallScore = 0;
        if (is_array($value)) {

            foreach ($value as $key => $value) {

                $overallScore = $value;
            }
        }

        if ($lastScore == $overallScore) {

            $index_rank--;
            $index_rank_counter++;
        } else {
            $index_rank += $index_rank_counter;
            $index_rank_counter = 0;
        }

        if ($counter == (ceil($arrayCount / 2))) {

            echo"</div><div class=\"col-lg-6 col-md-12 col-md-12 col-md-12\">";
        }


        echo "<div class=\"col-lg-12 col-md-12 col-md-12 col-md-12\" style=\" margin: -50px 0px 0px 0px; \">"
        . "<div class=\"card\" style=\"vertical-align: middle; height: 100px;\" >"
        . "<div class=\"card-content\">"
        . "<div class=\"col-lg-2 col-md-2 col-sm-2 col-xs-2\">"
        . "<h3 style=\"color:#$desRankColor;\"><b>" . $index_rank . "</b></h3>"
        . "</div>"
        . "<div class=\"col-lg-8 col-md-8 col-sm-8 col-xs-8\" style=\" overflow:hidden; white-space:nowrap; text-overflow: ellipsis;\">"
        . "<h3 style=\"color:#$desCompetitorColor;\">" . $athleteName . "</h3>"
        . "</div>"
        . "<div class=\"col-lg-2 col-md-2 col-sm-2 col-xs-2\">"
        . "<h3 style =\"color:#$desScoreColor;\">" . $overallScore . "</h3>"
        . "</div>"
        . "</div>"
        . "</div>"
        . "</div>";




        $lastScore = $overallScore;
        $index_rank++;
        $counter++;
    }
    echo"</div>";


    //////echo "</tbody></table>";
} else {

    $sql_wod = "SELECT wod_name, wod_desc, wod_duration from tbl_wod where wod_ID =?";

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $q_wod = $pdo->prepare($sql_wod);
    $q_wod->execute(array($wod_ID));


    while ($zeile = $q_wod->fetch(/* PDO::FETCH_ASSOC */)) {

        $wodDesc = $zeile['wod_desc'];
        $wodDuration = $zeile['wod_duration'];
        $wodName = $zeile['wod_name'];

        $wodDescFormatted = nl2br(htmlentities($wodDesc, ENT_QUOTES, 'UTF-8'));
        ?>
        <div class = "panel-group " id = "accordion" role = "tablist" aria-multiselectable = "true">
            <div class = "panel panel-default">
                <?php echo"<div class=\"col-lg-6 col-lg-offset-3 col-md-12 col-md-offset-0  col-sm-12 col-sm-offset-0 col-xs-12 col-xs-offset-0 panel-heading\" role=\"tab\" id=\"heading$wod_ID\">";
                ?>

                <?php echo"<a role=\"button\" data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapse$wod_ID\" aria-expanded=\"true\" aria-controls=\"collapse$wod_ID\">"; ?>
                <h4 class="panel-title">
                    <b><?php echo $wodName ?> Description</b>
                    <i class="material-icons">keyboard_arrow_down</i>
                </h4>
                <?php
                echo"</a>";
                ?>

                <?php echo"<div id=\"collapse$wod_ID\" class=\"panel-collapse collapse\" role=\"tabpanel\" aria-labelledby=\"heading$wod_ID\">";
                ?>
                <div class="panel-body">

                    <div class="col-md-12" align="left">
                        <?php
                        echo"<div  class=\"col-md-offset-3\" style=\" overflow: auto;
          word-wrap: normal;
          color:#$desWodDescColor\">"
                        . "<h4>" . $wodDescFormatted . "</h4>"
                        . "</div>";
                        ?>
                    </div>
                </div>
                <?php
                echo"</div>";
                echo"</div><br><br><br><br>";
                ?>
            </div>
        </div>
        <?php
        $wod_duration = $zeile ['wod_duration'];
    }



    /* $msg = "<table class = \"table table-responsive\">";
      echo $msg; */

    if ($divIsTeam) {

        $competitor = "TEAM";

        $sql_wod = "SELECT t.team_name as Name, t.team_affiliate as Box, rt.res_score as Punkte, rt.res_time as Time FROM tbl_team t inner join tbl_team_division td \n"
                . "on t.team_ID = td.fk_team_ID inner join tbl_result_team rt on td.team_div_ID = rt.fk_team_div_ID where rt.fk_wod_ID =? ORDER BY Time = 0, Time, Punkte DESC";
    } else {

        $competitor = "ATHLETE";

        $sql_wod = "SELECT a.athlete_name as Name, a.athlete_box as Box, r.res_score as Punkte, r.res_time as Time FROM tbl_athlete a inner join tbl_athlete_division ad \n"
                . "on a.athlete_ID = ad.fk_athlete_ID inner join tbl_result r on ad.athlete_div_ID = r.fk_athlete_div_ID where r.fk_wod_ID =? ORDER BY Time = 0, Time, Punkte DESC";
    }

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $q_wod = $pdo->prepare($sql_wod);
    $q_wod->execute(array($wod_ID));

    $score = array();
    while ($zeile = $q_wod->fetch(/* PDO::FETCH_ASSOC */)) {

        $score += array(
            $zeile['Name'] => array(
                "score" => $zeile['Name'],
                "score" => $zeile['Punkte'],
                "time" => $zeile['Time'],
        ));
    }

    if ($q_wod->rowCount() > 0) {

        /*         * ***echo "<thead>
          <tr>
          <th style=\"  min-width: 10%; color:#$desTableHeaderFontColor; background-color:#$desTableHeaderBgColor;\" align=\"middle\" ><b>RANK</b></th>
          <th style=\" min-width: 30%; color:#$desTableHeaderFontColor; background-color:#$desTableHeaderBgColor;\" align=\"middle\"><b>$competitor</b></th>
          <th style=\" min-width: 30%; color:#$desTableHeaderFontColor; background-color:#$desTableHeaderBgColor;\" align=\"middle\"><b>SCORE</b></th>
          </tr>
          </thead>";**** */


        ///// echo "<tbody>";
        /////  echo "<div class=\"row\">";

        $index_rank = 1;
        $lastScore = 0;
        $lastTime = 0;
        $index_rank_counter = 0;

        /*         * ** */
        $counter = 1;

        $arrayCount = count($score);
        $arrayCount++;
        echo"<br>";
        echo"<div class=\"col-lg-6 col-md-12 col-md-12 col-md-12\">";


        foreach ($score as $athleteName => $value) {




            if (is_array($value)) {
                foreach ($value as $key => $value) {

                    if ($key == 'score') {

                        $punkte = $value;
                    } else {
                        $time = $value;
                    }
                }
            }

            if ($lastScore == $punkte && $lastTime == $time) {

                $index_rank--;
                $index_rank_counter++;
            } else {
                $index_rank += $index_rank_counter;
                $index_rank_counter = 0;
            }


            $timeSec = gmdate("s", $time);
            $timeMin = gmdate("i", $time);
            $timeDisplay = $timeMin . ":" . $timeSec;

            if ($time == 0 && $punkte == 0) {

                $scoreDisplay = 0;
            } else {

                if ($time < $wodDuration) {

                    $scoreDisplay = $timeDisplay;
                } else {

                    $scoreDisplay = $punkte;
                }
            }




            if ($counter == (ceil($arrayCount / 2))) {

                echo"</div><div class=\"col-lg-6 col-md-12 col-md-12 col-md-12\">";
            }


            echo "<div class=\"col-lg-12 col-md-12 col-md-12 col-md-12\" style=\" margin: -50px 0px 0px 0px; \">"
            . "<div class=\"card\" style=\"vertical-align: middle; height: 100px;\" >"
            . "<div class=\"card-content\">"
            . "<div class=\"col-lg-2 col-md-2 col-sm-2 col-xs-2\">"
            . "<h3 style=\"color:#$desRankColor;\"><b>" . $index_rank . "</b></h3>"
            . "</div>"
            . "<div class=\"col-lg-8 col-md-8 col-sm-8 col-xs-8\" style=\" overflow:hidden; white-space:nowrap; text-overflow: ellipsis;\">"
            . "<h3 style=\"color:#$desCompetitorColor;\">" . $athleteName . "</h3>"
            . "</div>"
            . "<div class=\"col-lg-2 col-md-2 col-sm-2 col-xs-2\">"
            . "<h3 style =\"color:#$desScoreColor;\">" . $scoreDisplay . "</h3>"
            . "</div>"
            . "</div>"
            . "</div>"
            . "</div>"
            . "</td>"; //Display the number of the data item we are//Add some extra space between columns




            /* echo"<div class=\"col-lg-6 col-md-6 col-md-12 col-md-12\" style=\" margin: -50px 0px 0px 0px; \">"
              . "<div class=\"card\" style=\"vertical-align: middle; height: 100px;\" >"
              . "<div class=\"card-content\">"
              . "<div class=\"col-lg-2 col-md-2 col-sm-2 col-xs-2\">"
              . "<h3 style=\"color:#$desRankColor;\"><b>" . $index_rank . "</b></h3>"
              . "</div>"
              . "<div class=\"col-lg-8 col-md-8 col-sm-8 col-xs-8\" style=\" overflow:hidden; white-space:nowrap; text-overflow: ellipsis;\">"
              . "<h3 style=\"color:#$desCompetitorColor;\">" . $athleteName . "</h3>"
              . "</div>"
              . "<div class=\"col-lg-2 col-md-2 col-sm-2 col-xs-2\">"
              . "<h3 style =\"color:#$desScoreColor;\">" . $scoreDisplay . "</h3>"
              . "</div>"
              . "</div>"
              . "</div>"
              . "</div>"; */

            $lastScore = $punkte;
            $lastTime = $time;
            $index_rank++;
            $counter++;
        }
        echo"</div>";
    }
}




$stringDivWod = $wod_ID . "X" . $div_ID;
/* $msg = "<form  action=\"rangliste_pdf.php\" method=\"post\">  
  <button type=\"submit\" value=" . $stringDivWod . " id=\"btn_pdf\" name=\"btn_pdf\" class=\"btn btn-custom-red btn-lg\">PDF Export</button>
  </form > ";
  echo $msg;
 */
Database::disconnect();
?>
