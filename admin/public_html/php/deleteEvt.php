<?PHP

session_start();


$evtID = $_POST['evt_ID'];

include 'Database.php';
$pdo = Database::connect();

$sql = "DELETE FROM tbl_event WHERE evt_ID = ?";
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$q = $pdo->prepare($sql);
$q->execute(array($evtID));

Database::disconnect();
?>
