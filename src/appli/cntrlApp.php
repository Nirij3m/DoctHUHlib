<?php
require_once "utils.php";
require_once "src/dao/DaoUser.php";
require_once "src/dao/DaoSpeciality.php";

class cntrlApp {
    public function getAccueil() {
        $alerts = [];

        require PATH_VIEW . "vaccueil.php";
    }
    public function getRendezVous() {


        require PATH_VIEW . "vrendezvous.php";
    }

    public function getMedecin(){
        $DaoUser = new DaoUser(DBHOST, DBNAME, PORT, USER, PASS);
        $alerts = [];
        $specialite = $_POST["specialite"];

        //TODO
        // Sanitize the user input regarding the $_POST["nom"] variable. $_POST["specialite"] is safe whatever the value manipulation is made
        /*
        echo $_POST["nom"];
        $_POST["nom"] = filter_var($_POST["nom"], FILTER_SANITIZE_STRING);
        echo $_POST["nom"];
        */
        if(!empty($_POST["nom"])){
            $nom = explode(" ", $_POST["nom"]); //Array that separates the name from the surname. [0] => surname, [1] => name
            if(isset($nom[1])){ //The user inputed a name and a surname
                $users = $DaoUser->getByUserSpe($nom[0], $nom[1], $specialite);
            }
            else{ //Tests each name and surname in cas the user inputed only one thing
                $u1 = $DaoUser->getByUserSpe(" ", $nom[0], $specialite);
                $u2 = $DaoUser->getByUserSpe($nom[0], " ", $specialite);
                if(!empty($u1)){
                    $users = $u1;
                }
                else if (!empty($u2)){
                    $users = $u2;
                }
            }
            //TODO Make and alert system when no doctors is found
        }
        else if(empty($POST_["nom"])){
            $users = $DaoUser->getByUserSpe(" ", " ", $specialite);
        }

        require PATH_VIEW . "vrendezvous.php";
    }
}
