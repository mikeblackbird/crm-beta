<?session_start();
$workerId = $_SESSION['workerId'];
if (!empty($_POST)){
    $idclient  =  $_POST['idUpdate'];
    $idmanager =  $_POST['idmanager'];
    require_once 'classes/crud.php';
    $dbObject = new crud('clients');
        $dbObject->updateManagerClient($idclient, $idmanager);
}
