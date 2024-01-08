<?php
require_once "src/metier/User.php";
require_once "src/metier/Place.php";
require_once "src/metier/Speciality.php";

require_once "src/dao/DaoPlace.php";
require_once "src/dao/DaoCity.php";
require_once "src/dao/DaoWork.php";
require_once "src/dao/DaoSpeciality.php";

class DaoUser {
    private string $host;
    private string $dbname;
    private string $user;
    private string $pass;
    private PDO $db;

    public function __construct(string $host, string $dbname, int $port, string $user, string $pass) {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->user = $user;
        $this->pass = $pass;

        try {
            $this->db = new PDO("pgsql:dbname=" . $dbname . ";host=" . $host . ";port=" . $port, $user, $pass);
        } catch (PDOException $e) {
            $erreurs = [];
	        echo $e->getMessage();
        }
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }

    public function selectAll() {
        $statement = $this->db->query("SELECT * FROM users");
        $array = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $array;
    }
    public function connectUser(string $mail, string $password) {
        $id = NULL;

        $statement = $this->db->prepare("SELECT id, password FROM users WHERE mail = :mail");
        $statement->bindParam(":mail", $mail);
        $statement->execute();
        $user = $statement->fetch();

        if ($user != false) {
            if (password_verify($password, $user['password'])) $id = $user['id'];
        }
        return $id;
    }

    public function registerUser(string $name, string $surname, string $phone, string $mail, string $password) {
        $utils = new Utils();

        $name = strtolower($name);
        $surname = strtolower($surname);
        $phone = str_replace(' ', '', $phone);
        $tempPicture = "unknown.png";


        $statement = $this->db->prepare("INSERT INTO users (name, surname, phone, mail, password, picture) VALUES (:name, :surname, :phone, :mail, :password, :picture)");
        $statement->bindParam(":name", $name);
        $statement->bindParam(":surname", $surname);
        $statement->bindParam(":phone", $phone);
        $statement->bindParam(":mail", $mail);
        $statement->bindParam(":password", $password);
        $statement->bindParam(":picture", $tempPicture);
        try{
            $statement->execute();
        }
        catch (PDOException $err){
            $errMessage = $err->getMessage();
            if(strpos($errMessage, "phone") !== false){
                $needle = "Ce numéro de téléphone";
            }
            else $needle = "Cette adresse email";
            return $errString = $utils->pdoErrors($err->getCode(), $needle);
        }
    }
    public function registerDoc(string $name, string $surname, string $phone, string $mail, string $password,
        int $numStreet, string $street, int $codeInsee, string $namePlace, string $specialite){

        $name = strtolower($name);
        $surname = strtolower($surname);

        $DaoPlace = new DaoPlace(DBHOST, DBNAME, PORT, USER, PASS);
        $DaoWorks = new DaoWork(DBHOST, DBNAME, PORT, USER, PASS);
        $utils = new Utils();
        $name = strtolower($name);
        $surname = strtolower($surname);
        $phone = str_replace(' ', '', $phone);

        //Retrive the spe ID
        $statementSpeId = $this->db->prepare('SELECT id from speciality WHERE type = :type');
        $statementSpeId->bindParam(":type", $specialite);
        try{
            $statementSpeId->execute();
        }
        catch (PDOException $e){
            $utils->echoError("Cette spécialité n'existe pas");
            return "";
        }
        $resultSpeId = $statementSpeId->fetch(PDO::FETCH_ASSOC);
        $speId = $resultSpeId["id"];


        //Insert the user and retrive the user's id
        $tempPicture = "unknown.png";
        $statementUser = $this->db->prepare("INSERT INTO users (name, surname, phone, mail, password, id_speciality, picture) VALUES (:name, :surname, :phone, :mail, :password, :id_speciality, :picture) RETURNING id");
        $statementUser->bindParam(":name", $name);
        $statementUser->bindParam(":surname", $surname);
        $statementUser->bindParam(":phone", $phone);
        $statementUser->bindParam(":mail", $mail);
        $statementUser->bindParam(":password", $password);
        $statementUser->bindParam(":id_speciality", $speId);
        $statementUser->bindParam(":picture", $tempPicture);
        try{
            $statementUser->execute();
        }
        catch (PDOException $err){
            $errMessage = $err->getMessage();
            if(strpos($errMessage, "phone") !== false){
                $needle = "Ce numéro de téléphone";
            }
            else $needle = "Cette adresse email";
            return $errString = $utils->pdoErrors($err->getCode(), $needle);
        }
        $resultUserId = $statementUser->fetch(PDO::FETCH_ASSOC);
        $idUser = $resultUserId["id"];

        //Insert the place via the code_insee
        $idPlace = $DaoPlace->insertPlace($namePlace, $numStreet, $street, $codeInsee);

        //Insert the place and user in the works table
        $DaoWorks->insertWork($idPlace, $idUser);
        return "";

    }

    public function getEditUser(User $user, $email = null, $phone = null, $pfp = null, $oldPass = null, $newPass = null) {
        $idUser = $user->get_id();
        $statement = $this->db->prepare("SELECT password FROM users WHERE id = :id");
        $statement->bindParam(":id", $idUser);
        $statement->execute();
        $pass = $statement->fetch(PDO::FETCH_ASSOC)['password'];

        if (!password_verify($oldPass, $pass)) {
            return null;
        }
        else {
            if ($phone == null)     $phone = $user->get_phone();
            if ($newPass == null)   $newPass = $oldPass;
            if ($pfp == null)       $pfp = $user->get_picture();

            $newPass = password_hash($newPass, PASSWORD_BCRYPT);

            $statement = $this->db->prepare("UPDATE users SET mail = :email, phone = :phone, password = :password, picture = :picture WHERE id = :id");
            $statement->bindParam(":email", $email);
            $statement->bindParam(":phone", $phone);
            $statement->bindParam(":password", $newPass);
            $statement->bindParam(":picture", $pfp);
            $statement->bindParam(":id", $idUser);
            $statement->execute();

            return true;
        }
    }

    public function getByUserSpe(string $surname, string $name, string $spe) {
        $daoPlace = new DaoPlace(DBHOST, DBNAME, PORT, USER, PASS);
        $daoCity = new DaoCity(DBHOST, DBNAME, PORT, USER, PASS);
        $daoSpeciality = new DaoSpeciality(DBHOST, DBNAME, PORT, USER, PASS);

        $surname = strtolower($surname);
        $name = strtolower($surname);
        $statement = $this->db->prepare('SELECT u.id, u.name, u.surname, u.phone, u.mail, u.picture, s.type, p.num_street, p.street, c.code_postal, c.city FROM users u
        JOIN works w ON u.id = w.id_user
        JOIN speciality s ON u.id_speciality = s.id
        JOIN place p ON w.id = p.id
        JOIN city c ON p.code_insee = c.code_insee
        WHERE s.type = :type OR u.name = :name OR u.surname = :surname');
        $statement->bindParam(":type", $spe);
        $statement->bindParam(':name', $name);
        $statement->bindParam(":surname", $surname);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        $arr = [];
        foreach ($result as $obj) {
            $user = new User($obj['id'], $obj['name'], $obj['surname'], $obj['phone'], $obj['mail'], $obj['picture'], null, null);
            $city = $daoCity->getCityOfUser($user);
            $place = $daoPlace->getPlaceOfUser($user);
            $place->set_city($city);
            $speciality = $daoSpeciality->getSpecialityOfUser($user);
            if ($place != null)         $user->set_place($place);
            if ($speciality != null)    $user->set_speciality($speciality);
            array_push($arr, $user);
        }
        return $arr;
    }
    public function getFullById($id){
        $daoPlace = new DaoPlace(DBHOST, DBNAME, PORT, USER, PASS);
        $daoCity = new DaoCity(DBHOST, DBNAME, PORT, USER, PASS);
        $daoSpeciality = new DaoSpeciality(DBHOST, DBNAME, PORT, USER, PASS);

        $statement = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $statement->bindParam(":id", $id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        $user = new User($result['id'], $result['name'], $result['surname'], $result['phone'], $result['mail'], $result['picture'], null, null, []);
        
        $place = $daoPlace->getPlaceOfUser($user);
        if ($place != null) {
            $place->set_city($daoCity->getCityOfPlace($place));
            $user->set_place($place);
        }
        $speciality = $daoSpeciality->getSpecialityOfUser($user);
        if ($speciality != null) $user->set_speciality($speciality);

        return $user;
    }

    public function getPlanningMedecin(User $user) {
        
    }
}