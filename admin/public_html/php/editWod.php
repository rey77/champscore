<?php
session_start();

if ($_SESSION['eingeloggt'] == false) {

    header("Location: public_html/index.php");
    exit();
}

$wodID = $_POST['wodID'];
$compID = $_POST['compID'];

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



    $wodDurationSec = gmdate("s", $wodDuration);
    $wodDurationMin = gmdate("i", $wodDuration);
}

Database::disconnect();
?>
<html lang="en">

    <head>
        <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js'></script>
        <meta charset="utf-8" />
        <link rel="apple-touch-icon" sizes="76x76" href="img/apple-icon.png" />
        <link rel="icon" type="image/png" href="img/favicon-16x16.png" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>edit Wod</title>
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

            $(function () {


                $('input:radio[name="wodType"][value="<?php echo $wodType ?>"]').prop('checked', true);


                if (<?php echo $wodType ?> == 1) {

                    $("#wodMaxReps").show();

                } else {

                    $("#wodMaxReps").hide();

                }


                if (<?php echo $wodIsPublished ?> == true) {


                    $("#wodIsPublished").prop("checked", true);


                } else {
                    $("#wodIsPublished").prop("checked", false);

                }
            });

            function radioClick(myRadio)
            {
                

                if (myRadio.value == 1) {
                    $("#wodMaxReps").show();

                } else
                {
                    $("#wodMaxReps").hide();

                }

            }

        </script>
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
                            <img src="uploads/profile/<?php echo $_SESSION['host_id'] . ".jpg" ?>">
                        </div>
                        <div class="info">
                            <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                                <?php echo $_SESSION['hostName']; ?>
                                <b class="caret"></b>
                            </a>
                            <div class="collapse" id="collapseExample">
                                <ul class="nav">
                                    <li>
                                        <a href="#">My Profile</a>
                                    </li>
                                    <li>
                                        <a href="#">Edit Profile</a>
                                    </li>
                                    <li>
                                        <a href="#">Settings</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <ul class="nav">
                        <li>
                            <a href="./hostAllCompetitions.php">
                                <i class="material-icons">public</i>
                                <p>All Competitions</p>
                            </a>
                        </li>
                        <li  class="active">
                            
                            <a href="./hostCompetitions.php">
                                <i class="material-icons">dashboard</i>
                               <p>My Competitions</p>
                            
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
                            <a class="navbar-brand" href="#"> Division </a>
                        </div>
                        <div class="collapse navbar-collapse">
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
                        </div>
                    </div>
                </nav>
                <div class="content">
                    <div class="container-fluid">


                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-text" data-background-color="oxfordblue">
                                    <h4 class="card-title">Edit WOD</h4>

                                </div>
                                <div class="card-content">

                                    <form name ="formWodData" role="form" action="updateWod.php" method="POST" >

                                        <div class="form-group label-floating">
                                            <label class="control-label">WOD Name</label>
                                            <input type="text" name="wodName"  class="form-control" value="<?php echo $wodName ?>" required>
                                            <!--<p class="help-block">Example block-level help text here.</p>-->
                                        </div>
                                        <div class="form-group label-floating">
                                            <label class="control-label">WOD Description</label>
                                            <textarea class="form-control" style="height: 150px; resize: none" name="wodDescription" required><?php echo $wodDesc ?></textarea>
                                                                                        <!--<p class="help-block">Example block-level help text here.</p>-->
                                        </div>

                                        <div class="form-group label-floating">
                                            <label class="control-label">WOD Duration (Minutes)</label>

                                            <input type="text" name="wodDurationMin"  class="form-control"  value="<?php echo $wodDurationMin ?>" placeholder="Minutes" required >
                                        </div>
                                        <div class="form-group label-floating">
                                            <label class="control-label">WOD Duration (Seconds)</label>
                                            <input type="text" name="wodDurationSec"  class="form-control"  value="<?php echo $wodDurationSec ?>"  placeholder="Seconds" required >

                                        </div>
                                        <div class="form-group label-floating">
                                            <label class="control-label">WOD Type</label>
                                            <br>
                                            <label class="radio-inline">
                                                <input type="radio" name="wodType" id="fortimeRadio" value="1" onclick="radioClick(this)" checked>For Time
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="wodType" id="amrapRadio" onclick="radioClick(this)" value="2">AMRAP
                                            </label>
                                            <input type="hidden" name="wodID" value="<?php echo $wodID ?>" class="form-control" >
                                            <input type="hidden" name="compID" value="<?php echo $compID ?>" class="form-control" >
                                        </div>

                                        <div class="form-group label-floating" id="wodMaxReps">
                                            <label class="control-label">Max Reps possible</label>
                                            <input type="text" name="wodMaxReps"  class="form-control" placeholder="Reps" value="<?php echo $wodMaxReps ?>">
                                        </div>

                                        <div class="form-group" >

                                            <label>Publish<input type="checkbox" id="wodIsPublished"  name="wodIsPublished" class="form-control">
                                            </label>
                                            <!--<p class="help-block">Example block-level help text here.</p>-->
                                        </div>



                                        <button type="submit" class="pull-right btn btn-pinterest">Save</button>

                                    </form>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <footer class="footer">
                    <div class="container-fluid">
                        <nav class="pull-left">
                            <ul>
                                <li>
                                    <a href="#">
                                        Home
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        Company
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        Portfolio
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        Blog
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        <p class="copyright pull-right">
                            &copy;
                            <script>
                                document.write(new Date().getFullYear())
                            </script>
                            <a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
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
