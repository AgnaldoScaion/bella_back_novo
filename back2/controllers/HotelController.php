<?php
require_once '../models/hotel.php';

class HotelController {
    public function showForm() {
        session_start();
        require_once '../views/hotel_form.php';
    }

    public function saveHotel() {
        session_start();
        if (!isset($_POST['csrf_token']) || !verifyCsrfToken($_POST['csrf_token'])) {
            $_SESSION['message'] = 'Token CSRF inválido.';
            $_SESSION['message_type'] = 'error';
            header('Location: /bella_back_novo/public/hotel_form');
            return;
        }

        $nome_hotel = filter_input(INPUT_POST, 'nome_hotel', FILTER_SANITIZE_STRING);
        $estado = filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_STRING);
        $cidade = filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_STRING);
        $bairro = filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_STRING);
        $rua = filter_input(INPUT_POST, 'rua', FILTER_SANITIZE_STRING);
        $numero = filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_NUMBER_INT);
        $telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRING);
        $horario_funcionamento = filter_input(INPUT_POST, 'horario_funcionamento', FILTER_SANITIZE_STRING);
        $sobre = filter_input(INPUT_POST, 'sobre', FILTER_SANITIZE_STRING);

        if (!$nome_hotel || !$estado || !$cidade || !$bairro || !$rua || !$numero) {
            $_SESSION['message'] = 'Preencha todos os campos obrigatórios!';
            $_SESSION['message_type'] = 'error';
            header('Location: /bella_back_novo/public/hotel_form');
            return;
        }

        $hotel = new Hotel();
        $hotel->nome_hotel = $nome_hotel;
        $hotel->estado = $estado;
        $hotel->cidade = $cidade;
        $hotel->bairro = $bairro;
        $hotel->rua = $rua;
        $hotel->numero = $numero;
        $hotel->telefone = $telefone;
        $hotel->horario_funcionamento = $horario_funcionamento;
        $hotel->sobre = $sobre;

        if ($hotel->save()) {
            $_SESSION['message'] = 'Hotel cadastrado com sucesso!';
            $_SESSION['message_type'] = 'success';
            header('Location: /bella_back_novo/public/list-hotel');
            exit;
        } else {
            $_SESSION['message'] = 'Erro ao salvar hotel!';
            $_SESSION['message_type'] = 'error';
            header('Location: /bella_back_novo/public/hotel_form');
        }
    }

    public function listHotel() {
        session_start();
        $hotel = new Hotel();
        $hoteis = $hotel->getAll();
        require_once '../views/hotel_list.php';
    }

    public function deleteHotel() {
        session_start();
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $hotel = new Hotel();
        if ($hotel->delete($id)) {
            $_SESSION['message'] = 'Hotel excluído com sucesso!';
            $_SESSION['message_type'] = 'success';
            header('Location: /bella_back_novo/public/list-hotel');
            exit;
        } else {
            $_SESSION['message'] = 'Erro ao excluir hotel!';
            $_SESSION['message_type'] = 'error';
            header('Location: /bella_back_novo/public/list-hotel');
        }
    }
}