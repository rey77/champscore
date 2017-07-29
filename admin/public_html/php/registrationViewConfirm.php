<?php
session_start();
$compID = $_GET['comp_id'];
?>
<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <link rel="apple-touch-icon" sizes="76x76" href="../../assets/img/apple-icon.png" />
        <link rel="icon" type="image/png" href="img/favicon-16x16.png" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>Confirmation</title>
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
        <link href="css/material-kit.css?v=1.1.0" rel="stylesheet"/>

        <?php
        include 'Database.php';
        $pdo = Database::connect();

        //  $compID = $_GET['comp_id'];
        //   $compID = 57;
        $sql = "select comp_ID, comp_name, comp_start_date, comp_regcode, comp_terms, comp_active, comp_street, comp_zip, comp_city, comp_country, comp_logo from tbl_competition where comp_id = ?";
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $q = $pdo->prepare($sql);
        $q->execute(array($compID));


        while ($zeile = $q->fetch(/* PDO::FETCH_ASSOC */)) {

            $compID = $zeile['comp_ID'];
            $compName = $zeile['comp_name'];
            $compRegCode = $zeile['comp_regcode'];
            $compStartDate = $zeile['comp_start_date'];
            $compZip = $zeile['comp_zip'];
            $compStreet = $zeile['comp_street'];
            $compCity = $zeile['comp_city'];
            $compCountry = $zeile['comp_country'];
            $compLogo = $zeile['comp_logo'];
            $compTerms = $zeile['comp_terms'];
        }


        if ($compLogo != 0) {
            $logosrc = "uploads/host/complogo/$compLogo";
        } else {
            $logosrc = "img/image_placeholder.jpg";
        }

        if ($compTerms != 0) {
            $termsSrc = "uploads/host/terms/$compTerms";
        } else {
            $termsSrc = "img/image_placeholder.jpg";
        }


        /* $sql_user = "select * from tbl_user";
          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $q_user = $pdo->prepare($sql_user);
          $q_user->execute(array($userID));


          while ($zeile = $q_user->fetch(/* PDO::FETCH_ASSOC )) {

          $userName = $zeile['user_name'];
          $userFirstName = $zeile['user_firstname'];
          $userLastName = $zeile['user_lastname'];
          $userEmail = $zeile['user_email'];
          } */
        ?>



    </head>

    <body class="login-page">
        <nav class="navbar navbar-transparent navbar-absolute" id="sectionsNav">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">

                    <a class="navbar-brand" href="../index.php"><p><img style="width: 2em;" class="logo" src="../img/Logo.png" alt=""/><img style=" padding-left: .5em; width: 9em;" class="logo" src="../img/text.png" alt=""/></p></a>
                </div>


            </div>
        </nav>

        <div class="page-header header-filter" style="background-image: url('img/header2.jpg'); background-size: cover; background-position: top center;">
            <div class="container">
                <div class="row">

                    <div class="col-sm-8 col-sm-offset-2">

                        <div class="card card-signup">
                            <h2 class="wizard-title text-center"><?php echo $compName ?></h2>


                            <h5 class="text-center">Confirmation</h5>
                            <div class="row">
                                <div class="col-md-2 col-md-offset-5">
                                    <div class="avatar">
                                        <img class="media-object img-rounded img-responsive img-raised" alt="Logo" src="<?php echo $logosrc ?>">
                                    </div>

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-12 col-md-offset-1">
                                    <br>
                                    <br>
                                    <p>You are Registered for the Competition. You can find the Competition listed in your Athlete Section</p>
                                    <p>Good Luck in the Competition!</p>
                                </div>
                            </div>
                            <div class="row">
                                <div align="right" class="col-md-11 col-md-offset-0">

                                    <button class="btn btn-pinterest" type="button" onclick="window.open('', '_self', ''); window.close();">Close</button>
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
<script type="text/javascript">
                                        $().ready(function () {
                                            demo.initMaterialWizard();
                                        }
                                        );
</script>

</html>