<?PHP

session_start();

$teamMemberID = $_POST['team_member_id'];

include 'Database.php';
$pdo = Database::connect();

$sql = "DELETE FROM tbl_team_member WHERE team_member_ID = ?";
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$q = $pdo->prepare($sql);
$q->execute(array($teamMemberID));

Database::disconnect();
?>
