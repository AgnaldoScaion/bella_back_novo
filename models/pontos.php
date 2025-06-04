<?php

require_once '../config/database.php';

class Pontos {
    private $conn;
    private $table_name = "pontos";
    public $id_ponto;
    public $quantidade;
    public $nome; // Adicionado
    public $descricao; // Adicionado
    public $localizacao; // Adicionado

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function save() {
        try {
            $query = "INSERT INTO " . $this->table_name . " (quantidade, nome, descricao, localizacao) 
                      VALUES (:quantidade, :nome, :descricao, :localizacao)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':quantidade', $this->quantidade);
            $stmt->bindParam(':nome', $this->nome);
            $stmt->bindParam(':descricao', $this->descricao);
            $stmt->bindParam(':localizacao', $this->localizacao);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao salvar ponto: " . $e->getMessage());
            return false;
        }
    }

    public function getAll() {
        try {
            $query = "SELECT * FROM " . $this->table_name;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao listar pontos: " . $e->getMessage());
            return [];
        }
    }
}