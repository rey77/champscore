<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <?php include './header.php'; ?>



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

        </script>
    </head>

    <body style="background-color: <?php echo "#" . $desBgColor ?>">
    <?php
    $compID = $_GET['comp_id'];
    ?>

        <nav class="navbar top-nav navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="organizer.php"><img class="logo" src="../img/Logo.png" alt=""/><img class ="logo-text" src="../img/text.png" alt=""/></a>
            </div>
            <!-- Top Menu Items -->

        </nav>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand"><?php echo $compName ?>  <?php echo $compDate ?></a>
                </div>

                <ul class="nav navbar-nav">
                    <!--<li ><a href="competitionView.php?comp_id=<?php echo $compID ?>">COMPETITION</a></li> -->
                   <!-- <li class="active"><a href="ScoreboardView.php?comp_id=<?php echo $compID ?>">SCOREBOARD</a></li>-->

                    <!--<li><a href="registrationView.php?comp_id=<?php echo $compID ?>">REGISTRATION</a></li>-->
                </ul>
            </div>
        </nav>



        <div id="page-wrapper"  style="background-color: <?php echo "#" . $desBgColor ?>">


            <div class="container-fluid">

                <!-- Page Heading -->

                <div class="row"> 

                    <center>
                        <div class="img" style="background-image: url('<?php echo $logosrc ?>'); border:solid; border-color: <?php echo "#" . $desLogoFrameColor ?>;"></div>
                    </center>
                    <div class=" col-lg-2 col-lg-offset-5 col-md-2 col-md-offset-5 col-sm-4 col-sm-offset-4 col-xs-12 col-xs-offset-0 ">

                        <br>


                        <!--Renato  -->
                        <form class="form-horizontal"  method="post"> 

                            <div class = "form-group " >

                                <select class = "form-control" id = "selDiv" onChange="onSelectDivision('<?php echo $desWodBtnFontColor ?>', '<?php echo $desWodBtnBgColor ?>', <?php echo $compID ?>);">
                                    <option value="0">Select Division</option>
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

                    <div id ="result" class="col-lg-8 col-lg-offset-2 col-md-12 col-md-offset-0  col-sm-12 col-sm-offset-0 col-xs-12 col-xs-offset-0 ">


                    </div>


                </div>
            </div>

        </div>
        <!-- jQuery -->
        <script src="js/jquery.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>

    </body>

</html>
