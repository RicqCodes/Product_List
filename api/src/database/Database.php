<?php

namespace api\database;
use PDO;

class Database {
    private $db;
    
    public function __construct() {
        $dsn = 'mysql:host=localhost;dbname=test;charset=utf8';
        $user = 'root';
        $password = '';

        try {
            $this->db = new PDO($dsn, $user, $password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch(\Exception $e) {
            die('Database connection failed: ' . $e->getMessage());
        }
    }

    public function getDB() {
        return $this->db;
    }
    
    public function query(string $query){
            return $this->db->prepare($query);
    }

}