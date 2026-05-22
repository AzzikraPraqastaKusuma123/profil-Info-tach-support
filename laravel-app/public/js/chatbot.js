document.addEventListener('DOMContentLoaded', () => {
  const toggleBtn = document.getElementById('chat-toggle');
  const closeBtn = document.getElementById('chat-close');
  const panel = document.getElementById('chat-panel');
  const body = document.getElementById('chat-body');
  const input = document.getElementById('chat-input');
  const sendBtn = document.getElementById('chat-send');
  const widgetContainer = document.getElementById('chat-widget');
  const unreadBadge = document.querySelector('.wa-badge');
  const quickContainer = document.getElementById('chat-quick');

  // Basic sanity checks
  if (!toggleBtn) console.warn('chatbot: toggle button not found (id=chat-toggle)');
  if (!panel) console.warn('chatbot: chat panel not found (id=chat-panel)');
  if (!body) console.warn('chatbot: chat body not found (id=chat-body)');
  if (!input) console.warn('chatbot: chat input not found (id=chat-input)');
  if (!sendBtn) console.warn('chatbot: chat send button not found (id=chat-send)');

  // Session identification
  const SESSION_KEY = getOrCreateSessionKey();
  let isLiveChat = false;
  let lastMessageIds = new Set();
  let pollInterval = null;

  function getOrCreateSessionKey() {
    let key = localStorage.getItem('its_chat_session_key');
    if (!key) {
      key = 'session_' + Math.random().toString(36).substr(2, 9) + '_' + Date.now();
      localStorage.setItem('its_chat_session_key', key);
    }
    return key;
  }

  // Helper to append chat messages
  function appendMessage(text, who = 'bot') {
    if (!body) return;
    
    // Check if we are appending a system message (bot / admin status change)
    const isSystemMsg = who === 'bot' && (text.includes('diambil alih oleh Admin') || text.includes('diakhiri oleh Admin'));
    
    const el = document.createElement('div');
    if (isSystemMsg) {
      el.className = 'chat-msg bot system-notice';
      el.style.alignSelf = 'center';
      el.style.background = 'rgba(255, 255, 255, 0.05)';
      el.style.border = '1px dashed rgba(255, 255, 255, 0.15)';
      el.style.borderRadius = '8px';
      el.style.fontSize = '0.78rem';
      el.style.color = 'var(--gray-400)';
      el.style.textAlign = 'center';
      el.style.maxWidth = '95%';
      el.style.padding = '6px 12px';
    } else {
      el.className = 'chat-msg ' + who;
    }
    
    if (who === 'bot' || isSystemMsg) {
      el.innerHTML = text;
    } else {
      el.textContent = text;
    }
    
    body.appendChild(el);
    body.scrollTop = body.scrollHeight;

    // Trigger Lucide icons rendering if any are generated in the bubble
    if (window.lucide && typeof window.lucide.createIcons === 'function') {
      try {
        window.lucide.createIcons();
      } catch (err) {
        console.warn('Lucide icons rendering failed:', err);
      }
    }
  }

  // BOT REPLY LOGIC WITH TYPING DELAY
  function botReply(userText) {
    if (!body) return;
    
    // Create and append the typing indicator bubble
    const typingEl = document.createElement('div');
    typingEl.className = 'chat-msg bot typing';
    typingEl.innerHTML = '<div class="typing-indicator"><span></span><span></span><span></span></div>';
    body.appendChild(typingEl);
    body.scrollTop = body.scrollHeight;

    const reply = getResponse(userText);
    
    // Typing delay simulation (minimum 700ms, up to 1800ms depending on query length)
    const delay = 700 + Math.min(userText.length * 8, 1100);

    setTimeout(() => {
      // Remove typing bubble
      typingEl.remove();
      // Append actual bot reply
      appendMessage(reply, 'bot');
    }, delay);
  }

  // INTENT RESPONSES
  function getResponse(text) {
    if (!text) return "Silakan ketik pertanyaan Anda atau pilih tombol di atas.";
    const t = text.toLowerCase();
    
    if (/(halo|hi|hai|hello|selamat)/.test(t)) {
      return "Halo! Saya <b>Asisten IT Support</b> PT.ITS. Ada yang bisa saya bantu terkait layanan, alamat, atau cara pemesanan? 😊";
    }
    
    if (t.includes('layanan') || t.includes('service') || t.includes('laptop') || t.includes('website') || t.includes('cctv') || t.includes('jaringan')) {
      return "Kami menyediakan layanan IT profesional:<br>" +
             "• <b>Service Laptop & PC</b> (Hardware & OS)<br>" +
             "• <b>Instalasi Jaringan</b> (LAN & WiFi)<br>" +
             "• <b>Pasang CCTV HD/4K</b> (Pemantauan via HP)<br>" +
             "• <b>Pembuatan Website</b> (Company Profile & SEO)<br>" +
             "• <b>Maintenance IT</b> (Rutin Bulanan)<br>" +
             "• <b>Konsultasi IT</b> (Rekomendasi Ahli)<br><br>" +
             "Ingin berkonsultasi langsung?<br>" +
             "<a href='https://wa.me/6281210874692' target='_blank' class='chat-wa-inline-btn'><i data-lucide='phone'></i> Tanya CS via WhatsApp</a>";
    }
    
    if (t.includes('harga') || t.includes('biaya') || t.includes('tarif') || t.includes('ongkos') || t.includes('estimasi')) {
      return "Untuk detail penawaran layanan kami, silakan hubungi tim Customer Support kami. Tim kami akan menganalisis kebutuhan Anda dan memberikan solusi terbaik:<br><br>" +
             "<a href='https://wa.me/6281210874692' target='_blank' class='chat-wa-inline-btn'><i data-lucide='phone'></i> Hubungi via WhatsApp</a>";
    }
    
    if (t.includes('alamat') || t.includes('lokasi') || t.includes('kantor') || t.includes('maps') || t.includes('bekasi')) {
      return "Kantor operasional kami berlokasi di:<br>" +
             "📍 <b>Jl.Durian Blok CR 6 Komp.Bumi Dirgantara Permai, Kec. Jatiasih, Kota Bekasi, Jawa Barat 17426</b><br><br>" +
             "Kami melayani kunjungan servis langsung ke seluruh area <b>Jabodetabek</b>. Buka arah jalan di Google Maps:<br>" +
             "<a href='https://www.google.com/maps/place/IT+Support+Jabodetabek' target='_blank' class='chat-wa-inline-btn'><i data-lucide='map-pin'></i> Buka Google Maps</a>";
    }
    
    if (t.includes('jam') || t.includes('operasional') || t.includes('buka') || t.includes('tutup') || t.includes('hari')) {
      return "Jam operasional kantor & teknisi kami:<br>" +
             "📅 <b>Senin – Sabtu</b>: 08.00 – 20.00 WIB<br>" +
             "📅 <b>Minggu</b>: 09.00 – 17.00 WIB<br><br>" +
             "Untuk kondisi darurat di luar jam kerja, Anda tetap bisa meninggalkan pesan via WhatsApp untuk segera kami tindaklanjuti.";
    }
    
    if (t.includes('kontak') || t.includes('wa') || t.includes('telepon') || t.includes('email') || t.includes('hubung')) {
      return "Tim Customer Support kami siap dihubungi melalui:<br>" +
             "📞 <b>WhatsApp / Call</b>: 081210874692<br>" +
             "✉️ <b>Email CS</b>: cs@itsupport-jabodetabek.com<br><br>" +
             "<a href='https://wa.me/6281210874692' target='_blank' class='chat-wa-inline-btn'><i data-lucide='phone'></i> Hubungi via WhatsApp</a>";
    }
    
    if (t.includes('cara pesan') || t.includes('cara order') || t.includes('booking') || t.includes('pesan') || t.includes('order')) {
      return "Langkah memesan layanan IT di tempat kami:<br>" +
             "1. Klik tombol di bawah ini untuk memulai chat WhatsApp.<br>" +
             "2. Sebutkan kendala perangkat Anda atau kebutuhan instalasi Anda.<br>" +
             "3. Tim CS kami akan memberikan solusi awal terbaik untuk Anda.<br>" +
             "4. Jika sepakat, teknisi kami akan menjadwalkan kunjungan ke rumah/kantor Anda.<br><br>" +
             "<a href='https://wa.me/6281210874692' target='_blank' class='chat-wa-inline-btn'><i data-lucide='send'></i> Booking Teknisi Sekarang</a>";
    }
    
    if (t.includes('thanks') || t.includes('terima') || t.includes('makasih') || t.includes('suwun') || t.includes('nuhun')) {
      return "Sama-sama! Senang sekali bisa membantu Anda. Jika butuh bantuan perbaikan IT lainnya, hubungi kami kapan saja! 💻✨";
    }
    
    return "Maaf, saya belum mengerti pertanyaan tersebut. Coba tanyakan topik dasar seperti 'layanan', 'alamat', atau klik tombol <b>Hubungi Admin</b> di bawah untuk chat langsung dengan tim Support kami.";
  }

  // DYNAMIC SUGGESTIONS
  const defaultQuick = ['layanan', 'alamat', 'jam operasional', 'Hubungi Admin', 'kontak'];

  const suggestionsMap = {
    services: ['cara pesan', 'alamat', 'Hubungi Admin', 'kontak'],
    location: ['jam operasional', 'layanan', 'Hubungi Admin', 'kontak'],
    hours: ['alamat', 'layanan', 'Hubungi Admin', 'kontak'],
    contact: ['layanan', 'Hubungi Admin', 'cara pesan'],
    greeting: ['layanan', 'alamat', 'Hubungi Admin', 'kontak'],
    unknown: defaultQuick
  };

  // Intent analyzer helper
  function analyzeIntent(text) {
    if (!text) return 'unknown';
    const t = text.toLowerCase();
    if (/(halo|hi|hai|hello|selamat)/.test(t)) return 'greeting';
    if (t.includes('layanan') || t.includes('service') || t.includes('laptop') || t.includes('website') || t.includes('cctv') || t.includes('jaringan')) return 'services';
    if (t.includes('alamat') || t.includes('lokasi') || t.includes('kantor') || t.includes('maps')) return 'location';
    if (t.includes('jam') || t.includes('operasional') || t.includes('buka')) return 'hours';
    if (t.includes('kontak') || t.includes('wa') || t.includes('telepon') || t.includes('email')) return 'contact';
    return 'unknown';
  }

  function updateSuggestionsForText(text) {
    const intent = analyzeIntent(text);
    const items = suggestionsMap[intent] || defaultQuick;
    renderQuickReplies(items);
  }

  function renderQuickReplies(items = defaultQuick) {
    if (!quickContainer) return;
    quickContainer.innerHTML = '';
    
    items.forEach(q => {
      const btn = document.createElement('button');
      btn.type = 'button';
      btn.className = 'chat-quick-btn';
      btn.textContent = q;
      
      btn.addEventListener('click', (e) => {
        e.preventDefault();
        const query = q;
        if (query.toLowerCase() === 'hubungi admin') {
          startLiveChat();
        } else {
          appendMessage(query, 'user');
          setTimeout(() => {
            botReply(query);
            updateSuggestionsForText(query);
          }, 10);
        }
      });
      
      quickContainer.appendChild(btn);
    });
  }

  // ==========================================
  // LIVE CHAT REDIRECT & POLLING LOGIC
  // ==========================================

  function startLiveChat() {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    
    // Show typing/connecting indicator
    const typingEl = document.createElement('div');
    typingEl.className = 'chat-msg bot typing';
    typingEl.innerHTML = '<div class="typing-indicator"><span></span><span></span><span></span></div>';
    body.appendChild(typingEl);
    body.scrollTop = body.scrollHeight;

    fetch('/api/chat/takeover', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken
      },
      body: JSON.stringify({
        session_key: SESSION_KEY,
        user_name: 'Pengunjung #' + SESSION_KEY.substr(-5)
      })
    })
    .then(res => res.json())
    .then(data => {
      typingEl.remove();
      isLiveChat = true;
      
      if (quickContainer) quickContainer.style.display = 'none';
      
      updateHeaderStatus(true);
      fetchNewMessages();
      startPolling();
    })
    .catch(err => {
      typingEl.remove();
      console.error('Error starting live chat:', err);
      appendMessage('Gagal menghubungkan ke live chat. Silakan coba lagi nanti atau hubungi via WhatsApp.', 'bot');
    });
  }

  function startLiveChatDirect(userMessageText) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    
    // Show typing/connecting indicator
    const typingEl = document.createElement('div');
    typingEl.className = 'chat-msg bot typing';
    typingEl.innerHTML = '<div class="typing-indicator"><span></span><span></span><span></span></div>';
    body.appendChild(typingEl);
    body.scrollTop = body.scrollHeight;

    fetch('/api/chat/takeover', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken
      },
      body: JSON.stringify({
        session_key: SESSION_KEY,
        user_name: 'Pengunjung #' + SESSION_KEY.substr(-5)
      })
    })
    .then(res => res.json())
    .then(data => {
      typingEl.remove();
      isLiveChat = true;
      
      if (quickContainer) quickContainer.style.display = 'none';
      
      updateHeaderStatus(true);
      
      // Save the message they typed directly to admin chat list
      sendUserMessageToAdmin(userMessageText, true);
      
      startPolling();
    })
    .catch(err => {
      typingEl.remove();
      console.error('Error starting live chat:', err);
      appendMessage('Gagal menghubungkan ke live chat. Silakan coba lagi nanti atau hubungi via WhatsApp.', 'bot');
    });
  }

  function sendUserMessageToAdmin(messageText, skipAppending = false) {
    if (!skipAppending) {
      appendMessage(messageText, 'user');
    }

    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    fetch('/api/chat/send', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken
      },
      body: JSON.stringify({
        session_key: SESSION_KEY,
        message: messageText
      })
    })
    .then(res => res.json())
    .then(msg => {
      if (msg.id) {
        lastMessageIds.add(msg.id);
      }
      // Instantly query back to get messages
      fetchNewMessages();
    })
    .catch(err => {
      console.error('Error sending message to admin:', err);
    });
  }

  function fetchNewMessages() {
    fetch(`/api/chat/messages?session_key=${SESSION_KEY}`)
      .then(res => res.json())
      .then(data => {
        isLiveChat = data.is_active;
        updateHeaderStatus(isLiveChat);

        if (quickContainer) {
          quickContainer.style.display = isLiveChat ? 'none' : 'flex';
        }

        let hasNew = false;
        data.messages.forEach(msg => {
          if (!lastMessageIds.has(msg.id)) {
            lastMessageIds.add(msg.id);
            // Append message. If sender is 'user', append as 'user'. If sender is 'admin' or 'bot', append as 'bot'
            appendMessage(msg.message, msg.sender === 'user' ? 'user' : 'bot');
            hasNew = true;
          }
        });

        if (!isLiveChat) {
          stopPolling();
        }
      })
      .catch(err => console.error('Error polling chat messages:', err));
  }

  function syncSession() {
    fetch(`/api/chat/messages?session_key=${SESSION_KEY}`)
      .then(res => res.json())
      .then(data => {
        isLiveChat = data.is_active;
        updateHeaderStatus(isLiveChat);

        if (quickContainer) {
          quickContainer.style.display = isLiveChat ? 'none' : 'flex';
        }

        if (data.messages && data.messages.length > 0) {
          if (body) body.innerHTML = ''; // Clear fallback messages
          data.messages.forEach(msg => {
            lastMessageIds.add(msg.id);
            appendMessage(msg.message, msg.sender === 'user' ? 'user' : 'bot');
          });

          if (isLiveChat) {
            startPolling();
          } else {
            renderQuickReplies();
          }
        } else {
          // Empty chat history, show welcome
          if (body && body.children.length === 0) {
            appendMessage('Halo! Selamat datang di <b>IT Support Jabodetabek</b>. Saya asisten virtual PT.ITS. Ada yang bisa saya bantu hari ini? Silakan ketik pesan atau pilih topik cepat di bawah.', 'bot');
          }
          renderQuickReplies();
        }
      })
      .catch(err => {
        console.error('Error syncing chat session:', err);
        if (body && body.children.length === 0) {
          appendMessage('Halo! Selamat datang di <b>IT Support Jabodetabek</b>. Saya asisten virtual PT.ITS. Ada yang bisa saya bantu hari ini? Silakan ketik pesan atau pilih topik cepat di bawah.', 'bot');
        }
        renderQuickReplies();
      });
  }

  function updateHeaderStatus(active) {
    const statusSub = document.querySelector('.chat-bot-sub');
    const botName = document.querySelector('.chat-bot-name');
    if (statusSub && botName) {
      if (active) {
        botName.textContent = 'Admin Support PT.ITS';
        statusSub.textContent = 'Terhubung · Live Chat';
        statusSub.style.color = '#3b82f6';
      } else {
        botName.textContent = 'Asisten IT Support';
        statusSub.textContent = 'Online · CS PT.ITS';
        statusSub.style.color = '#25d366';
      }
    }
  }

  function startPolling() {
    if (pollInterval) clearInterval(pollInterval);
    pollInterval = setInterval(fetchNewMessages, 4000);
  }

  function stopPolling() {
    if (pollInterval) {
      clearInterval(pollInterval);
      pollInterval = null;
    }
  }

  // ==========================================
  // PANEL OPEN/CLOSE & INTERACTION LISTENERS
  // ==========================================

  function openPanel() {
    if (!panel || !toggleBtn) return;
    panel.setAttribute('aria-hidden', 'false');
    toggleBtn.setAttribute('aria-pressed', 'true');
    
    // Hide notification badge when user opens the chat
    if (unreadBadge) {
      unreadBadge.style.display = 'none';
    }
    
    // Sync session state from the backend
    syncSession();
  }

  function closePanel() {
    if (!panel || !toggleBtn) return;
    panel.setAttribute('aria-hidden', 'true');
    toggleBtn.setAttribute('aria-pressed', 'false');
    stopPolling();
  }

  // Toggle button click listener
  if (toggleBtn) {
    toggleBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      const open = panel.getAttribute('aria-hidden') === 'false';
      if (open) closePanel(); else openPanel();
    });
  }

  // Close button click listener
  if (closeBtn) {
    closeBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      closePanel();
    });
  }

  // Send message action on click
  if (sendBtn && input) {
    sendBtn.addEventListener('click', (e) => {
      e.preventDefault();
      const v = input.value.trim();
      if (!v) return;
      
      input.value = '';
      
      if (isLiveChat) {
        sendUserMessageToAdmin(v);
      } else {
        appendMessage(v, 'user');
        
        const isRequestingAdmin = /(admin|operator|support|bantuan manusia|hubungi)/i.test(v);
        if (isRequestingAdmin) {
          startLiveChatDirect(v);
        } else {
          botReply(v);
          updateSuggestionsForText(v);
        }
      }
    });
  }

  // Send message on Enter keypress
  if (input && sendBtn) {
    input.addEventListener('keydown', (e) => {
      if (e.key === 'Enter') {
        e.preventDefault();
        sendBtn.click();
      }
    });
  }

  // Close panel on outside click
  document.addEventListener('click', (e) => {
    if (!widgetContainer || !panel) return;
    
    const isClickedInside = widgetContainer.contains(e.target);
    const isOpen = panel.getAttribute('aria-hidden') === 'false';
    
    if (!isClickedInside && isOpen) {
      closePanel();
    }
  });

  // Render initial quick suggestions (will be updated or hidden on sync)
  renderQuickReplies();
});
