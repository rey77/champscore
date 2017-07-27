<?PHP

session_start();
$comp_ID = $_POST['comp_ID'];

include 'Database.php';
$pdo = Database::connect();

try {
    $sql = "DELETE FROM tbl_competition WHERE comp_ID = ?";
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $q = $pdo->prepare($sql);
    $q->execute(array($comp_ID));
    
} catch (PDOException $e) {
     echo $sql . "<br>" . $e->getMessage();
}

Database::disconnect();
?>
