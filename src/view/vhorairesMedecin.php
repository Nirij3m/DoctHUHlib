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
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-md-9 col-lg-7 col-xl-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="d-flex text-black">
                            <div class="flex-shrink-0">
                                <img src="/assets/img/<?=$medecin->get_picture()?>"
                                alt="Generic placeholder image" class="img-fluid"
                                style="width: 180px; border-radius: 10px;">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="mb-1"><?=strtoupper($medecin->get_surname())?> <?=ucfirst($medecin->get_name())?></h5>
                                <p class="mb-2 pb-1" style="color: #2b2a2a;"><?=$medecin->get_speciality()->get_type()?></p>
                                <div class="d-flex justify-content-start rounded-3 p-2 mb-2"
                                style="background-color: #efefef;">
                                <div>
                                    <p class="small text-muted mb-1">Adresse</p>
                                    <p class="mb-0"><?=$medecin->get_place()->get_name()?></p>
                                    <p class="mb-0"><?=$medecin->get_place()->get_num_street()?> <?=$medecin->get_place()->get_street()?></p>
                                    <p class="mb-0"><?=$medecin->get_place()->get_city()->get_code_postal()?> <?=$medecin->get_place()->get_city()->get_city()?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <?php foreach ($medecin->get_meetings() as $day => $meetings) {?>
            <h1><?=$day?></h1>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Début</th>
                        <th scope="col">Fin</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($meetings as $meeting) { ?>
                        <tr>
                            <td><?=$meeting->get_beginning()->format('H\hi')?></td>
                            <td><?=$meeting->get_ending()->format('H\hi')?></td>
                            <td>
                                <?php if ($meeting->get_user() == null) { ?>
                                    <form method="POST" action="/rendezvous/medecin/result">
                                        <input type="text" name="idMeeting" value="<?=$meeting->get_id()?>" hidden>
                                        <button type="submit" class="btn btn-primary">Réserver</button>
                                    </form>
                                    <?php }
                                    else if ($meeting->get_user()->get_id() == $user->get_id()) { ?>
                                        <buttton class="btn btn-warning">Votre horaire</buttton>
                                    <?php }
                                    else { ?>
                                        <button class="btn btn-danger">Occupé</button>
                                    <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } ?>
    </div>
</div>