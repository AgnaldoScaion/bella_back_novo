<style>
/* ... CSS do chat-feedback.css aqui ... */
@keyframes pulse-badge {
  0%, 100% { transform: scale(1); }
  50% { transform: scale(1.1); }
}
@keyframes float {
  0%, 100% { transform: translateY(0px); }
  50% { transform: translateY(-3px); }
}
@keyframes ripple {
  0% { transform: scale(0); opacity: 1; }
  100% { transform: scale(1); opacity: 0; }
}
@keyframes bounce {
  0%, 100% { transform: scale(1.2); }
  50% { transform: scale(1.3); }
}
.cf-fixed {
  position: fixed;
  left: 25px;
  bottom: 25px;
  z-index: 99999 !important;
  display: block !important;
}
.cf-btn {
  background: linear-gradient(135deg, #5a8f3d, #2d5016);
  border-radius: 50%;
  box-shadow: 0 4px 16px rgba(45,80,22,0.18), 0 0 0 2px #fff;
  width: 60px;
  height: 60px;
  display: flex;
  align-items: center;
  justify-content: center;
  border: 2px solid #fff;
  cursor: pointer;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  position: fixed;
  left: 30px !important;
  right: auto !important;
  bottom: 30px !important;
  animation: float 2.5s ease-in-out infinite;
  z-index: 100000 !important;
  visibility: visible !important;
  opacity: 1 !important;
}
.cf-btn:hover {
  transform: scale(1.08) translateY(-2px);
  box-shadow: 0 8px 24px rgba(45,80,22,0.22);
}
.cf-btn:active .cf-ripple {
  animation: ripple 0.6s ease-out;
}
.cf-btn-bg {
  position: absolute;
  inset: 0;
  background: linear-gradient(135deg, rgba(255,255,255,0.1), transparent);
  border-radius: 50%;
}
.cf-btn-icon {
  z-index: 1;
  filter: drop-shadow(0 1px 2px rgba(0,0,0,0.2));
}
.cf-badge {
  position: absolute;
  top: -5px;
  left: -5px;
  background: linear-gradient(135deg, #f59e0b, #d97706);
  color: #fff;
  border-radius: 50%;
  width: 24px;
  height: 24px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 11px;
  font-weight: bold;
  border: 3px solid #fff;
  box-shadow: 0 2px 8px rgba(245, 158, 11, 0.4);
  animation: pulse-badge 2s infinite;
}
.cf-ripple {
  position: absolute;
  inset: 0;
  border-radius: 50%;
  background: rgba(255,255,255,0.3);
  transform: scale(0);
  transition: transform 0.3s ease;
}
.cf-popup {
  background: #f8fdf8;
  border-radius: 18px;
  box-shadow: 0 12px 48px rgba(45,80,22,0.10), 0 0 0 2px #e5f2e5;
  border: 2px solid #e5f2e5;
  padding: 0;
  max-width: 380px;
  min-width: 220px;
  width: 100%;
  margin: 0;
  opacity: 1 !important;
}
.cf-popup.show {
  transform: translateY(0) scale(1) !important;
  opacity: 1 !important;
  display: flex !important;
  pointer-events: auto;
}
.cf-header {
  background: linear-gradient(135deg, #5a8f3d 80%, #e5f2e5 100%);
  color: #fff;
  border-radius: 18px 18px 0 0;
  box-shadow: 0 2px 12px rgba(45,80,22,0.10);
  padding: 18px 0 12px 0;
  font-size: 1.08em;
  min-height: 38px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  border-bottom: 2px solid #e5f2e5;
}
.cf-title {
  font-size: 17px;
  font-weight: 700;
  color: #2d5016;
  margin: 0;
  text-align: center;
}
.cf-subtitle {
  font-size: 13px;
  color: #6b7280;
  opacity: 0.85;
  margin: 2px 0 0 0;
  text-align: center;
}
.cf-header-content {
  display: flex;
  flex-direction: column;
  gap: 2px;
  align-items: center;
}
.cf-tabs {
  padding: 6px 0 6px 0;
  gap: 6px;
  border-radius: 0;
  background: #f7fafc;
  justify-content: center;
  display: flex;
}
.feedback-tab {
  font-size: 12px;
  padding: 6px 12px;
  border-radius: 8px;
  background: #fff;
  border: 1px solid #e5e7eb;
  color: #374151;
  min-width: 0;
  transition: background 0.2s, color 0.2s;
}
.feedback-tab.active, .feedback-tab:hover {
  background: #e5f2e5 !important;
  color: #2d5016 !important;
  border-color: #5a8f3d !important;
}
.cf-list {
  background: transparent;
  border-radius: 0;
  padding: 10px 8px 10px 8px;
  box-shadow: none;
  max-height: 30vh;
  min-height: 60px;
  overflow-y: auto;
}
.feedback-message.cf-card {
  background: #fff;
  border-radius: 10px;
  box-shadow: 0 2px 8px rgba(45,80,22,0.06);
  margin-bottom: 12px;
  padding: 10px 12px;
  opacity: 0;
  transform: translateY(6px);
  transition: all 0.2s;
  display: flex;
  flex-direction: column;
  gap: 6px;
}
.cf-avatar {
  background: #5a8f3d;
  color: #fff;
  font-weight: bold;
  font-size: 13px;
  width: 22px;
  height: 22px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-right: 8px;
}
.cf-footer {
  background: #fff;
  border-radius: 0 0 16px 16px;
  box-shadow: none;
  padding: 12px 12px 14px 12px;
  border-top: 1px solid #e5e7eb;
}
.cf-select, .cf-input, .cf-textarea {
  border-radius: 8px;
  font-size: 13px;
  padding: 7px 10px;
  margin-bottom: 7px;
  border: 1px solid #e5e7eb;
  background: #f7fafc;
  color: #374151;
}
.cf-select:focus, .cf-input:focus, .cf-textarea:focus {
  border-color: #5a8f3d;
  outline: none;
}
.cf-rating-box {
  margin-bottom: 7px;
  background: #f7fafc;
  padding: 7px;
  border-radius: 8px;
  border: 1px solid #e5e7eb;
}
.cf-label {
  font-size: 12px;
  color: #2d5016;
  margin-bottom: 4px;
}
.cf-stars {
  display: flex;
  gap: 4px;
  justify-content: center;
}
.star {
  font-size: 24px;
  cursor: pointer;
  color: #e5e7eb;
  transition: all 0.18s;
}
.star:hover, .star.active {
  color: #f59e0b !important;
  transform: scale(1.2);
  filter: drop-shadow(0 2px 4px rgba(245, 158, 11, 0.4));
  animation: bounce 0.3s ease;
}
.cf-send-btn {
  background: linear-gradient(90deg, #5a8f3d 80%, #3a6c2f 100%);
  color: #fff;
  border-radius: 8px;
  font-size: 13px;
  padding: 8px;
  margin-top: 6px;
  box-shadow: 0 2px 8px 0 rgba(45, 80, 22, 0.08);
  border: none;
  width: 100%;
  transition: background 0.2s;
}
.cf-send-btn:hover {
  background: linear-gradient(90deg, #3a6c2f 80%, #5a8f3d 100%);
}
@media (max-width: 600px) {
  .cf-popup {
    width: calc(100vw - 6px) !important;
    left: 3px !important;
    bottom: 50px !important;
    min-width: 0;
    max-width: 100vw;
  }
  .cf-header {
    padding: 8px 0 6px 0;
    font-size: 0.92em;
    min-height: 24px;
  }
  .cf-list {
    padding: 6px 2px 6px 2px;
    max-height: 22vh;
  }
  .cf-footer {
    padding: 8px 4px 10px 4px;
  }
}
@media (max-width: 400px) {
  .cf-popup {
    min-width: 0;
    max-width: 100vw;
    left: 0 !important;
    right: 0 !important;
  }
}
/* ...existing code... */

/* Adiciona estilo direto ao botão do toggle */
#chatToggle {
  background: linear-gradient(135deg, #5a8f3d, #2d5016) !important;
  border-radius: 50% !important;
  box-shadow: 0 4px 16px rgba(45,80,22,0.18), 0 0 0 2px #fff !important;
  width: 60px !important;
  height: 60px !important;
  border: 2px solid #fff !important;
  position: fixed !important;
  left: 30px !important;
  right: auto !important;
  bottom: 30px !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  z-index: 100000 !important;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
  opacity: 1 !important;
}
#chatToggle:hover {
  transform: scale(1.08) translateY(-2px) !important;
  box-shadow: 0 8px 24px rgba(45,80,22,0.22) !important;
}
#chatToggle svg {
  width: 28px !important;
  height: 28px !important;
  color: #fff !important;
}
#chatPopup {
  left: 30px !important;
  right: auto !important;
  bottom: 100px !important;
  position: fixed !important;
}

/* Ajusta o container interno do popup para garantir alinhamento à esquerda */
#chatPopup > div {
  margin-left: 0 !important;
  margin-right: auto !important;
}
#chat-tutorial {
  left: 100px !important;
  right: auto !important;
  bottom: 40px !important;
  position: fixed !important;
}
</style>

<!-- Chat Popup Tecnológico -->
<button id="chatToggle" style="position:fixed;bottom:30px;right:30px;z-index:999" class="bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white rounded-full p-4 shadow-lg transition-all duration-300 hover:scale-110">
    <svg id="chatIcon" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
    </svg>
    <svg id="closeIcon" class="w-8 h-8 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
    </svg>
</button>
<div id="chatPopup" style="display:none;position:fixed;bottom:100px;right:30px;z-index:1000;width:400px;max-width:calc(100vw - 40px);" class="">
    <div style="background:rgba(30,41,59,0.95);backdrop-filter:blur(8px);border-radius:18px;box-shadow:0 8px 32px rgba(0,0,0,0.18);border:1px solid #334155;overflow:hidden;display:flex;flex-direction:column;height:600px;">
        <div style="background:rgba(30,41,59,0.7);border-bottom:1px solid #334155;padding:14px 18px;display:flex;align-items:center;justify-content:space-between;">
            <div style="display:flex;align-items:center;gap:10px;">
                <div style="position:relative;">
                    <div style="width:38px;height:38px;border-radius:50%;background:linear-gradient(135deg,#a78bfa,#f472b6);display:flex;align-items:center;justify-content:center;color:#fff;font-weight:600;font-size:18px;">AI</div>
                    <div style="position:absolute;bottom:0;right:0;width:10px;height:10px;background:#4ade80;border-radius:50%;border:2px solid #1e293b;"></div>
                </div>
                <div>
                    <div style="color:#fff;font-weight:600;font-size:16px;">Assistente Virtual</div>
                    <div style="color:#4ade80;font-size:12px;">Online</div>
                </div>
            </div>
            <button id="minimizeChat" style="padding:6px;background:transparent;border:none;border-radius:8px;cursor:pointer;">
                <svg style="width:22px;height:22px;color:#cbd5e1;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
        </div>
        <div id="messagesArea" style="flex:1;overflow-y:auto;padding:18px 16px;display:flex;flex-direction:column;gap:10px;"></div>
        <div style="background:rgba(30,41,59,0.7);border-top:1px solid #334155;padding:14px 18px;">
            <form id="chatForm" style="display:flex;align-items:end;gap:10px;">
                <div style="flex:1;background:rgba(51,65,85,0.5);border-radius:12px;border:1px solid #64748b;">
                    <textarea id="messageInput" placeholder="Digite sua mensagem..." style="width:100%;background:transparent;color:#fff;padding:10px 12px;outline:none;resize:none;border:none;font-size:14px;max-height:80px;" rows="1"></textarea>
                </div>
                <button type="submit" id="sendButton" style="padding:10px;background:linear-gradient(90deg,#a78bfa,#f472b6);border:none;border-radius:12px;box-shadow:0 2px 8px #a78bfa44;cursor:pointer;">
                    <svg style="width:20px;height:20px;color:#fff;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                </button>
            </form>
        </div>
    </div>
</div>
<div id="chat-tutorial" style="position:fixed;right:100px;bottom:40px;z-index:99999;background:#fff;border-radius:12px;box-shadow:0 4px 16px rgba(45,80,22,0.10);border:2px solid #5a8f3d;padding:18px 22px;display:flex;align-items:center;gap:14px;animation:fade-in 1s;">
    <svg style="width:32px;height:32px;color:#5a8f3d;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
    </svg>
    <div style="color:#2d5016;font-size:16px;font-weight:600;">Clique no botão do chat para tirar dúvidas ou pedir ajuda! 👈</div>
    <button id="close-tutorial" style="background:transparent;border:none;font-size:22px;color:#5a8f3d;cursor:pointer;">&times;</button>
</div>
<script>
const chatToggle = document.getElementById('chatToggle');
const chatPopup = document.getElementById('chatPopup');
const minimizeChat = document.getElementById('minimizeChat');
const chatIcon = document.getElementById('chatIcon');
const closeIcon = document.getElementById('closeIcon');
const messagesArea = document.getElementById('messagesArea');
const chatForm = document.getElementById('chatForm');
const messageInput = document.getElementById('messageInput');
const sendButton = document.getElementById('sendButton');
let isOpen = false;
chatToggle.addEventListener('click', () => {
    isOpen = !isOpen;
    chatPopup.style.display = isOpen ? 'block' : 'none';
    chatIcon.classList.toggle('hidden');
    closeIcon.classList.toggle('hidden');
    if (isOpen) {
        loadMessages();
        setTimeout(() => messageInput.focus(), 200);
    }
});
minimizeChat.addEventListener('click', () => {
    isOpen = false;
    chatPopup.style.display = 'none';
    chatIcon.classList.remove('hidden');
    closeIcon.classList.add('hidden');
});
document.addEventListener('mousedown', function(e) {
    if (isOpen && chatPopup.style.display === 'block') {
        if (!chatPopup.contains(e.target) && !chatToggle.contains(e.target)) {
            isOpen = false;
            chatPopup.style.display = 'none';
            chatIcon.classList.remove('hidden');
            closeIcon.classList.add('hidden');
        }
    }
});
const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
async function loadMessages() {
    try {
        const response = await fetch('/chat/messages', {
            headers: { 'X-CSRF-TOKEN': csrfToken }
        });
        const messages = await response.json();
        messagesArea.innerHTML = '';
        messages.forEach(msg => addMessageToUI(msg));
        scrollToBottom();
    } catch (error) { console.error('Erro ao carregar mensagens:', error); }
}
chatForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    const message = messageInput.value.trim();
    if (!message) return;
    messageInput.value = '';
    sendButton.disabled = true;
    try {
        showTypingIndicator();
        const response = await fetch('/chat/send', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ message })
        });
        const data = await response.json();
        removeTypingIndicator();
        addMessageToUI(data.userMessage, true);
        setTimeout(() => {
            addMessageToUI(data.botMessage, true);
            scrollToBottom();
        }, 500);
    } catch (error) {
        console.error('Erro ao enviar mensagem:', error);
        removeTypingIndicator();
    } finally {
        sendButton.disabled = false;
        messageInput.focus();
    }
});
function addMessageToUI(message, animate = false) {
    const messageDiv = document.createElement('div');
    messageDiv.className = `flex ${message.sender === 'user' ? 'justify-end' : 'justify-start'}${animate ? ' animate-fade-in' : ''}`;
    messageDiv.innerHTML = `
        <div style="max-width:80%;border-radius:12px;padding:10px 14px;${message.sender === 'user' ? 'background:linear-gradient(90deg,#e5f2e5 80%,#5a8f3d 100%);color:#2d5016;border-bottom-right-radius:6px;' : 'background:#f3f7f3;color:#374151;border-bottom-left-radius:6px;'}">
            <div style="font-size:14px;line-height:1.5;">${escapeHtml(message.text)}</div>
            <div style="font-size:11px;margin-top:4px;${message.sender === 'user' ? 'color:#c6f6d5;' : 'color:#94a3b8;'}">${message.time}</div>
        </div>
    `;
    messagesArea.appendChild(messageDiv);
    scrollToBottom();
}
function showTypingIndicator() {
    const typingDiv = document.createElement('div');
    typingDiv.id = 'typingIndicator';
    typingDiv.className = 'flex justify-start animate-fade-in';
    typingDiv.innerHTML = `<div style='background:rgba(51,65,85,0.7);border-radius:12px;border-bottom-left-radius:4px;padding:10px 14px;'><div style='display:flex;gap:3px;'><div style='width:8px;height:8px;background:#94a3b8;border-radius:50%;animation:bounce 0.6s infinite;'></div><div style='width:8px;height:8px;background:#94a3b8;border-radius:50%;animation:bounce 0.6s infinite 0.2s;'></div><div style='width:8px;height:8px;background:#94a3b8;border-radius:50%;animation:bounce 0.6s infinite 0.4s;'></div></div></div>`;
    messagesArea.appendChild(typingDiv);
    scrollToBottom();
}
function removeTypingIndicator() {
    const indicator = document.getElementById('typingIndicator');
    if (indicator) indicator.remove();
}
function scrollToBottom() {
    messagesArea.scrollTop = messagesArea.scrollHeight;
}
function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}
messageInput.addEventListener('keypress', (e) => {
    if (e.key === 'Enter' && !e.shiftKey) {
        e.preventDefault();
        chatForm.dispatchEvent(new Event('submit'));
    }
});
setTimeout(() => {
  const tutorial = document.getElementById('chat-tutorial');
  if (tutorial) tutorial.style.display = 'flex';
}, 1200);
document.getElementById('chatToggle').addEventListener('click', () => {
  const tutorial = document.getElementById('chat-tutorial');
  if (tutorial) tutorial.style.display = 'none';
});
document.getElementById('close-tutorial').addEventListener('click', () => {
  const tutorial = document.getElementById('chat-tutorial');
  if (tutorial) tutorial.style.display = 'none';
});
</script>
<!-- Fim do Chat Popup -->
