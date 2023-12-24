<?php
require_once "src/metier/Place.php";
require_once "src/metier/Speciality.php";
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

        $statement = $this->db->prepare("INSERT INTO users (name, surname, phone, mail, password) VALUES (:name, :surname, :phone, :mail, :password)");
        $statement->bindParam(":name", $name);
        $statement->bindParam(":surname", $surname);
        $statement->bindParam(":phone", $phone);
        $statement->bindParam(":mail", $mail);
        $statement->bindParam(":password", $password);
        try{
            $statement->execute();
            return "";
        }
        catch (PDOException $err){
            $errMessage = $err->getMessage();
            if(str_contains($errMessage, "phone")){
                $needle = "Ce numéro de téléphone";
            }
            else $needle = "Cette adresse email";
            return $errString = $utils->pdoErrors($err->getCode(), $needle);
        }
    }
    public function getByUserSpe(string $surname, string $name, string $spe){
        $surname = strtolower($surname);
        $name = strtolower($surname);
        $statement = $this->db->prepare("SELECT u.name, u.surname, s.type ,u.mail, u.phone, p.num_street, p.street, c.code_postal, c.city from users u JOIN place p ON p.id = u.id JOIN city c ON c.code_insee = p.code_insee JOIN speciality s ON u.id_speciality = s.id
        WHERE s.type=:type OR u.name = :name OR u.surname = :surname");
        $statement->bindParam(":type", $spe);
        $statement->bindParam(':name', $name);
        $statement->bindParam(":surname", $surname);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getFullById($id){
        $statement = $this->db->prepare("SELECT u.name, u.surname, u.phone, u.mail, u.id_speciality, s.type, p.id as id_place ,p.name as name_p, p.num_street, p.street, c.city, c.code_postal  from users u
                                                LEFT JOIN speciality s ON u.id_speciality = s.id
                                                LEFT JOIN works w ON u.id = w.id_user
                                                LEFT JOIN place p ON w.id = p.id
                                                LEFT JOIN city c ON p.code_insee = c.code_insee WHERE u.id = :id"
        );
        $statement->bindParam(":id", $id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}