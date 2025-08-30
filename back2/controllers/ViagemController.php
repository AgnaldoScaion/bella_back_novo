<?php
require_once '../models/viagem.php';

// Listar viagens
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'listar') {
    $viagem = new Viagem();
    $viagens = $viagem->getAll();
    include '../views/viagem_list.php';
    exit;
}

// Salvar viagem
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $viagem = new Viagem();
    $viagem->nome = $_POST['nome'];
    $viagem->destino = $_POST['destino'];
    $viagem->data_inicio = $_POST['data_inicio'];
    $viagem->data_fim = $_POST['data_fim'];
    $viagem->descricao = $_POST['descricao'];

    if ($viagem->save()) {
        header('Location: ViagemController.php?action=listar');
        exit;
    } else {
        echo "Erro ao salvar viagem!";
    }
}

// Excluir viagem
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'excluir' && isset($_GET['id'])) {
    $viagem = new Viagem();
    $id = $_GET['id'];
    if ($viagem->delete($id)) {
        header('Location: ViagemController.php?action=listar');
        exit;
    } else {
        echo "Erro ao excluir viagem!";
    }
}