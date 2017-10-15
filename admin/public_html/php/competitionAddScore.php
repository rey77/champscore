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

        <script type="text/javascript">


            function onSelectDivision(compID)
            {
                
                var div_ID = 'div_ID=' + document.getElementById("selDiv").options[document.getElementById("selDiv").selectedIndex].value;
                var comp_ID = '&comp_ID=' + compID;

                var param = div_ID + comp_ID;
                $.ajax({
                    type: "POST",
                    url: "addScoreSelectDivisions.php",
                    cache: false,
                    data: param,
                    success: function (html)
                    {
                        $('#sel').html(html);
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

        <div class="wrapper">
            <div class="sidebar" data-active-color="darkred" data-background-color="black" data-image="img/sidebar-1.jpg">
                <!--
            Tip 1: You can change the color of active element of the sidebar using: data-active-color="purple | blue | green | orange | red | rose"
            Tip 2: you can also add an image using data-image tag
            Tip 3: you can change the color of the sidebar with data-background-color="white | black"
                -->
                <div class="logo">
                    <a href="index.php" class="simple-text">
                        <p><!--<img style=" margin-left: -20px; height: 70px;" class="logo" src="../img/Logo.png" alt=""/>-->
                            <img style="  height: 20px;" src="img/text.png" alt=""/></p>
                    </a>
                    
                </div>
                <div class="logo logo-mini">
                    <a href="index.php" class="simple-text">
                        CS
                    </a>
                </div>
                <div class="sidebar-wrapper">
                    <div class="user">
                        <div class="photo">
                            <img src="uploads/profile/<?php echo $_SESSION['host_id'] . ".jpg" ?>">
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
                               <p>MY COMPETTIONS</p>
                            
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
                            <a class="navbar-brand" href="#"> SCORES </a>
                        </div>
                        
                    </div>
                </nav>
                <div class="content">
                    <div class="row">
                    <div class="col-lg-3 container-fluid align-right">

                        <?php
                        $compID = $_GET['comp_ID'];
                        include 'Database.php';
                        $pdo = Database::connect();


                        $sql_comp = "select comp_ID, comp_name from tbl_competition where comp_id = ?";

                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $q_comp = $pdo->prepare($sql_comp);
                        $q_comp->execute(array($compID));


                        while ($zeile = $q_comp->fetch(/* PDO::FETCH_ASSOC */)) {

                            $compID = $zeile['comp_ID'];
                            $compName = $zeile['comp_name'];
                        }
                        ?>

                        <select class = "selectpicker form-control" data-style="btn btn-darkred btn-round" id = "selDiv" onChange="onSelectDivision(<?php echo $compID ?>);">
                              <option value='0' disabled selected>Choose Division</option>
                            <?php
                            $sql_div = "SELECT div_name, div_ID FROM `tbl_division` where fk_comp_id = ?";

                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $q_div = $pdo->prepare($sql_div);
                            $q_div->execute(array($compID));

                            while ($zeile = $q_div->fetch(/* PDO::FETCH_ASSOC */)) {
                                ?>
                                <option value="<?php echo $zeile['div_ID'] ?>" ><?php echo $zeile['div_name'] ?></option>

                                <?php
                            }
                            ?>

                        </select>
                        <!--
                        <?php
                        $sql = "SELECT div_name, div_ID FROM `tbl_division` where fk_comp_id = $compID";

                        foreach ($pdo->query($sql) as $row) {
                            echo

                            "<th><button type='submit' value='" . $row['div_ID'] . "' id='" . $row['div_ID'] . "' name='divselectbasic' class='btn btn-pinterest'>" . $row['div_name'] . "  </button>  </th> ";
                        }
                        ?>
                        
                        -->
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-lg-12 container-fluid">
                        <div id="sel">



                        </div>
                        <?php
                        if (isset($_POST['divselectbasic'])) {
                            ?>

                            <!--
                                                            <div class="container">
                            <?php
                            $divison = $_POST['divselectbasic'];

                            $sql = "SELECT `div_name` FROM `tbl_division` where div_id = $divison";
                            foreach ($pdo->query($sql) as $row) {
                                echo "<h2>Input Results Divison: " . $row['div_name'] . "</h2>";
                            }
                            ?>
                                                                <p>input or update the results</p> 
                            
                                                                <form  class="form-horizontal" action="update_result.php" method="post">  
                                                                    <input type="hidden" name="compID" value="<?php echo $compID ?>" class="form-control" >
                            
                                                                    <table class="table table-hover">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Name</th>
                                                                                <th>Box</th>    
                            <?php
                            $wod_array = array();
                            $wod_count = 1;

                            //  $pdo = Database::connect();
                            $sql = "SELECT , wod_ID, wod_name FROM `tbl_wod` WHERE `fk_div_ID` = $divison";
                            foreach ($pdo->query($sql) as $row) {
                                echo
                                "<th> "  . $row['wod_name'] . " </th> ";

                                $wod_array[$wod_count] = $row['wod_ID'];

                                $wod_count++;
                            }
                            ?>
                            
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                            
                            
                            <?php
//$sql = "select u.user_name as Name, u.user_box as Box,\n"
//    . "sum(if(fk_wod_ID=1,res_score,0)) as wod1,\n"
//    . "sum(if(fk_wod_ID=2,res_score,0)) as wod2,\n"
//    . "sum(if(fk_wod_ID=3,res_score,0)) as wod3,\n"
//    . "sum(if(fk_wod_ID=4,res_score,0)) as wod4,\n"
//    . "sum(if(fk_wod_ID=5,res_score,0)) as wod5\n"
//    . "from tbl_result r join tbl_user_division d \n"
//    . "on r.fk_user_div_ID = d.user_div_ID \n"
//    . "join tbl_user u on d.fk_user_ID = u.user_ID\n"
//    . "group by r.fk_user_div_ID";

                            $subsql = "";
                            for ($count1 = 1; $count1 < $wod_count; $count1++) {
                                $subsql = $subsql . ",\n sum(if(fk_wod_ID=" . $wod_array[$count1] . ",res_score,0)) as wod"
                                        . $count1
                                        . ", sum(if(r.fk_wod_ID=" . $wod_array[$count1] . ",r.res_ID,0)) as resID"
                                        . $count1;
                            }


                            $sql = "select d.athlete_div_ID, u.athlete_name as Name, u.athlete_box as Box"
                                    . $subsql
                                    . "  from tbl_athlete u join tbl_athlete_division d on d.fk_athlete_ID = u.athlete_ID"
                                    . " left join tbl_result r on r.fk_athlete_div_ID = d.athlete_div_ID "
                                    . "  where d.fk_div_ID ="
                                    . $divison . " group by Name";


                            foreach ($pdo->query($sql) as $row) {
                                echo "<tr><td>" . $row['Name'] . "</td><td> " . $row['Box'] . " </td>";
                                for ($count = 1; $count < $wod_count; $count++) {
                                    $wodas = "wod" . $count;
                                    $fieldID = $row["resID" . $count] . "X" . $row["athlete_div_ID"] . "X" . $wod_array[$count];

                                    echo "    <td> <input id='" . $fieldID . "' name='" . $fieldID . "' type='text'  placeholder='score' "
                                    . "value='" . $row[$wodas] . "'> </td>";
                                }


                                echo "   </tr>";
                            }
                            ?>
                            
                                                                        </tbody>
                                                                    </table>
                            
                            
                            
                                                                    <button id="btn_save" name="btn_save" class="btn btn-pinterest">Save</button>
                            
                                                                </form > 
                            
                                                            </div> -->

    <?php
}

Database::disconnect();
?>

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


</html>
