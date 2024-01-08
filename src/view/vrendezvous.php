<?php require_once "src/view/header.php";
$DaoSpeciality = new DaoSpeciality(DBHOST, DBNAME, PORT, USER, PASS);
$speArray = $DaoSpeciality->getSpeciality();
?>
<link rel="stylesheet" type="text/css" href="/src/css/rendezvous.css">
<script src="/src/js/vrendezvous.js"></script>



<div class="corpse"> <!-- Content area-->
    <div id="topHeader">
        <p id="namePage" class="fs-5 d-none d-sm-inline title">Rendez-vous</p>
    </div>
    <div id="container">

        <div class="mt-4">
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
                        <option name="<?=$s["type"]?>" value="<?= $s["type"] ?>"> <?=$s["type"]?> </option>
                        <?php }
                            }?>
                    </select>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>

                <?php if (!empty($users[0])) { ?>
                    <table class="table align-middle mb-0 bg-white">
                        <thead class="bg-light">
                            <tr>
                                <th>Nom</th>
                                <th>Titre</th>
                                <th>Téléphone</th>
                                <th>Adresse</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $u) { ?>
                                <form method="POST" action="/rendezvous/medecin/disponibilites">
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img
                                                        src="/assets/img/<?=$u->get_picture()?>"
                                                        alt=""
                                                        style="width: 45px; height: 45px"
                                                        class="rounded-circle"
                                                />
                                                <div class="ms-3">
                                                    <p class="fw-bold mb-1"><?=ucfirst($u->get_name()) . " " . strtoupper($u->get_surname())?></p>
                                                    <p class="text-muted mb-0"><?=$u->get_mail()?> </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="fw-normal mb-1"><?= $u->get_speciality()->get_type()?></p>
                                        </td>
                                        <td>
                                            <?= $u->get_phone()?>
                                        </td>
                                        <td>
                                            <p class="fw-normal mb-1"><?= $u->get_place()->get_name()?> </p>
                                            <p class="fw-normal mb-0"><?= $u->get_place()->get_num_street() . " " . ucfirst($u->get_place()->get_street())?></p>
                                            <p class="text-muted mb-0"><?= $u->get_place()->get_city()->get_code_postal() . " " . ucfirst($u->get_place()->get_city()->get_city())?></p>
                                        </td>
                                        <td>
                                            <input type="text" name="idMedecin" value="<?=$u->get_id()?>" hidden>
                                            <button type="submit" class="btn btn-primary">Prendre rendez-vous</button>
                                        </td>
                                    </tr>
                                </form>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } ?>
            </div>


            <?php if(sizeof($futureMeetings) != 0) { ?>
                <div class="mt-4">
                    <h3>Vos prochains rendez-vous</h3>
                    <hr>
                    <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Plage horaire</th>
                            <th scope="col">Médecin</th>
                            <th scope="col">Spécialité</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($futureMeetings as $meeting) { ?>
                            <tr>
                                <td><?=$meeting->get_beginning()->format('d/m/Y')?></td>
                                <td><?=$meeting->get_beginning()->format('H:i') . " - " . $meeting->get_ending()->format('H:i')?></td>
                                <td><?=ucfirst($meeting->get_medecin()->get_surname()) . " " . strtoupper($meeting->get_medecin()->get_name())?></td>
                                <td><?=$meeting->get_medecin()->get_speciality()->get_type()?></td>
                                <td class="d-flex flex-row justify-content-around">
                                    <form method="POST" action="/rendezvous/medecin/disponibilites">
                                        <input type="text" name="idMedecin" value="<?=$meeting->get_medecin()->get_id()?>" hidden />
                                        <button type="submit" class="btn btn-info">Réserver un autre RDV</button>
                                    </form>
                                    <?php if ($tomorrow < $meeting->get_beginning()) { ?>
                                        <form method="POST" action="/rendezvous/cancel">
                                            <input type="text" name="idMeeting" value="<?=$meeting->get_id()?>" hidden>
                                            <button type="submit" class="btn btn-danger">Annuler</button>
                                        </form>
                                    <?php } else { ?>
                                        <form>
                                            <button type="submit" class="btn btn-danger" title="Vous ne pouvez annuler un rendez-vous que 24h en avance" disabled>Annuler</button>
                                        </form>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>


        <?php if (sizeof($pastMeetings) != 0) { ?>
            <div class="mt-4">
                <h3>Vos anciens rendez-vous</h3>
                <hr>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Plage horaire</th>
                            <th scope="col">Médecin</th>
                            <th scope="col">Spécialité</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pastMeetings as $meeting) { ?>
                            <tr>
                                <td><?=$meeting->get_beginning()->format('d/m/Y')?></td>
                                <td><?=$meeting->get_beginning()->format('H:i') . " - " . $meeting->get_ending()->format('H:i')?></td>
                                <td><?=ucfirst($meeting->get_medecin()->get_surname()) . " " . strtoupper($meeting->get_medecin()->get_name())?></td>
                                <td><?=$meeting->get_medecin()->get_speciality()->get_type()?></td>
                                <td class="d-flex flex-row justify-content-around">
                                <form method="POST" action="/rendezvous/medecin/disponibilites">
                                    <input type="text" name="idMedecin" value="<?=$meeting->get_medecin()->get_id()?>" hidden />
                                    <button type="submit" class="btn btn-info">Réserver un autre RDV</button>
                                </form>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>
    </div>



    </div>
</div>