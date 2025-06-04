<?php
require_once '../config/database.php';

class Usuario {
    private $conn;
    private $table_name = "usuario";
    public $id_usuario;
    public $nome_completo;
    public $data_nascimento;
    public $CPF;
    public $e_mail;
    public $senha;
    public $nome_perfil;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function save() {
        try {
            $query = "INSERT INTO " . $this->table_name . " (nome_completo, data_nascimento, CPF, e_mail, senha, nome_perfil) 
                      VALUES (:nome_completo, :data_nascimento, :CPF, :e_mail, :senha, :nome_perfil)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':nome_completo', $this->nome_completo);
            $stmt->bindParam(':data_nascimento', $this->data_nascimento);
            $stmt->bindParam(':CPF', $this->CPF);
            $stmt->bindParam(':e_mail', $this->e_mail);
            $stmt->bindParam(':senha', $this->senha);
            $stmt->bindParam(':nome_perfil', $this->nome_perfil);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao salvar usuário: " . $e->getMessage());
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
            error_log("Erro ao listar usuários: " . $e->getMessage());
            return [];
        }
    }
}