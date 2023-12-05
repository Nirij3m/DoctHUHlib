<?php
require_once "utils.php";
require_once "src/dao/DaoUser.php";
class cntrlLogin {
    public function getConnectionForm() {
        $alerts = [];

        require PATH_VIEW . "vconnection.php";
    }

    public function getLoginResult() {
        $alerts = [];

        $mail       = $_POST['mail'];
        $password   = $_POST['password'];
        $daoUser    = new DaoUser(DBHOST, DBNAME, PORT, USER, PASS);
        $id = $daoUser->connectUser($mail, $password);

        if ($id == NULL) {
            array_push($alerts, ['danger', "L'adresse mail ou le login entré est incorrect"]);
        }
        
        require PATH_VIEW . "vconnection.php";
    }

    public function getRegisterResult() {
        $alerts = [];

        $name           = $_POST['name'];
        $surname        = $_POST['surname'];
        $phone          = $_POST['phone'];
        $mail           = $_POST['mail'];
        $mailVerify     = $_POST['mailVerify'];
        $password       = $_POST['password'];
        $passwordVerify = $_POST['passwordVerify'];

        if ($mail == $mailVerify && $password == $passwordVerify) {
            $daoUser = new DaoUser(DBHOST, DBNAME, PORT, USER, PASS);
            $hashedPass = password_hash($password, PASSWORD_BCRYPT);
            $daoUser->registerUser($name, $surname, $phone, $mail, $hashedPass);
        }
    }
}