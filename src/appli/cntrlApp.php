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
        $speArray = $DaoSpeciality->getSpeciality();
        //print_r($speArray);


        require PATH_VIEW . "vrendezvous.php";
    }

    public function getMedecin(){
        $DaoSpeciality = new DaoSpeciality(DBHOST, DBNAME, PORT, USER, PASS);
        $alerts = [];
        $speArray = $DaoSpeciality->getSpeciality();

        $nom = $_POST["nom"];
        printf($nom);
        $specialite = $_POST["specialite"];
        printf($specialite);

        require PATH_VIEW . "vrendezvous.php";
    }
}
