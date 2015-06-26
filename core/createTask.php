<?session_start();
$workerId = $_SESSION['workerId'];
if (!empty($_POST)){
    require_once 'classes/crud.php';
    $dbObject = new crud('tasks');
    $_POST['idfrom'] = $workerId;
    $_POST['opened'] = 1;
    $_POST['cond'] 	 = 1;
        $dbObject->create();
}
