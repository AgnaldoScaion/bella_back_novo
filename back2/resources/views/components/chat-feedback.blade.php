<div id="chat-feedback" style="position: fixed; left: 25px; bottom: 25px; z-index: 900;">
  <button id="chat-feedback-btn" style="background: linear-gradient(135deg, #2d5016, #5a8f3d); border-radius: 50%; box-shadow: 0 4px 20px rgba(45, 80, 22, 0.3); width: 65px; height: 65px; display: flex; align-items: center; justify-content: center; border: none; cursor: pointer; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); position: relative; overflow: visible;">
    <div style="position: absolute; inset: 0; background: linear-gradient(135deg, rgba(255,255,255,0.1), transparent); border-radius: 50%;"></div>
    <svg width="28" height="28" fill="#fff" viewBox="0 0 24 24" style="z-index: 1; filter: drop-shadow(0 1px 2px rgba(0,0,0,0.2));"><path d="M20 6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2v2l3-2h7a2 2 0 0 0 2-2V6z"/></svg>
    <span id="chat-feedback-badge" style="position: absolute; top: -5px; left: -5px; background: linear-gradient(135deg, #f59e0b, #d97706); color: #fff; border-radius: 50%; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; font-size: 11px; font-weight: bold; border: 3px solid #fff; box-shadow: 0 2px 8px rgba(245, 158, 11, 0.4); animation: pulse-badge 2s infinite;"></span>
    <div id="chat-ripple" style="position: absolute; inset: 0; border-radius: 50%; background: rgba(255,255,255,0.3); transform: scale(0); transition: transform 0.3s ease;"></div>
  </button>

  <div id="chat-feedback-popup" style="display: none; position: fixed; left: 20px; bottom: 20px; width: min(420px, calc(100vw - 40px)); max-width: 420px; background: #fff; border-radius: 20px; box-shadow: 0 10px 40px rgba(45, 80, 22, 0.2), 0 0 0 1px rgba(45, 80, 22, 0.1); overflow: visible; max-height: calc(100vh - 80px); display: flex; flex-direction: column; transform: translateY(20px) scale(0.95); opacity: 0; transition: all 0.28s cubic-bezier(0.4, 0, 0.2, 1); backdrop-filter: blur(8px); z-index: 905;">
    <div style="background: linear-gradient(135deg, #2d5016, #5a8f3d); padding: 20px; color: #fff; position: relative; overflow: hidden;">
    <!-- Substituído data-URI problemático por overlay seguro (evita parsing/escape issues) -->
    <div style="position: absolute; inset: 0; background-image: radial-gradient(rgba(255,255,255,0.06) 1px, transparent 1px); background-size: 6px 6px; opacity: 0.18; pointer-events: none;"></div>
      <div style="position: relative; z-index: 1;">
        <h3 style="margin: 0; font-size: 20px; font-weight: 700; display: flex; align-items: center; gap: 10px;">
          🌟 Chat de Comentarios
        </h3>
        <p style="margin: 8px 0 0; font-size: 14px; opacity: 0.9; font-weight: 400;">Compartilhe suas experiências de viagem</p>
      </div>
    </div>

  <div style="display: flex; background: linear-gradient(135deg, #f8fdf8, #f3f7f3); border-bottom: 1px solid rgba(45, 80, 22, 0.1); padding: 6px;">
      <button class="feedback-tab active" data-category="geral" style="flex: 1; padding: 12px 8px; border: none; background: #fff; font-size: 13px; font-weight: 600; color: #2d5016; border-radius: 12px; cursor: pointer; margin: 0 2px; transition: all 0.3s ease; box-shadow: 0 2px 8px rgba(45, 80, 22, 0.1); position: relative; overflow: hidden;">
        <span style="position: relative; z-index: 1;">🌍 Geral</span>
        <div style="position: absolute; inset: 0; background: linear-gradient(135deg, rgba(45, 80, 22, 0.05), transparent); opacity: 0; transition: opacity 0.3s ease;"></div>
      </button>
      <button class="feedback-tab" data-category="restaurante" style="flex: 1; padding: 12px 8px; border: none; background: transparent; font-size: 13px; font-weight: 600; color: #6b7280; border-radius: 12px; cursor: pointer; margin: 0 2px; transition: all 0.3s ease; position: relative; overflow: hidden;">
        <span style="position: relative; z-index: 1;">🍽️ Restaurante</span>
        <div style="position: absolute; inset: 0; background: linear-gradient(135deg, rgba(45, 80, 22, 0.05), transparent); opacity: 0; transition: opacity 0.3s ease;"></div>
      </button>
      <button class="feedback-tab" data-category="hotel" style="flex: 1; padding: 12px 8px; border: none; background: transparent; font-size: 13px; font-weight: 600; color: #6b7280; border-radius: 12px; cursor: pointer; margin: 0 2px; transition: all 0.3s ease; position: relative; overflow: hidden;">
        <span style="position: relative; z-index: 1;">🏨 Hotel</span>
        <div style="position: absolute; inset: 0; background: linear-gradient(135deg, rgba(45, 80, 22, 0.05), transparent); opacity: 0; transition: opacity 0.3s ease;"></div>
      </button>
    </div>

  <div id="chat-feedback-list" style="flex: 1 1 auto; min-height: 0; max-height: 40vh; overflow-y: auto; padding: 12px 14px 18px 14px; background: linear-gradient(135deg, #f8fdf8, #f3f7f3); position: relative;">
      <div style="position: absolute; top: 0; left: 0; right: 0; height: 10px; background: linear-gradient(to bottom, rgba(248, 253, 248, 1), transparent); z-index: 1; pointer-events: none;"></div>
      <div style="position: absolute; bottom: 0; left: 0; right: 0; height: 10px; background: linear-gradient(to top, rgba(248, 253, 248, 1), transparent); z-index: 1; pointer-events: none;"></div>
    </div>

  <div style="padding: 14px 18px; background: #fff; border-top: 1px solid rgba(45, 80, 22, 0.04); flex-shrink: 0;">
      <select id="chat-feedback-category" style="width: 100%; padding: 12px 14px; border-radius: 10px; border: 1px solid rgba(45, 80, 22, 0.06); margin-bottom: 10px; font-size: 14px; color: #2d5016; background: linear-gradient(135deg, #f8fdf8, #fff); font-weight: 500; transition: all 0.2s ease; cursor: pointer;">
        <option value="geral">🌍 Experiência Geral</option>
        <option value="restaurante">🍽️ Restaurante</option>
        <option value="hotel">🏨 Hotel</option>
      </select>

      <input id="chat-feedback-location" placeholder="📍 Nome do local (ex: Restaurante Bella Vista)" style="width: 100%; padding: 12px 14px; border-radius: 10px; border: 1px solid rgba(45, 80, 22, 0.06); margin-bottom: 10px; font-size: 14px; color: #2d5016; background: linear-gradient(135deg, #f8fdf8, #fff); transition: all 0.2s ease; font-weight: 500;">

      <div style="margin-bottom: 12px; background: linear-gradient(135deg, #f8fdf8, #fff); padding: 12px; border-radius: 10px; border: 1px solid rgba(45, 80, 22, 0.06);">
        <label style="font-size: 13px; color: #2d5016; display: block; margin-bottom: 8px; font-weight: 600;">⭐ Como foi sua experiência?</label>
        <div id="rating-stars" style="display: flex; gap: 6px; justify-content: center;">
          <span class="star" data-rating="1" style="font-size: 28px; cursor: pointer; color: #e5e7eb; transition: all 0.2s ease;">★</span>
          <span class="star" data-rating="2" style="font-size: 28px; cursor: pointer; color: #e5e7eb; transition: all 0.2s ease;">★</span>
          <span class="star" data-rating="3" style="font-size: 28px; cursor: pointer; color: #e5e7eb; transition: all 0.2s ease;">★</span>
          <span class="star" data-rating="4" style="font-size: 28px; cursor: pointer; color: #e5e7eb; transition: all 0.2s ease;">★</span>
          <span class="star" data-rating="5" style="font-size: 28px; cursor: pointer; color: #e5e7eb; transition: all 0.2s ease;">★</span>
        </div>
      </div>

      <textarea id="chat-feedback-text" placeholder="✨ Conte-nos sobre sua experiência... O que mais te impressionou?" style="width: 100%; min-height: 80px; border-radius: 10px; border: 1px solid rgba(45, 80, 22, 0.06); padding: 12px; resize: vertical; font-size: 14px; color: #2d5016; background: linear-gradient(135deg, #f8fdf8, #fff); transition: all 0.2s ease; font-family: inherit; font-weight: 500; line-height: 1.5;"></textarea>

      <button id="chat-feedback-send" style="margin-top: 10px; width: 100%; background: linear-gradient(135deg, #2d5016, #5a8f3d); color: #fff; border: none; border-radius: 10px; padding: 12px; cursor: pointer; font-size: 15px; font-weight: 700; transition: all 0.2s ease; position: relative; overflow: hidden; box-shadow: 0 4px 12px rgba(45, 80, 22, 0.2);">
        <span style="position: relative; z-index: 1; display: flex; align-items: center; justify-content: center; gap: 8px;">
          <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
            <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
          </svg>
          Compartilhar Experiência
        </span>
        <div style="position: absolute; inset: 0; background: linear-gradient(135deg, rgba(255,255,255,0.12), transparent); opacity: 0; transition: opacity 0.2s ease;"></div>
      </button>
    </div>
  </div>
</div>

<style>
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

  @keyframes slideInUp {
    from {
      transform: translateY(20px) scale(0.95);
      opacity: 0;
    }
    to {
      transform: translateY(0) scale(1);
      opacity: 1;
    }
  }

  #chat-feedback-btn {
    animation: float 3s ease-in-out infinite;
  }

  #chat-feedback-btn:hover {
    transform: scale(1.1) translateY(-2px);
    box-shadow: 0 8px 30px rgba(45, 80, 22, 0.4);
  }

  #chat-feedback-btn:active #chat-ripple {
    animation: ripple 0.6s ease-out;
  }

  #chat-feedback-popup.show {
    transform: translateY(0) scale(1) !important;
    opacity: 1 !important;
  }

  /* quando oculto, não deve interceptar cliques */
  #chat-feedback-popup { pointer-events: none; max-height: calc(100vh - 40px); overflow-y: auto; }
  #chat-feedback-popup.show { pointer-events: auto; }

  /* Estrutura mais limpa para o componente */
  #chat-feedback { left: 20px; bottom: 20px; }
  #chat-feedback-btn { width: 64px; height: 64px; }
  #chat-feedback-badge { font-size: 11px; }

  /* popup structure */
  #chat-feedback-popup.cf-popup { width: 420px; max-height: 85vh; display: flex; flex-direction: column; }
  #chat-feedback-popup .cf-header { padding: 18px 20px; border-radius: 16px 16px 0 0; }
  #chat-feedback-popup .cf-tabs { display:flex; gap:8px; padding: 10px; }
  #chat-feedback-popup .cf-list { flex: 1; overflow-y: auto; padding: 18px; }
  #chat-feedback-popup .cf-footer { padding: 18px; border-top: 1px solid rgba(45,80,22,0.06); background: #fff; }

  /* visual tweaks */
  .cf-card { background:#fff; border-radius:12px; padding:14px; box-shadow: 0 6px 18px rgba(0,0,0,0.05); border:1px solid rgba(45,80,22,0.04); }
  .cf-avatar { width:44px;height:44px;border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700 }


  .feedback-tab:hover {
    background: #fff !important;
    color: #2d5016 !important;
    box-shadow: 0 4px 12px rgba(45, 80, 22, 0.15) !important;
    transform: translateY(-1px);
  }

  .feedback-tab:hover > div {
    opacity: 1 !important;
  }

  .feedback-tab.active {
    background: #fff !important;
    color: #2d5016 !important;
    box-shadow: 0 4px 12px rgba(45, 80, 22, 0.15) !important;
  }

  .star:hover, .star.active {
    color: #f59e0b !important;
    transform: scale(1.2);
    filter: drop-shadow(0 2px 4px rgba(245, 158, 11, 0.4));
  }

  .star:hover {
    animation: bounce 0.3s ease;
  }

  @keyframes bounce {
    0%, 100% { transform: scale(1.2); }
    50% { transform: scale(1.3); }
  }

  #chat-feedback-category:focus,
  #chat-feedback-location:focus,
  #chat-feedback-text:focus {
    border-color: #5a8f3d !important;
    box-shadow: 0 0 0 3px rgba(45, 80, 22, 0.1) !important;
    outline: none;
  }

  #chat-feedback-send:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(45, 80, 22, 0.4) !important;
  }

  #chat-feedback-send:hover > div {
    opacity: 1 !important;
  }

  #chat-feedback-send:active {
    transform: translateY(0);
  }

  #chat-feedback-list::-webkit-scrollbar {
    width: 6px;
  }

  #chat-feedback-list::-webkit-scrollbar-track {
    background: rgba(45, 80, 22, 0.05);
    border-radius: 10px;
  }

  #chat-feedback-list::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, #2d5016, #5a8f3d);
    border-radius: 10px;
    border: 1px solid rgba(255, 255, 255, 0.2);
  }

  #chat-feedback-list::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, #5a8f3d, #2d5016);
  }

  .feedback-message {
    transition: all 0.3s ease;
  }

  .feedback-message:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(45, 80, 22, 0.15) !important;
  }

  @media (max-width: 480px) {
    #chat-feedback-popup {
      width: calc(100vw - 30px) !important;
      left: 15px !important;
      bottom: 90px !important;
    }

    #chat-feedback-btn {
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

<script>
  document.addEventListener('DOMContentLoaded', () => {
    let rating = 0;
    let category = 'geral';
    const feedbacks = [
      { id: 1, user: 'Maria Santos', message: 'Plataforma incrível! Consegui organizar toda minha viagem em poucos cliques. Super recomendo! 🌟', category: 'geral', location: null, rating: 5, date: '2025-10-23' },
      { id: 2, user: 'João Pedro', message: 'Experiência gastronômica excepcional! O risotto de camarão estava divino e o atendimento impecável. Voltarei com certeza! 🍽️', category: 'restaurante', location: 'Restaurante Bella Vista', rating: 5, date: '2025-10-22' },
      { id: 3, user: 'Ana Clara', message: 'Hospedagem maravilhosa! Quartos espaçosos, vista para o mar e café da manhã com produtos locais fresquinhos. 🏨', category: 'hotel', location: 'Hotel Paraíso Tropical', rating: 5, date: '2025-10-21' },
      { id: 4, user: 'Carlos Miguel', message: 'Interface muito intuitiva e design moderno. Facilitou muito o planejamento da nossa lua de mel! 💕', category: 'geral', location: null, rating: 5, date: '2025-10-20' },
      { id: 5, user: 'Fernanda Lima', message: 'Ambiente aconchegante e pratos autorais deliciosos. A sobremesa de chocolate belga é imperdível! 🍫', category: 'restaurante', location: 'Bistrô do Chef', rating: 4, date: '2025-10-19' },
      { id: 6, user: 'Roberto Silva', message: 'Localização perfeita e staff super atencioso. A piscina na cobertura tem uma vista espetacular! 🏊‍♂️', category: 'hotel', location: 'Grand Hotel Central', rating: 5, date: '2025-10-18' },
      { id: 7, user: 'Luiza Costa', message: 'Encontrei opções incríveis que não conhecia! A funcionalidade de filtros é muito útil. 🔍', category: 'geral', location: null, rating: 4, date: '2025-10-17' },
      { id: 8, user: 'Daniel Oliveira', message: 'Comida italiana autêntica no coração da cidade! O ambiente romântico é perfeito para casais. 🇮🇹', category: 'restaurante', location: 'Trattoria Amore', rating: 5, date: '2025-10-16' }
    ];

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
        tabs.forEach(t => {
          t.classList.remove('active');
          t.style.background = 'transparent';
          t.style.color = '#6b7280';
          t.style.boxShadow = 'none';
        });
        tab.classList.add('active');
        tab.style.background = '#fff';
        tab.style.color = '#2d5016';
        tab.style.boxShadow = '0 2px 8px rgba(45, 80, 22, 0.1)';
        category = tab.dataset.category;
        categorySelect.value = category;
        renderFeedbacks();
      });
    });

    btn.addEventListener('click', () => {
      const isVisible = popup.classList.contains('show');
      if (isVisible) {
        popup.classList.remove('show');
        // desativa interações e esconde após transição
        setTimeout(() => {
          popup.style.display = 'none';
          popup.style.pointerEvents = 'none';
          btn.setAttribute('aria-expanded', 'false');
          // parar polling quando fechado
          if (pollInterval) { clearInterval(pollInterval); pollInterval = null; }
        }, 400);
      } else {
        popup.style.display = 'block';
        // permitir cliques enquanto visível
        popup.style.pointerEvents = 'auto';
        btn.setAttribute('aria-expanded', 'true');
        setTimeout(() => popup.classList.add('show'), 10);
        // ao abrir, buscar feedbacks reais e iniciar polling para simular multi-usuário
        fetchFeedbacks();
        if (!pollInterval) pollInterval = setInterval(fetchFeedbacks, 8000);
      }
    });

    // Fecha o chat ao clicar fora (adicionado uma vez, no escopo principal)
    // (listener já registrado aqui antes de outras ações)
    // NOTE: não remover esse listener — ele é único e controla fechamento global
    document.addEventListener('mousedown', function(e) {
      var chat = popup;
      var button = btn;
      if (chat && chat.classList.contains('show') && !chat.contains(e.target) && !button.contains(e.target)) {
        chat.classList.remove('show');
        setTimeout(() => {
          chat.style.display = 'none';
          chat.style.pointerEvents = 'none';
          button.setAttribute('aria-expanded', 'false');
          if (pollInterval) { clearInterval(pollInterval); pollInterval = null; }
        }, 400);
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
        // enviar 'mensagem' para compatibilidade com o controller (validação espera 'mensagem')
        body: JSON.stringify({ mensagem: msg, category: cat, location: loc || null, rating })
      })
      .then(res => {
        if (!res.ok) throw new Error('network');
        return res.json();
      })
      .then((saved) => {
        // Limpar formulário
        textArea.value = '';
        locationInput.value = '';
        rating = 0;
        stars.forEach(s => s.classList.remove('active'));
        // após salvar, re-sincronizar com servidor para refletir multiusuário
        sendBtn.disabled = false;
        sendBtn.textContent = 'Compartilhar Experiência';
        // buscar novamente (o endpoint retorna feedbacks com user)
        fetchFeedbacks();
      })
      .catch((err) => {
        console.error(err);
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
        <div style="text-align: center; padding: 40px 20px; color: #6b7280;">
          <div style="font-size: 48px; margin-bottom: 16px; opacity: 0.5;">
            ${category === 'geral' ? '🌍' : category === 'restaurante' ? '🍽️' : '🏨'}
          </div>
          <p style="font-size: 16px; font-weight: 600; color: #2d5016; margin-bottom: 8px;">Ainda não há experiências compartilhadas</p>
          <p style="font-size: 14px; opacity: 0.8;">Seja o primeiro a contar como foi sua experiência!</p>
        </div>
      `;

      filtered.slice(0, 6).forEach((f, index) => {
        const div = document.createElement('div');
        div.className = 'feedback-message';
        div.style.padding = '20px';
        div.style.background = '#fff';
        div.style.borderRadius = '16px';
        div.style.marginBottom = '16px';
        div.style.boxShadow = '0 4px 15px rgba(45, 80, 22, 0.1)';
        div.style.border = '1px solid rgba(45, 80, 22, 0.05)';
        div.style.opacity = '0';
        div.style.transform = 'translateY(20px)';
        div.style.transition = 'all 0.4s ease';
        const text = f.mensagem || f.message || f.text || '';
        const userName = (f.user && (f.user.name || f.user.email)) ? (f.user.name || f.user.email) : (f.user || 'Anônimo');
        const dateStr = f.created_at || f.date || f.createdAt || new Date().toISOString();
        div.innerHTML = `
          <div style="display: flex; gap: 14px; margin-bottom: 14px;">
            <div class="cf-avatar" style="background: linear-gradient(135deg, #2d5016, #5a8f3d);">
              ${(userName && userName[0]) ? userName[0].toUpperCase() : 'U'}
              <div style="position: absolute; inset: 0; background: linear-gradient(135deg, rgba(255,255,255,0.2), transparent); border-radius: 50%;"></div>
            </div>
            <div style="flex: 1;">
              <div style="font-weight: 700; font-size: 15px; color: #2d5016; margin-bottom: 2px;">${userName}</div>
              ${f.location ? `<div style="font-size: 13px; color: #5a8f3d; display: flex; align-items: center; gap: 4px;"><span>📍</span> ${f.location}</div>` : ''}
            </div>
            <div style="font-size: 12px; color: #6b7280; text-align: right;">${new Date(dateStr).toLocaleDateString('pt-BR')}</div>
          </div>
          <div style="color: #f59e0b; font-size: 18px; margin-bottom: 12px; filter: drop-shadow(0 1px 2px rgba(245, 158, 11, 0.3));">${'★'.repeat(f.rating || 0)}${'☆'.repeat(5-(f.rating||0))}</div>
          <div style="font-size: 14px; color: #374151; line-height: 1.6; background: linear-gradient(135deg, #f8fdf8, transparent); padding: 12px; border-radius: 12px; border-left: 3px solid #5a8f3d;">${text}</div>
        `;
        list.appendChild(div);

        // Animação de entrada
        setTimeout(() => {
          div.style.opacity = '1';
          div.style.transform = 'translateY(0)';
        }, index * 150);
      });
    // (antes aqui) o listener de clique fora foi movido para o escopo global para evitar múltiplas inscrições

    // Adicionar efeitos de hover nos elementos interativos
    const interactiveElements = [categorySelect, locationInput, textArea];
    interactiveElements.forEach(element => {
      element.addEventListener('focus', () => {
        element.style.transform = 'translateY(-1px)';
        element.style.boxShadow = '0 4px 15px rgba(45, 80, 22, 0.15)';
      });

      element.addEventListener('blur', () => {
        element.style.transform = 'translateY(0)';
        element.style.boxShadow = 'none';
      });
    });

      badge.textContent = feedbacks.length;
      badge.style.display = feedbacks.length ? 'flex' : 'none';
    }

    renderFeedbacks();
  });

    // busca feedbacks do servidor (GET) e atualiza estado local
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
        .catch(err => {
          // falha silenciosa — manter mock local
          console.warn('Não foi possível buscar /api/feedbacks', err);
          renderFeedbacks();
        });
    }
</script>
