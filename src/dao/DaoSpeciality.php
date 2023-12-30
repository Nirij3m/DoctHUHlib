<?php
class DaoSpeciality {
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

    public function getSpecialities() {
        $statement = $this->db->query("SELECT * FROM speciality");
        $array = $statement->fetchAll(PDO::FETCH_ASSOC);
        $return = [];

        foreach ($array as $elem) {
            $speciality = new Speciality($elem['id'], $elem['type']);
            array_push($return, $speciality);
        }

        return $return;
    }

    public function getSpeciality(){
        $statement = $this->db->query("SELECT type from speciality");
        $array = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $array;
    }

    public function getSpecialityOfUser(User $user) {
        $uId = $user->get_id();
        $statement = $this->db->prepare("SELECT speciality.id, speciality.type FROM speciality
        INNER JOIN users ON users.id_speciality = speciality.id
        WHERE users.id = :id");
        $statement->bindParam(":id", $uId);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        if(empty($result)){ //User is not a doctor
            return null;
        }
        $speciality = new Speciality($result['id'], $result['type']);
        return $speciality;
    }
}


?>