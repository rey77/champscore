<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>ChampScore</title>

        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="css/sb-admin.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <script type="text/javascript">


            $(function () {
                $('#cp2').colorpicker();
            });





        </script>
    </head>

    <body>

        <nav class="navbar top-nav navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">CHAMPSCORE®</a>
            </div>
            <!-- Top Menu Items -->

        </nav>

        <div id="bodycont">

            <div  class="collapse navbar-collapse navbar-ex1-collapse">

                <ul  class="nav navbar-nav side-nav">
                    <li>
                        <a> Background Color <button style="width: 25px ;height: 25px" class="jscolor {valueElement:'chosen-value-score', onFineChange:'setBGColorScore(this)'} btn btn-default btn-md">

                            </button></a>

                        <script>
                            function setBGColorScore(picker) {


                                $("#bodycont").css('background-color', '#' + picker.toString());
                                document.getElementsByID('bodycont')[0].style.color = '#' + picker.toString();
                                $("#bodycont2").css('background-color', '#' + picker.toString());
                                document.getElementsByID('bodycont2')[0].style.color = '#' + picker.toString();

                            }
                        </script>

                    </li>



                    <li>
                        <a> Title Color <button style="width: 25px ;height: 25px" class="jscolor {valueElement:'chosen-value-score', onFineChange:'setTextColorTitle(this)'} btn btn-default btn-md">

                            </button></a>

                        <script>
                            function setTextColorTitle(picker) {


                                $("#title").css('color', '#' + picker.toString());
                                document.getElementsByID('title')[0].style.color = '#' + picker.toString();


                            }
                        </script>

                    </li>
                    <li>
                        <a> Score Boxes <button style="width: 25px ;height: 25px" class="jscolor {valueElement:'chosen-value-score', onFineChange:'setBGColorScoreBox(this)'} btn btn-default btn-md">

                            </button></a>

                        <script>
                            function setBGColorScoreBox(picker) {


                                $("scoreBox").css('background-color', '#' + picker.toString());
                                document.getElementsByName('scoreBox')[0].style.color = '#' + picker.toString();


                            }
                        </script>
                    </li>

                    <li>
                    </li>

                    <li>

                    </li>

                    <!-- /.navbar-collapse -->
                </ul>
            </div>
            <center>

                <div  class="container-fluid">

                    <!-- Page Heading -->

                    <div  class="row" > 
                        <div  class=" col-lg-2 col-lg-offset-5 col-md-2 col-md-offset-5 col-sm-4 col-sm-offset-4 col-xs-12 col-xs-offset-0 ">


                            <?php
                            include 'Database.php';

                            $pdo = Database::connect();

                            $compID = $_GET['comp_ID'];

                            $sql = "SELECT comp_name from tbl_competition where comp_id = $compID";


                            foreach ($pdo->query($sql) as $row) {
                                echo "<h1 id=\"title\">" . $row['comp_name'] . "</h1>";
                            }
                            ?>
                            <br>

                            <!--Renato  -->
                            <form class="form-horizontal"  method="post"> 

                                <div class = "form-group " >

                                    <select class = "form-control" id = "selDiv" onChange="onSelectDivision();">
                                        <option value="0">Select Division</option>

                                        <?php
                                        $sql = "SELECT div_name, div_ID FROM `tbl_division` where fk_comp_id = $compID";

                                        foreach ($pdo->query($sql) as $row) {

                                            echo "<option value=" . $row['div_ID'] . ">" . $row['div_name'] . "</option>";
                                        }
                                        ?>


                                    </select>

                                </div>




                            </form>

                        </div>

                    </div>
                    <br> 



                    <div  class="row">
                        <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                            <div style=" overflow: auto;
                                 word-wrap: normal;
                                 white-space: pre;"  id ="wods">

                                <?php
                                for ($x = 0; $x <= 5; $x++) {
                                    echo "<button class= \"btn btn-custom-red btn-lg\">Event " . $x . " </br> WOD " . $x .
                                    "</button>";
                                }
                                ?>
                            </div>


                            <!--<table class="table table-hover col-lg-12 col-md-12" id ="result" ></table>
                            -->
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="row">

                        <div  class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12 col-xs-offset-0 " >
                            <div id ="result">
                                <?php
                                $testscore = 234;
                                for ($x = 1; $x <= 10; $x++) {


                                    echo "<div id=\"panel\" class=\"panel panel-primary \"  name =\"scoreBox\">


                                                <div class=\"panel-body\">

                                                    <div class=\"col-lg-2 col-md-2 col-sm-2 col-xs-2\" style=\"text-align: left\">

                                                        <h2 id=\"FCPlace\">" . number_format($x) . "</h2>
                                                    </div>

                                                    <div class=\"col-lg-7 col-md-7 col-sm-7 col-xs-7\" style=\"text-align: left\" >

                                                        <h2 id=\"FCName\">Athlete " . $x . "</h2>
                                                    </div>

                                                    <div class=\"col-lg-3 col-md-3 col-sm-3 col-xs-3\" style=\"text-align: right\">

                                                        <h2 id=\"FCScore\">" . number_format($testscore) . "</h2>
                                                    </div>


                                                </div>
                                            </div>";
                                    $testscore = $testscore * 0.9;
                                }
                                ?>
                            </div>
                        </div>
                    </div>


                    <!-- /.row -->

                </div>

                <!-- /.container-fluid -->

            </center></div>
        <!-- /#page-wrapper -->


        <!-- /#wrapper -->

        <!-- jQuery -->
        <script src="js/jquery.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>
        <script src="js/colorpicker/jscolor.js"></script>

    </body>

</html>
