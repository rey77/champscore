<?php
session_start();

if ($_SESSION['eingeloggt'] == false) {

    header("Location: public_html/ChampScoreIndex.php");
    exit();
}
?>
<html lang="en">

    <head>

        <?php include './header.php'; ?>
        <script type="text/javascript">

//Funktion zur Prüfung der Registrierungsdaten
            function mySubmitRegCode()
            {

                var comp = '&comp_ID=' + comp_ID;
                var code = document.getElementById('regcode' + comp_ID).value;
                var regcode = 'regcode=' + code;

                var division = '&div_ID=' + document.querySelector('input[name = "Division' + comp_ID + '" ]:checked').value;
                var all = regcode + comp + division;

                $.ajax({
                    type: "POST",
                    url: "checkRegCode.php",
                    cache: false,
                    data: all,
                    success: function (html)
                    {
                        $('#msg' + comp_ID).html(html);
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

    <body>

        <div id="wrapper">

            <!-- Navigation -->
            <?php include './navigation.php'; ?>

            <div id="page-wrapper">

                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">
                                Competition Registration
                            </h1>

                        </div>
                    </div>
                    <!-- /.row -->

                    <div>
                        <!-- /.row -->
                        <?php
                        require ("./public_html/php/loginsec/db.inc.php");

                        $link = mysqli_connect("localhost", $benutzer, $passwort);
                        mysqli_select_db($link, $dbname);
                        $compAbfrage = "select comp_ID, comp_name, comp_date, comp_logo from tbl_competition";
                        $compErgebnis = mysqli_query($link, $compAbfrage) or die(mysqli_error());


                        while ($compZeile = mysqli_fetch_array($compErgebnis, MYSQLI_ASSOC)) {
                            $comp_ID = $compZeile['comp_ID'];
                            $comp_name = $compZeile['comp_name'];
                            $comp_date = date('d.m.Y', strtotime($compZeile['comp_date']));

                            $compLogo = $compZeile['comp_logo'];
                            if ($compLogo != 0) {
                                $logosrc = "uploads/complogo/$compLogo";
                            } else {
                                $logosrc = "http://placehold.it/400x250/000/fff";
                            }


                            echo "<div class=\"col-lg-6 col-md-6 col-sm-6\">";
                            echo"<div class=\"panel panel-default\">";
                            echo"<div class=\"panel-body\">";



                            echo "<h4 class=\"group inner list-group-item-heading\"><b>" .
                            $comp_name . "</b></h4>";
                            echo "<img class=\"group list-group-image\"  alt=\"\"  />";


                            echo "<p class=\"group inner list-group-item-text\">" . $comp_date . "</p><br>";
                            echo "<img align =\"middle\" class=\"group list-group-image\" src=$logosrc alt=\"\" />"
                            . "<br><br>";

                            echo "<form name =\"formRegCodeEnter\" role=\"form\" onsubmit=\"return mySubmitRegCode()\">
                                                            <div class=\"form-group\">
                                                            <label>Registration Code</label>
                                                            <input <type=\"password\" id=\"regcode" . $comp_ID . "\"  class=\"form-control input-lg\">
                                                            </div>";

                            $link = mysqli_connect("localhost", $benutzer, $passwort);
                            mysqli_select_db($link, $dbname);
                            $DivAbfrage = "select div_ID, div_name from tbl_division where fk_comp_ID = " . $comp_ID;
                            $DivErgebnis = mysqli_query($link, $DivAbfrage) or die(mysqli_error());


                            echo "<div class=\"form-group\">
                                 <label>Select Division</label><br>";
                            while ($DivZeile = mysqli_fetch_array($DivErgebnis, MYSQLI_ASSOC)) {

                                $div_id = $DivZeile['div_ID'];
                                $div_name = $DivZeile['div_name'];



                                echo "<label class=\"radio-inline\">
                                            <input type=\"radio\" name=\"Division" . $comp_ID . "\"  value=\"$div_id\" checked> $div_name
                                        </label>";
                            }

                            echo "</div>";
                            echo "<div id=\"msg" . $comp_ID . "\">

                                                                 </div>
                                                            <button type=\"submit\" onclick= \"comp_ID=$comp_ID\" class=\"btn btn-custom-red btn-lg\" >Submit</button>
                                                        </form>";




                            echo"</div>";
                            echo"</div>";
                            echo "</div>";
                        }



                        mysqli_close($link);
                        ?>                    







                    </div>
                </div>
                <!-- /.container-fluid -->


            </div>
            <!-- /#page-wrapper -->


        </div>
        <!-- /#wrapper -->




    </body>

</html>
