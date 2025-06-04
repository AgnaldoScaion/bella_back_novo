<?php
require_once '../models/restaurante.php';

// Listar restaurantes
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'listar') {
    $restaurante = new Restaurante();
    $restaurantes = $restaurante->getAll();
    include '../views/restaurante_list.php';
    exit;
}

// Salvar restaurante (inserir)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $restaurante = new Restaurante();
    $restaurante->nome = $_POST['nome'];
    $restaurante->telefone = $_POST['telefone'];
    $restaurante->estado = $_POST['estado'];
    $restaurante->cidade = $_POST['cidade'];
    $restaurante->rua = $_POST['rua'];
    $restaurante->bairro = $_POST['bairro'];
    $restaurante->numero = $_POST['numero'];
    $restaurante->horario_funcionamento = $_POST['horario_funcionamento'];
    $restaurante->sobre = $_POST['sobre'];

    if ($restaurante->save()) {
        header('Location: RestauranteController.php?action=listar');
        exit;
    } else {
        echo "Erro ao salvar restaurante!";
    }
}

// Excluir restaurante
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'excluir' && isset($_GET['id'])) {
    $restaurante = new Restaurante();
    $id = $_GET['id'];
    if ($restaurante->delete($id)) {
        header('Location: RestauranteController.php?action=listar');
        exit;
    } else {
        echo "Erro ao excluir restaurante!";
    }
}