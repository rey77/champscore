<?PHP

session_start();
$div_ID = $_POST['div_ID'];
$comp_ID = $_POST['comp_ID'];
$wodBtnBgColor = $_POST['wodBtnBgColor'];
$wodBtnFontColor = $_POST['wodBtnFontColor'];

include 'Database.php';
$pdo = Database::connect();


$sql_evt = "SELECT  wod_ID, wod_name FROM `tbl_wod` WHERE `fk_div_ID` = ?";

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$q_evt = $pdo->prepare($sql_evt);
$q_evt->execute(array($div_ID));

echo"<div class=\"btn-group\" style =\" display: inline-flex; \">";
if ($q_evt->rowCount() > 0) {

    $wod_overall = 0;

    echo "<button class= \"btn  btn-lg\" style=\"background-color:#$wodBtnBgColor; color:#$wodBtnFontColor;\" onclick='onSelectWod(" . $wod_overall . ',' . $div_ID . ',' . $comp_ID . ") '  value='" . $div_ID . "X" . $wod_overall . "' id='" . $wod_overall . "' ' class='btn btn-primary btn-lg'>
          <b>Total Score</b> </button>";



    while ($zeile = $q_evt->fetch(/* PDO::FETCH_ASSOC */)) {

        echo "<button class= \"btn  btn-lg\" style=\"background-color:#$wodBtnBgColor; color:#$wodBtnFontColor;\" onclick='onSelectWod(" . $zeile['wod_ID'] . ',' . $div_ID . ',' . $comp_ID . ") '  value='" . $div_ID . "X" . $zeile['wod_ID'] . "' id='" . $zeile['wod_ID'] . "' ' class='btn btn-primary btn-lg'>
          <b> " . $zeile['wod_name'] . "</b> </button>";
    }
    
}
echo "</div>";

Database::disconnect();
?>
