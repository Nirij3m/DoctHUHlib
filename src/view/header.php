<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="/src/css/header.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter">
    <script src="https://kit.fontawesome.com/5b8b37978c.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>
<div class="container-fluid">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                <a href="/" class="linkTitle d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <span class="fs d-none d-sm-inline title">Doct'HUH'lib</span>
                </a>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <li class="nav-item">
                        <a href="/" class="link align-middle px-0">
                            <i class="fa-solid fa-house"></i>
                            <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline fsblock">Accueil</span>
                        </a>
                    </li>

                    <li>
                        <a href="/login" class="link px-0 align-middle">
                            <i class="fa-solid fa-calendar-days"></i>
                            <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline fsblock">Rendez-vous</span></a>
                    </li>

                </ul>
                <hr>
                <?php 
                    $session = session_id();
                    if ($session == "") // User is not connected 
                    {
                        // TODO: c'est de meilleure pratique de ne pas mettre de echo et, à la place,
                        // couper le php avec un ? >, mettre l'HTML, puis reprendre le php avec < php ! (:
                        echo '
                                                <div class="dropdown pb-4">
                                                <a href="/login" class="d-flex align-items-center text-white text-decoration-none>
                                                    <i class="fa-solid fa-right-to-bracket"></i>
                                                    <span class="d-none d-sm-inline mx-1">Se connecter</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                        ';
                    }
                    else {
                        echo '
                                            <div class="dropdown pb-4">
                                            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                                <img src="https://github.com/mdo.png" alt="hugenerd" width="30" height="30" class="rounded-circle">
                                                <span class="d-none d-sm-inline mx-1">Hello</span>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                                                <li><a class="dropdown-item" href="#">Se déconnecter</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>';
                    }
                ?>



</body>
</html>