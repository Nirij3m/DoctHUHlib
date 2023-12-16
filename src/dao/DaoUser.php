<?php
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
        $statement = $this->db->query("SELECT * FROM citation");
        $array = $statement->fetchAll(PDO::FETCH_ASSOC);
    
        return $array;
    }

    public function connectUser(string $mail, string $password) {
        $id = null;

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
        $statement = $this->db->prepare("INSERT INTO users (name, surname, phone, mail, password) VALUES (:name, :surname, :phone, :mail, :password)");
        $statement->bindParam(":name", $name);
        $statement->bindParam(":surname", $surname);
        $statement->bindParam(":phone", $phone);
        $statement->bindParam(":mail", $mail);
        $statement->bindParam(":password", $password);
        $statement->execute();
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
}