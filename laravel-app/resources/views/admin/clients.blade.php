@extends('admin.layout')

@yield('title', 'Kelola Klien Kami')
@section('page-title', 'Kelola Klien Kami')

@section('styles')
<style>
    .clients-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
    }

    .client-logo-preview {
        width: 100px;
        height: 50px;
        object-fit: contain;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid var(--border-glass);
        border-radius: var(--radius-sm);
        padding: 4px;
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

    .logo-upload-preview {
        width: 100%;
        height: 120px;
        border: 2px dashed rgba(255, 255, 255, 0.1);
        border-radius: var(--radius-sm);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 10px;
        overflow: hidden;
        background: rgba(0,0,0,0.2);
    }

    .logo-upload-preview img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    .logo-upload-placeholder {
        color: var(--gray-400);
        font-size: 0.85rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
    }

    .admin-table-wrapper {
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
        vertical-align: middle;
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
        cursor: pointer;
    }

    .btn-table-action-edit:hover {
        background: var(--blue-400);
        color: var(--white);
        border-color: var(--blue-400);
    }

    .btn-table-action-delete:hover {
        background: rgba(239, 68, 68, 0.2);
        color: #ef4444;
        border-color: rgba(239, 68, 68, 0.3);
    }

    @keyframes scaleUp {
        from { transform: scale(0.95); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }
</style>
@endsection

@section('content')
<div class="glass-panel">
    <div class="clients-header">
        <p style="color: var(--gray-400); font-size: 0.95rem;">Kelola daftar klien/mitra usaha yang bekerja sama dengan PT. ITS untuk ditampilkan di halaman depan.</p>
        <button class="btn btn-primary" onclick="openCreateModal()">
            <i data-lucide="plus" style="width:18px; height:18px;"></i>
            <span>Tambah Mitra/Klien</span>
        </button>
    </div>

    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 80px;">No</th>
                    <th style="width: 160px;">Logo</th>
                    <th>Nama Perusahaan</th>
                    <th>Industri</th>
                    <th style="width: 120px; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clients as $index => $client)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            @if(str_starts_with($client->logo, '/clients/'))
                                <img src="{{ asset($client->logo) }}" alt="{{ $client->name }} logo" class="client-logo-preview">
                            @else
                                <img src="{{ $client->logo }}" alt="{{ $client->name }} logo" class="client-logo-preview">
                            @endif
                        </td>
                        <td style="font-weight: 700;">{{ $client->name }}</td>
                        <td>
                            <span class="category-badge">{{ $client->industry }}</span>
                        </td>
                        <td style="text-align: center;">
                            <div style="display: inline-flex; gap: 8px;">
                                <button class="btn-table-action btn-table-action-edit" onclick="openEditModal({{ json_encode($client) }})" title="Edit Mitra">
                                    <i data-lucide="edit-3" style="width:16px; height:16px;"></i>
                                </button>
                                <form action="{{ route('admin.clients.delete', $client->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus mitra ini?')">
                                    @csrf
                                    <button type="submit" class="btn-table-action btn-table-action-delete" title="Hapus Mitra">
                                        <i data-lucide="trash-2" style="width:16px; height:16px;"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- ── CLIENT MODAL FORM ── -->
<div class="modal" id="client-modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" id="modal-title">Tambah Mitra/Klien</h3>
            <button class="close-modal" onclick="closeModal()">
                <i data-lucide="x" style="width:24px; height:24px;"></i>
            </button>
        </div>
        <form id="client-form" method="POST" action="{{ route('admin.clients.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="admin-form-group">
                    <label class="admin-label" for="name">Nama Perusahaan / Instansi</label>
                    <input type="text" name="name" id="name" class="admin-input" placeholder="Contoh: PT. Toyota Indonesia" required>
                </div>

                <div class="admin-form-group">
                    <label class="admin-label" for="industry">Kategori Industri</label>
                    <input type="text" name="industry" id="industry" class="admin-input" placeholder="Contoh: Manufaktur, Otomotif, Logistik" required>
                </div>

                <div class="admin-form-group">
                    <label class="admin-label" for="logo-input">Logo Perusahaan</label>
                    <input type="file" name="logo" id="logo-input" class="admin-input" accept="image/*" onchange="previewImage(this)">
                    <p style="font-size: 0.75rem; color: var(--gray-400); margin-top: 6px;">Format gambar: png, jpg, jpeg, svg, webp. Maksimal 2MB.</p>
                    
                    <div class="logo-upload-preview" id="logo-preview-box">
                        <div class="logo-upload-placeholder" id="logo-placeholder">
                            <i data-lucide="image" style="width:32px; height:32px;"></i>
                            <span>Belum ada file dipilih</span>
                        </div>
                        <img id="logo-preview-img" style="display:none;" src="" alt="Pratinjau logo">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline" style="padding: 10px 20px;" onclick="closeModal()">Batal</button>
                <button type="submit" class="btn btn-primary" style="padding: 10px 24px;">Simpan Mitra</button>
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
    const previewBox = document.getElementById('logo-preview-box');
    const previewImg = document.getElementById('logo-preview-img');
    const placeholder = document.getElementById('logo-placeholder');

    function openCreateModal() {
        modalTitle.textContent = "Tambah Mitra/Klien";
        form.action = "{{ route('admin.clients.store') }}";
        form.reset();
        
        logoInput.required = true;
        previewImg.style.display = 'none';
        placeholder.style.display = 'flex';
        
        modal.classList.add('show');
        lucide.createIcons();
    }

    function openEditModal(client) {
        modalTitle.textContent = "Edit Mitra/Klien";
        form.action = `/admin/clients/${client.id}/update`;
        form.reset();

        document.getElementById('name').value = client.name;
        document.getElementById('industry').value = client.industry;
        logoInput.required = false;

        // Render current logo path in preview
        const logoUrl = client.logo.startsWith('/clients/') ? client.logo : client.logo;
        previewImg.src = logoUrl;
        previewImg.style.display = 'block';
        placeholder.style.display = 'none';

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
                previewImg.src = e.target.result;
                previewImg.style.display = 'block';
                placeholder.style.display = 'none';
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            previewImg.style.display = 'none';
            placeholder.style.display = 'flex';
        }
    }
</script>
@endsection
