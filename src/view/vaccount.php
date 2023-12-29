<?php 
require_once "header.php";
?>
<link rel="stylesheet" href="/src/css/accueil.css">
<div class="corpse"> <!-- Content area-->
    <div id="topHeader">
        <p id="namePage" class="fs-5 d-none d-sm-inline title">Accueil</p>
    </div>

    <div class="container px-4 py-5" id="featured-3">
        <form method="GET" action="/account/edited">
            <div class="mb-3">
                <label for="phone" class="form-label">N° de téléphone</label>
                <input type="phone" name="phone" class="form-control" id="phone" value="<?=$user->get_phone()?>">
            </div>

            <div class="mb-3">
                <label for="mail" class="form-label">Email address</label>
                <input type="email" name="mail" class="form-control" id="mail" value="<?=$user->get_mail()?>" aria-describedby="emailHelp">
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Nouveau mot de passe</label>
                <input type="password" name="pass" class="form-control" id="exampleInputPassword1">
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Confirmez le nouveau mot de passe</label>
                <input type="password" name="passVerify" class="form-control" id="exampleInputPassword1">
            </div>

            <div class="mb-3 form-check">
                <label class="form-check-label" for="place_name">Nom de bâtiment</label>
                <input type="text" name="place_name" class="form-control" id="place_name">
            </div>

            <div class="mb-3 form-check">
                <label class="form-check-label" for="code_postal">Code postal</label>
                <input type="text" name="code_postal" class="form-control" id="code_postal">
            </div>

            <div class="mb-3 form-check">
                <label class="form-check-label" for="nRue">Numéro de rue</label>
                <input type="text" name="code_postal" class="form-control" id="code_postal">
            </div>

            <div class="mb-3 form-check">
                <label class="form-check-label" for="street">Rue</label>
                <input type="text" name="street" class="form-control" id="street">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</div>
</html>
