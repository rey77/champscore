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
        <title>champscore</title>
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
        $compID = $_GET['comp_ID'];

        include 'Database.php';
        $pdo = Database::connect();


        $sql_div = "SELECT div_name, div_ID FROM `tbl_division` where fk_comp_id = ?";

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $q_div = $pdo->prepare($sql_div);
        $q_div->execute(array($compID));

        $arrayDiv = array();
        $counter = 0;
        ?>

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
                                        <a href="loginsec/logout.php">Log out</a>
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
                        <li class="active">

                            <a  href="./hostCompetitions.php">
                                <i class="material-icons">dashboard</i>
                                <p>My Competitions
                                </p>
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
                            <a class="navbar-brand" href="#"> Ticketing </a>
                        </div>

                    </div>
                </nav>
                <div class="content">
                    <div class="container-fluid">


                        <div class="row">

                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header card-header-text" data-background-color="oxfordblue">
                                        <h4 class="card-title">Divisions</h4>


                                    </div>

                                    <div class="card-content">

                                        <form name ="competitionTicketing" role="form" action="updateTicketing.php" method="POST" >

                                            <?php
                                            while ($zeile = $q_div->fetch(/* PDO::FETCH_ASSOC */)) {
                                                $divID = $zeile['div_ID'];
                                                $divName = $zeile['div_name'];
                                                ?>
                                                <div class = "row">
                                                    <div class = "col-lg-12">
                                                        <h3><?php echo $divName ?></h3>

                                                        <input type="hidden" name="compID" class="form-control" value="<?php echo $compID ?>" />
                                                        <div class="col-lg-4 form-group">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="optionsCheckboxes"> Free
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 form-group label-floating">
                                                            <label class="control-label">Price in US $</label>
                                                            <input class="form-control" type="text" name="divisionTicketAmount" />
                                                        </div>


                                                    </div>

                                               

                                            </div>
                                            <hr>
 <?php } ?>


                                            <button type="submit" class="btn pull-right btn-fill btn-pinterest">Save</button>

                                        </form>

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

        <div class="modal fade" id="modal-7">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Athlete info</h4>
                    </div>

                    <div class="modal-body">



                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-pinterest" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>




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
        <script src="js/bootstrap.min.js"></script>

    </body>

</html>