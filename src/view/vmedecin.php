<?php require_once "header.php"; ?>
<link rel="stylesheet" href="/src/css/medecin.css">
<?php $i = 0;
if(isset($_POST["selectedWeek"]) && $_POST["selectedWeek"] != -1){
    $days = $weekArray[$_POST["selectedWeek"]]->getDays();
}
else $days = $currentWeek->getDays();
?>
<div class="corpse"> <!-- Content area-->
    <div id="topHeader">
        <p id="namePage" class="fs-5 d-none d-sm-inline title">Espace practicien</p>
    </div>
    <div id="container">
        <h3>Votre planning</h3>
        <hr>
        <form action="/espacedoc" method="POST" style="display: flex; flex-direction: row; gap: 1%;">
            <select id="selectWeek" class="form-select" aria-label="Default select example" style="width: 25%;" name="selectedWeek">
                <option selected value="-1">Choisir une semaine...</option>
                <?php
                $j = 0;
                foreach($weekArray as $w) {

                    ?>
                    <option value="<?= $j ?>"><?= $w->getBegin()->format('D. d/m/Y'). " - " . $w->getEnd()->format('D. d/m/Y')?></option>
                    <?php
                    $j+=1;
                }?>
            </select>
            <button type="submit" class="btn btn-light">Charger</button>
        </form>
        <br>

        <div id="calendar">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col"><?="Lundi". " ". $days[0]->format("d/m")?></th>
                </tr>
                </thead>
                <tbody class="table-group-divider table-divider-color">
                    <?php

                        foreach($meetings as $m){
                            if($m->get_beginning()->format("d-m-Y") == $days[0]->format("d-m-Y") && $m->get_user() != null) {
                                    $user = $m->get_user();
                                ?>
                                <tr>
                                    <td>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="colorPatient btn btn-primary" data-toggle="modal" data-target="#<?='Modal'.$i?>">
                                            <b><u><p style="color: #FDFBF6"><?= $m->get_beginning()->format("H\hi"). " - ". $m->get_ending()->format("H\hi")?></p></u></b>
                                            <b><p><?=ucfirst(ucfirst($user->get_name())). " ". strtoupper($user->get_surname()) ?></p></b>
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
                                                        <img
                                                                src="/assets/img/<?=$user->get_picture()?>"
                                                                alt=""
                                                                style="width: 90px; height: 90px; margin-bottom: 5%"
                                                                class="rounded-circle"
                                                        />
                                                        <span class="fbContainer"><p class="frontText"> Horaire:</p> <p class="backText"><?= $m->get_beginning()->format("H\hi"). " - ". $m->get_ending()->format("H\hi")?></p></span>
                                                        <span class="fbContainer"><p class="frontText"> Patient:</p> <p class="backText"><?=ucfirst($user->get_name()). " ". strtoupper($user->get_surname())?></p></span>
                                                        <span class="fbContainer"><p class="frontText"> Numéro de téléphone:</p> <p class="backText"><?= $user->get_phone()?></p></span>
                                                        <span class="fbContainer"><p class="frontText"> Adresse mail:</p> <p class="backText"><?= $user->get_mail()?></p></span>
                                                    </div>
                                                    <form id="<?= "Form".$i ?>" method="POST" action="/espacedoc/delete" style="display: none;">
                                                        <div class="d-none">
                                                            <input type="text" value="<?= $_POST["selectedWeek"] ?>" name="persistWeek">
                                                        </div>
                                                        <input value="<?= $m->get_medecin()->get_id()?>" name="idDoc">
                                                        <input value="<?= $m->get_beginning()->format("Y-m-d H:i:s")?>" name="tbeg">
                                                    </form>
                                                    <div class="modal-footer">
                                                        <button type="submit" form="<?= "Form".$i ?>" class="btn btn-danger" data-mdb-ripple-init>Supprimer l'horaire</button>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                        <?php $i++; }
                            elseif ($m->get_beginning()->format("d-m-Y") == $days[0]->format("d-m-Y")){?>
                                    <tr>
                                        <td>
                                            <button type="button" class="colorFree btn btn-primary" data-toggle="modal" data-target="#<?='subModal'.$i?>">
                                                <b><u><p><?= $m->get_beginning()->format("H\hi"). " - ". $m->get_ending()->format("H\hi")?></p></u></b>
                                                <b><p>Libre</p></b>
                                            </button

                                                    <!-- Modal -->
                                            <div class="modal fade" id="<?='subModal'.$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Informations complémentaires</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Aucun patient n'a réservé ce créneau</p>
                                                        </div>
                                                        <form id="<?= "Form".$i ?>" method="POST" action="/espacedoc/delete" style="display: none;">
                                                            <div class="d-none">
                                                                <input type="text" value="<?= $_POST["selectedWeek"] ?>" name="persistWeek">
                                                            </div>
                                                            <input value="<?= $m->get_medecin()->get_id()?>" name="idDoc">
                                                            <input value="<?= $m->get_beginning()->format("Y-m-d H:i:s")?>" name="tbeg">
                                                        </form>
                                                        <div class="modal-footer">
                                                            <button type="submit" form="<?= "Form".$i ?>" class="btn btn-danger" data-mdb-ripple-init>Supprimer l'horaire</button>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                            <?php $i++;}
                         }
                        ?>
                </tbody>
            </table>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col"><?="Mardi". " ". $days[1]->format("d/m")?></th>
                </tr>
                </thead>
                <tbody class="table-group-divider table-divider-color">
                <?php

                foreach($meetings as $m){
                    if($m->get_beginning()->format("d-m-Y") == $days[1]->format("d-m-Y") && $m->get_user() != null) {
                        $user = $m->get_user();
                        ?>
                        <tr>
                            <td>
                                <!-- Button trigger modal -->
                                        <button type="button" class="colorPatient btn btn-primary" data-toggle="modal" data-target="#<?='Modal'.$i?>">
                                    <b><u><p><?= $m->get_beginning()->format("H\hi"). " - ". $m->get_ending()->format("H\hi")?></p></u></b>
                                            <b><p><?=ucfirst($user->get_name()). " ". strtoupper($user->get_surname()) ?></p></b>
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
                                                        <img
                                                                src="/assets/img/<?=$user->get_picture()?>"
                                                                alt=""
                                                                style="width: 90px; height: 90px; margin-bottom: 5%"
                                                                class="rounded-circle"
                                                        />
                                                        <span class="fbContainer"><p class="frontText"> Horaire:</p> <p class="backText"><?= $m->get_beginning()->format("H\hi"). " - ". $m->get_ending()->format("H\hi")?></p></span>
                                                        <span class="fbContainer"><p class="frontText"> Patient:</p> <p class="backText"><?=ucfirst($user->get_name()). " ". strtoupper($user->get_surname())?></p></span>
                                                        <span class="fbContainer"><p class="frontText"> Numéro de téléphone:</p> <p class="backText"><?= $user->get_phone()?></p></span>
                                                        <span class="fbContainer"><p class="frontText"> Adresse mail:</p> <p class="backText"><?= $user->get_mail()?></p></span>
                                                    </div>
                                                    <form id="<?= "Form".$i ?>" method="POST" action="/espacedoc/delete" style="display: none;">
                                                        <div class="d-none">
                                                            <input type="text" value="<?= $_POST["selectedWeek"] ?>" name="persistWeek">
                                                        </div>
                                                        <input value="<?= $m->get_medecin()->get_id()?>" name="idDoc">
                                                        <input value="<?= $m->get_beginning()->format("Y-m-d H:i:s")?>" name="tbeg">
                                                    </form>
                                                    <div class="modal-footer">
                                                        <button type="submit" form="<?= "Form".$i ?>" class="btn btn-danger" data-mdb-ripple-init>Supprimer l'horaire</button>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                            </td>
                        </tr>

                    <?php $i++;}
                    elseif($m->get_beginning()->format("d-m-Y") == $days[1]->format("d-m-Y")){?>
                             <tr>
                                        <td>
                                            <button type="button" class="colorFree btn btn-primary" data-toggle="modal" data-target="#<?='subModal'.$i?>">
                                                <b><u><p><?= $m->get_beginning()->format("H\hi"). " - ". $m->get_ending()->format("H\hi")?></p></u></b>
                                                <b><p>Libre</p></b>
                                            </button

                                                    <!-- Modal -->
                                            <div class="modal fade" id="<?='subModal'.$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Informations complémentaires</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Aucun patient n'a réservé ce créneau</p>
                                                        </div>
                                                        <form id="<?= "Form".$i ?>" method="POST" action="/espacedoc/delete" style="display: none;">
                                                            <div class="d-none">
                                                                <input type="text" value="<?= $_POST["selectedWeek"] ?>" name="persistWeek">
                                                            </div>
                                                            <input value="<?= $m->get_medecin()->get_id()?>" name="idDoc">
                                                            <input value="<?= $m->get_beginning()->format("Y-m-d H:i:s")?>" name="tbeg">
                                                        </form>
                                                        <div class="modal-footer">
                                                            <button type="submit" form="<?= "Form".$i ?>" class="btn btn-danger" data-mdb-ripple-init>Supprimer l'horaire</button>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                    <?php $i++;}
                }?>
                </tbody>
            </table>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col"><?="Mercredi". " ". $days[2]->format("d/m")?></th>
                </tr>
                </thead>
                <tbody class="table-group-divider table-divider-color">
                <?php

                foreach($meetings as $m){
                    if($m->get_beginning()->format("d-m-Y") == $days[2]->format("d-m-Y") && $m->get_user() != null) {
                        $user = $m->get_user();
                        ?>
                        <tr>
                            <td>
                                <!-- Button trigger modal -->
                                        <button type="button" class="colorPatient btn btn-primary" data-toggle="modal" data-target="#<?='Modal'.$i?>">
                                    <b><u><p><?= $m->get_beginning()->format("H\hi"). " - ". $m->get_ending()->format("H\hi")?></p></u></b>
                                   <b><p><?=ucfirst(ucfirst($user->get_name())). " ". strtoupper($user->get_surname()) ?></p></b>
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
                                                        <img
                                                                src="/assets/img/<?=$user->get_picture()?>"
                                                                alt=""
                                                                style="width: 90px; height: 90px; margin-bottom: 5%"
                                                                class="rounded-circle"
                                                        />
                                                        <span class="fbContainer"><p class="frontText"> Horaire:</p> <p class="backText"><?= $m->get_beginning()->format("H\hi"). " - ". $m->get_ending()->format("H\hi")?></p></span>
                                                        <span class="fbContainer"><p class="frontText"> Patient:</p> <p class="backText"><?=ucfirst($user->get_name()). " ". strtoupper($user->get_surname())?></p></span>
                                                        <span class="fbContainer"><p class="frontText"> Numéro de téléphone:</p> <p class="backText"><?= $user->get_phone()?></p></span>
                                                        <span class="fbContainer"><p class="frontText"> Adresse mail:</p> <p class="backText"><?= $user->get_mail()?></p></span>
                                                    </div>
                                                    <form id="<?= "Form".$i ?>" method="POST" action="/espacedoc/delete" style="display: none;">
                                                        <div class="d-none">
                                                            <input type="text" value="<?= $_POST["selectedWeek"] ?>" name="persistWeek">
                                                        </div>
                                                        <input value="<?= $m->get_medecin()->get_id()?>" name="idDoc">
                                                        <input value="<?= $m->get_beginning()->format("Y-m-d H:i:s")?>" name="tbeg">
                                                    </form>
                                                    <div class="modal-footer">
                                                        <button type="submit" form="<?= "Form".$i ?>" class="btn btn-danger" data-mdb-ripple-init>Supprimer l'horaire</button>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                            </td>
                        </tr>

                    <?php $i++;}
                    elseif($m->get_beginning()->format("d-m-Y") == $days[2]->format("d-m-Y")){?>
                             <tr>
                                        <td>
                                                           <button type="button" class="colorFree btn btn-primary" data-toggle="modal" data-target="#<?='subModal'.$i?>">
                                                <b><u><p><?= $m->get_beginning()->format("H\hi"). " - ". $m->get_ending()->format("H\hi")?></p></u></b>
                                                <b><p>Libre</p></b>
                                            </button

                                                    <!-- Modal -->
                                            <div class="modal fade" id="<?='subModal'.$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Informations complémentaires</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Aucun patient n'a réservé ce créneau</p>
                                                        </div>
                                                        <form id="<?= "Form".$i ?>" method="POST" action="/espacedoc/delete" style="display: none;">
                                                            <div class="d-none">
                                                                <input type="text" value="<?= $_POST["selectedWeek"] ?>" name="persistWeek">
                                                            </div>
                                                            <input value="<?= $m->get_medecin()->get_id()?>" name="idDoc">
                                                            <input value="<?= $m->get_beginning()->format("Y-m-d H:i:s")?>" name="tbeg">
                                                        </form>
                                                        <div class="modal-footer">
                                                            <button type="submit" form="<?= "Form".$i ?>" class="btn btn-danger" data-mdb-ripple-init>Supprimer l'horaire</button>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                    <?php $i++;}
                }?>
                </tbody>
            </table>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col"><?="Jeudi". " ". $days[3]->format("d/m")?></th>
                </tr>
                </thead>
                <tbody class="table-group-divider table-divider-color">
                <?php

                foreach($meetings as $m){
                    if($m->get_beginning()->format("d-m-Y") == $days[3]->format("d-m-Y") && $m->get_user() != null) {
                        $user = $m->get_user();
                        ?>
                        <tr>
                            <td>
                                <!-- Button trigger modal -->
                                        <button type="button" class="colorPatient btn btn-primary" data-toggle="modal" data-target="#<?='Modal'.$i?>">
                                    <b><u><p><?= $m->get_beginning()->format("H\hi"). " - ". $m->get_ending()->format("H\hi")?></p></u></b>
                                   <b><p><?=ucfirst(ucfirst($user->get_name())). " ". strtoupper($user->get_surname()) ?></p></b>
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
                                                        <img
                                                                src="/assets/img/<?=$user->get_picture()?>"
                                                                alt=""
                                                                style="width: 90px; height: 90px; margin-bottom: 5%"
                                                                class="rounded-circle"
                                                        />
                                                        <span class="fbContainer"><p class="frontText"> Horaire:</p> <p class="backText"><?= $m->get_beginning()->format("H\hi"). " - ". $m->get_ending()->format("H\hi")?></p></span>
                                                        <span class="fbContainer"><p class="frontText"> Patient:</p> <p class="backText"><?=ucfirst($user->get_name()). " ". strtoupper($user->get_surname())?></p></span>
                                                        <span class="fbContainer"><p class="frontText"> Numéro de téléphone:</p> <p class="backText"><?= $user->get_phone()?></p></span>
                                                        <span class="fbContainer"><p class="frontText"> Adresse mail:</p> <p class="backText"><?= $user->get_mail()?></p></span>
                                                    </div>
                                                    <form id="<?= "Form".$i ?>" method="POST" action="/espacedoc/delete" style="display: none;">
                                                        <div class="d-none">
                                                            <input type="text" value="<?= $_POST["selectedWeek"] ?>" name="persistWeek">
                                                        </div>
                                                        <input value="<?= $m->get_medecin()->get_id()?>" name="idDoc">
                                                        <input value="<?= $m->get_beginning()->format("Y-m-d H:i:s")?>" name="tbeg">
                                                    </form>
                                                    <div class="modal-footer">
                                                        <button type="submit" form="<?= "Form".$i ?>" class="btn btn-danger" data-mdb-ripple-init>Supprimer l'horaire</button>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                            </td>
                        </tr>
                    <?php $i++;}
                    elseif($m->get_beginning()->format("d-m-Y") == $days[3]->format("d-m-Y")){?>
                             <tr>
                                        <td>
                                                           <button type="button" class="colorFree btn btn-primary" data-toggle="modal" data-target="#<?='subModal'.$i?>">
                                                <b><u><p><?= $m->get_beginning()->format("H\hi"). " - ". $m->get_ending()->format("H\hi")?></p></u></b>
                                                <b><p>Libre</p></b>
                                            </button

                                                    <!-- Modal -->
                                            <div class="modal fade" id="<?='subModal'.$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Informations complémentaires</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Aucun patient n'a réservé ce créneau</p>
                                                        </div>
                                                        <form id="<?= "Form".$i ?>" method="POST" action="/espacedoc/delete" style="display: none;">
                                                            <div class="d-none">
                                                                <input type="text" value="<?= $_POST["selectedWeek"] ?>" name="persistWeek">
                                                            </div>
                                                            <input value="<?= $m->get_medecin()->get_id()?>" name="idDoc">
                                                            <input value="<?= $m->get_beginning()->format("Y-m-d H:i:s")?>" name="tbeg">
                                                        </form>
                                                        <div class="modal-footer">
                                                            <button type="submit" form="<?= "Form".$i ?>" class="btn btn-danger" data-mdb-ripple-init>Supprimer l'horaire</button>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                    <?php $i++;}
                }?>
                </tbody>
            </table>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col"><?="Vendredi". " ". $days[4]->format("d/m")?></th>
                </tr>
                </thead>
                <tbody class="table-group-divider table-divider-color">
                <?php

                foreach($meetings as $m){
                    if($m->get_beginning()->format("d-m-Y") == $days[4]->format("d-m-Y") && $m->get_user() != null) {
                        $user = $m->get_user();
                        ?>
                        <tr>
                            <td>
                                <!-- Button trigger modal -->
                                        <button type="button" class="colorPatient btn btn-primary" data-toggle="modal" data-target="#<?='Modal'.$i?>">
                                    <b><u><p><?= $m->get_beginning()->format("H\hi"). " - ". $m->get_ending()->format("H\hi")?></p></u></b>
                                   <b><p><?=ucfirst(ucfirst($user->get_name())). " ". strtoupper($user->get_surname()) ?></p></b>
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
                                                        <img
                                                                src="/assets/img/<?=$user->get_picture()?>"
                                                                alt=""
                                                                style="width: 90px; height: 90px; margin-bottom: 5%"
                                                                class="rounded-circle"
                                                        />
                                                        <span class="fbContainer"><p class="frontText"> Horaire:</p> <p class="backText"><?= $m->get_beginning()->format("H\hi"). " - ". $m->get_ending()->format("H\hi")?></p></span>
                                                        <span class="fbContainer"><p class="frontText"> Patient:</p> <p class="backText"><?=ucfirst($user->get_name()). " ". strtoupper($user->get_surname())?></p></span>
                                                        <span class="fbContainer"><p class="frontText"> Numéro de téléphone:</p> <p class="backText"><?= $user->get_phone()?></p></span>
                                                        <span class="fbContainer"><p class="frontText"> Adresse mail:</p> <p class="backText"><?= $user->get_mail()?></p></span>
                                                    </div>
                                                    <form id="<?= "Form".$i ?>" method="POST" action="/espacedoc/delete" style="display: none;">
                                                        <div class="d-none">
                                                            <input type="text" value="<?= $_POST["selectedWeek"] ?>" name="persistWeek">
                                                        </div>
                                                        <input value="<?= $m->get_medecin()->get_id()?>" name="idDoc">
                                                        <input value="<?= $m->get_beginning()->format("Y-m-d H:i:s")?>" name="tbeg">
                                                    </form>
                                                    <div class="modal-footer">
                                                        <button type="submit" form="<?= "Form".$i ?>" class="btn btn-danger" data-mdb-ripple-init>Supprimer l'horaire</button>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                            </td>
                        </tr>
                    <?php $i++;}
                    elseif($m->get_beginning()->format("d-m-Y") == $days[4]->format("d-m-Y")){?>
                             <tr>
                                        <td>
                                                           <button type="button" class="colorFree btn btn-primary" data-toggle="modal" data-target="#<?='subModal'.$i?>">
                                                <b><u><p><?= $m->get_beginning()->format("H\hi"). " - ". $m->get_ending()->format("H\hi")?></p></u></b>
                                                <b><p>Libre</p></b>
                                            </button

                                                    <!-- Modal -->
                                            <div class="modal fade" id="<?='subModal'.$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Informations complémentaires</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Aucun patient n'a réservé ce créneau</p>
                                                        </div>
                                                        <form id="<?= "Form".$i ?>" method="POST" action="/espacedoc/delete" style="display: none;">
                                                            <div class="d-none">
                                                                <input type="text" value="<?= $_POST["selectedWeek"] ?>" name="persistWeek">
                                                            </div>
                                                            <input value="<?= $m->get_medecin()->get_id()?>" name="idDoc">
                                                            <input value="<?= $m->get_beginning()->format("Y-m-d H:i:s")?>" name="tbeg">
                                                        </form>
                                                        <div class="modal-footer">
                                                            <button type="submit" form="<?= "Form".$i ?>" class="btn btn-danger" data-mdb-ripple-init>Supprimer l'horaire</button>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                    <?php $i++;}
                }?>
                </tbody>
            </table>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col"><?="Samedi". " ". $days[5]->format("d/m")?></th>
                </tr>
                </thead>
                <tbody class="table-group-divider table-divider-color">
                <?php

                foreach($meetings as $m){
                    if($m->get_beginning()->format("d-m-Y") == $days[5]->format("d-m-Y") && $m->get_user() != null) {
                        $user = $m->get_user();
                        ?>
                        <tr>
                            <td>
                                <!-- Button trigger modal -->
                                        <button type="button" class="colorPatient btn btn-primary" data-toggle="modal" data-target="#<?='Modal'.$i?>">
                                    <b><u><p><?= $m->get_beginning()->format("H\hi"). " - ". $m->get_ending()->format("H\hi")?></p></u></b>
                                   <b><p><?=ucfirst(ucfirst($user->get_name())). " ". strtoupper($user->get_surname()) ?></p></b>
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
                                                        <img
                                                                src="/assets/img/<?=$user->get_picture()?>"
                                                                alt=""
                                                                style="width: 90px; height: 90px; margin-bottom: 5%"
                                                                class="rounded-circle"
                                                        />
                                                        <span class="fbContainer"><p class="frontText"> Horaire:</p> <p class="backText"><?= $m->get_beginning()->format("H\hi"). " - ". $m->get_ending()->format("H\hi")?></p></span>
                                                        <span class="fbContainer"><p class="frontText"> Patient:</p> <p class="backText"><?=ucfirst($user->get_name()). " ". strtoupper($user->get_surname())?></p></span>
                                                        <span class="fbContainer"><p class="frontText"> Numéro de téléphone:</p> <p class="backText"><?= $user->get_phone()?></p></span>
                                                        <span class="fbContainer"><p class="frontText"> Adresse mail:</p> <p class="backText"><?= $user->get_mail()?></p></span>
                                                    </div>
                                                    <form id="<?= "Form".$i ?>" method="POST" action="/espacedoc/delete" style="display: none;">
                                                        <div class="d-none">
                                                            <input type="text" value="<?= $_POST["selectedWeek"] ?>" name="persistWeek">
                                                        </div>
                                                        <input value="<?= $m->get_medecin()->get_id()?>" name="idDoc">
                                                        <input value="<?= $m->get_beginning()->format("Y-m-d H:i:s")?>" name="tbeg">
                                                    </form>
                                                    <div class="modal-footer">
                                                        <button type="submit" form="<?= "Form".$i ?>" class="btn btn-danger" data-mdb-ripple-init>Supprimer l'horaire</button>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                            </td>
                        </tr>

                    <?php $i++;}
                    elseif($m->get_beginning()->format("d-m-Y") == $days[5]->format("d-m-Y")){?>
                             <tr>
                                        <td>
                                                           <button type="button" class="colorFree btn btn-primary" data-toggle="modal" data-target="#<?='subModal'.$i?>">
                                                <b><u><p><?= $m->get_beginning()->format("H\hi"). " - ". $m->get_ending()->format("H\hi")?></p></u></b>
                                                <b><p>Libre</p></b>
                                            </button

                                                    <!-- Modal -->
                                            <div class="modal fade" id="<?='subModal'.$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Informations complémentaires</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Aucun patient n'a réservé ce créneau</p>
                                                        </div>
                                                        <form id="<?= "Form".$i ?>" method="POST" action="/espacedoc/delete" style="display: none;">
                                                            <div class="d-none">
                                                                <input type="text" value="<?= $_POST["selectedWeek"] ?>" name="persistWeek">
                                                            </div>
                                                            <input value="<?= $m->get_medecin()->get_id()?>" name="idDoc">
                                                            <input value="<?= $m->get_beginning()->format("Y-m-d H:i:s")?>" name="tbeg">
                                                        </form>
                                                        <div class="modal-footer">
                                                            <button type="submit" form="<?= "Form".$i ?>" class="btn btn-danger" data-mdb-ripple-init>Supprimer l'horaire</button>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                    <?php $i++;}
                }?>
                </tbody>
            </table>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col"><?="Dimanche". " ". $days[6]->format("d/m")?></th>
                </tr>
                </thead>
                <tbody class="table-group-divider table-divider-color">
                <?php

                foreach($meetings as $m){
                    if($m->get_beginning()->format("d-m-Y") == $days[6]->format("d-m-Y") && $m->get_user() != null) {
                        $user = $m->get_user();
                        ?>
                        <tr>
                            <td>
                                <!-- Button trigger modal -->
                                        <button type="button" class="colorPatient btn btn-primary" data-toggle="modal" data-target="#<?='Modal'.$i?>">
                                    <b><u><p><?= $m->get_beginning()->format("H\hi"). " - ". $m->get_ending()->format("H\hi")?></p></u></b>
                                   <b><p><?=ucfirst(ucfirst($user->get_name())). " ". strtoupper($user->get_surname()) ?></p></b>
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
                                                        <img
                                                                src="/assets/img/<?=$user->get_picture()?>"
                                                                alt=""
                                                                style="width: 90px; height: 90px; margin-bottom: 5%"
                                                                class="rounded-circle"
                                                        />
                                                        <span class="fbContainer"><p class="frontText"> Horaire:</p> <p class="backText"><?= $m->get_beginning()->format("H\hi"). " - ". $m->get_ending()->format("H\hi")?></p></span>
                                                        <span class="fbContainer"><p class="frontText"> Patient:</p> <p class="backText"><?=ucfirst($user->get_name()). " ". strtoupper($user->get_surname())?></p></span>
                                                        <span class="fbContainer"><p class="frontText"> Numéro de téléphone:</p> <p class="backText"><?= $user->get_phone()?></p></span>
                                                        <span class="fbContainer"><p class="frontText"> Adresse mail:</p> <p class="backText"><?= $user->get_mail()?></p></span>
                                                    </div>
                                                    <form id="<?= "Form".$i ?>" method="POST" action="/espacedoc/delete" style="display: none;">
                                                        <div class="d-none">
                                                            <input type="text" value="<?= $_POST["selectedWeek"] ?>" name="persistWeek">
                                                        </div>
                                                        <input value="<?= $m->get_medecin()->get_id()?>" name="idDoc">
                                                        <input value="<?= $m->get_beginning()->format("Y-m-d H:i:s")?>" name="tbeg">
                                                    </form>
                                                    <div class="modal-footer">
                                                        <button type="submit" form="<?= "Form".$i ?>" class="btn btn-danger" data-mdb-ripple-init>Supprimer l'horaire</button>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                            </td>
                        </tr>

                    <?php $i++;}
                    elseif($m->get_beginning()->format("d-m-Y") == $days[6]->format("d-m-Y")){?>
                             <tr>
                                        <td>
                                                           <button type="button" class="colorFree btn btn-primary" data-toggle="modal" data-target="#<?='subModal'.$i?>">
                                                <b><u><p><?= $m->get_beginning()->format("H\hi"). " - ". $m->get_ending()->format("H\hi")?></p></u></b>
                                                <b><p>Libre</p></b>
                                            </button

                                                    <!-- Modal -->
                                            <div class="modal fade" id="<?='subModal'.$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Informations complémentaires</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Aucun patient n'a réservé ce créneau</p>
                                                        </div>
                                                        <form id="<?= "Form".$i ?>" method="POST" action="/espacedoc/delete" style="display: none;">
                                                            <div class="d-none">
                                                                <input type="text" value="<?= $_POST["selectedWeek"] ?>" name="persistWeek">
                                                            </div>
                                                            <input value="<?= $m->get_medecin()->get_id()?>" name="idDoc">
                                                            <input value="<?= $m->get_beginning()->format("Y-m-d H:i:s")?>" name="tbeg">
                                                        </form>
                                                        <div class="modal-footer">
                                                            <button type="submit" form="<?= "Form".$i ?>" class="btn btn-danger" data-mdb-ripple-init>Supprimer l'horaire</button>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                    <?php $i++;}
                }?>
                </tbody>
            </table>


        </div>

        <h3>Saisir vos disponibilités</h3>
        <hr>
        <br>


            <?php
            if(isset($_POST["selectedWeek"])){
                if($_POST["selectedWeek"] != -1){
                foreach($weekArray[$_POST["selectedWeek"]]->getDays() as $d) {?>
                        <form action="/espacedoc/result" method="POST">
                            <div id="subcontainer">
                                <div class="d-none">
                                    <input type="text" value="<?= $_POST["selectedWeek"] ?>" name="persistWeek">
                                </div>

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
