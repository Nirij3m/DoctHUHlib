<?php
require_once "City.php";

class Place {
    private int $id;
    private string $name;
    private int $num_street;
    private string $street;
    private ?int $code_insee;
    private ?City $city;

    public function __construct(int $id, string $name, int $num_street, string $street, ?int $code_insee, ?City $city) {
        $this->id = $id;
        $this->name = $name;
        $this->num_street = $num_street;
        $this->street = $street;
        $this->code_insee = $code_insee;
        $this->city = $city;
    }

    public function get_id() : int {
        return $this->id;
    }

    public function get_name() : string {
        return $this->name;
    }

    public function get_num_street() : int {
        return $this->num_street;
    }

    public function get_street() : string {
        return $this->street;
    }

    public function get_code_insee() : int {
        return $this->code_insee;
    }

    public function get_city() : ?City {
        return $this->city;
    }

    public function set_id(int $id) {
        $this->id = $id;
    }

    public function set_name(string $name){
        $this->name = $name;
    }

    public function set_num_street(int $num_street){
        $this->num_street = $num_street;
    }

    public function set_street(string $street){
        $this->street = $street;
    }

    public function set_code_insee(int $code_insee){
        $this->code_insee = $code_insee;
    }

    public function set_city(City $city){
        $this->city = $city;
    }
}


