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
                <?php if (!isset($user)) { ?>
                    <h2>Connectez-vous</h2>
                    <p>Afin de tirer le meilleur de Doct'HUH'lib et de consulter votre profil et services associés</p>
                    <a href="/login" class="icon-link">
                        Se connecter
                        <svg class="bi" width="1em" height="1em"><use xlink:href="#chevron-right"></use></svg>
                    </a>
                <?php } else { ?>
                    <h2>Bienvenue, <?=ucfirst($user->get_name())?> <?=strtoupper($user->get_surname())?>.</h2>
                    <?php if ($meeting != null) { ?>
                    <p>
                        Votre prochain rendez-vous est le <?=$meeting->get_beginning()->format('d/m/y')?> à <?=$meeting->get_beginning()->format('H\hi')?> avec le <?=$meeting->get_medecin()->get_speciality()->get_type()?> <?=ucfirst($meeting->get_medecin()->get_surname())?> <?=strtoupper($meeting->get_medecin()->get_name())?>.<br>
                        Il s'effectuera à <?=ucfirst($meeting->get_place()->get_street())?> (<?=$meeting->get_place()->get_num_street()?> <?=ucfirst($meeting->get_place()->get_city()->get_city())?>)
                    </p>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>

</div>
</html>
