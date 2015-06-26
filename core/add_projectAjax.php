<?session_start();
require_once 'classes/crud.php';
if (!empty($_POST)){

    $project_name    = $_POST['project_name'];
    $idworkerProject = $_SESSION['workerId'];
    $idclient        = $_POST['idclient'];
    $dbObject        = new crud('projects');
    $projectQuery    = "INSERT INTO projects VALUES ('', '$project_name' , '$idworkerProject', '1', '$idclient')";

    if ( $dbObject->query($projectQuery) ){ //Вставка записи проекта

        $idproject      = $dbObject->getMaxId('projects');
        $names          = $_POST['name'];
        $summaries      = $_POST['summary'];
        $startdates     = $_POST['startdate'];
        $finishdates    = $_POST['finishdate'];
        $idworkers      = $_POST['worker'];
        $descriptions   = $_POST['description'];
        $query          = "INSERT INTO tasks VALUES ";

        for ($i=0;$i<count($_POST['name']);$i++){
            $set .= " ( $names[$i], $summaries[$i], $startdates[$i], $finishdates[$i], $idproject, $idworkers[$i], $descriptions[$i] ),";
        }
        $set = substr($set, 0, -1);
        $query = $query . $set;

        if ( $dbObject->query($query) ){
            echo "Создание проекта заверешно";
        }else{
            echo "Возникли ошибки при добавлении задач";
        }
    }else{
        echo "Ошибка при создании проекта";
    }
}