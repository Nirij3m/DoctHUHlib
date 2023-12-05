<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>  </title>
        <script src="script.js" defer></script>
        <link href="style.css" rel="stylesheet"> 
    </head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <body>
        <section class="vh-100" style="background-color: #9A616D;">
            <div class="container py-5 h-100">
              <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                  <div class="card" style="border-radius: 1rem;">
                    <div class="row g-0">
                      <div class="col-md-6 col-lg-5 d-none d-md-block">
                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/img1.webp"
                          alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                      </div>
                      <div class="col-md-6 col-lg-7 d-flex align-items-center">
                        <div class="card-body p-4 p-lg-5 text-black">
          
                          <form action="/login/result" method="POST">
          
                            <div class="d-flex align-items-center mb-3 pb-1">
                              <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                              <span class="h1 fw-bold mb-0">Doctisen</span>
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

                            <p class="mb-5 pb-lg-2" style="color: #393f81;">Pas encore membre ? <a href="/login/result" style="color: #393f81;">Créez-vous un compte</a></p>
                          </form>
          
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>

          
        <section class="vh-100" style="background-color: #9A616D;">
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
                              <span class="h1 fw-bold mb-0">Doctisen</span>
                            </div>
          
                            <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Créez-votre compte en moins de 5 minutes</h5>
          
                            <div class="form-outline mb-4">
                              <input type="text" id="form2Example17" name="name" class="form-control form-control-lg" />
                              <label class="form-label" for="form2Example17">Nom</label>
                            </div>
                            
                            <div class="form-outline mb-4">
                              <input type="text" id="form2Example17" name="surname" class="form-control form-control-lg" />
                              <label class="form-label" for="form2Example17">Prénom</label>
                            </div>
                            
                            <div class="form-outline mb-4">
                              <input type="tel" id="form2Example17" name="phone" class="form-control form-control-lg" />
                              <label class="form-label" for="form2Example17">Téléphone</label>
                            </div>
                            
                            <div class="form-outline mb-4">
                              <input type="email" id="form2Example17" name="mail" class="form-control form-control-lg" />
                              <label class="form-label" for="form2Example17">Mail</label>
                            </div>
                            
                            <div class="form-outline mb-4">
                              <input type="email" id="form2Example17" name="mailVerify" class="form-control form-control-lg" />
                              <label class="form-label" for="form2Example17">Mail (vérification)</label>
                            </div>
                            
                            <div class="form-outline mb-4">
                              <input type="password" id="form2Example17" name="password" class="form-control form-control-lg" />
                              <label class="form-label" for="form2Example17">Mot de passe</label>
                            </div>
          
                            <div class="form-outline mb-4">
                              <input type="password" id="form2Example27" name="passwordVerify" class="form-control form-control-lg" />
                              <label class="form-label" for="form2Example27">Mot de passe (vérification)</label>
                            </div>
          
                            <div class="pt-1 mb-4">
                              <button class="btn btn-dark btn-lg btn-block" type="submit">Créer un compte</button>
                            </div>
                          </form>
          
                        </div>
                      </div>
                      
                      <div class="col-md-6 col-lg-5 d-none d-md-block">
                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/img1.webp"
                          alt="login form" class="img-fluid" style="border-radius: 0 1rem 1rem 0;" />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>

          <?php require_once "alerts.php"; ?>
    </body>
</html>