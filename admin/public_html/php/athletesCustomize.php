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
        <title>Athletes</title>
        <meta contenat='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
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
                            window.location.reload(false);

                        },
                        error: function () {
                            alert("Fehler")
                        },
                    });

                }
                return false;


            }

            function deleteTeam(team_ID)
            {

                var del_team_id = team_ID;
                var info = 'team_ID=' + del_team_id;

                if (confirm("Sure you want to remove this Team? This cannot be undone later.")) {
                    $.ajax({
                        type: "POST",
                        url: "deleteTeam.php", //URL to the delete php script
                        data: info,
                        success: function () {
                            $("#rowTeam" + del_team_id).animate("fast").animate({
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

            $(document).ready(function () {
                $(function () {
                    $('[data-toggle="tooltip"]').tooltip()
                })
                if (location.hash) {
                    $("a[href='" + location.hash + "']").tab("show");
                }
                $(document.body).on("click", "a[data-toggle]", function (event) {
                    location.hash = this.getAttribute("href");
                });
            });
            $(window).on("popstate", function () {
                var anchor = location.hash || $("a[data-toggle='tab']").first().attr("href");
                $("a[href='" + anchor + "']").tab("show");
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
                            <img src="uploads/profile/<?php echo $_SESSION['host_id'] . ".jpg" ?>">
                        </div>
                        <div class="info">
                            <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                                <?php echo $_SESSION['hostEmail']; ?>
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
                            <a class="navbar-brand" href="#"> Athletes & Teams </a>
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


                        <div class="row">

                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header card-header-tabs" data-background-color="oxfordblue" >
                                        <div class="nav-tabs-navigation">
                                            <div class="nav-tabs-wrapper">
                                                <span class="nav-tabs-title"><b>Divisions </b></span>
                                                <ul class="nav nav-tabs" data-tabs="tabs" >
                                                    <?php
                                                    $sql_div = "select div_ID, div_name, div_is_team from tbl_division where fk_comp_id = ?";
                                                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                                    $q_div = $pdo->prepare($sql_div);
                                                    $q_div->execute(array($compID));
                                                    $tabCounter = 1;
                                                    while ($zeile = $q_div->fetch(PDO::FETCH_ASSOC)) {
                                                        $divID = $zeile['div_ID'];
                                                        $divName = $zeile['div_name'];
                                                        $divIsTeam = $zeile['div_is_team'];

                                                        if ($tabCounter == 1) {

                                                            $tabActive = "active";
                                                        } else {
                                                            $tabActive = "";
                                                        }

                                                        $tabCounter++;
                                                        ?>
                                                        <li class="<?php echo $tabActive ?>">
                                                            <a href="#div<?php echo $divID ?>" data-toggle="tab">
                                                                <?php echo $divName ?>                                                        <div class="ripple-container"></div>
                                                            </a>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-content">

                                        <div class="tab-content">

                                            <?php
                                            $sql_div = "select div_ID, div_name, div_is_team from tbl_division where fk_comp_id = ?";
                                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                            $q_div = $pdo->prepare($sql_div);
                                            $q_div->execute(array($compID));
                                            $divCounter = 1;
                                            while ($zeile = $q_div->fetch(PDO::FETCH_ASSOC)) {
                                                $divID = $zeile['div_ID'];
                                                $divName = $zeile['div_name'];
                                                $divIsTeam = $zeile['div_is_team'];

                                                if ($divCounter == 1) {

                                                    $tabPaneActive = "active";
                                                } else {

                                                    $tabPaneActive = "";
                                                }

                                                $divCounter++;
                                                ?>
                                                <div class="tab-pane <?php echo $tabPaneActive ?>" id="div<?php echo $divID ?>">
                                                    <div class="col-md-12">


                                                        <?php
                                                        if ($divIsTeam) {
                                                            $tblHeader1 = "Team Name";
                                                            $tblHeader2 = "Team Affiliate";
                                                            $tblHeader3 = "Team Members";
                                                            ?>
                                                            <form name="newTeam" action = "newTeam.php" method="POST" role="form">
                                                                <div style="display:none;">
                                                                    <input type="hidden" name="divID" class="form-control" value="<?php echo $divID ?>" >
                                                                    <input type="hidden" name="compID" class="form-control" value="<?php echo $compID ?>" >
                                                                </div>
                                                                <button type="submit" class="btn btn-pinterest" data-toggle="tooltip" data-placement="right" title="Add new Team">Team <i class="material-icons">add</i></button>


                                                            </form>
                                                            <?php
                                                        } else {

                                                            $tblHeader1 = "Athlete Name";
                                                            $tblHeader2 = "Athlete Affiliate";
                                                            $tblHeader3 = "";
                                                            ?>
                                                            <form name="newAthlete" action = "newAthlete.php" method="POST" role="form">
                                                                <div style="display:none;">
                                                                    <input type="hidden" name="divID" class="form-control" value="<?php echo $divID ?>" >
                                                                    <input type="hidden" name="compID" class="form-control" value="<?php echo $compID ?>" >
                                                                </div>
                                                                <button type="submit" class="btn btn-pinterest" data-toggle="tooltip" data-placement="right" title="Add new Athlete">Athlete <i class="material-icons">add</i></button>
                                                            </form>

                                                            <?php
                                                        }
                                                        ?>

                                                        <div class="table-responsive">
                                                            <table class="table">

                                                                <thead>
                                                                <th><?php echo $tblHeader1 ?></th>
                                                                <!--<th><?php echo $tblHeader2 ?></th>-->
                                                                <?php
                                                                if ($tblHeader3 != "") {
                                                                    echo "<th>$tblHeader3</th>";
                                                                }
                                                                ?>
                                                                <th></th>

                                                                </thead>

                                                                <tbody>

                                                                    <?php
                                                                    if ($divIsTeam == true) {


                                                                        $sql_td = "select team_div_ID, fk_team_ID, fk_div_ID from tbl_team_division where fk_div_id = ?";
                                                                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                                                        $q_td = $pdo->prepare($sql_td);
                                                                        $q_td->execute(array($divID));

                                                                        while ($zeile = $q_td->fetch(PDO::FETCH_ASSOC)) {
                                                                            $teamID = $zeile['fk_team_ID'];

                                                                            $sql_team = "select team_ID, team_name, team_affiliate from tbl_team where team_ID = ?";
                                                                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                                                            $q_team = $pdo->prepare($sql_team);
                                                                            $q_team->execute(array($teamID));

                                                                            while ($zeile = $q_team->fetch(PDO::FETCH_ASSOC)) {
                                                                                $teamID = $zeile['team_ID'];
                                                                                $teamName = $zeile['team_name'];
                                                                                $teamBox = $zeile['team_affiliate'];

                                                                                $sql_team_member = "select team_member_ID, fk_athlete_ID from tbl_team_member where fk_team_ID = ?";
                                                                                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                                                                $q_team_member = $pdo->prepare($sql_team_member);
                                                                                $q_team_member->execute(array($teamID));
                                                                                ?>

                                                                                <tr id = "rowathlete"<?php echo $teamID ?> >
                                                                                    <td >
                                                                                        <?php echo $teamName ?>
                                                                                    </td>
                                                                                    
                                                                                    <td>
                                                                                        <?php
                                                                                        while ($zeile = $q_team_member->fetch(PDO::FETCH_ASSOC)) {

                                                                                            $teamMemberID = $zeile['fk_athlete_ID'];
                                                                                            $sql_athlete = "SELECT athlete_ID, athlete_email, athlete_firstname, athlete_lastname FROM `tbl_athlete` where athlete_ID=?";
                                                                                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                                                                            $q_athlete = $pdo->prepare($sql_athlete);
                                                                                            $q_athlete->execute(array($teamMemberID));

                                                                                            while ($zeile = $q_athlete->fetch()) {

                                                                                                $athleteID = $zeile['athlete_ID'];
                                                                                                $athleteFirstName = $zeile['athlete_firstname'];
                                                                                                $athleteLastName = $zeile['athlete_lastname'];


                                                                                                echo $athleteFirstName . " " . $athleteLastName . ", ";
                                                                                            }
                                                                                        }
                                                                                        ?>

                                                                                    </td>
                                                                                    <td class="td-actions text-right">

                                                                                        <form name="editTeam" action = "#" method="POST" role="form">
                                                                                            <div style="display:none;">
                                                                                                <input type="hidden" name="teamID" class="form-control" value="<?php echo $teamID ?>" >
                                                                                                <input type="hidden" name="divID" class="form-control" value="<?php echo $divID ?>">
                                                                                            </div>


                                                                                            <!--<button type="submit" rel="tooltip" class="btn btn-round">
                                                                                                <i class="material-icons">edit</i>
                                                                                            </button>-->
                                                                                            <button type="button" onclick = "deleteTeam(<?php echo $teamID ?>);" rel="tooltip" class="btn btn-round btn-danger">
                                                                                                <i class="material-icons">close</i>
                                                                                            </button>
                                                                                        </form>

                                                                                    </td>
                                                                                </tr>

                                                                                <?php
                                                                            }
                                                                        }
                                                                    } else {
                                                                        $sql_ad = "select athlete_div_ID, fk_athlete_ID, fk_div_ID from tbl_athlete_division where fk_div_id = ?";
                                                                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                                                        $q_ad = $pdo->prepare($sql_ad);
                                                                        $q_ad->execute(array($divID));

                                                                        while ($zeile = $q_ad->fetch(PDO::FETCH_ASSOC)) {
                                                                            $athleteID = $zeile['fk_athlete_ID'];

                                                                            $sql_athl = "select athlete_ID,  athlete_affiliate, athlete_firstname, athlete_lastname from tbl_athlete where athlete_ID = ?";
                                                                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                                                            $q_athl = $pdo->prepare($sql_athl);
                                                                            $q_athl->execute(array($athleteID));

                                                                            while ($zeile = $q_athl->fetch(PDO::FETCH_ASSOC)) {
                                                                                $athleteID = $zeile['athlete_ID'];
                                                                                $athleteName = $zeile['athlete_firstname'] ." ". $zeile['athlete_lastname'] ;
                                                                                $athleteBox = $zeile['athlete_affiliate'];
                                                                                ?>


                                                                                <tr id = "rowteam"<?php echo $athleteID ?> >
                                                                                    <td>
                                                                                        <?php echo $athleteName ?>
                                                                                    </td>
                                                                                  <!--  <td>
                                                                                        <?php echo $athleteBox ?>
                                                                                    </td>-->
                                                                                    <td class="td-actions text-right">

                                                                                        <form name="editAthlete" action = "editAthlete.php" method="POST" role="form">
                                                                                            <div style="display:none;">
                                                                                                <input type="hidden" name="athleteID" class="form-control" value="<?php echo $athleteID ?>" >
                                                                                            </div>
                                                                                            <button type="submit" rel="tooltip" class="btn btn-round">
                                                                                                <i class="material-icons">edit</i>
                                                                                            </button>
                                                                                            <button type="button" onclick = "deleteAthlete(<?php echo $athleteID ?>);" rel="tooltip" class="btn btn-round btn-danger">
                                                                                                <i class="material-icons">delete</i>
                                                                                            </button>
                                                                                        </form>
                                                                                    </td>
                                                                                </tr> <?php
                                                                            }
                                                                        }
                                                                    }
                                                                    ?>


                                                                </tbody>
                                                            </table>
                                                        </div>

                                                    </div>

                                                </div>
                                                <?php
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