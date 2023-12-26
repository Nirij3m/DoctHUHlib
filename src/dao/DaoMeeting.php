<?php
require_once "src/metier/User.php";
require_once "src/metier/Time.php";
class DaoMeeting {
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
    public function insertMeeting($beg, $end, User $user){
        $beginning = $beg->format("Y-m-d H:i");
        $ending = $end->format("Y-m-d H:i");
        $idPlace = $user->get_id_place();
        $idUser = $user->get_id();
        $statement = $this->db->prepare('INSERT INTO meeting(beginning, ending, id_place, id_user) VALUES (:beg, :end, :id_place, :id_user)');
        $statement->bindParam(":beg", $beginning);
        $statement->bindParam(":end", $ending);
        $statement->bindParam(":id_place", $idPlace);
        $statement->bindParam(":id_user", $idUser);
        $statement->execute();
    }
}
