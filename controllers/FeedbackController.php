<?php
namespace Controllers;

use Models\Feedback;

class FeedbackController {

    public function showForm() {
        require_once __DIR__ . '/../views/feedback_form.php';
    }

    public function saveFeedback() {
        $feedback = $_POST['feedback'];
        $estrelas = $_POST['estrelas'];
        $quantidade_feedbacks = $_POST['quantidade_feedbacks'];

        $feedbackModel = new Feedback();
        $feedbackModel->feedback = $feedback;
        $feedbackModel->estrelas = $estrelas;
        $feedbackModel->quantidade_feedbacks = $quantidade_feedbacks;

        if ($feedbackModel->save()) {
            header('Location: /bella_back_novo/index.php?action=list-feedback');
            exit;
        } else {
            echo "Erro ao salvar o feedback!";
        }
    }

    public function listfeedback() {
        $feedbackModel = new Feedback();
        $feedbacks = $feedbackModel->getAll();

        require_once __DIR__ . '/../views/feedback_list.php';
    }
}
