<?
/*
 * Файл устанавилвает связь в базе данных в таблице relat_mc между менеджером и клиентом
 * */
    if (!empty($_POST['idclient']) && !empty($_POST['idworker'])){
        $idClient = $_POST['idclient'];
        $idWorker = $_POST['idworker'];
        require_once 'classes/crud.php';
        $dbObject = new crud('clients');
        $dbObject->setWorkerByClient($idClient, $idWorker);
    }