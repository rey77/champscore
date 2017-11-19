<?php
session_start();

if ($_SESSION['eingeloggt'] == false) {

    header("Location: public_html/index.php");
    exit();
}
?>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <link rel="apple-touch-icon" sizes="76x76" href="img/apple-icon.png" />
        <link rel="icon" type="image/png" href="img/favicon-16x16.png" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>Submit Scores</title>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />
        <!-- Bootstrap core CSS     -->
        <link href="css/bootstrap.min.css" rel="stylesheet" />
        <!--  Material Dashboard CSS    -->
        <link href="css/material-dashboard.css" rel="stylesheet" />
        <!--  CSS for Demo Purpose, don't include it in your project     -->
        <link href="css/demo.css" rel="stylesheet" />
        <!--     Fonts and icons     -->
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons" />


    </head>

    <body>

        <?php
        $compID = $_GET['comp_id'];

        include 'Database.php';
        $pdo = Database::connect();
        ?>

        <div class="wrapper">
            <div class="sidebar" data-active-color="oxfordblue" data-background-color="black" data-image="img/sidebar-1.jpg">
                <!--
            Tip 1: You can change the color of active element of the sidebar using: data-active-color="purple | blue | green | orange | red | rose"
            Tip 2: you can also add an image using data-image tag
            Tip 3: you can change the color of the sidebar with data-background-color="white | black"
                -->
                <div class="logo">
                    <a href="athleteIndex.php" class="simple-text">
                        <p><!--<img style=" margin-left: -20px; height: 70px;" class="logo" src="../img/Logo.png" alt=""/>-->
                            <img style="  height: 20px;" src="img/text.png" alt=""/></p>
                    </a>

                </div>
                <div class="logo logo-mini">
                    <a href="athleteIndex.php" class="simple-text">
                        CS
                    </a>
                </div>
                <div class="sidebar-wrapper">
                    <div class="user">
                        <div class="photo">

                            <img src="uploads/athlete/profile/<?php echo $_SESSION['athlete_id'] . ".jpg" ?>">
                        </div>
                        <div class="info">
                            <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                                <?php echo $_SESSION['athleteEmail']; ?>
                                <b class="caret"></b>
                            </a>
                            <div class="collapse" id="collapseExample">
                                <ul class="nav">
                                    <li>
                                        <a href="athletePersonalData.php">Edit Profile</a>
                                    </li>
                                    <li>
                                        <a href="loginsec/logout.php">Log Out</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <ul class="nav">
                        <li>
                            <a href="./athleteAllCompetitions.php">
                                <i class="material-icons">public</i>
                                <p>ALL COMPETITIONS</p>
                            </a>
                        </li>
                        <li  class="active">

                            <a href="./athleteCompetitions.php">
                                <i class="material-icons">dashboard</i>
                                <p>MY COMPETITIONS</p>

                            </a>
                        </li>


                    </ul>
                </div>
            </div>
            <div class="main-panel">
                <nav class="navbar navbar-transparent navbar-absolute">
                    <div class="container-fluid">
                        <div class="navbar-minimize">
                            <button id="minimizeSidebar" class="btn btn-round btn-white btn-fill btn-just-icon">
                                <i class="material-icons visible-on-sidebar-regular">more_vert</i>
                                <i class="material-icons visible-on-sidebar-mini">view_list</i>
                            </button>
                        </div>
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="#"> SUBMIT SCORES </a>
                        </div>

                    </div>
                </nav>
                <div class="content">
                    <div class="container-fluid">




                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-header card-header-tabs" data-background-color="oxfordblue">
                                    <div class="nav-tabs-navigation">
                                        <div class="nav-tabs-wrapper">
                                            <span class="nav-tabs-title"><b>DIVISIONS</b></span>
                                            <ul class="nav nav-tabs" data-tabs="tabs">

                                                <?php
                                                $sql_div = "SELECT distinct div_name, div_ID, div_is_team FROM `tbl_division` join tbl_team_division on tbl_division.div_ID = tbl_team_division.fk_div_ID"
                                                        . " join tbl_team on tbl_team_division.fk_team_ID = tbl_team.team_ID"
                                                        . " join tbl_team_member on tbl_team.team_ID = tbl_team_member.fk_team_ID"
                                                        . " where tbl_team_member.fk_athlete_ID =? and fk_comp_id = ?";


                                                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                                $q_div = $pdo->prepare($sql_div);
                                                $q_div->execute(array($_SESSION['athlete_id'], $compID));

                                                $arrayDiv = array();
                                                $counter = 0;

                                                while ($zeile = $q_div->fetch(/* PDO::FETCH_ASSOC */)) {
                                                    $divID = $zeile['div_ID'];
                                                    $divName = $zeile['div_name'];
                                                    $divIsTeam = $zeile['div_is_team'];
                                                    $arrayDiv[$counter] = $divID;

                                                    if ($counter == 0) {
                                                        $liActive = 'active';
                                                    } else {
                                                        $liActive = '';
                                                    }
                                                    $counter++;
                                                    ?>

                                                    <li class="<?php echo $liActive ?>">
                                                        <a href="#WDiv<?php echo $divID ?>" data-toggle="tab">
                                                            <?php echo $divName; ?>
                                                            <div class="ripple-container"></div>
                                                        </a>
                                                    </li>
                                                    <?php
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

                                            echo "<div class =\"tab-pane WDiv$valueDiv $paneActive\" id =\"WDiv$valueDiv\">";
                                            ?> 



                                            <div class="table-responsive">
                                                <table class="table" style="table-layout:fixed">
                                                    <thead>
                                                        <tr><th>WOD NAME

                                                            </th>
                                                            
                                                            <th>WOD DESCRIPTION

                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php
                                                        $sql_wod = "select wod_ID, wod_desc,wod_name from tbl_wod where fk_div_id = ?";
                                                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                                        $q_wod = $pdo->prepare($sql_wod);
                                                        $q_wod->execute(array($valueDiv));

                                                        while ($zeile = $q_wod->fetch(/* PDO::FETCH_ASSOC */)) {
                                                            $wodID = $zeile['wod_ID'];
                                                            $wodName = $zeile['wod_name'];
                                                            $wodDesc = $zeile['wod_desc'];
                                                            $wodDescFormatted = nl2br(htmlentities($wodDesc, ENT_QUOTES, 'UTF-8'));
                                                            ?>
                                                            <tr>

                                                                <td class="td-actions text-left" >

                                                                    <?php echo $wodName ?>

                                                                </td>

                                                                <td><?php echo $wodDescFormatted ?></td>
                                                                <td class=" text-right">
                                                                    <form name="submitScoreForWod" action = "athleteSubmitScoreForWod.php" method="POST" role="form">
                                                                        <input type="hidden" name="wodID" class="form-control" value="<?php echo $wodID ?>" >
                                                                        <input type="hidden" name="divIsTeam" class="form-control" value="<?php echo $divIsTeam ?>" >

                                                                        <button type="submit"  rel="tooltip" class="btn btn-lg btn-pinterest" title="ADD SCORE">
                                                                            <i class="material-icons">input</i>
                                                                        </button>
                                                                    </form>
                                                                </td>
                                                            </tr>

                                                            <?php
                                                        }
                                                        Database::disconnect();
                                                        ?>

                                                    </tbody>
                                                </table>
                                            </div>
                                            <?php
                                            $counter++;
                                            echo "</div>";
                                        }
                                        Database::disconnect();
                                        ?>


                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

                <footer class="footer">
                    <div class="container-fluid">

                        <p class="copyright pull-right">
                            &copy;
                            <script>
                                document.write(new Date().getFullYear())
                            </script>
                            <a>champscore</a>
                        </p>
                    </div>
                </footer>
            </div>
        </div>


    </body>
    <!--   Core JS Files   -->
    <script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui.min.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <script src="js/material.min.js" type="text/javascript"></script>
    <script src="js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
    <!-- Forms Validations Plugin -->
    <script src="js/jquery.validate.min.js"></script>
    <!--  Plugin for Date Time Picker and Full Calendar Plugin-->
    <script src="js/moment.min.js"></script>
    <!--  Charts Plugin -->
    <script src="js/chartist.min.js"></script>
    <!--  Plugin for the Wizard -->
    <script src="js/jquery.bootstrap-wizard.js"></script>
    <!--  Notifications Plugin    -->
    <script src="js/bootstrap-notify.js"></script>
    <!-- DateTimePicker Plugin -->
    <script src="js/bootstrap-datetimepicker.js"></script>
    <!-- Vector Map plugin -->
    <script src="js/jquery-jvectormap.js"></script>
    <!-- Sliders Plugin -->
    <script src="js/nouislider.min.js"></script>
    <!--  Google Maps Plugin    -->
    <script src="https://maps.googleapis.com/maps/api/js"></script>
    <!-- Select Plugin -->
    <script src="js/jquery.select-bootstrap.js"></script>
    <!--  DataTables.net Plugin    -->
    <script src="js/jquery.datatables.js"></script>
    <!-- Sweet Alert 2 plugin -->
    <script src="js/sweetalert2.js"></script>
    <!--	Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
    <script src="js/jasny-bootstrap.min.js"></script>
    <!--  Full Calendar Plugin    -->
    <script src="js/fullcalendar.min.js"></script>
    <!-- TagsInput Plugin -->
    <script src="js/jquery.tagsinput.js"></script>
    <!-- Material Dashboard javascript methods -->
    <script src="js/material-dashboard.js"></script>
    <!-- Material Dashboard DEMO methods, don't include it in your project! -->
    <script src="js/demo.js"></script>

</html>