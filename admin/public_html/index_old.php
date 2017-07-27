
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>champscore</title>
        <link rel="shortcut icon" type="image/x-icon" href="img/favicon-16x16.png">
        <!-- Bootstrap Core CSS -->
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <!-- Custom Fonts -->
        <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- Plugin CSS -->
        <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

        <!-- Theme CSS -->
        <link href="css/creative.min.css" rel="stylesheet">
        <link href="css/reglog.css" rel="stylesheet">

        <script type="text/javascript">
            //Funktion zur Prüfung der Registrierungsdaten
            function mySubmitReg()
            {
                if (document.formular.benutzername.value == "") {
                    alert("Bitte tragen Sie Ihren Benutzername (Kontaktperson) ein!");
                    document.formular.benutzername.focus();
                    return false;
                }
                if (document.formular.passwort1.value == "") {
                    alert("Bitte geben sie ein Passwort ein!");
                    document.formular.passwort1.focus();
                    return false;
                }
                if (document.formular.passwort2.value == "") {
                    alert("Bitte geben sie das Passwort zweimal ein - zur Kontrolle!");
                    document.formular.passwort2.focus();
                    return false;
                }
                if (document.formular.passwort1.value.length < 8) {
                    alert("Bitte geben sie ein Passwort mit mindestens 8 Zeichen ein!")
                    document.formular.passwort1.focus();
                    return false;
                }
                var nr_length = document.formular.passwort1.value.replace(/[^0-9]/g, '').length;
                if (nr_length < 1) {
                    alert("Passwort muss mind. 1 Zahl haben !")
                    document.formular.passwort1.focus();
                    return false;
                }
                if (document.formular.passwort1.value == document.formular.passwort2.value)
                {
                    return true;
                } else
                {
                    alert("Passwörter sind nicht identisch");
                    return false;
                }
            }


            function mySubmitLogin()
            {
                if (document.formLogin.email.value == "") {
                    alert("Bitte tragen Sie Ihren Benutzername (Email) ein!");
                    document.formLogin.email.focus();
                    return false;
                }
                if (document.formLogin.passwort.value == "") {
                    alert("Bitte geben sie ein Passwort ein!");
                    document.formLogin.passwort.focus();
                    return false;
                }
            }

        </script> 

    </head>

    <body id="page-top">


        <?PHP
        session_start();


        if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        }

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

        <!-- Navigationsleiste oben-->
        <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                    </button>

                    <a class="navbar-brand page-scroll" href="#page-top"></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">

                        <li>
                            <a target="_blank" href=php/allScoreboardsPublic.php>All Scoreboards</a>

                        </li>

                        <li>
                            <a class="page-scroll" href="#about">About</a>
                        </li>
                        <li>
                            <a class="page-scroll" href="#services">Services</a>
                        </li>
                        <li>
                            <a class="page-scroll" href="#portfolio">Pricing</a>
                        </li>
                        <li>
                            <a class="page-scroll" href="#contact">Contact</a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>

        <header>
            <div class="header-content">
                <div class="header-content-inner"><br><br>


                    <h1 id="homeHeading">Your Favorite Tool to support your Competition</h1>
                    <hr>  
                    <p>You will have an unique competition experience using ChampScore </p>

                    <!-- <a> <button type="button" class="btn btn-primary btn-xl" data-toggle="modal" data-target="#register">Register</button></a>
                     <a> <button type="button" class="btn btn-success btn-xl" data-toggle="modal" data-target="#login">Login</button></a>
                     
                    <!--<a href="#about" class="btn btn-primary btn-xl page-scroll">Find Out More</a>-->

                    <div class="container">
                        <div class="row">
                            <div class="col-lg-4 col-lg-offset-3 col-md-4 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-6 col-xs-offset-0">
                                <div class="form-body">
                                    <ul class="nav nav-tabs final-login">
                                        <li class="active"><a data-toggle="tab" href="#sectionA">Sign In</a></li>
                                        <li><a data-toggle="tab" href="#sectionB">Join us!</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div id="sectionA" class="tab-pane fade in active">
                                            <div class="innter-form">
                                                <form  name="formLogin" action="php/loginsec/login_b.php" onsubmit="mySubmitLogin()" method="POST" class="sa-innate-form">
                                                    <input type="hidden" name="vonwo" value="erfassung"/>

                                                    <input class="form-control" type="text" name="email" placeholder="E-Mail">
                                                    <input class="form-control" type="password" name="passwort" placeholder="Password">




                                                    <button type="submit" name="submit" >SIGN IN</button>
                                                    <a href="#" class="passforgot"  data-toggle="modal" data-target="#passwordforgot">Forgot Password?</a>
                                                </form>
                                            </div>
                                            <!--  <div class="social-login">
                                             <br>
                                                  <ul>
                                              <li><a href=""><i class="fa fa-facebook"></i> Facebook</a></li>
                                              <li><a href=""><i class="fa fa-google-plus"></i> Google+</a></li>
                                              <li><a href=""><i class="fa fa-twitter"></i> Twitter</a></li>
                                              </ul>
                                              </div>
                                            -->
                                            <div class="clearfix"></div>
                                        </div>
                                        <div id="sectionB" class="tab-pane fade">
                                            <div class="inner-form">
                                                <form name="formular" onsubmit="return mySubmitReg()" action= php/loginsec/login_erf.php class="sa-innate-form" method="post">

                                                    <input type="hidden" name="vonwo" value="erfassung"/>
                                                    <div class="col-lg-6"><input type="text" class="form-control" name="benutzername" placeholder="User Name"></div>
                                                    

                                                    <div class="col-lg-6"><input type="email" class="form-control" name="email" placeholder="Email"></div>

                                                    <div class="col-lg-6"><input type="password" class="form-control" name="passwort1" placeholder="Password"></div>
                                                    <div class="col-lg-6"><input type="password"  class="form-control" name="passwort2" placeholder="Confirm Password"></div>
                                                    <button type="submit"  name="erfassen">JOIN NOW</button>

                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </header>

        <section class="bg-primary" id="about">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2 text-center">
                        <h2 class="section-heading">Set up your Competition easily and fast</h2>
                        <hr class="light">
                        <!--<a href="#services" class="page-scroll btn btn-default btn-xl sr-button">Get Started!</a>-->
                    </div>
                </div>
            </div>
        </section>

        <section id="services">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="section-heading">At Your Service</h2>
                        <hr class="primary">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="service-box">
                            <i class="fa fa-4x fa-cube text-primary sr-icons"></i>
                            <h3>Simple & Quick</h3>
                            <p class="text-muted">Our tool is easy to handle, so you can easily support your scoring management</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="service-box">
                            <i class="fa fa-4x fa-mobile text-primary sr-icons"></i>
                            <h3>All Devices</h3>
                            <p class="text-muted">You can Access your Leaderboard on every device</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="service-box">
                            <i class="fa fa-4x fa-th-list text-primary sr-icons"></i>
                            <h3>Up to Date</h3>
                            <p class="text-muted">Real-Time Scores and customized Judging sheets</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="service-box">
                            <i class="fa fa-4x fa-heart text-primary sr-icons"></i>
                            <h3>Made with Love</h3>
                            <p class="text-muted">we assure maximal peformance at low cost</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!---
            <section class="no-padding" id="portfolio">
                <div class="container-fluid">
                    <div class="row no-gutter popup-gallery">
                        <div class="col-lg-4 col-sm-6">
                            <a href="img/portfolio/fullsize/1.jpg" class="portfolio-box">
                                <img src="img/portfolio/thumbnails/1.jpg" class="img-responsive" alt="">
                                <div class="portfolio-box-caption">
                                    <div class="portfolio-box-caption-content">
                                        <div class="project-category text-faded">
                                            Category
                                        </div>
                                        <div class="project-name">
                                            Project Name
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <a href="img/portfolio/fullsize/2.jpg" class="portfolio-box">
                                <img src="img/portfolio/thumbnails/2.jpg" class="img-responsive" alt="">
                                <div class="portfolio-box-caption">
                                    <div class="portfolio-box-caption-content">
                                        <div class="project-category text-faded">
                                            Category
                                        </div>
                                        <div class="project-name">
                                            Project Name
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <a href="img/portfolio/fullsize/3.jpg" class="portfolio-box">
                                <img src="img/portfolio/thumbnails/3.jpg" class="img-responsive" alt="">
                                <div class="portfolio-box-caption">
                                    <div class="portfolio-box-caption-content">
                                        <div class="project-category text-faded">
                                            Category
                                        </div>
                                        <div class="project-name">
                                            Project Name
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <a href="img/portfolio/fullsize/4.jpg" class="portfolio-box">
                                <img src="img/portfolio/thumbnails/4.jpg" class="img-responsive" alt="">
                                <div class="portfolio-box-caption">
                                    <div class="portfolio-box-caption-content">
                                        <div class="project-category text-faded">
                                            Category
                                        </div>
                                        <div class="project-name">
                                            Project Name
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <a href="img/portfolio/fullsize/5.jpg" class="portfolio-box">
                                <img src="img/portfolio/thumbnails/5.jpg" class="img-responsive" alt="">
                                <div class="portfolio-box-caption">
                                    <div class="portfolio-box-caption-content">
                                        <div class="project-category text-faded">
                                            Category
                                        </div>
                                        <div class="project-name">
                                            Project Name
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <a href="img/portfolio/fullsize/6.jpg" class="portfolio-box">
                                <img src="img/portfolio/thumbnails/6.jpg" class="img-responsive" alt="">
                                <div class="portfolio-box-caption">
                                    <div class="portfolio-box-caption-content">
                                        <div class="project-category text-faded">
                                            Category
                                        </div>
                                        <div class="project-name">
                                            Project Name
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
            
        -->

        <aside class="bg-dark">
            <div class="container text-center">
                <div class="call-to-action">
                    <h2>Support your competition with ChampScore!</h2>
                    <a class=" btn btn-default btn-xl sr-button page-scroll" href="#page-top">Register now!</a>
                    <!-- <a href="http://startbootstrap.com/template-overviews/creative/" class="btn btn-default btn-xl sr-button">Register Now!</a>
                    --> </div>
            </div>
        </aside>

        <section id="contact">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2 text-center">
                        <h2 class="section-heading">Let's Get In Touch!</h2>
                        <hr class="primary">
                        <p>Do you have any Questions? Give us a call or send us an email and we will get back to you as soon as possible!</p>
                    </div>
                    <div class="col-lg-4 col-lg-offset-2 text-center">
                        <i class="fa fa-phone fa-3x sr-contact"></i>
                        <p>123-456-6789</p>
                    </div>
                    <div class="col-lg-4 text-center">
                        <i class="fa fa-envelope-o fa-3x sr-contact"></i>
                        <p><a href="mailto:your-email@your-domain.com">info@champscore.net</a></p>
                    </div>
                </div>
            </div>
        </section>

        <!-- jQuery -->
        <script src="vendor/jquery/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

        <!-- Plugin JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
        <script src="vendor/scrollreveal/scrollreveal.min.js"></script>
        <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

        <!-- Theme JavaScript -->
        <script src="js/creative.min.js"></script>



        <div class="modal fade" id="passwordforgot">
            <div class="modal-dialog modal-md">
                <div class="modal-content">

                    <!-- header -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title">Forgot your Password?</h3>
                    </div>

                    <!-- body ( form ) -->
                    <div class="modal-body">

                        <form role="form" action="php/loginsec/login-reset-form.php" method="POST" id="passForgot">
                            <div class="form-group">
                                <label>No Problem, just type in your User E-Mail</label>
                                <input type="text" class="form-control" Name = "email" placeholder="Email">                                     
                            </div>
                        </form>
                    </div>

                    <!-- button -->
                    <div class="modal-footer">

                        <button type="Submit" form="passForgot" class="btn btn-primary btn-block"  name="submit">Send me a new one</button>

                    </div>
                </div>
            </div>
        </div>
    </body>

</html>
