<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Doct'HUH'lib</title>
    <link rel="icon" type="image/png" href="/assets/img/huh.png">
    <link rel="stylesheet" type="text/css" href="/src/css/header.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter">
    <script src="https://kit.fontawesome.com/5b8b37978c.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                <a href="/" class="linkTitle d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <span class="fs-4 d-none d-sm-inline title">Doct'HUH'lib</span>
                </a>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <li class="nav-item">
                        <a href="/" class="colorIndex link align-middle px-0">
                            <i class="fa-solid fa-house"></i>
                            <span class=" ms-1 d-none d-sm-inline fsblock">Accueil</span>
                        </a>
                    </li>

                    <li>
                        <a href="/rendezvous" class=" colorIndex link px-0 align-middle">
                            <i class="fa-solid fa-calendar-days"></i>
                            <span class="ms-1 d-none d-sm-inline fsblock">Espace santé</span>
                        </a>
                    </li>
                    <?php
                    if(isset($_SESSION["user"]) && $_SESSION["user"]->isSpeInit() ){ ?>
                    <li>
                        <a href="/espacedoc" class="colorIndex link px-0 align-middle">
                            <i class="fa-solid fa-stethoscope"></i>
                            <span class="ms-1 d-none d-sm-inline fsblock">Espace practicien</span></a>
                    </li>
                    <?php } ?>

                </ul>
                <hr>
                <?php 
                     if(session_status() !== PHP_SESSION_ACTIVE){
                            session_start();
                     }
                    if (!isset($_SESSION["user"])) // User is not connected
                        {
                            ?>
                                  <div class="dropdown pb-4">
                                                <a href="/login" class="d-flex align-items-center text-white text-decoration-none>
                                                    <i class="fa-solid fa-right-to-bracket"></i>
                                                    <span class="d-none d-sm-inline mx-1">Se connecter</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                    <?php
                    }
                    else { ?>
                                            <div class="dropdown pb-4">
                                            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                                <img src="/assets/img/<?=$_SESSION['user']->get_picture()?>" alt="hugenerd" width="30" height="30" class="rounded-circle">
                                                <span class="d-none d-sm-inline mx-1"><?= "  ". ucfirst($_SESSION["user"]->get_name()) ." ". strtoupper($_SESSION["user"]->get_surname()) ?></span>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                                                <li><a class="dropdown-item" href="/account">Compte</a></li>
                                                <li><a class="dropdown-item" onclick="delSession()" href="/disconnect">Se déconnecter</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                    <?php
                    }?>




</body>
</html>