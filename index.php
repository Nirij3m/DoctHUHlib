<?php
// Organize server path requested
$method = $_SERVER["REQUEST_METHOD"];                   // Récupération de la méthode (GET/POST)
$uri    = explode("?", $_SERVER["REQUEST_URI"])[0];     // Récupération du contexte (/...)

// Controllers.
require_once "src/appli/cntrlLogin.php";
require_once "src/appli/cntrlApp.php";

// DAO.
// Peut-être vérifier la session utilisateur ici au lieu du header :
// Nous permetra de redirect si besoin. (à voir dans le futur cependant)

// Objets controllers
$cntrlLogin = new cntrlLogin();
$cntrlApp   = new cntrlApp();

// Redirection selon l'URL
// (oui, un switch case peut très bien fonctionner aussi si tu le souhaites ! :3)
if ($method == "GET") {
    if ($uri == "/")                        $cntrlApp->getAccueil();
    elseif ($uri == "/login")               $cntrlLogin->getConnectionForm();
    elseif ($uri == "/rendezvous")         $cntrlApp->getRendezVous();
    else $cntrlLogin->getConnectionForm();
}
elseif ($method == "POST") {
    if ($uri == "/login/result")                $cntrlLogin->getLoginResult();
    elseif ($uri == "/register/result")         $cntrlLogin->getRegisterResult();
    elseif ($uri == "/rendezvous/result")       $cntrlApp->getMedecin();
    else $cntrlLogin->getConnectionForm();
}