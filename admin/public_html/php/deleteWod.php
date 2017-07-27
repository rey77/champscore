<?PHP

session_start();


$wodID = $_POST['wod_ID'];

include 'Database.php';
$pdo = Database::connect();

$sql = "DELETE FROM tbl_wod WHERE wod_ID = ?";
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$q = $pdo->prepare($sql);
$q->execute(array($wodID));

Database::disconnect();
?>
