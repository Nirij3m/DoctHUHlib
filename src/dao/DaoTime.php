<?php
require_once "src/metier/Time.php";
class DaoTime{
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
    public function getFutureWeeks(){
        $ttime = new DateTime();
        $weekArray = array();
        while($ttime->format("N") != 1){
            $ttime->sub(DateInterval::createFromDateString("1 day"));
        }
        for($i = 0; $i < 9; $i++){
            $tstart = clone $ttime;
            $week = new Week($tstart);
            array_push($weekArray, $week);
            $ttime->add(DateInterval::createFromDateString('7 days'));
        }
        return $weekArray;
    }

}
?>