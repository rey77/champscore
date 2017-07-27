<?PHP

session_start();

$teamID = $_POST['team_ID'];

include 'Database.php';
$pdo = Database::connect();

$sql = "DELETE FROM tbl_team WHERE team_ID = ?";
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$q = $pdo->prepare($sql);
$q->execute(array($teamID));

Database::disconnect();
?>
