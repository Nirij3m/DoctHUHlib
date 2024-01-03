<?php 
require_once "header.php";
?>
<link rel="stylesheet" href="/src/css/accueil.css">
<script src="/src/js/editAccount.js" defer></script>
<div class="corpse"> <!-- Content area-->
    <div id="topHeader">
        <p id="namePage" class="fs-5 d-none d-sm-inline title">Compte</p>
    </div>

    <div class="container px-4 py-5" id="featured-3">
        <form method="POST" data-sb-form-api-token="API_TOKEN" enctype="multipart/form-data" action="/account/result">
            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="phone" class="form-label">E-mail</label>
                        <input type="email" name="email" class="form-control" id="email" value="<?=$user->get_mail()?>">
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">N° de téléphone</label>
                        <input type="tel" name="phone" class="form-control" id="phone" value="<?=$user->get_phone()?>">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Nouveau mot de passe</label>
                        <input type="password" name="pass" class="form-control" id="exampleInputPassword1">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Confirmez le nouveau mot de passe</label>
                        <input type="password" name="passVerify" class="form-control" id="exampleInputPassword1">
                    </div>
                </div>

                <div class="col">
                    <div class="mb-3">
                        <img src="<?=$img_account . $user->get_picture()?>" id="pfp" width=250 height=250>
                        <input name="img" type="file" id="img" accept="image/png, image/jpeg image/jpg" />
                    </div>
                </div>

                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Mot de passe actuel</label>
                    <input type="password" name="oldPass" class="form-control" id="exampleInputPassword1" required>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

</div>
</html>
