<?php
require_once "Speciality.php";
require_once "Place.php";

class User {
    private int $id;
    private string $name;
    private string $surname;
    private string $phone;
    private string $mail;
    private string $password;
    private ?int $idPlace;
    private ?Place $place;
    private ?Speciality $speciality;

    public function __construct(int $id, string $name, string $surname, string $phone, string $mail, string $password, ?int $idPlace, ?Place $place = NULL, ?Speciality $speciality = NULL) {
        $this->id           = $id;
        $this->name         = $name;
        $this->surname      = $surname;
        $this->phone        = $phone;
        $this->mail         = $mail;
        $this->password     = $password;
        $this->idPlace = $idPlace;
        if ($speciality != NULL) $this->speciality   = $speciality;
        if ($place != NULL) $this->place = $place;
    }

    public function get_id() : int {
        return $this->id;
    }

    public function get_name() : string {
        return $this->name;
    }

    public function get_surname() : string {
        return $this->surname;
    }

    public function get_phone() : string {
        return $this->phone;
    }

    public function get_mail() : string {
        return $this->mail;
    }

    public function get_password() : string {
        return $this->password;
    }

    public function get_speciality() : Speciality {
        return $this->speciality;
    }
    public function get_id_place() : int {
        return $this->idPlace;
    }

    public function set_id($id) {
        $this->id = $id;
    }

    public function set_name(string $name) {
        $this->name = $name;
    }

    public function set_surname(string $surname) {
        $this->surname = $surname;
    }

    public function set_phone(string $phone) {
        $this->phone = $phone;
    }

    public function set_mail(string $mail) {
        $this->mail = $mail;
    }

    public function set_password(string $password) {
        $this->password = $password;
    }

    public function set_speciality(Speciality $speciality) {
        $this->speciality = $speciality;
    }
    public function set_id_place(int $idPlace){
        $this->idPlace = $idPlace;
    }
}