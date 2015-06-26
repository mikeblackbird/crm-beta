<?php

require 'crud.php';
class user {

public $loginIn = false;

    public function login($username, $password){
        $crud = new crud();
            $userinfo = $crud->auth($username, $password);
            if (!$userinfo){
                return false;
            }else{
                $this->loginIn = true;
                return $userinfo;
            }
    }
/*
    public function getUserTasks(){
        $dbObject = new crud('tasks');
        $myTasks = $dbObject->getTasks();$myTasks = $myTasks[0];
}*/
} 