<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Marca o tutorial do chat como fechado para o usuário logado.
     */
    public function closeTutorial(Request $request)
    {
        $user = auth()->user();
        if ($user) {
            $user->chat_tutorial_closed = true;
            $user->save();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 401);
    }
    public function index()
    {
        return view('chat.index');
    }

    public function getMessages()
    {
        $userId = Auth::user()->id_usuario;
        Message::where('user_id', $userId)->delete();
        $nome = Auth::user()->nome_completo ?? 'Viajante';
        $hora = now()->format('H');
        $saudacao = ($hora >= 6 && $hora < 12) ? 'Bom dia' : (($hora >= 12 && $hora < 18) ? 'Boa tarde' : 'Boa noite');
        $initialBot = [
            'id' => 0,
            'text' => $saudacao . ', ' . $nome . '! 👋 Eu sou sua assistente virtual. Como posso ajudar? Veja sugestões abaixo ou digite sua dúvida.',
            'sender' => 'bot',
            'time' => now()->format('H:i'),
            'quickReplies' => [
                'Quais destinos você recomenda?',
                'Como faço uma reserva?',
                'Quais pontos turísticos estão em alta?',
                'Quero falar com um atendente'
            ]
        ];
        $tutorialBot = [
            'id' => 1,
            'text' => 'Tutorial rápido: 1️⃣ Escolha uma opção abaixo ou digite sua pergunta. 2️⃣ Você pode perguntar sobre destinos, reservas, pontos turísticos ou atendimento. 3️⃣ Para reservar, basta pedir ou clicar nos menus do site. Se quiser mais dicas, digite "tutorial" a qualquer momento. Se precisar de ajuda, digite "ajuda".',
            'sender' => 'bot',
            'time' => now()->addSeconds(2)->format('H:i'), // Simula delay de 2 segundos
            'delay' => 2000 // ms, para frontend exibir como "escrevendo"
        ];
        return response()->json([$initialBot, $tutorialBot]);
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000'
        ]);
        $userId = Auth::user()->id_usuario;
        $userMessage = Message::create([
            'message' => $request->message,
            'sender' => 'user',
            'user_id' => $userId
        ]);
        $botResponse = $this->generateBotResponse($request->message);
        $botMessage = Message::create([
            'message' => $botResponse,
            'sender' => 'bot',
            'user_id' => $userId
        ]);
        return response()->json([
            'userMessage' => [
                'id' => $userMessage->id,
                'text' => $userMessage->message,
                'sender' => 'user',
                'time' => $userMessage->created_at->format('H:i')
            ],
            'botMessage' => [
                'id' => $botMessage->id,
                'text' => $botMessage->message,
                'sender' => 'bot',
                'time' => $botMessage->created_at->format('H:i')
            ]
        ]);
    }

    private function generateBotResponse($userMessage)
    {
        $msg = strtolower($userMessage);
        // Sinônimos e frases
        if (preg_match('/\b(olá|oi|opa|e aí|bom dia|boa tarde|boa noite)\b/', $msg)) {
            return 'Olá! 👋 Como posso ajudar? Você pode perguntar sobre destinos, reservas ou pontos turísticos.';
        }
        if (preg_match('/\b(ajuda|socorro|preciso de ajuda|me ajuda)\b/', $msg)) {
            return 'Claro! Para usar o sistema, clique nos menus de Destinos, Hotéis, Restaurantes ou Pontos Turísticos. Se quiser reservar, clique no botão de reserva. Qual parte você quer aprender?';
        }
        if (preg_match('/\b(como funciona|tutorial|explica|ensina)\b/', $msg)) {
            return 'Tutorial rápido: 1️⃣ Clique no botão do chat para conversar comigo. 2️⃣ Use os menus para navegar. 3️⃣ Para reservar, escolha o local e clique em "Reservar". Se tiver dúvidas, me pergunte!';
        }
        if (preg_match('/\b(destino|viagem|lugares|cidade)\b/', $msg)) {
            return 'Temos ótimos destinos! Quer ver hotéis, restaurantes ou pontos turísticos? Me diga o tipo de viagem que procura.';
        }
        if (preg_match('/\b(hotel|hospedagem|pousada|alojamento)\b/', $msg)) {
            return 'Hotéis são opções de hospedagem. Clique em "Hotéis" para ver os disponíveis. Para reservar, clique no hotel desejado e depois em "Reservar".';
        }
        if (preg_match('/\b(restaurante|comida|prato|culinária)\b/', $msg)) {
            return 'Restaurantes são lugares para comer. Clique em "Restaurantes" para ver opções. Se quiser sugestões de pratos, me pergunte!';
        }
        if (preg_match('/\b(ponto turístico|atração|monumento|visita)\b/', $msg)) {
            return 'Pontos turísticos são locais famosos para visitar. Clique em "Pontos Turísticos" para ver os mais visitados. Se quiser dicas, só pedir!';
        }
        if (preg_match('/\b(reserva|reservar|agendar|booking)\b/', $msg)) {
            return 'Para fazer uma reserva, escolha o local desejado e clique em "Reservar". Se precisar de ajuda, me diga o local e a data.';
        }
        if (preg_match('/\b(dica|sugestão|recomenda|indica)\b/', $msg)) {
            return 'Dica: Use os filtros do site para encontrar o que procura. Se quiser sugestões personalizadas, me conte o que você gosta!';
        }
        if (preg_match('/\b(obrigado|valeu|agradecido|thanks)\b/', $msg)) {
            return 'Por nada! Se precisar de mais alguma coisa, estou por aqui. 😊';
        }
        // Fallback para perguntas desconhecidas
        return 'Não entendi sua pergunta, mas posso te ajudar com destinos, reservas ou dúvidas sobre o site! Tente perguntar de outra forma ou clique em "Quero falar com um atendente".';
    }
}
