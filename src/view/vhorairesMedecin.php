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
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Début</th>
                    <th scope="col">Fin</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($medecin->get_meetings() as $meeting) {?>
                    <tr>
                        <td><?=$meeting->get_beginning()->format('d/m/Y H:i:s')?></td>
                        <td><?=$meeting->get_ending()->format('d/m/Y H:i:s')?></td>
                        <td>
                            <?php if ($meeting->get_user() == null) { ?>
                                <form method="POST" action="/rendezvous/medecin/result">
                                    <input type="text" name="idTimeslot" value="<?=$meeting->get_id()?>" hidden>
                                    <button type="submit" class="btn btn-primary">Réserver</button>
                                </form>
                                <?php }
                                else { ?>
                                    <button class="btn btn-danger">Occupé</button>
                                <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>