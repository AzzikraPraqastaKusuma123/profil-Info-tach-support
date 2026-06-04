@extends('admin.layout')

@section('title', 'Dashboard Overview')
@section('page-title', 'Dashboard Overview')

@section('styles')
<style>
    .metrics-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 24px;
        margin-bottom: 32px;
    }

    .metric-card {
        padding: 24px;
        border-radius: var(--radius-md);
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: relative;
        overflow: hidden;
        transition: var(--transition);
        border: 1px solid var(--border-glass);
    }

    .metric-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(59, 130, 246, 0.1);
    }

    .metric-card-info h3 {
        font-size: 0.85rem;
        color: var(--gray-400);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
    }

    .metric-card-info .value {
        font-size: 2.2rem;
        font-weight: 800;
        color: var(--white);
    }

    .metric-icon-box {
        width: 54px;
        height: 54px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--white);
    }

    /* Glow variants */
    .metric-services {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(10, 22, 40, 0.5));
    }
    .metric-services .metric-icon-box {
        background: rgba(59, 130, 246, 0.15);
        color: var(--blue-300);
        border: 1px solid rgba(59, 130, 246, 0.3);
    }

    .metric-clients {
        background: linear-gradient(135deg, rgba(245, 158, 11, 0.1), rgba(10, 22, 40, 0.5));
    }
    .metric-clients .metric-icon-box {
        background: rgba(245, 158, 11, 0.15);
        color: var(--accent-light);
        border: 1px solid rgba(245, 158, 11, 0.3);
    }

    .metric-articles {
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(10, 22, 40, 0.5));
    }
    .metric-articles .metric-icon-box {
        background: rgba(16, 185, 129, 0.15);
        color: #34d399;
        border: 1px solid rgba(16, 185, 129, 0.3);
    }

    .metric-chats {
        background: linear-gradient(135deg, rgba(239, 68, 68, 0.1), rgba(10, 22, 40, 0.5));
    }
    .metric-chats .metric-icon-box {
        background: rgba(239, 68, 68, 0.15);
        color: #fca5a5;
        border: 1px solid rgba(239, 68, 68, 0.3);
        position: relative;
    }

    .metric-chats .badge-pulse {
        position: absolute;
        top: 2px;
        right: 2px;
        width: 10px;
        height: 10px;
        background: #ef4444;
        border-radius: 50%;
        box-shadow: 0 0 0 rgba(239, 68, 68, 0.7);
        animation: pulse-ring 1.5s infinite;
    }

    .dashboard-sections {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 24px;
    }

    .panel-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        border-bottom: 1px solid var(--border-glass);
        padding-bottom: 14px;
    }

    .panel-header h2 {
        font-size: 1.15rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Table & lists */
    .table-container {
        overflow-x: auto;
    }

    .admin-table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
    }

    .admin-table th {
        padding: 14px 16px;
        color: var(--gray-400);
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        border-bottom: 1px solid var(--border-glass);
    }

    .admin-table td {
        padding: 14px 16px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.03);
        font-size: 0.95rem;
    }

    .badge-status {
        padding: 4px 8px;
        border-radius: 99px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
    }

    .badge-status-active {
        background: rgba(34, 197, 94, 0.15);
        color: #4ade80;
        border: 1px solid rgba(34, 197, 94, 0.3);
    }

    .btn-table-action {
        width: 32px;
        height: 32px;
        border-radius: 6px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: rgba(255, 255, 255, 0.05);
        color: var(--gray-400);
        transition: var(--transition);
        border: 1px solid var(--border-glass);
    }

    .btn-table-action:hover {
        background: var(--blue-400);
        color: var(--white);
        border-color: var(--blue-400);
    }

    /* Welcome card */
    .welcome-panel {
        background: linear-gradient(135deg, rgba(30, 58, 138, 0.3) 0%, rgba(10, 22, 40, 0.5) 100%);
        border: 1px solid rgba(59, 130, 246, 0.2);
        padding: 28px;
        border-radius: var(--radius-md);
        margin-bottom: 32px;
    }

    .welcome-panel h2 {
        font-size: 1.5rem;
        margin-bottom: 10px;
    }

    .welcome-panel p {
        color: var(--gray-400);
        font-size: 0.95rem;
        max-width: 700px;
    }

    /* Quick Actions */
    .quick-action-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .quick-action-card {
        padding: 16px;
        background: rgba(255, 255, 255, 0.02);
        border: 1px solid var(--border-glass);
        border-radius: var(--radius-sm);
        display: flex;
        align-items: center;
        gap: 16px;
        transition: var(--transition);
    }

    .quick-action-card:hover {
        background: rgba(255, 255, 255, 0.05);
        border-color: rgba(59, 130, 246, 0.3);
        transform: translateX(4px);
    }

    .quick-action-icon {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        background: rgba(59, 130, 246, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--blue-300);
    }

    .quick-action-info {
        flex-grow: 1;
    }

    .quick-action-info h4 {
        font-size: 0.95rem;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .quick-action-info p {
        font-size: 0.8rem;
        color: var(--gray-400);
    }

    .quick-action-arrow {
        color: var(--gray-400);
    }

    @media (max-width: 1200px) {
        .metrics-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 991px) {
        .dashboard-sections {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 576px) {
        .metrics-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<!-- ── Welcome Card ── -->
<div class="welcome-panel animate-fadeInUp">
    <h2>Selamat Datang Kembali, <span class="gradient-text">{{ session('admin_name') ?? 'Admin' }}</span>!</h2>
    <p>Di sini Anda dapat mengelola seluruh konten website profil PT. ITS, mengunggah logo klien, memperbarui artikel informasi, dan mengambil alih obrolan chatbot interaktif dari pengunjung.</p>
</div>

<!-- ── Live Chat Alert Banner ── -->
<div id="live-chat-alert-banner" class="glass-panel animate-fadeInUp" style="display: none; background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.2); margin-bottom: 32px; padding: 20px 24px; align-items: center; justify-content: space-between; gap: 16px; border-radius: var(--radius-md);">
    <div style="display: flex; align-items: center; gap: 16px;">
        <div style="background: rgba(239, 68, 68, 0.15); width: 48px; height: 48px; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #fca5a5; border: 1px solid rgba(239, 68, 68, 0.3);">
            <i data-lucide="bell" style="width: 22px; height: 22px; animation: float 3s ease-in-out infinite;"></i>
        </div>
        <div>
            <h4 style="font-size: 1.05rem; font-weight: 700; color: #fca5a5; margin: 0 0 4px 0;">Notifikasi Chat Masuk</h4>
            <p style="font-size: 0.9rem; color: var(--gray-300); margin: 0;" id="live-chat-alert-text">Ada pengunjung yang menunggu tanggapan Anda.</p>
        </div>
    </div>
    <a href="/admin/chat" class="btn" style="background: linear-gradient(135deg, #ef4444, #b91c1c); color: white; padding: 10px 20px; font-size: 0.85rem; border-radius: 8px; font-weight: 700; border: none; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3); transition: var(--transition);">
        <span>Balas Sekarang</span>
        <i data-lucide="arrow-right" style="width: 16px; height: 16px;"></i>
    </a>
</div>


<!-- ── Metrics Grid ── -->
<div class="metrics-grid">
    <!-- Services Metric -->
    <div class="metric-card metric-services">
        <div class="metric-card-info">
            <h3>Layanan Kami</h3>
            <div class="value">{{ $servicesCount }}</div>
        </div>
        <div class="metric-icon-box">
            <i data-lucide="wrench" style="width: 24px; height: 24px;"></i>
        </div>
    </div>

    <!-- Articles Metric -->
    <div class="metric-card metric-articles">
        <div class="metric-card-info">
            <h3>Artikel</h3>
            <div class="value">{{ $articlesCount }}</div>
        </div>
        <div class="metric-icon-box">
            <i data-lucide="file-text" style="width: 24px; height: 24px;"></i>
        </div>
    </div>

    <!-- Active Chats Metric -->
    <div class="metric-card metric-chats">
        <div class="metric-card-info">
            <h3>Chat Aktif</h3>
            <div class="value" id="dashboard-active-chats-value">{{ $activeChatsCount }}</div>
        </div>
        <div class="metric-icon-box">
            <i data-lucide="message-square" style="width: 24px; height: 24px;"></i>
            <div class="badge-pulse" id="dashboard-active-chats-pulse" style="{{ $activeChatsCount > 0 ? '' : 'display: none;' }}"></div>
        </div>
    </div>

    <!-- Traffic Year -->
    <div class="metric-card" style="background: linear-gradient(135deg, rgba(14, 165, 233, 0.08), rgba(10, 22, 40, 0.5)); border-color: rgba(14, 165, 233, 0.15);">
        <div class="metric-card-info">
            <h3 style="color: rgba(14, 165, 233, 0.8);">Trafik Tahun Ini</h3>
            <div class="value">{{ $trafficYear }}</div>
        </div>
        <div class="metric-icon-box" style="background: rgba(14, 165, 233, 0.12); color: #38bdf8; border: 1px solid rgba(14, 165, 233, 0.25);">
            <i data-lucide="globe" style="width: 24px; height: 24px;"></i>
        </div>
    </div>
</div>

<div class="dashboard-sections">
    <!-- Left panel: Recent Active Chats -->
    <div class="glass-panel">
        <div class="panel-header">
            <h2>
                <i data-lucide="message-square" style="color: var(--blue-300);"></i>
                <span>Sesi Sembang Aktif (Live Chat)</span>
            </h2>
            <a href="/admin/chat" class="btn btn-outline" style="padding: 6px 14px; font-size: 0.8rem; border-radius: 6px;">Buka Konsol</a>
        </div>

        <div class="table-container">
            @if(count($recentChats) > 0)
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Nama Pengguna</th>
                            <th>Status Sesi</th>
                            <th>Dibuat Pada</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentChats as $chat)
                            <tr>
                                <td style="font-weight: 700;">{{ $chat->user_name }}</td>
                                <td>
                                    <span class="badge-status badge-status-active">Diambil Alih</span>
                                </td>
                                <td>{{ $chat->created_at->translatedFormat('d M Y, H:i') }}</td>
                                <td>
                                    <a href="/admin/chat?session={{ $chat->id }}" class="btn-table-action" title="Buka Percakapan">
                                        <i data-lucide="message-circle" style="width:16px; height:16px;"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div style="text-align: center; padding: 40px 0; color: var(--gray-400);">
                    <i data-lucide="message-square" style="width: 48px; height: 48px; opacity: 0.3; margin-bottom: 12px;"></i>
                    <p>Tidak ada sesi live chat aktif saat ini.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Right panel: Quick Actions -->
    <div class="glass-panel">
        <div class="panel-header">
            <h2>
                <i data-lucide="sparkles" style="color: var(--accent);"></i>
                <span>Aksi Cepat</span>
            </h2>
        </div>

        <div class="quick-action-list">
            <a href="/admin/services" class="quick-action-card">
                <div class="quick-action-icon">
                    <i data-lucide="wrench"></i>
                </div>
                <div class="quick-action-info">
                    <h4>Kelola Layanan</h4>
                    <p>Edit kartu penawaran jasa IT</p>
                </div>
                <i data-lucide="chevron-right" class="quick-action-arrow" style="width: 18px;"></i>
            </a>

            <a href="/admin/clients" class="quick-action-card">
                <div class="quick-action-icon" style="background: rgba(245, 158, 11, 0.1); color: var(--accent-light);">
                    <i data-lucide="users"></i>
                </div>
                <div class="quick-action-info">
                    <h4>Tambah Logo Klien</h4>
                    <p>Unggah nama mitra kerja baru</p>
                </div>
                <i data-lucide="chevron-right" class="quick-action-arrow" style="width: 18px;"></i>
            </a>

            <a href="/admin/information" class="quick-action-card">
                <div class="quick-action-icon" style="background: rgba(16, 185, 129, 0.1); color: #34d399;">
                    <i data-lucide="file-text"></i>
                </div>
                <div class="quick-action-info">
                    <h4>Tulis Artikel Baru</h4>
                    <p>Bagikan tips IT dan info keamanan</p>
                </div>
                <i data-lucide="chevron-right" class="quick-action-arrow" style="width: 18px;"></i>
            </a>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Real-time notification check on Dashboard
    async function checkDashboardPendingChats() {
        try {
            // Update notification banner and pending chats count
            const res = await fetch('/admin/chat/pending-count');
            if (res.ok) {
                const data = await res.json();
                const alertBanner = document.getElementById('live-chat-alert-banner');
                const alertText = document.getElementById('live-chat-alert-text');
                
                if (alertBanner && alertText) {
                    if (data.count > 0) {
                        // SECURITY: Parse as integer to prevent HTML injection from API response
                        const safeCount = parseInt(data.count, 10) || 0;
                        alertText.innerHTML = 'Ada <b>' + safeCount + '</b> sesi obrolan pengunjung yang sedang menunggu tanggapan Anda.';
                        alertBanner.style.display = 'flex';
                    } else {
                        alertBanner.style.display = 'none';
                    }
                }
            }

            // Also check total active sessions to keep metric card updated in real-time
            const resSessions = await fetch('/admin/chat/sessions');
            if (resSessions.ok) {
                const sessions = await resSessions.json();
                const activeCount = sessions.filter(s => s.is_active).length;
                
                const valueEl = document.getElementById('dashboard-active-chats-value');
                const pulseEl = document.getElementById('dashboard-active-chats-pulse');
                
                if (valueEl) valueEl.textContent = activeCount;
                if (pulseEl) {
                    pulseEl.style.display = activeCount > 0 ? 'block' : 'none';
                }
            }
        } catch (err) {
            console.error('Error checking pending chats on dashboard:', err);
        }
    }

    // Run initially and then check every 5 seconds
    checkDashboardPendingChats();
    setInterval(checkDashboardPendingChats, 5000);
</script>
@endsection
