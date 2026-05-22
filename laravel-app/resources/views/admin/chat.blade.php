@extends('admin.layout')

@section('title', 'Live Chat Console')
@section('page-title', 'Live Chat Console')

@section('styles')
<style>
    .chat-container {
        display: grid;
        grid-template-columns: 320px 1fr;
        height: calc(100vh - var(--header-height) - 64px);
        background: var(--card-glass);
        border: 1px solid var(--border-glass);
        border-radius: var(--radius-lg);
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
    }

    /* ── SESSION LIST SIDEBAR ── */
    .chat-sidebar {
        border-right: 1px solid var(--border-glass);
        display: flex;
        flex-direction: column;
        background: rgba(10, 22, 40, 0.5);
    }

    .sidebar-search {
        padding: 16px;
        border-bottom: 1px solid var(--border-glass);
    }

    .session-list {
        flex-grow: 1;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
    }

    .session-item {
        padding: 16px 20px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.03);
        display: flex;
        align-items: center;
        gap: 12px;
        cursor: pointer;
        transition: var(--transition);
        position: relative;
    }

    .session-item:hover {
        background: rgba(255, 255, 255, 0.03);
    }

    .session-item.active {
        background: rgba(59, 130, 246, 0.08);
        border-left: 4px solid var(--blue-400);
    }

    .session-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--navy-600), var(--navy-800));
        border: 1px solid rgba(255, 255, 255, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--white);
        font-weight: 700;
        font-size: 0.9rem;
    }

    .session-info {
        flex-grow: 1;
        overflow: hidden;
    }

    .session-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 4px;
    }

    .session-name {
        font-weight: 700;
        font-size: 0.95rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        color: var(--white);
    }

    .session-time {
        font-size: 0.75rem;
        color: var(--gray-400);
    }

    .session-preview {
        font-size: 0.8rem;
        color: var(--gray-400);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .session-status {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        padding: 2px 6px;
        border-radius: 4px;
    }

    .status-active {
        background: rgba(34, 197, 94, 0.15);
        color: #4ade80;
        border: 1px solid rgba(34, 197, 94, 0.3);
    }

    .status-inactive {
        background: rgba(255, 255, 255, 0.05);
        color: var(--gray-400);
        border: 1px solid var(--border-glass);
    }

    /* ── CHAT PANE ── */
    .chat-pane {
        display: flex;
        flex-direction: column;
        background: rgba(5, 13, 26, 0.2);
        position: relative;
    }

    .chat-pane-empty {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100%;
        color: var(--gray-400);
        text-align: center;
        padding: 40px;
    }

    .chat-header {
        padding: 16px 24px;
        border-bottom: 1px solid var(--border-glass);
        background: rgba(10, 22, 40, 0.4);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .chat-user-details {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .chat-body {
        flex-grow: 1;
        overflow-y: auto;
        padding: 24px;
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .msg-bubble-wrapper {
        display: flex;
        flex-direction: column;
        max-width: 70%;
    }

    .msg-bubble-wrapper.user {
        align-self: flex-start;
    }

    .msg-bubble-wrapper.admin, .msg-bubble-wrapper.bot {
        align-self: flex-end;
    }

    .msg-sender-name {
        font-size: 0.75rem;
        color: var(--gray-400);
        margin-bottom: 4px;
        padding: 0 4px;
    }

    .msg-bubble {
        padding: 12px 18px;
        border-radius: 16px;
        font-size: 0.95rem;
        line-height: 1.5;
        position: relative;
        word-wrap: break-word;
    }

    .msg-bubble-wrapper.user .msg-bubble {
        background: rgba(255, 255, 255, 0.08);
        color: var(--white);
        border-bottom-left-radius: 4px;
        border: 1px solid rgba(255, 255, 255, 0.05);
    }

    .msg-bubble-wrapper.admin .msg-bubble {
        background: linear-gradient(135deg, var(--blue-500), var(--blue-400));
        color: var(--white);
        border-bottom-right-radius: 4px;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.2);
    }

    .msg-bubble-wrapper.bot .msg-bubble {
        background: rgba(30, 41, 59, 0.8);
        color: var(--gray-200);
        border-bottom-right-radius: 4px;
        border: 1px solid rgba(255, 255, 255, 0.05);
        font-style: italic;
    }

    .msg-time {
        font-size: 0.7rem;
        color: var(--gray-400);
        margin-top: 4px;
        text-align: right;
        padding: 0 4px;
    }

    /* System Notice */
    .msg-system {
        align-self: center;
        background: rgba(245, 158, 11, 0.1);
        border: 1px solid rgba(245, 158, 11, 0.2);
        color: var(--accent-light);
        font-size: 0.8rem;
        font-weight: 600;
        padding: 6px 16px;
        border-radius: 99px;
        text-align: center;
        max-width: 80%;
    }

    .chat-footer {
        padding: 20px 24px;
        border-top: 1px solid var(--border-glass);
        background: rgba(10, 22, 40, 0.4);
    }

    .chat-input-row {
        display: flex;
        gap: 12px;
    }

    .chat-input-box {
        flex-grow: 1;
        background: rgba(5, 13, 26, 0.6);
        border: 1px solid var(--border-glass);
        border-radius: var(--radius-sm);
        padding: 14px;
        color: var(--white);
        font-family: inherit;
        font-size: 0.95rem;
        resize: none;
        height: 50px;
        transition: var(--transition);
    }

    .chat-input-box:focus {
        outline: none;
        border-color: var(--blue-400);
        background: rgba(5, 13, 26, 0.8);
    }

    .chat-input-box:disabled {
        opacity: 0.5;
        cursor: not-allowed;
        placeholder: "Ambil alih sesi ini untuk membalas...";
    }

    .btn-chat-send {
        background: var(--blue-400);
        color: var(--white);
        border: none;
        border-radius: var(--radius-sm);
        padding: 0 24px;
        font-weight: 700;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-chat-send:hover {
        background: var(--blue-300);
        transform: translateY(-2px);
    }

    .btn-chat-send:disabled {
        background: var(--gray-600);
        color: var(--gray-400);
        cursor: not-allowed;
        transform: none;
    }

    .takeover-banner {
        background: rgba(59, 130, 246, 0.1);
        border-bottom: 1px solid rgba(59, 130, 246, 0.2);
        padding: 10px 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.85rem;
        color: var(--blue-300);
    }

    .btn-takeover {
        padding: 6px 14px;
        font-size: 0.8rem;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 700;
        border: none;
        transition: var(--transition);
    }

    .btn-takeover-active {
        background: var(--blue-400);
        color: var(--white);
    }

    .btn-takeover-active:hover {
        background: var(--blue-500);
    }

    .btn-takeover-inactive {
        background: rgba(239, 68, 68, 0.2);
        color: #fca5a5;
        border: 1px solid rgba(239, 68, 68, 0.3);
    }

    .btn-takeover-inactive:hover {
        background: rgba(239, 68, 68, 0.3);
        color: #ef4444;
    }
</style>
@endsection

@section('content')
<div class="chat-container">
    <!-- Sidebar: Sessions List -->
    <div class="chat-sidebar">
        <div class="sidebar-search">
            <input type="text" id="search-sessions" class="admin-input" placeholder="Cari sesi chat..." style="padding: 10px 12px; font-size: 0.85rem;">
        </div>

        <div class="session-list" id="sessions-container">
            <!-- Rendered dynamically -->
            <div style="text-align: center; padding: 40px 0; color: var(--gray-400);">
                <div class="typing-indicator" style="margin-bottom:10px;"><span></span><span></span><span></span></div>
                <p>Memuat sesi chat...</p>
            </div>
        </div>
    </div>

    <!-- Main Pane: Chat Transcript -->
    <div class="chat-pane" id="chat-pane">
        <!-- Default State: Empty -->
        <div class="chat-pane-empty" id="chat-empty-state">
            <i data-lucide="message-square" style="width: 64px; height: 64px; opacity: 0.2; margin-bottom: 16px;"></i>
            <h3>Konsol Sembang Live Chat</h3>
            <p style="max-width: 400px; margin-top: 8px;">Pilih sesi chat pengunjung dari menu di sebelah kiri untuk melihat percakapan dan mengambil alih obrolan.</p>
        </div>

        <!-- Active Chat State -->
        <div style="display:none; flex-direction:column; height:100%;" id="chat-active-state">
            <div class="chat-header">
                <div class="chat-user-details">
                    <div class="session-avatar" id="active-user-avatar">P</div>
                    <div>
                        <h3 id="active-user-name" style="font-size:1.05rem; font-weight:700;">Nama Pengunjung</h3>
                        <div id="active-user-status-wrapper" style="margin-top:2px;">
                            <span class="session-status" id="active-user-status">Status</span>
                        </div>
                    </div>
                </div>

                <div>
                    <button class="btn-takeover" id="active-takeover-btn">Ambil Alih Chat</button>
                </div>
            </div>

            <!-- Takeover Warning Banner -->
            <div class="takeover-banner" id="takeover-banner" style="display: none;">
                <span id="takeover-banner-text">Chat saat ini sedang direspon oleh bot otomatis.</span>
            </div>

            <!-- Message Log -->
            <div class="chat-body" id="chat-body-container">
                <!-- Messages rendered dynamically -->
            </div>

            <!-- Message Input Area -->
            <div class="chat-footer">
                <form id="chat-send-form">
                    <div class="chat-input-row">
                        <textarea id="chat-message-input" class="chat-input-box" placeholder="Ketik pesan balasan..." disabled></textarea>
                        <button type="submit" class="btn-chat-send" id="chat-send-btn" disabled>
                            <span>Kirim</span>
                            <i data-lucide="send" style="width:16px;"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    let activeSessionId = null;
    let pollingInterval = null;
    let sessionsList = [];
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Get session from URL parameter
    const urlParams = new URLSearchParams(window.location.search);
    const initialSessionId = urlParams.get('session');

    // Load session list on start
    loadSessions().then(() => {
        if (initialSessionId) {
            selectSession(parseInt(initialSessionId));
        }
    });

    // Start global polling for sessions list
    setInterval(loadSessions, 6000);

    async function loadSessions() {
        try {
            const res = await fetch('/admin/chat/sessions');
            const data = await res.json();
            sessionsList = data;
            renderSessions();
        } catch (err) {
            console.error('Error fetching sessions:', err);
        }
    }

    function renderSessions() {
        const container = document.getElementById('sessions-container');
        if (sessionsList.length === 0) {
            container.innerHTML = `
                <div style="text-align: center; padding: 40px 0; color: var(--gray-400);">
                    <p>Tidak ada sesi chat.</p>
                </div>
            `;
            return;
        }

        const searchVal = document.getElementById('search-sessions').value.toLowerCase();
        
        container.innerHTML = '';
        sessionsList.forEach(session => {
            if (searchVal && !session.user_name.toLowerCase().includes(searchVal)) {
                return;
            }

            const item = document.createElement('div');
            item.className = `session-item ${session.id === activeSessionId ? 'active' : ''}`;
            item.onclick = () => selectSession(session.id);

            const initial = session.user_name.charAt(0).toUpperCase();
            const dateObj = new Date(session.updated_at);
            const timeStr = dateObj.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
            
            const statusClass = session.is_active ? 'status-active' : 'status-inactive';
            const statusText = session.is_active ? 'Diambil Alih' : 'Bot Chat';

            item.innerHTML = `
                <div class="session-avatar">${initial}</div>
                <div class="session-info">
                    <div class="session-top">
                        <div class="session-name">${session.user_name}</div>
                        <div class="session-time">${timeStr}</div>
                    </div>
                    <div class="session-top" style="margin-top: 4px;">
                        <span class="session-status ${statusClass}">${statusText}</span>
                    </div>
                </div>
            `;
            container.appendChild(item);
        });
    }

    // Search filter trigger
    document.getElementById('search-sessions').addEventListener('input', renderSessions);

    async function selectSession(id) {
        activeSessionId = id;
        
        // Show active state, hide empty state
        document.getElementById('chat-empty-state').style.display = 'none';
        document.getElementById('chat-active-state').style.display = 'flex';
        
        // Update active class in sidebar items
        document.querySelectorAll('.session-item').forEach(el => el.classList.remove('active'));
        renderSessions(); // Re-render to apply active class style

        // Fetch messages initially
        await fetchMessages();

        // Start specific session messages polling
        if (pollingInterval) clearInterval(pollingInterval);
        pollingInterval = setInterval(fetchMessages, 3000);
    }

    async function fetchMessages() {
        if (!activeSessionId) return;

        try {
            const res = await fetch(`/admin/chat/sessions/${activeSessionId}/messages`);
            const data = await res.json();
            
            const session = data.session;
            const messages = data.messages;

            // Render Header info
            document.getElementById('active-user-name').textContent = session.user_name;
            document.getElementById('active-user-avatar').textContent = session.user_name.charAt(0).toUpperCase();
            
            const statusSpan = document.getElementById('active-user-status');
            const takeoverBtn = document.getElementById('active-takeover-btn');
            const inputField = document.getElementById('chat-message-input');
            const sendBtn = document.getElementById('chat-send-btn');
            const banner = document.getElementById('takeover-banner');

            if (session.is_active) {
                statusSpan.className = 'session-status status-active';
                statusSpan.textContent = 'Diambil Alih';
                
                takeoverBtn.className = 'btn-takeover btn-takeover-inactive';
                takeoverBtn.textContent = 'Kembalikan ke Bot';
                takeoverBtn.onclick = () => toggleSessionTakeover(false);

                // Enable messaging inputs
                inputField.disabled = false;
                sendBtn.disabled = false;
                inputField.placeholder = "Ketik pesan balasan...";
                banner.style.display = 'none';
            } else {
                statusSpan.className = 'session-status status-inactive';
                statusSpan.textContent = 'Respon Otomatis Bot';
                
                takeoverBtn.className = 'btn-takeover btn-takeover-active';
                takeoverBtn.textContent = 'Ambil Alih Chat';
                takeoverBtn.onclick = () => toggleSessionTakeover(true);

                // Disable messaging inputs
                inputField.disabled = true;
                sendBtn.disabled = true;
                inputField.placeholder = "Ambil alih sesi ini untuk membalas...";
                
                banner.style.display = 'flex';
                banner.innerHTML = `
                    <span>Merespon otomatis via Bot Chat. Klik <b>Ambil Alih Chat</b> untuk mengobrol langsung.</span>
                `;
            }

            // Render messages
            const bodyContainer = document.getElementById('chat-body-container');
            const wasScrolledToBottom = bodyContainer.scrollHeight - bodyContainer.clientHeight <= bodyContainer.scrollTop + 50;
            
            bodyContainer.innerHTML = '';
            messages.forEach(msg => {
                if (msg.message.startsWith('[') && msg.message.endsWith(']')) {
                    // Render system notice message
                    const systemDiv = document.createElement('div');
                    systemDiv.className = 'msg-system';
                    systemDiv.textContent = msg.message;
                    bodyContainer.appendChild(systemDiv);
                } else {
                    const wrap = document.createElement('div');
                    wrap.className = `msg-bubble-wrapper ${msg.sender}`;
                    
                    const senderName = msg.sender === 'user' ? session.user_name : (msg.sender === 'admin' ? 'Admin' : 'Assistant Bot');
                    const dateObj = new Date(msg.created_at);
                    const timeStr = dateObj.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });

                    wrap.innerHTML = `
                        <div class="msg-sender-name">${senderName}</div>
                        <div class="msg-bubble">${msg.message}</div>
                        <div class="msg-time">${timeStr}</div>
                    `;
                    bodyContainer.appendChild(wrap);
                }
            });

            // Scroll to bottom if user was already at the bottom or if it's the first load
            if (wasScrolledToBottom || bodyContainer.dataset.firstLoad !== '1') {
                bodyContainer.scrollTop = bodyContainer.scrollHeight;
                bodyContainer.dataset.firstLoad = '1';
            }
            
        } catch (err) {
            console.error('Error fetching chat messages:', err);
        }
    }

    async function toggleSessionTakeover(isActive) {
        if (!activeSessionId) return;

        try {
            const res = await fetch(`/admin/chat/sessions/${activeSessionId}/takeover`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ is_active: isActive })
            });
            const data = await res.json();
            fetchMessages();
            loadSessions();
        } catch (err) {
            console.error('Error toggling takeover:', err);
        }
    }

    // Submit form handler to send message
    document.getElementById('chat-send-form').addEventListener('submit', async (e) => {
        e.preventDefault();
        const inputField = document.getElementById('chat-message-input');
        const text = inputField.value.trim();
        if (!text || !activeSessionId) return;

        inputField.value = '';
        
        try {
            const res = await fetch(`/admin/chat/sessions/${activeSessionId}/send`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ message: text })
            });
            const data = await res.json();
            
            // Append message locally immediately to look snappy
            const bodyContainer = document.getElementById('chat-body-container');
            const wrap = document.createElement('div');
            wrap.className = 'msg-bubble-wrapper admin';
            const timeStr = new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
            
            wrap.innerHTML = `
                <div class="msg-sender-name">Admin</div>
                <div class="msg-bubble">${text}</div>
                <div class="msg-time">${timeStr}</div>
            `;
            bodyContainer.appendChild(wrap);
            bodyContainer.scrollTop = bodyContainer.scrollHeight;

            // Fetch from database to sync
            fetchMessages();
        } catch (err) {
            console.error('Error sending message:', err);
        }
    });

    // Handle enter key on textarea to submit
    document.getElementById('chat-message-input').addEventListener('keydown', (e) => {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            document.getElementById('chat-send-form').dispatchEvent(new Event('submit'));
        }
    });
</script>
@endsection
