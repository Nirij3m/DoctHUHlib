<?php require_once "header.php"; ?>
<link rel="stylesheet" href="/src/css/medecin.css">
<?php $i = 0;?>
<div class="corpse"> <!-- Content area-->
    <div id="topHeader">
        <p id="namePage" class="fs-5 d-none d-sm-inline title">Espace practicien</p>
    </div>
    <div id="container">
        <h3>Votre planning</h3>
        <hr>
        <div id="calendar">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col"><?="Lundi". " ". $currentWeek->getDays()[0]->format("d/m")?></th>
                </tr>
                </thead>
                <tbody class="table-group-divider table-divider-color">
                    <?php

                        foreach($meetings as $m){
                            if($m->get_beginning()->format("N") == 1 && $m->get_user() != null) {
                                    $user = $m->get_user();
                                ?>
                                <tr>
                                    <td>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#<?='Modal'.$i?>">
                                            <u><p><?= $m->get_beginning()->format("H\hi"). " - ". $m->get_ending()->format("H\hi")?></p></u>
                                            <p><?=ucfirst(ucfirst($user->get_name())). " ". strtoupper($user->get_surname()) ?></p>
                                        </button

                                        <!-- Modal -->
                                        <div class="modal fade" id="<?='Modal'.$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Informations complémentaires</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Patient: <?=ucfirst($user->get_name()). " ". strtoupper($user->get_surname())?></p>
                                                        <p>Numéro de téléphone: <?= $user->get_phone()?></p>
                                                        <p>Adresse mail: <?= $user->get_mail()?></p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                        <?php $i++; }
                            elseif ($m->get_beginning()->format("N") == 1){?>
                                    <tr>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal">
                                                <u><p><?= $m->get_beginning()->format("H\hi"). " - ". $m->get_ending()->format("H\hi")?></p></u>
                                                <p>Libre</p>
                                            </button

                                        </td>
                                    </tr>
                            <?php }
                         }
                        ?>
                </tbody>
            </table>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col"><?="Mardi". " ". $currentWeek->getDays()[1]->format("d/m")?></th>
                </tr>
                </thead>
                <tbody class="table-group-divider table-divider-color">
                <?php

                foreach($meetings as $m){
                    if($m->get_beginning()->format("N") == 2 && $m->get_user() != null) {
                        $user = $m->get_user();
                        ?>
                        <tr>
                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#<?='Modal'.$i?>">
                                    <u><p><?= $m->get_beginning()->format("H\hi"). " - ". $m->get_ending()->format("H\hi")?></p></u>
                                    <p><?=ucfirst($user->get_name()). " ". strtoupper($user->get_surname()) ?></p>
                                </button

                                        <!-- Modal -->
                                <div class="modal fade" id="<?='Modal'.$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Informations complémentaires</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Patient: <?=ucfirst($user->get_name()). " ". strtoupper($user->get_surname())?></p>
                                                <p>Numéro de téléphone: <?= $user->get_phone()?></p>
                                                <p>Adresse mail: <?= $user->get_mail()?></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>

                    <?php $i++;}
                    elseif($m->get_beginning()->format("N") == 2){?>
                             <tr>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal">
                                                <u><p><?= $m->get_beginning()->format("H\hi"). " - ". $m->get_ending()->format("H\hi")?></p></u>
                                                <p>Libre</p>
                                            </button

                                        </td>
                                    </tr>
                    <?php }
                }?>
                </tbody>
            </table>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col"><?="Mercredi". " ". $currentWeek->getDays()[2]->format("d/m")?></th>
                </tr>
                </thead>
                <tbody class="table-group-divider table-divider-color">
                <?php

                foreach($meetings as $m){
                    if($m->get_beginning()->format("N") == 3 && $m->get_user() != null) {
                        $user = $m->get_user();
                        ?>
                        <tr>
                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#<?='Modal'.$i?>">
                                    <u><p><?= $m->get_beginning()->format("H\hi"). " - ". $m->get_ending()->format("H\hi")?></p></u>
                                    <p><?=ucfirst($user->get_name()). " ". strtoupper($user->get_surname()) ?></p>
                                </button

                                        <!-- Modal -->
                                <div class="modal fade" id="<?='Modal'.$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Informations complémentaires</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Patient: <?=ucfirst($user->get_name()). " ". strtoupper($user->get_surname())?></p>
                                                <p>Numéro de téléphone: <?= $user->get_phone()?></p>
                                                <p>Adresse mail: <?= $user->get_mail()?></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>

                    <?php $i++;}
                    elseif($m->get_beginning()->format("N") == 3){?>
                             <tr>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal">
                                                <u><p><?= $m->get_beginning()->format("H\hi"). " - ". $m->get_ending()->format("H\hi")?></p></u>
                                                <p>Libre</p>
                                            </button

                                        </td>
                                    </tr>
                    <?php }
                }?>
                </tbody>
            </table>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col"><?="Jeudi". " ". $currentWeek->getDays()[3]->format("d/m")?></th>
                </tr>
                </thead>
                <tbody class="table-group-divider table-divider-color">
                <?php

                foreach($meetings as $m){
                    if($m->get_beginning()->format("N") == 4 && $m->get_user() != null) {
                        $user = $m->get_user();
                        ?>
                        <tr>
                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#<?='Modal'.$i?>">
                                    <u><p><?= $m->get_beginning()->format("H\hi"). " - ". $m->get_ending()->format("H\hi")?></p></u>
                                    <p><?=ucfirst($user->get_name()). " ". strtoupper($user->get_surname()) ?></p>
                                </button

                                        <!-- Modal -->
                                <div class="modal fade" id="<?='Modal'.$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Informations complémentaires</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Patient: <?=ucfirst($user->get_name()). " ". strtoupper($user->get_surname())?></p>
                                                <p>Numéro de téléphone: <?= $user->get_phone()?></p>
                                                <p>Adresse mail: <?= $user->get_mail()?></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php $i++;}
                    elseif($m->get_beginning()->format("N") == 4){?>
                             <tr>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal">
                                                <u><p><?= $m->get_beginning()->format("H\hi"). " - ". $m->get_ending()->format("H\hi")?></p></u>
                                                <p>Libre</p>
                                            </button

                                        </td>
                                    </tr>
                    <?php }
                }?>
                </tbody>
            </table>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col"><?="Vendredi". " ". $currentWeek->getDays()[4]->format("d/m")?></th>
                </tr>
                </thead>
                <tbody class="table-group-divider table-divider-color">
                <?php

                foreach($meetings as $m){
                    if($m->get_beginning()->format("N") == 5 && $m->get_user() != null) {
                        $user = $m->get_user();
                        ?>
                        <tr>
                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#<?='Modal'.$i?>">
                                    <u><p><?= $m->get_beginning()->format("H\hi"). " - ". $m->get_ending()->format("H\hi")?></p></u>
                                    <p><?=ucfirst($user->get_name()). " ". strtoupper($user->get_surname()) ?></p>
                                </button

                                        <!-- Modal -->
                                <div class="modal fade" id="<?='Modal'.$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Informations complémentaires</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Patient: <?=ucfirst($user->get_name()). " ". strtoupper($user->get_surname())?></p>
                                                <p>Numéro de téléphone: <?= $user->get_phone()?></p>
                                                <p>Adresse mail: <?= $user->get_mail()?></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php $i++;}
                    elseif($m->get_beginning()->format("N") == 5){?>
                             <tr>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal">
                                                <u><p><?= $m->get_beginning()->format("H\hi"). " - ". $m->get_ending()->format("H\hi")?></p></u>
                                                <p>Libre</p>
                                            </button

                                        </td>
                                    </tr>
                    <?php }
                }?>
                </tbody>
            </table>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col"><?="Samedi". " ". $currentWeek->getDays()[5]->format("d/m")?></th>
                </tr>
                </thead>
                <tbody class="table-group-divider table-divider-color">
                <?php

                foreach($meetings as $m){
                    if($m->get_beginning()->format("N") == 6 && $m->get_user() != null) {
                        $user = $m->get_user();
                        ?>
                        <tr>
                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#<?='Modal'.$i?>">
                                    <u><p><?= $m->get_beginning()->format("H\hi"). " - ". $m->get_ending()->format("H\hi")?></p></u>
                                    <p><?=ucfirst($user->get_name()). " ". strtoupper($user->get_surname()) ?></p>
                                </button

                                        <!-- Modal -->
                                <div class="modal fade" id="<?='Modal'.$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Informations complémentaires</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Patient: <?=ucfirst($user->get_name()). " ". strtoupper($user->get_surname())?></p>
                                                <p>Numéro de téléphone: <?= $user->get_phone()?></p>
                                                <p>Adresse mail: <?= $user->get_mail()?></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>

                    <?php $i++;}
                    elseif($m->get_beginning()->format("N") == 6){?>
                             <tr>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal">
                                                <u><p><?= $m->get_beginning()->format("H\hi"). " - ". $m->get_ending()->format("H\hi")?></p></u>
                                                <p>Libre</p>
                                            </button

                                        </td>
                                    </tr>
                    <?php }
                }?>
                </tbody>
            </table>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col"><?="Dimanche". " ". $currentWeek->getDays()[6]->format("d/m")?></th>
                </tr>
                </thead>
                <tbody class="table-group-divider table-divider-color">
                <?php

                foreach($meetings as $m){
                    if($m->get_beginning()->format("N") == 7 && $m->get_user() != null) {
                        $user = $m->get_user();
                        ?>
                        <tr>
                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#<?='Modal'.$i?>">
                                    <u><p><?= $m->get_beginning()->format("H\hi"). " - ". $m->get_ending()->format("H\hi")?></p></u>
                                    <p><?=ucfirst($user->get_name()). " ". strtoupper($user->get_surname()) ?></p>
                                </button

                                        <!-- Modal -->
                                <div class="modal fade" id="<?='Modal'.$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Informations complémentaires</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Patient: <?=ucfirst($user->get_name()). " ". strtoupper($user->get_surname())?></p>
                                                <p>Numéro de téléphone: <?= $user->get_phone()?></p>
                                                <p>Adresse mail: <?= $user->get_mail()?></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>

                    <?php $i++;}
                    elseif($m->get_beginning()->format("N") == 7){?>
                             <tr>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal">
                                                <u><p><?= $m->get_beginning()->format("H\hi"). " - ". $m->get_ending()->format("H\hi")?></p></u>
                                                <p>Libre</p>
                                            </button

                                        </td>
                                    </tr>
                    <?php }
                }?>
                </tbody>
            </table>


        </div>

        <h3>Saisir vos disponibilités</h3>
        <hr>
        <form action="/espacedoc" method="POST">
            <select id="selectWeek" class="form-select" aria-label="Default select example" style="width: 25%;" name="selectedWeek">
                <option selected value="-1">Choisir une semaine...</option>
                <?php

                    foreach($weekArray as $w) {

                    ?>
                    <option value="<?= $i ?>"><?= $w->getBegin()->format('D. d/m/Y'). " - " . $w->getEnd()->format('D. d/m/Y')?></option>
                <?php
                        $i+=1;
                    }?>
            </select>
            <button type="submit">Charger</button>
        </form>
        <br>


            <?php
            if(isset($_POST["selectedWeek"])){
                if($_POST["selectedWeek"] != -1){
                foreach($weekArray[$_POST["selectedWeek"]]->getDays() as $d) {?>
                        <form action="/espacedoc/result" method="POST">
                            <div id="subcontainer">
                                <div class="form-outline mb-4">
                                    <input type="text" id="form2Example17" value="<?= $d->format('D. d/m/Y')?>" class="form-control form-control-sm" name="date" readonly/>
                                </div>

                                <div class="form-outline mb-3">
                                    <input type="time" id="timeStart"  name="timeStart" class="form-control form-control-sm" />

                                </div>
                                <div class="form-outline mb-4">
                                    <input type="time" id="timeEnd"  name="timeEnd" class="form-control form-control-sm" />
                                </div>
                                <button type="submit" class="btn btn-outline-secondary btn-sm">Enregistrer</button>
                            </div>
                        </form>
        <?php           }
                }
                else {
                    $utils->echoInfo("Veuillez choisir une semaine");
                }

            }?>


    </div>


    </div>
</div>
</html>
