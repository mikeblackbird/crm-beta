<?session_start();
$workerId = $_SESSION['workerId'];
if (!empty($_POST['idTask'])){
    $idTask = $_POST['idTask'];
    $idAuthor = $_POST['idfrom'];
    echo 'idAuthor: '.$idAuthor;
    require_once 'classes/crud.php';
    $dbObject = new crud('tasks');
    $query = "UPDATE tasks SET idworker = '$idAuthor', cond = 3 WHERE id = '$idTask' ";
    $dbObject->query($query);
}
