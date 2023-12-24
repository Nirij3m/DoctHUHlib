<?php
class City {
    private ?int $code_insee;
    private ?string $city;
    private ?int $code_postal;

    public function __construct(?int $code_insee, ?string $city, ?int $code_postal) {
        $this->code_insee   = $code_insee;
        $this->city         = $city;
        $this->code_postal  = $code_postal;
    }

    public function get_code_insee() : int {
        return $this->code_insee;
    }

    public function get_city() : string {
        return $this->city;
    }

    public function get_code_postal() : int {
        return $this->code_postal;
    }

    public function set_code_insee(int $code_insee) {
        $this->code_insee = $code_insee;
    }

    public function set_city(string $city) {
        $this->city = $city;
    }

    public function set_code_postal(int $code_postal) {
        $this->code_postal = $code_postal;
    }

}