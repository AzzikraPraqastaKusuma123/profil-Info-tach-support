@extends('layouts.app')

@section('title', 'Layanan Kami | IT Support Jabodetabek')

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
                @php
                    $services = [
                        [
                            "icon" => "monitor", "title" => "Service Laptop & PC", "category" => "Hardware",
                            "desc" => "Kami menangani berbagai kerusakan laptop dan PC dengan penanganan cepat dan bergaransi. Dipercaya oleh ratusan pengguna di Jabodetabek.",
                            "features" => ["Ganti LCD/LED", "Upgrade RAM & SSD", "Perbaikan Motherboard", "Install Ulang OS", "Cleaning & Servis Berkala", "Penggantian Baterai"]
                        ],
                        [
                            "icon" => "wifi", "title" => "Instalasi Jaringan", "category" => "Network",
                            "desc" => "Pemasangan dan konfigurasi jaringan LAN/WiFi untuk rumah, kantor, dan gedung komersial dengan perangkat berkualitas tinggi.",
                            "features" => ["Setting Router & Switch", "Instalasi Kabel LAN CAT6", "Konfigurasi WiFi Enterprise", "VPN Setup", "Network Monitoring", "Troubleshooting Jaringan"]
                        ],
                        [
                            "icon" => "camera", "title" => "Pasang CCTV", "category" => "Security",
                            "desc" => "Instalasi CCTV profesional untuk keamanan rumah, toko, kantor, dan area publik dengan kamera resolusi tinggi dan bisa dipantau jarak jauh.",
                            "features" => ["CCTV Indoor & Outdoor", "Resolusi HD/Full HD/4K", "Pemantauan via Smartphone", "DVR & NVR Setup", "Kabel & Aksesoris Lengkap", "Garansi Instalasi"]
                        ],
                        [
                            "icon" => "globe", "title" => "Pembuatan Website", "category" => "Digital",
                            "desc" => "Desain dan pengembangan website profesional yang responsif, cepat, dan SEO-friendly untuk meningkatkan eksistensi bisnis Anda secara online.",
                            "features" => ["Website Company Profile", "Landing Page", "Website Toko Online", "Sistem Informasi Custom", "Domain & Hosting", "Maintenance Berkala"]
                        ],
                        [
                            "icon" => "wrench", "title" => "Maintenance IT", "category" => "Maintenance",
                            "desc" => "Layanan perawatan rutin perangkat komputer dan infrastruktur jaringan untuk memastikan sistem IT Anda selalu berjalan optimal dan bebas masalah.",
                            "features" => ["Perawatan PC Berkala", "Update Software & Antivirus", "Backup Data Rutin", "Monitoring Jaringan", "Penanganan Masalah Cepat", "Laporan Bulanan"]
                        ],
                        [
                            "icon" => "headphones", "title" => "Konsultasi IT", "category" => "Consulting",
                            "desc" => "Dapatkan saran dan rekomendasi ahli untuk kebutuhan infrastruktur IT bisnis Anda. Kami membantu Anda membuat keputusan teknologi yang tepat.",
                            "features" => ["Analisis Kebutuhan IT", "Perencanaan Infrastruktur", "Rekomendasi Perangkat", "Audit Keamanan Jaringan", "Optimasi Sistem", "Pendampingan Proyek IT"]
                        ]
                    ];
                @endphp

                @foreach($services as $s)
                    <div class="layanan-card reveal" data-category="{{ $s['category'] }}">
                        <div class="layanan-card-header">
                            <div class="layanan-icon"><i data-lucide="{{ $s['icon'] }}" style="width:40px;height:40px"></i></div>
                        </div>
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
                        ["num" => "01", "title" => "Hubungi Kami", "desc" => "Hubungi kami melalui WhatsApp, telepon, atau email untuk konsultasi kebutuhan Anda."],
                        ["num" => "02", "title" => "Analisis & Solusi", "desc" => "Tim kami akan menganalisis kebutuhan dan memberikan penawaran solusi terbaik secara transparan."],
                        ["num" => "03", "title" => "Pengerjaan", "desc" => "Teknisi kami mengerjakan proyek dengan standar kualitas tinggi dan tepat waktu."],
                        ["num" => "04", "title" => "Garansi & Support", "desc" => "Pekerjaan selesai disertai garansi dan dukungan purna jual yang responsif."]
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
