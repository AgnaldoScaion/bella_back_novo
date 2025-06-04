<?php
require_once '../config/database.php';

class Hotel {
    private $conn;
    private $table_name = "hotel";
    public $id_hotel;
    public $nome_hotel;
    public $estado;
    public $cidade;
    public $bairro;
    public $rua;
    public $numero;
    public $telefone;
    public $horario_funcionamento;
    public $sobre;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function save() {
        try {
            $query = "INSERT INTO " . $this->table_name . " (nome_hotel, estado, cidade, bairro, rua, numero, telefone, horario_funcionamento, sobre) 
                      VALUES (:nome_hotel, :estado, :cidade, :bairro, :rua, :numero, :telefone, :horario_funcionamento, :sobre)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':nome_hotel', $this->nome_hotel);
            $stmt->bindParam(':estado', $this->estado);
            $stmt->bindParam(':cidade', $this->cidade);
            $stmt->bindParam(':bairro', $this->bairro);
            $stmt->bindParam(':rua', $this->rua);
            $stmt->bindParam(':numero', $this->numero);
            $stmt->bindParam(':telefone', $this->telefone);
            $stmt->bindParam(':horario_funcionamento', $this->horario_funcionamento);
            $stmt->bindParam(':sobre', $this->sobre);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao salvar hotel: " . $e->getMessage());
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
            error_log("Erro ao listar hotéis: " . $e->getMessage());
            return [];
        }
    }

    public function delete($id) {
        try {
            $query = "DELETE FROM " . $this->table_name . " WHERE id_hotel = :id_hotel";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id_hotel', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao excluir hotel: " . $e->getMessage());
            return false;
        }
    }
}