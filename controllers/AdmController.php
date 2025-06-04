<?php
require_once '../models/adm.php';

class AdmController {

    public function showForm() {
        // Exibe o formulário de cadastro de adms
        require_once '../views/adm_form.php';
    }

    public function saveAdm() {
        // Recebe dados do formulário
        $nome_completo = $_POST['nome_completo'];
        $data_nascimento = $_POST['data_nascimento'];
        $CPF = $_POST['CPF'];
        $e_mail = $_POST['e_mail'];
        $senha_adm = $_POST['senha_adm'];
        $nome_perfil = $_POST['nome_perfil'];

        // Cria um novo adm
        $adm = new Adm();
        $adm->nome_completo = $nome_completo;
        $adm->data_nascimento = $data_nascimento;
        $adm->CPF = $CPF;
        $adm->e_mail = $e_mail;
        $adm->senha_adm = password_hash($senha_adm, PASSWORD_BCRYPT); // Criptografa a senha
        $adm->nome_perfil = $nome_perfil;
        // Não defina $adm->id_adm se o banco gera automaticamente

        // Salva no banco de dados
        if ($adm->save()) {
            // Redireciona para a página de listagem
            header('Location: /bella_back_novo/list-adm');
            exit;
        } else {
            echo "Erro ao salvar o adm!";
        }
    }

    public function listadm() {
        // Pega todos os adms do banco de dados
        $admModel = new Adm();
        $adms = $admModel->getAll();
        
        // Exibe a lista de adms
        require_once '../views/adm_list.php';
    }
}