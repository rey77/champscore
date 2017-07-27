<?PHP

session_start();


$divID = $_POST['div_ID'];

include 'Database.php';
$pdo = Database::connect();

$sql = "DELETE FROM tbl_division WHERE div_ID = ?";
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$q = $pdo->prepare($sql);
$q->execute(array($divID));

Database::disconnect();
?>
