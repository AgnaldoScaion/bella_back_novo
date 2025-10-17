<div id="chat-feedback" style="position: fixed; left: 24px; bottom: 24px; z-index: 9999;">
    <button id="chat-feedback-btn" style="background: #fff; border-radius: 50%; box-shadow: 0 2px 8px rgba(0,0,0,0.15); width: 56px; height: 56px; display: flex; align-items: center; justify-content: center; position: relative; animation: bounce 1s infinite; border: none; cursor: pointer;">
        <svg width="28" height="28" fill="#007bff" viewBox="0 0 24 24"><path d="M21 6.5a2.5 2.5 0 0 0-2.5-2.5h-13A2.5 2.5 0 0 0 3 6.5v9A2.5 2.5 0 0 0 5.5 18H7v2.25a.75.75 0 0 0 1.22.59L11.5 18h7A2.5 2.5 0 0 0 21 15.5v-9z"/></svg>
        <span id="chat-feedback-badge" style="position: absolute; top: 8px; right: 8px; background: #ff3b3b; color: #fff; border-radius: 50%; width: 20px; height: 20px; display: flex; align-items: center; justify-content: center; font-size: 13px; font-weight: bold;">1</span>
    </button>
    <div id="chat-feedback-popup" style="display: none; position: absolute; left: 0; bottom: 70px; width: 320px; background: #fff; border-radius: 12px; box-shadow: 0 2px 16px rgba(0,0,0,0.18); padding: 18px;">
        <div style="font-size: 15px; color: #333; margin-bottom: 10px;">
            Após realizar a viagem volte neste chat para deixar a sua avaliação para a nossa aplicação, facilidade de acesso, acessibilidade e etc.
        </div>
        <div id="chat-feedback-list" style="max-height: 120px; overflow-y: auto; margin-bottom: 10px; font-size: 14px; color: #444;"></div>
        <textarea id="chat-feedback-text" placeholder="Deixe seu feedback aqui..." style="width: 100%; min-height: 60px; border-radius: 8px; border: 1px solid #ddd; padding: 8px; resize: vertical;"></textarea>
        <button id="chat-feedback-send" style="margin-top: 10px; background: #007bff; color: #fff; border: none; border-radius: 8px; padding: 8px 16px; cursor: pointer;">Enviar</button>
    </div>
    <style>
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-12px); }
        }
    </style>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var btn = document.getElementById('chat-feedback-btn');
        var popup = document.getElementById('chat-feedback-popup');
        var sendBtn = document.getElementById('chat-feedback-send');
        var textArea = document.getElementById('chat-feedback-text');
        var listDiv = document.getElementById('chat-feedback-list');
        btn.addEventListener('click', function() {
            popup.style.display = popup.style.display === 'none' ? 'block' : 'none';
            if (popup.style.display === 'block') {
                fetchFeedbacks();
            }
        });
        sendBtn.addEventListener('click', function() {
            var msg = textArea.value.trim();
            if (!msg) return;
            sendBtn.disabled = true;
            fetch('/api/feedbacks', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ mensagem: msg })
            })
            .then(res => res.json())
            .then(data => {
                textArea.value = '';
                sendBtn.disabled = false;
                fetchFeedbacks();
            })
            .catch(() => { sendBtn.disabled = false; });
        });
        function fetchFeedbacks() {
            fetch('/api/feedbacks')
                .then(res => res.json())
                .then(data => {
                    listDiv.innerHTML = '';
                    if (data.length === 0) {
                        listDiv.innerHTML = '<div style="color:#888;">Nenhum feedback enviado ainda.</div>';
                    } else {
                        data.forEach(fb => {
                            var el = document.createElement('div');
                            el.textContent = fb.mensagem + ' (' + new Date(fb.created_at).toLocaleDateString('pt-BR') + ')';
                            el.style.marginBottom = '6px';
                            listDiv.appendChild(el);
                        });
                    }
                });
        }
    });
</script>
