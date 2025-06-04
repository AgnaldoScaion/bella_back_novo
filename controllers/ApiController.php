<?php
require_once '../models/api.php';

// Listar APIs
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'listar') {
    $api = new Api();
    $apis = $api->getAll();
    include '../views/api_list.php';
    exit;
}

// Salvar API
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $api = new Api();
    $api->nome = $_POST['nome'];
    $api->url = $_POST['url'];
    $api->descricao = $_POST['descricao'];

    if ($api->save()) {
        header('Location: ApiController.php?action=listar');
        exit;
    } else {
        echo "Erro ao salvar API!";
    }
}

// Excluir API
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'excluir' && isset($_GET['id'])) {
    $api = new Api();
    $id = $_GET['id'];
    if ($api->delete($id)) {
        header('Location: ApiController.php?action=listar');
        exit;
    } else {
        echo "Erro ao excluir API!";
    }
}