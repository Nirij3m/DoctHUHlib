<?php
require_once "src/metier/User.php";
class DaoPlace {
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

    public function getPlaceById(int $id) {
        $statement = $this->db->prepare("SELECT * FROM place WHERE id = :id");
        $statement->bindParam(":id", $id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        $place = new Place($result['id'], $result['name'], $result['num_street'], $result['street'], $result['code_insee'], null);

        return $place;
    }

    public function getPlaceOfUser(User $user) {
        $uId = $user->get_id();
        $statement = $this->db->prepare("SELECT place.id, name, num_street, street, code_insee FROM place
        INNER JOIN works ON works.id = place.id
        WHERE works.id_user = :id");
        $statement->bindParam(":id", $uId);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if ($result != null){
            $place = new Place($result['id'], $result['name'], $result['num_street'], $result['street'], $result['code_insee'], null);
        }
        else {
            $place = null;
        }
        return $place;
    }
}