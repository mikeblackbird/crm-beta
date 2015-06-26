<?session_start();
$workerId = $_SESSION['workerId'];
if (!empty($_POST)){
    require_once 'classes/crud.php';
    $dbObject = new crud('clients');
        $dbObject->create();
}
