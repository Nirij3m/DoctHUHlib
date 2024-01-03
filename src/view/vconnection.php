<?php require_once "src/view/header.php"?>
<link rel="stylesheet" href="/src/css/connection.css">
<div class="corpse"> <!-- Content area-->
    <div id="topHeader">
        <p id="namePage" class="fs-5 d-none d-sm-inline title">Se connecter</p>
    </div>
    <div id="containerLogin">
        <div class="vh-100" style="height: 100%;">
            <div class="container py-5 h-100">
              <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                  <div class="card" style="border-radius: 1rem;">
                    <div class="row g-0">
                      <div class="col-md-6 col-lg-5 d-none d-md-block">
                        <img src="https://source.unsplash.com/une-femme-en-chemise-blanche-tenant-un-stethoscope-tE7_jvK-_YU"
                          alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                      </div>
                      <div class="col-md-6 col-lg-7 d-flex align-items-center">
                        <div class="card-body p-4 p-lg-5 text-black">
          
                          <form action="/login/result" method="POST">
          
                            <div class="d-flex align-items-center mb-3 pb-1">
                              <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                              <span class="h1 fw-bold mb-0">Doct'HUH'lib</span>
                            </div>
          
                            <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Connectez-vous à votre compte</h5>
          
                            <div class="form-outline mb-4">
                              <input type="email" id="form2Example17" name="mail" class="form-control form-control-lg" />
                              <label class="form-label" for="form2Example17">Adresse mail</label>
                            </div>
          
                            <div class="form-outline mb-4">
                              <input type="password" id="form2Example27" name="password" class="form-control form-control-lg" />
                              <label class="form-label" for="form2Example27">Mot de passe</label>
                            </div>
          
                            <div class="pt-1 mb-4">
                              <button class="btn btn-dark btn-lg btn-block" type="submit">Connexion</button>
                            </div>
                              <span>
                                <p class="" style="color: #393f81; margin-bottom: 5%">Pas encore membre ? <a href="#seConnecter" style="color: #393f81;">Créez-vous un compte</a></p>
                                <p class="mb-5 pb-lg-2" style="color: #393f81;">Vous êtes praticien ? <a href="/espacedoc/creation" style="color: #393f81;">Créez-vous votre espace médical</a></p>
                              </span>

                          </form>
          
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <div class="vh-100" id="secondForm" style="height: 100%;">
            <div class="container py-5 h-100">
              <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                  <div class="card" style="border-radius: 1rem;">
                    <div class="row g-0">
                      <div class="col-md-6 col-lg-7 d-flex align-items-center">
                        <div class="card-body p-4 p-lg-5 text-black">
          
                          <form action="/register/result" method="POST">
          
                            <div class="d-flex align-items-center mb-3 pb-1">
                              <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                              <span id="seConnecter" class="h1 fw-bold mb-0">Doct'HUH'lib</span>
                            </div>
          
                            <h5  class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Créez-votre compte en moins de 5 minutes</h5>
          
                            <div class="form-outline mb-4">
                              <input value="<?php if(isset($name)){echo $name;} ?>" type="text" id="form2Example18" name="name" class="form-control form-control-lg" required/>
                              <label class="form-label" for="form2Example18">Nom</label>
                                <div class="invalid-feedback">
                                    Please choose a username.
                                </div>
                            </div>
                            
                            <div class="form-outline mb-4">
                              <input value="<?php if(isset($surname)){echo $surname;} ?>" type="text" id="form2Example17" name="surname" class="form-control form-control-lg" required/>
                              <label class="form-label" for="form2Example17">Prénom</label>
                                <div class="invalid-feedback">
                                    Please choose a username.
                                </div>
                            </div>
                            
                            <div class="form-outline mb-4">
                              <input value="<?php if(isset($phone)){echo $phone;} ?>" type="tel" id="form2Example17" name="phone" class="form-control form-control-lg"required/>
                              <label class="form-label" for="form2Example17">Téléphone</label>
                            </div>
                            
                            <div class="form-outline mb-4">
                              <input value="<?php if(isset($mail)){echo $mail;} ?>" type="email" id="form2Example17" name="mail" class="form-control form-control-lg" required/>
                              <label class="form-label" for="form2Example17">Adresse Mail</label>
                            </div>
                            
                            <div class="form-outline mb-4">
                              <input type="email" id="form2Example17" name="mailVerify" class="form-control form-control-lg" required/>
                              <label class="form-label" for="form2Example17">Adresse Mail (vérification)</label>
                            </div>
                            
                            <div class="form-outline mb-4">
                              <input type="password" id="form2Example17" name="password" class="form-control form-control-lg" required/>
                              <label class="form-label" for="form2Example17">Mot de passe</label>
                            </div>
          
                            <div class="form-outline mb-4">
                              <input type="password" id="form2Example27" name="passwordVerify" class="form-control form-control-lg" required/>
                              <label class="form-label" for="form2Example27">Mot de passe (vérification)</label>
                            </div>
          
                            <div class="pt-1 mb-4">
                              <button class="btn btn-dark btn-lg btn-block" type="submit">Créer un compte</button>
                            </div>
                          </form>
          
                        </div>
                      </div>
                      
                      <div class="col-md-6 col-lg-5 d-none d-md-block noimg">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
    </div>
</div>
</html>