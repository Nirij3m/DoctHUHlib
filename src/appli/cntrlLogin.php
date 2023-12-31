<?php
require_once "utils.php";
require_once "src/dao/DaoUser.php";
require_once "src/dao/DaoSpeciality.php";
require_once "src/appli/cntrlApp.php";
class cntrlLogin {
    /*
    Contrôleur possédant toutes les pages en lien avec l'enregistrement et
    la connexion.
    */
    public function getConnectionForm() {
        session_start();
        if (isset($_SESSION['user'])) {
            session_write_close();
            $utils = new Utils();
            $utils->echoInfo("Vous êtes déjà connecté ! Redirection sur l'accueil");
            require PATH_VIEW . "vaccueil.php";
        }
        else {
            session_write_close();
            require PATH_VIEW . "vconnection.php";
        }
    }

    public function getDocConnectionForm(){

        require PATH_VIEW . "vmconnection.php";
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
            $utils->constructSession($id);
            $needle = "Vous êtes connecté";
            $utils->echoSuccess($needle);

            require PATH_VIEW . "vrendezvous.php";
        }
    }

    public function getRegisterResult() {
        $DaoUser = new DaoUser(DBHOST, DBNAME, PORT, USER, PASS);
        $name = $surname = $phone = $mail = $mailVerify = $password = $passwordVerify = "";
        $utils = new Utils();
        $alerts = [];

        $name           = $_POST['name'];
        $surname        = $_POST['surname'];
        $phone          = $_POST['phone'];
        $mail           = $_POST['mail'];
        $mailVerify     = $_POST['mailVerify'];
        $password       = $_POST['password'];
        $passwordVerify = $_POST['passwordVerify'];

        if(!$utils->isSanitize($name) || !$utils->isSanitize($surname)){
            $utils->echoWarning("Le nom et prénom ne peuvent contenir ni caractères spéciaux ni accents");
            require PATH_VIEW . "vconnection.php";
            return;
        }

        if($mail !== $mailVerify){
            $utils->echoWarning("La deuxième adresse mail ne correspond pas à la première");
            require PATH_VIEW . "vconnection.php";
            return;
        }
        if($password !== $passwordVerify){
            $utils->echoWarning("Le deuxième mot de passe ne correspond pas au premier");
            require PATH_VIEW . "vconnection.php";
            return;
        }
        else{
            $daoUser = new DaoUser(DBHOST, DBNAME, PORT, USER, PASS);
            $hashedPass = password_hash($password, PASSWORD_BCRYPT);
            $errString = $daoUser->registerUser($name, $surname, $phone, $mail, $hashedPass); //returns a string containing the appropriate warning message if a PDOException is catched. Empty if sucess
        }

        if(empty($errString)){ //No errors, account created, start session and redirect on rendez-vous page
            $id = $DaoUser->connectUser($mail, $password);
            $utils->constructSession($id);
            require PATH_VIEW . "vrendezvous.php";
            $utils->echoSuccess("Votre compte a bien été créé.");
            $utils->clearAlert();
        }
        else{ //error, appen error message and reload the page
            $utils->echoError($errString);
            $utils->clearAlert();
            require  PATH_VIEW . "vconnection.php";

        }
    }

    public function getAccountEdit() {
        $alerts = [];
        $daoSpeciality = new DaoSpeciality(DBHOST, DBNAME, PORT, USER, PASS);

        session_start();
        $user = $_SESSION['user'];
        session_write_close();

        $specialities = $daoSpeciality->getSpecialities();

        require PATH_VIEW . "vaccount.php";
    }

    public function getDisconnect()
    {
        $utils = new Utils();

        $utils->destructSession();

        require PATH_VIEW . "vconnection.php";
    }
    public function getRegisterDocResult() {
        $DaoUser = new DaoUser(DBHOST, DBNAME, PORT, USER, PASS);
        $cntrlApp = new cntrlApp();
        $name = $surname = $phone = $mail = $mailVerify = $password = $passwordVerify = "";
        $utils = new Utils();
        $name           = $_POST['name'];
        $surname        = $_POST['surname'];
        $phone          = $_POST['phone'];
        $mail           = $_POST['mail'];
        $password       = $_POST['password'];
        $passwordVerify = $_POST['passwordVerify'];
        $idPraticien = $_POST['id_p'];
        $numStreet = $_POST['num'];
        $street = $_POST['street'];
        $namePlace = $_POST['name_e'];
        $specialite = $_POST['specialite'];
        $codeInsee = $_POST['city'];


        if(!$utils->isSanitize($name) || !$utils->isSanitize($surname)){
            $utils->echoWarning("Le nom et prénom ne peuvent contenir ni caractères spéciaux ni accents");
            require PATH_VIEW . "vmconnection.php";
            return;
        }

        if($password !== $passwordVerify){
            $utils->echoWarning("Le deuxième mot de passe ne correspond pas au premier");
            require PATH_VIEW . "vmconnection.php";
            return;
        }
        else{
            $daoUser = new DaoUser(DBHOST, DBNAME, PORT, USER, PASS);
            $hashedPass = password_hash($password, PASSWORD_BCRYPT);
            $errString = $daoUser->registerDoc($name, $surname, $phone, $mail, $hashedPass, $numStreet, $street, $codeInsee, $namePlace, $specialite); //returns a string containing the appropriate warning message if a PDOException is catched. Empty if sucess
        }

        if(empty($errString)){ //No errors, account created, start session and redirect on rendez-vous page
            $id = $DaoUser->connectUser($mail, $password);
            $utils->constructSession($id);
            $cntrlApp->getDocPage();
            $utils->echoSuccess("Votre compte a bien été créé.");
            $utils->clearAlert();
        }
        else{ //error, appen error message and reload the page
            $utils->echoError($errString);
            $utils->clearAlert();
            require  PATH_VIEW . "vmconnection.php";
            return;
        }
    }
}