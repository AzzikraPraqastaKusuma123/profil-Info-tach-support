@extends('admin.layout')

@section('title', 'Kelola Admin')
@section('page-title', 'Kelola Admin')

@section('styles')
<style>
    .users-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
    }

    /* Modal styling */
    .modal {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.6);
        backdrop-filter: blur(10px);
        z-index: 1000;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .modal.show {
        display: flex;
    }

    .modal-content {
        background: #0b1528;
        border: 1px solid var(--border-glass);
        border-radius: var(--radius-lg);
        width: 100%;
        max-width: 500px;
        box-shadow: 0 20px 50px rgba(0,0,0,0.5);
        animation: scaleUp 0.3s cubic-bezier(0.16, 1, 0.3, 1) both;
    }

    .modal-header {
        padding: 20px 24px;
        border-bottom: 1px solid var(--border-glass);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .modal-title {
        font-size: 1.2rem;
        font-weight: 700;
    }

    .close-modal {
        background: transparent;
        border: none;
        color: var(--gray-400);
        cursor: pointer;
    }

    .close-modal:hover {
        color: var(--white);
    }

    .modal-body {
        padding: 24px;
    }

    .modal-footer {
        padding: 20px 24px;
        border-top: 1px solid var(--border-glass);
        display: flex;
        justify-content: flex-end;
        gap: 12px;
    }

    .btn-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border-radius: 6px;
        background: rgba(255,255,255,0.05);
        color: var(--gray-400);
        border: 1px solid var(--border-glass);
        cursor: pointer;
        transition: var(--transition);
    }

    .btn-edit-pass:hover {
        background: rgba(245, 158, 11, 0.2);
        color: #f59e0b;
        border-color: #f59e0b;
    }

    .btn-delete:hover {
        background: rgba(239, 68, 68, 0.2);
        color: #ef4444;
        border-color: #ef4444;
    }

    @keyframes scaleUp {
        from { transform: scale(0.95); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }
</style>
@endsection

@section('content')
<div class="users-header">
    <p style="color: var(--gray-400); font-size: 0.95rem;">Kelola hak akses panel admin dan daftarkan rekan teknisi baru ke sistem.</p>
    <button onclick="openAddModal()" class="btn btn-accent" style="display: flex; align-items: center; gap: 8px;">
        <i data-lucide="user-plus" style="width: 18px; height: 18px;"></i>
        <span>Tambah Admin Baru</span>
    </button>
</div>

<!-- ── Admin List Panel ── -->
<div class="glass-panel animate-fadeInUp">
    <div class="table-container">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Nama Lengkap</th>
                    <th>Username</th>
                    <th>Ditambahkan Pada</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($admins as $admin)
                    <tr>
                        <td style="font-weight: 700;">{{ $admin->name }}</td>
                        <td><code>{{ $admin->username }}</code></td>
                        <td>{{ $admin->created_at->translatedFormat('d M Y') }}</td>
                        <td>
                            <div style="display: flex; gap: 8px;">
                                <button onclick="openChangePasswordModal({{ $admin->id }}, '{{ $admin->name }}')" class="btn-action btn-edit-pass" title="Ubah Password">
                                    <i data-lucide="key-round" style="width:16px; height:16px;"></i>
                                </button>
                                
                                @if($admin->id != session('admin_id'))
                                    <form action="{{ route('admin.users.delete', $admin->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun admin {{ $admin->name }}? Action ini tidak dapat di-rollback.');" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn-action btn-delete" title="Hapus Admin">
                                            <i data-lucide="trash-2" style="width:16px; height:16px;"></i>
                                        </button>
                                    </form>
                                @else
                                    <span style="font-size: 0.8rem; color: #60a5fa; background: rgba(59,130,246,0.15); border: 1px dashed rgba(59,130,246,0.3); padding: 4px 8px; border-radius: 4px; font-weight: 600;">Sesi Aktif Anda</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- ── Modal: Tambah Admin Baru ── -->
<div class="modal" id="add-modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Registrasi Admin Baru</h3>
            <button onclick="closeAddModal()" class="close-modal"><i data-lucide="x"></i></button>
        </div>
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="admin-form-group">
                    <label class="admin-label" for="add-name">Nama Lengkap *</label>
                    <input type="text" id="add-name" name="name" class="admin-input" placeholder="Nama Lengkap Admin" required />
                </div>
                <div class="admin-form-group">
                    <label class="admin-label" for="add-username">Username *</label>
                    <input type="text" id="add-username" name="username" class="admin-input" placeholder="Username untuk log-in" required />
                </div>
                <div class="admin-form-group">
                    <label class="admin-label" for="add-password">Password Kredensial *</label>
                    <input type="password" id="add-password" name="password" class="admin-input" placeholder="Min. 6 karakter" required />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="closeAddModal()" class="btn btn-outline" style="padding: 10px 20px;">Batal</button>
                <button type="submit" class="btn btn-accent" style="padding: 10px 20px;">Daftarkan Admin</button>
            </div>
        </form>
    </div>
</div>

<!-- ── Modal: Ganti Password Admin ── -->
<div class="modal" id="password-modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" id="password-modal-title">Ganti Password Admin</h3>
            <button onclick="closePasswordModal()" class="close-modal"><i data-lucide="x"></i></button>
        </div>
        <form id="password-form" method="POST">
            @csrf
            <div class="modal-body">
                <div class="admin-form-group">
                    <label class="admin-label" for="new-password">Password Baru *</label>
                    <input type="password" id="new-password" name="password" class="admin-input" placeholder="Min. 6 karakter" required />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="closePasswordModal()" class="btn btn-outline" style="padding: 10px 20px;">Batal</button>
                <button type="submit" class="btn btn-accent" style="padding: 10px 20px;">Simpan Password</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Add Modal functions
    const addModal = document.getElementById('add-modal');
    function openAddModal() {
        addModal.classList.add('show');
    }
    function closeAddModal() {
        addModal.classList.remove('show');
    }

    // Password Modal functions
    const passwordModal = document.getElementById('password-modal');
    const passwordForm = document.getElementById('password-form');
    const passwordTitle = document.getElementById('password-modal-title');

    function openChangePasswordModal(id, name) {
        passwordForm.setAttribute('action', `/admin/users/${id}/update-password`);
        passwordTitle.textContent = `Ubah Password: ${name}`;
        passwordModal.classList.add('show');
    }
    function closePasswordModal() {
        passwordModal.classList.remove('show');
        passwordForm.removeAttribute('action');
    }

    // Click outside to close modals
    window.addEventListener('click', (e) => {
        if (e.target === addModal) closeAddModal();
        if (e.target === passwordModal) closePasswordModal();
    });
</script>
@endsection
