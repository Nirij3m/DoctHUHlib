<?php
// Organize server path requested
$method = $_SERVER["REQUEST_METHOD"];                   // Récupération de la méthode (GET/POST)
$uri    = explode("?", $_SERVER["REQUEST_URI"])[0];     // Récupération du contexte (/...)

// Uncomment this if you want to display errors on all pages.
/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

// Controllers.
require_once "src/appli/cntrlLogin.php";
require_once "src/appli/cntrlApp.php";
require_once "src/dao/DaoTime.php";
require_once "src/metier/User.php";

// Objets controllers
$cntrlLogin = new cntrlLogin();
$cntrlApp   = new cntrlApp();
$utils      = new Utils();
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}


if (isset($_SESSION['user']))   $user = $_SESSION['user'];
else                            $user = null;


// Redirection selon l'URL

if ($method == "GET") {
    if ($uri == "/")                        $cntrlApp->getAccueil();
    elseif ($uri == "/login")               $cntrlLogin->getConnectionForm();
    elseif ($uri == "/rendezvous")         $cntrlApp->getRendezVous();
    elseif($uri == "/espacedoc")            $cntrlApp->getDocPage();
    elseif ($uri == "/account")             $cntrlLogin->getAccountEdit();
    elseif ($uri == "/pastmeetings")        $cntrlApp->getPastMeetings();
    elseif ($uri == "/disconnect")          $cntrlLogin->getDisconnect();
    elseif($uri == "/debug")                $utils->constructSession(12);
    elseif($uri == "/espacedoc/creation")   $cntrlLogin->getDocConnectionForm();
    else $cntrlLogin->getConnectionForm();
}
elseif ($method == "POST") {
    if ($uri == "/login/result")                            $cntrlLogin->getLoginResult();
    elseif ($uri == "/register/result")                     $cntrlLogin->getRegisterResult();
    elseif ($uri == "/rendezvous/result")                   $cntrlApp->getMedecin();
    elseif ($uri === "/disconnect")                         $utils->destructSession();
    elseif ($uri == "/rendezvous/medecin/disponibilites")   $cntrlApp->dispoMedecin();
    elseif ($uri == "/rendezvous/medecin/result")           $cntrlApp->userReservation();
    elseif ($uri == '/rendezvous/cancel')                   $cntrlApp->getCancelMeeting();
    elseif($uri == '/espacedoc')                            $cntrlApp->getDocPage();
    elseif($uri == '/espacedoc/result')                     $cntrlApp->createMeeting();
    elseif($uri == '/espacedoc/creation/result')            $cntrlLogin->getRegisterDocResult();
    elseif($uri == '/espacedoc/delete')                     $cntrlApp->deleteMeeting();
    elseif($uri == '/account/result')                       $cntrlLogin->getAccountEditResult();
    else $cntrlLogin->getConnectionForm();
}