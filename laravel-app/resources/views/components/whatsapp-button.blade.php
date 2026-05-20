<div class="wa-float-container" id="chat-widget">
    <!-- Trigger Button -->
    <button id="chat-toggle" class="wa-btn" aria-label="Buka Chatbot IT Support">
        <span class="wa-tooltip">Tanya Asisten IT</span>
        <span class="wa-badge">1</span>
        <div class="wa-icon-wrapper">
            <!-- Normal Chat Icon -->
            <svg class="wa-icon wa-icon-chat" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM6 9h12v2H6V9zm8 5H6v-2h8v2zm4-6H6V6h12v2z"/>
            </svg>
            <!-- WhatsApp Brand Icon (for hover/active state) -->
            <svg class="wa-icon wa-icon-wa" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
            </svg>
        </div>
    </button>

    <!-- Chat Panel -->
    <div class="chat-panel" id="chat-panel" aria-hidden="true">
        <!-- Header -->
        <div class="chat-header">
            <div class="chat-header-info">
                <div class="chat-avatar">
                    <img src="{{ asset('logo.png') }}" alt="PT ITS Logo" />
                    <span class="chat-status-dot"></span>
                </div>
                <div class="chat-header-text">
                    <span class="chat-bot-name">Asisten IT Support</span>
                    <span class="chat-bot-sub">Online · CS PT.ITS</span>
                </div>
            </div>
            <button id="chat-close" class="chat-close-btn" aria-label="Tutup Obrolan">
                <i data-lucide="x"></i>
            </button>
        </div>

        <!-- Chat Messages Body -->
        <div class="chat-body" id="chat-body" role="log" aria-live="polite"></div>

        <!-- Suggestion Chips / Quick Replies -->
        <div class="chat-quick" id="chat-quick" aria-hidden="false"></div>

        <!-- Input Area Form -->
        <form id="chat-form" class="chat-form" onsubmit="return false;">
            <div class="chat-input-wrapper">
                <input id="chat-input" type="text" placeholder="Tulis pertanyaan Anda..." autocomplete="off" />
                <button id="chat-send" type="button" aria-label="Kirim Pesan">
                    <i data-lucide="send"></i>
                </button>
            </div>
        </form>
    </div>
</div>

<script src="{{ asset('js/chatbot.js') }}?v=1.0.3"></script>
