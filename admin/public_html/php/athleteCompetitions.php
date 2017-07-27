<?php
session_start();

if ($_SESSION['eingeloggt'] == false) {

    header("Location: public_html/index.php");
    exit();
}

$userID = $_SESSION['user_id'];
include 'Database.php';
$pdo = Database::connect();

$sql_indiv = "select comp_ID, comp_name, comp_start_date, comp_logo, comp_city, comp_country, comp_active, div_is_team from tbl_competition "
        . " join tbl_division on tbl_competition.comp_ID = tbl_division.fk_comp_ID"
        . " join tbl_user_division on tbl_division.div_ID = tbl_user_division.fk_div_ID"
        . " where tbl_user_division.fk_user_ID =?";

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$q_indiv = $pdo->prepare($sql_indiv);
$q_indiv->execute(array($userID));


$sql_team = "select comp_ID, comp_name, comp_start_date, comp_logo, comp_city, comp_country, comp_active, div_is_team from tbl_competition "
        . " join tbl_division on tbl_competition.comp_ID = tbl_division.fk_comp_ID"
        . " join tbl_team_division on tbl_division.div_ID = tbl_team_division.fk_div_ID"
        . " join tbl_team on tbl_team_division.fk_team_ID = tbl_team.team_ID"
        . " join tbl_team_member on tbl_team.team_ID = tbl_team_member.fk_team_ID"
        . " where tbl_team_member.fk_user_ID =?";

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$q_team = $pdo->prepare($sql_team);
$q_team->execute(array($userID));
?>

<!doctype html>
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
                                        <a href="person.php">Edit Profile</a>
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
                            <a href="./allCompetitions.php">
                                <i class="material-icons">public</i>
                                <p>All Competitions</p>
                            </a>
                        </li>
                        <li>

                            <a data-toggle="collapse" href="#host">
                                <i class="material-icons">person</i>
                                <p>Competition Host
                                    <b class="caret"></b>
                                </p>
                            </a>
                            <div class="collapse out" id="host">
                                <ul class="nav">
                                    <!--<li>
                                        <a href="./hostDashboard.php">Dashboard</a>
                                    </li>-->
                                    <li>
                                        <a href="./hostCompetitions.php">Competitions</a>
                                    </li>

                                </ul>
                            </div>
                        </li>

                        <li class="active">
                            <a data-toggle="collapse" href="#athlete">
                                <i class="material-icons">person_outline</i>
                                <p>Athlete
                                    <b class="caret"></b>
                                </p>
                            </a>
                            <div class="collapse in" id="athlete">
                                <ul class="nav">
                                    <!--<li>
                                        <a href="./athleteDashboard.php">Dashboard</a>
                                    </li>-->
                                    <li class="active">
                                        <a href="./athleteCompetitions.php">Competitions</a>
                                    </li>

                                </ul>
                            </div>
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
                            <a class="navbar-brand" href="#"> My Competitions </a>
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
                                            <a href="#">Nina responded to your email</a>
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
                            <div class="col-lg-12">

                                <p>Here, you see your upcoming and past competitions</p>



                            </div>
                        </div>



                        <div class="row">

                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header card-header-tabs" data-background-color="darkred" >
                                        <div class="nav-tabs-navigation">
                                            <div class="nav-tabs-wrapper">
                                                <span class="nav-tabs-title"><b>Competitions</b></span>
                                                <ul class="nav nav-tabs" data-tabs="tabs" >

                                                    <li class="active">
                                                        <a href="#upcoming" data-toggle="tab">
                                                            Upcoming                                                               <div class="ripple-container"></div>
                                                        </a>
                                                    </li>

                                                    <li class="">
                                                        <a href="#current" data-toggle="tab">
                                                            Current                                                               <div class="ripple-container"></div>
                                                        </a>
                                                    </li>
                                                    <li class="">
                                                        <a href="#past" data-toggle="tab">
                                                            Past                                                               <div class="ripple-container"></div>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-content">

                                        <div class="tab-content">
                                            <div class="tab-pane active" id="upcoming">
                                                <div class="col-md-12">


                                                    <div class="material-datatables">
                                                        <table id="datatablessssss" class="table  table-no-bordered  table-shopping" cellspacing="0" width="100%" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                   <th></th>
                                                                    <th>Name</th>
                                                                    <th>When</th>
                                                                    <th>Where</th>
                                                                    <th>Team</th>

                                                                </tr>
                                                            </thead>

                                                            <tbody>

                                                                <?php
                                                                while ($zeile = $q_team->fetch(/* PDO::FETCH_ASSOC */)) {

                                                                    $compLocation = $zeile['comp_city'] . ", " . $zeile['comp_country'];
                                                                    $compName = $zeile['comp_name'];
                                                                    $compStartDate = $zeile['comp_start_date'];
                                                                    $compID = $zeile['comp_ID'];



                                                                    if ($zeile['div_is_team']) {
                                                                        $divIsTeam = "done";
                                                                    }

                                                                    $compLogo = $zeile['comp_logo'];
                                                                      if ($compLogo != 0) {
                                                                      $logosrc = "uploads/complogo/$compLogo";
                                                                      } else {
                                                                      $logosrc = "img/image_placeholder.jpg";
                                                                      } 
                                                                    ?>
                                                                    <tr>
                                                                        <td><div class="img-container">
                                                                                <img src="<?php echo $logosrc ?>" alt="...">
                                                                            </div>
                                                                        </td>

                                                                        <td><a href="competitionView.php?comp_id=<?php echo $compID ?>" target="_blank"><?php echo $compName ?></a></td>
                                                                        <td><?php echo $compStartDate ?></td>
                                                                        <td><?php echo $compLocation ?></td>
                                                                        <td><i class="material-icons"><?php echo $divIsTeam ?></i></td>

                                                                    </tr>

                                                                    <?php
                                                                }
                                                                Database::disconnect();
                                                                ?>


                                                            </tbody>
                                                        </table>
                                                    </div>


                                                </div>

                                            </div>
                                            <div class="tab-pane" id="current">

                                            </div>
                                            <div class="tab-pane" id="past">

                                            </div>
                                        </div>
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

    <script type="text/javascript">
                                $(document).ready(function () {
                                    $('#datatables').DataTable({
                                        "pagingType": "full_numbers",
                                        "lengthMenu": [
                                            [10, 25, 50, -1],
                                            [10, 25, 50, "All"]
                                        ],

                                        responsive: true,
                                        language: {
                                            search: "_INPUT_",
                                            searchPlaceholder: "Search records",
                                        }

                                    });


                                    var table = $('#datatables').DataTable();

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
                                });
    </script>



</html>