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
        <title>Submit Score: </title>
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


        <script type="text/javascript">



            function checkClick()
            {

                if (document.getElementById('CheckTimeCap').checked)
                {
                    $("#wodFTTime").show();
                    $("#wodFTReps").hide();
                } else {

                    $("#wodFTReps").show();
                    $("#wodFTTime").hide();

                }

            }

            document.addEventListener("DOMContentLoaded", function () {
                $("#wodFTTime").hide();
            });

        </script>

    </head>

    <body>

        <?php
        $wodID = $_POST['wodID'];
        $divIsTeam = $_POST['divIsTeam'];

        include 'Database.php';
        $pdo = Database::connect();

        $sql_wod = "select wod_ID, wod_name, wod_desc, wod_duration, wod_max_reps, wod_type, wod_is_published from tbl_wod where wod_id = ?";
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $q_wod = $pdo->prepare($sql_wod);
        $q_wod->execute(array($wodID));


        while ($zeile = $q_wod->fetch(/* PDO::FETCH_ASSOC */)) {

            $wodID = $zeile['wod_ID'];
            $wodName = $zeile['wod_name'];
            $wodDesc = $zeile['wod_desc'];
            $wodDuration = $zeile['wod_duration'];
            $wodMaxReps = $zeile['wod_max_reps'];
            $wodType = $zeile['wod_type'];
            $wodIsPublished = $zeile['wod_is_published'];
            $wodDescFormatted = nl2br(htmlentities($wodDesc, ENT_QUOTES, 'UTF-8'));



            $wodDurationSec = gmdate("s", $wodDuration);
            $wodDurationMin = gmdate("i", $wodDuration);
        }
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
                            <a class="navbar-brand" href="#"> SUBMIT SCORE FOR WOD</a>
                        </div>

                    </div>
                </nav>
                <div class="content">
                    <div class="container-fluid">




                        <div class="col-lg-8 col-md-8">
                            <div class="card">
                                <div class="card-header card-header-text" data-background-color="oxfordblue">
                                    <h4 class="card-title">DESCRIPTION & STANDARDS</h4>

                                </div>
                                <div class="card-content">

                                    <div class="row">

                                        <div class="col-lg-12" >

                                            <h3>DESCRIPTION & STANDARDS </h3>

                                            <p><?php echo $wodDescFormatted ?></p>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4">
                            <div class="card">

                                <div class="card-content">

                                    <form name ="compData" role="form" action="inputScoreQualifier.php" method="POST" enctype="multipart/form-data">
                                        <div class="row">


                                            <div class="col-lg-12" >

                                                <h3>YOUR RESULT </h3>
                                                <?php if ($wodType == 1) { ?>

                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" id="CheckTimeCap"  onclick="return checkClick();"> FINISHED BEFORE TIMECAP
                                                        </label>
                                                    </div>
                                                    <div class="form-group label-floating" id="wodFTTime">
                                                        <label class="control-label">TIME</label>

                                                        <input type="text" name="wodTime"  class="form-control"  required>
                                                    </div>

                                                    <div class="form-group label-floating" id="wodFTReps">
                                                        <label class="control-label">NUMBER OF REPS</label>

                                                        <input type="text" name="wodResult"  class="form-control"  required>
                                                    </div>

                                                <?php } else { ?>

                                                    <div class="form-group label-floating">
                                                        <label class="control-label">NUMBER OF REPS</label>

                                                        <input type="text" name="wodResult"  class="form-control"  required>
                                                    </div>
                                                <?php } ?>


                                                <div class="form-group label-floating">
                                                    <label class="control-label">YOUTUBE LINK TO VIDEO</label>

                                                    <input type="text" name="wodResult"  class="form-control"  required>
                                                </div>
                                            </div>


                                        </div>
                                        <input type="hidden" name="divIsTeam" class="form-control" value="<?php echo $divIsTeam ?>" >


                                        <button type="submit" class="btn pull-right btn-fill btn-pinterest">Submit</button>

                                    </form>

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