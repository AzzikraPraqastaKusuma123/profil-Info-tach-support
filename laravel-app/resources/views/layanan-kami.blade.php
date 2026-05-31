@extends('layouts.app')

@section('title', 'Layanan Kami | IT Support Jabodetabek')
@section('canonical', 'https://itsupport-jabodetabek.com/layanan-kami')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/LayananKami.css') }}">
@endsection

@section('content')
<main>
    <div class="page-hero">
        <div class="container">
            <div class="badge">Layanan Kami</div>
            <h1>Solusi IT Lengkap untuk Anda</h1>
            <p>Semua kebutuhan IT Anda kami tangani dengan profesional, cepat, dan bergaransi.</p>
        </div>
    </div>

    <section class="section">
        <div class="container">
            <!-- Filter -->
            <div class="filter-bar reveal">
                @php $categories = ['Semua', 'Hardware', 'Network', 'Security', 'Digital', 'Maintenance', 'Consulting']; @endphp
                @foreach($categories as $idx => $cat)
                    <button class="filter-btn {{ $idx === 0 ? 'active' : '' }}" data-filter="{{ $cat }}">{{ $cat }}</button>
                @endforeach
            </div>

            <!-- Services Grid -->
            <div class="layanan-grid">


                @foreach($services as $s)
                    <div class="layanan-card reveal" data-category="{{ $s['category'] }}">
                        @if(!empty($s->image))
                            <div class="layanan-image-wrapper">
                                <img src="{{ asset($s->image) }}" alt="{{ $s['title'] }}" class="layanan-card-img">
                                <div class="layanan-icon-badge">
                                    <i data-lucide="{{ $s['icon'] }}" style="width:20px;height:20px"></i>
                                </div>
                            </div>
                        @else
                            <div class="layanan-card-header">
                                <div class="layanan-icon"><i data-lucide="{{ $s['icon'] }}" style="width:40px;height:40px"></i></div>
                            </div>
                        @endif
                        <h3>{{ $s['title'] }}</h3>
                        <p>{{ $s['desc'] }}</p>
                        <ul class="layanan-features">
                            @foreach($s['features'] as $f)
                                <li><i data-lucide="check-circle" class="feat-check" style="width:16px;height:16px"></i>{{ $f }}</li>
                            @endforeach
                        </ul>
                        <a href="https://wa.me/6281210874692" target="_blank" rel="noreferrer" class="btn btn-primary layanan-cta">
                            Konsultasi Gratis <i data-lucide="chevron-right" style="width:18px;height:18px"></i>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Process -->
    <section class="section process-section">
        <div class="container">
            <div class="section-header reveal">
                <div class="badge">Cara Kerja</div>
                <h2>Proses Layanan Kami yang Mudah</h2>
            </div>
            <div class="process-grid">
                @php
                    $process = [
                        ["num" => "01", "title" => "Konsultasi", "desc" => "Kami mendengarkan serta memahami kebutuhan teknologi informasi perusahaan Anda dan melakukan analisa awal."],
                        ["num" => "02", "title" => "Survey Lokasi", "desc" => "Tim teknisi ahli kami melakukan kunjungan langsung untuk pengecekan detail kondisi infrastruktur IT kantor Anda."],
                        ["num" => "03", "title" => "Implementasi", "desc" => "Pemasangan perangkat baru, migrasi sistem, konfigurasi server, serta optimasi jaringan diselesaikan dengan standar tinggi."],
                        ["num" => "04", "title" => "Monitoring", "desc" => "Sistem dipantau secara berkala menggunakan tools monitoring canggih untuk menjamin seluruh layanan berjalan lancar."],
                        ["num" => "05", "title" => "Maintenance Berkala", "desc" => "Kami memberikan perawatan rutin (preventive maintenance) bulanan guna menjaga stabilitas jangka panjang sistem perusahaan Anda."]
                    ];
                @endphp
                @foreach($process as $p)
                    <div class="process-step reveal">
                        <div class="process-num">{{ $p['num'] }}</div>
                        <h4>{{ $p['title'] }}</h4>
                        <p>{{ $p['desc'] }}</p>
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
        const cards = document.querySelectorAll('.layanan-card');

        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelector('.filter-btn.active').classList.remove('active');
                btn.classList.add('active');
                const cat = btn.getAttribute('data-filter');

                cards.forEach(card => {
                    if (cat === 'Semua' || card.getAttribute('data-category') === cat) {
                        card.style.display = 'flex';
                        setTimeout(() => card.classList.add('reveal', 'visible'), 10);
                    } else {
                        card.style.display = 'none';
                        card.classList.remove('reveal', 'visible');
                    }
                });
            });
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
