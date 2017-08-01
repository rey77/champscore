<?PHP
session_start();


// Session beenden 
// damit können wir diese Seite als "Logout" verwenden
session_unset();
session_destroy();
unset($_SESSION); // Session-Array löschen
// Session-Cookie löschen 
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]
    );
}
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="apple-touch-icon" sizes="76x76" href="php/img/apple-icon.png">
        <link rel="icon" type="image/png" href="php/img/favicon-16x16.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <title>champscore</title>

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

        <!--     Fonts and icons     -->
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

        <!-- CSS Files -->
        <link href="php/css/bootstrap.min.css" rel="stylesheet" />
        <link href="php/css/material-kit.css?v=1.1.0" rel="stylesheet"/>



    </head>

    <body>
        
        <?php include_once("./php/analyticstracking.php") ?>



        <div class="cd-section" id="headers">

            <!--     *********     HEADER 1      *********      -->


            <!--     *********     HEADER 2      *********      -->

            <div class="header-2">
                <nav class="navbar navbar-transparent navbar-absolute">
                    <div class="container">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="index.php"><p><img style="width: 2em;" class="logo" src="img/Logo.png" alt=""/><img style=" padding-left: .5em; width: 9em;" class="logo" src="img/text.png" alt=""/></p></a>
                        </div>

                        <div class="collapse navbar-collapse" id="navigation-example">

                            <ul class="nav navbar-nav navbar-right">

                                

                                <!--<li>
                                    <a href="https://twitter.com/CreativeTim">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.facebook.com/CreativeTim">
                                        <i class="fa fa-facebook-square"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.instagram.com/CreativeTimOfficial">
                                        <i class="fa fa-instagram"></i>
                                    </a>
                                </li>-->
                               <!-- <li class="button-container">
                                    <a href="php/login.php"  class="btn btn-pinterest ">
                                        Login
                                    </a>
                                </li>-->
                            </ul>
                        </div>
                    </div>
                </nav>

                <div class="page-header header-filter" style="background-image: url('img/header.jpg');">
                    <div class="container">
                        <div class="row">
                            <!--<div class="col-md-8 col-md-offset-2 text-center">
                                <h1 class="title"> Your Favorite Competition Management Tool</h1>
                                <h4>You will have an unique competition experience using champscore</h4>
                            </div>-->
                            <div class="col-md-6 col-md-offset-0 text-center">
                                <h1 class="title">ATHLETES</h1>
                                <a class="btn btn-pinterest" href="php/athleteLogin.php">Login</a>
                                <a class="btn btn-pinterest" href="php/athleteRegister.php">create Athlete Account</a>
                            </div>
                            
                            <div class="col-md-6 col-md-offset-0 text-center">
                                <h1 class="title">HOSTS</h1>
                                <a class="btn btn-pinterest" href="php/hostLogin.php">Login</a>
                                <a class="btn btn-pinterest" href="#">Register (coming soon)</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--     *********    END HEADER 2      *********      -->

        </div>

        <div class="cd-section" id="teams" style="background-color: white;">
            <!--     *********    TEAM 1     *********      -->

            <div class="team-1" id="team-1">

                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2 text-center">
                            <h2 class="title">Our Competitions</h2>
                            <h5 class="description">We are happy to host Competitions all around the globe.</h5>
                        </div>
                    </div>

                    <div class="row">
                        
                        <?php
                        
                        include 'php/Database.php';
                        $pdo = Database::connect();
                        $sql = "select comp_ID, comp_name, comp_start_date, comp_logo, comp_city, comp_country from tbl_competition";
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $q = $pdo->prepare($sql);
                        $q->execute(array());
                        while ($zeile = $q->fetch(/* PDO::FETCH_ASSOC */)) {

                            $compID = $zeile['comp_ID'];
                            $compLogo = $zeile['comp_logo'];

                            if ($compLogo != 0) {

                                $logosrc = "php/uploads/host/complogo/$compLogo";
                            } else {
                                $logosrc = "http://placehold.it/400x250/000/fff";
                            }
                            ?> 

                            <div class="col-md-6">
                                <div class="media">
                                    <a class="pull-left" href="php/competitionView.php?comp_id=<?php echo $compID ?>">
                                        <div class="avatar">
                                            <img class="media-object" alt="Tim Picture" src="<?php echo $logosrc ?>">
                                        </div>
                                    </a>
                                    <div class="media-body">
                                        <a class="pull-left" href="php/competitionView.php?comp_id=<?php echo $compID ?>"><h4 class="media-heading" ><?php echo $zeile['comp_name'] ?> </h4>

                                            <p><?php echo $zeile['comp_start_date'] ?></p>
                                            <p><?php echo $zeile['comp_city'] ?>, <?php echo $zeile['comp_country'] ?></p>
                                        </a>
                                        <!--<div class="media-footer">
                                            <a href="#pablo" class="btn btn-primary btn-simple pull-right" rel="tooltip" title="Reply to Comment">
                                                <i class="material-icons">reply</i> Reply
                                            </a>
                                            <a href="#pablo" class="btn btn-default btn-simple pull-right">
                                                <i class="material-icons">favorite</i> 25
                                            </a>
                                        </div>-->

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
       <!-- <div class="cd-section" id="pricing">


            <div class="pricing-2" id="pricing-2">

                <div class="container">


                    <div class="row">
                        <div class="col-md-6 col-md-offset-3 text-center">
                            <h2 class="title">Pricing</h2>
                            
                        </div>
                    </div>
                    <div class="row">



                        <div class="col-md-4">
                            <div class="card card-pricing  card-raised" style="background-image: url('php/img/cs.png')">
                                <div class="card-content">
                                    
                                    <h1 class="card-title"><small>$</small>.99<small>/ Registration</small></h1>
                                    <ul>
                                        <li><b>+3.5%</b> Fee per registration</li>
                                        <li>Unlimited Wods</li>
                                        <li>Customizable Competition page</li>
                                        <li>Customizable Leaderboard</li>
                                        <li>Simple Scoring</li>
                                        <li>Judging sheets on demand</li>
                                    </ul>
                                    <a href="#pablo" class="btn btn-pinterest btn-round">
                                        Get Started
                                    </a>
                                </div>
                            </div>
                        </div>



                    </div>

                </div>
            </div>

        </div>-->


    </body>
    <!--   Core JS Files   -->
    <script src="php/js/jquery.min.js" type="text/javascript"></script>
    <script src="php/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="php/js/material.min.js"></script>

    <!--    Plugin for Date Time Picker and Full Calendar Plugin   -->
    <script src="php/js/moment.min.js"></script>

    <!--	Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/   -->
    <script src="php/js/nouislider.min.js" type="text/javascript"></script>

    <!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker   -->
    <script src="php/js/bootstrap-datetimepicker.js" type="text/javascript"></script>

    <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select   -->
    <script src="php/js/bootstrap-selectpicker.js" type="text/javascript"></script>

    <!--	Plugin for Tags, full documentation here: http://xoxco.com/projects/code/tagsinput/   -->
    <script src="php/js/bootstrap-tagsinput.js"></script>

    <!--	Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput   -->
    <script src="php/js/jasny-bootstrap.min.js"></script>

    <!--    Plugin For Google Maps   -->
    <script  type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

    <!--    Plugin for 3D images animation effect, full documentation here: https://github.com/drewwilson/atvImg    -->
    <script src="php/js/atv-img-animation.js" type="text/javascript"></script>

    <!--    Control Center for Material Kit: activating the ripples, parallax effects, scripts from the example pages etc    -->
    <script src="php/js/material-kit.js?v=1.1.0" type="text/javascript"></script>

    <script type="text/javascript">
        $().ready(function () {

            materialKitDemo.initContactUs2Map();
        });
    </script>

</html>
