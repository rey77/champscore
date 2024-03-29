<?php
session_start();

if ($_SESSION['eingeloggt'] == false) {

    header("Location: public_html/index.php");
    exit();
}

$hostID = $_SESSION['host_id'];
include 'Database.php';
$pdo = Database::connect();

$sql = "select comp_ID, comp_name, comp_start_date, comp_logo, comp_city, comp_country, comp_active from tbl_competition where fk_host_id = ?";
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$q = $pdo->prepare($sql);
$q->execute(array($hostID));

Database::disconnect();
?>

<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <link rel="apple-touch-icon" sizes="76x76" href="img/apple-icon.png" />
        <link rel="icon" type="image/png" href="img/favicon-16x16.png" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>My Competitions</title>
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
        <div class="wrapper">

            <div class="sidebar" data-active-color="darkred" data-background-color="black" data-image="img/sidebar-1.jpg">
                <!--
            Tip 1: You can change the color of active element of the sidebar using: data-active-color="purple | blue | green | orange | red | rose"
            Tip 2: you can also add an image using data-image tag
            Tip 3: you can change the color of the sidebar with data-background-color="white | black"
                -->
                <div class="logo">
                    <a href="hostIndex.php" class="simple-text">
                        <p><!--<img style=" margin-left: -20px; height: 70px;" class="logo" src="../img/Logo.png" alt=""/>-->
                            <img style="  height: 20px;" src="img/text.png" alt=""/></p>
                    </a>

                </div>
                <div class="logo logo-mini">
                    <a href="hostIndex.php" class="simple-text">
                        CS
                    </a>
                </div>
                <div class="sidebar-wrapper">
                    <div class="user">
                        <div class="photo">
                            <img src="uploads/host/profile/<?php echo $_SESSION['host_id'] . ".jpg" ?>">
                        </div>
                        <div class="info">
                            <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                                <?php echo $_SESSION['hostEmail']; ?>
                                <b class="caret"></b>
                            </a>
                            <div class="collapse" id="collapseExample">
                                <ul class="nav">

                                    <li>
                                        <a href="hostPersonalData.php">Edit Profile</a>
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
                            <a href="./hostAllCompetitions.php">
                                <i class="material-icons">public</i>
                                <p>ALL COMPETITIONS</p>
                            </a>
                        </li>
                        <li  class="active">

                            <a href="./hostCompetitions.php">
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
                            <a class="navbar-brand" href="#"> MY COMPETITIONS </a>
                        </div>
                        <!--<div class="collapse navbar-collapse">
                            <ul class="nav navbar-nav navbar-right">
                                <li>
                                    <a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="material-icons">dashboard</i>
                                        <p class="hidden-lg hidden-md">Dashboard</p>
                                    </a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="material-icons">notifications</i>
                                        <span class="notification">5</span>
                                        <p class="hidden-lg hidden-md">
                                            Notifications
                                            <b class="caret"></b>
                                        </p>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="#">Mike John responded to your email</a>
                                        </li>
                                        <li>
                                            <a href="#">You have 5 new tasks</a>
                                        </li>
                                        <li>
                                            <a href="#">You're now friend with Andrew</a>
                                        </li>
                                        <li>
                                            <a href="#">Another Notification</a>
                                        </li>
                                        <li>
                                            <a href="#">Another One</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="material-icons">person</i>
                                        <p class="hidden-lg hidden-md">Profile</p>
                                    </a>
                                </li>
                                <li class="separator hidden-lg hidden-md"></li>
                            </ul>
                            <form class="navbar-form navbar-right" role="search">
                                <div class="form-group form-search is-empty">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <span class="material-input"></span>
                                </div>
                                <button type="submit" class="btn btn-white btn-round btn-just-icon">
                                    <i class="material-icons">search</i>
                                    <div class="ripple-container"></div>
                                </button>
                            </form>
                        </div>-->
                    </div>
                </nav>
                <div class="content">
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-lg-12">

                                <p>CUSTOMIZE YOUR COMPETITIONS. YOU CAN ADD NEW COMPETITIONS AND EDIT EXISTING ONES</p>


                               <!-- <div class ="dropdown">
                                    <button class = "btn btn-pinterest dropdown-toggle" type = "button" data-toggle = "dropdown">NEW COMPETITION
                                        <span class = "caret"></span></button>

                                    <ul class = "dropdown-menu">
                                        <li><a href = "newCompetition.php">New</a></li>
                                    </ul>
                                </div>-->

                                <form method="POST" action='newCompetition.php'>

                                    <button type ="submit" class="btn btn-pinterest" data-toggle="tooltip" data-placement="right" title="Create Competition" >New Competition</button>


                                </form>


                            </div>

                        </div>
                        <br>
                        <?php
                        while ($zeile = $q->fetch(/* PDO::FETCH_ASSOC */)) {


                            $compLogo = $zeile['comp_logo'];
                            if ($compLogo != 0) {
                                $logosrc = "uploads/host/complogo/$compLogo";
                            } else {
                                $logosrc = "img/image_placeholder.jpg";
                            }

                            $originalDate = $zeile['comp_start_date'];
                            $newDate = date("d.m.Y", strtotime($originalDate));
                            ?>



                            <div class="col-md-4">
                                <div class="card card-product">
                                    <div class="card-image" data-header-animation="true">
                                        <a href="#pablo">
                                            <img class="img" src="<?php echo $logosrc ?>">
                                        </a>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-actions">

                                            <div class ="dropdown">
                                                <button class = "btn btn-pinterest dropdown-toggle" type = "button" data-toggle = "dropdown">Options
                                                    <span class = "caret"></span></button>

                                                <ul class = "dropdown-menu">
                                                    <li><a href = "editCompetition.php?comp_id=<?php echo $zeile['comp_ID'] ?>"  >EDIT COMPETITION</a></li>
                                                    <li><a href = "wodCustomize.php?comp_id=<?php echo $zeile['comp_ID'] ?>" >DIVISIONS & WODS</a></li>
                                                    <li><a href = "athletesCustomize.php?comp_id=<?php echo $zeile['comp_ID'] ?>"  >ATHLETES AND TEAMS</a></li>
                                                    <li><a href = "competitionAddScore.php?comp_ID=<?php echo $zeile['comp_ID'] ?>"  >SCORES</a></li>
                                                    <li><a href = "competitionScoresheets.php?comp_ID=<?php echo $zeile['comp_ID'] ?>"  >SCORESHEETS</a></li>
    <!--<li><a href = "competitionTicketing.php?comp_ID=<?php echo $zeile['comp_ID'] ?>"  >TICKETING</a></li>-->
    <!-- <li><a href = "scoreboardCustomize.php?comp_id=<?php echo $zeile['comp_ID'] ?>"  >Leaderboard</a>-->
    <!--<li><a href = "javascript:;" onclick="deleteComp(<?php echo $zeile['comp_ID'] ?>);" > Delete Competition</a>-->
                                                </ul>
                                            </div>

                                        </div>
                                        <h4 class="card-title" style="text-overflow: ellipsis;
                                            white-space: nowrap;">
                                            <a href="competitionView.php?comp_id=<?php echo $zeile['comp_ID'] ?>"><?php echo $zeile['comp_name'] ?></a>
                                        </h4>
                                        <div class="card-description">

                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="price">
                                            <h4><?php echo $newDate ?></h4>
                                        </div>
                                        <div class="stats pull-right">
                                            <p class="category"><i class="material-icons">place</i><?php echo $zeile['comp_city'] ?>, <?php echo $zeile['comp_country'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>




                            <?php
                        }
                        ?>


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


    <script type="text/javascript">
                                $(document).ready(function () {

                                    // Javascript method's body can be found in assets/js/demos.js
                                    demo.initDashboardPageCharts();

                                    demo.initVectorMap();
                                });


    </script>


    <script type="text/javascript">

//Funktion zur Prüfung der Registrierungsdaten
        function deleteComp(comp_ID)
        {

            var del_comp_id = comp_ID;
            var info = 'comp_ID=' + del_comp_id;

            if (confirm("Sure you want to delete this Competition? This cannot be undone later.")) {
                alert(info);
                $.ajax({
                    type: "POST",
                    url: "deleteComp.php", //URL to the delete php script
                    data: info,
                    success: function () {
                        window.location.reload(false);
                    },
                    error: function () {
                        alert("Fehler")
                    },
                });

            }
            return false;


        }
    </script>
</html>