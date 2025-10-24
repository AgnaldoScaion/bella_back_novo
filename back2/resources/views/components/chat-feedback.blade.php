
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
  background: linear-gradient(135deg, #2d5016, #5a8f3d);
  border-radius: 50%;
  box-shadow: 0 4px 20px rgba(45, 80, 22, 0.3);
  width: 65px;
  height: 65px;
  display: flex;
  align-items: center;
  justify-content: center;
  border: none;
  cursor: pointer;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  position: relative;
  overflow: visible;
  animation: float 3s ease-in-out infinite;
  z-index: 100000 !important;
  display: flex !important;
  visibility: visible !important;
  opacity: 1 !important;
}
.cf-btn:hover {
  transform: scale(1.1) translateY(-2px);
  box-shadow: 0 8px 30px rgba(45, 80, 22, 0.4);
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
  display: none;
  position: fixed;
  left: 20px;
  bottom: 15px;
  width: min(420px, calc(100vw - 40px));
  max-width: 420px;
  background: rgba(30,40,30,0.82);
  border-radius: 32px;
  box-shadow: 0 10px 40px 0 rgba(45, 80, 22, 0.25), 0 0 0 1.5px #5a8f3d;
  overflow: visible;
  max-height: calc(100vh - 60px);
  display: flex;
  flex-direction: column;
  transform: translateY(20px) scale(0.97);
  opacity: 0;
  transition: all 0.22s cubic-bezier(0.4, 0, 0.2, 1);
  backdrop-filter: blur(16px) saturate(1.2);
  z-index: 100001 !important;
  border: 1.5px solid #5a8f3d;
  visibility: visible !important;
  opacity: 1 !important;
}
.cf-popup.show {
  transform: translateY(0) scale(1) !important;
  opacity: 1 !important;
  display: flex !important;
  pointer-events: auto;
}
.cf-header {
  background: linear-gradient(135deg, #2d5016, #5a8f3d);
  padding: 20px;
  color: #fff;
  position: relative;
  overflow: hidden;
  border-radius: 32px 32px 0 0;
}
.cf-header-bg {
  position: absolute;
  inset: 0;
  background-image: radial-gradient(rgba(255,255,255,0.06) 1px, transparent 1px);
  background-size: 6px 6px;
  opacity: 0.18;
  pointer-events: none;
}
.cf-header-content {
  position: relative;
  z-index: 1;
}
.cf-title {
  margin: 0;
  font-size: 20px;
  font-weight: 700;
  display: flex;
  align-items: center;
  gap: 10px;
}
.cf-subtitle {
  margin: 8px 0 0;
  font-size: 14px;
  opacity: 0.9;
  font-weight: 400;
}
.cf-tabs {
  display: flex;
  background: linear-gradient(135deg, #f8fdf8, #f3f7f3);
  border-bottom: 1px solid rgba(45, 80, 22, 0.1);
  padding: 6px;
  gap: 8px;
}
.feedback-tab {
  flex: 1;
  padding: 12px 8px;
  border: none;
  background: transparent;
  font-size: 13px;
  font-weight: 600;
  color: #6b7280;
  border-radius: 12px;
  cursor: pointer;
  margin: 0 2px;
  transition: all 0.3s ease;
  position: relative;
  overflow: hidden;
}
.feedback-tab.active {
  background: #fff !important;
  color: #2d5016 !important;
  box-shadow: 0 4px 12px rgba(45, 80, 22, 0.15) !important;
}
.feedback-tab:hover {
  background: #fff !important;
  color: #2d5016 !important;
  box-shadow: 0 4px 12px rgba(45, 80, 22, 0.15) !important;
  transform: translateY(-1px);
}
.cf-list {
  flex: 1 1 auto;
  min-height: 0;
  max-height: 32vh;
  overflow-y: auto;
  padding: 6px 8px 8px 8px;
  background: linear-gradient(135deg, rgba(60,80,60,0.10), rgba(40,60,40,0.08));
  position: relative;
  border-radius: 24px 24px 0 0;
}
.cf-footer {
  padding: 12px 16px 16px 16px;
  background: rgba(255,255,255,0.92);
  border-top: 1.5px solid #5a8f3d;
  border-radius: 0 0 32px 32px;
  flex-shrink: 0;
  box-shadow: 0 2px 12px 0 rgba(45,80,22,0.07);
}
.cf-select, .cf-input, .cf-textarea {
  width: 100%;
  padding: 10px 12px;
  border-radius: 16px;
  border: 1.5px solid #5a8f3d;
  margin-bottom: 8px;
  font-size: 14px;
  color: #2d5016;
  background: linear-gradient(135deg, #f8fdf8, #fff);
  font-weight: 500;
  transition: all 0.2s;
  box-shadow: 0 1px 4px 0 rgba(45,80,22,0.06);
}
.cf-rating-box {
  margin-bottom: 8px;
  background: linear-gradient(135deg, #f8fdf8, #fff);
  padding: 10px;
  border-radius: 16px;
  border: 1.5px solid #5a8f3d;
  box-shadow: 0 1px 4px 0 rgba(45,80,22,0.06);
}
.cf-label {
  font-size: 13px;
  color: #2d5016;
  display: block;
  margin-bottom: 6px;
  font-weight: 600;
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
  margin-top: 8px;
  width: 100%;
  background: linear-gradient(135deg, #2d5016 60%, #5a8f3d 100%);
  color: #fff;
  border: none;
  border-radius: 16px;
  padding: 12px;
  cursor: pointer;
  font-size: 15px;
  font-weight: 700;
  transition: all 0.18s;
  position: relative;
  overflow: hidden;
  box-shadow: 0 4px 16px 0 rgba(45, 80, 22, 0.18);
  letter-spacing: 0.5px;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
}
.cf-send-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(45, 80, 22, 0.4) !important;
}
.cf-send-btn:active {
  transform: translateY(0);
}
@media (max-width: 480px) {
  .cf-popup {
    width: calc(100vw - 30px) !important;
    left: 15px !important;
    bottom: 90px !important;
  }
  .cf-btn {
    width: 55px !important;
    height: 55px !important;
    left: 20px !important;
    bottom: 20px !important;
  }
  .feedback-tab {
    font-size: 11px !important;
    padding: 10px 6px !important;
  }
}
@media (max-width: 360px) {
  .feedback-tab span {
    font-size: 10px !important;
  }
}
</style>

<div id="chat-feedback" class="cf-fixed">
  <button id="chat-feedback-btn" class="cf-btn" aria-label="Abrir chat de comentários">
    <span class="cf-btn-bg"></span>
    <!-- Ícone de chat -->
    <svg width="32" height="32" fill="#fff" viewBox="0 0 24 24" class="cf-btn-icon"><path d="M12 3C6.48 3 2 6.92 2 12c0 2.08.8 3.98 2.13 5.5L2 21l3.67-1.1C7.6 20.6 9.72 21 12 21c5.52 0 10-3.92 10-9s-4.48-9-10-9zm0 16c-2.01 0-3.89-.5-5.33-1.36l-.38-.23-2.09.62.62-2.09-.23-.38C4.5 15.89 4 13.99 4 12c0-4.08 4.03-7 8-7s8 2.92 8 7-4.03 7-8 7z"/></svg>
    <span id="chat-feedback-badge" class="cf-badge"></span>
    <span id="chat-ripple" class="cf-ripple"></span>
  </button>

  <div id="chat-feedback-popup" class="cf-popup" style="display: none;">
    <div class="cf-header">
      <span class="cf-header-bg"></span>
      <button id="chat-feedback-close" style="position:absolute;top:12px;right:16px;background:transparent;border:none;color:#fff;font-size:22px;cursor:pointer;z-index:2;line-height:1;">&times;</button>
      <div class="cf-header-content">
        <h3 class="cf-title">🌟 Chat de Comentários</h3>
        <p class="cf-subtitle">Compartilhe suas experiências de viagem</p>
      </div>
    </div>
    <div class="cf-tabs">
      <button class="feedback-tab active" data-category="geral"><span>🌍 Geral</span></button>
      <button class="feedback-tab" data-category="restaurante"><span>🍽️ Restaurante</span></button>
      <button class="feedback-tab" data-category="hotel"><span>🏨 Hotel</span></button>
    </div>
    <div id="chat-feedback-list" class="cf-list"></div>
    <div class="cf-footer">
      <select id="chat-feedback-category" class="cf-select">
        <option value="geral">🌍 Experiência Geral</option>
        <option value="restaurante">🍽️ Restaurante</option>
        <option value="hotel">🏨 Hotel</option>
      </select>
      <input id="chat-feedback-location" class="cf-input" placeholder="📍 Nome do local (ex: Restaurante Bella Vista)">
      <div class="cf-rating-box">
        <label class="cf-label">⭐ Como foi sua experiência?</label>
        <div id="rating-stars" class="cf-stars">
          <span class="star" data-rating="1">★</span>
          <span class="star" data-rating="2">★</span>
          <span class="star" data-rating="3">★</span>
          <span class="star" data-rating="4">★</span>
          <span class="star" data-rating="5">★</span>
        </div>
      </div>
      <textarea id="chat-feedback-text" class="cf-textarea" placeholder="✨ Conte-nos sobre sua experiência... O que mais te impressionou?"></textarea>
      <button id="chat-feedback-send" class="cf-send-btn">
        <span class="flex items-center gap-2">
          <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/></svg>
          Compartilhar Experiência
        </span>
      </button>
    </div>
  </div>
</div>

<script>
// Chat Feedback Component JS - inline
document.addEventListener('DOMContentLoaded', () => {
  let rating = 0;
  let category = 'geral';
  // Experiências mock para exibição inicial
  const feedbacks = [
    { user: 'Maria Santos', mensagem: 'Plataforma incrível! Consegui organizar toda minha viagem em poucos cliques. Super recomendo! 🌟', category: 'geral', location: null, rating: 5, date: '2025-10-23' },
    { user: 'João Pedro', mensagem: 'Experiência gastronômica excepcional! O risotto de camarão estava divino e o atendimento impecável. Voltarei com certeza! 🍽️', category: 'restaurante', location: 'Restaurante Bella Vista', rating: 5, date: '2025-10-22' },
    { user: 'Ana Clara', mensagem: 'Hospedagem maravilhosa! Quartos espaçosos, vista para o mar e café da manhã com produtos locais fresquinhos. 🏨', category: 'hotel', location: 'Hotel Paraíso Tropical', rating: 5, date: '2025-10-21' },
    { user: 'Carlos Miguel', mensagem: 'Interface muito intuitiva e design moderno. Facilitou muito o planejamento da nossa lua de mel! 💕', category: 'geral', location: null, rating: 5, date: '2025-10-20' },
    { user: 'Fernanda Lima', mensagem: 'Ambiente aconchegante e pratos autorais deliciosos. A sobremesa de chocolate belga é imperdível! 🍫', category: 'restaurante', location: 'Bistrô do Chef', rating: 4, date: '2025-10-19' },
    { user: 'Roberto Silva', mensagem: 'Localização perfeita e staff super atencioso. A piscina na cobertura tem uma vista espetacular! 🏊‍♂️', category: 'hotel', location: 'Grand Hotel Central', rating: 5, date: '2025-10-18' },
    { user: 'Luiza Costa', mensagem: 'Encontrei opções incríveis que não conhecia! A funcionalidade de filtros é muito útil. 🔍', category: 'geral', location: null, rating: 4, date: '2025-10-17' },
    { user: 'Daniel Oliveira', mensagem: 'Comida italiana autêntica no coração da cidade! O ambiente romântico é perfeito para casais. 🇮🇹', category: 'restaurante', location: 'Trattoria Amore', rating: 5, date: '2025-10-16' }
  ];
  // Botão X fecha o chat
  const closeBtn = document.getElementById('chat-feedback-close');
  if (closeBtn) {
    closeBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      popup.classList.remove('show');
      setTimeout(() => {
        popup.style.display = 'none';
        popup.style.pointerEvents = 'none';
        btn.setAttribute('aria-expanded', 'false');
        if (pollInterval) { clearInterval(pollInterval); pollInterval = null; }
      }, 100);
    });
  }
  const btn = document.getElementById('chat-feedback-btn');
  const popup = document.getElementById('chat-feedback-popup');
  const sendBtn = document.getElementById('chat-feedback-send');
  const textArea = document.getElementById('chat-feedback-text');
  const categorySelect = document.getElementById('chat-feedback-category');
  const locationInput = document.getElementById('chat-feedback-location');
  const list = document.getElementById('chat-feedback-list');
  const badge = document.getElementById('chat-feedback-badge');
  const tabs = document.querySelectorAll('.feedback-tab');
  const stars = document.querySelectorAll('.star');
  let pollInterval = null;

  stars.forEach(star => {
    star.addEventListener('click', () => {
      rating = parseInt(star.dataset.rating);
      stars.forEach((s, i) => s.classList.toggle('active', i < rating));
    });
  });

  tabs.forEach(tab => {
    tab.addEventListener('click', () => {
      tabs.forEach(t => t.classList.remove('active'));
      tab.classList.add('active');
      category = tab.dataset.category;
      categorySelect.value = category;
      renderFeedbacks();
    });
  });

  btn.addEventListener('click', (e) => {
    e.stopPropagation();
    const isVisible = popup.classList.contains('show');
    if (isVisible) {
      popup.classList.remove('show');
      setTimeout(() => {
        popup.style.display = 'none';
        popup.style.pointerEvents = 'none';
        btn.setAttribute('aria-expanded', 'false');
        if (pollInterval) { clearInterval(pollInterval); pollInterval = null; }
      }, 200);
    } else {
      popup.style.display = 'flex';
      popup.style.pointerEvents = 'auto';
      btn.setAttribute('aria-expanded', 'true');
      setTimeout(() => popup.classList.add('show'), 10);
      fetchFeedbacks();
      if (!pollInterval) pollInterval = setInterval(fetchFeedbacks, 8000);
    }
  });

  // Fecha o chat ao clicar em qualquer lugar fora do popup
  document.addEventListener('mousedown', function(e) {
    if (popup && popup.classList.contains('show')) {
      if (!popup.contains(e.target) && !btn.contains(e.target)) {
        popup.classList.remove('show');
        setTimeout(() => {
          popup.style.display = 'none';
          popup.style.pointerEvents = 'none';
          btn.setAttribute('aria-expanded', 'false');
          if (pollInterval) { clearInterval(pollInterval); pollInterval = null; }
        }, 100);
      }
    }
  });

  sendBtn.addEventListener('click', () => {
    const msg = textArea.value.trim();
    const cat = categorySelect.value;
    const loc = locationInput.value.trim();
    if (!msg || !rating) return alert('Preencha o feedback e a avaliação!');
    if ((cat === 'restaurante' || cat === 'hotel') && !loc) return alert('Informe o nome do local!');
    sendBtn.disabled = true;
    sendBtn.textContent = 'Enviando...';
    fetch('/api/feedbacks', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      },
      body: JSON.stringify({ mensagem: msg, category: cat, location: loc || null, rating })
    })
    .then(res => {
      if (!res.ok) throw new Error('network');
      return res.json();
    })
    .then(() => {
      textArea.value = '';
      locationInput.value = '';
      rating = 0;
      stars.forEach(s => s.classList.remove('active'));
      sendBtn.disabled = false;
      sendBtn.textContent = 'Compartilhar Experiência';
      fetchFeedbacks();
    })
    .catch(() => {
      sendBtn.disabled = false;
      sendBtn.textContent = 'Compartilhar Experiência';
      alert('Erro ao enviar. Tente novamente.');
    });
  });

  function renderFeedbacks() {
    let filtered = feedbacks;
    if (category && filtered.some(f => f.category)) {
      filtered = feedbacks.filter(f => f.category === category);
    }
    list.innerHTML = filtered.length ? '' : `
      <div class="cf-empty">
        <div class="cf-empty-icon">
          ${category === 'geral' ? '🌍' : category === 'restaurante' ? '🍽️' : '🏨'}
        </div>
        <p class="cf-empty-title">Ainda não há experiências compartilhadas</p>
        <p class="cf-empty-desc">Seja o primeiro a contar como foi sua experiência!</p>
      </div>
    `;
    filtered.slice(0, 6).forEach((f, index) => {
      const div = document.createElement('div');
      div.className = 'feedback-message cf-card';
      const text = f.mensagem || f.message || f.text || '';
      const userName = (f.user && (f.user.name || f.user.email)) ? (f.user.name || f.user.email) : (f.user || 'Anônimo');
      const dateStr = f.created_at || f.date || f.createdAt || new Date().toISOString();
      div.innerHTML = `
        <div style="display: flex; gap: 14px; margin-bottom: 14px;">
          <div class="cf-avatar">
            ${(userName && userName[0]) ? userName[0].toUpperCase() : 'U'}
          </div>
          <div style="flex: 1;">
            <div style="font-weight: 700; font-size: 15px; color: #2d5016; margin-bottom: 2px;">${userName}</div>
            ${f.location ? `<div style=\"font-size: 13px; color: #5a8f3d; display: flex; align-items: center; gap: 4px;\"><span>📍</span> ${f.location}</div>` : ''}
          </div>
          <div style="font-size: 12px; color: #6b7280; text-align: right;">${new Date(dateStr).toLocaleDateString('pt-BR')}</div>
        </div>
        <div style="color: #f59e0b; font-size: 18px; margin-bottom: 12px; filter: drop-shadow(0 1px 2px rgba(245, 158, 11, 0.3));">${'★'.repeat(f.rating || 0)}${'☆'.repeat(5-(f.rating||0))}</div>
        <div style="font-size: 14px; color: #374151; line-height: 1.6; background: linear-gradient(135deg, #f8fdf8, transparent); padding: 12px; border-radius: 12px; border-left: 3px solid #5a8f3d;">${text}</div>
      `;
      list.appendChild(div);
      setTimeout(() => {
        div.style.opacity = '1';
        div.style.transform = 'translateY(0)';
      }, index * 150);
    });
    badge.textContent = feedbacks.length;
    badge.style.display = feedbacks.length ? 'flex' : 'none';
  }

  function fetchFeedbacks() {
    fetch('/api/feedbacks')
      .then(r => {
        if (!r.ok) throw new Error('network');
        return r.json();
      })
      .then(data => {
        let arr = [];
        if (Array.isArray(data)) {
          arr = data;
        } else if (data && Array.isArray(data.data)) {
          arr = data.data;
        } else if (data && Array.isArray(data.feedbacks)) {
          arr = data.feedbacks;
        }
        if (arr.length) {
          feedbacks.length = 0;
          arr.forEach(item => {
            feedbacks.push({
              id: item.id,
              user: item.user ? (item.user.name || item.user.email || 'Usuário') : (item.user_name || 'Usuário'),
              mensagem: item.mensagem || item.message || item.text || '',
              message: item.mensagem || item.message || item.text || '',
              category: item.category || 'geral',
              location: item.location || item.local || null,
              rating: item.rating || 0,
              date: item.created_at || item.date || new Date().toISOString()
            });
          });
        }
        renderFeedbacks();
      })
      .catch(() => {
        renderFeedbacks();
      });
  }

  renderFeedbacks();
});
</script>
