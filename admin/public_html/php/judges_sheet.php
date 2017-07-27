<!--<!DOCTYPE html>
<html lang="en">
<head>
  <title>Results</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
-->
<div class="container">

    <?php
    include 'Database.php';

    $pdo = Database::connect();

    
    $sql = "SELECT `comp_name` FROM `tbl_competition` where comp_id = $comp_ID";

    foreach ($pdo->query($sql) as $row) {
        echo "<h2>" . $row['comp_name'] . "</h2>";
    }
    ?>


    <form class="form-horizontal" action="judgeSheetsGen.php?comp_ID=<?php echo $comp_ID ?>" method="post"> 
        <table class="table table-hover">
            <tr>
<?php
$divcounter = 1;

$sql = "SELECT div_name, div_ID FROM `tbl_division` where fk_comp_id = $comp_ID";

foreach ($pdo->query($sql) as $row) {
    echo

    "<th><button type='submit' value='" . $row['div_ID'] . "' id='" . $row['div_ID'] . "' name='divselectbasic' class='btn btn-custom-red btn-lg'>" . $row['div_name'] . "  </button>  </th> ";


    $divcounter++;
}
?>
            </tr>
        </table>

    </form>

</div>  
<?php
if (isset($_POST['divselectbasic'])) {
    ?>
    <div class="container">
        <table class="table table-hover">



    <?php
    $divison = $_POST['divselectbasic'];

    $sql = "SELECT evt_ID, wod_ID, wod_name, evt_name FROM `tbl_wod` join tbl_event on fk_evt_ID = evt_ID WHERE `fk_div_ID` = " . $divison;
    foreach ($pdo->query($sql) as $row) {
        echo "<tr>";


        echo "<td>" . $row['evt_name'] . " <br/> " . $row['wod_name'] . "</td>";

        echo "<td> <form action='judges_pdf.php' method='post'>"
        . "<button type='submit' value=" . $row['wod_ID'] . "X" . $divison . " id='judges_pdf' "
        . "name='judges_pdf' class='btn btn-custom-red btn-lg'>PDF Generator</button></form ></td>";


        echo "</tr> ";
    }
    ?>




            <?php
        }
        ?>   

    </table>

</div>
<!--
</body>
</html>
-->