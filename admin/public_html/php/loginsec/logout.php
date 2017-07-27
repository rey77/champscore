<?PHP

session_start();
session_destroy();
$_SESSION['eingeloggt'] = false;
header("Location: ../../index.php");
    exit();

?>