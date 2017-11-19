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
        <title>Add Scoresheets</title>
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

        $sql_comp = "select comp_ID, comp_name, comp_scoresheets from tbl_competition where comp_id = ?";
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $q_comp = $pdo->prepare($sql_comp);
        $q_comp->execute(array($compID));


        while ($zeile = $q_comp->fetch(/* PDO::FETCH_ASSOC */)) {

            $compID = $zeile['comp_ID'];
            $compName = $zeile['comp_name'];
            $compScoresheets = $zeile['comp_scoresheets'];
                    
        }
        
        if ($compScoresheets != 0) {
            $scoresheetssrc = "uploads/host/scoresheets/$compScoresheets";
        } else {
            $scoresheetssrc = "img/image_placeholder.jpg";
        }

        
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
                        
                        <div class="info">
                            <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                                <?php echo $_SESSION['admin_email']; ?>
                                <b class="caret"></b>
                            </a>
                            <div class="collapse" id="collapseExample">
                                <ul class="nav">
                                    
                                    <li>
                                        <a href="loginsec/logout.php">Log out</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <ul class="nav">
                       
                        <li  class="active">

                            <a href="./adminIndex.php">
                                <i class="material-icons">dashboard</i>
                                <p>COMPETITIONS</p>

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
                            <a class="navbar-brand" href="#"> ADD SCORESHEETS </a>
                        </div>

                    </div>
                </nav>
                <div class="content">
                    <div class="container-fluid">



                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-text" data-background-color="oxfordblue">
                                    <h4 class="card-title"><?php echo $compName ?></h4>

                                </div>
                                <div class="card-content">

                                    <form name ="compData" role="form" action="updateScoresheets.php" method="POST" enctype="multipart/form-data">
                                        <div class="row">
                                            
                                              <input type="hidden" name="compID" class="form-control" value="<?php echo $compID ?>" >
  
                                        <h3>SCORESHEETS <i class="material-icons">assignment</i></h3>

                                        <div class="col-lg-12" align="center">

                                            <div class="fileinput fileinput-new text-center" data-provides="fileinput">

                                                <div class="fileinput-new ">
                                                    <iframe src="<?php echo $scoresheetssrc ?>" width="400" height="500"></iframe>
                                                </div>
                                                <div class="fileinput-preview fileinput-exists"></div>
                                                <div>
                                                    <span class="btn btn-pinterest btn-round btn-file">
                                                        <span class="fileinput-new">Select PDF File</span>
                                                        <span class="fileinput-exists">Change</span>
                                                        <input type="file" accept="application/pdf" name="compScoresheets" id="compScoresheets" value="<?php echo $scoresheetssrc ?>" />
                                                    </span>
                                                    <a href="#pablo" class="btn btn-pinterest btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn pull-right btn-fill btn-pinterest">Save</button>

                                    </form>

                                
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

    <script src="js/colorpicker/jscolor.js"></script>

    <script type="text/javascript">


                                $(document).ready(function () {
                                    var slider = document.getElementById('sliderRegular');

                                    noUiSlider.create(slider, {
                                        start: 40,
                                        connect: [true, false],
                                        range: {
                                            min: 0,
                                            max: 100
                                        }
                                    });

                                    var slider2 = document.getElementById('sliderDouble');

                                    noUiSlider.create(slider2, {
                                        start: [20, 60],
                                        connect: true,
                                        range: {
                                            min: 0,
                                            max: 100
                                        }
                                    });



                                    materialKit.initFormExtendedDatetimepickers();

                                    $('#cp2').colorpicker();
                                });
    </script>
</html>