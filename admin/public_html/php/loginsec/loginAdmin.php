<?PHP

session_start();
ob_start();

if (isset($_POST['adminEmail']) AND isset($_POST['adminPassword'])) {
    $email = $_POST['adminEmail'];
    $pass = $_POST['adminPassword'];
    $pass = md5($pass);


    include '../Database.php';
    $pdo = Database::connect();

    $sql_admin = "SELECT admin_ID, admin_email, admin_password FROM `tbl_admin` WHERE admin_email=? and admin_password=?";
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $q_admin = $pdo->prepare($sql_admin);
    $q_admin->execute(array($email, $pass));

    while ($zeile = $q_admin->fetch(/* PDO::FETCH_ASSOC */)) {

        $_SESSION['admin_id'] = $zeile["admin_ID"];
        $_SESSION['eingeloggt'] = true;
        $_SESSION['admin_email'] = $email;

        header("Location: ../adminIndex.php");
        exit();
    }
    /*  // Datenbankverbindung
      include "db.inc.php";

      $link = mysqli_connect("localhost", $benutzer, $passwort) or die("Keine Verbindung zur Datenbank!");
      mysqli_select_db($link, $dbname) or die("Datenbank nicht gefunden!");

      // prüfen ob es host und passwort gibt
      $abfrage = "SELECT admin_ID, admin_email, admin_password FROM `tbl_admin` WHERE admin_email='$email' and admin_password='$pass'";
      $ergebnis = mysqli_query($link, $abfrage) or die("Email oder Passwort stimmt nicht!");
      $count = mysqli_num_rows($ergebnis);
     */
   /* if ($count == 1) {

        $zeile = mysqli_fetch_assoc($ergebnis);
        $_SESSION['athlete_id'] = $zeile["athlete_ID"];
        $_SESSION['eingeloggt'] = true;
        $_SESSION['athleteEmail'] = $email;

        header("Location: ../athleteIndex.php");
        exit();


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
        header("Location: ../athleteLogin.php");
        exit();
        // echo "<script type='text/javascript'>  window.location='../../ChampScoreIndex.php'; </script>";

        exit;
    }*/
}