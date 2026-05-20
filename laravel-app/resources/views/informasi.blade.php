@extends('layouts.app')

@section('title', 'Informasi | IT Support Jabodetabek')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/Informasi.css') }}">
@endsection

@section('content')
<main>
    <div class="page-hero">
        <div class="container">
            <div class="badge">Informasi & Tips IT</div>
            <h1>Artikel & Berita Terbaru</h1>
            <p>Update informasi, tips, dan panduan seputar teknologi IT untuk Anda.</p>
        </div>
    </div>

    <section class="section">
        <div class="container">
            <!-- Search & Filter -->
            <div class="info-toolbar reveal">
                <div class="search-box">
                    <i data-lucide="search" class="search-icon" style="width:18px;height:18px"></i>
                    <input type="text" id="searchInput" placeholder="Cari artikel..." />
                </div>
                <div class="filter-bar" style="justify-content: flex-start; margin-bottom: 0">
                    @php $categories = ['Semua', 'Tips IT', 'Keamanan', 'Jaringan', 'Website']; @endphp
                    @foreach($categories as $idx => $cat)
                        <button class="filter-btn {{ $idx === 0 ? 'active' : '' }}" data-filter="{{ $cat }}">{{ $cat }}</button>
                    @endforeach
                </div>
            </div>

            <!-- Articles -->
            @php
                $articles = [
                    ["id" => 1, "category" => "Tips IT", "title" => "10 Tips Menjaga Laptop Agar Awet dan Tidak Cepat Rusak", "excerpt" => "Laptop adalah investasi penting yang perlu dijaga dengan baik. Berikut 10 tips praktis yang bisa Anda terapkan untuk memperpanjang usia laptop Anda.", "date" => "12 Mei 2025", "author" => "Tim IT Support", "readTime" => "5 menit"],
                    ["id" => 2, "category" => "Keamanan", "title" => "Pentingnya CCTV untuk Keamanan Bisnis Anda di Era Modern", "excerpt" => "Dengan meningkatnya angka kejahatan, sistem keamanan CCTV bukan lagi sekadar pilihan, melainkan kebutuhan pokok bagi setiap bisnis.", "date" => "5 Mei 2025", "author" => "Tim IT Support", "readTime" => "4 menit"],
                    ["id" => 3, "category" => "Jaringan", "title" => "Perbedaan WiFi 2.4GHz vs 5GHz: Mana yang Tepat untuk Anda?", "excerpt" => "Bingung memilih frekuensi WiFi yang tepat? Artikel ini menjelaskan perbedaan, kelebihan, dan kekurangan masing-masing frekuensi secara mudah dipahami.", "date" => "28 Apr 2025", "author" => "Tim IT Support", "readTime" => "6 menit"],
                    ["id" => 4, "category" => "Website", "title" => "Mengapa Bisnis UMKM Wajib Punya Website di Tahun 2025?", "excerpt" => "Di era digital ini, website bukan lagi kemewahan. Temukan alasan mengapa UMKM Anda harus segera go online dan bagaimana cara memulainya.", "date" => "20 Apr 2025", "author" => "Tim IT Support", "readTime" => "7 menit"],
                    ["id" => 5, "category" => "Tips IT", "title" => "Cara Mudah Mempercepat Komputer Windows yang Lemot", "excerpt" => "Komputer Anda terasa lambat dan membuat frustasi? Ikuti langkah-langkah mudah ini untuk meningkatkan performa PC Anda secara signifikan.", "date" => "15 Apr 2025", "author" => "Tim IT Support", "readTime" => "5 menit"],
                    ["id" => 6, "category" => "Keamanan", "title" => "Waspada Virus & Malware: Panduan Lengkap Proteksi Komputer", "excerpt" => "Serangan siber semakin canggih. Pelajari cara melindungi perangkat Anda dari berbagai ancaman digital yang mengintai setiap saat.", "date" => "8 Apr 2025", "author" => "Tim IT Support", "readTime" => "8 menit"]
                ];
                $categoryColors = [
                    "Tips IT" => "#3b82f6", "Keamanan" => "#ef4444", "Jaringan" => "#10b981", "Website" => "#8b5cf6"
                ];
            @endphp
            <div class="empty-state reveal" id="emptyState" style="display: none;">
                <p>Tidak ada artikel yang ditemukan.</p>
            </div>
            
            <div class="articles-grid" id="articlesGrid">
                @foreach($articles as $i => $article)
                    @php 
                        $color = $categoryColors[$article['category']] ?? '#3b82f6'; 
                    @endphp
                    <div class="article-card reveal {{ $i === 0 ? 'featured' : '' }}" data-category="{{ $article['category'] }}">
                        <div class="article-img" style="background: linear-gradient(135deg, {{ $color }}22, {{ $color }}44)">
                            <i data-lucide="tag" style="width:40px;height:40px;color:{{ $color }};opacity:0.5"></i>
                        </div>
                        <div class="article-body">
                            <span class="article-cat" style="color: {{ $color }}">{{ $article['category'] }}</span>
                            <h3 class="article-title">{{ $article['title'] }}</h3>
                            <p class="article-excerpt">{{ $article['excerpt'] }}</p>
                            <div class="article-meta">
                                <span><i data-lucide="calendar" style="width:14px;height:14px"></i> {{ $article['date'] }}</span>
                                <span><i data-lucide="user" style="width:14px;height:14px"></i> {{ $article['author'] }}</span>
                                <span>⏱ {{ $article['readTime'] }}</span>
                            </div>
                            <button class="article-read-more">
                                Baca Selengkapnya <i data-lucide="arrow-right" style="width:16px;height:16px"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</main>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const filterBtns = document.querySelectorAll('.filter-btn');
        const searchInput = document.getElementById('searchInput');
        const cards = document.querySelectorAll('.article-card');
        const emptyState = document.getElementById('emptyState');
        const articlesGrid = document.getElementById('articlesGrid');

        let activeCat = 'Semua';
        let searchQuery = '';

        function renderFilter() {
            let visibleCount = 0;
            let firstVisibleIndex = -1;

            cards.forEach((card, idx) => {
                const cat = card.getAttribute('data-category');
                const title = card.querySelector('.article-title').textContent.toLowerCase();
                const excerpt = card.querySelector('.article-excerpt').textContent.toLowerCase();
                
                const matchCat = activeCat === 'Semua' || cat === activeCat;
                const matchSearch = title.includes(searchQuery) || excerpt.includes(searchQuery);

                if (matchCat && matchSearch) {
                    card.style.display = 'flex';
                    if (firstVisibleIndex === -1) firstVisibleIndex = idx;
                    
                    // Toggle featured styling for first visible if activeCat is Semua
                    if (activeCat === 'Semua' && visibleCount === 0) {
                        card.classList.add('featured');
                    } else {
                        card.classList.remove('featured');
                    }
                    
                    setTimeout(() => card.classList.add('reveal', 'visible'), 10);
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                    card.classList.remove('reveal', 'visible', 'featured');
                }
            });

            if (visibleCount === 0) {
                emptyState.style.display = 'block';
                articlesGrid.style.display = 'none';
            } else {
                emptyState.style.display = 'none';
                articlesGrid.style.display = 'grid';
            }
        }

        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelector('.filter-btn.active').classList.remove('active');
                btn.classList.add('active');
                activeCat = btn.getAttribute('data-filter');
                renderFilter();
            });
        });

        searchInput.addEventListener('input', (e) => {
            searchQuery = e.target.value.toLowerCase();
            renderFilter();
        });

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) e.target.classList.add('visible');
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
    });
</script>
@endsection
