<?session_start();
$workerId = $_SESSION['workerId'];
if (!empty($_POST['commentText']) && !empty($_POST['idTask']) && !empty($_POST['commentText'])){
    $commentText = $_POST['commentText'];
    $idTask = $_POST['idTask'];
    $commentText = $_POST['commentText'];
    require_once 'classes/crud.php';
    $dbObject = new crud('tasks');
    $query = "INSERT INTO comments VALUES ('', '$workerId', '$idTask', '$commentText')";
    if ($dbObject->query($query)){
        echo true;
    }else{
        echo false;
    }

}
