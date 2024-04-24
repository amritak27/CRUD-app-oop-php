<?php

class Catgory {
    private $conn;
    private $table_name = "categories";

    public $id;
    public $name;

    public function __construct($db) {
        $this->conn = $db;
    }

    function read() {
        $qry = "SELECT id, name 
                FROM ". $this->table_name ."
                ORDER BY name";
        $stmt = $this->conn->prepare($qry);
        $stmt->execute();

        return $stmt;
    }

    // used to read category name by its ID 
    function readName(){        
        $query = "SELECT name FROM " . $this->table_name . " WHERE id = ? limit 0,1";

        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $this->name = $row['name'];
    }
}