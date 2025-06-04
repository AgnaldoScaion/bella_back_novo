<?php

require_once '../config/database.php';

class Feedback {
    private $conn;
    private $table_name = "feedbacks";

    public $id_feedback;
    public $feedback;
    public $stars;
    public $feedback_count;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function save() {
        $query = "INSERT INTO {$this->table_name} (feedback, stars, feedback_count) 
                  VALUES (:feedback, :stars, :feedback_count)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':feedback', $this->feedback);
        $stmt->bindParam(':stars', $this->stars);
        $stmt->bindParam(':feedback_count', $this->feedback_count);

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