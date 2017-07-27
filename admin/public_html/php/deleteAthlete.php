<?PHP

session_start();

$athleteID = $_POST['athlete_ID'];

include 'Database.php';
$pdo = Database::connect();

$sql = "DELETE FROM tbl_athlete WHERE athlete_ID = ?";
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$q = $pdo->prepare($sql);
$q->execute(array($athleteID));

Database::disconnect();
?>
