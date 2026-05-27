@extends('layouts.app')

@section('title', 'Informasi | IT Support Jabodetabek')
@section('canonical', 'https://itsupport-jabodetabek.com/informasi')

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
                        @if(!empty($article->image))
                            <div class="article-img">
                                <img src="{{ asset($article->image) }}" alt="{{ $article['title'] }}" class="article-cover-img">
                            </div>
                        @else
                            <div class="article-img" style="background: linear-gradient(135deg, {{ $color }}22, {{ $color }}44)">
                                <i data-lucide="tag" style="width:40px;height:40px;color:{{ $color }};opacity:0.5"></i>
                            </div>
                        @endif
                        <div class="article-body">
                            <span class="article-cat" style="color: {{ $color }}">{{ $article['category'] }}</span>
                            <h3 class="article-title">{{ $article['title'] }}</h3>
                            <p class="article-excerpt">{{ $article['excerpt'] }}</p>
                            <div class="article-meta">
                                <span><i data-lucide="calendar" style="width:14px;height:14px"></i> {{ $article['date'] }}</span>
                                <span><i data-lucide="user" style="width:14px;height:14px"></i> {{ $article['author'] }}</span>
                                <span>⏱ {{ $article['read_time'] }}</span>
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
