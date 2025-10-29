<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        return view('chat.index');
    }

    public function getMessages()
    {
        $userId = Auth::user()->id_usuario;
        // Apaga histórico do usuário a cada acesso (F5)
        Message::where('user_id', $userId)->delete();
        // Mensagem inicial tutorial do bot
        $initialBot = [
            'id' => 0,
            'text' => 'Olá! 👋 Eu sou sua assistente virtual. Para saber como usar o sistema, digite "tutorial" ou clique nos menus acima. Posso te ajudar com reservas, dicas e navegação!',
            'sender' => 'bot',
            'time' => now()->format('H:i')
        ];
        return response()->json([$initialBot]);
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
        $lowercaseMessage = strtolower($userMessage);
        if (str_contains($lowercaseMessage, 'olá') || str_contains($lowercaseMessage, 'oi')) {
            return 'Olá! 👋 Eu sou sua assistente virtual. Se precisar de ajuda, basta digitar sua dúvida ou clicar nos botões do site. Posso te explicar como funciona cada parte!';
        }
        if (str_contains($lowercaseMessage, 'ajuda')) {
            return 'Claro! Para usar o sistema, clique nos menus de Destinos, Hotéis, Restaurantes ou Pontos Turísticos. Se quiser reservar, clique no botão de reserva. Qual parte você quer aprender?';
        }
        if (str_contains($lowercaseMessage, 'como funciona') || str_contains($lowercaseMessage, 'tutorial')) {
            return 'Tutorial rápido: 1️⃣ Clique no botão verde do chat no canto inferior direito para conversar comigo. 2️⃣ Use os menus para navegar. 3️⃣ Para reservar, escolha o local e clique em "Reservar". Se tiver dúvidas, me pergunte!';
        }
        if (str_contains($lowercaseMessage, 'destino')) {
            return 'Destinos são lugares para viajar. Clique em "Destinos" no menu para ver opções. Se quiser dicas, me diga o tipo de viagem que procura!';
        }
        if (str_contains($lowercaseMessage, 'hotel')) {
            return 'Hotéis são opções de hospedagem. Clique em "Hotéis" para ver os disponíveis. Para reservar, clique no hotel desejado e depois em "Reservar".';
        }
        if (str_contains($lowercaseMessage, 'restaurante')) {
            return 'Restaurantes são lugares para comer. Clique em "Restaurantes" para ver opções. Se quiser sugestões de pratos, me pergunte!';
        }
        if (str_contains($lowercaseMessage, 'ponto turístico')) {
            return 'Pontos turísticos são locais famosos para visitar. Clique em "Pontos Turísticos" para ver os mais visitados. Se quiser dicas, só pedir!';
        }
        if (str_contains($lowercaseMessage, 'reserva')) {
            return 'Para fazer uma reserva, escolha o local desejado e clique em "Reservar". Se precisar de ajuda, me diga o local e a data.';
        }
        if (str_contains($lowercaseMessage, 'dica')) {
            return 'Dica: Use os filtros do site para encontrar o que procura. Se quiser sugestões personalizadas, me conte o que você gosta!';
        }
        if (str_contains($lowercaseMessage, 'obrigado') || str_contains($lowercaseMessage, 'valeu')) {
            return 'Por nada! Se precisar de mais alguma coisa, estou por aqui. 😊';
        }
        // Resposta padrão didática
        return 'Sou uma assistente virtual pronta para te ajudar! Para começar, clique no botão verde do chat no canto inferior direito. Digite sua dúvida ou escolha uma opção no menu. Se quiser um tutorial, digite "tutorial".';
    }
}
