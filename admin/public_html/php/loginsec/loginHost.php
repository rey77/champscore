<?PHP

session_start();
ob_start();

if (isset($_POST['hostEmail']) AND isset($_POST['hostPassword'])) {
    $email = $_POST['hostEmail'];
    $pass = $_POST['hostPassword'];
    $pass = md5($pass);

    
    include '../Database.php';
    $pdo = Database::connect();

    $sql_host = "SELECT host_ID, host_email, host_password FROM `tbl_host` WHERE host_email=? and host_password=?";
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $q_host = $pdo->prepare($sql_host);
    $q_host->execute(array($email, $pass));

    while ($zeile = $q_host->fetch(/* PDO::FETCH_ASSOC */)) {

        $_SESSION['host_id'] = $zeile["host_ID"];
        $_SESSION['eingeloggt'] = true;
        $_SESSION['hostEmail'] = $email;

        header("Location: ../hostIndex.php");
        exit();
    }

    // Datenbankverbindung
    include "db.inc.php";

    $link = mysqli_connect("localhost", $benutzer, $passwort) or die("Keine Verbindung zur Datenbank!");
    mysqli_select_db($link, $dbname) or die("Datenbank nicht gefunden!");

    // prüfen ob es host und passwort gibt
    $abfrage = "SELECT host_ID, host_email, host_password FROM `tbl_host` WHERE host_email='$email' and host_password='$pass'";
    $ergebnis = mysqli_query($link, $abfrage) or die("Email oder Passwort stimmt nicht!");
    $count = mysqli_num_rows($ergebnis);

    if ($count == 1) {

        $zeile = mysqli_fetch_assoc($ergebnis);
        $_SESSION['host_id'] = $zeile["host_ID"];
        $_SESSION['eingeloggt'] = true;
        $_SESSION['hostEmail'] = $email;

        header("Location: ../hostIndex.php");
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
        header("Location: ../hostLogin.php");
        exit();
        // echo "<script type='text/javascript'>  window.location='../../ChampScoreIndex.php'; </script>";

        exit;
    }
}