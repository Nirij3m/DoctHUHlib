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

    public function getSpeciality(){
        $statement = $this->db->query("SELECT type from speciality");
        $array = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $array;
    }
}


?>