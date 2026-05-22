@extends('admin.layout')

@yield('title', 'Kelola Artikel & Informasi')
@section('page-title', 'Kelola Artikel & Informasi')

@section('styles')
<style>
    .info-header {
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
        max-width: 750px;
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

    .article-excerpt {
        max-width: 300px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        color: var(--gray-400);
        font-size: 0.85rem;
    }

    @keyframes scaleUp {
        from { transform: scale(0.95); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }
</style>
@endsection

@section('content')
<div class="glass-panel">
    <div class="info-header">
        <p style="color: var(--gray-400); font-size: 0.95rem;">Kelola artikel edukasi, berita, tips IT, dan publikasi informasi yang diterbitkan oleh tim IT Support.</p>
        <button class="btn btn-primary" onclick="openCreateModal()">
            <i data-lucide="plus" style="width:18px; height:18px;"></i>
            <span>Tulis Artikel</span>
        </button>
    </div>

    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 60px;">No</th>
                    <th style="width: 100px;">Gambar</th>
                    <th style="width: 140px;">Kategori</th>
                    <th>Judul Artikel</th>
                    <th>Ringkasan (Excerpt)</th>
                    <th style="width: 120px;">Tanggal</th>
                    <th style="width: 100px;">Durasi Baca</th>
                    <th style="width: 120px; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($articles as $index => $article)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            @if($article->image)
                                <img src="{{ asset($article->image) }}" alt="Thumbnail" style="width: 60px; height: 40px; object-fit: cover; border-radius: 4px; border: 1px solid var(--border-glass);">
                            @else
                                <div style="width: 60px; height: 40px; background: rgba(255,255,255,0.05); border-radius: 4px; display:flex; align-items:center; justify-content:center; color: var(--gray-500); font-size: 0.7rem;">Tidak ada</div>
                            @endif
                        </td>
                        <td>
                            <span class="category-badge">{{ $article->category }}</span>
                        </td>
                        <td style="font-weight: 700;">{{ $article->title }}</td>
                        <td>
                            <div class="article-excerpt">{{ $article->excerpt }}</div>
                        </td>
                        <td>{{ $article->date }}</td>
                        <td>{{ $article->read_time }}</td>
                        <td style="text-align: center;">
                            <div style="display: inline-flex; gap: 8px;">
                                <button class="btn-table-action btn-table-action-edit" onclick="openEditModal({{ json_encode($article) }})" title="Edit Artikel">
                                    <i data-lucide="edit-3" style="width:16px; height:16px;"></i>
                                </button>
                                <form action="{{ route('admin.information.delete', $article->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?')">
                                    @csrf
                                    <button type="submit" class="btn-table-action btn-table-action-delete" title="Hapus Artikel">
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

<!-- ── INFORMATION MODAL FORM ── -->
<div class="modal" id="info-modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" id="modal-title">Tulis Artikel Baru</h3>
            <button class="close-modal" onclick="closeModal()">
                <i data-lucide="x" style="width:24px; height:24px;"></i>
            </button>
        </div>
        <form id="info-form" method="POST" action="{{ route('admin.information.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="admin-form-group">
                    <label class="admin-label" for="title">Judul Artikel</label>
                    <input type="text" name="title" id="title" class="admin-input" placeholder="Contoh: 10 Tips Menjaga Laptop Agar Awet" required>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                    <div class="admin-form-group">
                        <label class="admin-label" for="category">Kategori</label>
                        <select name="category" id="category" class="admin-select" required>
                            <option value="Tips IT">Tips IT</option>
                            <option value="Keamanan">Keamanan</option>
                            <option value="Jaringan">Jaringan</option>
                            <option value="Website">Website</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>

                    <div class="admin-form-group">
                        <label class="admin-label" for="read_time">Durasi Baca</label>
                        <input type="text" name="read_time" id="read_time" class="admin-input" placeholder="Contoh: 5 menit" required>
                    </div>
                </div>

                <div class="admin-form-group">
                    <label class="admin-label" for="excerpt">Ringkasan Singkat (Excerpt)</label>
                    <textarea name="excerpt" id="excerpt" class="admin-textarea" rows="2" placeholder="Masukkan ringkasan singkat artikel untuk preview halaman depan..." required></textarea>
                </div>

                <div class="admin-form-group">
                    <label class="admin-label" for="content">Isi Lengkap Artikel</label>
                    <textarea name="content" id="content" class="admin-textarea" rows="8" placeholder="Tulis isi lengkap dari artikel di sini..." required></textarea>
                </div>

                <div class="admin-form-group">
                    <label class="admin-label" for="image-input">Foto Cover Artikel (Opsional)</label>
                    <input type="file" name="image" id="image-input" class="admin-input" accept="image/*" onchange="previewImage(this)">
                    <p style="font-size: 0.75rem; color: var(--gray-400); margin-top: 6px;">Format gambar: png, jpg, jpeg, svg, webp. Maksimal 2MB. Kosongkan jika ingin memakai placeholder gradient default.</p>
                    
                    <div class="logo-upload-preview" id="image-preview-box" style="width: 100%; height: 180px; border: 2px dashed rgba(255, 255, 255, 0.1); border-radius: var(--radius-sm); display: flex; align-items: center; justify-content: center; margin-top: 10px; overflow: hidden; background: rgba(0,0,0,0.2);">
                        <div class="logo-upload-placeholder" id="image-placeholder" style="color: var(--gray-400); font-size: 0.85rem; display: flex; flex-direction: column; align-items: center; gap: 8px;">
                            <i data-lucide="image" style="width:32px; height:32px;"></i>
                            <span>Belum ada file dipilih</span>
                        </div>
                        <img id="image-preview-img" style="display:none; max-width: 100%; max-height: 100%; object-fit: contain;" src="" alt="Pratinjau gambar">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline" style="padding: 10px 20px;" onclick="closeModal()">Batal</button>
                <button type="submit" class="btn btn-primary" style="padding: 10px 24px;">Terbitkan Artikel</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const modal = document.getElementById('info-modal');
    const form = document.getElementById('info-form');
    const modalTitle = document.getElementById('modal-title');
    const imageInput = document.getElementById('image-input');
    const previewBox = document.getElementById('image-preview-box');
    const previewImg = document.getElementById('image-preview-img');
    const placeholder = document.getElementById('image-placeholder');

    function openCreateModal() {
        modalTitle.textContent = "Tulis Artikel Baru";
        form.action = "{{ route('admin.information.store') }}";
        form.reset();
        
        previewImg.style.display = 'none';
        placeholder.style.display = 'flex';
        
        modal.classList.add('show');
        lucide.createIcons();
    }

    function openEditModal(article) {
        modalTitle.textContent = "Edit Artikel";
        form.action = `/admin/information/${article.id}/update`;
        form.reset();

        document.getElementById('title').value = article.title;
        document.getElementById('category').value = article.category;
        document.getElementById('read_time').value = article.read_time;
        document.getElementById('excerpt').value = article.excerpt;
        document.getElementById('content').value = article.content;

        // Render current image in preview if exists
        if (article.image) {
            previewImg.src = article.image;
            previewImg.style.display = 'block';
            placeholder.style.display = 'none';
        } else {
            previewImg.style.display = 'none';
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
