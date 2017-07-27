<?PHP

session_start();

include '../Database.php';
$pdo = Database::connect();

$userEmail = $_SESSION['userEmail'];
$userName = $_SESSION['username'];
$userPhone = $_POST["userPhone"];
$userFirstName = $_POST["userFirstName"];
$userLastName = $_POST["userLastName"];
$userBirthDate = $_POST["userBirthDate"];
$userGender = $_POST["userGender"];
$userStreet = $_POST["userStreet"];
$userZIP = $_POST["userZIP"];
$userCity = $_POST["userCity"];
$userCountry = $_POST["userCountry"];
$userAffiliate = $_POST["userAffiliate"];
$userShirtSize = $_POST["userShirtSize"];
$userBestScore = $_POST["userBestScore"];


$password = $_POST["password"];

$_SESSION['username'] = $userName;


// Benutzer erfassen, weil noch nicht in DB vorhanden
$sqlUser = "INSERT INTO tbl_user ( `user_name`, `user_password`, `user_email`, `user_gender`, `user_birthdate`, `user_affiliate`, `user_shirtsize`, `user_bestscore`, `user_firstname`, `user_lastname`, `user_street`,`user_zip` ,`user_city`,`user_country`) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$qUser = $pdo->prepare($sqlUser);
$qUser->execute(array($userName, $password, $userEmail, $userGender, $userBirthDate, $userAffiliate, $userShirtSize, $userBestScore, $userFirstName, $userLastName, $userStreet, $userZIP, $userCity, $userCountry));
$_SESSION['user_id'] = $pdo->lastInsertId();


Database::disconnect();
$_SESSION['eingeloggt'] = true;
header("Location: ../index.php");
exit();




