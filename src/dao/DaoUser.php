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
}