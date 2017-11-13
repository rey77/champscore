<?php
session_start();

if ($_SESSION['eingeloggt'] == false) {

    header("Location: public_html/index.php");
    exit();
}

if (isset($_POST["teamID"])) {
    $teamID = $_POST['teamID'];
} else {
    $teamID = $_GET['teamID'];
}

if (isset($_POST["teamID"])) {
    $divID = $_POST['divID'];
} else {
    $divID = $_GET['divID'];
}

include 'Database.php';
$pdo = Database::connect();

$sql_div = "select div_ID, div_name, div_is_team, div_team_size, fk_comp_ID from tbl_division where div_id = ?";
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$q_div = $pdo->prepare($sql_div);
$q_div->execute(array($divID));


while ($zeile = $q_div->fetch(/* PDO::FETCH_ASSOC */)) {

    $divName = $zeile['div_name'];
    $divIsTeam = $zeile['div_is_team'];
    $divTeamSize = $zeile['div_team_size'];
    $compID = $zeile['fk_comp_ID'];
}

$sql = "select team_ID, team_name, team_affiliate from tbl_team where team_ID = ?";
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$q = $pdo->prepare($sql);
$q->execute(array($teamID));


while ($zeile = $q->fetch(/* PDO::FETCH_ASSOC */)) {

    $teamName = $zeile['team_name'];
    $teamBox = $zeile['team_affiliate'];
}



Database::disconnect();
?>
<html lang = "en">

    <head>

        <meta charset="utf-8" />
        <link rel="apple-touch-icon" sizes="76x76" href="img/apple-icon.png" />
        <link rel="icon" type="image/png" href="img/favicon-16x16.png" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>Material Dashboard Pro by Creative Tim</title>
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




            function deleteTeamMember(team_member_ID)
            {

                var del_team_member_id = team_member_ID;
                var info = 'team_member_id=' + del_team_member_id;

                if (confirm("Sure you want to remove this Team Member? This cannot be undone later.")) {
                    $.ajax({
                        type: "POST",
                        url: "deleteTeamMember.php", //URL to the delete php script
                        data: info,
                        success: function () {
                            $("#rowTeamMember" + del_team_member_id).animate("fast").animate({
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
                                <?php echo $_SESSION['hostName']; ?>
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
                                    <h4 class="card-title">Edit Team</h4>

                                </div>
                                <div class="card-content">



                                    <form name ="teamData" role="form" action="updateTeam.php" method="POST" >

                                        <div class="form-group">
                                            <label>Team Name</label>
                                            <input type="text" name="teamName"  class="form-control" value="<?php echo $teamName ?>">
                                            <!--<p class="help-block">Example block-level help text here.</p>-->
                                        </div>

                                        <div class="form-group">
                                            <label>Team Box</label>
                                            <input type="text" name="teamBox"  class="form-control" value="<?php echo $teamBox ?>">
                                            <!--<p class="help-block">Example block-level help text here.</p>-->
                                        </div>
                                        <?php
                                        $sql_tm = "select team_member_ID, team_member_name from tbl_team_member where fk_team_ID = ?";
                                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                        $q_tm = $pdo->prepare($sql_tm);
                                        $q_tm->execute(array($teamID));
                                        ?>


                                        <div class="form-group">

                                            <input type="hidden" name="teamID" value="<?php echo $teamID ?>" class="form-control" >
                                            <input type="hidden" name="compID" value="<?php echo $compID ?>" class="form-control" >
                                            <!--<p class="help-block">Example block-level help text here.</p>-->
                                        </div>


                                        <button type="submit" class="btn pull-right btn-pinterest">Save</button>

                                    </form>

                                    <div class="col-lg-12">
                                        <form name ="teamMemberNew" role="form" action="teamMemberNew.php" method="POST" >


                                            <div class="form-group">

                                                <input type="hidden" name="teamID" value="<?php echo $teamID ?>" class="form-control" >
                                                <input type="hidden" name="compID" value="<?php echo $compID ?>" class="form-control" >
                                                <input type="hidden" name="divID" value="<?php echo $divID ?>" class="form-control" >
                                                <input type="hidden" name="fromWhere" value="edit" class="form-control" >
    <!--<p class="help-block">Example block-level help text here.</p>-->
                                            </div>


                                            <button type="submit" class="btn btn-pinterest">Team Member <i class="material-icons">add</i></button>

                                        </form>
                                        <form name ="teamMemberData" role="form" action="teamMemberEdit.php" method="POST" >

                                            <div class="form-group">

                                                <label>Team Members</label>
                                                <table class = "table table-bordered">

                                                    <tbody>
                                                        <?php
                                                        while ($zeile = $q_tm->fetch(/* PDO::FETCH_ASSOC */)) {

                                                            $teamMemberID = $zeile['team_member_ID'];
                                                            $teamMemberName = $zeile['team_member_name'];
                                                            ?>

                                                            <tr id = "rowTeamMember"<?php echo $teamMemberID ?>>

                                                                <td>
                                                                    <?php echo $teamMemberName ?>
                                                                </td>



                                                                <td class="td-actions text-right">

                                                                    <input type="hidden" name="teamID" class="form-control" value="<?php echo $teamID ?>" >
                                                                    <input type="hidden" name="compID" class="form-control" value="<?php echo $compID ?>" >
                                                                    <input type="hidden" name="divID" class="form-control" value="<?php echo $divID ?>" >
                                                                    <input type="hidden" name="teamMemberID" class="form-control" value="<?php echo $teamMemberID ?>" >
                                                                    <button type="submit" class="btn btn-round" data-toggle="tooltip" data-placement="right" title="Edit this Team"><i class="material-icons">edit</i></button>

                                                                    <button type = "button" onclick = "deleteTeamMember(<?php echo $teamMemberID ?>);" class = "btn btn-round btn-danger" data-toggle = "tooltip" data-placement = "right" title = "Remove this Team Member"><i class="material-icons">delete</i></button>


                                                                </td>
                                                            </tr>



                                                            <?php
                                                        }
                                                        ?>
                                                    </tbody>

                                                </table>

                                            </div>
                                        </form>
                                    </div>


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
