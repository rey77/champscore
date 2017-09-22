<?php

session_start();

include 'Database.php';
$pdo = Database::connect();


define('KB', 1024);
define('MB', 1048576);
define('GB', 1073741824);
define('TB', 1099511627776);

// INSERT COMPETITION IN DB
$compName = $_POST['compName'];
$compStartDate = $_POST['compStartDate'];
$compStartTime = $_POST['compStartTime'];
$compEndDate = $_POST['compEndDate'];
$compEndTime = $_POST['compEndTime'];
$compID = $_POST['compID'];
$regCode = $_POST['compRegCode'];
$compZip = $_POST['compZip'];
$compStreet = $_POST['compStreet'];
$compCity = $_POST['compCity'];
$compCountry = $_POST['compCountry'];
$compDescLong = $_POST['compDescLong'];
$compDescShort = $_POST['compDescShort'];
$compMainColor = $_POST['compMainColor'];
$compAccentColor = $_POST['compAccentColor'];
$compLocation = $_POST['compLocation'];
$compFacebookLink = $_POST['compFacebookLink'];
$compSponsors = $_POST['compSponsors'];

$sql = "UPDATE tbl_competition SET comp_name = ?, comp_desc_short =?, comp_desc_long = ?, comp_regcode = ? , comp_location_name = ?,  comp_facebook_link = ?, comp_start_date = ? , comp_start_time = ?, "
        . "comp_end_date = ?, comp_end_time = ?, comp_street = ?, comp_zip = ?, comp_city = ?, comp_country = ? , comp_main_color = ?, comp_accent_color = ?, comp_sponsors = ?"
        . "WHERE comp_id = ?";


$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$q = $pdo->prepare($sql);
$q->execute(array($compName, $compDescShort, $compDescLong, $regCode, $compLocation, $compFacebookLink, $compStartDate, $compStartTime, $compEndDate, $compEndTime, $compStreet, $compZip, $compCity, $compCountry, $compMainColor, $compAccentColor, $compSponsors, $compID));

//save competition logo
$target_dir = "uploads/host/complogo/";
$target_file = $target_dir . basename($_FILES["compLogo"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
echo $imageFileType;
// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["compLogo"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
if ($_FILES["compLogo"]["error"] != 0) {
    $uploadOk = 0;
//stands for any kind of errors happen during the uploading
}
// Check file size
if ($_FILES["compLogo"]["size"] > 5 * MB) {
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

    $temp = explode(".", $_FILES["compLogo"]["name"]);
    $newfilename = $compID . '.jpg';// . end($temp);

    if (move_uploaded_file($_FILES["compLogo"]["tmp_name"], "uploads/host/complogo/" . $newfilename /* $target_file */)) {
        echo "The file " . basename($_FILES["compLogo"]["name"]) . " has been uploaded.";

        $sql_logo = "UPDATE tbl_competition SET comp_logo = ? WHERE comp_id =?";

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $q_logo = $pdo->prepare($sql_logo);
        $q_logo->execute(array($newfilename, $compID));
//competition logo over
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}


//save competition banner
$target_dir = "uploads/host/compbanner/";
$target_file = $target_dir . basename($_FILES["compBanner"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["compBanner"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
if ($_FILES["compBanner"]["error"] != 0) {
    $uploadOk = 0;
//stands for any kind of errors happen during the uploading
}
// Check file size
if ($_FILES["compBanner"]["size"] > 5 * MB) {
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

    $temp = explode(".", $_FILES["compBanner"]["name"]);
    $newfilename = $compID . '.jpg';// . end($temp);
    echo $newfilename;
    if (move_uploaded_file($_FILES["compBanner"]["tmp_name"], "uploads/host/compbanner/" . $newfilename /* $target_file */)) {
        echo "The file " . basename($_FILES["compBanner"]["name"]) . " has been uploaded.";

        $sql_logo = "UPDATE tbl_competition SET comp_banner = ? WHERE comp_id =?";

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $q_logo = $pdo->prepare($sql_logo);
        $q_logo->execute(array($newfilename, $compID));
//competition logo over
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}


//save PDF File for terms and conditions--------------------------------
$target_dir = "uploads/host/terms/";
$target_file = $target_dir . basename($_FILES["compTerms"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["compTerms"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an PDF - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not a PDF File.";
        $uploadOk = 0;
    }
}

if ($_FILES["compTerms"]["error"] != 0) {
    $uploadOk = 0;
//stands for any kind of errors happen during the uploading
}

// Check file size
if ($_FILES["compTerms"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if ($imageFileType != "pdf") {
    echo "Sorry, only PDF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {

    $temp = explode(".", $_FILES["compTerms"]["name"]);
    $newfilename = $compID . '.pdf'; //. end($temp);

    if (move_uploaded_file($_FILES["compTerms"]["tmp_name"], "uploads/host/terms/" . $newfilename /* $target_file */)) {
        echo "The file " . basename($_FILES["compTerms"]["name"]) . " has been uploaded.";

        $sql_terms = "UPDATE tbl_competition SET comp_terms = ? WHERE comp_id =?";

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $q_terms = $pdo->prepare($sql_terms);
        $q_terms->execute(array($newfilename, $compID));

//competition terms over
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}


Database::disconnect();

header("Location:hostCompetitions.php");
?>
   
