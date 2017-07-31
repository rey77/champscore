<?php
session_start();
?>
<html lang="en">
    <head>

        <?php
        $compID = $_GET['comp_id'];


        include 'Database.php';
        $pdo = Database::connect();

        $sql = "select comp_ID, comp_name, comp_start_date,comp_end_date,comp_start_time, comp_banner, comp_end_time, comp_location_name, comp_start_time, comp_facebook_link, comp_instagram_link, comp_desc_long,comp_desc_short, comp_main_color, comp_accent_color, comp_regcode, comp_active, comp_street, comp_zip, comp_city, comp_country, comp_logo from tbl_competition where comp_id = ?";

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $q = $pdo->prepare($sql);
        $q->execute(array($compID));


        while ($zeile = $q->fetch(/* PDO::FETCH_ASSOC */)) {

            $compID = $zeile['comp_ID'];
            $compName = $zeile['comp_name'];
            $compRegCode = $zeile['comp_regcode'];
            $compStartDate = $zeile['comp_start_date'];
            $compStartTime = $zeile['comp_start_time'];
            $compEndDate = $zeile['comp_end_date'];
            $compEndTime = $zeile['comp_end_time'];
            $compZip = $zeile['comp_zip'];
            $compStreet = $zeile['comp_street'];
            $compCity = $zeile['comp_city'];
            $compCountry = $zeile['comp_country'];
            $compLogo = $zeile['comp_logo'];
            $compDescLong = $zeile['comp_desc_long'];
            $compDescShort = $zeile['comp_desc_short'];
            $compMainColor = $zeile['comp_main_color'];
            $compAccentColor = $zeile['comp_accent_color'];
            $compLocation = $zeile['comp_location_name'];
            $compFacebookLink = $zeile['comp_facebook_link'];
            $compInstagramLink = $zeile['comp_instagram_link'];
            $compBanner = $zeile['comp_banner'];
        }


        $compDescLongFormatted = nl2br(htmlentities($compDescLong, ENT_QUOTES, 'UTF-8'));
        $compDescShortFormatted = nl2br(htmlentities($compDescShort, ENT_QUOTES, 'UTF-8'));

        $sql_div = "SELECT div_name, div_ID FROM `tbl_division` where fk_comp_id = ?";

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $q_div = $pdo->prepare($sql_div);
        $q_div->execute(array($compID));

        $counter = 0;
        $arrayDivInit = array();
        while ($zeile = $q_div->fetch(/* PDO::FETCH_ASSOC */)) {
            $divID = $zeile['div_ID'];
            $arrayDivInit[$counter] = $divID;

            $counter++;
        }


        if ($compLogo != 0) {
            $logosrc = "uploads/host/complogo/$compLogo";
        } else {
            $logosrc = "img/image_placeholder.jpg";
        }

        if ($compBanner != 0) {
            $bannersrc = "uploads/host/compbanner/$compBanner";
        } else {
            $bannersrc = "img/banner.jpg";
        }
        ?>

        <meta charset="utf-8" />
        <link rel="apple-touch-icon" sizes="76x76" href="img/apple-icon.png">
        <link rel="icon" type="image/png" href="img/favicon-16x16.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <title><?php echo $compName ?></title>

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

        <!--     Fonts and icons     -->
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
        <link href="css/material-dashboard.css" rel="stylesheet" />
        <!-- CSS Files -->
        <link href="css/bootstrap.min.css" rel="stylesheet" />
        <link href="css/material-kit.css?v=1.1.0" rel="stylesheet"/>




    </head>

    <body class="profile-page">
        <nav class="navbar navbar-transparent navbar-absolute">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="../index.php"><p><img style="width: 2em;" class="logo" src="../img/Logo.png" alt=""/><img style=" padding-left: .5em; width: 9em;" class="logo" src="../img/text.png" alt=""/></p></a>

                   
                </div>

                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <!--<li>
                            <a href="../index.html">
                                <i class="material-icons">apps</i> Components
                            </a>
                        </li>-->

                        <!--<li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="material-icons">view_day</i> Sections
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu dropdown-with-icons">
                                <li>
                                    <a href="../sections.html#headers">
                                        <i class="material-icons">dns</i> Headers
                                    </a>
                                </li>
                                <li>
                                    <a href="../sections.html#features">
                                        <i class="material-icons">build</i> Features
                                    </a>
                                </li>
                                <li>
                                    <a href="../sections.html#blogs">
                                        <i class="material-icons">list</i> Blogs
                                    </a>
                                </li>
                                <li>
                                    <a href="../sections.html#teams">
                                        <i class="material-icons">people</i> Teams
                                    </a>
                                </li>
                                <li>
                                    <a href="../sections.html#projects">
                                        <i class="material-icons">assignment</i> Projects
                                    </a>
                                </li>
                                <li>
                                    <a href="../sections.html#pricing">
                                        <i class="material-icons">monetization_on</i> Pricing
                                    </a>
                                </li>
                                <li>
                                    <a href="../sections.html#testimonials">
                                        <i class="material-icons">chat</i> Testimonials
                                    </a>
                                </li>
                                <li>
                                    <a href="../sections.html#contactus">
                                        <i class="material-icons">call</i> Contacts
                                    </a>
                                </li>

                            </ul>
                        </li>-->

                        <!-- <li class="dropdown">
                             <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                 <i class="material-icons">view_carousel</i> Examples
                                 <b class="caret"></b>
                             </a>
                             <ul class="dropdown-menu dropdown-with-icons">
                                 <li>
                                     <a href="../examples/about-us.html">
                                         <i class="material-icons">account_balance</i> About Us
                                     </a>
                                 </li>
                                 <li>
                                     <a href="../examples/blog-post.html">
                                         <i class="material-icons">art_track</i> Blog Post
                                     </a>
                                 </li>
                                 <li>
                                     <a href="../examples/blog-posts.html">
                                         <i class="material-icons">view_quilt</i> Blog Posts
                                     </a>
                                 </li>
                                 <li>
                                     <a href="../examples/contact-us.html">
                                         <i class="material-icons">location_on</i> Contact Us
                                     </a>
                                 </li>
                                 <li>
                                     <a href="../examples/landing-page.html">
                                         <i class="material-icons">view_day</i> Landing Page
                                     </a>
                                 </li>
                                 <li>
                                     <a href="../examples/login-page.html">
                                         <i class="material-icons">fingerprint</i> Login Page
                                     </a>
                                 </li>
                                 <li>
                                     <a href="../examples/pricing.html">
                                         <i class="material-icons">attach_money</i> Pricing Page
                                     </a>
                                 </li>
                                 <li>
                                     <a href="../examples/ecommerce.html">
                                         <i class="material-icons">shop</i> Ecommerce Page
                                     </a>
                                 </li>
                                 <li>
                                     <a href="../examples/product-page.html">
                                         <i class="material-icons">beach_access</i> Product Page
                                     </a>
                                 </li>
                                 <li>
                                     <a href="../examples/profile-page.html">
                                         <i class="material-icons">account_circle</i> Profile Page
                                     </a>
                                 </li>
                                 <li>
                                     <a href="../examples/signup-page.html">
                                         <i class="material-icons">person_add</i> Signup Page
                                     </a>
                                 </li>
                             </ul>
                         </li>-->


                    </ul>
                </div>
            </div>
        </nav>


        <div class="page-header header-filter" data-parallax="true" style="background-image: url('<?php echo $bannersrc ?>');"></div>

        <div class="main main-raised">
            <div class="profile-content">
                <div class="container">

                    <div class="row">
                        <div class="col-xs-6 col-xs-offset-3">
                            <div class="profile">
                                <div class="avatar">
                                    <img src="<?php echo $logosrc ?>" alt="Circle Image" style="border: solid; border-color: <?php echo "#" . $compAccentColor ?>" class="img-rounded img-responsive img-raised">
                                </div>
                                <div class="name">
                                    <h3 class="title"><?php echo $compName ?></h3>
                                    <h6>Presented By CrossFit Jackhammer</h6>
                                    <?php if ($compFacebookLink != "") { ?>
                                        <a href = "<?php echo $compFacebookLink ?>" target="_blank" class = "btn btn-just-icon btn-simple btn-facebook"><i class = "fa fa-facebook"></i></a>

                                    <?php } ?>
                                    <?php if ($compInstagramLink != "") { ?>
                                        <a href = "<?php echo $compInstagramLink ?>" target="_blank" class = "btn btn-just-icon btn-simple btn-instagram"><i class = "fa fa-instagram"></i></a>

                                    <?php } ?>
                                </div>

                            </div>

                        </div>
                        <div class="col-xs-12  col-sm-12  col-lg-12   text-center">
                            <a class="btn" style="background:<?php echo '#' . $compAccentColor ?>" href = "registrationView_1.php?comp_id=<?php echo $compID ?>" target="_blank" >
                                <i class="material-icons">person_add</i> Register for this Competition
                            </a> 
                        </div>

                        <!--<div class="col-xs-3 follow">
                           <button class="btn btn-fab btn-pinterest" rel="tooltip" title="Register">
                            <i class="material-icons">register</i>
                            <a href = "registrationView_1.php?comp_id=<?php echo $compID ?>" target="_blank" ></a>

                        </button>
                        </div>-->
                    </div>


                    <!--<div class = "description text-center">
                    <p><?php echo $compDescShortFormatted
                                    ?></p>
                </div>-->

                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="profile-tabs">
                                <div class="nav-align-center">
                                    <ul  class="nav nav-pills nav-pills-white nav-pills-icons"  role="tablist">
                                        <li  class="active">
                                            <a  href="#competition" role="tab" data-toggle="tab">
                                                <i class="material-icons">timer</i>
                                                Competition
                                            </a>
                                        </li>
                                        <li  >
                                            <a  href="#workouts" role="tab" data-toggle="tab">
                                                <i class="material-icons">fitness_center</i>
                                                Workouts
                                            </a>
                                        </li>
                                        <li >
                                            <a  href="ScoreboardView_2.php?comp_id=<?php echo$compID ?>" target ="_blank" >
                                                <i class="material-icons">list</i>
                                                Leaderboard
                                            </a>
                                        </li>

                                    </ul>


                                </div>
                            </div>
                            <!-- End Profile Tabs -->
                        </div>
                    </div>
                    <br>
                    <br>


                    <br><br>
                    <div class="tab-content">
                        <div class="tab-pane active competition" id="competition">
                            <div class="row">
                                <div class="col-md-7 col-md-offset-1"><h3 class="title"> <?php echo $compName ?></h3>
                                    <br><p><?php echo $compDescLongFormatted ?></p>
                                </div>



                                <div class="col-md-2 col-md-offset-1 stats">
                                    <h4 class="title">When</h4>
                                    <ul class="list-unstyled">
                                        <li><b>from</b></li>
                                        <li><?php echo $compStartDate ?></li>
                                        <li><?php echo $compStartTime ?></li>
                                        <li><b>to</b></li>
                                        <li><?php echo $compEndDate ?></li>
                                        <li><?php echo $compEndTime ?></li>
                                    </ul>
                                    <hr />
                                    <h4 class="title">Where</h4>
                                    <ul class="list-unstyled">
                                        <li><b><?php echo $compLocation ?></b></li>
                                        <li><?php echo $compStreet ?></li>
                                        <li><?php echo $compZip ?></li>
                                        <li><?php echo $compCity ?></li>
                                        <li><?php echo $compCountry ?></li>
                                    </ul>
                                    <hr />
                                    <h4 class="title">Sponsors</h4>
                                    <ul class="list-unstyled">
                                        <li>VOGT TRAINING Equipment</li>
                                    </ul><br>

<!-- <p class="description">Vogttraining Equipment</p>-->
                                    <!--<hr />
                                    <!--<h4 class="title">Focus</h4>
                                    <span class="label label-primary">Footwear</span>
                                    <span class="label label-rose">Luxury</span>-->
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane leaderboard" id="leaderboard">


                            <div class="row"> 


                                <div class=" col-lg-2 col-lg-offset-5 col-md-2 col-md-offset-5 col-sm-4 col-sm-offset-4 col-xs-12 col-xs-offset-0 ">

                                    <br>


                                    <!--Renato  -->
                                    <form class="form-horizontal"  method="post"> 

                                        <div class = "form-group " >

                                            <select class = "form-control" id = "selDiv" onChange="onSelectDivision('<?php echo $desWodBtnFontColor ?>', '<?php echo $desWodBtnBgColor ?>', <?php echo $compID ?>);">

                                                <?php
                                                $sql_div = "SELECT div_name, div_ID FROM `tbl_division` where fk_comp_id = ?";

                                                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                                $q_div = $pdo->prepare($sql_div);
                                                $q_div->execute(array($compID));


                                                while ($zeile = $q_div->fetch(/* PDO::FETCH_ASSOC */)) {
                                                    echo "<option value=" . $zeile['div_ID'] . ">" . $zeile['div_name'] . "</option>";
                                                }

                                                Database::disconnect();
                                                ?>


                                            </select>

                                        </div>

                                    </form>

                                </div>

                            </div>
                            <br> 

                            <div  class="row">
                                <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                    <div align ="center" style=" overflow: auto;
                                         word-wrap: normal;
                                         white-space: pre;"  id ="wods"></div>


                            <!--<table class="table table-hover col-lg-12 col-md-12" id ="result" ></table>
                                    -->
                                </div>
                            </div>
                            <div class="row">

                                <div id ="result" class="col-lg-12 col-lg-offset-0 col-md-12 col-md-offset-0  col-sm-12 col-sm-offset-0 col-xs-12 col-xs-offset-0 ">


                                </div>


                            </div>
                            <!--   <div class="row">
   
                                   <div class="col-lg-12 col-md-12">
                                       
                                       
                                       
                                       <form class="form-horizontal" action="ScoreboardView_1.php?comp_id=<?php echo$compID ?>">
                                           <div style="display:none;">
                                               <input type="hidden" name="comp_id" value="<?php echo $compID ?>">
                                           </div>
                                           <div class="row">
                                               <label class="col-md-3"></label>
                                               <div class="col-md-9">
                                                   <div class="form-group form-button">
                                                       <button type="submit" class="btn pull-left btn-fill btn-danger">Grid Leaderboard</button>
                                                   </div>
                                               </div>
                                           </div>
                                       </form>
                                       <form class="form-horizontal" action="ScoreboardView_2.php?comp_id=<?php echo$compID ?>">
                                           <div style="display:none;">
                                               <input type="hidden" name="comp_id" value="<?php echo $compID ?>">
                                           </div>
                                           <div class="row">
                                               <label class="col-md-3"></label>
                                               <div class="col-md-9">
                                                   <div class="form-group form-button">
                                                       <button type="submit" class="btn pull-left btn-fill btn-danger">Leaderboard 2</button>
                                                   </div>
                                               </div>
                                           </div>
                                       </form>
                                   </div>
                               </div>-->
                        </div>
                        <div class = "tab-pane text-center workouts" id = "workouts">

                            <div class="row">

                                <div class="col-lg-12 col-md-12">
                                    <div class="card">
                                        <div class="card-header card-header-tabs" data-background-color="white" style="background:<?php echo '#' . $compMainColor ?>;
                                             box-shadow: 0 4px 20px 0px rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(0, 0, 0, 0.4); color: <?php echo '#' . $compAccentColor ?>">
                                            <div class="nav-tabs-navigation">
                                                <div class="nav-tabs-wrapper">
                                                    <span class="nav-tabs-title"><b>Divisions</b></span>
                                                    <ul class="nav nav-tabs" data-tabs="tabs" style="color: <?php echo '#' . $compAccentColor ?>">

                                                        <?php
                                                        $sql_div = "SELECT div_name, div_ID FROM `tbl_division` where fk_comp_id = ?";

                                                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                                        $q_div = $pdo->prepare($sql_div);
                                                        $q_div->execute(array($compID));

                                                        $arrayDiv = array();
                                                        $counter = 0;

                                                        while ($zeile = $q_div->fetch(/* PDO::FETCH_ASSOC */)) {
                                                            $divID = $zeile['div_ID'];
                                                            $divName = $zeile['div_name'];
                                                            $arrayDiv[$counter] = $divID;

                                                            if ($counter == 0) {
                                                                $liActive = 'active';
                                                            } else {
                                                                $liActive = '';
                                                            }
                                                            $counter++;
                                                            ?>

                                                            <li class="<?php echo $liActive ?>">
                                                                <a href="#WDiv<?php echo $divID ?>" data-toggle="tab">
                                                                    <?php echo $divName; ?>
                                                                    <div class="ripple-container"></div>
                                                                </a>
                                                            </li>
                                                            <?php
                                                        }
                                                        ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-content">
                                            <div class="tab-content">
                                                <?php
                                                $counter = 0;

                                                foreach ($arrayDiv as $valueDiv) {

                                                    if ($counter == 0) {

                                                        $paneActive = 'active';
                                                    } else {
                                                        $paneActive = '';
                                                    }

                                                    echo "<div class =\"tab-pane WDiv$valueDiv $paneActive\" id =\"WDiv$valueDiv\">";
                                                    ?>  


                                                    <?php
                                                    $sql_wod_colspan = "select * from tbl_wod where fk_div_id = ?";
                                                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                                    $q_wod_colspan = $pdo->prepare($sql_wod_colspan);
                                                    $q_wod_colspan->execute(array($valueDiv));

                                                    while ($zeile = $q_wod_colspan->fetch(/* PDO::FETCH_ASSOC */)) {
                                                        $wodID = $zeile['wod_ID'];
                                                        $wodName = $zeile['wod_name'];
                                                        $wodDesc = $zeile['wod_desc'];
                                                        $wodDescFormatted = nl2br(htmlentities($wodDesc, ENT_QUOTES, 'UTF-8'));
                                                        ?>

                                                        <div class="card-content">

                                                            <div class="row">
                                                                <div class="col-md-12">



                                                                    <div class = "panel-group" id = "accordion" role = "tablist" aria-multiselectable = "true">
                                                                        <div class = "panel panel-default">
                                                                            <?php echo"<div class=\"panel-heading\" role=\"tab\" id=\"heading$wodID\">";
                                                                            ?>

                                                                            <?php echo"<a role=\"button\" data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapse$wodID\" aria-expanded=\"true\" aria-controls=\"collapse$wodID\">"; ?>
                                                                            <h4 class="panel-title">
                                                                                <b><?php echo $wodName ?></b>
                                                                                <i class="material-icons">keyboard_arrow_down</i>
                                                                            </h4>
                                                                            <?php
                                                                            echo"</a>";
                                                                            echo"</div>";
                                                                            ?>

                                                                            <?php echo"<div id=\"collapse$wodID\" class=\"panel-collapse collapse out\" role=\"tabpanel\" aria-labelledby=\"heading$wodID\">";
                                                                            ?>
                                                                            <div class="panel-body">

                                                                                <div class="col-md-6" align="left">
                                                                                    <?php echo "<p><h4>$wodDescFormatted</h4></p>"; ?>
                                                                                </div>
                                                                            </div>


                                                                            <?php
                                                                            echo"</div>";
                                                                            ?>
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                                <!--  end card  -->
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <!-- end col-md-12 -->



                                                    <?php
                                                    $counter++;
                                                    echo "</div>";
                                                }
                                                Database::disconnect();
                                                ?>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>


        <footer class = "footer">
            <div class = "container">
                <nav class = "pull-left">
                    <ul>
                        <li>
                            <a href = "http://www.creative-tim.com">
                                Creative Tim
                            </a>
                        </li>
                        <li>
                            <a href = "http://presentation.creative-tim.com">
                                About Us
                            </a>
                        </li>
                        <li>
                            <a href = "http://blog.creative-tim.com">
                                Blog
                            </a>
                        </li>
                        <li>
                            <a href = "http://www.creative-tim.com/license">
                                Licenses
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class = "copyright pull-right">
                    &copy;
                    <script>document.write(new Date().getFullYear())</script>, made with <i class="fa fa-heart heart"></i> by Creative Tim
                </div>
            </div>
        </footer>


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

    <!--  DataTables.net Plugin    -->
    <script src="js/jquery.datatables.js"></script>

    <!--    Plugin For Google Maps   -->
    <script  type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

    <!--    Plugin for 3D images animation effect, full documentation here: https://github.com/drewwilson/atvImg    -->
    <script src="js/atv-img-animation.js" type="text/javascript"></script>



    <!--    Control Center for Material Kit: activating the ripples, parallax effects, scripts from the example pages etc    -->
    <script src="js/material-kit.js?v=1.1.0" type="text/javascript"></script>





    <script type="text/javascript">
                        $(document).ready(function () {

<?php foreach ($arrayDivInit as $valueDivInit) { ?>
                                var value = <?php echo $valueDivInit ?>;


                                $('#datatables' + value).DataTable({
                                    "pagingType": "full_numbers",

                                    "lengthMenu": [
                                        [10, 25, 50, -1],
                                        [10, 25, 50, "All"]
                                    ],
                                    paging: false,
                                    responsive: true,
                                    language: {
                                        search: "_INPUT_",
                                        searchPlaceholder: "Search records",
                                    }

                                });


                                var table = $('#datatables' + value).DataTable();

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

<?php } ?>
                        });
    </script>

</html>
