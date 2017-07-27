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
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
        <link rel="icon" type="image/png" href="../img/favicon-16x16.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <title>Login</title>

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

        <!--     Fonts and icons     -->
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

        <!-- CSS Files -->
        <link href="css/bootstrap.min.css" rel="stylesheet" />
        <link href="css/material-kit.css?v=1.1.0" rel="stylesheet"/>


    </head>

    <body class="login-page">


        <nav class="navbar navbar-transparent navbar-absolute" id="sectionsNav">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">

                    <a class="navbar-brand" href="landingpage.php"><p><img style="width: 2em;" class="logo" src="../img/Logo.png" alt=""/><img style=" padding-left: .5em; width: 9em;" class="logo" src="../img/text.png" alt=""/></p></a>
                </div>


            </div>
        </nav>

        <div class="page-header header-filter" style="background-image: url('img/header2.jpg'); background-size: cover; background-position: top center;">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                        <div class="card card-signup">
                            <form class="form" name="formLogin" onsubmit="onSubmitLogin()" method="POST" action="loginsec/login_b.php">
                                <div class="header header-pinterest text-center">
                                    <h4 class="card-title">Log in</h4>
                                    <!--<div class="social-line">
                                        <a href="#pablo" class="btn btn-just-icon btn-simple">
                                            <i class="fa fa-facebook-square"></i>
                                        </a>
                                        <a href="#pablo" class="btn btn-just-icon btn-simple">
                                            <i class="fa fa-twitter"></i>
                                        </a>
                                        <a href="#pablo" class="btn btn-just-icon btn-simple">
                                            <i class="fa fa-google-plus"></i>
                                        </a>
                                    </div>-->
                                </div>
                                <!--<p class="description text-center">Or Be Classical</p>-->
                                <div class="card-content">



                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">email</i>
                                        </span>
                                        <input type="email" name ="email" class="form-control" placeholder="Email..." email="true" required="true">
                                    </div>

                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">lock_outline</i>
                                        </span>
                                        <input type="password" name="passwort" placeholder="Password..." class="form-control" type="password" required="true" />
                                    </div>

                                    <!-- If you want to add a checkbox to this form, uncomment this code

                                    <div class="checkbox">
                                            <label>
                                                    <input type="checkbox" name="optionsCheckboxes" checked>
                                                    Subscribe to newsletter
                                            </label>
                                    </div> -->
                                </div>
                                <div class="footer text-center">
                                    <input type='submit' class='btn btn-oxfordblue' name='next' value='login' />

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </body>
    <!--   Core JS Files   -->
    <script src="js/jquery.min.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <script src="js/material.min.js"></script>

    <!--    Plugin for Date Time Picker and Full Calendar Plugin   -->
    <script src="js/moment.min.js"></script>

    <!--	Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/   -->
    <script src="js/nouislider.min.js" type="text/javascript"></script>

    <!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker   -->
    <script src="js/bootstrap-datetimepicker.js" type="text/javascript"></script>

    <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select   -->
    <script src="js/bootstrap-selectpicker.js" type="text/javascript"></script>

    <!--	Plugin for Tags, full documentation here: http://xoxco.com/projects/code/tagsinput/   -->
    <script src="js/bootstrap-tagsinput.js"></script>

    <!--	Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput   -->
    <script src="js/jasny-bootstrap.min.js"></script>

    <!--    Plugin For Google Maps   -->
    <script  type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

    <!--    Plugin for 3D images animation effect, full documentation here: https://github.com/drewwilson/atvImg    -->
    <script src="js/atv-img-animation.js" type="text/javascript"></script>

    <!--    Control Center for Material Kit: activating the ripples, parallax effects, scripts from the example pages etc    -->
    <script src="js/material-kit.js?v=1.1.0" type="text/javascript"></script>
</html>
