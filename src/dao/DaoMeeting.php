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

    public function getMeetingById(int $id) {
        $statement = $this->db->prepare("SELECT * FROM meeting WHERE id = :id");
        $statement->bindParam(":id", $id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        $daoUser = new DaoUser(DBHOST, DBNAME, PORT, USER, PASS);
        $daoPlace = new DaoPlace(DBHOST, DBNAME, PORT, USER, PASS);
        
        $place = $daoPlace->getPlaceById($result['id_place']);

        if ($result['id_user_asks_for'] != null)    $patient = $daoUser->getFullById($result['id_user_asks_for']);
        else                                        $patient = null;

        if ($result['id_user'] != null) $medecin = $daoUser->getFullById($result['id_user']);
        else                            $medecin = null;

        $beginning = DateTime::createFromFormat('Y-m-d H:i:s', $result['beginning']);
        $ending = DateTime::createFromFormat('Y-m-d H:i:s', $result['ending']);
        
        $meeting = new Meeting($result['id'], $beginning, $ending, $place, $medecin, $patient);

        return $meeting;
    }

    public function getMeetings(User $user) {
        $idUser = $user->get_id();
        $statement = $this->db->prepare("SELECT * FROM meeting WHERE id_user = :id ORDER BY beginning");
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

    public function setUserOfMeeting(Meeting $meeting, User $user) {
        $idMeeting  = $meeting->get_id();
        $idUser     = $user->get_id();

        echo $idMeeting . "<br>" . $idUser;

        $statement = $this->db->prepare("UPDATE meeting SET id_user_asks_for = :id_user WHERE id = :id");
        $statement->bindParam(":id_user", $idUser);
        $statement->bindParam(":id", $idMeeting);
        $statement->execute();
    }
    public function insertMeeting($beg, $end, User $user){
        $beginning = $beg->format("Y-m-d H:i");
        $ending = $end->format("Y-m-d H:i");
        $idPlace = $user->get_place()->get_id();
        $idUser = $user->get_id();
        $statement = $this->db->prepare('INSERT INTO meeting(beginning, ending, id_place, id_user) VALUES (:beg, :end, :id_place, :id_user)');
        $statement->bindParam(":beg", $beginning);
        $statement->bindParam(":end", $ending);
        $statement->bindParam(":id_place", $idPlace);
        $statement->bindParam(":id_user", $idUser);
        $statement->execute();
    }
}
