<?php require_once "header.php"; ?>
<link rel="stylesheet" href="/src/css/medecin.css">
<div class="corpse"> <!-- Content area-->
    <div id="topHeader">
        <p id="namePage" class="fs-5 d-none d-sm-inline title">Espace practicien</p>
    </div>
    <div id="container">

        <h3>Votre planning</h3>
        <hr>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Handle</th>
            </tr>
            </thead>
            <tbody class="table-group-divider table-divider-color">
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td colspan="2">Larry the Bird</td>
                <td>@twitter</td>
            </tr>
            </tbody>
        </table>

        <h3>Saisir vos disponibilités</h3>
        <hr>
        <form action="/espacedoc" method="POST">
            <select id="selectWeek" class="form-select" aria-label="Default select example" style="width: 25%;" name="selectedWeek">
                <option selected value="-1">Choisir une semaine...</option>
                <?php
                    $i = 0;
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
