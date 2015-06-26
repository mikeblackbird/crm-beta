<?session_start();
$workerId = $_SESSION['workerId'];
if (!empty($_POST['idTask'])){
    $idTask = $_POST['idTask'];
    require_once 'classes/crud.php';
    $dbObject = new crud('tasks');
    $query = "UPDATE tasks SET opened = 0 WHERE id = '$idTask' ";
    $dbObject->query($query);
}
