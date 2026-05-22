@extends('admin.layout')

@section('title', 'Kelola Layanan Kami')
@section('page-title', 'Kelola Layanan Kami')

@section('styles')
<style>
    .services-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
        margin-top: 24px;
    }

    .service-admin-card {
        background: var(--card-glass);
        border: 1px solid var(--border-glass);
        border-radius: var(--radius-md);
        padding: 24px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: var(--transition);
        position: relative;
    }

    .service-admin-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(59, 130, 246, 0.1);
        border-color: rgba(59, 130, 246, 0.2);
    }

    .card-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        margin-bottom: 16px;
    }

    .icon-wrapper {
        background: rgba(59, 130, 246, 0.1);
        border: 1px solid rgba(59, 130, 246, 0.2);
        width: 48px;
        height: 48px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--blue-300);
    }

    .category-badge {
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        color: var(--accent-light);
        background: rgba(245, 158, 11, 0.1);
        padding: 4px 10px;
        border-radius: 99px;
        border: 1px solid rgba(245, 158, 11, 0.2);
    }

    .service-title {
        font-size: 1.2rem;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .service-desc {
        font-size: 0.9rem;
        color: var(--gray-400);
        margin-bottom: 16px;
        line-height: 1.5;
        flex-grow: 1;
    }

    .feature-list {
        display: flex;
        flex-direction: column;
        gap: 8px;
        margin-bottom: 24px;
        border-top: 1px solid rgba(255, 255, 255, 0.05);
        padding-top: 16px;
    }

    .feature-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.85rem;
        color: var(--gray-200);
    }

    .feature-item i {
        color: var(--blue-400);
        flex-shrink: 0;
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
        max-width: 600px;
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

    .features-input-container {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-top: 8px;
    }

    .feature-input-row {
        display: flex;
        gap: 10px;
    }

    .btn-add-feature {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--blue-300);
        background: transparent;
        border: none;
        cursor: pointer;
        margin-top: 8px;
    }

    .btn-remove-feature {
        background: rgba(239, 68, 68, 0.1);
        border: 1px solid rgba(239, 68, 68, 0.2);
        color: #fca5a5;
        border-radius: var(--radius-sm);
        width: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .btn-remove-feature:hover {
        background: rgba(239, 68, 68, 0.2);
        color: #ef4444;
    }

    @keyframes scaleUp {
        from { transform: scale(0.95); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }

    @media (max-width: 991px) {
        .services-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .services-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<div class="glass-panel">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 24px;">
        <p style="color: var(--gray-400); font-size: 0.95rem;">Kelola daftar layanan IT yang ditawarkan oleh PT. ITS kepada publik.</p>
        <button class="btn btn-primary" onclick="openCreateModal()">
            <i data-lucide="plus" style="width:18px; height:18px;"></i>
            <span>Tambah Layanan</span>
        </button>
    </div>

    <div class="services-grid">
        @foreach($services as $service)
            <div class="service-admin-card">
                <div>
                    <div class="card-top">
                        <div class="icon-wrapper">
                            <i data-lucide="{{ $service->icon }}" style="width: 24px; height: 24px;"></i>
                        </div>
                        <span class="category-badge">{{ $service->category }}</span>
                    </div>

                    @if($service->image)
                        <div style="width: 100%; height: 120px; border-radius: 8px; overflow: hidden; margin-bottom: 12px; border: 1px solid var(--border-glass);">
                            <img src="{{ asset($service->image) }}" alt="{{ $service->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                    @endif

                    <h3 class="service-title">{{ $service->title }}</h3>
                    <p class="service-desc">{{ $service->desc }}</p>

                    <div class="feature-list">
                        @if(is_array($service->features))
                            @foreach($service->features as $feature)
                                <div class="feature-item">
                                    <i data-lucide="check" style="width: 14px; height: 14px;"></i>
                                    <span>{{ $feature }}</span>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="card-actions">
                    <button class="action-btn btn-edit" onclick="openEditModal({{ json_encode($service) }})">
                        <i data-lucide="edit-3" style="width:14px; height:14px;"></i>
                        <span>Edit</span>
                    </button>
                    <form action="{{ route('admin.services.delete', $service->id) }}" method="POST" style="flex: 1;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus layanan ini?')">
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
<div class="modal" id="service-modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" id="modal-title">Tambah Layanan</h3>
            <button class="close-modal" onclick="closeModal()">
                <i data-lucide="x" style="width:24px; height:24px;"></i>
            </button>
        </div>
        <form id="service-form" method="POST" action="{{ route('admin.services.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="admin-form-group">
                    <label class="admin-label" for="title">Nama Layanan</label>
                    <input type="text" name="title" id="title" class="admin-input" placeholder="Contoh: Service Laptop & PC" required>
                </div>

                <div class="admin-form-group">
                    <label class="admin-label" for="category">Kategori</label>
                    <input type="text" name="category" id="category" class="admin-input" placeholder="Contoh: Hardware, Network, Security" required>
                </div>

                <div class="admin-form-group">
                    <label class="admin-label" for="icon">Icon (Nama Lucide Icon)</label>
                    <select name="icon" id="icon" class="admin-select" required>
                        <option value="wrench">Wrench (Kunci Inggris)</option>
                        <option value="monitor">Monitor (Komputer)</option>
                        <option value="wifi">Wifi (Jaringan)</option>
                        <option value="camera">Camera (CCTV/Kamera)</option>
                        <option value="globe">Globe (Web/Internet)</option>
                        <option value="headphones">Headphones (Konsultasi/IT Support)</option>
                        <option value="shield">Shield (Keamanan)</option>
                        <option value="server">Server</option>
                        <option value="cpu">CPU (Processor)</option>
                    </select>
                </div>

                <div class="admin-form-group">
                    <label class="admin-label" for="desc">Deskripsi Singkat</label>
                    <textarea name="desc" id="desc" class="admin-textarea" rows="3" placeholder="Masukkan deskripsi layanan secara detail..." required></textarea>
                </div>

                <div class="admin-form-group">
                    <label class="admin-label" for="image-input">Foto Banner Layanan (Opsional)</label>
                    <input type="file" name="image" id="image-input" class="admin-input" accept="image/*" onchange="previewImage(this)">
                    <p style="font-size: 0.75rem; color: var(--gray-400); margin-top: 6px;">Format gambar: png, jpg, jpeg, svg, webp. Maksimal 2MB. Kosongkan jika ingin memakai fallback icon default.</p>
                    
                    <div class="logo-upload-preview" id="image-preview-box" style="width: 100%; height: 150px; border: 2px dashed rgba(255, 255, 255, 0.1); border-radius: var(--radius-sm); display: flex; align-items: center; justify-content: center; margin-top: 10px; overflow: hidden; background: rgba(0,0,0,0.2);">
                        <div class="logo-upload-placeholder" id="image-placeholder" style="color: var(--gray-400); font-size: 0.85rem; display: flex; flex-direction: column; align-items: center; gap: 8px;">
                            <i data-lucide="image" style="width:32px; height:32px;"></i>
                            <span>Belum ada file dipilih</span>
                        </div>
                        <img id="image-preview-img" style="display:none; max-width: 100%; max-height: 100%; object-fit: contain;" src="" alt="Pratinjau gambar">
                    </div>
                </div>

                <div class="admin-form-group">
                    <label class="admin-label">Fitur / Sub-layanan (Min. 1)</label>
                    <div class="features-input-container" id="features-container">
                        <div class="feature-input-row">
                            <input type="text" name="features[]" class="admin-input" placeholder="Contoh: Ganti Layar LCD" required>
                        </div>
                    </div>
                    <button type="button" class="btn-add-feature" onclick="addFeatureInput()">
                        <i data-lucide="plus" style="width:14px; height:14px;"></i>
                        <span>Tambah Fitur</span>
                    </button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline" style="padding: 10px 20px;" onclick="closeModal()">Batal</button>
                <button type="submit" class="btn btn-primary" style="padding: 10px 24px;">Simpan Layanan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const modal = document.getElementById('service-modal');
    const form = document.getElementById('service-form');
    const modalTitle = document.getElementById('modal-title');
    const container = document.getElementById('features-container');
    const imageInput = document.getElementById('image-input');
    const previewBox = document.getElementById('image-preview-box');
    const previewImg = document.getElementById('image-preview-img');
    const placeholder = document.getElementById('image-placeholder');

    function openCreateModal() {
        modalTitle.textContent = "Tambah Layanan";
        form.action = "{{ route('admin.services.store') }}";
        form.reset();
        
        previewImg.style.display = 'none';
        placeholder.style.display = 'flex';
        
        // Reset features inputs to one empty
        container.innerHTML = `
            <div class="feature-input-row">
                <input type="text" name="features[]" class="admin-input" placeholder="Contoh: Ganti Layar LCD" required>
            </div>
        `;
        
        modal.classList.add('show');
        lucide.createIcons();
    }

    function openEditModal(service) {
        modalTitle.textContent = "Edit Layanan";
        form.action = `/admin/services/${service.id}/update`;
        form.reset();

        document.getElementById('title').value = service.title;
        document.getElementById('category').value = service.category;
        document.getElementById('icon').value = service.icon;
        document.getElementById('desc').value = service.desc;

        // Render current image in preview if exists
        if (service.image) {
            previewImg.src = service.image;
            previewImg.style.display = 'block';
            placeholder.style.display = 'none';
        } else {
            previewImg.style.display = 'none';
            placeholder.style.display = 'flex';
        }

        // Render features
        container.innerHTML = '';
        if (Array.isArray(service.features) && service.features.length > 0) {
            service.features.forEach((feature, idx) => {
                const row = document.createElement('div');
                row.className = 'feature-input-row';
                
                let deleteBtnHtml = '';
                if (idx > 0) {
                    deleteBtnHtml = `
                        <button type="button" class="btn-remove-feature" onclick="removeFeatureInput(this)">
                            <i data-lucide="trash-2" style="width:16px; height:16px;"></i>
                        </button>
                    `;
                }

                row.innerHTML = `
                    <input type="text" name="features[]" class="admin-input" placeholder="Fitur layanan" value="${feature}" required>
                    ${deleteBtnHtml}
                `;
                container.appendChild(row);
            });
        } else {
            container.innerHTML = `
                <div class="feature-input-row">
                    <input type="text" name="features[]" class="admin-input" placeholder="Fitur layanan" required>
                </div>
            `;
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

    function addFeatureInput() {
        const row = document.createElement('div');
        row.className = 'feature-input-row';
        row.innerHTML = `
            <input type="text" name="features[]" class="admin-input" placeholder="Fitur/Sub-layanan baru" required>
            <button type="button" class="btn-remove-feature" onclick="removeFeatureInput(this)">
                <i data-lucide="trash-2" style="width:16px; height:16px;"></i>
            </button>
        `;
        container.appendChild(row);
        lucide.createIcons();
    }

    function removeFeatureInput(btn) {
        btn.closest('.feature-input-row').remove();
    }
</script>
@endsection
