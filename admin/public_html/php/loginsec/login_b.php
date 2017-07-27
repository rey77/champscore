<?PHP

session_start();
ob_start();

if (isset($_POST['email']) AND isset($_POST['passwort'])) {
    $email = $_POST['email'];
    $pass = $_POST['passwort'];
    $pass = md5($pass);


    // Datenbankverbindung
    include "db.inc.php";

    $link = mysqli_connect("localhost", $benutzer, $passwort) or die("Keine Verbindung zur Datenbank!");
    mysqli_select_db($link, $dbname) or die("Datenbank nicht gefunden!");

    // prüfen ob es user und passwort gibt
    $abfrage = "SELECT user_ID, user_email, user_password, user_name FROM `tbl_user` WHERE user_email='$email' and user_password='$pass'";
    $ergebnis = mysqli_query($link, $abfrage) or die("Email oder Passwort stimmt nicht!");
    $count = mysqli_num_rows($ergebnis);

    if ($count == 1) {

        $zeile = mysqli_fetch_assoc($ergebnis);
        $_SESSION['username'] = $zeile["user_name"];
        $_SESSION['user_id'] = $zeile["user_ID"];
        $_SESSION['eingeloggt'] = true;
        $_SESSION['benutzer'] = $email;

        header("Location: ../index.php");
        exit();

        $_SESSION['username'] = $email;

        $_SESSION['email'] = $email;
        echo "Herzlich willkommen im VIP-Bereich!<br/>";
        echo "Ihre Session-ID: " . session_id();
        echo "<br/><a href=\"login_c.php\"> Hier gehts zu den geheimen Daten</a>";
        echo "<br/><a href=\"login-anpassen-form.php\"> Passwort anpassen </a>";
    } else {
        $_SESSION['eingeloggt'] = false;

        $_SESSION['message'] = "<div class=\"alert alert-danger\">
	             <div class=\"container\">
					 <div class=\"alert-icon\">
						<i class=\"material-icons\">error_outline</i>
					</div>
					<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
						<span aria-hidden=\"true\"><i class=\"material-icons\">clear</i></span>
					</button>
	                 Wrong E-Mail or Password
	            </div>
	        </div>";
        header("Location: ../login.php");
        exit();
        // echo "<script type='text/javascript'>  window.location='../../ChampScoreIndex.php'; </script>";

        exit;
    }
}