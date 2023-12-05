<?php
// Organize server path requested
$method = $_SERVER["REQUEST_METHOD"];
$uri    = explode("?", $_SERVER["REQUEST_URI"])[0];
$headFilesPath = "";

// Controllers.
require_once "src/appli/cntrlLogin.php";

// DAO.

// Objets controllers
$cntrlLogin = new cntrlLogin();
if ($method == "GET") {
    if ($uri == "/")                        $cntrlLogin->getConnectionForm();
    elseif ($uri == "/login")               $cntrlLogin->getConnectionForm();
    else $cntrlLogin->getConnectionForm();
}
elseif ($method == "POST") {
    if ($uri == "/login/result")                $cntrlLogin->getLoginResult();
    elseif ($uri == "/register/result")         $cntrlLogin->getRegisterResult();
    else $cntrlLogin->getConnectionForm();
}