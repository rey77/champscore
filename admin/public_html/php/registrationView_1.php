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
        <title>Registration</title>
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
        $sql = "select comp_ID, comp_name, comp_start_date, comp_banner, comp_regcode, comp_terms, comp_active, comp_street, comp_zip, comp_city, comp_country, comp_logo from tbl_competition where comp_id = ?";
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
            $compBanner = $zeile['comp_banner'];
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
        if ($compTerms != 0) {
            $bannersrc = "uploads/host/compbanner/$compBanner";
        } else {
            $bannersrc = "img/image_placeholder.jpg";
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


        <script type="text/javascript">
            function onChangeDivision() {
                var division = document.getElementById('division').value.split(',');
                var divID = division[0];
                var divIsTeam = division[1];
                var divTeamSize = division[2];
                document.getElementById("divID").value = divID;
                if (divIsTeam) {
                    // Number of tea to create
                    var number = divTeamSize;
                    // Container <div> where dynamic content will be placed
                    var container = document.getElementById("names");
                    // Clear previous contents of the container
                    while (container.hasChildNodes()) {
                        container.removeChild(container.lastChild);
                    }
                    //container.appendChild(document.createTextNode("Each Member will get an E-Mail to Confirm the Registration"));
                    for (i = 1; i <= number; i++) {
                        // Append a node with a random text
                        // Create an <input> element, set its type and name attributes
                        // var input = document.createElement("input");
                        //input.type = "text";
                        //input.name = "member" + i;
                        //input.class = "form-control";
                        var counter = i;
                        var suffix;
                        var captain;
                        switch (i) {
                            case 1:
                                suffix = "st";
                                captain = "& Team Captain";
                                break;
                            case 2:
                                suffix = "nd"
                                captain = "";
                                break;
                            case 3:
                                suffix = "rd"
                                captain = "";
                                break;
                            default:
                                suffix = "th"
                                captain = "";
                                break;
                        }
                        var newdiv = document.createElement('div' + counter);
                        if (counter === 1) {
                            var teamNameDiv = document.createElement('div');
                            teamNameDiv.innerHTML = "<div class=\"col-md-10 col-md-offset-0 form-group label-floating\"><input type='text' id='teamName' name='teamName'  class='form-control' placeholder ='Team Name' required>\n\
                                                    <input type='hidden' id='isTeam' name='isTeam'  class='form-control' value= '1'  required></div>";
                            container.appendChild(teamNameDiv);
                            newdiv.innerHTML = "<div class=\"col-md-5 col-md-offset-0 form-group label-floating\"><b>" + (counter + suffix) + " Member " + captain + "</b><br>\n\
                                            <input type='email' id='athleteEmail" + counter + "' name='athleteEmail[" + counter + "]' class='form-control' placeholder ='E-Mail' email='true' required><span id='athlete-result" + counter + "' ></span></div>";
                            //append("<input type='text'/><br/>");
                            // newdiv.innerHTML = "<div class=\"col-md-5 col-md-offset-0 form-group label-floating\"><b>" + (counter + suffix) + " Member " + captain + "</b><br><input type='text' id='firstName" + counter + "'  value= '' class='form-control' placeholder ='First Name' required>\n\
                            //<input type='text' id='lastName" + counter + "'  value= '' class='form-control' placeholder ='Last Name' required>\n\
                            //<input type='email' id='userEmail" + counter + "' name='userEmail[" + counter + "]' value= '' class='form-control' placeholder ='E-Mail' email='true' required><span id='user-result" + counter + "' ></span></div>";
                        } else {
                            newdiv.innerHTML = "<div class=\"col-md-5 col-md-offset-0 form-group label-floating has-success\"><b>" + (counter + suffix) + " Member</b><br>\n\
                                            <input type='email' id='athleteEmail" + counter + "'  name='athleteEmail[" + counter + "]' class='form-control' placeholder ='E-Mail' email='true' required><span id='athlete-result" + counter + "' ></span></div>";
                        }
                        container.appendChild(newdiv);
//check if username exists, important for teams
                        clearTimeout(x_timer); //clear any previously set 
                        var x_timer;
                        $('#athleteEmail' + counter).keyup(function (e) {
                            var athlete = this.value;
                            var id = this.getAttribute('id').substr(12);
                            e.preventDefault();
                            clearTimeout(x_timer);
                            x_timer = setTimeout(function () {
                                check_athlete_ajax(athlete, id);
                            }, 500);
                        });
                        function check_athlete_ajax(athlete, id) {
                            $.post('athlete_checker.php', {'athlete_email': athlete}, function (data) {


                                var exists;
                                var firstname;
                                var lastname;
                                $.each(data, function (key, value) {


                                    if (key === 0) {
                                        exists = value;
                                    }

                                    if (key === 1) {
                                        firstname = value;
                                    }
                                    if (key === 2) {
                                        lastname = value;
                                    }

                                }

                                );

                                if (exists === 1) {
                                    document.getElementById("btnRegister").disabled = false;
                                    var message = 'Athlete: ' + firstname + " " + lastname + ' <i class="material-icons">done</i>';
                                } else {

                                    document.getElementById("btnRegister").disabled = true;
                                    var message = 'Select an existing Athlete';
                                }
                                $('#athlete-result' + id).html(message);
                            }, "json");
                        }
                    }
                } else {
                    // Container <div> where dynamic content will be placed
                    var container = document.getElementById("names");
                    // Clear previous contents of the container
                    while (container.hasChildNodes()) {
                        container.removeChild(container.lastChild);
                    }
                    //container.appendChild(document.createTextNode("Each Member will get an E-Mail to Confirm the Registration"));
                    var newdiv = document.createElement('div');
                    //append("<input type='text'/><br/>");
                    newdiv.innerHTML = "<div class=\"col-md-2 col-md-offset-5\"><input type='hidden' id='isTeam' name='isTeam'  class='form-control' value= '0'  required>\n\
                                        <input type='text' name='firstName'  class='form-control' placeholder ='First Name' required>\n\
                                              <input type='text' name='lastName'  class='form-control' placeholder ='Last Name' required>\n\
                                            <input type='email' name='email' class='form-control' placeholder ='E-Mail' email='true' required></div>";
                    container.appendChild(newdiv);
                }
            }



            function mySubmitCompReg()
            {


                if ($("#division").val() == "") {
                    alert("Please select a Division");
                    document.formular.division.focus();
                    return false;
                }

                if (!this.form.optionsCheckboxes.checked)
                {

                    alert('You must agree to the terms first.');
                    return false;
                } else {

                    alert('haha');
                }


            }


        </script>


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

        <div class="page-header header-filter" style="background-image: url('<?php echo $bannersrc ?>'); background-size: cover; background-position: top center;">
            <div class="container">
                <div class="row">

                    <div class="col-sm-8 col-sm-offset-2">

                        <div class="card card-signup" style="opacity: 0.9">
                            <h2 class="wizard-title text-center"><?php echo $compName ?></h2>


                            <h5 class="text-center">Register for the Competition</h5>
                            <div class="row">
                                <div class="col-md-2 col-md-offset-5">
                                    <div class="avatar">
                                        <img class="media-object img-rounded img-responsive img-raised" alt="Tim Picture" src="<?php echo $logosrc ?>">
                                    </div>

                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-12 col-md-offset-1">

                                    <form class="form" onsubmit="return mySubmitCompReg()" method="POST" action="inputCompRegistration.php">
                                        <input type='hidden' id='compID' name='compID' class='form-control' value= '<?php echo $compID ?>'>
                                        <input type='hidden' id='divID' name='divID' class='form-control' >

                                        <div class="card-content">
                                            <div class="row">
                                                <div class="col-md-4 col-md-offset-3">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Select Division</label>
                                                        <select id ="division" name="division" class="form-control" onchange="onChangeDivision()" required>
                                                            <option disabled="" selected=""></option>


                                                            <?php
                                                            $sql_div = "SELECT div_name, div_ID, div_is_team, div_team_size FROM `tbl_division` where fk_comp_id =?";
                                                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                                            $q_div = $pdo->prepare($sql_div);
                                                            $q_div->execute(array($compID));
                                                            while ($zeile = $q_div->fetch(/* PDO::FETCH_ASSOC */)) {
                                                                $divName = $zeile['div_name'];
                                                                if ($zeile['div_is_team']) {
                                                                    $divName = 'Team - ' . $divName;
                                                                } else {
                                                                    $divName = 'Individual - ' . $divName;
                                                                }
                                                                echo "<option value=" . $zeile['div_ID'] . ',' . $zeile['div_is_team'] . ',' . $zeile['div_team_size'] . ">" . $divName . "</option>";
                                                            }
                                                            Database::disconnect();
                                                            ?>
                                                        </select>
                                                    </div>


                                                </div>
                                            </div>
                                            <div class="row">
                                                <br><br>
                                                <div id="names">


                                                </div>
                                            </div>
                                            <div align="right" class="col-md-11 col-md-offset-0">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="optionsCheckboxes" id="termsCheckbox" required>
                                                        I agree to the <a href="#something" data-toggle="modal" data-target="#myModal">I agree to the Terms and Conditions</a>.
                                                    </label>

                                                    <button id="btnRegister"  class="btn btn-pinterest" disabled>Register</button>

                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <div id="myModal" class="modal fade" role="dialog">
                            <div class="modal-dialog" style="width: 70%">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Terms & Conditions</h4>
                                    </div>
                                    <div class="modal-body" align="middle">
                                        <iframe src="<?php echo $termsSrc ?>" width="400" height="500" style="width: 70%"></iframe>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-pinterest" data-dismiss="modal">Close</button>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <!--      Wizard container        -->
                        <!--<div class="wizard-container">
                            <div class="card wizard-card" data-color="rose" id="wizardProfile">
                                <form action="" method="">
                                            You can switch " data-color="purple" "  with one of the next bright colors: "green", "orange", "red", "blue"    
                                    <div class="wizard-header">
                                        <h3 class="wizard-title">
                        <?php echo $compName ?>
                                        </h3>
                                        <h5>Register for the Competition</h5>
                                    </div>
                                    <div class="wizard-navigation">
                                        <ul>
                                            <li>
                                                <a href="#about" data-toggle="tab">Athlete</a>
                                            </li>
                                           
                                            <li>
                                                <a href="#address" data-toggle="tab">Finish</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tab-content">
                                        <div class="tab-pane" id="about">
                                            <div class="row">
                                                <h4 class="info-text"> Please fill in the required Information</h4>
                                                <div class="col-sm-6">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="material-icons">face</i>
                                                        </span>
                                                        
                                                    </div>
                                                </div>
                                                
                        <!--<div class="col-lg-10 col-lg-offset-1">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">email</i>
                                </span>
                                <div class="form-group label-floating">
                                    <label class="control-label">Email
                                        <small>(required)</small>
                                    </label>
                                    <input name="email" type="email" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="tab-pane" id="address">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4 class="info-text"> Please accept the agb to finish your registration </h4>
                        </div>
                        <div class="col-sm-7 col-sm-offset-1">
                            <div class="form-group label-floating">
                                <label class="control-label">Street Name</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group label-floating">
                                <label class="control-label">Street No.</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-5 col-sm-offset-1">
                            <div class="form-group label-floating">
                                <label class="control-label">City</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-group label-floating">
                                <label class="control-label">Country</label>
                                <select name="country" class="form-control">
                                    <option disabled="" selected=""></option>
                                    <option value="Afghanistan"> Afghanistan </option>
                                    <option value="Albania"> Albania </option>
                                    <option value="Algeria"> Algeria </option>
                                    <option value="American Samoa"> American Samoa </option>
                                    <option value="Andorra"> Andorra </option>
                                    <option value="Angola"> Angola </option>
                                    <option value="Anguilla"> Anguilla </option>
                                    <option value="Antarctica"> Antarctica </option>
                                    <option value="...">...</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="wizard-footer">
                <div class="pull-right">
                    <input type='button' class='btn btn-next btn-fill btn-pinterest btn-wd' name='next' value='Next' />
                    <input type='button' class='btn btn-finish btn-fill btn-pinterest btn-wd' name='finish' value='Finish' />
                </div>
                <div class="pull-left">
                    <input type='button' class='btn btn-previous btn-fill btn-default btn-wd' name='previous' value='Previous' />
                </div>
                <div class="clearfix"></div>
            </div>
        </form>
    </div>
</div>-->
                        <!-- wizard container -->
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
                                                            $("form").submit(function (e) {
                                                                var ref = $(this).find("[required]");
                                                                $(ref).each(function () {
                                                                    if ($(this).val() == '')
                                                                    {
                                                                        alert("Please provide all Information");
                                                                        $(this).focus();
                                                                        e.preventDefault();
                                                                        return false;
                                                                    }


                                                                });
                                                                return true;
                                                            });
    </script>

</html>