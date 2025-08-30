<?php
require_once '../models/usuario.php';

class UsuarioController {
    public function showForm() {
        require_once '../views/usuario_form.php';
    }

    public function saveUsuario() {
        session_start();
        if (!isset($_POST['csrf_token']) || !verifyCsrfToken($_POST['csrf_token'])) {
            $_SESSION['message'] = 'Token CSRF inválido.';
            $_SESSION['message_type'] = 'error';
            header('Location: /bella_back_novo/public/usuario_form/');
            return;
        }

        $nome_completo = filter_input(INPUT_POST, 'nome_completo', FILTER_SANITIZE_STRING);
        $data_nascimento = filter_input(INPUT_POST, 'data_nascimento', FILTER_SANITIZE_STRING);
        $CPF = filter_input(INPUT_POST, 'CPF', FILTER_SANITIZE_STRING);
        $e_mail = filter_input(INPUT_POST, 'e_mail', FILTER_SANITIZE_EMAIL);
        $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
        $nome_perfil = filter_input(INPUT_POST, 'nome_perfil', FILTER_SANITIZE_STRING);

        if (!$nome_completo || !$data_nascimento || !$CPF || !$e_mail || !$senha) {
            $_SESSION['message'] = 'Preencha todos os campos obrigatórios!';
            $_SESSION['message_type'] = 'error';
            header('Location: /bella_back_novo/public/usuario_form/');
            return;
        }

        $usuario = new Usuario();
        $usuario->nome_completo = $nome_completo;
        $usuario->data_nascimento = $data_nascimento;
        $usuario->CPF = $CPF;
        $usuario->e_mail = $e_mail;
        $usuario->senha = password_hash($senha, PASSWORD_DEFAULT); // Hash da senha
        $usuario->nome_perfil = $nome_perfil;

        if ($usuario->save()) {
            $_SESSION['message'] = 'Usuário cadastrado com sucesso!';
            $_SESSION['message_type'] = 'success';
            header('Location: /bella_back_novo/public/list-usuario/');
            exit;
        } else {
            $_SESSION['message'] = 'Erro ao salvar usuário!';
            $_SESSION['message_type'] = 'error';
            header('Location: /bella_back_novo/public/usuario_form/');
        }
    }

    public function listUsuario() {
        session_start();
        $usuario = new Usuario();
        $usuarios = $usuario->getAll();
        require_once '../views/usuario_list.php';
    }
}