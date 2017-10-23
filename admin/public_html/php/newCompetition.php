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
        <script src="js/colorpicker/jscolor.js"></script>
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
                        <div class="photo">
                            <img src="uploads/host/profile/<?php echo $_SESSION['host_id'] . ".jpg" ?>">
                        </div>
                        <div class="info">
                            <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                                <?php echo $_SESSION['hostEmail']; ?>
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
                                <p>ALL COMPETITIONS</p>
                            </a>
                        </li>
                        <li  class="active">

                            <a href="./hostCompetitions.php">
                                <i class="material-icons">dashboard</i>
                                <p>MY COMPETITIONS</p>

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
                            <a class="navbar-brand" href="#"> NEW COMPETITION </a>
                        </div>

                    </div>
                </nav>
                <div class="content">
                    <div class="container-fluid">

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-text" data-background-color="oxfordblue">
                                    <h4 class="card-title">NEW</h4>

                                </div>
                                <div class="card-content">

                                    <form name ="compData" role="form" action="inputComp.php" method="POST" enctype="multipart/form-data">
                                        <div class="row">

                                            <div class="col-lg-6" align="center">
                                                <h3>COMPETITION LOGO <i class="material-icons">image</i></h3>
                                                <p class="text-muted">
                                                    This is the Logo of the Competition. Choose a big enough image
                                                </p>
                                                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail">
                                                        <img src="img/image_placeholder.jpg" alt="...">
                                                    </div>
                                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                                    <div>
                                                        <span class="btn btn-pinterest btn-round btn-file">
                                                            <span class="fileinput-new">Select Logo</span>
                                                            <span class="fileinput-exists">Change</span>
                                                            <input type="file" name="compLogo" id="compLogo" required/>
                                                        </span>
                                                        <a href="#pablo" class="btn btn-pinterest btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6" align="center">
                                                <h3>CCOMPETITION BANNER <i class="material-icons">image</i></h3>
                                                <p class="text-muted">
                                                    This is the big picture displayed on the top of your Competition Page
                                                </p>
                                                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail">
                                                        <img src="img/image_placeholder.jpg" alt="...">
                                                    </div>
                                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                                    <div>
                                                        <span class="btn btn-pinterest btn-round btn-file">
                                                            <span class="fileinput-new">Select Banner</span>
                                                            <span class="fileinput-exists">Change</span>
                                                            <input type="file" name="compBanner" id="compBanner" required/>
                                                        </span>
                                                        <a href="#pablo" class="btn btn-pinterest btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <hr>
                                        <h3>COMPETITION TYPE <i class="material-icons">view_compact</i></h3>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="compType" checked="true" value="live"> Live Competition
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="compType" value="qualifier"> Qualifier
                                                    </label>
                                                </div>
                                            </div>


                                        </div>
                                        <hr>
                                        <h3>GENERAL <i class="material-icons">reorder</i></h3></h3>

                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Competition Name</label>
                                                    <input type="text" name="compName"  class="form-control" required >
                                                    <!--<p class="help-block">Example block-level help text here.</p>-->
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Registration Code</label>
                                                    <input type="text" name="compRegCode"  class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Short Description</label>
                                                    <input type ="text" class="form-control"  name="compDescShort" required/>
                                                                                                <!--<p class="help-block">Example block-level help text here.</p>-->
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Long Description</label>
                                                    <textarea class="form-control" style="resize: none; height: 100px;" name="compDescLong" required></textarea>
                                                                                                <!--<p class="help-block">Example block-level help text here.</p>-->
                                                </div>
                                            </div>

                                        </div>
                                        <hr>
                                        <h3>WHEN <i class="material-icons">watch_later</i></h3>
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Date of Competition</label>
                                                    <input type="date" name="compStartDate"  class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Start Time</label>
                                                    <input type="time" name="compStartTime"  class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">End Date</label>
                                                    <input type="date" name="compEndDate"  class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">End Time</label>
                                                    <input type="time" name="compEndTime"  class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <h3>WHERE <i class="material-icons">location_on</i></h3>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Location Name</label>
                                                    <input type="text" name="compLocation"  class="form-control" required>
                                                </div>
                                            </div>


                                            <div class="col-lg-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Street</label>
                                                    <input type="text" name="compStreet"  class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">ZIP</label>
                                                    <input type="text" name="compZip"  class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">City</label>
                                                    <input type="text" name="compCity"  class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Country</label>
                                                    <input type="text" name="compCountry"  class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <h3>SOCIAL MEDIA <i class="material-icons">share</i></h3>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Link to Facebook Page</label>
                                                    <input type="text" name="compFacebookLink"  class="form-control" >
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Link to Instagram Page</label>
                                                    <input type="text" name="compInstagramLink"  class="form-control" >
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <h3>COLORS <i class="material-icons">invert_colors</i></h3>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group label-floating">
                                                    <label>Main Color</label>
                                                    <p><button style="width: 25px; height: 25px" class="jscolor {valueElement:'chosen-value-mainColor', value:'0B2545', onFineChange:'setBodyBgColor(this)'} btn btn-round btn-md colorchange">
                                                        </button>
                                                        <input  class="form-control" name="compMainColor" id="chosen-value-mainColor" >
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group label-floating">
                                                    <label>Accent Color</label>
                                                    <p><button style="width: 25px; height: 25px" class=" jscolor {valueElement:'chosen-value-accentColor', value:'cc2127', onFineChange:'setBodyBgColor(this)'} btn btn-round btn-md colorchange">
                                                        </button>
                                                        <input  class="form-control" name="compAccentColor" id="chosen-value-accentColor" >
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <h3>TERMS AND CONDITIONS <i class="material-icons">assignment</i></h3>

                                        <div class="col-lg-12" align="center">

                                            <div class="fileinput fileinput-new text-center" data-provides="fileinput">

                                                <div class="fileinput-new ">
                                                </div>
                                                <div class="fileinput-preview fileinput-exists"></div>
                                                <div>
                                                    <span class="btn btn-pinterest btn-round btn-file">
                                                        <span class="fileinput-new">Select PDF File</span>
                                                        <span class="fileinput-exists">Change</span>
                                                        <input type="file" accept="application/pdf" name="compTerms" id="compTerms"  />
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
    <!--   Core 
    Files   -->
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
