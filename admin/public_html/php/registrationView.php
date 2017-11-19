<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <?php include './header.php'; ?>

        <?php
        include 'Database.php';
        $pdo = Database::connect();

        $compID = $_GET['comp_id'];

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
        ?>

    </head>

    <body>
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
                <a class="navbar-brand" href="index.php">CHAMPSCORE®</a>
            </div>
            <!-- Top Menu Items -->

        </nav>
        <nav class="navbar navbar-default">

            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand"><?php echo $compName ?></a>
                </div>
                <ul class="nav navbar-nav">
                    <li><a href="competitionView.php?comp_id=<?php echo $compID ?>">COMPETITION</a></li>
                    <li><a href="ScoreboardView.php?comp_id=<?php echo $compID ?>">SCOREBOARD</a></li>
                    <li class="active"><a href="registrationView.php?comp_id=<?php echo $compID ?>">REGISTRATION</a></li>
                </ul>
            </div>
        </nav>



        <div id="page-wrapper">
            <center>
                <div class="img" style="background-image: url('<?php echo $logosrc ?>');"></div>
            </center>
            <br>

            <div   class="container well "  style="background-color: white" >
                <h1 class="page-header">
                    REGISTRATION
                </h1>

                <form class="form-vertical"  method="post"> 


                    <div class= " col-lg-4 col-lg-offset-4">
                        <div class = "form-group " >
                            <select class = "form-control" id = "selDiv" onChange="onSelectDivision();">
                                <option value="0">Select Division</option>
                                <?php
                                $sql_div = "SELECT div_name, div_ID FROM `tbl_division` where fk_comp_id =?";
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
                    </div>
                    <div class="col-lg-4 col-lg-offset-4">
                        <div class="form-group">
                            <input class ="form-control" type="text" name="fullName" placeholder="Athlete Name">
                            <!--<p class="help-block">Example block-level help text here.</p>-->
                        </div>
                    </div>

                    <div class="col-lg-4 col-lg-offset-4">
                        <div class="form-group">
                            <input class ="form-control" type="text" name="boxName" placeholder="Box Name">
                            <p class="help-block">If you are not in a Box, leave this empty</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-lg-offset-4">
                        <div class="form-group">
                            <input class ="form-control" type="password" name="regCode" placeholder="Registration Code">

                        </div>
                    </div>

                    <div class="col-lg-4 col-lg-offset-4">
                        <div class="form-group">
                            <input type="submit" class="btn btn-custom-red btn-lg" value="Submit" name="submit">

                        </div>
                    </div>
                </form>

            </div>
        </div>



        <!-- /#page-wrapper -->


        <!-- /#wrapper -->

        <!-- jQuery -->
        <script src="js/jquery.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>

    </body>

</html>
