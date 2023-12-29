<?php
require_once "src/dao/DaoUser.php";
require_once "src/dao/DaoCity.php";
require_once "src/metier/User.php";
const PATH_VIEW = "src/view/";

const PATH_CSS = "src/css/";
const DBHOST = "localhost";
const DBNAME = "themightypoo";
const PORT = 5433;
const USER = "postgres";
const PASS = "Isen44N";


class Utils {

    public function hash_password(string $password) {
        password_hash($password, PASSWORD_BCRYPT);
    }
    public function pdoErrors($err, $needle){
        $string = "";
        switch ($err){
            case 23505:
                $string = $needle." existe déjà.";
                break;
        }
        return $string;
    }
    public function echoSuccess($needle){
        echo '
            <div class="errorWrapper">
                  <div class="alert alert-success alert-dismissible d-flex align-items-center fade show">
                        <i class="bi-check-circle-fill"></i>
                        <strong class="mx-2">Succès!</strong>'. $needle. '
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        ';
    }
    public function echoError($needle){
        echo '
                <div class="errorWrapper">
                    <div class="alert alert-danger alert-dismissible d-flex align-items-center fade show">
                        <i class="bi-exclamation-octagon-fill"></i>
                        <strong class="mx-2">Erreur!</strong>'. $needle . '
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>  
                </div>
        ';
    }
    public function echoWarning($needle){
        echo '
             <div class="errorWrapper">
                <div class="alert alert-warning alert-dismissible d-flex align-items-center fade show">
                    <i class="bi-exclamation-triangle-fill"></i>
                    <strong class="mx-2">Attention!</strong>' . $needle . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
             </div>
        ';
    }

    public function echoInfo($needle){
        echo '
             <div class="errorWrapper">
                <div class="alert alert-info alert-dismissible d-flex align-items-center fade show">
                    <i class="bi-info-circle-fill"></i>
                    <strong class="mx-2">Info!</strong>' . $needle . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        ';
    }

    public function clearAlert(){
        echo '
            <script>
            document.addEventListener("DOMContentLoaded", function(){
                var btn = document.getElementById("myBtn");
                var element = document.getElementById("myAlert");
            
                // Create alert instance
                var myAlert = new bootstrap.Alert(element);
                
                btn.addEventListener("click", function(){
                    myAlert.close();
                });
                //setTimeout(() => {echo "Jeanne";}, 5000);
                
            });
        </script>
        ';
    }
    public function str_replace_first($search, $replace, $subject)
    {
        $search = '/'.preg_quote($search, '/').'/';
        return preg_replace($search, $replace, $subject, 1);
    }

    public function isSanitize($string){
        $string = $this->str_replace_first(" ", "-", $string);
        $string = preg_replace('/\s+/', '', $string);
        $string = stripslashes($string);
        if($string == filter_var($string, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK)){
            return true;
        }
        else return false;
    }

    public function constructSession($id){
        $DaoUser = new DaoUser(DBHOST, DBNAME, PORT, USER, PASS);
        $DaoCity = new DaoCity(DBHOST, DBNAME, PORT, USER, PASS);
        $DaoPlace = new DaoPlace(DBHOST, DBNAME, PORT, USER, PASS);
        $DaoSpeciality = new DaoSpeciality(DBHOST, DBNAME, PORT, USER, PASS);
        $tempUser = $DaoUser->getFullById($id); // returns a temporary user

        $city = $DaoCity->getCityOfUser($tempUser);
        $place = $DaoPlace->getPlaceOfUser($tempUser);
        $speciality = $DaoSpeciality->getSpecialityOfUser($tempUser);
        $place->set_city($city);
        $tempUser->set_place($place);
        $tempUser->set_speciality($speciality);

        if(!isset($_SESSION["user"])){
            $_SESSION["user"] = $tempUser;
        }
    }

    public function destructSession(){
        while(isset($_SESSION)){
            session_destroy();
        }
        require PATH_VIEW . "vaccueil.php";
    }

}


