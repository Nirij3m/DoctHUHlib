<?php
require_once "utils.php";
require_once "src/dao/DaoUser.php";
class cntrlLogin {
    /*
    Contrôleur possédant toutes les pages en lien avec l'enregistrement et
    la connexion.
    */
    public function getConnectionForm() {
        $alerts = [];

        require PATH_VIEW . "vconnection.php";
    }

    public function getLoginResult() {
        $utils = new Utils();
        $mail       = $_POST['mail'];
        $password   = $_POST['password'];
        $daoUser    = new DaoUser(DBHOST, DBNAME, PORT, USER, PASS);
        $id = $daoUser->connectUser($mail, $password);

        if ($id == NULL) {
            $needle = "L'adresse email ou le mot de passe renseigné est incorrect";
            $utils->echoError($needle);
            require PATH_VIEW . "vconnection.php";

        }
        else {
            $needle = "Vous êtes connecté";
            $utils->echoSuccess($needle);
            require PATH_VIEW . "vrendezvous.php";
        }
    }

    public function getRegisterResult() {

        $utils = new Utils();
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
            $errString = $daoUser->registerUser($name, $surname, $phone, $mail, $hashedPass); //returns a string containing the appropriate warning message if a PDOException is catched. Empty if sucess
        }
        if(empty($errString)){ //No errors, account created, start session and redirect on rendez-vous page
            require PATH_VIEW . "vrendezvous.php";
            $utils->echoSuccess("Votre compte a bien été créé.");
            $utils->clearAlert();
        }
        else{ //error, appen error message and reload the page
            $utils->echoError($errString);
            $utils->clearAlert();
        }
    }
}