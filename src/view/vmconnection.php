<?php
require_once "header.php";
$DaoSpeciality = new DaoSpeciality(DBHOST, DBNAME, PORT, USER, PASS);
$speArray = $DaoSpeciality->getSpeciality();
$DaoCity = new DaoCity(DBHOST, DBNAME, PORT, USER, PASS);
$cityArray = $DaoCity->getAllCities();
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
<script src="/src/js/vmconnection.js"></script>
<link rel="stylesheet" href="/src/css/mconnection.css">

<div class="corpse"> <!-- Content area-->
    <div id="topHeader">
        <p id="namePage" class="fs-5 d-none d-sm-inline title">Créer mon espace praticien</p>
    </div>
    <form method="POST" action="/espacedoc/creation/result" id="docForm">
        <h4>Votre identité</h4>
        <hr>

        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Nom</span>
            <input
                type="text"
                class="form-control"
                placeholder="ex: Dufouleur"
                aria-label="Username"
                aria-describedby="basic-addon1"
                name="surname"
            />
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon2">Prénom</span>
            <input
                type="text"
                class="form-control"
                placeholder="ex: Cédric"
                aria-label="Recipient's username"
                aria-describedby="basic-addon2"
                name="name"
            />
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon2">Téléphone</span>
            <input
                type="tel"
                class="form-control"
                placeholder="ex: 0754623158"
                aria-label="Recipient's username"
                aria-describedby="basic-addon2"
                name="phone"
            />
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Adresse mail</span>
            <input
                type="mail"
                class="form-control"
                placeholder="cedric.df@gmail.com"
                aria-label="Amount (to the nearest dollar)"
                name="mail"
            />
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Mot de passe</span>
            <input
                type="password"
                class="form-control"
                aria-label="Amount (to the nearest dollar)"
                name="password"
            />
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Mot de passe (confirmation)</span>
            <input
                    type="password"
                    class="form-control"
                    aria-label="Amount (to the nearest dollar)"
                    name="passwordVerify"
            />
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon2">Votre identifiant praticien</span>
            <input
                    type="number"
                    class="form-control"
                    aria-label="Recipient's username"
                    aria-describedby="basic-addon2"
                    name="id_p"
            />
        </div>

        <h4>Votre établissement de santé</h4>
        <hr>
        <div class="input-group mb-3">
            <span class="input-group-text">Numéro</span>
            <input
                type="number"
                class="form-control"
                placeholder="ex: 48"
                aria-label="Username"
                name="num"
            />
            <span class="input-group-text">Adresse postale</span>
            <input
                type="text"
                class="form-control"
                placeholder="ex: Rue Jean Moulin"
                aria-label="Server"
                name="street"
            />
            <select class="form-select form-override" aria-label="Default select example" name="city">
                <?php
                if(isset($cityArray)){
                    foreach ($cityArray as $c){ ?>
                    <option name="<?=$c["city"]?>" value="<?= $c["code_insee"] ?>"> <?=$c["city"]?> </option>
                <?php }
                }?>
            </select>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon2">Nom de votre établissement</span>
            <input
                    type="text"
                    class="form-control"
                    placeholder="ex: Belena Sante"
                    aria-label="Recipient's username"
                    aria-describedby="basic-addon2"
                    name="name_e"
            />
        </div>
        <h4>Votre spécialité</h4>
        <hr>
        <select class="form-select form-override" aria-label="Default select example" name="specialite">
            <!-- Will output all the specialities from the db in the select menu-->
            <?php
            if(isset($speArray)){
                foreach ($speArray as $s){
                    ?>
                    <option name="<?=$s["type"]?>" value="<?= $s["type"] ?>"> <?=$s["type"]?> </option>
                <?php }
            }?>
        </select>
        <br>
        <div class="pt-1 mb-4">
            <button class="btn btn-dark btn-sm btn-block" type="submit">Créer un compte</button>
        </div>
    </form>

</div>