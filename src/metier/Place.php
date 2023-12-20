<?php
class Place {
    private ?string $name;
    private ?int $numStreet;
    private ?string $street;
    private ?int $codePostal;
    private ?string $city;

    public function __construct(?string $name = null, ?int $numStreet = 0, ?string $street = null, ?int $codePostal = 0, ?string $city = null){
        if($name != null) $this->name = $name;
        if($numStreet != null) $this->numStreet = $numStreet;
        if($street != null) $this->street = $street;
        if($codePostal != null) $this->codePostal = $codePostal;
        if($city != null) $this->city = $city;
    }

    public function getName(){
        return $this->name;
    }
    public function getNumStreet(){
        return $this->numStreet;
    }
    public function getStreet(){
        return $this->street;
    }
    public function getCodePostal(){
        return $this->codePostal;
    }
    public function getCity(){
        return $this->city;
    }
    public function setName($name){
        $this->name = $name;
    }
    public function setNumStreet($ns){
        $this->name = $ns;
    }
    public function setStreet($street){
        $this->name = $street;
    }
    public function setCodePostal($cp){
        $this->name = $cp;
    }
    public function setCity($city){
        $this->name = $city;
    }
}


