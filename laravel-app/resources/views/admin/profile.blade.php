@extends('admin.layout')

@section('title', 'Profil Saya')
@section('page-title', 'Profil Saya')

@section('styles')
<style>
    .profile-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 32px;
        align-items: start;
    }

    .profile-sidebar {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .profile-card-header {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 24px;
    }

    .profile-avatar-large {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--blue-400), var(--accent));
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        font-weight: 800;
        color: var(--white);
        border: 3px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 10px 25px rgba(59, 130, 246, 0.25);
    }

    .profile-title-info h3 {
        font-size: 1.3rem;
        font-weight: 800;
        margin: 0 0 4px 0;
    }

    .profile-title-info p {
        color: var(--gray-400);
        margin: 0;
        font-size: 0.85rem;
    }

    .session-log-card {
        padding: 16px 20px;
        background: rgba(255, 255, 255, 0.02);
        border: 1px solid var(--border-glass);
        border-radius: var(--radius-sm);
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .session-icon {
        width: 42px;
        height: 42px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .session-icon-login {
        background: rgba(16, 185, 129, 0.1);
        color: #34d399;
        border: 1px solid rgba(16, 185, 129, 0.2);
    }

    .session-icon-logout {
        background: rgba(239, 68, 68, 0.1);
        color: #fca5a5;
        border: 1px solid rgba(239, 68, 68, 0.2);
    }

    .session-info {
        flex-grow: 1;
    }

    .session-info h5 {
        font-size: 0.8rem;
        text-transform: uppercase;
        color: var(--gray-400);
        margin: 0 0 4px 0;
        letter-spacing: 0.5px;
    }

    .session-info p {
        font-size: 0.95rem;
        font-weight: 700;
        margin: 0;
        color: var(--white);
    }

    @media (max-width: 991px) {
        .profile-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<div class="profile-grid">
    <!-- Left Column: Edit Profile & Password -->
    <div class="profile-sidebar">
        <!-- Edit Profile Panel -->
        <div class="glass-panel animate-fadeInUp">
            <div class="profile-card-header">
                <div class="profile-avatar-large">
                    {{ strtoupper(substr($admin->name, 0, 1)) }}
                </div>
                <div class="profile-title-info">
                    <h3>{{ $admin->name }}</h3>
                    <p>Admin Username: <code>{{ $admin->username }}</code></p>
                </div>
            </div>
            
            <form action="{{ route('admin.profile.update') }}" method="POST">
                @csrf
                <div class="admin-form-group">
                    <label class="admin-label" for="profile-name">Nama Lengkap *</label>
                    <input type="text" id="profile-name" name="name" class="admin-input" value="{{ $admin->name }}" required />
                </div>
                <div class="admin-form-group">
                    <label class="admin-label" for="profile-username">Username *</label>
                    <input type="text" id="profile-username" name="username" class="admin-input" value="{{ $admin->username }}" required />
                </div>
                <button type="submit" class="btn btn-accent" style="width: 100%; display: flex; align-items: center; justify-content: center; gap: 8px; margin-top: 8px;">
                    <i data-lucide="save" style="width: 18px; height: 18px;"></i>
                    <span>Simpan Perubahan Profil</span>
                </button>
            </form>
        </div>

        <!-- Session Logs Info Card -->
        <div class="glass-panel animate-fadeInUp" style="animation-delay: 0.1s;">
            <div class="panel-header" style="margin-bottom: 20px;">
                <h2 style="font-size: 1.05rem;"><i data-lucide="history" style="color: var(--blue-300);"></i> Riwayat Sesi Pengguna</h2>
            </div>
            <div style="display: flex; flex-direction: column; gap: 16px;">
                <!-- Last Login -->
                <div class="session-log-card">
                    <div class="session-icon session-icon-login">
                        <i data-lucide="log-in" style="width: 20px; height: 20px;"></i>
                    </div>
                    <div class="session-info">
                        <h5>Terakhir Masuk (Login)</h5>
                        <p>
                            @if($admin->last_login_at)
                                {{ $admin->last_login_at->translatedFormat('l, d M Y - H:i:s') }}
                            @else
                                <span style="color: var(--gray-400); font-weight: normal; font-size: 0.85rem;">Tidak tercatat</span>
                            @endif
                        </p>
                    </div>
                </div>

                <!-- Last Logout -->
                <div class="session-log-card">
                    <div class="session-icon session-icon-logout">
                        <i data-lucide="log-out" style="width: 20px; height: 20px;"></i>
                    </div>
                    <div class="session-info">
                        <h5>Terakhir Keluar (Logout)</h5>
                        <p>
                            @if($admin->last_logout_at)
                                {{ $admin->last_logout_at->translatedFormat('l, d M Y - H:i:s') }}
                            @else
                                <span style="color: var(--gray-400); font-weight: normal; font-size: 0.85rem;">Tidak tercatat</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column: Change Password -->
    <div class="glass-panel animate-fadeInUp" style="animation-delay: 0.15s;">
        <div class="panel-header" style="margin-bottom: 20px;">
            <h2 style="font-size: 1.05rem;"><i data-lucide="shield-alert" style="color: var(--accent);"></i> Pengaturan Keamanan Password</h2>
        </div>
        
        <form action="{{ route('admin.profile.update-password') }}" method="POST">
            @csrf
            <div class="admin-form-group">
                <label class="admin-label" for="current_password">Password Saat Ini *</label>
                <input type="password" id="current_password" name="current_password" class="admin-input" placeholder="Masukkan password Anda saat ini" required />
            </div>
            <div class="admin-form-group" style="margin-top: 24px; border-top: 1px solid var(--border-glass); padding-top: 20px;">
                <label class="admin-label" for="new_password">Password Baru *</label>
                <input type="password" id="new_password" name="new_password" class="admin-input" placeholder="Min. 6 karakter" required />
            </div>
            <div class="admin-form-group">
                <label class="admin-label" for="new_password_confirmation">Konfirmasi Password Baru *</label>
                <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="admin-input" placeholder="Ketik ulang password baru Anda" required />
            </div>
            <button type="submit" class="btn btn-accent" style="width: 100%; display: flex; align-items: center; justify-content: center; gap: 8px; margin-top: 8px;">
                <i data-lucide="key-round" style="width: 18px; height: 18px;"></i>
                <span>Perbarui Password</span>
            </button>
        </form>
    </div>
</div>
@endsection
