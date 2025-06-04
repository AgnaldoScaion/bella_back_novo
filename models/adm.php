<?php

require_once '../config/database.php';

class Adm {
    private $conn;
    private $table_name = "adms";

    public $id_adm;
    public $nome_completo;
    public $data_nascimento;
    public $CPF;
    public $e_mail;
    public $senha_adm;
    public $nome_perfil;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function save() {
        $query = "INSERT INTO " . $this->table_name . " (nome_completo, data_nascimento, CPF, e_mail, senha_adm, nome_perfil) 
                  VALUES (:nome_completo, :data_nascimento, :CPF, :e_mail, :senha_adm, :nome_perfil)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nome_completo', $this->nome_completo);
        $stmt->bindParam(':data_nascimento', $this->data_nascimento);
        $stmt->bindParam(':CPF', $this->CPF);
        $stmt->bindParam(':e_mail', $this->e_mail);
        $stmt->bindParam(':senha_adm', $this->senha_adm);
        $stmt->bindParam(':nome_perfil', $this->nome_perfil);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function getAll() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}