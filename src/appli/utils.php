<?php
const PATH_VIEW = "src/view/";
const DBHOST = "localhost";
const DBNAME = "themightypoo";
const PORT = 5433;
const USER = "postgres";
const PASS = "Isen44N";

class Utils {
    public function hash_password(string $password) {
        password_hash($password, PASSWORD_BCRYPT);
    }
}