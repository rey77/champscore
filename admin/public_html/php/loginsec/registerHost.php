<?PHP

session_start();


include '../Database.php';
$pdo = Database::connect();

$hostEmail = $_POST["hostEmail"];
$password1 = $_POST["hostPassword1"];
$password2 = $_POST["hostPassword2"];


if (isset($_POST['hostEmail']) AND isset($_POST['hostPassword1'])) {


    $passEncr = md5($password1);
    $_SESSION['hostEmail'] = $hostEmail;


    if (($password1 == $password2) && (strlen($password1) >= 8)) {



        $sql = "SELECT host_email FROM `tbl_host` WHERE host_email= ?";
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $q = $pdo->prepare($sql);
        $q->execute(array($hostEmail));


        while ($zeile = $q->fetch(/* PDO::FETCH_ASSOC */)) {

            $_SESSION['message'] = "<div class=\"alert alert-danger\">
	             <div class=\"container\">
					 <div class=\"alert-icon\">
						<i class=\"material-icons\">error_outline</i>
					</div>
					<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
						<span aria-hidden=\"true\"><i class=\"material-icons\">clear</i></span>
					</button>
	                 This E-Mail und Username already exist
	            </div>
	        </div>";
            header("Location: ../hostRegister.php");
            exit();
        }
    }

    // end if passwörter gleich und länger als 8 Zeichen
    else {

        $_SESSION['message'] = "<div class=\"alert alert-danger\">
	             <div class=\"container\">
					 <div class=\"alert-icon\">
						<i class=\"material-icons\">error_outline</i>
					</div>
					<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
						<span aria-hidden=\"true\"><i class=\"material-icons\">clear</i></span>
					</button>
	                 Passwords are not identical or shorter than 8 characters
	            </div>
	        </div>";

        header("Location: ../hostRegister.php");
        exit();
    }
}



$hostEmail = $_SESSION['hostEmail'];
$hostPhone = $_POST["hostPhone"];
$hostFirstName = $_POST["hostFirstName"];
$hostLastName = $_POST["hostLastName"];
$hostBirthDate = $_POST["hostBirthDate"];
$hostGender = $_POST["hostGender"];
$hostStreet = $_POST["hostStreet"];
$hostZIP = $_POST["hostZIP"];
$hostCity = $_POST["hostCity"];
$hostCountry = $_POST["hostCountry"];
$hostAffiliate = $_POST["hostAffiliate"];



$password = md5($_POST["hostPassword1"]);

// Benutzer erfassen, weil noch nicht in DB vorhanden
$sqlhost = "INSERT INTO tbl_host ( `host_password`, `host_email`, `host_gender`, `host_birthdate`, `host_affiliate`, `host_firstname`, `host_lastname`, `host_street`,`host_zip` ,`host_city`,`host_country`) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$qhost = $pdo->prepare($sqlhost);
$qhost->execute(array( $password, $hostEmail, $hostGender, $hostBirthDate, $hostAffiliate, $hostFirstName, $hostLastName, $hostStreet, $hostZIP, $hostCity, $hostCountry));
$_SESSION['host_id'] = $pdo->lastInsertId();


Database::disconnect();
$_SESSION['eingeloggt'] = true;
header("Location: ../hostIndex.php");
exit();




