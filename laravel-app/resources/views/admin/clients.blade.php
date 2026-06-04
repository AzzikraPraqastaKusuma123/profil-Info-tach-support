@extends('admin.layout')

@section('title', 'Kelola Logo Mitra Klien')
@section('page-title', 'Kelola Logo Mitra Klien')

@section('styles')
<style>
    .clients-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 24px;
        margin-top: 24px;
    }

    .client-admin-card {
        background: var(--card-glass);
        border: 1px solid var(--border-glass);
        border-radius: var(--radius-md);
        padding: 24px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: var(--transition);
        position: relative;
        text-align: center;
    }

    .client-admin-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(59, 130, 246, 0.1);
        border-color: rgba(59, 130, 246, 0.2);
    }

    .logo-container {
        width: 100%;
        height: 120px;
        background: rgba(255, 255, 255, 0.02);
        border: 1px solid var(--border-glass);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 16px;
        overflow: hidden;
    }

    .logo-container img {
        max-width: 85%;
        max-height: 85%;
        object-fit: contain;
        filter: drop-shadow(0 4px 8px rgba(0,0,0,0.3));
    }

    .client-name {
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 4px;
        color: var(--white);
    }

    .client-industry {
        font-size: 0.8rem;
        color: var(--blue-300);
        background: rgba(59, 130, 246, 0.08);
        padding: 3px 10px;
        border-radius: 99px;
        border: 1px solid rgba(59, 130, 246, 0.15);
        display: inline-block;
        margin-bottom: 16px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 700;
    }

    .card-actions {
        display: flex;
        gap: 12px;
        border-top: 1px solid rgba(255, 255, 255, 0.05);
        padding-top: 16px;
    }

    .action-btn {
        flex: 1;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 10px;
        border-radius: var(--radius-sm);
        font-size: 0.85rem;
        font-weight: 600;
        cursor: pointer;
        border: none;
        transition: var(--transition);
    }

    .btn-edit {
        background: rgba(255, 255, 255, 0.05);
        color: var(--white);
        border: 1px solid var(--border-glass);
    }

    .btn-edit:hover {
        background: rgba(255, 255, 255, 0.1);
    }

    .btn-delete {
        background: rgba(239, 68, 68, 0.1);
        color: #fca5a5;
        border: 1px solid rgba(239, 68, 68, 0.2);
    }

    .btn-delete:hover {
        background: rgba(239, 68, 68, 0.2);
        color: #ef4444;
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
        max-height: 90vh;
        overflow-y: auto;
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

    .logo-upload-preview {
        width: 100%;
        height: 150px;
        border: 2px dashed rgba(255, 255, 255, 0.1);
        border-radius: var(--radius-sm);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 10px;
        overflow: hidden;
        background: rgba(0,0,0,0.2);
    }

    .logo-upload-placeholder {
        color: var(--gray-400);
        font-size: 0.85rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
    }

    @keyframes scaleUp {
        from { transform: scale(0.95); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }

    @media (max-width: 1200px) {
        .clients-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 768px) {
        .clients-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 480px) {
        .clients-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<div class="glass-panel">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 24px; gap: 16px; flex-wrap: wrap;">
        <p style="color: var(--gray-400); font-size: 0.95rem;">Kelola daftar logo dan industri mitra kerja sama (klien) PT. Info Tech Support.</p>
        <button class="btn btn-primary" onclick="openCreateModal()">
            <i data-lucide="plus" style="width:18px; height:18px;"></i>
            <span>Tambah Klien</span>
        </button>
    </div>

    <div class="clients-grid">
        @foreach($clients as $client)
            <div class="client-admin-card">
                <div>
                    <div class="logo-container">
                        <img src="{{ asset($client->logo) }}" alt="{{ $client->name }}">
                    </div>
                    <h3 class="client-name">{{ $client->name }}</h3>
                    <div class="client-industry">{{ $client->industry }}</div>
                </div>

                <div class="card-actions">
                    <button class="action-btn btn-edit" onclick="openEditModal({{ json_encode($client) }})">
                        <i data-lucide="edit-3" style="width:14px; height:14px;"></i>
                        <span>Edit</span>
                    </button>
                    <form action="{{ route('admin.clients.delete', $client->id) }}" method="POST" style="flex: 1;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus mitra klien ini?')">
                        @csrf
                        <button type="submit" class="action-btn btn-delete" style="width:100%;">
                            <i data-lucide="trash-2" style="width:14px; height:14px;"></i>
                            <span>Hapus</span>
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- ── MODAL FORM ── -->
<div class="modal" id="client-modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" id="modal-title">Tambah Klien</h3>
            <button class="close-modal" onclick="closeModal()">
                <i data-lucide="x" style="width:24px; height:24px;"></i>
            </button>
        </div>
        <form id="client-form" method="POST" action="{{ route('admin.clients.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="admin-form-group">
                    <label class="admin-label" for="name">Nama Mitra Klien</label>
                    <input type="text" name="name" id="name" class="admin-input" placeholder="Contoh: PT. Toyota Indonesia" required>
                </div>

                <div class="admin-form-group">
                    <label class="admin-label" for="industry">Sektor Industri</label>
                    <input type="text" name="industry" id="industry" class="admin-input" placeholder="Contoh: Manufaktur, Telekomunikasi, Keuangan" required>
                </div>

                <div class="admin-form-group">
                    <label class="admin-label" for="logo-input" id="logo-label">File Logo Mitra</label>
                    <input type="file" name="logo" id="logo-input" class="admin-input" accept="image/*" onchange="previewImage(this)">
                    <p style="font-size: 0.75rem; color: var(--gray-400); margin-top: 6px;">Format file: png, jpg, jpeg, svg, webp. Ukuran file maksimal: 2MB.</p>
                    
                    <div class="logo-upload-preview">
                        <div class="logo-upload-placeholder" id="logo-placeholder">
                            <i data-lucide="image" style="width:32px; height:32px;"></i>
                            <span>Belum ada file dipilih</span>
                        </div>
                        <img id="logo-preview-img" style="display:none; max-width: 100%; max-height: 100%; object-fit: contain;" src="" alt="Pratinjau logo">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline" style="padding: 10px 20px;" onclick="closeModal()">Batal</button>
                <button type="submit" class="btn btn-primary" style="padding: 10px 24px;">Simpan Klien</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const modal = document.getElementById('client-modal');
    const form = document.getElementById('client-form');
    const modalTitle = document.getElementById('modal-title');
    const logoInput = document.getElementById('logo-input');
    const logoPreviewImg = document.getElementById('logo-preview-img');
    const placeholder = document.getElementById('logo-placeholder');
    const logoLabel = document.getElementById('logo-label');

    function openCreateModal() {
        modalTitle.textContent = "Tambah Klien";
        form.action = "{{ route('admin.clients.store') }}";
        form.reset();
        logoInput.required = true;
        logoLabel.textContent = "File Logo Mitra (Wajib)";
        
        logoPreviewImg.style.display = 'none';
        placeholder.style.display = 'flex';
        
        modal.classList.add('show');
        lucide.createIcons();
    }

    function openEditModal(client) {
        modalTitle.textContent = "Edit Klien";
        form.action = `/admin/clients/${client.id}/update`;
        form.reset();
        logoInput.required = false;
        logoLabel.textContent = "Ganti Logo Mitra (Opsional)";

        document.getElementById('name').value = client.name;
        document.getElementById('industry').value = client.industry;

        if (client.logo) {
            logoPreviewImg.src = client.logo;
            logoPreviewImg.style.display = 'block';
            placeholder.style.display = 'none';
        } else {
            logoPreviewImg.style.display = 'none';
            placeholder.style.display = 'flex';
        }

        modal.classList.add('show');
        lucide.createIcons();
    }

    function closeModal() {
        modal.classList.remove('show');
    }

    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                logoPreviewImg.src = e.target.result;
                logoPreviewImg.style.display = 'block';
                placeholder.style.display = 'none';
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            logoPreviewImg.style.display = 'none';
            placeholder.style.display = 'flex';
        }
    }
</script>
@endsection
