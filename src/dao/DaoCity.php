<?php
class DaoCity {
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
    public function getAllCities(){
        $statement = $this->db->query("SELECT code_insee, city.city from city");
         return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCityOfUser(User $user) {
        $uId = $user->get_id();
        $statement = $this->db->prepare("SELECT city.code_insee, city, code_postal FROM city
            INNER JOIN place ON place.code_insee = city.code_insee
            INNER JOIN works ON works.id = place.id
            INNER JOIN users ON users.id = works.id_user
            WHERE users.id = :id");
        $statement->bindParam(":id", $uId);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        $city = new City($result['code_insee'], $result['city'], $result['code_postal']);

        return $city;
    }
}