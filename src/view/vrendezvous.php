<?php require_once "header.php"?>
<link rel="stylesheet" href="../css/rendezvous.css">


<div class="corpse"> <!-- Content area-->
    <div id="topHeader">
        <p id="namePage" class="fs-5 d-none d-sm-inline title">Accueil</p>
    </div>
    <div id="container">

        <h3>Prendre un rendez-vous</h3>
        <hr>
        <div>
            <form id="alignement">
                <div class="form-group">
                    <span class="innerItem"> <i class="fa-solid fa-magnifying-glass"></i> <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Rechercher par nom"/></span>
                </div>
                <div class="form-group">
                    <span class="innerItem"> <i class="fa-solid fa-location-dot"></i> <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Rechercher par ville"/></span>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

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
                            <p class="fw-bold mb-1">John Doe</p>
                            <p class="text-muted mb-0">john.doe@gmail.com</p>
                        </div>
                    </div>
                </td>
                <td>
                    <p class="fw-normal mb-1">Software engineer</p>
                    <p class="text-muted mb-0">IT department</p>
                </td>
                <td>
                    07 69 96 60 69
                </td>
                <td>Nantes</td>
                <td>
                    <button type="button" class="btn btn-link btn-sm btn-rounded">
                        Edit
                    </button>
                </td>
            </tr>



            </tbody>
        </table>


    </div>



    </div>
</div>