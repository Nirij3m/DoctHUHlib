<?php
require_once "utils.php";

class cntrlApp {
    public function getAccueil() {
        $alerts = [];

        require PATH_VIEW . "vaccueil.php";
    }
    public function getRendezVous() {
        $alerts = [];

        require PATH_VIEW . "vrendezvous.php";
    }
}