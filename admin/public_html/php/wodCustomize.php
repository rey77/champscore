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

        <script type="text/javascript">

            //Funktion zur Prüfung der Registrierungsdaten
            function deleteDiv(div_ID)
            {

                var del_div_id = div_ID;
                var info = 'div_ID=' + del_div_id;
                if (confirm("Sure you want to delete this Division? This cannot be undone later.")) {
                    $.ajax({
                        type: "POST",
                        url: "deleteDiv.php", //URL to the delete php script
                        data: info,
                        success: function () {
                            $("#rowDiv" + del_div_id).animate("fast").animate({
                                opacity: "hide"
                            }, "slow");
                            window.location.reload(false);
                        },
                        error: function () {
                            alert("Fehler")
                        },
                    });
                }
                return false;
            }

            function deleteEvt(evt_ID)
            {

                var del_evt_id = evt_ID;
                var info = 'evt_ID=' + del_evt_id;
                if (confirm("Sure you want to delete this Event? This cannot be undone later.")) {
                    $.ajax({
                        type: "POST",
                        url: "deleteEvt.php", //URL to the delete php script
                        data: info,
                        success: function () {
                            $("#rowEvt" + del_evt_id).animate("fast").animate({
                                opacity: "hide"
                            }, "slow");
                            window.location.reload(false);
                            // window.location.reload(false);

                        },
                        error: function () {
                            alert("Fehler")
                        },
                    });
                }
                return false;
            }
            function deleteWod(wod_ID)
            {

                var del_wod_id = wod_ID;
                var info = 'wod_ID=' + del_wod_id;
                if (confirm("Sure you want to delete this WOD? This cannot be undone later.")) {
                    $.ajax({
                        type: "POST",
                        url: "deleteWod.php", //URL to the delete php script
                        data: info,
                        success: function () {
                            $("#rowWod" + del_wod_id).animate("fast").animate({
                                opacity: "hide"
                            }, "slow");
                            window.location.reload(false);
                        },
                        error: function () {
                            alert("Fehler")
                        },
                    });
                }
                return false;
            }

            function deleteAthlete(athlete_ID)
            {

                var del_athlete_id = athlete_ID;
                var info = 'athlete_ID=' + del_athlete_id;
                if (confirm("Sure you want to remove this Athlete? This cannot be undone later.")) {
                    $.ajax({
                        type: "POST",
                        url: "deleteAthlete.php", //URL to the delete php script
                        data: info,
                        success: function () {
                            $("#rowAthlete" + del_athlete_id).animate("fast").animate({
                                opacity: "hide"
                            }, "slow");
                            // window.location.reload(false);

                        },
                        error: function () {
                            alert("Fehler")
                        },
                    });
                }
                return false;
            }

            $(document).ready(function () {
                $(function () {
                    $('[data-toggle="tooltip"]').tooltip()
                })

            });
        </script>
    </head>

    <body>

        <?php
        $compID = $_GET['comp_id'];

        include 'Database.php';
        $pdo = Database::connect();
        ?>

        <div class="wrapper">
            <div class="sidebar" data-active-color="darkred" data-background-color="black" data-image="img/sidebar-1.jpg">
                <!--
            Tip 1: You can change the color of active element of the sidebar using: data-active-color="purple | blue | green | orange | red | rose"
            Tip 2: you can also add an image using data-image tag
            Tip 3: you can change the color of the sidebar with data-background-color="white | black"
                -->
                <div class="logo">
                    <a href="index.php" class="simple-text">
                        <p><!--<img style=" margin-left: -20px; height: 70px;" class="logo" src="../img/Logo.png" alt=""/>-->
                            <img style="  height: 20px;" src="img/text.png" alt=""/></p>
                    </a>

                </div>
                <div class="logo logo-mini">
                    <a href="index.php" class="simple-text">
                        CS
                    </a>
                </div>
                <div class="sidebar-wrapper">
                    <div class="user">
                        <div class="photo">
                            <img src="uploads/profile/<?php echo $_SESSION['user_id'] . ".jpg" ?>">
                        </div>
                        <div class="info">
                            <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                                <?php echo $_SESSION['username']; ?>
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
                            <a class="navbar-brand" href="#"> Divisions, Events, WODs </a>
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

                        <p>Your Divisions, Events, Workouts are listed here.</p>

                        <form name ="newDiv" role="form" action="newDivision.php" method="POST">
                            <div style="display:none;">
                                <input type="hidden" name="compID" class="form-control" value="<?php echo $compID ?>" >
                            </div>
                            <button type ="submit" class="btn btn-pinterest" data-toggle="tooltip" data-placement="right" title="Add new Division" >Division <i class="material-icons">add</i></button>

                        </form>
                        <br>


                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-header card-header-tabs" data-background-color="oxfordblue">
                                    <div class="nav-tabs-navigation">
                                        <div class="nav-tabs-wrapper">
                                            <span class="nav-tabs-title"><b>Divisions</b></span>
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
                                    <div class="table-responsive">
                                        <table class="table" style="table-layout:fixed">

                                            <tbody>
                                                <tr>

                                                    <td class="td-actions text-left">

                                                        <form name="editDiv" action = "editDivision.php" method="POST" role="form">
                                                            <div style="display:none;"><input type="hidden" name="divID" class="form-control" value="<?php echo $divID ?>">
                                                            </div>
                                                            Division
                                                            <button type="submit" rel="tooltip" class="btn btn-round" title="Edit this Division">
                                                                <i class="material-icons">edit</i>
                                                            </button>

                                                            <button type="button" onclick="deleteDiv(<?php echo $divID ?>)" rel="tooltip" class="btn btn-round btn-danger" title="Delete this Division">
                                                                <i class="material-icons">delete</i>
                                                            </button>

                                                        </form>

                                                        <hr>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
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
                                                        <tr>
                                                            <th class= "td-actions"><form name="newWod" action = "newWod.php" method="POST" role="form">
                                                            <div style="display:none;">
                                                                <input type="hidden" name="divID" class="form-control" value="<?php echo $divID ?>" >
                                                                <input type="hidden" name="compID" class="form-control" value="<?php echo $compID ?>" >
                                                            </div>
                                                            WOD
                                                            <button type="submit" rel="tooltip" class="btn btn-round btn-success" title="Add WOD" >
                                                                <i class="material-icons">add</i>
                                                            </button>

                                                        </form></th>

                                                            <th>Description</th>
                                                            <th></th>
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
                                                            ?>
                                                            <tr>

                                                                <td class="td-actions text-left" >

                                                                    <form name="editWod" action = "editWod.php" method="POST" role="form">

                                                                        <div style="display:none;">
                                                                            <input type="hidden" name="wodID" class="form-control" value="<?php echo $wodID ?>" >
                                                                            <input type="hidden" name="compID" class="form-control" value="<?php echo $compID ?>" >
                                                                        </div>
                                                                        <?php echo $wodName ?>
                                                                        <button type="submit" rel="tooltip" class="btn btn-round" title="Edit this WOD">
                                                                            <i class="material-icons">edit</i>
                                                                        </button>

                                                                    </form>
                                                                </td>
                                                                <td><?php echo $wodDesc ?></td>
                                                                <td class="td-actions text-right">
                                                                    <button type="button" onclick="deleteWod(<?php echo $wodID ?>);" rel="tooltip" class="btn btn-round btn-danger" title="Delete this WOD">
                                                                        <i class="material-icons">delete</i>
                                                                    </button>
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