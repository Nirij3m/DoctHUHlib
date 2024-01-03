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

    public function getMeetingsOfDoctor(User $user) {
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

    public function getMeetingsOfPatient(User $user) {
        $idUser = $user->get_id();
        $statement = $this->db->prepare("SELECT * FROM meeting WHERE id_user_asks_for = :id ORDER BY beginning DESC");
        $statement->bindParam(":id", $idUser);
        $statement->execute();
        $array = $statement->fetchAll(PDO::FETCH_ASSOC);
        $return = [];

        $daoPlace = new DaoPlace(DBHOST, DBNAME, PORT, USER, PASS);
        $daoUser = new DaoUser(DBHOST, DBNAME, PORT, USER, PASS);

        foreach($array as $elem) {
            $place = $daoPlace->getPlaceById($elem['id_place']);
            if ($elem['id_user_asks_for'] != null)  $medecin = $daoUser->getFullById($elem['id_user']);
            else                                    $medecin = null;
            $beginning = DateTime::createFromFormat('Y-m-d H:i:s', $elem['beginning']);
            $ending = DateTime::createFromFormat('Y-m-d H:i:s', $elem['ending']);
            $timeslot = new Meeting($elem['id'], $beginning, $ending, $place, $medecin, $user);
            array_push($return, $timeslot);
        }

        return $return;
    }

    public function cancelMeetingOfPatient(User $user, Meeting $meeting) {
        $idUser = $user->get_id();
        $idMeeting = $meeting->get_id();

        $statement = $this->db->prepare("UPDATE meeting SET id_user_asks_for = null WHERE id = :id AND id_user_asks_for = :idUser");
        $statement->bindParam(":id", $idMeeting);
        $statement->bindParam(":idUser", $idUser);
        $statement->execute();
    }

    public function setUserOfMeeting(Meeting $meeting, User $user) {
        $idMeeting  = $meeting->get_id();
        $idUser     = $user->get_id();

        $statement = $this->db->prepare("UPDATE meeting SET id_user_asks_for = :id_user WHERE id = :id");
        $statement->bindParam(":id_user", $idUser);
        $statement->bindParam(":id", $idMeeting);
        $statement->execute();
    }

    public function getNextMeeting(User $user) {
        $idUser = $user->get_id();

        $statement = $this->db->prepare("SELECT * FROM meeting WHERE id_user_asks_for = :id AND beginning > NOW()");
        $statement->bindParam(":id", $idUser);
        $statement->execute();
        $elem = $statement->fetch(PDO::FETCH_ASSOC);

        $daoUser = new DaoUser(DBHOST, DBNAME, PORT, USER, PASS);
        $daoPlace = new DaoPlace(DBHOST, DBNAME, PORT, USER, PASS);

        if ($elem != false) {
            $place = $daoPlace->getPlaceById($elem['id_place']);
            if ($elem['id_user_asks_for'] != null)  $medecin = $daoUser->getFullById($elem['id_user']);
            else                                    $medecin = null;
            $beginning  = DateTime::createFromFormat('Y-m-d H:i:s', $elem['beginning']);
            $ending     = DateTime::createFromFormat('Y-m-d H:i:s', $elem['ending']);
            $meeting    = new Meeting($elem['id'], $beginning, $ending, $place, $medecin, $user);
        }
        else $meeting = null;

        return $meeting;
    }

    public function insertMeeting(DateTime $beg, DateTime $end, User $user){
        $beginning = $beg->format("Y-m-d H:i");
        $ending = $end->format("Y-m-d H:i");
        $idPlace = $user->get_place()->get_id();
        $idUser = $user->get_id();

        //Check if the timestamp is already taken
        $checkStatement = $this->db->prepare("SELECT * from meeting WHERE :beg >= beginning AND :beg < ending AND id_user = :id ");
        $checkStatement->bindParam(":beg", $beginning);
        $checkStatement->bindParam(":id", $idUser);
        $checkStatement->execute();
        $resutlCheck = $checkStatement->fetch(PDO::FETCH_ASSOC);
        if(!empty($resutlCheck)){ //This timestamp already exists
            return false;
        }
        //
        //Insert the meeting
        $statement = $this->db->prepare('INSERT INTO meeting(beginning, ending, id_place, id_user) VALUES (:beg, :end, :id_place, :id_user)');
        $statement->bindParam(":beg", $beginning);
        $statement->bindParam(":end", $ending);
        $statement->bindParam(":id_place", $idPlace);
        $statement->bindParam(":id_user", $idUser);
        return $statement->execute();
    }
    public function deleteMeeting(string $tbeg, int $idDoc){
        $utils = new Utils();
        $statement = $this->db->prepare("DELETE from meeting WHERE id_user = :idDoc AND beginning = :tbeg");
        $statement->bindParam(":idDoc", $idDoc );
        $statement->bindParam(":tbeg", $tbeg);
        try {
            $statement->execute();
            $utils->echoSuccess("Horaire supprimé");
        }
        catch (PDOException $e){
            $utils->echoError("Erreur lors de la suppression de la plage");
        }
    }
}