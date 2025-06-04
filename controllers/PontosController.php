<?php
require_once '../models/pontos.php';

class PontosController {
    public function showForm() {
        session_start();
        require_once '../views/ponto_form.php';
    }

    public function savePonto() {
        session_start();
        if (!isset($_POST['csrf_token']) || !verifyCsrfToken($_POST['csrf_token'])) {
            $_SESSION['message'] = 'Token CSRF inválido.';
            $_SESSION['message_type'] = 'error';
            header('Location: /bella_back_novo/public/ponto_form/');
            return;
        }

        $quantidade = filter_input(INPUT_POST, 'quantidade', FILTER_SANITIZE_STRING);
        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
        $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);
        $localizacao = filter_input(INPUT_POST, 'localizacao', FILTER_SANITIZE_STRING);
        $fk_usuario_id_usuario = filter_input(INPUT_POST, 'fk_usuario_id_usuario', FILTER_SANITIZE_NUMBER_INT);

        if (!$quantidade || !$nome || !$descricao || !$localizacao || !$fk_usuario_id_usuario) {
            $_SESSION['message'] = 'Preencha todos os campos obrigatórios!';
            $_SESSION['message_type'] = 'error';
            header('Location: /bella_back_novo/public/ponto_form/');
            return;
        }

        $ponto = new Pontos();
        $ponto->quantidade = $quantidade;
        $ponto->nome = $nome;
        $ponto->descricao = $descricao;
        $ponto->localizacao = $localizacao;
        $ponto->fk_usuario_id_usuario = $fk_usuario_id_usuario;

        if ($ponto->save()) {
            $_SESSION['message'] = 'Ponto cadastrado com sucesso!';
            $_SESSION['message_type'] = 'success';
            header('Location: /bella_back_novo/public/list-ponto/');
            exit;
        } else {
            $_SESSION['message'] = 'Erro ao salvar ponto!';
            $_SESSION['message_type'] = 'error';
            header('Location: /bella_back_novo/public/ponto_form/');
        }
    }

    public function listPonto() {
        session_start();
        $ponto = new Pontos();
        $pontos = $ponto->getAll();
        require_once '../views/ponto_list.php';
    }

    public function deletePonto() {
        session_start();
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $ponto = new Pontos();
        if ($ponto->delete($id)) {
            $_SESSION['message'] = 'Ponto excluído com sucesso!';
            $_SESSION['message_type'] = 'success';
            header('Location: /bella_back_novo/public/list-ponto/');
            exit;
        } else {
            $_SESSION['message'] = 'Erro ao excluir ponto!';
            $_SESSION['message_type'] = 'error';
            header('Location: /bella_back_novo/public/list-ponto/');
        }
    }
}