<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') - Info Tech Support</title>
    
    <!-- Favicon / Browser Tab Logo -->
    <link rel="shortcut icon" href="{{ asset('logo.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('logo.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        :root {
            --sidebar-width: 280px;
            --admin-bg: #070f1e;
            --card-glass: rgba(15, 32, 64, 0.4);
            --border-glass: rgba(255, 255, 255, 0.08);
            --header-height: 70px;
        }

        body {
            background-color: var(--admin-bg);
            color: var(--white);
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            overflow-x: hidden;
        }

        /* ── SIDEBAR ── */
        .sidebar {
            width: var(--sidebar-width);
            background: rgba(10, 22, 40, 0.7);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border-right: 1px solid var(--border-glass);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            transition: var(--transition);
        }

        .sidebar-brand {
            padding: 24px;
            border-bottom: 1px solid var(--border-glass);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-icon {
            background: linear-gradient(135deg, var(--blue-400), var(--navy-500));
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
        }

        .brand-name {
            font-weight: 800;
            font-size: 1.2rem;
            letter-spacing: 0.5px;
        }

        .brand-name span {
            color: var(--blue-300);
        }

        .sidebar-menu {
            padding: 24px 16px;
            display: flex;
            flex-direction: column;
            gap: 8px;
            flex-grow: 1;
            overflow-y: auto;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-radius: var(--radius-sm);
            color: var(--gray-400);
            font-weight: 600;
            font-size: 0.95rem;
            transition: var(--transition);
        }

        .menu-item:hover {
            color: var(--white);
            background: rgba(255, 255, 255, 0.05);
        }

        .menu-item.active {
            color: var(--white);
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.2), rgba(30, 77, 140, 0.2));
            border: 1px solid rgba(59, 130, 246, 0.3);
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.1);
        }

        .menu-item-icon {
            width: 20px;
            height: 20px;
        }

        .sidebar-footer {
            padding: 20px 16px;
            border-top: 1px solid var(--border-glass);
        }

        .logout-btn {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-radius: var(--radius-sm);
            color: #fca5a5;
            font-weight: 600;
            font-size: 0.95rem;
            transition: var(--transition);
            width: 100%;
            background: transparent;
            border: none;
            cursor: pointer;
            text-align: left;
        }

        .logout-btn:hover {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
        }

        /* ── MAIN CONTENT ── */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            position: relative;
            z-index: 10;
        }

        /* ── TOP HEADER ── */
        .admin-header {
            height: var(--header-height);
            border-bottom: 1px solid var(--border-glass);
            background: rgba(10, 22, 40, 0.4);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            position: sticky;
            top: 0;
            z-index: 90;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .mobile-toggle {
            display: none;
            background: transparent;
            border: none;
            color: var(--white);
            cursor: pointer;
        }

        .page-title-text {
            font-size: 1.25rem;
            font-weight: 700;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--blue-400), var(--accent));
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: var(--white);
            border: 2px solid var(--border-glass);
        }

        .user-info {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-weight: 700;
            font-size: 0.9rem;
        }

        .user-role {
            font-size: 0.75rem;
            color: var(--gray-400);
        }

        /* ── PAGE LAYOUT ── */
        .content-body {
            padding: 32px;
            flex-grow: 1;
            overflow-y: auto;
        }

        /* ── GLASS CONTAINER ── */
        .glass-panel {
            background: var(--card-glass);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid var(--border-glass);
            border-radius: var(--radius-md);
            padding: 24px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        /* Forms in admin panels */
        .admin-form-group {
            margin-bottom: 20px;
        }

        .admin-label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--gray-200);
            margin-bottom: 8px;
        }

        .admin-input, .admin-select, .admin-textarea {
            width: 100%;
            background: rgba(5, 13, 26, 0.5);
            border: 1px solid var(--border-glass);
            border-radius: var(--radius-sm);
            padding: 12px;
            color: var(--white);
            font-family: inherit;
            font-size: 0.95rem;
            transition: var(--transition);
        }

        .admin-input:focus, .admin-select:focus, .admin-textarea:focus {
            outline: none;
            border-color: var(--blue-400);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
            background: rgba(5, 13, 26, 0.7);
        }

        /* Custom notifications */
        .toast-container {
            position: fixed;
            top: 24px;
            right: 24px;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            gap: 12px;
            max-width: 380px;
            width: 100%;
        }

        .toast {
            padding: 16px;
            border-radius: var(--radius-sm);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            display: flex;
            align-items: center;
            gap: 12px;
            animation: slideInRight 0.3s cubic-bezier(0.16, 1, 0.3, 1) both;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .toast-success {
            background: rgba(16, 185, 129, 0.15);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: #a7f3d0;
        }

        .toast-error {
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fca5a5;
        }

        @keyframes slideInRight {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 991px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .main-wrapper {
                margin-left: 0;
            }
            .mobile-toggle {
                display: block;
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    @if(session('success') || session('error'))
        <div class="toast-container">
            @if(session('success'))
                <div class="toast toast-success" id="success-toast">
                    <i data-lucide="check-circle" style="flex-shrink:0;"></i>
                    <div>{{ session('success') }}</div>
                </div>
            @endif
            @if(session('error'))
                <div class="toast toast-error" id="error-toast">
                    <i data-lucide="alert-circle" style="flex-shrink:0;"></i>
                    <div>{{ session('error') }}</div>
                </div>
            @endif
        </div>
    @endif

    <!-- ── SIDEBAR ── -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <div class="brand-icon">
                <i data-lucide="shield-check"></i>
            </div>
            <div class="brand-name">PT.ITS<span> Admin</span></div>
        </div>

        <nav class="sidebar-menu">
            <a href="/admin/dashboard" class="menu-item {{ Request::is('admin/dashboard') || Request::is('admin') ? 'active' : '' }}">
                <i data-lucide="layout-dashboard" class="menu-item-icon"></i>
                <span>Dashboard</span>
            </a>
            <a href="/admin/services" class="menu-item {{ Request::is('admin/services*') ? 'active' : '' }}">
                <i data-lucide="wrench" class="menu-item-icon"></i>
                <span>Layanan Kami</span>
            </a>
            <a href="/admin/clients" class="menu-item {{ Request::is('admin/clients*') ? 'active' : '' }}">
                <i data-lucide="users" class="menu-item-icon"></i>
                <span>Logo Mitra Klien</span>
            </a>

            <a href="/admin/information" class="menu-item {{ Request::is('admin/information*') ? 'active' : '' }}">
                <i data-lucide="file-text" class="menu-item-icon"></i>
                <span>Informasi/Artikel</span>
            </a>
            <a href="/admin/chat" class="menu-item {{ Request::is('admin/chat*') ? 'active' : '' }}" style="display: flex; align-items: center; justify-content: space-between; width: 100%;">
                <span style="display: flex; align-items: center; gap: 12px;">
                    <i data-lucide="message-square" class="menu-item-icon"></i>
                    <span>Live Chat Console</span>
                </span>
                <span id="chat-nav-badge" style="display: none; background: #ef4444; color: white; padding: 2px 8px; border-radius: 999px; font-size: 0.75rem; font-weight: 700;">0</span>
            </a>
            <a href="/admin/users" class="menu-item {{ Request::is('admin/users*') ? 'active' : '' }}">
                <i data-lucide="users-round" class="menu-item-icon"></i>
                <span>Kelola Admin</span>
            </a>
            <a href="/admin/profile" class="menu-item {{ Request::is('admin/profile*') ? 'active' : '' }}">
                <i data-lucide="user-cog" class="menu-item-icon"></i>
                <span>Profil Admin</span>
            </a>
        </nav>

        <div class="sidebar-footer">
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <button onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="logout-btn">
                <i data-lucide="log-out"></i>
                <span>Keluar</span>
            </button>
        </div>
    </div>

    <!-- ── MAIN WRAPPER ── -->
    <div class="main-wrapper">
        <!-- ── HEADER ── -->
        <header class="admin-header">
            <div class="header-left">
                <button class="mobile-toggle" id="mobile-toggle">
                    <i data-lucide="menu"></i>
                </button>
                <h1 class="page-title-text">@yield('page-title', 'Overview')</h1>
            </div>

            <div class="header-right">
                <a href="/admin/profile" class="user-profile" style="text-decoration: none; color: inherit; transition: var(--transition);">
                    <div class="avatar" style="transition: var(--transition);">
                        {{ strtoupper(substr(session('admin_name') ?? 'A', 0, 1)) }}
                    </div>
                    <div class="user-info">
                        <span class="user-name">{{ session('admin_name') ?? 'Admin' }}</span>
                        <span class="user-role">Administrator</span>
                    </div>
                </a>
            </div>
        </header>

        <!-- ── CONTENT BODY ── -->
        <main class="content-body">
            @yield('content')
        </main>
    </div>

    <script>
        // Init Lucide Icons
        lucide.createIcons();

        // Mobile Sidebar Toggle
        const mobileToggle = document.getElementById('mobile-toggle');
        const sidebar = document.getElementById('sidebar');
        if (mobileToggle && sidebar) {
            mobileToggle.addEventListener('click', (e) => {
                e.stopPropagation();
                sidebar.classList.toggle('show');
            });

            document.addEventListener('click', (e) => {
                if (!sidebar.contains(e.target) && sidebar.classList.contains('show')) {
                    sidebar.classList.remove('show');
                }
            });
        }

        // Auto close toast alert
        setTimeout(() => {
            const successToast = document.getElementById('success-toast');
            const errorToast = document.getElementById('error-toast');
            if (successToast) {
                successToast.style.transition = 'opacity 0.5s ease';
                successToast.style.opacity = '0';
                setTimeout(() => successToast.remove(), 500);
            }
            if (errorToast) {
                errorToast.style.transition = 'opacity 0.5s ease';
                errorToast.style.opacity = '0';
                setTimeout(() => errorToast.remove(), 500);
            }
        }, 4000);

        // Chat Notification Polling for Admin Nav Link
        async function checkPendingChats() {
            try {
                const res = await fetch('/admin/chat/pending-count');
                if (res.ok) {
                    const data = await res.json();
                    const badge = document.getElementById('chat-nav-badge');
                    if (badge) {
                        if (data.count > 0) {
                            badge.textContent = data.count;
                            badge.style.display = 'inline-block';
                        } else {
                            badge.style.display = 'none';
                        }
                    }
                }
            } catch (err) {
                console.error('Error fetching chat count:', err);
            }
        }
        
        checkPendingChats();
        setInterval(checkPendingChats, 5000);
    </script>
    @yield('scripts')
</body>
</html>
