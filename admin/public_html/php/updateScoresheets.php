<?php

session_start();

include 'Database.php';
$pdo = Database::connect();

// INSERT COMPETITION IN DB
$compID = $_POST['compID'];

//save PDF File for Scoresheets--------------------------------
$target_dir = "uploads/host/scoresheets/";
$target_file = $target_dir . basename($_FILES["compScoresheets"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["compScoresheets"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an PDF - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not a PDF File.";
        $uploadOk = 0;
    }
}

if ($_FILES["compScoresheets"]["error"] != 0) {
    $uploadOk = 0;
//stands for any kind of errors happen during the uploading
}

// Check file size
if ($_FILES["compScoresheets"]["size"] > 500000) {
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

    $temp = explode(".", $_FILES["compScoresheets"]["name"]);
    $newfilename = $compID . '.pdf'; //. end($temp);

    if (move_uploaded_file($_FILES["compScoresheets"]["tmp_name"], "uploads/host/scoresheets/" . $newfilename /* $target_file */)) {
        echo "The file " . basename($_FILES["compScoresheets"]["name"]) . " has been uploaded.";

        $sql_scoresheets = "UPDATE tbl_competition SET comp_scoresheets = ? WHERE comp_id =?";

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $q_scoresheets = $pdo->prepare($sql_scoresheets);
        $q_scoresheets->execute(array($newfilename, $compID));

//competition scoresheets over
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}


Database::disconnect();

header("Location:adminIndex.php");
?>
   
