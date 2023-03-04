<?php

class Database {
    private $db;
    
    public function __construct() {
        $dsn = 'mysql:host=localhost;dbname=product-list;charset=utf8';
        $user = 'root';
        $password = 'FVaA7f@49X6m4';

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