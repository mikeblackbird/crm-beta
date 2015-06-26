<?php
/*
 * Класс crud, через методы описывает действия с базой данных
 */

class crud{
    private $tableName;
    public  $DBH;
    public  $nameColumns;
    public  $aliasColumns;
    function __construct($section){
        try{
            $DBH = new PDO('mysql:host=localhost;dbname=mv3', 'root', '');
            $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            $this->DBH = $DBH;
        }
        catch(PDOException $e) {
            echo "Хьюстон, у нас проблемы.";
            file_put_contents('admin/logs/PDOErrors.txt', $e->getMessage(), FILE_APPEND);
        }

        if ( !empty($section) ){
            switch($section){
                case 'clients'  :$this->tableName = 'clients';
                    $this->aliasColumns = array(
                        0 => "Номер",
                        1 => "Имя фирмы",
                        2 => "Контактное лицо",
                        3 => "Телефон",
                        4 => "Email",
                        5 => "Комментарий",
                        6 => "Активность"
                    );
                    $this->nameColumns = array(
                        0 => "id",
                        1 => "firmname",
                        2 => "facename",
                        3 => "phone",
                        4 => "email",
                        5 => "comment",
                        6 => "activity"
                    );
                    break;

                case 'workers'  :$this->tableName = 'workers';
                    $this->aliasColumns = array(
                        0 => "Номер",
                        1 => "Имя",
                        2 => "Телефон",
                        3 => "Email",
                        4 => "Должность",
                        5 => "Отдел"
                    );
                    $this->nameColumns = array(
                        0 => "id",
                        1 => "name",
                        2 => "phone",
                        3 => "email",
                        4 => "post",
                        5 => "division"
                    );
                    break;

                case 'tasks':$this->tableName = 'tasks';
                    $this->aliasColumns = array(
                        0 => "Номер задачи",
                        1 => "Имя задачи",
                        2 => "Дата начала",
                        3 => "Дата конца",

                    );
                    $this->nameColumns = array(
                        0 => "id",
                        1 => "name",
                        2 => "startdate",
                        3 => "finishdate",
                        4 => "idworker",
                        5 => "idfrom",
                        6 => "status",
                        7 => "description",

                    );
                    break;

                case 'projects':$this->tableName = 'projects';
                    $this->aliasColumns = array(
                        0 => "Номер",
                        1 => "Название",
                        2 => "Ответственный",
                        3 => "Активность проекта",
                        4 => "Клиент"
                    );
                    $this->nameColumns = array(
                        0 => "id",
                        1 => "name",
                        2 => "idworker",
                        3 => "activity",
                        4 => "idclient"
                    );
                    break;
                default: break;
            }
        }
    }

    public function create(){
        $SET = '';
        unset($_POST['create']);    //               из массива $_POST

        foreach ($_POST as $key => $value){
            $SET .=', `'.$key.'` = \''.$value.'\'';
        }
        $SET = substr($SET, 2);
        $sql = "INSERT INTO " .$this->tableName. " SET ". $SET;
        echo $sql;

        try{
          $this->DBH->query($sql);
        }
        catch(PDOException $e) {
            echo $e->getMessage();
            echo "<br/>".$sql;
            //file_put_contents('logs/PDOErrors.txt', $e->getMessage(), FILE_APPEND);
        }
    }

    public function read(){
            $STH = $this->DBH->query('SELECT * FROM '. $this->tableName);
            $STH->setFetchMode(PDO::FETCH_ASSOC);
            while($row = $STH->fetch()) {
                $result[] = $row;
            }
            return array($result);
    }

    public function workersRead(){
        $query =
            "SELECT workers.name, workers.id, workers.phone, workers.email, posts.name as post, divisions.divname
FROM workers, posts, divisions
 WHERE workers.post = posts.id AND workers.division = divisions.id ";
        $STH = $this->DBH->query($query);
        $STH->setFetchMode(PDO::FETCH_ASSOC);
        while($row = $STH->fetch()) {
            $result[] = $row;
        }
        return array($result);
    }

    public function managersRead(){
        $query =
            "SELECT workers.name, workers.id
             FROM workers
             WHERE workers.post = 2 ";
        $STH = $this->DBH->query($query);
        $STH->setFetchMode(PDO::FETCH_ASSOC);
        while($row = $STH->fetch()) {
            $result[] = $row;
        }
        return array($result);
    }

    public function activityRead(){
        $query = "SELECT DISTINCT clients.id, clients.firmname, clients.facename, clients.phone, clients.email, clients.comment, workers.name as worker FROM clients,workers WHERE clients.activity = 1 AND clients.idworker = workers.id";
        $STH = $this->DBH->query($query);
        $STH->setFetchMode(PDO::FETCH_ASSOC);
        while($row = $STH->fetch()) {
            $result[] = $row;
        }
        return array($result);
    }

    public function setCommentClient($idclient, $textComment){
        $query = "UPDATE clients SET comment = '$textComment' WHERE id = $idclient";
        try{
            if ( $this->DBH->query($query) ){
                echo "Коментарий клиента успешно изменен";
            }
        }
        catch(PDOException $e) {
            echo $e->getMessage();
            echo "<br/>".$query;
        }
    }

    public function MyActivityRead($idworker){
        $query = "SELECT DISTINCT clients.id, clients.firmname, clients.facename, clients.phone, clients.email, clients.comment FROM clients, workers WHERE clients.activity = 1 AND clients.idworker = $idworker";
        $STH = $this->DBH->query($query);
        $STH->setFetchMode(PDO::FETCH_ASSOC);
        while($row = $STH->fetch()) {
            $result[] = $row;
        }
        return array($result);
    }

    public function auth($login, $password){
        $query =  "SELECT workers.name, workers.id FROM workers WHERE workers.password = '$password' AND workers.login = '$login' ";
        $STH = $this->DBH->query($query);
        $STH->setFetchMode(PDO::FETCH_ASSOC);
        $row = $STH->fetch();
        if ( !empty ($row) ){
            return array($row);
        }else{
            return false;
        }
    }

    public function getProjects($idClient){
        $query = "SELECT clients.firmname, projects.name, projects.activity, projects.id as project FROM clients, projects WHERE clients.id = $idClient AND projects.idClient = $idClient ";
        $STH = $this->DBH->query($query);
        $STH->setFetchMode(PDO::FETCH_ASSOC);
        $row = $STH->fetch();
        return array($row);
    }

    public function getMyProjects($idworker){
        $query = "SELECT distinct projects.id, projects.name, clients.firmname FROM projects, clients WHERE projects.activity = 1 AND projects.idworker = $idworker AND projects.idclient = clients.id ";
        $STH = $this->DBH->query($query);
        $STH->setFetchMode(PDO::FETCH_ASSOC);
        while($row = $STH->fetch()) {
            $result[] = $row;
        }
        return array($result);
    }

    public function getClient($idclient){
        $query = "SELECT clients.id, clients.firmname, clients.facename, clients.phone, clients.email, clients.comment, clients.activity, workers.name, clients.INN, clients.address, clients.KPP, clients.BankName, clients.OGRN, clients.BIK, clients.RS
         FROM clients, workers WHERE clients.id = $idclient AND clients.idworker = workers.id";
        $STH = $this->DBH->query($query);
        $STH->setFetchMode(PDO::FETCH_ASSOC);
        $row = $STH->fetch();
        return array($row);
    }

    public function getWorker($id){
        $query = "SELECT workers.id, workers.name, workers.phone, workers.email, posts.name as post, divisions.divname FROM workers, posts, divisions WHERE workers.id=$id";
        $STH = $this->DBH->query($query);
        $STH->setFetchMode(PDO::FETCH_ASSOC);
        $row = $STH->fetch();
        return array($row);
    }

    public function getAllTasks(){
        $query = "
        SELECT tasks.id, tasks.name, tasks.startdate, tasks.finishdate,conditions.name as cond, workerz0.name as fromTask, workerz1.name as toTask, statuses.name as status, tasks.description, tasks.opened
        FROM tasks, workers as workerz0, workers as workerz1, statuses, conditions
        WHERE tasks.idworker = workerz0.id AND tasks.idfrom = workerz1.id AND tasks.status = statuses.id AND tasks.cond = conditions.id";
        $STH = $this->DBH->query($query);
        $STH->setFetchMode(PDO::FETCH_ASSOC);
        while($row = $STH->fetch()) {
            $result[] = $row;
        }
        return array($result);
    }

    public function getTask($idTask){
        $query =
        "SELECT tasks.id, tasks.name, tasks.finishdate, tasks.description, tasks.opened, conditions.name as conditionName, tasks.cond, workerz0.name as fromTask, workerz1.name as toTask, statuses.name as status, tasks.idfrom
        FROM tasks, workers as workerz0, workers as workerz1, statuses, conditions
        WHERE tasks.id = $idTask AND tasks.idworker = workerz0.id AND tasks.idfrom = workerz1.id AND tasks.status = statuses.id";

            $STH = $this->DBH->query($query);
            $STH->setFetchMode(PDO::FETCH_ASSOC);
            $row = $STH->fetch();
            return array($row);
    }

    public function getTasks($idWorker){
        $query = "SELECT tasks.id, tasks.name, tasks.finishdate, tasks.description, statuses.name as status, tasks.status as priority
        FROM tasks, statuses
        WHERE tasks.idworker = $idWorker AND tasks.status = statuses.id AND tasks.opened = 1";
        $STH = $this->DBH->query($query);
        $STH->setFetchMode(PDO::FETCH_ASSOC);
        while($row = $STH->fetch()) {
            $result[] = $row;
        }
        return array($result);
    }

    public function getTasksWorker($idworker){
         $query = "SELECT tasks.id, tasks.name, tasks.status as priority FROM tasks, statuses WHERE tasks.idworker = $idworker AND tasks.status = statuses.id";
        $STH = $this->DBH->query($query);
        $STH->setFetchMode(PDO::FETCH_ASSOC);
        while($row = $STH->fetch()) {
            $result[] = $row;
        }
        return array($result);
    }

    public function checkAccessTask($idTask, $idWorker){
        $query = "SELECT id FROM tasks WHERE id = $idTask AND ( idworker = $idWorker OR idfrom = $idWorker ) ";
        $STH = $this->DBH->query($query);
        $count = $STH->rowCount(PDO::FETCH_ASSOC);
        if ( $count > 0 ){
            return true;
        }else{
            return false;
        }
    }

    public function getTasksFromProject($idProject){
        $query = "SELECT tasks.id, tasks.name, tasks.summary, tasks.startdate, tasks.finishdate, statuses.name as status, projects.name as project, workers.name as worker
        FROM tasks, projects, statuses, workers
        WHERE  projects.id = $idProject AND tasks.status = statuses.id AND tasks.idworker = workers.id";
        $STH = $this->DBH->query($query);
        $STH->setFetchMode(PDO::FETCH_ASSOC);
        while($row = $STH->fetch()) {
            $result[] = $row;
        }
        return array($result);
    }




    public function getAllProjects(){
        $query = "SELECT projects.id, projects.name, projects.activity, clients.firmname FROM projects, clients WHERE projects.idClient = clients.id";
        $STH = $this->DBH->query($query);
        $STH->setFetchMode(PDO::FETCH_ASSOC);
        while($row = $STH->fetch()) {
            $result[] = $row;
        }
        return array($result);
    }

    public function getAllWorkers(){
        $query = "SELECT workers.id, workers.name, workers.phone, workers.email FROM workers";
        $STH = $this->DBH->query($query);
        $STH->setFetchMode(PDO::FETCH_ASSOC);
        while($row = $STH->fetch()) {
            $result[] = $row;
        }
        return array($result);   
    }

    public function  setWorkerByClient($idClient, $idWorker){
        $sql = "SELECT id FROM clients WHERE idworker IS NOT NULL AND activity > 0 AND id = $idClient";
        $STH = $this->DBH->query($sql);
        $count = $STH->rowCount();

        if ( $count != 0 ){
            echo "Этот клиент уже привязан! ";
            exit();
        }


        $query = "UPDATE clients SET activity = 1, idworker = $idWorker WHERE id = $idClient";
        try{
            if ( $this->DBH->query($query) ){
                echo "Клиент успешно привзяан к вашему аккаунту";
            }

        }
        catch(PDOException $e) {
            echo $e->getMessage();
            echo "<br/>".$query;
        }
    }

    public function update(){

        $SET = '';
        $id = $_POST['idUpdate'];
        unset($_POST['section']);   //Удаляем лишние элементы
        unset($_POST['action']);    //из массива $_POST
        unset($_POST['idUpdate']);

        foreach ($_POST as $key => $value){
            $SET .=', `'.$key.'` = \''.$value.'\'';
        }
        $SET = substr($SET, 2);
        $sql = "UPDATE " .$this->tableName. " SET ". $SET. " WHERE id = ' " . $id . "' ";
        echo $sql;

        try{
            $this->DBH->query($sql);
        }
        catch(PDOException $e) {
            echo "Хьюстон, у нас проблемы.";
            file_put_contents('logs/PDOErrors.txt', $e->getMessage(), FILE_APPEND);
        }
    }

    public function updateNow($updateID, $updateValue, $nameColumn){
        $updateValue = trim($updateValue);
        if($this->DBH->query("UPDATE ". $this->tableName. " SET ".$nameColumn." = ' ".$updateValue." ' WHERE id = ".$updateID)){
            echo "UPDATE ". $this->tableName. " SET ".$nameColumn." ='".$updateValue."' WHERE id = ".$updateID;
        }else{
             echo "Хьюстон, у нас проблемы.";
        }
    }

    public function delete($id){
        if ($this->DBH->query('DELETE FROM '. $this->tableName . ' WHERE id = '. $id)){
            echo "Запись успешно удалена";
        }
    }

    public function getOneRow($tableName, $id){
        $STH = $this->DBH->query('SELECT * FROM '. $tableName .' WHERE id = '. $id);
        $STH->setFetchMode(PDO::FETCH_ASSOC);
        $row = $STH->fetch();
        return $row;
    }


    public function getCountRows($tableName){
        $STH = $this->DBH->query('SELECT * FROM '. $tableName );
        $result  = $STH->rowCount();
        return $result;
    }

    public function query($query){
        try{
            $this->DBH->query($query);
        }
        catch(PDOException $e) {
            echo "Хьюстон, у нас проблемы.";
            file_put_contents('logs/PDOErrors.txt', $e->getMessage(), FILE_APPEND);
        }
    }

    public function getMaxId($tableName){
        $STH = $this->DBH->query('SELECT MAX(id) FROM '. $tableName);
        $STH->setFetchMode(PDO::FETCH_ASSOC);
        $row = $STH->fetch();
        return $row;
    }

    public function getCommentsTask($idTask){
        $query = "SELECT DISTINCT comments.id, comments.text, workers.name as author
        FROM comments, workers, tasks
        WHERE comments.idTask = $idTask AND comments.idAuthor = workers.id AND comments.idTask = tasks.id";
        $STH = $this->DBH->query($query);
        $STH->setFetchMode(PDO::FETCH_ASSOC);
        while($row = $STH->fetch()) {
            $result[] = $row;
        }
        return array($result);
    }

    public function updateManagerClient($idclient, $idmanager){
        $query = "UPDATE clients SET idworker = $idmanager WHERE id = $idclient";
        if ($this->DBH->query($query)){
            echo "Сопровождающий успешно имзенен";
        }else{
            echo "Возникли проблемы при изменении";
        }

    }

}