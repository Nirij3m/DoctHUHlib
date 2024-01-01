<?php require_once "src/view/header.php"?>
<link rel="stylesheet" href="/src/css/connection.css">
<div class="corpse"> <!-- Content area-->
    <div id="topHeader">
        <p id="namePage" class="fs-5 d-none d-sm-inline title">Rendez-vous passés</p>
    </div>
    <div id="container">
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
                <?php foreach ($meetings as $meeting) { ?>
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
                            <?php if ($yesterday < $meeting->get_beginning()) { ?>
                                <form method="POST" action="/rendezvous/cancel">
                                    <input type="text" name="idMeeting" value="<?=$meeting->get_id()?>" hidden>
                                    <button type="submit" class="btn btn-danger">Annuler</button>
                                </form>
                                <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
</html>