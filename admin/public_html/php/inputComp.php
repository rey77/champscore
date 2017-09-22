<?php

session_start();

include 'Database.php';
$pdo = Database::connect();


// INSERT COMPETITION IN DB
$compName = $_POST['compName'];
$hostID = $_SESSION['host_id']; //aus Session Variable nehmen
$compStartDate = $_POST['compStartDate'];
$compStartTime = $_POST['compStartTime'];
$compEndDate = $_POST['compEndDate'];
$compEndTime = $_POST['compEndTime'];
$compFacebookLink = $_POST['compFacebookLink'];
$compLocation = $_POST['compLocation'];
$regCode = $_POST['compRegCode'];
$compStreet = $_POST['compStreet'];
$compZip = $_POST['compZip']; //aus Session Variable nehmen
$compCity = $_POST['compCity'];
$compCountry = $_POST['compCountry'];
$compDescLong = $_POST['compDescLong'];
$compDescShort = $_POST['compDescShort'];
$compSponsors = $_POST['compSponsors'];




$sql = "INSERT INTO `tbl_competition` ( `comp_name`,`comp_desc_short`,`comp_desc_long`, `comp_regcode`, `comp_start_date`,  `comp_start_time`,  `comp_location_name`,  `comp_facebook_link` ,`fk_host_ID`, `comp_active`, `comp_street`, `comp_zip`, `comp_city`, `comp_country`, `comp_sponsors` ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$q = $pdo->prepare($sql);
$q->execute(array($compName, $compDescShort, $compDescLong, $regCode, $compStartDate, $compStartTime, $compLocation, $compFacebookLink, $hostID, 1, $compStreet, $compZip, $compCity, $compCountry, $compSponsors));

$compID = $pdo->lastInsertId();

// No file was selected for upload, your (re)action goes here
//competition logo save
$target_dir = "uploads/host/complogo/";
$target_file = $target_dir . basename($_FILES["compLogo"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
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

// Check file size
if ($_FILES["compLogo"]["size"] > 500000) {
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
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
$sql_comp_upd = "UPDATE tbl_competition SET comp_logo = ? WHERE comp_id = ?";

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$q_comp_upd = $pdo->prepare($sql_comp_upd);
$q_comp_upd->execute(array($newfilename, $compID));
//competition logo over



// No file was selected for upload, your (re)action goes here
//competition Banner save
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

// Check file size
if ($_FILES["compBanner"]["size"] > 500000) {
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


    if (move_uploaded_file($_FILES["compBanner"]["tmp_name"], "uploads/host/compbanner/" . $newfilename /* $target_file */)) {
        echo "The file " . basename($_FILES["compBanner"]["name"]) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
$sql_comp_banner = "UPDATE tbl_competition SET comp_banner = ? WHERE comp_id = ?";

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$q_comp_banner = $pdo->prepare($sql_comp_banner);
$q_comp_banner->execute(array($newfilename, $compID));
//competition Banner over


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
    $newfilename = $compID . '.pdf';// . end($temp);

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
   
