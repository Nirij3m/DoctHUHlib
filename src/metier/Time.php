<?php
class Week {
    private DateTime $begin;

    private DateTime $end;

    private array $days = array();

    public function __construct(DateTime $begin) {
        $this->begin = $begin;
        array_push($this->days, clone $begin);
        $tstart = clone $begin;
        for($i = 0; $i < 6; $i++){
            $tplus = $tstart->add(DateInterval::createFromDateString('1 day'));
            array_push($this->days, clone $tplus);
            $tstart = $tplus;
        }
        $this->end = end($this->days);
    }
    public function getBegin() :  DateTime {
        return $this->begin;
    }
    public function getEnd() : DateTime {
        return $this->end;
    }
    public function getDays() : array {
        return $this->days;
    }
    public function setBegin(DateTime $begin) : void {
        $this->begin = $begin;
    }
    public function setEnd($end) : void {
        $this->end = $end;
    }
}

class Meeting{
    private DateTime $beginning;
    private DateTime $ending;
    private int $id;
    private int $idPlace;
    private ?int $idAsksFor;
    private int $idUser;

    public function __construct(DateTime $beginning, DateTime $ending, int $id, int $idPlace, ?int $idAsksFor, int $idUser){
            $this->beginning = clone $beginning;
            $this->ending =  clone $ending;
            $this->id = $id;
            $this->idPlace = $idPlace;
            $this->idAsksFor = $idAsksFor;
            $this->idUser = $idUser;
    }
    public function getBeginning() : DateTime{
        return clone $this->beginning;
    }
    public function getEnding() : DateTime{
        return clone $this->ending;
    }
    public function getId() : int {
        return $this->id;
    }
    public function getIdPlace() : int {
        return $this->idPlace;
    }
    public function getIdAsksFor() : int {
        return $this->idAsksFor;
    }
    public function getIdUser() : int {
        return $this->idUser;
    }

    public function setBeginning(DateTime $beg){
        $this->beginning = clone $beg;
    }
    public function setEnding(DateTime $end){
        $this->beginning = clone $end;
    }
    public function setId(int $id){
        $this->id = $id;
    }
    public function setIdPlace(int $id){
        $this->idPlace = $id;
    }
    public function setIdAsksFor(int $id){
        $this->idAsksFor = $id;
    }
    public function setIdUser(int $id){
        $this->idUser = $id;
    }
}

