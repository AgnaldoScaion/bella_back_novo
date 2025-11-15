<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Chat Tecnológico</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in { animation: fade-in 0.3s ease-out; }
        .chat-popup { display: none; position: fixed; bottom: 100px; right: 30px; z-index: 1000; width: 400px; max-width: calc(100vw - 40px); }
        .chat-popup.active { display: block; animation: fade-in 0.3s ease-out; }
        .chat-button { position: fixed; bottom: 30px; right: 30px; z-index: 999; }
        @media (max-width: 640px) {
            .chat-popup { right: 10px; bottom: 90px; width: calc(100vw - 20px); }
            .chat-button { right: 10px; bottom: 10px; }
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen p-8">
    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg p-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Bem-vindo ao Chat Tecnológico</h1>
        <p class="text-gray-600 mb-4">Esta é uma página de exemplo. Clique no botão flutuante no canto inferior esquerdo para abrir o chat novamente!</p>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
            <div class="bg-purple-50 p-6 rounded-lg">
                <h3 class="text-xl font-semibold text-purple-800 mb-2">Chat em Popup</h3>
                <p class="text-gray-600">Nosso chat abre em uma janela popup flutuante, sem sair da página atual.</p>
            </div>
            <div class="bg-pink-50 p-6 rounded-lg">
                <h3 class="text-xl font-semibold text-pink-800 mb-2">Totalmente Funcional</h3>
                <p class="text-gray-600">Envie mensagens reais que são salvas no banco de dados.</p>
            </div>
        </div>
    </div>
    <button id="chatToggle" class="chat-button bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white rounded-full p-4 shadow-lg transition-all duration-300 hover:scale-110">
        <svg id="chatIcon" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
        </svg>
        <svg id="closeIcon" class="w-8 h-8 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>
    <div id="chatPopup" class="chat-popup">
        <div class="bg-slate-800/95 backdrop-blur-xl rounded-2xl shadow-2xl border border-slate-700/50 overflow-hidden flex flex-col h-[600px]">
            <div class="bg-slate-800/60 backdrop-blur-sm border-b border-slate-700/50 px-4 py-3 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="relative">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center text-white font-semibold">AI</div>
                        <div class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-green-400 rounded-full border-2 border-slate-800"></div>
                    </div>
                    <div>
                        <h2 class="text-white font-semibold">Assistente Virtual</h2>
                        <p class="text-green-400 text-xs">Online</p>
                    </div>
                </div>
                <button id="minimizeChat" class="p-2 hover:bg-slate-700/50 rounded-lg transition-colors">
                    <svg class="w-5 h-5 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
            </div>
            <div id="messagesArea" class="flex-1 overflow-y-auto px-4 py-4 space-y-3"></div>
            <div id="quickReplies" class="flex flex-wrap gap-2 px-4 pb-2"></div>
            <div class="bg-slate-800/60 backdrop-blur-sm border-t border-slate-700/50 px-4 py-3">
                <form id="chatForm" class="flex items-end gap-2">
                    <div class="flex-1 bg-slate-700/50 backdrop-blur-sm rounded-xl border border-slate-600/50 focus-within:border-purple-500/50 transition-colors">
                        <textarea id="messageInput" placeholder="Digite sua mensagem..." class="w-full bg-transparent text-white px-3 py-2 outline-none resize-none placeholder-slate-400 max-h-32 text-sm" rows="1"></textarea>
                    </div>
                    <button type="submit" id="sendButton" class="p-2.5 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 rounded-xl transition-all shadow-lg shadow-purple-500/25">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
    <script>
        // Inteligência aprimorada e jogada de cores
        const messagesArea = document.getElementById('messagesArea');
        const quickReplies = document.getElementById('quickReplies');
        const chatForm = document.getElementById('chatForm');
        const messageInput = document.getElementById('messageInput');

        // Mensagem de boas-vindas
        function showWelcome() {
            addMessage('Olá! 👋 Eu sou sua assistente virtual. Como posso ajudar?', 'ai');
            showQuickReplies([
                'Quais destinos você recomenda?',
                'Como faço uma reserva?',
                'Quais pontos turísticos estão em alta?',
                'Quero falar com um atendente'
            ]);
        }

        // Adiciona mensagem ao chat
        function addMessage(text, sender) {
            const msgDiv = document.createElement('div');
            msgDiv.className = sender === 'ai'
                ? 'bg-gradient-to-r from-purple-500/80 to-pink-500/80 text-white rounded-xl px-4 py-2 max-w-[80%] self-start shadow-md border border-purple-400 animate-fade-in'
                : 'bg-white border border-pink-200 text-gray-800 rounded-xl px-4 py-2 max-w-[80%] self-end shadow-md animate-fade-in';
            msgDiv.textContent = text;
            messagesArea.appendChild(msgDiv);
            messagesArea.scrollTop = messagesArea.scrollHeight;
        }

        // Sugestões rápidas
        function showQuickReplies(replies) {
            quickReplies.innerHTML = '';
            replies.forEach(reply => {
                const btn = document.createElement('button');
                btn.className = 'px-3 py-1 bg-gradient-to-r from-purple-400 to-pink-400 text-white rounded-lg shadow hover:from-purple-500 hover:to-pink-500 transition-all text-sm';
                btn.textContent = reply;
                btn.onclick = () => {
                    messageInput.value = reply;
                    chatForm.dispatchEvent(new Event('submit'));
                };
                quickReplies.appendChild(btn);
            });
        }

        // Resposta automática por palavra-chave
        function getAutoReply(text) {
            text = text.toLowerCase();
            if (text.includes('destino')) return 'Temos ótimos destinos! Quer ver hotéis, restaurantes ou pontos turísticos?';
            if (text.includes('reserva')) return 'Para reservar, escolha o destino e clique em "Reservar". Precisa de ajuda?';
            if (text.includes('ponto turístico')) return 'Os pontos turísticos mais visitados estão em destaque na página principal.';
            if (text.includes('atendente')) return 'Um atendente humano irá te responder em breve.';
            return 'Posso te ajudar com destinos, reservas ou dúvidas sobre o site!';
        }

        // Evento de envio de mensagem
        chatForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const text = messageInput.value.trim();
            if (!text) return;
            addMessage(text, 'user');
            setTimeout(() => {
                addMessage(getAutoReply(text), 'ai');
            }, 600);
            messageInput.value = '';
            quickReplies.innerHTML = '';
        });

        // Inicia chat com boas-vindas
        showWelcome();
    </script>
</body>
</html>
