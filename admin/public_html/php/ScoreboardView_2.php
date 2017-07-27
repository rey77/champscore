<?php
session_start();
?>

<?php
$compID = $_GET['comp_id'];

include 'Database.php';
$pdo = Database::connect();

$sql = "select comp_ID, comp_name, comp_logo, comp_main_color, comp_accent_color, comp_banner from tbl_competition where comp_id = ?";

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$q = $pdo->prepare($sql);
$q->execute(array($compID));

while ($zeile = $q->fetch(/* PDO::FETCH_ASSOC */)) {

    $compID = $zeile['comp_ID'];
    $compName = $zeile['comp_name'];
    $compLogo = $zeile['comp_logo'];
    $compBanner = $zeile['comp_banner'];
    $compMainColor = $zeile['comp_main_color'];
    $compAccentColor = $zeile['comp_accent_color'];
}

if ($compLogo != 0) {
    $logosrc = "uploads/complogo/$compLogo";
} else {
    $logosrc = "http://placehold.it/400x250/000/fff";
}
if ($compBanner != 0) {
    $bannersrc = "uploads/compbanner/$compBanner";
} else {
    $bannersrc = "img/banner.jpg";
}

//Standardwerte
$desBgColor = "EBEBEB";
$desLogoFrameColor = "000000";
$desWodBtnBgColor = "8B0000";
$desWodBtnFontColor = "FFFFFF";
$desWodDescColor = "000000";
$desTableHeaderBgColor = "000000";
$desTableHeaderFontColor = "FFFFFF";
$desTableBodyBgColor = "FFFFFF";
$desScoreColor = "000000";
$desCompetitorColor = "000000";
$desRankColor = "8B0000";
$desTableBorderColor = "FFFFFF";

$sql_des = "select design_ID,
        design_body_bg_color,
        design_logo_frame_color,
        design_wod_btn_bg_color,
        design_wod_btn_font_color,
        design_wod_desc_color,
        design_table_header_bg_color,
        design_table_header_font_color,
        design_table_body_bg_color,
        design_score_color,
        design_competitor_color,
        design_rank_color,
        design_table_border_color from tbl_design where fk_comp_id = ?";


$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$q_des = $pdo->prepare($sql_des);
$q_des->execute(array($compID));


while ($zeile = $q_des->fetch(/* PDO::FETCH_ASSOC */)) {
    $desID = $zeile['design_ID'];
    $desBgColor = $zeile['design_body_bg_color'];
    $desLogoFrameColor = $zeile['design_logo_frame_color'];
    $desWodBtnBgColor = $zeile['design_wod_btn_bg_color'];
    $desWodBtnFontColor = $zeile['design_wod_btn_font_color'];
    $desWodDescColor = $zeile['design_wod_desc_color'];
    $desTableHeaderBgColor = $zeile['design_table_header_bg_color'];
    $desTableHeaderFontColor = $zeile['design_table_header_font_color'];
    $desTableBodyBgColor = $zeile['design_table_body_bg_color'];
    $desScoreColor = $zeile['design_score_color'];
    $desCompetitorColor = $zeile['design_competitor_color'];
    $desRankColor = $zeile['design_rank_color'];
    $desTableBorderColor = $zeile['design_table_border_color'];
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>

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

        <script type="text/javascript">




            function onSelectDivision(i_wodBtnFontColor, i_wodBtnBgColor, i_comp_ID)
            {


                var div_ID = 'div_ID=' + document.getElementById("selDiv").options[document.getElementById("selDiv").selectedIndex].value;
                var wodBtnFontColor = '&wodBtnFontColor=' + i_wodBtnFontColor;
                var wodBtnBgColor = '&wodBtnBgColor=' + i_wodBtnBgColor;
                var compID = '&comp_ID=' + i_comp_ID;
                var data = div_ID + wodBtnFontColor + wodBtnBgColor + compID;


                $.ajax({
                    type: "POST",
                    url: "ScoreboardViewSelWods.php",
                    cache: false,
                    data: data,
                    success: function (html)
                    {
                        $('#wods').html(html);
                    },
                    error: function (html)
                    {

                        alert('error');
                    }

                }
                );

                return false;

            }

            function onSelectWod(i_wod_ID, i_div_ID, i_comp_ID)
            {


                var wod_ID = 'wod_ID=' + i_wod_ID;
                var div_ID = '&div_ID=' + i_div_ID;
                var comp_ID = '&comp_ID=' + i_comp_ID;


                var data = wod_ID + div_ID + comp_ID;

                $.ajax({
                    type: "POST",
                    url: "ScoreboardViewSelResults.php",
                    cache: false,
                    data: data,
                    success: function (html)
                    {
                        $('#result').html(html);
                    },
                    error: function (html)
                    {

                        alert('error');
                    }

                }
                );

                return false;

            }

            document.addEventListener('DOMContentLoaded', function () {

                onSelectDivision('<?php echo $desWodBtnFontColor ?>', '<?php echo $desWodBtnBgColor ?>', <?php echo $compID ?>);
                var div_ID = document.getElementById("selDiv").options[document.getElementById("selDiv").selectedIndex].value;

                onSelectWod(0, div_ID, <?php echo $compID ?>);


            }, false);

        </script>
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
                    <a class="navbar-brand" href="index.php"><p><img style="width: 2em;" class="logo" src="../img/Logo.png" alt=""/><img style=" padding-left: .5em; width: 9em;" class="logo" src="../img/text.png" alt=""/></p></a>
                </div>

                <!--<div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="../index.html">
                                <i class="material-icons">apps</i> Components
                            </a>
                        </li>

                        <li class="dropdown">
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
                        </li>

                        <li class="dropdown">
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
                        </li>

                        <li>
                            <a href="http://www.creative-tim.com/buy/material-kit-pro?ref=presentation" target="_blank" class="btn btn-white btn-simple">
                                <i class="material-icons">shopping_cart</i> Buy Now
                            </a>
                        </li>
                    </ul>
                </div> -->
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
                                    <img src="<?php echo $logosrc ?>" alt="Circle Image" style="border:solid; border-color: <?php echo "#".$compAccentColor?>"  class="img-rounded img-responsive img-raised">
                                </div>
                                <div class="name">
                                    <h3 class="title"><?php echo $compName ?></h3>
                                    <h6>Presented By CrossFit Jackhammer</h6>
                                    
                                </div>
                            </div>
                        </div>

                    </div>




                    <div class="container-fluid">

                        <!-- Page Heading -->

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

                                <div align ="center" class="center-align" style="overflow: auto" id ="wods"></div>


                            <!--<table class="table table-hover col-lg-12 col-md-12" id ="result" ></table>
                                -->
                            </div>
                        </div>

                        <div class="row">

                            <div id ="result" class="col-lg-12 col-lg-offset-0 col-md-12 col-md-offset-0  col-sm-12 col-sm-offset-0 col-xs-12 col-xs-offset-0 ">


                            </div>


                        </div>
                    </div>
                    <br><br><br><br>
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
