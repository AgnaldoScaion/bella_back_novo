<?php
require_once '../models/pontoturistico.php';

class PontoTuristicoController {
    public function showForm() {
        session_start();
        require_once '../views/pontoturistico_form.php';
    }

    public function savePontoTuristico() {
        session_start();
        if (!isset($_POST['csrf_token']) || !verifyCsrfToken($_POST['csrf_token'])) {
            $_SESSION['message'] = 'Token CSRF inválido.';
            $_SESSION['message_type'] = 'error';
            header('Location: /bella_back_novo/public/pontoturistico_form/');
            return;
        }

        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
        $sobre = filter_input(INPUT_POST, 'sobre', FILTER_SANITIZE_STRING);
        $numero = filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_NUMBER_INT);
        $rua = filter_input(INPUT_POST, 'rua', FILTER_SANITIZE_STRING);
        $bairro = filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_STRING);
        $cidade = filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_STRING);
        $estado = filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_STRING);

        if (!$nome || !$sobre || !$numero || !$rua || !$bairro || !$cidade || !$estado) {
            $_SESSION['message'] = 'Preencha todos os campos obrigatórios!';
            $_SESSION['message_type'] = 'error';
            header('Location: /bella_back_novo/public/pontoturistico_form/');
            return;
        }

        $pontoModel = new PontoTuristico();
        $pontoModel->nome = $nome;
        $pontoModel->sobre = $sobre;
        $pontoModel->numero = $numero;
        $pontoModel->rua = $rua;
        $pontoModel->bairro = $bairro;
        $pontoModel->cidade = $cidade;
        $pontoModel->estado = $estado;

        if ($pontoModel->save()) {
            $_SESSION['message'] = 'Ponto turístico cadastrado com sucesso!';
            $_SESSION['message_type'] = 'success';
            header('Location: /bella_back_novo/public/list-pontoturistico/');
            exit;
        } else {
            $_SESSION['message'] = 'Erro ao salvar ponto turístico!';
            $_SESSION['message_type'] = 'error';
            header('Location: /bella_back_novo/public/pontoturistico_form/');
        }
    }

    public function listPontoTuristico() {
        session_start();
        $pontoModel = new PontoTuristico();
        $pontos = $pontoModel->getAll();
        require_once '../views/pontoturistico_list.php';
    }
}