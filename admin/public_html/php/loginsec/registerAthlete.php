<?PHP

session_start();


include '../Database.php';
$pdo = Database::connect();

$athleteEmail = $_POST["athleteEmail"];
$password1 = $_POST["athletePassword1"];
$password2 = $_POST["athletePassword2"];


if (isset($_POST['athleteEmail']) AND isset($_POST['athletePassword1'])) {


    $passEncr = md5($password1);
    $_SESSION['athleteEmail'] = $athleteEmail;


    if (($password1 == $password2) && (strlen($password1) >= 8)) {



        $sql = "SELECT athlete_email FROM `tbl_athlete` WHERE athlete_email= ?";
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $q = $pdo->prepare($sql);
        $q->execute(array($athleteEmail));


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
            header("Location: ../athleteRegister.php");
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

        header("Location: ../athleteRegister.php");
        exit();
    }
}

define('KB', 1024);
define('MB', 1048576);
define('GB', 1073741824);
define('TB', 1099511627776);


$athleteEmail = $_SESSION['athleteEmail'];
$athletePhone = $_POST["athletePhone"];
$athleteFirstName = $_POST["athleteFirstName"];
$athleteLastName = $_POST["athleteLastName"];

$athleteGender = $_POST["athleteGender"];
$athleteStreet = $_POST["athleteStreet"];
$athleteZIP = $_POST["athleteZIP"];
$athleteCity = $_POST["athleteCity"];
$athleteCountry = $_POST["athleteCountry"];
$athleteAffiliate = $_POST["athleteAffiliate"];
$athleteShirtsize = $_POST["athleteShirtsize"];
$athleteBestscore = $_POST["athleteBestscore"];

$athleteBirthDate = DateTime::createFromFormat('m/d/Y',$_POST["athleteBirthDate"]);
$from_date = $athleteBirthDate->format("Y-m-d");




$password = md5($_POST["athletePassword1"]);

// Benutzer erfassen, weil noch nicht in DB vorhanden
$sqlathlete = "INSERT INTO tbl_athlete ( `athlete_password`, `athlete_email`, `athlete_gender`, `athlete_birthdate`, `athlete_affiliate`, `athlete_firstname`, `athlete_lastname`, `athlete_street`,`athlete_zip` ,`athlete_city`,`athlete_country`,`athlete_bestscore`,`athlete_shirtsize` ) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)";
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$qathlete = $pdo->prepare($sqlathlete);
$qathlete->execute(array($password, $athleteEmail, $athleteGender, $from_date, $athleteAffiliate, $athleteFirstName, $athleteLastName, $athleteStreet, $athleteZIP, $athleteCity, $athleteCountry, $athleteBestscore, $athleteShirtsize));
$_SESSION['athlete_id'] = $pdo->lastInsertId();
$athleteID = $_SESSION['athlete_id'];



//save avatar
$target_dir = "../uploads/athlete/profile/";
$target_file = $target_dir . basename($_FILES["avatar"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["avatar"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
if ($_FILES["avatar"]["error"] != 0) {
    $uploadOk = 0;
//stands for any kind of errors happen during the uploading
}
// Check file size
if ($_FILES["avatar"]["size"] > 10 * MB) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {

    $temp = explode(".", $_FILES["avatar"]["name"]);
    $newfilename = $athleteID . '.jpg'; //. end($temp);

    if (move_uploaded_file($_FILES["avatar"]["tmp_name"], "../uploads/athlete/profile/" . $newfilename /* $target_file */)) {
        echo "The file " . basename($_FILES["avatar"]["name"]) . " has been uploaded.";

        $sql_logo = "UPDATE tbl_athlete SET athlete_avatar = ? WHERE athlete_id =?";

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $q_logo = $pdo->prepare($sql_logo);
        $q_logo->execute(array($newfilename, $athleteID));
//competition logo over
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}


//save competition logo
$target_dir = "uploads/athlete/actionpicture/";
$target_file = $target_dir . basename($_FILES["actionPicture"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["actionPicture"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
if ($_FILES["actionPicture"]["error"] != 0) {
    $uploadOk = 0;
//stands for any kind of errors happen during the uploading
}
// Check file size
if ($_FILES["actionPicture"]["size"] > 10 * MB) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {

    $temp = explode(".", $_FILES["actionPicture"]["name"]);
    $newfilename = $athleteID . '.jpg'; //. end($temp);

    if (move_uploaded_file($_FILES["actionPicture"]["tmp_name"], "../uploads/athlete/actionpicture/" . $newfilename /* $target_file */)) {
        echo "The file " . basename($_FILES["actionPicture"]["name"]) . " has been uploaded.";

        $sql_ap = "UPDATE tbl_athlete SET athlete_actionpicture = ? WHERE athlete_id =?";

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $q_ap = $pdo->prepare($sql_ap);
        $q_ap->execute(array($newfilename, $athleteID));
//competition logo over
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

Database::disconnect();
$_SESSION['eingeloggt'] = true;
header("Location: ../athleteIndex.php");
exit();




