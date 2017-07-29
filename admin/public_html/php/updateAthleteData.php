<?PHP

session_start();

$athleteID = $_SESSION["athlete_id"];
$firstName = $_POST['firstname'];
$lastName = $_POST['lastname'];
$street = $_POST['street'];
$zip = $_POST['zip'];
$city = $_POST['city'];
$country = $_POST['country'];
$birthdate = $_POST['birthdate'];
$gender = $_POST['gender'];
$affiliate = $_POST['affiliate'];
$bestscore = $_POST['bestscore'];
$shirtsize = $_POST['shirtsize'];

include 'Database.php';
$pdo = Database::connect();


$sql_athlete = "UPDATE\n"
        . " tbl_athlete\n"
        . "SET\n"
        . " athlete_gender =?,\n"
        . " athlete_affiliate =?,\n"
        . " athlete_birthdate =?, \n"
        . " athlete_firstname =?,\n"
        . " athlete_lastname =?,\n"
        . " athlete_street =?,\n"
        . " athlete_zip = ?,\n"
        . " athlete_city = ?,\n"
        . " athlete_country = ?,\n"
        . " athlete_shirtsize = ?,\n"
        . " athlete_bestscore = ?\n"
        . "WHERE\n"
        . " athlete_ID =?";

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$q_athlete = $pdo->prepare($sql_athlete);
$q_athlete->execute(array($gender, $affiliate, $birthdate, $firstName, $lastName, $street, $zip, $city, $country, $shirtsize, $bestscore, $athleteID));



if (isset($_FILES["fileToUpload"]) && !empty($_FILES["fileToUpload"])) {



    $target_dir = "uploads/athlete/profile/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    if ($_FILES["fileToUpload"]["error"] != 0) {
        $uploadOk = 0;
//stands for any kind of errors happen during the uploading
    }

// Check if file already exists
    /* if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
      } */
// Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
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

        $temp = explode(".", $_FILES["fileToUpload"]["name"]);
        $newfilename = $_SESSION['athlete_id'] . '.jpg';// . end($temp);


        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "uploads/athlete/profile/" . $newfilename /* $target_file */)) {
            //echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";


            $sql_athlete = "UPDATE\n"
                    . " tbl_athlete\n"
                    . "SET\n"
                    . " athlete_avatar =?\n"
                    . "WHERE\n"
                    . " athlete_ID =?";

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $q_athlete = $pdo->prepare($sql_athlete);
            $q_athlete->execute(array($newfilename, $athleteID));
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
$msg = "<div class=\"alert alert-success\">
	             <div class=\"container\">
					 <div class=\"alert-icon\">
						<i class=\"material-icons\">error_outline</i>
					</div>
					<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
						<span aria-hidden=\"true\"><i class=\"material-icons\">clear</i></span>
					</button>
	                 Your Personal Data was saved
	            </div>
	        </div>";
echo $msg;


Database::disconnect();
?>
