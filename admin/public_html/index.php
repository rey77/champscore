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
        <meta charset="utf-8"/>
        <link rel="apple-touch-icon" sizes="76x76" href="php/img/apple-icon.png">
        <link rel="icon" type="image/png" href="php/img/favicon-16x16.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

        <title>champscore</title>

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>

        <!--     Fonts and icons     -->
        <link rel="stylesheet" type="text/css"
              href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"/>

        <!-- CSS Files -->
        <link href="php/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="php/css/material-kit.css?v=1.1.0" rel="stylesheet"/>
        <link href="assets/css/styles.css" type="text/css" rel="stylesheet"/>
        <!--   Core JS Files   -->
        <script src="php/js/jquery-3.1.1.min.js" type="text/javascript"></script>
        <script src="php/js/jquery-ui.min.js" type="text/javascript"></script>
        <script src="php/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="php/js/material.min.js" type="text/javascript"></script>
        <script src="php/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
        <script src="php/js/jquery.autocomplete.min.js" type="text/javascript"></script>
        <script src="php/js/script.js" type="text/javascript"></script>
    </head>

    <body class="blog-post">
        <?php include_once("./php/analyticstracking.php") ?>
        <div class="cd-section" id="headers">
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
                            <a class="navbar-brand" href="index.php">
                                <p>
                                    <img class="logo" src="img/Logo.png" alt=""/>
                                    <img class="logo-title" src="img/text.png" alt=""/>
                                </p>
                            </a>
                        </div>

                        <div class="collapse navbar-collapse">

                            <ul class="nav navbar-nav navbar-right">


                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="material-icons">person</i> Athlete
                                        <b class="caret"></b>
                                    </a>
                                    <ul class="dropdown-menu dropdown-with-icons">
                                        <li>
                                            <a class="host" href="php/athleteLogin.php">
                                                <i class="material-icons">fingerprint</i> Login
                                            </a>
                                        </li>
                                        <li>
                                            <a href="php/athleteRegister.php">
                                                <i class="material-icons">person_add</i> Signup
                                            </a>
                                        </li>

                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="material-icons">person_outline</i> Host
                                        <b class="caret"></b>
                                    </a>
                                    <ul class="dropdown-menu dropdown-with-icons">
                                        <li>
                                            <a href="php/hostLogin.php">
                                                <i class="material-icons">fingerprint</i> Login
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="material-icons">person_add</i> Signup
                                            </a>
                                        </li>

                                    </ul>
                                </li>

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

                        <!--<div class="col-md-8 col-md-offset-2 text-center">
                            <h1 class="title"> Your Favorite Competition Management Tool</h1>
                            <h4>You will have an unique competition experience using champscore</h4>
                        </div>-->
                        <div class="col-lg-6 col-md-6 col-md-offset-0 text-center">

                            <h1 class="title">ATHLETE</h1>

                            <a class="btn btn-oxfordblue" href="php/athleteLogin.php">Login</a>


                            <a class="btn btn-oxfordblue" href="php/athleteRegister.php">Register</a>

                        </div>

                        <div class="col-lg-6 col-md-6 col-md-offset-0 text-center">
                            <h1 class="title">HOST</h1>

                            <a class="btn btn-pinterest" href="php/hostLogin.php">Login</a>


                            <a class="btn btn-pinterest" href="#">Register (coming soon)</a>

                        </div>
                    </div>
                </div>
            </div>

            <div class="main main-raised">
                <div class="container">
                    <div class="row">
                        <br>
                        <br>
                        <div class="col-md-8 col-md-offset-2 text-center">
                            <h2 class="title">OUR COMPETITIONS</h2>
                            <!--<h5 class="description">We are happy to host Competitions all around the globe.</h5>-->
                        </div>
                        <form class="navbar-form navbar-right search-form" role="search">
                            <div class="form-group form-search is-empty field-container" id="search">
                                <input type="text" class="form-control search-field" placeholder="Search for Competition" id="autocomplete">
                            </div>
                        </form>
                    </div>
                    <br>
                    <br>

                    <div class="row">

                        <div id="tabs-container">
                            <ul class="tabs-menu">
                                <li><a href="#tab-1">Past</a></li>
                                <li class="current"><a href="#tab-2">Now</a></li>
                                <li><a href="#tab-3">Future</a></li>
                            </ul>
                            <div class="tab">
                                <?php
                                    include 'php/Database.php';
                                    include 'php/showCompetitions.php';
                                    $competitions = getCompetitionsFromDB();
                                    $past = addCompToPast($competitions);
                                    $now = addCompToNow($competitions);
                                    $future = addCompToFuture($competitions);
                                ?>
                                <div id="tab-1" class="tab-content">
                                    <?php
                                        showCompetitionsInIndex($past);
                                    ?>
                                </div>

                                <div id="tab-2" class="tab-content">
                                    <?php
                                        showCompetitionsInIndex($now);
                                    ?>

                                </div>

                                <div id="tab-3" class="tab-content">
                                    <?php
                                        showCompetitionsInIndex($future);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br>
                    <br><br>
                    <br><br>
                    <br>

                </div>
            </div>
        </div>
        <br>
        <br>

        <footer class="footer footer-black">
            <div class="container">


                <ul class="pull-center">
                    <li>
                        <a href="mailto:info@champscore.ch">
                            info@champscore.ch
                        </a>
                    </li>


                </ul>

                <!--<ul class="social-buttons pull-right">
                    <li>
                        <a href="https://www.facebook.com/CreativeTim" target="_blank" class="btn btn-just-icon btn-simple">
                            <i class="fa fa-facebook-square"></i>
                        </a>
                    </li>
                </ul>-->

            </div>
        </footer>

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
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

        <!--    Plugin for 3D images animation effect, full documentation here: https://github.com/drewwilson/atvImg    -->
        <script src="php/js/atv-img-animation.js" type="text/javascript"></script>

        <!--    Control Center for Material Kit: activating the ripples, parallax effects, scripts from the example pages etc    -->
        <script src="php/js/material-kit.js?v=1.1.0" type="text/javascript"></script>
        <script src="php/js/jquery.autocomplete.min.js" type="text/javascript"></script>
        <script src="php/js/script.js" type="text/javascript"></script>

        <script type="text/javascript">
            $().ready(function () {
                materialKitDemo.initContactUs2Map();
            });
        </script>
    </body>
</html>
