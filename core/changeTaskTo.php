<?session_start();
$workerId = $_SESSION['workerId'];
if (!empty($_POST['idTask'])){
    $idTask = $_POST['idTask'];
    $idworker = $_POST['idworker'];
    echo 'idworker: '.$idworker;
    require_once 'classes/crud.php';
    $dbObject = new crud('tasks');
    $query = "UPDATE tasks SET idworker = '$idworker' WHERE id = '$idTask' ";
    $dbObject->query($query);
}
