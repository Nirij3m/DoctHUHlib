<?php
class DaoWork {
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

    public function getWorkPlaceOfUser(User $user) {
        $uId = $user->get_id();
        $statement = $this->db->prepare("SELECT * FROM works WHERE id_user = :id");
        $statement->bindParam(":id", $uId);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result['id'];
    }
    public function insertWork(int $idPlace, int $idUser){
        $statement = $this->db->prepare('INSERT INTO works (id, id_user) VALUES (:id_place, :id_user)');
        $statement->bindParam(":id_place", $idPlace);
        $statement->bindParam(":id_user", $idUser);
        $statement->execute();
    }
}