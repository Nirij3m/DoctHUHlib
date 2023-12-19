<?php 
require_once "header.php";
?>
<link rel="stylesheet" href="/src/css/accueil.css">
<div class="corpse"> <!-- Content area-->
    <div id="topHeader">
        <p id="namePage" class="fs-5 d-none d-sm-inline title">Accueil</p>
    </div>

    <div class="container px-4 py-5" id="featured-3">
        <h2 class="pb-2 border-bottom">Bienvenue sur votre espace santé</h2>
        <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
            <div class="feature col">
                <div class="feature-icon bg-primary bg-gradient">
                    <svg class="bi" width="1em" height="1em"><use xlink:href="#collection"></use></svg>
                </div>
                <h2>Simple!</h2>
                <p>A l'aide du menu latéral, naviguer et explorer facilement le site pour accéder à vos services</p>

            </div>
            <div class="feature col">
                <div class="feature-icon bg-primary bg-gradient">
                    <svg class="bi" width="1em" height="1em"><use xlink:href="#people-circle"></use></svg>
                </div>
                <h2>Espace santé</h2>
                <p>Depuis votre espace santé, vous pouvez accéder à tous les services de la plateforme. Prise de rendez-vous, recherche de practicien et historique de vos consultations passées</p>

            </div>
            <div class="feature col">
                <div class="feature-icon bg-primary bg-gradient">
                    <svg class="bi" width="1em" height="1em"><use xlink:href="#toggles2"></use></svg>
                </div>
                <h2>Connectez-vous</h2>
                <p>Afin de tirer le meilleur de Doct'HUH'lib et de consulter votre profil et services associés</p>
                <a href="/login" class="icon-link">
                    Se connecter
                    <svg class="bi" width="1em" height="1em"><use xlink:href="#chevron-right"></use></svg>
                </a>
            </div>
        </div>
    </div>

</div>
</html>
