<?php

session_start();

include '../Database.php';
$pdo = Database::connect();
var_dump($_POST);


// INSERT COMPETITION IN DB
$compName = $_POST['compName'];
$userID = $_SESSION['user_id']; //aus Session Variable nehmen
$compDate = $_POST['compDate'];
$regCode = $_POST['compregCode'];


$sql = "INSERT INTO `tbl_competition` ( `comp_name`, `comp_regcode`, `comp_date`, `fk_user_ID`, comp_active ) VALUES (?,?,?,?,?)";

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$q = $pdo->prepare($sql);
$q->execute(array($compName, $regCode, $compDate, $userID, 1));


//INSERT DIVISION IN DB
$sqlsel = "SELECT `comp_id` FROM `tbl_competition` order by comp_id DESC Limit 1";

$compID;
foreach ($pdo->query($sqlsel) as $row) {
    $compID = $row['comp_id'];
}

//competition logo save
$target_dir = "../uploads/complogo/";
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
    $newfilename = $_SESSION['user_id'] + $compID . '.' . end($temp);
    

    if (move_uploaded_file($_FILES["compLogo"]["tmp_name"], "../uploads/complogo/" . $newfilename /* $target_file */)) {
        echo "The file " . basename($_FILES["compLogo"]["name"]) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

$sql = "UPDATE\n"
        . " tbl_competition\n"
        . "SET\n"
        . " comp_logo = '$newfilename'\n"
        . "WHERE\n"
        . " comp_id =" . $compID;

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$q = $pdo->prepare($sql);
$q->execute();
//competition logo over




$numbDiv = $_POST['selectDiv'];
$nameDiv;



for ($i = 1; $i <= $numbDiv; $i++) {
    $nameDiv = $_POST['nameDiv_' . $i];


    $sql = "INSERT INTO `tbl_division` (`div_name`, `fk_comp_ID`) VALUES (?, ?)";

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $q = $pdo->prepare($sql);
    $q->execute(array($nameDiv, $compID));



    //INSERT EVENTS IN DB
    $numbEvent = $_POST['selEvent' . $i];

    for ($a = 1; $a <= $numbEvent; $a++) {

        $sqlsel = "SELECT `div_ID` FROM `tbl_division` order by div_ID DESC Limit 1";

        $divID;
        foreach ($pdo->query($sqlsel) as $row) {
            $divID = $row['div_ID'];
        }

        $eventName = $_POST['event_' . $a . $i];

        $sql = "INSERT INTO `tbl_event` (`evt_name`, `fk_div_ID`) VALUES (?, ?)";

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $q = $pdo->prepare($sql);
        $q->execute(array($eventName, $divID));



        $numbWod = $_POST['selWod' . $a . $i];
        for ($c = 1; $c <= $numbWod; $c++) {

            $sqlsel = "SELECT `evt_ID` FROM `tbl_event` order by evt_ID DESC Limit 1";

            $evtID;
            foreach ($pdo->query($sqlsel) as $row) {
                $evtID = $row['evt_ID'];
                $wodName = $_POST['inputWod' . $a . $i . $c];
                $wodDesc = $_POST['textWod' . $a . $i . $c];


                $sql = "INSERT INTO `tbl_wod` (`wod_name`,`wod_desc`,`fk_evt_ID`) VALUES (?, ?,?)";

                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $q = $pdo->prepare($sql);
                $q->execute(array($wodName, $wodDesc, $evtID));
            }
        }
    }
}


Database::disconnect();
header("Location:../organizer.php");
?>
   
