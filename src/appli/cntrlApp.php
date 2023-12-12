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
        $DaoSpeciality = new DaoSpeciality(DBHOST, DBNAME, PORT, USER, PASS);
        $alerts = [];
        $speciality = $DaoSpeciality->getSpeciality();
        print_r($speciality);


        require PATH_VIEW . "vrendezvous.php";
    }

    public function getMedecin(){
        $nom = $_POST["nom"];
        $specialite = $_POST["specialite"];

        require PATH_VIEW . "vrendezvous.php";
    }
}
