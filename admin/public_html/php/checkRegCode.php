<?PHP

session_start();

$regcode = $_POST['regcode'];
$comp_ID = $_POST['comp_ID'];
$div_ID = $_POST['div_ID'];

require ("./public_html/php/loginsec/db.inc.php");
/* check user already registered */

$link = mysqli_connect("localhost", $benutzer, $passwort);
mysqli_select_db($link, $dbname);

$abfrage = "select * from tbl_user_division "
        . "join tbl_division on tbl_user_division.fk_div_ID = tbl_division.div_ID "
        . "where tbl_user_division.fk_user_ID = " . $_SESSION['user_id'] . " and tbl_division.fk_comp_ID = " . $comp_ID;
$ergebnis = mysqli_query($link, $abfrage) or die($msg = "Fehler");
$count = mysqli_num_rows($ergebnis);

if ($count >= 1) {

    $zeile = mysqli_fetch_assoc($ergebnis);

    $msg = "<div class=\"alert alert-danger\"><p id =\"msg\"> <strong>Shit!</strong> Schon angemeldet<p></div> ";
} else {

    //echo $regcode;
    //echo $comp_ID;
    //echo $div_ID;
    /* check code exists */
    $link = mysqli_connect("localhost", $benutzer, $passwort);
    mysqli_select_db($link, $dbname);
    $abfrage = "select comp_ID, comp_name from tbl_competition where comp_regcode = " . $regcode . " and comp_ID = " . $comp_ID;
    $ergebnis = mysqli_query($link, $abfrage) or die($msg = "<div class=\"alert alert-danger\"><p id =\"msg\"> <strong>Shit!</strong> Wrong Code<p></div> ");
    $count = mysqli_num_rows($ergebnis);


    if ($count == 1) {

        $zeile = mysqli_fetch_assoc($ergebnis);

        $link = mysqli_connect("localhost", $benutzer, $passwort);
        mysqli_select_db($link, $dbname);
        $abfrage = "INSERT INTO tbl_user_division (fk_user_ID, fk_div_ID) VALUES (" . $_SESSION['user_id'] . "," . $div_ID . ")";
        $ergebnis = mysqli_query($link, $abfrage) or die($msg = "<div class = \"alert alert-danger\"><p id =\"msg\"> <strong>Shit!</strong> Wrong Code<p></div> ");

        $msg = "<div class=\"alert alert-success\"><p id =\"msg\"> <strong>Well done!</strong> You successfully registered for " . $zeile["comp_name"] . "<p></div> ";
    } else {

        $msg = "<div class=\"alert alert-danger\"><p id =\"msg\"> <strong>Shit!</strong> Wrong Code<p></div> ";
    }
}
echo $msg;
/*
  while ($zeile = mysqli_fetch_array($ergebnis, MYSQLI_ASSOC)) {

  echo $zeile['comp_name'];
  } */

mysqli_close($link);
?>
