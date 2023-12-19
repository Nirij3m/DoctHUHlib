<?php require_once "src/view/header.php";
$DaoSpeciality = new DaoSpeciality(DBHOST, DBNAME, PORT, USER, PASS);
$speArray = $DaoSpeciality->getSpeciality();
?>
<link rel="stylesheet" type="text/css" href="/src/css/rendezvous.css">



<div class="corpse"> <!-- Content area-->
    <div id="topHeader">
        <p id="namePage" class="fs-5 d-none d-sm-inline title">Rendez-vous</p>
    </div>
    <div id="container">

        <h3>Chercher un practicien</h3>
        <hr>
        <div>
            <form id="alignement" action="/rendezvous/result" method="POST">
                <div class="form-group">
                    <span class="innerItem"> <i class="fa-solid fa-magnifying-glass"></i> <input type="text" name="nom" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nom prénom..."/></span>
                </div>
                <select class="form-select form-override" aria-label="Default select example" name="specialite">
                    <option selected>Sélectionner la spécialité</option>
                    <!-- Will output all the specialities from the db in the select menu-->
                    <?php
                        if(isset($speArray)){
                            foreach ($speArray as $s){
                    ?>
                     <option value="<?= $s["type"] ?>"> <?=$s["type"]?> </option>
                    <?php }
                        }?>
                </select>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

            <?php
                if(!empty($users[0])){
                ?>
                <table class="table align-middle mb-0 bg-white">
                    <thead class="bg-light">
                    <tr>
                        <th>Nom</th>
                        <th>Titre</th>
                        <th>Téléphone</th>
                        <th>Adresse</th>
                    </tr>
                    </thead>
                    <tbody>
            <?php
                    foreach ($users as $u){
            ?>
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <img
                                    src="https://mdbootstrap.com/img/new/avatars/8.jpg"
                                    alt=""
                                    style="width: 45px; height: 45px"
                                    class="rounded-circle"
                            />
                            <div class="ms-3">
                                <p class="fw-bold mb-1"><?= ucfirst($u["name"])." ". ucfirst($u["surname"])?></p>
                                <p class="text-muted mb-0"><?= $u["mail"] ?> </p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <p class="fw-normal mb-1"><?= $u["type"]?></p>
                    </td>
                    <td>
                        <?= $u["phone"]?>
                    </td>
                    <td>
                        <p class="fw-normal mb-1"><?= $u["num_street"] . " " . ucfirst($u["street"])?></p>
                        <p class="text-muted mb-0"><?= $u["code_postal"] . " " . ucfirst($u["city"])?></p>
                    </td>
                </tr>
            <?php
                    }
                }?>
            </tbody>
        </table>
    </div>



    </div>
</div>