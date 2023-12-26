<?php
require_once "src/metier/Meeting.php";
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

    public function getMeetings(User $user) {
        $idUser = $user->get_id();
        $statement = $this->db->prepare("SELECT * FROM meeting WHERE id_user = :id");
        $statement->bindParam(":id", $idUser);
        $statement->execute();
        $array = $statement->fetchAll(PDO::FETCH_ASSOC);
        $return = [];

        $daoPlace = new DaoPlace(DBHOST, DBNAME, PORT, USER, PASS);
        $daoUser = new DaoUser(DBHOST, DBNAME, PORT, USER, PASS);

        foreach($array as $elem) {
            $place = $daoPlace->getPlaceById($elem['id_place']);
            if ($elem['id_user_asks_for'] != null)  $patient = $daoUser->getFullById($elem['id_user_asks_for']);
            else                                    $patient = null;
            $beginning = DateTime::createFromFormat('Y-m-d H:i:s', $elem['beginning']);
            $ending = DateTime::createFromFormat('Y-m-d H:i:s', $elem['ending']);
            $timeslot = new Meeting($elem['id'], $beginning, $ending, $place, $user, $patient);
            array_push($return, $timeslot);
        }

        return $return;
    }
}