<?PHP

session_start();

$divID = $_POST['div_ID'];
$compID = $_POST['comp_ID'];

if ($divID == 0) {
    echo"";
} else {

    include 'Database.php';
    $pdo = Database::connect();

    $sql_div = "SELECT div_name, div_ID, div_is_team FROM `tbl_division` where div_id = ?";

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $q_div = $pdo->prepare($sql_div);
    $q_div->execute(array($divID));


    while ($zeile = $q_div->fetch(/* PDO::FETCH_ASSOC */)) {
        $divName = $zeile['div_name'];
        $divIsTeam = $zeile['div_is_team'];
    }


    echo "<div class=\"card\">"
    . "<div class = \"card-header card-header-text\" data-background-color=\"oxfordblue\">"
    . "<h4 class=\"card-title\">$divName</h4>"
    . "</div><div class = \"card-content\">"
    . "<form class = \"form form-horizontal\" action=\"update_result.php\" method=\"POST\">"
    . "<input type=\"hidden\" name=\"compID\" value=\"$compID\" class=\"form-control\">"
    . "<table class=\"table table-hover\">"
    . "<thead>"
    . "<tr>"
    . "<th>Name</th>";
    //. "<th>Box</th>";

    $wod_array = array();
    $wod_count = 1;

    $sql = "SELECT wod_ID, wod_name FROM `tbl_wod` WHERE `fk_div_ID` = $divID";
    foreach ($pdo->query($sql) as $row) {
        echo
        "<th> " .$row['wod_name'] . " </th> ";

        $wod_array[$wod_count] = $row['wod_ID'];

        $wod_count++;
    }

    echo"</tr>"
    . "</thead>"
    . "<tbody>";

    $subsql = "";
    for ($counter = 1; $counter < $wod_count; $counter++) {
        $subsql = $subsql . ",\n sum(if(fk_wod_ID=" . $wod_array[$counter] . ",r.res_score,0)) as score" . $counter
                . ", sum(if(r.fk_wod_ID=" . $wod_array[$counter] . ",r.res_ID,0)) as resID" . $counter
                . ", sum(if(r.fk_wod_ID=" . $wod_array[$counter] . ",r.res_time,0)) as time" . $counter;
    }

    if ($divIsTeam == true) {

        $sql = "select td.team_div_ID, t.team_name, t.team_affiliate"
                . $subsql
                . "  from tbl_team t join tbl_team_division td on td.fk_team_ID = t.team_ID"
                . " left join tbl_result_team r on r.fk_team_div_ID = td.team_div_ID "
                . "  where td.fk_div_ID ="
                . $divID . " group by team_name";

        foreach ($pdo->query($sql) as $row) {
            echo "<tr><td>" . $row['team_name'] . "</td>";
            //<td>" . $row['team_affiliate'] . "</td>";

            for ($count = 1; $count < $wod_count; $count++) {
                $score = "score" . $count;
                $time = "time" . $count;
                $minutes = gmdate("i", $row[$time]);
                $seconds = gmdate("s", $row[$time]);

                $fieldID = $row["resID" . $count] . "X" . $row["team_div_ID"] . "X" . $wod_array[$count];

                /*
                  . "<div class=\"col-md-2 text-right\"><label>Reps</label></div>"
                  . "<div class=\"col-md-10 text-left\"><input style=\"width:100px\" class=\"form-control\" id='score' name='" . $fieldID . "[sco]' type='number'  placeholder='score' "
                  . "value='" . $row[$score] . "'>"
                  . "</div>"
                  . "<div class=\"col-md-2 text-right\"><label>Minutes</label></div>"
                  . "<div class=\"col-md-10 text-left\">"
                  . "<input style = \"width:100px\" class=\"form-control\" id='minutes' maxlength=\"4\" size=\"4\" name='" . $fieldID . "[min]' type='number'  placeholder='Min'"
                  . "value='" . $minutes . "'> "
                  . "</div>"
                  . "<div class=\"col-md-2 \"><label>Seconds</label></div>"
                  . "<div class=\"col-md-10 text-left\">"
                  . "<input style=\"width:100px\" class=\"form-control\" id='seconds' name='" . $fieldID . "[sec]' type='number'  placeholder='Sec' "
                  . "value='" . $seconds . "'>"
                  . "<input name ='resType' type='hidden' value='team'>"
                  . "</div>" */

                echo "<td>"
                . "<div class=\"col-md-4\">"
                . "<div class = \"form-group label-floating\">"
                . "<label class = \"control-label\">Score</label>"
                . "<input type = \"text\" id='score' name='" . $fieldID . "[sco]' type='number' class = \"form-control\" value='" . $row[$score] . "'>"
                . "</div>"
                . "</div>"
                . "<div class=\"col-md-4 \">"
                . "<div class = \"form-group label-floating\">"
                . "<label class = \"control-label\">Minutes</label>"
                . "<input type = \"text\" id='minutes' name='" . $fieldID . "[min]' type='number' class = \"form-control\" value='" . $minutes . "'>"
                . "</div>"
                . "</div>"
                . "<div class=\"col-md-4 \">"
                . "<div class = \"form-group label-floating\">"
                . "<label class = \"control-label\">Seconds</label>"
                . "<input type = \"text\" id='seconds' name='" . $fieldID . "[sec]' type='number' class = \"form-control\" value='" . $seconds . "'>"
                . "<input name=\"resType\" type=\"hidden\" value=\"team\">"
                . "</div>"
                . "</td>";
            }
            echo "</tr>";
        }
    } else {
        $sql = "select ad.athlete_div_ID, a.athlete_name, a.athlete_box"
                . $subsql
                . "  from tbl_athlete a join tbl_athlete_division ad on ad.fk_athlete_ID = a.athlete_ID"
                . " left join tbl_result r on r.fk_athlete_div_ID = ad.athlete_div_ID "
                . "  where ad.fk_div_ID ="
                . $divID . " group by athlete_name";


        foreach ($pdo->query($sql) as $row) {
            echo "<tr><td>" . $row['athlete_name'] . "</td><td> " . $row['athlete_box'] . " </td>";

            for ($count = 1; $count < $wod_count; $count++) {
                $score = "score" . $count;
                $time = "time" . $count;
                $minutes = gmdate("i", $row[$time]);
                $seconds = gmdate("s", $row[$time]);

                $fieldID = $row["resID" . $count] . "X" . $row["athlete_div_ID"] . "X" . $wod_array[$count];


                echo "<td>"
                . "<div class=\"col-md-12\">"
                . "<div class = \"form-group label-floating\">"
                . "<label class = \"control-label\">Score</label>"
                . "<input style=\"width:100px\" class=\"form-control\" id='score' name='" . $fieldID . "[sco]' type='number'  placeholder='score' "
                . "value='" . $row[$score] . "'>"
                . "</div>"
                . "</div>"
                . "<div class=\"col-md-12\">"
                . "<div class = \"form-group label-floating\">"
                . "<label class = \"control-label\">Minutes</label>"
                . "<input style = \"width:100px\" class=\"form-control\" id='minutes' maxlength=\"4\" size=\"4\" name='" . $fieldID . "[min]' type='number'  placeholder='Min'"
                . "value='" . $minutes . "'> "
                . "</div>"
                . "</div>"
                . "<div class=\"col-md-12\">"
                . "<div class = \"form-group label-floating\">"
                . "<label class = \"control-label\">Seconds</label>"
                . "<input style=\"width:100px\" class=\"form-control\" id=\"seconds\" name='" . $fieldID . "[sec]' type='number'  placeholder='Sec' "
                . "value='" . $seconds . "'>"
                . "<input name=\"resType\" type=\"hidden\" value=\"athlete\">"
                . "</div>"
                . "</div>"
                . "</td>";
            }
            echo "</tr>";
        }
    }


    Database::disconnect();

    echo"</tbody></table><button id=\"btn_save\" name=\"btn_save\" class=\"btn pull-right btn-pinterest\">Save</button></form></div></div>";
}
?>
