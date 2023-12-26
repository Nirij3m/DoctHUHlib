<?php
require_once "utils.php";
require_once "src/dao/DaoUser.php";
require_once "src/dao/DaoSpeciality.php";
require_once "src/dao/DaoMeeting.php";

class cntrlApp {
    public function getAccueil() {
        $alerts = [];

        require PATH_VIEW . "vaccueil.php";
    }
    public function getRendezVous() {

        if(isset($_SESSION["user"])){
            require PATH_VIEW . "vrendezvous.php";
        }
        require PATH_VIEW . "vconnection.php";
    }

    public function getMedecin(){
        $DaoUser = new DaoUser(DBHOST, DBNAME, PORT, USER, PASS);
        $utils = new Utils();
        $alerts = [];
        $specialite = $_POST["specialite"];
        $nom = $_POST["nom"];

        if(!$utils->isSanitize($nom)){
            $utils->echoWarning("Le champ de recherche ne peut contenir ni caractères spéciaux ni accents");
            require PATH_VIEW . "vrendezvous.php";
            return;
        }


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
            $utils->echoInfo("Aucun practicien trouvé");
        }
        else if(empty($POST_["nom"])) {
            $users = $DaoUser->getByUserSpe(" ", " ", $specialite);
        }

        require PATH_VIEW . "vrendezvous.php";
    }

    public function dispoMedecin() {
        $alerts = [];
        $daoUser = new DaoUser(DBHOST, DBNAME, PORT, USER, PASS);
        $daoMeeting = new DaoMeeting(DBHOST, DBNAME, PORT, USER, PASS);

        $idMedecin = $_POST['idMedecin'];

        $medecin = $daoUser->getFullById($idMedecin);
        $medecin->set_meetings($daoMeeting->getMeetings($medecin));

        require PATH_VIEW . "vhorairesMedecin.php";
    }
}