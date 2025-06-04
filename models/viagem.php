<?php

require_once '../config/database.php';

class Trip {
    private $conn;
    private $table_name = "trip";

    public $id;
    public $name;
    public $destination;
    public $start_date;
    public $end_date;
    public $description;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function save() {
        $query = "INSERT INTO {$this->table_name} (name, destination, start_date, end_date, description) 
                  VALUES (:name, :destination, :start_date, :end_date, :description)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':destination', $this->destination);
        $stmt->bindParam(':start_date', $this->start_date);
        $stmt->bindParam(':end_date', $this->end_date);
        $stmt->bindParam(':description', $this->description);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function getAll() {
        $query = "SELECT * FROM {$this->table_name}";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}