<?PHP

session_start();
ob_start();

if (isset($_POST['erfassen']) OR isset($_POST['anpassen'])) {

    if (isset($_POST['userEmail']) AND isset($_POST['passwort1'])) {
        $vonwo = $_POST["vonwo"];
        $email = $_POST["userEmail"];
        $benutzername = $_POST["userName"];
        $passwort1 = $_POST["passwort1"];
        $passwort2 = $_POST["passwort2"];
        $pass = md5($passwort1);
        $_SESSION['username'] = $benutzername;

        if (($passwort1 == $passwort2) && (strlen($passwort1) >= 8)) {
            // Datenbankverbindung
            include "db.inc.php";
            $link = mysqli_connect("localhost", $benutzer, $passwort) or die("Keine Verbindung zur Datenbank!");
            mysqli_select_db($link, $dbname) or die("Datenbank nicht gefunden!");

            // damit ä,ö,ü und é richtig dargestellt werden! --> auf utf8 stellen
            mysqli_query($link, "SET NAMES 'utf8'");

            // falls vom Formular anpassen 
            /* if ($vonwo == "anpassen") {
              $anpassung = "UPDATE tbl_user SET `user_password`='$pass', `user_name`='$benutzername' WHERE `user_email`='$email'";
              $angepasst = mysqli_query($link, $anpassung);
              if ($angepasst == TRUE) {
              echo "Die Daten wurden angepasst<br/>";
              echo "Ihre Session_id ist:" . session_id();
              echo "<br/> <a href=\"login_c.php\">Zu den geheimen Daten</a>";
              echo "<br/> <a href=\"index.php\">Logout</a>";
              $_SESSION['name'] = $email;

              $_SESSION['eingeloggt'] = true;
              }
              } */

            // falls vom Formular "Neues Login" 
            if ($vonwo == "erfassung") {
                // prüfen ob email bereits vorhanden
                $abfrage = "SELECT user_email FROM `tbl_user` WHERE user_email='$email'";
                $ergebnis = mysqli_query($link, $abfrage) or die("Abfrage hat nicht geklappt!");
                $count = mysqli_num_rows($ergebnis);

                if ($count == 1) {

                    $_SESSION['message'] = 'Diese E-Mail-Adresse wurde bereits erfasst';
                    header("Location: ../../index.php");
                    exit();
                } else {

                    // Benutzer erfassen, weil noch nicht in DB vorhanden
                    $insert = "INSERT INTO tbl_user (`user_ID`, `user_name`, `user_password`, `user_email`) VALUES('','$benutzername','$pass','$email')";
                    mysqli_query($link, $insert) or die("DB-Eintrag hat nicht geklappt!");

                    // prüfen ob es user und passwort gibt
                    $abfrage = "SELECT user_ID, user_email FROM `tbl_user` WHERE user_email='$email'";
                    $ergebnis = mysqli_query($link, $abfrage) or die("Abfrage hat nicht geklappt!");
                    $count = mysqli_num_rows($ergebnis);

                    if ($count == 1) {
                        $zeile = mysqli_fetch_assoc($ergebnis);
                        $_SESSION['user_id'] = $zeile["user_ID"];
                        $_SESSION['benutzer'] = $email;

                        //Benutzer in der Adress Tabelle erfassen
                        $insertUserAddress = "INSERT INTO tbl_user_address (`fk_user_ID`) VALUE(" . $_SESSION['user_id'] . ")";
                        mysqli_query($link, $insertUserAddress) or die("DB-Eintrag hat nicht geklappt!");
                    }
                    $_SESSION['eingeloggt'] = true;
                    header("Location: ../organizer.php");
                    exit();
                }
            }
            // Datenbankverbindung beenden
            mysqli_close($link);
        } // end if passwörter gleich und länger als 8 Zeichen
        else {
            $_SESSION['message'] = 'Passwörter nicht identisch';

            header("Location: ../../index.php");
            exit();
            // echo "<script type='text/javascript'>  window.location='../../ChampScoreIndex.php'; </script>";
            //exit;
        } // end if passwörter gleich und länger als 8 Zeichen
    } // end if isset email, passwort1
} // end if isset $submit



