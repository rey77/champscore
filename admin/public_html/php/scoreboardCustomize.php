<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <link rel="apple-touch-icon" sizes="76x76" href="img/apple-icon.png" />
        <link rel="icon" type="image/png" href="img/favicon-16x16.png" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>Material Dashboard Pro by Creative Tim</title>
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


        <?php
        $compID = $_GET['comp_id'];

        include 'Database.php';
        $pdo = Database::connect();

        $sql = "select comp_ID, comp_name, comp_date, comp_regcode, comp_active, comp_street, comp_zip, comp_state, comp_country, comp_logo from tbl_competition where comp_id = ?";

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $q = $pdo->prepare($sql);
        $q->execute(array($compID));

        while ($zeile = $q->fetch(/* PDO::FETCH_ASSOC */)) {

            $compID = $zeile['comp_ID'];
            $compName = $zeile['comp_name'];
            $compRegCode = $zeile['comp_regcode'];
            $compDate = $zeile['comp_date'];
            $compZip = $zeile['comp_zip'];
            $compStreet = $zeile['comp_street'];
            $compState = $zeile['comp_state'];
            $compCountry = $zeile['comp_country'];
            $compLogo = $zeile['comp_logo'];
        }


        if ($compLogo != 0) {
            $logosrc = "uploads/complogo/$compLogo";
        } else {
            $logosrc = "http://placehold.it/400x250/000/fff";
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

        <script type="text/javascript">

            $(function () {
                $('#cp2').colorpicker();

            });

            $(".colorchange").on("click", function (e) {
                alert('hallo');
                e.stopPropagation();
            });

            /* function onSelectDivision()
             {
             
             var div_ID = 'div_ID=' + document.getElementById("selDiv").options[document.getElementById("selDiv").selectedIndex].value;
             
             
             $.ajax({
             type: "POST",
             url: "ScoreboardViewSelWods.php",
             cache: false,
             data: div_ID,
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
             
             function onSelectWod(i_wod_ID, i_div_ID)
             {
             
             var wod_ID = 'wod_ID=' + i_wod_ID;
             var div_ID = '&div_ID=' + i_div_ID;
             var all = wod_ID + div_ID;
             
             
             $.ajax({
             type: "POST",
             url: "ScoreboardViewSelResults.php",
             cache: false,
             data: all,
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
             
             }*/

        </script>



    </head>

    <body class=".bodyBgColor" style="background-color: <?php echo "#" . $desBgColor ?>" >
    <?php
    $compID = $_GET['comp_id'];
    ?>

        <div class="wrapper">
            <div class="sidebar" data-active-color="rose" data-background-color="black" data-image="img/sidebar-1.jpg">
                <!--
            Tip 1: You can change the color of active element of the sidebar using: data-active-color="purple | blue | green | orange | red | rose"
            Tip 2: you can also add an image using data-image tag
            Tip 3: you can change the color of the sidebar with data-background-color="white | black"
                -->
                <div class="logo">
                    <a href="organizer.php" class="simple-text">
                        CHAMPSCORE
                    </a>
                </div>
                <div class="logo logo-mini">
                    <a href="http://www.creative-tim.com" class="simple-text">
                        CS
                    </a>
                </div>
                <div class="sidebar-wrapper">
                    <div class="user">
                        <div class="photo">
                            <img src="uploads/profile/<?php echo $_SESSION['user_id'] . ".jpg" ?>">
                        </div>
                        <div class="info">
                            <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                                <?php echo $_SESSION['username']; ?>
                                <b class="caret"></b>
                            </a>
                            <div class="collapse" id="collapseExample">
                                <ul class="nav">
                                    <li>
                                        <a href="#">My Profile</a>
                                    </li>
                                    <li>
                                        <a href="#">Edit Profile</a>
                                    </li>
                                    <li>
                                        <a href="#">Settings</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <ul class="nav">
                        <li class="active">
                            <a href="./index.php">
                                <i class="material-icons">dashboard</i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li>
                            <a href="./organizer.php">
                                <i class="material-icons">timer</i>
                                <p>My Competitions</p>
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
                            <a class="navbar-brand" href="#"> Division </a>
                        </div>
                        <div class="collapse navbar-collapse">
                            <ul class="nav navbar-nav navbar-right">
                                <li>
                                    <a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="material-icons">dashboard</i>
                                        <p class="hidden-lg hidden-md">Dashboard</p>
                                    </a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="material-icons">notifications</i>
                                        <span class="notification">5</span>
                                        <p class="hidden-lg hidden-md">
                                            Notifications
                                            <b class="caret"></b>
                                        </p>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="#">Mike John responded to your email</a>
                                        </li>
                                        <li>
                                            <a href="#">You have 5 new tasks</a>
                                        </li>
                                        <li>
                                            <a href="#">You're now friend with Andrew</a>
                                        </li>
                                        <li>
                                            <a href="#">Another Notification</a>
                                        </li>
                                        <li>
                                            <a href="#">Another One</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="material-icons">person</i>
                                        <p class="hidden-lg hidden-md">Profile</p>
                                    </a>
                                </li>
                                <li class="separator hidden-lg hidden-md"></li>
                            </ul>
                            <form class="navbar-form navbar-right" role="search">
                                <div class="form-group form-search is-empty">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <span class="material-input"></span>
                                </div>
                                <button type="submit" class="btn btn-white btn-round btn-just-icon">
                                    <i class="material-icons">search</i>
                                    <div class="ripple-container"></div>
                                </button>
                            </form>
                        </div>
                    </div>
                </nav>
                <div class="content">
                    <div class="container-fluid">
                        <div class="container-fluid well" style="overflow-y: auto; height:150px;">



                            <form name="formScoreboardCustomize" action="updateDesign.php"  method="POST" class="form-inline" >

                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <input type="hidden" name="compID" value="<?php echo $compID ?>" class="form-control" >

                                        <label>Background Color</label>
                                        <p><button style="width: 25px ;height: 25px" class=" jscolor {valueElement:'chosen-value-bodyBgColor', onFineChange:'setBodyBgColor(this)'} btn btn-default btn-md colorchange">
                                            </button>
                                            <input  class="form-control" name="bodyBgColor" id="chosen-value-bodyBgColor" value="<?php echo $desBgColor ?>">
                                        </p>

                                        <script>
                                            function setBodyBgColor(picker) {

                                                var x = document.getElementsByClassName('.bodyBgColor');
                                                var i;
                                                for (i = 0; i < x.length; i++) {
                                                    x[i].style.backgroundColor = '#' + picker.toString();
                                                }

                                            }
                                        </script>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6 col-sm-12">

                                    <div class="form-group">
                                        <label>Logo Frame Color </label>  
                                        <p><button style="width: 25px ;height: 25px" class="jscolor {valueElement:'chosen-value-logoFrameColor', onFineChange:'setLogoFrameColor(this)'} btn btn-default btn-md">

                                            </button>

                                            <input  class="form-control" name="logoFrameColor" id="chosen-value-logoFrameColor"  value="<?php echo $desLogoFrameColor ?>">
                                        </p>

                                        <script>
                                            function setLogoFrameColor(picker) {
                                                var x = document.getElementsByClassName('.logoFrameColor');
                                                var i;
                                                for (i = 0; i < x.length; i++) {
                                                    x[i].style.borderColor = '#' + picker.toString();
                                                }

                                            }
                                        </script>
                                    </div>
                                </div>



                                <div class="col-lg-3 col-md-6 col-sm-12">

                                    <div class="form-group">
                                        <label>WOD Button Background </label> 
                                        <p>
                                            <button style="width: 25px ;height: 25px" class="jscolor {valueElement:'chosen-value-wodBtnBgColor', onFineChange:'setWodBtnBgColor(this)'} btn btn-default btn-md">

                                            </button>

                                            <input  class="form-control" name="wodBtnBgColor" id="chosen-value-wodBtnBgColor" value="<?php echo $desWodBtnBgColor ?>">
                                        </p>


                                        <script>
                                            function setWodBtnBgColor(picker) {
                                                var x = document.getElementsByClassName('.wodBtnBgColor');
                                                var i;
                                                for (i = 0; i < x.length; i++) {
                                                    x[i].style.backgroundColor = '#' + picker.toString();
                                                }
                                            }
                                        </script>
                                    </div>
                                </div>


                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>WOD Color </label> 
                                        <p><button style="width: 25px ;height: 25px" class="jscolor{valueElement:'chosen-value-wodBtnFontColor', onFineChange:'setWodBtnFontColor(this)'} btn btn-default btn-md">
                                            </button>
                                            <input  class="form-control" name="wodBtnFontColor" id="chosen-value-wodBtnFontColor" value="<?php echo $desWodBtnFontColor ?>">
                                        </p>

                                        <script>
                                            function setWodBtnFontColor(picker) {

                                                var x = document.getElementsByClassName('.wodBtnFontColor');
                                                var i;
                                                for (i = 0; i < x.length; i++) {
                                                    x[i].style.color = '#' + picker.toString();
                                                }


                                            }
                                        </script>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6 col-sm-12">

                                    <div class="form-group">
                                        <label>WOD Description </label> 
                                        <p>
                                            <button style="width: 25px ;height: 25px" class="jscolor {valueElement:'chosen-value-wodDescColor', onFineChange:'setWodDescColor(this)'} btn btn-default btn-md">

                                            </button>

                                            <input  class="form-control" name="wodDescColor" id="chosen-value-wodDescColor" value="<?php echo $desWodDescColor ?>">
                                        </p>


                                        <script>
                                            function setWodDescColor(picker) {
                                                var x = document.getElementsByClassName('.wodDescColor');
                                                var i;
                                                for (i = 0; i < x.length; i++) {
                                                    x[i].style.color = '#' + picker.toString();
                                                }
                                            }
                                        </script>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6 col-sm-12">

                                    <div class="form-group">
                                        <label>Table Header Background </label> 
                                        <p>
                                            <button style="width: 25px ;height: 25px" class="jscolor {valueElement:'chosen-value-tableHeaderBgColor', onFineChange:'setTableHeaderBgColor(this)'} btn btn-default btn-md">

                                            </button>

                                            <input  class="form-control" name="tableHeaderBgColor" id="chosen-value-tableHeaderBgColor" value="<?php echo $desTableHeaderBgColor ?>">
                                        </p>


                                        <script>
                                            function setTableHeaderBgColor(picker) {
                                                var x = document.getElementsByClassName('.tableHeaderBgColor');
                                                var i;
                                                for (i = 0; i < x.length; i++) {
                                                    x[i].style.backgroundColor = '#' + picker.toString();
                                                }
                                            }
                                        </script>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">

                                    <div class="form-group">
                                        <label>Table Header Font </label> 
                                        <p>
                                            <button style="width: 25px ;height: 25px" class="jscolor {valueElement:'chosen-value-tableHeaderFontColor', onFineChange:'setTableHeaderFontColor(this)'} btn btn-default btn-md">

                                            </button>

                                            <input  class="form-control" name="tableHeaderFontColor" id="chosen-value-tableHeaderFontColor" value="<?php echo $desTableHeaderFontColor ?>">
                                        </p>


                                        <script>
                                            function setTableHeaderFontColor(picker) {
                                                var x = document.getElementsByClassName('.tableHeaderFontColor');
                                                var i;
                                                for (i = 0; i < x.length; i++) {
                                                    x[i].style.color = '#' + picker.toString();
                                                }
                                            }
                                        </script>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6 col-sm-12">

                                    <div class="form-group">
                                        <label>Table Body Background </label> 
                                        <p>
                                            <button style="width: 25px ;height: 25px" class="jscolor {valueElement:'chosen-value-tableBodyBgColor', onFineChange:'setTableBodyBgColor(this)'} btn btn-default btn-md">

                                            </button>

                                            <input  class="form-control" name="tableBodyBgColor" id="chosen-value-tableBodyBgColor" value="<?php echo $desTableBodyBgColor ?>">
                                        </p>


                                        <script>
                                            function setTableBodyBgColor(picker) {
                                                var x = document.getElementsByClassName('.tableBodyBgColor');
                                                var i;
                                                for (i = 0; i < x.length; i++) {
                                                    x[i].style.backgroundColor = '#' + picker.toString();
                                                }
                                            }
                                        </script>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">

                                    <div class="form-group">
                                        <label>Score </label> 
                                        <p>
                                            <button style="width: 25px ;height: 25px" class="jscolor {valueElement:'chosen-value-scoreColor', onFineChange:'setScoreColor(this)'} btn btn-default btn-md">

                                            </button>

                                            <input  class="form-control" name="scoreColor" id="chosen-value-scoreColor" value="<?php echo $desScoreColor ?>">
                                        </p>


                                        <script>
                                            function setScoreColor(picker) {
                                                var x = document.getElementsByClassName('.scoreColor');
                                                var i;
                                                for (i = 0; i < x.length; i++) {
                                                    x[i].style.color = '#' + picker.toString();
                                                }
                                            }
                                        </script>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6 col-sm-12">

                                    <div class="form-group">
                                        <label>Competitor </label> 
                                        <p>
                                            <button style="width: 25px ;height: 25px" class="jscolor {valueElement:'chosen-value-competitorColor', onFineChange:'setCompetitorColor(this)'} btn btn-default btn-md">

                                            </button>

                                            <input  class="form-control" name="competitorColor" id="chosen-value-competitorColor" value="<?php echo $desCompetitorColor ?>">
                                        </p>


                                        <script>
                                            function setCompetitorColor(picker) {
                                                var x = document.getElementsByClassName('.competitorColor');
                                                var i;
                                                for (i = 0; i < x.length; i++) {
                                                    x[i].style.color = '#' + picker.toString();
                                                }
                                            }
                                        </script>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6 col-sm-12">

                                    <div class="form-group">
                                        <label>Rank </label> 
                                        <p>
                                            <button style="width: 25px ;height: 25px" class="jscolor {valueElement:'chosen-value-rankColor', onFineChange:'setRankColor(this)'} btn btn-default btn-md">

                                            </button>

                                            <input  class="form-control" name="rankColor" id="chosen-value-rankColor" value="<?php echo $desRankColor ?>">
                                        </p>


                                        <script>
                                            function setRankColor(picker) {
                                                var x = document.getElementsByClassName('.rankColor');
                                                var i;
                                                for (i = 0; i < x.length; i++) {
                                                    x[i].style.color = '#' + picker.toString();
                                                }
                                            }
                                        </script>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6 col-sm-12">

                                    <div class="form-group">
                                        <label>Table Border </label> 
                                        <p>
                                            <button style="width: 25px ;height: 25px" class="jscolor {valueElement:'chosen-value-tableBorderColor', onFineChange:'setTableBorderColor(this)'} btn btn-default btn-md">

                                            </button>

                                            <input  class="form-control" name="tableBorderColor" id="chosen-value-setRankColor" value="000000">
                                        </p>

                                        <script>
                                            function setTableBorderColor(picker) {
                                                var x = document.getElementsByClassName('.tableBorderColor');
                                                var i;
                                                for (i = 0; i < x.length; i++) {
                                                    x[i].style.borderColor = '#' + picker.toString();
                                                }
                                            }
                                        </script>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12" align="right">
                                        <button type="submit" class="btn btn-custom-red btn-lg" name="submit" >Save</button><br></div>

                                </div>
                            </form>


                        </div>

                        <div class=".bodyBgColor" style="background-color: <?php echo "#" . $desBgColor ?>">


                            <div class="container-fluid">

                                <!-- Page Heading -->

                                <div class="row" > 

                                    <center>
                                        <img class="img" src="<?php echo $logosrc ?>">
                                    </center>

                                    <div class=" col-lg-2 col-lg-offset-5 col-md-2 col-md-offset-5 col-sm-4 col-sm-offset-4 col-xs-12 col-xs-offset-0 ">

                                        <br>


                                        <!--Renato  -->
                                        <form class="form-horizontal"  method="post"> 

                                            <div class = "form-group " >

                                                <select class = "form-control">
                                                    <option value="0">Select Division</option>

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
                                             white-space: pre;"  id ="wods">
                                             <?php
                                             for ($x = 0; $x <= 5; $x++) {
                                                 echo "<button class= \".wodBtnBgColor .wodBtnFontColor btn btn-lg\" style=\"background-color:#$desWodBtnBgColor; color:#$desWodBtnFontColor;\">Event " . $x . " </br> WOD " . $x .
                                                 "</button> ";
                                             }
                                             ?>
                                        </div>
                                        <br>
                                    </div>
                                </div>

                                <div class="row">
                                    <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class = ".wodDescColor" align ="center" style=" overflow: auto;
                                             word-wrap: normal;
                                             white-space: pre;
                                             color: <?php echo "#" . $desWodDescColor ?>">
                                            <p>WOD Description</p>

                                        </div>

                                    </div>


                                </div>
                                <div class="row">

                                    <div id ="result" class="col-lg-8 col-lg-offset-2 col-md-12 col-md-offset-0  col-sm-12 col-sm-offset-0 col-xs-12 col-xs-offset-0 ">

                                        <?php
                                        $testscore = 234;

                                        echo "<table class = \"table  table-responsive table-bordered .tableBorderColor\">";

                                        echo "<thead>
                                            <tr>
                                              <th class =\".tableHeaderBgColor .tableHeaderFontColor\" align=\"middle\" style=\"  min-width: 20%; color:#$desTableHeaderFontColor; background-color:#$desTableHeaderBgColor;\">RANK</th>
                                              <th class =\".tableHeaderBgColor .tableHeaderFontColor\" align=\"middle\" style=\"  min-width: 60%; color:#$desTableHeaderFontColor; background-color:#$desTableHeaderBgColor;\">ATHLETE</th>
                                              <th class =\".tableHeaderBgColor .tableHeaderFontColor\" align=\"middle\" style=\"  min-width: 20%; color:#$desTableHeaderFontColor; background-color:#$desTableHeaderBgColor;\">SCORE</th>
                                            </tr>
                            </thead><tbody>";
                                        for ($x = 1; $x <= 10; $x++) {



                                            echo"<tr class= \".tableBodyBgColor\" style=\"background-color:#$desTableBodyBgColor;\">
               
               <td align=\"middle\">
              <h2 class=\".rankColor\" style=\"color:#$desRankColor;\">" . $x . "</h2>
                  </td>
                                                   
                <td>
               <h2 class=\".competitorColor\" style=\"color:#$desCompetitorColor;\">Athlete " . $x . "</h2>
               </td>
                <td class=\".scoreColor\" style =\"color:#$desScoreColor;\">
                 <h2>" . $testscore . "</h2>
               </td>
               </tr>";


                                            $testscore = $testscore * 0.9;
                                        }
                                        ?>

                                    </div>


                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <footer class="footer">
                    <div class="container-fluid">
                        <nav class="pull-left">
                            <ul>
                                <li>
                                    <a href="#">
                                        Home
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        Company
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        Portfolio
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        Blog
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        <p class="copyright pull-right">
                            &copy;
                            <script>
                                document.write(new Date().getFullYear())
                            </script>
                            <a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
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


</html>




