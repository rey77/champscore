<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <?php
        $compID = $_GET['comp_id'];

        include 'Database.php';
        $pdo = Database::connect();

        $sql = "select comp_ID, comp_name, comp_regcode, comp_active, comp_street, comp_zip, comp_city, comp_main_color, comp_accent_color, comp_country, comp_logo from tbl_competition where comp_id = ?";

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $q = $pdo->prepare($sql);
        $q->execute(array($compID));

        while ($zeile = $q->fetch(/* PDO::FETCH_ASSOC */)) {

            $compID = $zeile['comp_ID'];
            $compName = $zeile['comp_name'];
            $compRegCode = $zeile['comp_regcode'];
            
            $compZip = $zeile['comp_zip'];
            $compStreet = $zeile['comp_street'];
            $compCity = $zeile['comp_city'];
            $compCountry = $zeile['comp_country'];
            $compLogo = $zeile['comp_logo'];
            $compMainColor = $zeile['comp_main_color'];
            $compAccentColor = $zeile['comp_accent_color'];
        }


        if ($compLogo != 0) {
            $logosrc = "uploads/host/complogo/$compLogo";
        } else {
            $logosrc = "img/image_placeholder.jpg";
        }



        $sql_div = "SELECT div_name, div_ID FROM `tbl_division` where fk_comp_id = ?";

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $q_div = $pdo->prepare($sql_div);
        $q_div->execute(array($compID));

        $counter = 0;
        $arrayDivInit = array();
        while ($zeile = $q_div->fetch(/* PDO::FETCH_ASSOC */)) {
            $divID = $zeile['div_ID'];
            $arrayDivInit[$counter] = $divID;

            $counter++;
        }
        ?>
        <meta charset="utf-8" />
        <link rel="apple-touch-icon" sizes="76x76" href="img/apple-icon.png">
        <link rel="icon" type="image/png" href="img/favicon-16x16.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <title><?php echo $compName ?></title>

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

        <!--     Fonts and icons     -->
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
        <link href="css/material-dashboard.css" rel="stylesheet" />
        <!-- CSS Files -->
        <link href="css/bootstrap.min.css" rel="stylesheet" />
        <link href="css/material-kit.css?v=1.1.0" rel="stylesheet"/>




        <script type="text/javascript">


            function onSelectDivision(i_wodBtnFontColor, i_wodBtnBgColor, i_comp_ID)
            {


                var div_ID = 'div_ID=' + document.getElementById("selDiv").options[document.getElementById("selDiv").selectedIndex].value;
                var wodBtnFontColor = '&wodBtnFontColor=' + i_wodBtnFontColor;
                var wodBtnBgColor = '&wodBtnBgColor=' + i_wodBtnBgColor;
                var compID = '&comp_ID=' + i_comp_ID;
                var data = div_ID + wodBtnFontColor + wodBtnBgColor + compID;


                $.ajax({
                    type: "POST",
                    url: "ScoreboardViewSelWods.php",
                    cache: false,
                    data: data,
                    success: function (html)
                    {
                        $('#wods').html(html);
                    },
                    error: function (html)
                    {

                        alert('error');
                    }

                }
                );

                return false;

            }

            function onSelectWod(i_wod_ID, i_div_ID, i_comp_ID)
            {


                var wod_ID = 'wod_ID=' + i_wod_ID;
                var div_ID = '&div_ID=' + i_div_ID;
                var comp_ID = '&comp_ID=' + i_comp_ID;


                var data = wod_ID + div_ID + comp_ID;

                $.ajax({
                    type: "POST",
                    url: "ScoreboardViewSelResults.php",
                    cache: false,
                    data: data,
                    success: function (html)
                    {
                        $('#result').html(html);
                    },
                    error: function (html)
                    {

                        alert('error');
                    }

                }
                );

                return false;

            }

        </script>
    </head>

    <body class="profile-page">
    <?php
    $compID = $_GET['comp_id'];
    ?>
        <nav class="navbar navbar-transparent navbar-fixed-top navbar-color-on-scroll">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="organizer.php">CHAMPSCORE</a>
                </div>


            </div>
        </nav>


        <div class="page-header header-filter" data-parallax="true" style="background-image: url('img/banner.jpg');"></div>

        <div class="main main-raised">
            <div class="profile-content">
                <div class="container">

                    <div class="row">
                        <div class="col-xs-6 col-xs-offset-3">
                            <div class="profile">
                                <div class="avatar">
                                    <img src="<?php echo $logosrc ?>" alt="Circle Image" class="img-rounded img-responsive img-raised">
                                </div>
                                <div class="name">
                                    <h3 class="title"><?php echo $compName ?></h3>
                                    <h6>Presented By CrossFit Jackhammer</h6>
                                    <a href="#pablo" class="btn btn-just-icon btn-simple btn-facebook"><i class="fa fa-facebook"></i></a>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="card">
                                    <div class="card-header card-header-tabs" data-background-color="white" style="background:<?php echo '#' . $compMainColor ?>;
                                         box-shadow: 0 4px 20px 0px rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(0, 0, 0, 0.4); color: <?php echo '#' . $compAccentColor ?>">
                                        <div class="nav-tabs-navigation">
                                            <div class="nav-tabs-wrapper">
                                                <span class="nav-tabs-title"><b>Divisions:</b></span>
                                                <ul class="nav nav-tabs" data-tabs="tabs" style="color: <?php echo '#' . $compAccentColor ?>">

                                                    <?php
                                                    $sql_div = "SELECT div_name, div_ID FROM `tbl_division` where fk_comp_id = ?";

                                                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                                    $q_div = $pdo->prepare($sql_div);
                                                    $q_div->execute(array($compID));

                                                    $arrayDiv = array();
                                                    $counter = 0;

                                                    while ($zeile = $q_div->fetch(/* PDO::FETCH_ASSOC */)) {
                                                        $divID = $zeile['div_ID'];
                                                        $divName = $zeile['div_name'];
                                                        $arrayDiv[$counter] = $divID;

                                                        if ($counter == 0) {
                                                            $liActive = 'active';
                                                        } else {
                                                            $liActive = '';
                                                        }
                                                        ?>

                                                        <li class="<?php echo $liActive ?>">
                                                            <a href="#LBDiv<?php echo $divID ?>" data-toggle="tab">
                                                                <?php echo $divName; ?>
                                                                <div class="ripple-container"></div>
                                                            </a>
                                                        </li>
                                                        <?php
                                                        $counter++;
                                                    }
                                                    ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-content">
                                        <div class="tab-content">
                                            <?php
                                            $counter = 0;
                                            foreach ($arrayDiv as $valueDiv) {

                                                if ($counter == 0) {

                                                    $paneActive = 'active';
                                                } else {
                                                    $paneActive = '';
                                                }

                                                echo "<div class =\"tab-pane LBDiv$valueDiv $paneActive\" id =\"LBDiv$valueDiv\">";
                                                $counter++
                                                ?>  

                                                <div class="row">
                                                    <div class="col-md-12">


                                                        <div class="material-datatables">
                                                            <?php
                                                            $sql_div = "SELECT div_name, div_ID, div_is_team FROM `tbl_division` where div_id = ?";

                                                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                                            $q_div = $pdo->prepare($sql_div);
                                                            $q_div->execute(array($valueDiv));



                                                            while ($zeile = $q_div->fetch(/* PDO::FETCH_ASSOC */)) {
                                                                $divIsTeam = $zeile['div_is_team'];
                                                            }

                                                            if ($divIsTeam) {

                                                                $sql_res = "SELECT t.team_ID as ID, t.team_name as Name FROM tbl_team t inner join tbl_team_division td \n"
                                                                        . "on t.team_ID = td.fk_team_ID where td.fk_div_ID = ?";
                                                            } else {

                                                                $sql_res = "SELECT a.athlete_ID as ID,a.athlete_name as Name, r.res_score as Punkte, r.res_time as Time FROM tbl_athlete a inner join tbl_athlete_division ad \n"
                                                                        . "on a.athlete_ID = ad.fk_athlete_ID inner join tbl_result r on ad.athlete_div_ID = r.fk_athlete_div_ID inner join tbl_wod w \n"
                                                                        . "on w.wod_ID = r.fk_wod_ID where r.fk_wod_ID =? ORDER BY Time = 0, Time, Punkte DESC";
                                                            }
                                                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                                            $q_res = $pdo->prepare($sql_res);
                                                            $q_res->execute(array($valueDiv));

                                                            $index_rank = 1;
                                                            $lastScore = 0;
                                                            $lastTime = 0;
                                                            $score = array();

                                                            while ($zeile = $q_res->fetch(/* PDO::FETCH_ASSOC */)) {

                                                                $score[$zeile['ID']] = array();
                                                            }



                                                            if ($divIsTeam) {


                                                                $sql_wod = "SELECT distinct w.wod_ID as wodID, wod_name FROM tbl_wod w inner join tbl_result_team rt on w.wod_ID = rt.fk_wod_ID inner join tbl_team_division td \n"
                                                                        . "on td.team_div_ID = rt.fk_team_div_ID where td.fk_div_ID =?";
                                                            } else {

                                                                $sql_wod = "SELECT distinct w.wod_ID as wodID, wod_name FROM tbl_wod w inner join tbl_result r on w.wod_ID = r.fk_wod_ID inner join tbl_athlete_division ad \n"
                                                                        . "on ad.athlete_div_ID = r.fk_athlete_div_ID where ad.fk_div_ID =?";
                                                            }


                                                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                                            $q_wod = $pdo->prepare($sql_wod);
                                                            $q_wod->execute(array($valueDiv));

                                                            echo"<table id=\"datatables$valueDiv\" class=\"table table-striped table-no-bordered table-hover\" cellspacing=\"0\" width=\"100%\" style=\"width:100%\">
                                                                          <thead><tr><th><b>Rank</b></th>
                                                                            <th><b>Competitor</b></th>
                                                                            <th><b>Overall Score</b></th>";

                                                            while ($zeile = $q_wod->fetch(/* PDO::FETCH_ASSOC */)) {
                                                                $zeile['wodID'];
                                                                $wodName = $zeile['wod_name'];

                                                                echo"<th><b>$wodName</b></th>";
                                                            }


                                                            echo"</tr>
                                                                            </thead>
                                                                            
                                                                            <tbody>";



                                                            if ($divIsTeam) {

                                                                $sql_wod = "SELECT distinct w.wod_ID as wodID, wod_duration FROM tbl_wod w inner join tbl_result_team rt on w.wod_ID = rt.fk_wod_ID inner join tbl_team_division td \n"
                                                                        . "on td.team_div_ID = rt.fk_team_div_ID where td.fk_div_ID =?";
                                                            } else {
                                                                $sql_wod = "SELECT distinct w.wod_ID as wodID, wod_duration FROM tbl_wod w inner join tbl_result r on w.wod_ID = r.fk_wod_ID inner join tbl_athlete_division ad \n"
                                                                        . "on ad.athlete_div_ID = r.fk_athlete_div_ID where ad.fk_div_ID =?";
                                                            }

                                                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                                            $q_wod = $pdo->prepare($sql_wod);
                                                            $q_wod->execute(array($valueDiv));

                                                            while ($zeile = $q_wod->fetch(/* PDO::FETCH_ASSOC */)) {
                                                                $zeile['wodID'];
                                                                $wodDuration = $zeile['wod_duration'];


                                                                if ($divIsTeam) {

                                                                    $sql_res = "SELECT t.team_ID as ID, t.team_name as Name, rt.res_score as Punkte, rt.res_time as Time FROM tbl_team t inner join tbl_team_division td \n"
                                                                            . "on t.team_ID = td.fk_team_ID inner join tbl_result_team rt on td.team_div_ID = rt.fk_team_div_ID inner join tbl_wod w \n"
                                                                            . "on w.wod_ID = rt.fk_wod_ID where rt.fk_wod_ID =? ORDER BY Time = 0, Time, Punkte DESC";
                                                                } else {
                                                                    $sql_res = "SELECT a.athlete_ID as ID,a.athlete_name as Name, r.res_score as Punkte, r.res_time as Time FROM tbl_athlete a inner join tbl_athlete_division ad \n"
                                                                            . "on a.athlete_ID = ad.fk_athlete_ID inner join tbl_result r on ad.athlete_div_ID = r.fk_athlete_div_ID inner join tbl_wod w \n"
                                                                            . "on w.wod_ID = r.fk_wod_ID where r.fk_wod_ID =? ORDER BY Time = 0, Time, Punkte DESC";
                                                                }


                                                                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                                                $q_res = $pdo->prepare($sql_res);
                                                                $q_res->execute(array($zeile['wodID']));

                                                                $index_rank = 1;
                                                                $lastScore = 0;
                                                                $lastTime = 0;
                                                                while ($zeile = $q_res->fetch(/* PDO::FETCH_ASSOC */)) {


                                                                    if ($lastScore == $zeile['Punkte'] && $lastTime == $zeile['Time']) {

                                                                        $index_rank--;
                                                                    }


                                                                    $timeSec = gmdate("s", $zeile['Time']);
                                                                    $timeMin = gmdate("i", $zeile['Time']);
                                                                    $timeDisplay = $timeMin . ":" . $timeSec;

                                                                    if ($zeile['Time'] == 0 && $zeile['Punkte'] == 0) {

                                                                        $scoreDisplay = 0;
                                                                    } else {


                                                                        if ($zeile['Time'] < $wodDuration) {

                                                                            $scoreDisplay = $timeDisplay;
                                                                        } else {

                                                                            $scoreDisplay = $zeile['Punkte'];
                                                                        }
                                                                    }



                                                                    array_push($score[$zeile['ID']], $index_rank . ' (' . $scoreDisplay . ')');

                                                                    $lastScore = $zeile['Punkte'];
                                                                    $lastTime = $zeile['Time'];
                                                                    $index_rank++;
                                                                }
                                                            }


                                                            foreach ($score as $ID => $value) {


                                                                if ($divIsTeam) {

                                                                    $sql_name = "SELECT team_name as Name from tbl_team where team_ID =?";
                                                                } else {
                                                                    $sql_name = "SELECT athlete_name as Name from athlete where athlete_ID =?";
                                                                }

                                                                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                                                $q_name = $pdo->prepare($sql_name);
                                                                $q_name->execute(array($ID));

                                                                while ($zeile = $q_name->fetch(/* PDO::FETCH_ASSOC */)) {
                                                                    $name = $zeile['Name'];
                                                                }
                                                                $overallScore = 0;
                                                                if (is_array($value)) {

                                                                    foreach ($value as $key => $value) {

                                                                        $overallScore += $value;
                                                                    }
                                                                    array_unshift($score[$ID], $overallScore);
                                                                    array_unshift($score[$ID], $name);
                                                                }
                                                            }
                                                            array_multisort($score, SORT_DESC);

                                                            $rankCounter = 1;

                                                            foreach ($score as $ID => $value) {




                                                                if (is_array($value)) {
                                                                    echo"<tr>";
                                                                    echo"<td><h4>$rankCounter</h4></td>";
                                                                    foreach ($value as $key => $value) {


                                                                        echo"<td><h4>$value</h4></td>";
                                                                    }
                                                                    echo"</tr>";
                                                                    $rankCounter++;
                                                                }
                                                            }



                                                            echo"</tbody>
                                                                        </table>";
                                                            ?>
                                                        </div>

                                                        <!--  end card  -->
                                                    </div>
                                                    <!-- end col-md-12 -->
                                                </div>


                                                <?php
                                                echo"</div>";
                                            }
                                            Database::disconnect();
                                            ?>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>

                </div></div>
        </div>


        


    </body>
    <!--   Core JS Files   -->
    <script src="js/jquery.min.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <script src="js/material.min.js"></script>

    <!--    Plugin for Date Time Picker and Full Calendar Plugin   -->
    <script src="js/moment.min.js"></script>

    <!--	Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/   -->
    <script src="js/nouislider.min.js" type="text/javascript"></script>

    <!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker   -->
    <script src="js/bootstrap-datetimepicker.js" type="text/javascript"></script>

    <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select   -->
    <script src="js/bootstrap-selectpicker.js" type="text/javascript"></script>

    <!--	Plugin for Tags, full documentation here: http://xoxco.com/projects/code/tagsinput/   -->
    <script src="js/bootstrap-tagsinput.js"></script>

    <!--	Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput   -->
    <script src="js/jasny-bootstrap.min.js"></script>

    <!--  DataTables.net Plugin    -->
    <script src="js/jquery.datatables.js"></script>

    <!--    Plugin For Google Maps   -->
    <script  type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

    <!--    Plugin for 3D images animation effect, full documentation here: https://github.com/drewwilson/atvImg    -->
    <script src="js/atv-img-animation.js" type="text/javascript"></script>



    <!--    Control Center for Material Kit: activating the ripples, parallax effects, scripts from the example pages etc    -->
    <script src="js/material-kit.js?v=1.1.0" type="text/javascript"></script>

    <script type="text/javascript">
                        $(document).ready(function () {

<?php foreach ($arrayDivInit as $valueDivInit) { ?>
                                var value = <?php echo $valueDivInit ?>;


                                $('#datatables' + value).DataTable({
                                    "pagingType": "full_numbers",
                                    "lengthMenu": [
                                        [10, 25, 50, -1],
                                        [10, 25, 50, "All"]
                                    ],
                                    paging:false,
                                    responsive: true,
                                    language: {
                                        search: "_INPUT_",
                                        searchPlaceholder: "Search records",
                                    }

                                });


                                var table = $('#datatables' + value).DataTable();

                                // Edit record
                                table.on('click', '.edit', function () {
                                    $tr = $(this).closest('tr');

                                    var data = table.row($tr).data();
                                    alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
                                });

                                // Delete a record
                                table.on('click', '.remove', function (e) {
                                    $tr = $(this).closest('tr');
                                    table.row($tr).remove().draw();
                                    e.preventDefault();
                                });

                                //Like record
                                table.on('click', '.like', function () {
                                    alert('You clicked on Like button');
                                });

                                $('.card .material-datatables label').addClass('form-group');

<?php } ?>
                        });
    </script>
</html>
