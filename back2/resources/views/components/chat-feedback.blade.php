<div id="chat-feedback" style="position: fixed; left: 20px; bottom: 20px; z-index: 1000;">
  <button id="chat-feedback-btn" style="background: linear-gradient(135deg, #6b7280, #4b5563); border-radius: 50%; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2); width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; border: none; cursor: pointer;">
    <svg width="24" height="24" fill="#fff" viewBox="0 0 24 24"><path d="M20 6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2v2l3-2h7a2 2 0 0 0 2-2V6z"/></svg>
    <span id="chat-feedback-badge" style="position: absolute; top: 0; right: 0; background: #f59e0b; color: #fff; border-radius: 50%; width: 20px; height: 20px; display: flex; align-items: center; justify-content: center; font-size: 10px; font-weight: bold;"></span>
  </button>

  <div id="chat-feedback-popup" style="display: none; position: absolute; left: 0; bottom: 60px; width: 360px; background: #fff; border-radius: 12px; box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15); overflow: hidden; max-height: 80vh; display: flex; flex-direction: column;">
    <div style="background: linear-gradient(135deg, #6b7280, #4b5563); padding: 12px; color: #fff;">
      <h3 style="margin: 0; font-size: 16px; font-weight: 600;">💬 Feedback</h3>
      <p style="margin: 4px 0 0; font-size: 12px; opacity: 0.8;">Conte como foi sua experiência</p>
    </div>

    <div style="display: flex; background: #f3f4f6; border-bottom: 1px solid #d1d5db;">
      <button class="feedback-tab active" data-category="geral" style="flex: 1; padding: 8px; border: none; background: #fff; font-size: 12px; font-weight: 500; color: #4b5563; border-bottom: 2px solid #6b7280; cursor: pointer;">🌍 Geral</button>
      <button class="feedback-tab" data-category="restaurante" style="flex: 1; padding: 8px; border: none; background: none; font-size: 12px; font-weight: 500; color: #6b7280; cursor: pointer;">🍽️ Restaurante</button>
      <button class="feedback-tab" data-category="hotel" style="flex: 1; padding: 8px; border: none; background: none; font-size: 12px; font-weight: 500; color: #6b7280; cursor: pointer;">🏨 Hotel</button>
    </div>

  <div id="chat-feedback-list" style="max-height: 240px; overflow-y: auto; padding: 18px 14px; background: #f3f4f6;"></div>

    <div style="padding: 10px; background: #fff; border-top: 1px solid #d1d5db;">
      <select id="chat-feedback-category" style="width: 100%; padding: 8px; border-radius: 8px; border: 1px solid #d1d5db; margin-bottom: 8px; font-size: 14px; color: #374151;">
        <option value="geral">🌍 Geral</option>
        <option value="restaurante">🍽️ Restaurante</option>
        <option value="hotel">🏨 Hotel</option>
      </select>

      <input id="chat-feedback-location" placeholder="Nome do local (ex: Restaurante X)" style="width: 100%; padding: 8px; border-radius: 8px; border: 1px solid #d1d5db; margin-bottom: 8px; font-size: 14px; color: #374151;">

      <div style="margin-bottom: 8px;">
        <label style="font-size: 12px; color: #6b7280; display: block; margin-bottom: 4px;">⭐ Avaliação:</label>
        <div id="rating-stars" style="display: flex; gap: 4px;">
          <span class="star" data-rating="1" style="font-size: 24px; cursor: pointer; color: #d1d5db;">★</span>
          <span class="star" data-rating="2" style="font-size: 24px; cursor: pointer; color: #d1d5db;">★</span>
          <span class="star" data-rating="3" style="font-size: 24px; cursor: pointer; color: #d1d5db;">★</span>
          <span class="star" data-rating="4" style="font-size: 24px; cursor: pointer; color: #d1d5db;">★</span>
          <span class="star" data-rating="5" style="font-size: 24px; cursor: pointer; color: #d1d5db;">★</span>
        </div>
      </div>

      <textarea id="chat-feedback-text" placeholder="Escreva sua experiência..." style="width: 100%; min-height: 60px; border-radius: 8px; border: 1px solid #d1d5db; padding: 8px; resize: vertical; font-size: 14px; color: #374151;"></textarea>

      <button id="chat-feedback-send" style="margin-top: 8px; width: 100%; background: linear-gradient(135deg, #6b7280, #4b5563); color: #fff; border: none; border-radius: 8px; padding: 10px; cursor: pointer; font-size: 14px; font-weight: 600;">Enviar Feedback</button>
    </div>
  </div>
</div>

<style>
  #chat-feedback-btn:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
  }

  .feedback-tab:hover, .feedback-tab.active {
    background: #fff;
    color: #4b5563;
    border-bottom: 2px solid #6b7280;
  }

  .star:hover, .star.active {
    color: #f59e0b;
  }

  #chat-feedback-list::-webkit-scrollbar {
    width: 5px;
  }

  #chat-feedback-list::-webkit-scrollbar-track {
    background: #e5e7eb;
    border-radius: 5px;
  }

  #chat-feedback-list::-webkit-scrollbar-thumb {
    background: #6b7280;
    border-radius: 5px;
  }

  @media (max-width: 480px) {
    #chat-feedback-popup {
      width: calc(100vw - 20px);
      left: 10px;
    }
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    let rating = 0;
    let category = 'geral';
    const feedbacks = [
      { id: 1, user: 'Maria S.', message: 'App bem intuitivo, planejei minha viagem rapidinho!', category: 'geral', location: null, rating: 5, date: '2025-10-20' },
      { id: 2, user: 'João P.', message: 'Comida top, atendimento nota 10. O risotto é imperdível!', category: 'restaurante', location: 'Restaurante Bella', rating: 5, date: '2025-10-19' },
      { id: 3, user: 'Ana C.', message: 'Hotel ótimo, quartos amplos e café da manhã delicioso.', category: 'hotel', location: 'Hotel Paraíso', rating: 5, date: '2025-10-18' },
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
          t.style.borderBottom = '2px solid transparent';
          t.style.background = 'none';
        });
        tab.classList.add('active');
        tab.style.borderBottom = '2px solid #6b7280';
        tab.style.background = '#fff';
        category = tab.dataset.category;
        categorySelect.value = category;
        renderFeedbacks();
      });
    });

    btn.addEventListener('click', () => {
      popup.style.display = popup.style.display === 'none' ? 'block' : 'none';
      if (popup.style.display === 'block') renderFeedbacks();
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
        body: JSON.stringify({ message: msg, category: cat, location: loc || null, rating })
      })
      .then(res => res.json())
      .then(() => {
        textArea.value = '';
        locationInput.value = '';
        rating = 0;
        stars.forEach(s => s.classList.remove('active'));
        sendBtn.disabled = false;
        sendBtn.textContent = 'Enviar Feedback';
        renderFeedbacks();
      })
      .catch(() => {
        sendBtn.disabled = false;
        sendBtn.textContent = 'Enviar Feedback';
        alert('Erro ao enviar. Tente novamente.');
      });
    });

    function renderFeedbacks() {
      const filtered = feedbacks.filter(f => f.category === category);
      list.innerHTML = filtered.length ? '' : '<div style="text-align: center; padding: 20px; color: #6b7280;"><p style="font-size: 12px;">Nenhum feedback ainda.</p></div>';

      filtered.slice(0, 2).forEach(f => {
        const div = document.createElement('div');
        div.style.padding = '16px';
        div.style.background = '#fff';
        div.style.borderRadius = '12px';
        div.style.marginBottom = '20px';
        div.style.boxShadow = '0 2px 8px rgba(0, 0, 0, 0.10)';
        div.innerHTML = `
          <div style="display: flex; gap: 12px; margin-bottom: 12px;">
            <div style="width: 36px; height: 36px; background: linear-gradient(135deg, #6b7280, #4b5563); color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 14px; font-weight: bold;">${f.user[0]}</div>
            <div>
              <div style="font-weight: 600; font-size: 13px; color: #1f2937;">${f.user}</div>
              ${f.location ? `<div style="font-size: 12px; color: #6b7280;">📍 ${f.location}</div>` : ''}
            </div>
          </div>
          <div style="color: #f59e0b; font-size: 15px; margin-bottom: 8px;">${'★'.repeat(f.rating)}</div>
          <div style="font-size: 13px; color: #374151; margin-bottom: 8px;">${f.message}</div>
          <div style="font-size: 12px; color: #6b7280; text-align: right;">${new Date(f.date).toLocaleDateString('pt-BR')}</div>
        `;
        list.appendChild(div);
      });
    // Fecha o chat ao clicar fora
    document.addEventListener('mousedown', function(e) {
      var chat = document.getElementById('chat-feedback-popup');
      var btn = document.getElementById('chat-feedback-btn');
      if (chat.style.display === 'block' && !chat.contains(e.target) && !btn.contains(e.target)) {
        chat.style.display = 'none';
      }
    });

      badge.textContent = feedbacks.length;
      badge.style.display = feedbacks.length ? 'flex' : 'none';
    }

    renderFeedbacks();
  });
</script>
