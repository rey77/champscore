<?php
session_start();

if ($_SESSION['eingeloggt'] == false) {

    header("Location: public_html/index.php");
    exit();
}

$hostID = $_SESSION['host_id'];
include 'Database.php';
$pdo = Database::connect();

$sql = "select * from tbl_competition";
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$q = $pdo->prepare($sql);
$q->execute();

Database::disconnect();
?>

<!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <link rel="apple-touch-icon" sizes="76x76" href="img/apple-icon.png" />
        <link rel="icon" type="image/png" href="img/favicon-16x16.png" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>All Competitions</title>
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

        <link href="php/css/material-kit.css?v=1.1.0" rel="stylesheet"/>

        <link href="../assets/css/styles.css" type="text/css" rel="stylesheet"/>

        <!--   Core JS Files   -->
        <script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
        <script src="js/jquery-ui.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/material.min.js" type="text/javascript"></script>
        <script src="js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
        <script src="js/jquery.autocomplete.min.js" type="text/javascript"></script>


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
                        <li class="active">
                            <a href="./hostAllCompetitions.php">
                                <i class="material-icons">public</i>
                                <p>ALL COMPETITIONS</p>
                            </a>
                        </li>
                        <li>

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
                            <a class="navbar-brand" href="#"> ALL COMPETITIONS </a>
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
                            <div class="col-md-8 col-md-offset-2 text-center">
                                <h2 class="title"><i class="material-icons">public</i> ALL COMPETITIONS</h2>
                                <h5 class="description">WE ARE HAPPY TO HOST COMPETITIONS AROUND THE GLOBE.</h5>
                            </div>

                            <script>
                                $(function () {
                                    var url = "json_comp.php";

                                    $.getJSON(url, function (result) {
                                        var comp = [];
                                        $.each(result, function (i, field) {
                                            comp.push(field.comp_name);
                                        });

                                        $('#autocomplete').autocomplete({
                                            lookup: comp,
                                            onSelect: function (suggestion) {
                                                $.each(result, function (i, field) {
                                                    if(field.comp_name === suggestion.value) {
                                                        window.location.href = 'competitionView.php?comp_id=' + field.comp_id;
                                                    }
                                                });
                                            }
                                        });
                                    });
                                });
                            </script>
                            <form class="navbar-form navbar-right search-form" role="search">
                                <div class="form-group form-search is-empty field-container" id="search">
                                    <input type="text" class="form-control search-field" placeholder="Search for Competition" id="autocomplete">
                                </div>
                            </form>
                        </div>

                        <div class="row">
                            <div id="tabs-container" class="tabs-container-athlete">
                                <ul class="tabs-menu">
                                    <li><a href="#tab-1">Past</a></li>
                                    <li class="current"><a href="#tab-2">Now</a></li>
                                    <li><a href="#tab-3">Future</a></li>
                                </ul>
                                <div class="tab">
                                    <?php
                                    include 'showCompetitions.php';
                                    $competitions = getCompetitionsFromDB();
                                    $past = addCompToPast($competitions);
                                    $now = addCompToNow($competitions);
                                    $future = addCompToFuture($competitions);
                                    ?>
                                    <div id="tab-1" class="tab-content">
                                        <?php
                                        showCompetitionsInAthleteAndHostSite($past);
                                        ?>
                                    </div>

                                    <div id="tab-2" class="tab-content">
                                        <?php
                                        showCompetitionsInAthleteAndHostSite($now);
                                        ?>
                                    </div>

                                    <div id="tab-3" class="tab-content">
                                        <?php
                                        showCompetitionsInAthleteAndHostSite($future);
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <script>
                                $(document).ready(function() {
                                    $(".tabs-menu a").click(function(event) {
                                        event.preventDefault();
                                        $(this).parent().addClass("current");
                                        $(this).parent().siblings().removeClass("current");
                                        var tab = $(this).attr("href");
                                        $(".tab-content").not(tab).css("display", "none");
                                        $(tab).fadeIn();
                                    });
                                });
                            </script>
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
    <script src="js/jquery.autocomplete.min.js" type="text/javascript"></script>
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