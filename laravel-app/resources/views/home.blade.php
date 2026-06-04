@extends('layouts.app')

@section('title', 'Jasa IT Support Jabodetabek | Maintenance Komputer, Server, CCTV & Jaringan Kantor')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/Home.css') }}">
    <!-- Leaflet.js CSS CDN -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
@endsection

@section('content')
<main>
    <!-- ── HERO ── -->
    <section class="hero">
        <div class="hero-bg">
            <div class="hero-bg-slideshow">
                <img src="{{ asset('background/1.png') }}" alt="IT Background" class="hero-bg-img active" />
                <img src="{{ asset('background/2.png') }}" alt="IT Background" class="hero-bg-img" />
                <img src="{{ asset('background/3.png') }}" alt="IT Background" class="hero-bg-img" />
                <img src="{{ asset('background/4.png') }}" alt="IT Background" class="hero-bg-img" />
                <div class="hero-bg-overlay"></div>
            </div>
            <div class="hero-orb hero-orb-1"></div>
            <div class="hero-orb hero-orb-2"></div>
            <div class="hero-grid"></div>
        </div>
        <div class="container hero-content">
            <div class="hero-text">
                <h1 class="hero-title">
                    Solusi IT <span class="gradient-text">Profesional</span><br />
                    Untuk Bisnis Anda
                </h1>
                <p class="hero-desc">
                    Kami hadir memberikan layanan IT Support terpercaya untuk bisnis dan UMKM di area
                    Jabodetabek. Service laptop, instalasi jaringan, CCTV, hingga pembuatan website
                    — semua dalam satu tempat.
                </p>
                <div class="hero-checks">
                    <div class="hero-check"><i data-lucide="check-circle" class="check-icon" style="width:18px;height:18px"></i>Garansi Kepuasan</div>
                    <div class="hero-check"><i data-lucide="check-circle" class="check-icon" style="width:18px;height:18px"></i>Response &lt; 1 Jam</div>
                    <div class="hero-check"><i data-lucide="check-circle" class="check-icon" style="width:18px;height:18px"></i>Teknisi Berpengalaman</div>
                </div>
                <div class="hero-actions">
                    <a href="https://wa.me/6281210874692" target="_blank" rel="noreferrer" class="btn btn-accent">
                        Konsultasi Gratis <i data-lucide="arrow-right" style="width:18px;height:18px;margin-left:8px"></i>
                    </a>
                    <a href="{{ route('layanan-kami') }}" class="btn btn-outline">
                        Lihat Layanan
                    </a>
                </div>
            </div>
            <div class="hero-visual animate-float">
                <div class="hero-image-wrapper">
                    @for($i = 1; $i <= 10; $i++)
                        <img src="{{ asset('home-page/'.$i.'.png') }}" alt="Kegiatan IT Support {{ $i }}" class="hero-img-main {{ $i == 1 ? 'active' : '' }}" style="{{ $i == 1 || $i == 2 ? 'object-position: center 12%;' : '' }}" />
                    @endfor
                    <div class="hero-image-overlay"></div>
                    
                    <div class="hero-caption-wrapper">
                        @php
                            $captions = [
                                ["title" => "Visi Kami", "text" => "Menjadi penyedia layanan IT terkemuka di Jabodetabek dengan keunggulan teknis."],
                                ["title" => "Misi Kami", "text" => "Menghadirkan solusi teknologi efektif untuk mendorong kemajuan bisnis Anda."],
                                ["title" => "Dukungan 24/7", "text" => "Memastikan kelancaran operasional melalui penanganan IT yang proaktif."],
                                ["title" => "Transformasi Digital", "text" => "Mendukung keamanan data dengan infrastruktur IT yang modern."],
                                ["title" => "Kemitraan Jangka Panjang", "text" => "Layanan andal yang selalu berfokus pada kebutuhan pelanggan."],
                                ["title" => "Keunggulan Teknis", "text" => "Menghadirkan inovasi dan standar kualitas tinggi di setiap layanan."],
                                ["title" => "Solusi Inovatif", "text" => "Mengubah setiap tantangan operasional menjadi keunggulan bisnis."],
                                ["title" => "Layanan Terpadu", "text" => "Penanganan Hardware, Network, dan Security dalam satu atap."],
                                ["title" => "Teknisi Profesional", "text" => "Tim bersertifikasi dan berpengalaman untuk hasil yang maksimal."],
                                ["title" => "Berorientasi Klien", "text" => "Kepercayaan dan kepuasan Anda adalah prioritas utama kami."]
                            ];
                        @endphp
                        @foreach($captions as $index => $item)
                            <div class="hero-caption {{ $index == 0 ? 'active' : '' }}">
                                <div class="caption-icon-wrapper">
                                    <i data-lucide="target" style="width:20px;height:20px"></i>
                                </div>
                                <div class="caption-text-content">
                                    <h4>{{ $item['title'] }}</h4>
                                    <p>{{ $item['text'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Slide Indicator Dots -->
                <div class="hero-slide-dots">
                    @for($i = 0; $i < 10; $i++)
                        <button class="hero-dot {{ $i == 0 ? 'active' : '' }}" data-index="{{ $i }}" aria-label="Slide {{ $i + 1 }}"></button>
                    @endfor
                </div>
            </div>
        </div>
    </section>

    <!-- ── STATS ── -->
    <section class="stats-strip">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item"><div class="stat-number">500+</div><div class="stat-label">Klien Puas</div></div>
                <div class="stat-item"><div class="stat-number">7+</div><div class="stat-label">Tahun Pengalaman</div></div>
                <div class="stat-item"><div class="stat-number">98%</div><div class="stat-label">Kepuasan Klien</div></div>
                <div class="stat-item"><div class="stat-number">24/7</div><div class="stat-label">Support Tersedia</div></div>
            </div>
        </div>
    </section>

    <!-- ── SERVICES (Bento Grid) ── -->
    <section class="section bento-section">
        <div class="container">
            <div class="bento-section-header reveal">
                <h2 class="section-title-premium">
                    Infrastruktur IT yang<br />
                    <span class="gradient-text">Mendukung Pertumbuhan</span>
                </h2>
                <p class="section-subtitle-premium">
                    Layanan komprehensif yang dirancang untuk memastikan operasional bisnis Anda berjalan mulus tanpa hambatan teknologi.
                </p>
            </div>

            <div class="bento-grid">
                @php
                    $services = [
                        [ "icon" => "laptop", "tag" => "Hardware", "title" => "Service Laptop & PC", "desc" => "Perbaikan hardware & software laptop dan PC semua merk dengan penanganan cepat, bergaransi, dan transparan.", "img" => "/services/laptop-pc.png", "color" => "#3b82f6" ],
                        [ "icon" => "network", "tag" => "Network", "title" => "Instalasi Jaringan", "desc" => "Pemasangan & konfigurasi jaringan LAN/WiFi enterprise untuk kantor, gedung, dan rumah Anda.", "img" => "/services/jaringan.png", "color" => "#06b6d4" ],
                        [ "icon" => "shield-check", "tag" => "Security", "title" => "Pasang CCTV", "desc" => "Instalasi kamera CCTV resolusi tinggi untuk keamanan bisnis, kantor, dan hunian Anda 24 jam.", "img" => "/services/cctv.png", "color" => "#8b5cf6" ],
                        [ "icon" => "code-2", "tag" => "Digital", "title" => "Pembuatan Website", "desc" => "Desain & pengembangan website profesional, responsif, dan SEO-friendly untuk bisnis Anda.", "img" => "/services/website.png", "color" => "#10b981" ],
                        [ "icon" => "settings-2", "tag" => "Maintenance", "title" => "Maintenance IT", "desc" => "Perawatan rutin perangkat komputer & infrastruktur jaringan agar selalu dalam performa optimal.", "img" => "/services/maintenance.png", "color" => "#f59e0b" ],
                        [ "icon" => "lightbulb", "tag" => "Consulting", "title" => "Konsultasi IT", "desc" => "Dapatkan saran dan rekomendasi ahli untuk kebutuhan infrastruktur IT dan digitalisasi bisnis Anda.", "img" => "/services/konsultasi.png", "color" => "#ef4444" ],
                    ];
                @endphp

                @foreach($services as $idx => $s)
                    @php
                        $cardClass = "bento-card bento-standard reveal";
                        if ($idx === 0) $cardClass = "bento-card bento-large reveal";
                        if ($idx === 1) $cardClass = "bento-card bento-wide reveal";
                        if ($idx === 4) $cardClass = "bento-card bento-wide reveal";
                        if ($idx === 5) $cardClass = "bento-card bento-wide reveal";
                    @endphp
                    <a href="{{ route('layanan-kami') }}" class="{{ $cardClass }}" style="--bento-accent: {{ $s['color'] }}">
                        <div class="bento-glow"></div>
                        <div class="bento-image-bg" style="background-image: url('{{ asset($s['img']) }}')"></div>
                        <div class="bento-overlay"></div>
                        <div class="bento-card-inner">
                            <div class="bento-top">
                                <div class="bento-icon-wrapper">
                                    <i data-lucide="{{ $s['icon'] }}" style="width:28px;height:28px"></i>
                                </div>
                                <span class="bento-badge">{{ $s['tag'] }}</span>
                            </div>
                            <div class="bento-bottom">
                                <h3 class="bento-title">{{ $s['title'] }}</h3>
                                <p class="bento-desc">{{ $s['desc'] }}</p>
                                <div class="bento-link">
                                    <span>Eksplorasi Layanan</span>
                                    <i data-lucide="arrow-right" style="width:16px;height:16px"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ── BUSINESS BENEFITS ── -->
    <!-- ── BUSINESS BENEFITS ── -->
    <!-- ── BUSINESS BENEFITS ── -->
    <section class="section premium-benefits-section" style="background: linear-gradient(135deg, #050d1a 0%, #0a1628 50%, #0f2040 100%) !important; border-top: 1px solid rgba(255,255,255,0.03); border-bottom: 1px solid rgba(255,255,255,0.03); padding: 100px 0 !important; position: relative;">
        <div class="container">
            <div class="section-header reveal" style="margin-bottom: 48px; text-align: center;">
                <div class="badge"><i data-lucide="sparkles" style="width:14px;height:14px;margin-right:6px"></i> Efisiensi Operasional</div>
                <h2 style="font-size: 2.2rem; font-weight: 800; line-height: 1.2; margin: 12px 0; color: #ffffff !important;">Keuntungan Menggunakan Jasa <span class="gradient-text">IT Support Profesional</span></h2>
                <p style="color: var(--gray-400); max-width: 700px; margin: 0 auto;">Dapatkan berbagai keuntungan strategis untuk mendorong stabilitas sistem and efisiensi anggaran operasional perusahaan Anda.</p>
            </div>
            
            <div class="benefits-grid">
                @php
                    $benefits = [
                        ["icon" => "shield-alert", "title" => "Mengurangi Downtime", "desc" => "Menghindari kerusakan fatal sistem dan downtime operasional melalui preventive maintenance terukur.", "color" => "#3b82f6", "rgb" => "59, 130, 246"],
                        ["icon" => "trending-up", "title" => "Meningkatkan Produktivitas", "desc" => "Memastikan laptop dan PC seluruh karyawan Anda selalu siap pakai dalam performa terbaik.", "color" => "#06b6d4", "rgb" => "6, 182, 212"],
                        ["icon" => "lock", "title" => "Keamanan Data Terjamin", "desc" => "Melindungi data kredensial perusahaan dari ancaman ransomware, virus, malware, serta kebocoran data.", "color" => "#10b981", "rgb" => "16, 185, 129"],
                        ["icon" => "activity", "title" => "Jaringan Tetap Stabil", "desc" => "Setup Mikrotik failover memastikan konektivitas internet kantor Anda selalu terhubung 24/7.", "color" => "#8b5cf6", "rgb" => "139, 92, 246"],
                        ["icon" => "laptop", "title" => "Kemudahan Kelola Perangkat", "desc" => "Seluruh inventaris komputer dan lisensi sistem operasi terdokumentasi dan terawat berkala.", "color" => "#f59e0b", "rgb" => "245, 158, 11"],
                        ["icon" => "coins", "title" => "Mengurangi Biaya Perbaikan", "desc" => "Menghilangkan pembengkakan anggaran perbaikan darurat melalui program pemeliharaan terencana.", "color" => "#ef4444", "rgb" => "239, 68, 68"],
                        ["icon" => "award", "title" => "Dukungan Teknis Profesional", "desc" => "Akses instan ke tim teknisi ahli tersertifikasi untuk menangani masalah kompleks secara cepat.", "color" => "#38bdf8", "rgb" => "56, 189, 248"],
                        ["icon" => "rocket", "title" => "Meningkatkan Efisiensi Bisnis", "desc" => "Operasional berjalan mulus sehingga Anda dapat sepenuhnya berfokus pada kemajuan inti bisnis.", "color" => "#ec4899", "rgb" => "236, 72, 153"]
                    ];
                @endphp
                @foreach($benefits as $idx => $b)
                    <div class="benefit-card reveal" style="--b-color: {{ $b['color'] }}; --b-color-rgb: {{ $b['rgb'] }}; background: rgba(15, 32, 64, 0.4) !important; border: 1px solid rgba(255,255,255,0.08) !important; border-radius: 16px !important; padding: 28px 24px !important; display: flex !important; flex-direction: column !important; gap: 16px !important; overflow: hidden !important;">
                        <div class="benefit-icon-wrapper">
                            <i data-lucide="{{ $b['icon'] }}"></i>
                        </div>
                        <div>
                            <h4 style="font-size: 1.1rem !important; font-weight: 700 !important; color: #ffffff !important; margin: 0 0 8px 0 !important;">{{ $b['title'] }}</h4>
                            <p style="font-size: 0.875rem !important; color: rgba(255, 255, 255, 0.65) !important; line-height: 1.55 !important; margin: 0 !important;">{{ $b['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ── WHY US (Asymmetric Layout) ── -->
    <section class="section premium-why-section">
        <div class="container">
            <div class="premium-why-grid">
                <div class="premium-why-content reveal">
                    <div class="subtle-badge">Nilai Kami</div>
                    <h2 class="premium-heading">Standar Baru dalam <span class="gradient-text">Dukungan IT</span></h2>
                    <p class="premium-paragraph">
                        Bukan sekadar perbaikan, kami membangun infrastruktur yang tangguh. Dengan pengalaman lebih dari 7 tahun, kami menghadirkan metodologi presisi yang mengubah masalah teknis menjadi keunggulan operasional Anda.
                    </p>
                    <ul class="premium-feature-list">
                        <li><i data-lucide="check-circle" class="check-accent" style="width:20px;height:20px"></i> <span>SLA Respons di bawah 60 menit</span></li>
                        <li><i data-lucide="check-circle" class="check-accent" style="width:20px;height:20px"></i> <span>Transparansi diagnosa & solusi</span></li>
                        <li><i data-lucide="check-circle" class="check-accent" style="width:20px;height:20px"></i> <span>Teknisi tersertifikasi</span></li>
                    </ul>
                    <a href="{{ route('tentang-kami') }}" class="premium-btn mt-6">
                        Mengenal Tim Kami
                    </a>
                </div>
                
                <div class="premium-why-cards">
                    @php
                        $whyUs = [
                            ["icon" => "zap", "title" => "Fast Response", "desc" => "Kami merespons setiap permintaan dalam waktu kurang dari 1 jam."],
                            ["icon" => "shield", "title" => "Bergaransi", "desc" => "Semua layanan kami dilengkapi dengan garansi kepuasan pelanggan."],
                            ["icon" => "star", "title" => "Berpengalaman", "desc" => "Tim teknisi berpengalaman lebih dari 7 tahun di bidang IT."],
                            ["icon" => "clock", "title" => "Tepat Waktu", "desc" => "Komitmen kami adalah menyelesaikan pekerjaan sesuai waktu yang dijanjikan."]
                        ];
                    @endphp
                    @foreach($whyUs as $i => $item)
                        <div class="premium-feature-card reveal delay-{{ $i }}">
                            <div class="premium-feature-icon"><i data-lucide="{{ $item['icon'] }}" style="width:24px;height:24px"></i></div>
                            <div class="premium-feature-text">
                                <h4>{{ $item['title'] }}</h4>
                                <p>{{ $item['desc'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- ── CLIENTS MARQUEE ── -->
    <section class="section clients-section">
        <div class="container">
            <div class="section-header reveal" style="margin-bottom: 48px">
                <div class="badge">Klien Kami</div>
                <h2 style="font-size: 1.8rem">OUR VALUED CLIENTS</h2>
            </div>
        </div>
        <div class="marquee-wrapper reveal">
            <div class="marquee-track">
                @php
                    $clientLogos = [
                        "/clients/Toyota.png", "/clients/MNC.png", "/clients/PLN.png",
                        "/clients/pertamina.png", "/clients/epson.png", "/clients/yamaha.png",
                        "/clients/pos.png", "/clients/inka.png", "/clients/telkom.png",
                        "/clients/siloam.png", "/clients/wika.png", "/clients/wings.png"
                    ];
                @endphp
                <div class="marquee-content">
                    @foreach($clientLogos as $client)
                        <img src="{{ asset($client) }}" class="marquee-logo-img" alt="Client Logo" />
                    @endforeach
                </div>
                <div class="marquee-content" aria-hidden="true">
                    @foreach($clientLogos as $client)
                        <img src="{{ asset($client) }}" class="marquee-logo-img" alt="Client Logo" />
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- ── TESTIMONIALS SLIDESHOW ── -->
    <section class="section testi-section">
        <div class="container">
            <div class="section-header reveal">
                <div class="badge">Testimoni</div>
                <h2>Apa Kata Klien Kami?</h2>
                <p>Kepercayaan klien adalah prioritas utama kami. Lihat ulasan asli pelanggan kami.</p>
            </div>
            <div class="testi-marquee-wrapper reveal">
                <div class="testi-marquee-track">
                    @php
                        $testimonials = [
                            ["name" => "Argi Anto", "company" => "Local Guide", "rating" => 5, "text" => "Dan akhirnya laptop saya kembali normal. Abangnya sangat komunikatif. Hasil pengerjaannya jelas dan sangat profesional. Tidak ragu perbaiki laptop disini. Mantap…"],
                            ["name" => "Marta Olina", "company" => "Local Guide", "rating" => 5, "text" => "Terima kasih banyak sudah membantu saya menyelesaikan masalah pekerjaan saya dengan cepat, efektif dan efisien alias gercep.. Mantabb sukses selalu buat IT support team"],
                            ["name" => "Mas Khusaini", "company" => "Local Guide", "rating" => 5, "text" => "Terimakasih banyak atas bantuannya. Pelayanan service komputernya bagus, terpercaya dan ownernya ramah."],
                            ["name" => "Nick Janthio", "company" => "Local Guide", "rating" => 5, "text" => "Masnya ramah sekali, langsung mengerjakan yang penting kita sebagai customer menjelaskan bagian apa yang problem. Pelayanannya sangat ramah dan sangat membantu sekali."],
                            ["name" => "Monika Astari", "company" => "Local Guide", "rating" => 5, "text" => "Support yang diberikan luar biasa bagus. Amat sangat cepat respondnya. Laptop saya selesai diperbaiki tepat waktu. Sparepart yang rusak diganti dengan yang asli dan bergaransi. Sukses terus ya IT Support Jabodetabek👍"]
                        ];
                        $allTestis = array_merge($testimonials, $testimonials);
                    @endphp
                    @foreach($allTestis as $t)
                        <div class="testi-card-clean">
                            <div class="testi-card-content">
                                <div class="testi-header">
                                    <div class="testi-avatar-clean">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($t['name']) }}&background=f1f5f9&color=3b82f6&size=100" alt="{{ $t['name'] }}" />
                                    </div>
                                    <div class="testi-meta">
                                        <div class="testi-name">{{ $t['name'] }}</div>
                                        <div class="testi-company">{{ $t['company'] }}</div>
                                    </div>
                                    <div class="testi-google-icon">
                                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                                            <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                                            <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                                            <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="testi-stars-row">
                                    <div class="testi-stars">
                                        @for($i=0; $i<$t['rating']; $i++)
                                            <i data-lucide="star" style="width:16px;height:16px;color:#fbbc04;fill:#fbbc04"></i>
                                        @endfor
                                    </div>
                                    <span class="testi-time">Beberapa bulan lalu</span>
                                </div>
                                <p class="testi-text">"{{ $t['text'] }}"</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- ── INTERACTIVE REGIONAL MAP ── -->
    <section class="section map-section">
        <div class="container">
            <div class="section-header reveal">
                <div class="badge"><i data-lucide="map" style="width:14px;height:14px"></i> Cakupan & Lokasi Kami</div>
                <h2>Cakupan IT Support Seluruh Jabodetabek</h2>
                <p>Kami hadir dengan titik siaga teknisi di Jakarta, Bogor, Depok, Tangerang, dan Bekasi untuk memberikan layanan tercepat.</p>
            </div>
            
            <!-- Region Switcher Buttons -->
            <div class="map-switcher-tabs-wrapper reveal">
                <div class="map-switcher-tabs">
                    <button type="button" class="map-switch-btn active" data-region="all">
                        <i data-lucide="globe" style="width:16px;height:16px"></i> Semua JABODETABEK
                    </button>
                    <button type="button" class="map-switch-btn" data-region="bekasi">
                        <i class="region-dot-indicator bekasi"></i> Kantor 1: Bekasi
                    </button>
                    <button type="button" class="map-switch-btn" data-region="jakarta">
                        <i class="region-dot-indicator jakarta"></i> Kantor 2: Jakarta Barat
                    </button>
                </div>
            </div>

            <div class="map-layout-grid reveal">
                <!-- Interactive Leaflet Canvas -->
                <div class="map-interactive-wrapper">
                    <div id="interactive-map"></div>
                </div>

                <!-- Active Region Details Card -->
                <div class="map-details-card">
                    <div class="details-card-header">
                        <div class="details-badge" id="region-badge">Seluruh JABODETABEK</div>
                        <h3 id="region-title">Layanan IT Support Nasional Premium</h3>
                    </div>
                    <div class="details-card-body">
                        <p id="region-desc" class="region-desc-text">
                            PT Info Tech Support Jabodetabek melayani seluruh area Jakarta, Bogor, Depok, Tangerang, dan Bekasi dengan jaminan response time di bawah 1 jam. Silakan pilih wilayah di atas untuk melihat detail kantor operasional dan cakupan layanan.
                        </p>
                        
                        <div class="region-info-list">
                            <div class="region-info-item">
                                <i data-lucide="map-pin" class="info-icon"></i>
                                <div>
                                    <h5>Titik Layanan / Alamat</h5>
                                    <p id="region-address">Melayani seluruh wilayah Jabodetabek (Titik operasional tersebar strategis)</p>
                                </div>
                            </div>
                            <div class="region-info-item">
                                <i data-lucide="clock" class="info-icon"></i>
                                <div>
                                    <h5>Kecepatan Respon</h5>
                                    <p id="region-response">&lt; 1 Jam (Garansi Teknisi Siaga Terdekat)</p>
                                </div>
                            </div>
                        </div>

                        <!-- Dynamic Sub-districts chips container -->
                        <div id="region-chips-wrapper" style="margin-top: 24px; border-top: 1px solid rgba(255,255,255,0.06); padding-top: 16px; display: none;">
                            <h5 style="font-size: 0.8rem; text-transform: uppercase; color: var(--gray-400); margin-bottom: 12px; letter-spacing: 0.5px;">Area Layanan Detil:</h5>
                            <div id="region-chips-container" style="display: flex; flex-wrap: wrap; gap: 8px;"></div>
                        </div>
                    </div>
                    <div class="details-card-footer">
                        <a id="region-maps-link" href="https://www.google.com/maps/place/IT+Support+Jabodetabek" target="_blank" rel="noreferrer" class="btn-maps-action">
                            <i data-lucide="external-link" style="width:18px;height:18px"></i> Buka Google Maps
                        </a>
                        <a id="region-wa-link" href="https://wa.me/6281210874692?text=Halo%20IT%20Support%20Jabodetabek,%20saya%20memerlukan%20layanan%20IT%20Support%20di%20area%20saya" target="_blank" rel="noreferrer" class="btn-wa-action">
                            <i data-lucide="message-square" style="width:18px;height:18px"></i> Hubungi WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
                 <!-- ── FAQ SECTION ── -->
    <section class="section home-faq-section" style="background: linear-gradient(135deg, #050d1a 0%, #0a1628 50%, #0f2040 100%) !important; padding: 100px 0 !important; position: relative;">
        <div class="container">
            <div class="section-header reveal" style="margin-bottom: 48px; text-align: center;">
                <div class="badge"><i data-lucide="help-circle" style="width:14px;height:14px;margin-right:6px"></i> FAQ</div>
                <h2 style="font-size: 2.2rem; font-weight: 800; line-height: 1.2; margin: 12px 0; color: #ffffff !important;">Pertanyaan yang <span class="gradient-text">Sering Diajukan</span></h2>
                <p style="color: var(--gray-400); max-width: 700px; margin: 0 auto;">Temukan jawaban cepat untuk pertanyaan umum mengenai keandalan layanan IT Support kami.</p>
            </div>
            
            <div class="faq-accordion-wrap reveal" style="max-width: 800px; margin: 0 auto; display: flex; flex-direction: column; gap: 16px;">
                @php
                    $faqs = [
                        [
                            "q" => "Berapa biaya jasa IT Support?",
                            "a" => "Biaya layanan kami sangat menyesuaikan dengan jumlah perangkat (PC/Laptop/Server), lokasi kantor perusahaan Anda, serta jenis tingkatan layanan (SLA) yang dibutuhkan. Kami menyediakan opsi paket bulanan (kontrak maintenance) maupun kunjungan onsite panggilan dengan harga yang sangat kompetitif."
                        ],
                        [
                            "q" => "Apakah tersedia layanan onsite (datang ke lokasi)?",
                            "a" => "Ya, tentu saja. Kami menyediakan layanan kunjungan teknisi onsite langsung ke kantor Anda untuk seluruh wilayah Jabodetabek (Jakarta, Bogor, Depok, Tangerang, dan Bekasi) guna menangani kendala fisik yang tidak bisa diselesaikan secara remote."
                        ],
                        [
                            "q" => "Apakah melayani maintenance kontrak bulanan?",
                            "a" => "Ya, kami menyediakan kontrak maintenance berkala baik bulanan maupun tahunan. Kontrak ini sudah mencakup preventive maintenance rutin (pembersihan berkala, audit performa, update patch) untuk mencegah terjadinya gangguan sistem sebelum terjadi."
                        ],
                        [
                            "q" => "Apakah bisa menangani server perusahaan?",
                            "a" => "Ya, tim teknisi kami memiliki sertifikasi profesional dan pengalaman bertahun-tahun dalam menginstal, mengkonfigurasi, dan merawat server berbasis Windows Server maupun Linux Server, termasuk active directory, file sharing, dan virtualisasi."
                        ],
                        [
                            "q" => "Apakah tersedia layanan darurat (emergency)?",
                            "a" => "Ya, kami menyediakan dukungan bantuan teknis darurat (emergency support) untuk kondisi krusial yang mengganggu jalannya operasional bisnis Anda. Tim respon cepat kami siap siaga remote maupun segera menuju ke lokasi Anda."
                        ]
                    ];
                @endphp
                
                @foreach($faqs as $fIdx => $faq)
                    <div class="faq-item" style="background: rgba(15, 32, 64, 0.4) !important; border: 1px solid rgba(255,255,255,0.06) !important; border-radius: 12px !important; padding: 20px 24px !important; margin-bottom: 16px !important; transition: all 0.3s ease-in-out !important;" onclick="toggleFaq({{ $fIdx }})">
                        <div class="faq-question-row">
                            <h4 style="font-size: 1.1rem !important; font-weight: 700 !important; color: #ffffff !important; margin: 0 !important;">{{ $faq['q'] }}</h4>
                            <div class="faq-icon-arrow" id="faq-arrow-{{ $fIdx }}">
                                <i data-lucide="chevron-down"></i>
                            </div>
                        </div>
                        <div class="faq-answer-panel" id="faq-answer-{{ $fIdx }}">
                            <p style="color: rgba(255, 255, 255, 0.7) !important; font-size: 0.95rem !important; line-height: 1.65 !important; margin: 16px 0 0 0 !important; border-top: 1px solid rgba(255,255,255,0.08) !important; padding-top: 14px !important;">{{ $faq['a'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ── HUBUNGI KAMI ── -->
    <section class="home-contact-section">
        <div class="hc-bg-deco">
            <div class="hc-orb hc-orb-1"></div>
            <div class="hc-orb hc-orb-2"></div>
            <div class="hero-grid"></div>
        </div>
        <div class="container">
            <div class="section-header reveal" style="margin-bottom: 56px">
                <div class="badge" style="background: rgba(59,130,246,.12); color: #60a5fa; border-color: rgba(59,130,246,.25)">Hubungi Kami</div>
                <h2 style="color: #fff">Kami Siap Membantu Anda</h2>
                <p style="color: rgba(255,255,255,.65)">Jangan ragu menghubungi kami. Tim profesional siap merespons dalam waktu kurang dari 1 jam.</p>
            </div>
            <div class="hc-grid">
                <!-- Info Column -->
                <div class="hc-info-col reveal">
                    <div class="hc-cards">
                        @php
                            $contactInfo = [
                                ["icon" => "phone", "title" => "Telepon / WhatsApp", "value" => "081210874692", "link" => "tel:081210874692", "label" => "Hubungi Sekarang"],
                                ["icon" => "mail", "title" => "Email", "value" => "cs@itsupport-jabodetabek.com", "link" => "mailto:cs@itsupport-jabodetabek.com", "label" => "Kirim Email"],
                                ["icon" => "map-pin", "title" => "Alamat", "value" => "Jatiasih Jatisari, Bekasi Selatan 17426", "link" => "https://www.google.com/maps/place/IT+Support+Jabodetabek", "label" => "Lihat di Maps"],
                                ["icon" => "clock", "title" => "Jam Operasional", "value" => "Senin – Sabtu: 08.00 – 20.00\nMinggu: 09.00 – 17.00", "link" => null, "label" => null]
                            ];
                        @endphp
                        @foreach($contactInfo as $info)
                            <div class="hc-card">
                                <div class="hc-icon"><i data-lucide="{{ $info['icon'] }}" style="width:22px;height:22px"></i></div>
                                <div class="hc-detail">
                                    <h4>{{ $info['title'] }}</h4>
                                    <p>{{ $info['value'] }}</p>
                                    @if($info['link'])
                                        <a href="{{ $info['link'] }}" target="_blank" rel="noreferrer" class="hc-link">{{ $info['label'] }} →</a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <a href="https://wa.me/6281210874692?text=Halo%20IT%20Support%20Jabodetabek" target="_blank" rel="noreferrer" class="hc-wa-btn">
                        <svg viewBox="0 0 24 24" fill="currentColor" width="26" height="26"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                        <div>
                            <span class="hc-wa-title">Chat WhatsApp Langsung</span>
                            <span class="hc-wa-sub">Fast Response · Senin–Sabtu 08.00–20.00</span>
                        </div>
                    </a>
                </div>
                <!-- Form Column -->
                <div class="hc-form-col reveal">
                    <div class="hc-form-wrap">
                        <h3>Kirim Pesan</h3>
                        <p>Isi formulir di bawah ini dan kami akan menghubungi Anda segera.</p>
                        <form onsubmit="event.preventDefault(); alert('Pesan terkirim! (Demo Laravel)');" class="hc-form">
                            <div class="hc-form-row">
                                <div class="hc-form-group">
                                    <label for="hc-name">Nama Lengkap *</label>
                                    <input id="hc-name" name="name" type="text" placeholder="Nama Anda" required />
                                </div>
                                <div class="hc-form-group">
                                    <label for="hc-phone">No. Telepon / WA</label>
                                    <input id="hc-phone" name="phone" type="tel" placeholder="08xxxxxxxxxx" />
                                </div>
                            </div>
                            <div class="hc-form-group">
                                <label for="hc-email">Alamat Email *</label>
                                <input id="hc-email" name="email" type="email" placeholder="email@anda.com" required />
                            </div>
                            <div class="hc-form-group">
                                <label for="hc-subject">Subjek / Keperluan</label>
                                <select id="hc-subject" name="subject">
                                    <option value="">Pilih Layanan...</option>
                                    <option>Service Laptop &amp; PC</option>
                                    <option>Instalasi Jaringan</option>
                                    <option>Pasang CCTV</option>
                                    <option>Pembuatan Website</option>
                                    <option>Maintenance IT</option>
                                    <option>Konsultasi IT</option>
                                    <option>Lainnya</option>
                                </select>
                            </div>
                            <div class="hc-form-group">
                                <label for="hc-message">Pesan *</label>
                                <textarea id="hc-message" name="message" rows="4" placeholder="Ceritakan kebutuhan IT Anda..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-accent hc-submit">
                                <i data-lucide="send" style="width:18px;height:18px"></i> Kirim Pesan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@section('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Slideshows logic
        let currentHeroImage = 0;
        let currentBgImage = 0;
        const heroImgs = document.querySelectorAll('.hero-img-main');
        const heroCaptions = document.querySelectorAll('.hero-caption');
        const heroDots = document.querySelectorAll('.hero-dot');
        const bgImgs = document.querySelectorAll('.hero-bg-img');

        function setHeroSlide(index) {
            heroImgs[currentHeroImage].classList.remove('active');
            heroCaptions[currentHeroImage].classList.remove('active');
            heroDots[currentHeroImage].classList.remove('active');
            
            currentHeroImage = index;
            
            heroImgs[currentHeroImage].classList.add('active');
            heroCaptions[currentHeroImage].classList.add('active');
            heroDots[currentHeroImage].classList.add('active');
        }

        setInterval(() => {
            setHeroSlide((currentHeroImage + 1) % heroImgs.length);
        }, 3500);

        setInterval(() => {
            bgImgs[currentBgImage].classList.remove('active');
            currentBgImage = (currentBgImage + 1) % bgImgs.length;
            bgImgs[currentBgImage].classList.add('active');
        }, 5000);

        heroDots.forEach((dot, idx) => {
            dot.addEventListener('click', () => {
                setHeroSlide(idx);
            });
        });

        // PETA INTERAKTIF JABODETABEK - LEAFLET.JS
        
        // Data Wilayah & Kantor (Dengan preset koordinat detail untuk pemfokusan kamera close-up)
        const regionsData = {
            all: {
                title: "Layanan IT Support Seluruh Jabodetabek",
                badge: "Seluruh JABODETABEK",
                desc: "PT Info Tech Support Jabodetabek melayani seluruh area Jakarta, Bogor, Depok, Tangerang, dan Bekasi dengan jaminan response time di bawah 1 jam. Silakan pilih tombol di atas untuk melihat detail kantor operasional dan cakupan layanan.",
                address: "Kantor 1 (Bekasi Pusat) & Kantor 2 (Jakarta Barat)",
                response: "< 1 Jam (Teknisi Siaga Terdekat)",
                mapsLink: "https://www.google.com/maps/place/IT+Support+Jabodetabek",
                waLink: "https://wa.me/6281210874692?text=Halo%20IT%20Support%20Jabodetabek,%20saya%20memerlukan%20layanan%20IT%20Support%20di%20area%20saya",
                bounds: [[-6.79, 106.32], [-5.98, 107.28]],
                subDistricts: ["Jakarta", "Bekasi", "Bogor", "Depok", "Tangerang", "Cikarang", "BSD City", "Margonda", "Karawaci", "Jatiasih"]
            },
            bekasi: {
                title: "Project Office",
                badge: "KANTOR PUSAT BEKASI",
                desc: "Kantor Pusat kami di Bekasi Selatan siap menangani perbaikan hardware laptop/PC, instalasi jaringan fiber optic/LAN enterprise, setup & maintenance server kantor, Mikrotik routing, backup data, serta bantuan IT helpdesk siaga 24/7.",
                address: "Jl.Durian Blok CR 6 Komp.Bumi Dirgantara Permai Jatiasih Jatisari Bekasi Selatan 17426, RT.004/RW.013, Jatisari, Kec. Jatiasih, Kota Bks, Jawa Barat 17426",
                response: "< 30 Menit (Respon Prioritas Utama)",
                mapsLink: "https://www.google.com/maps/place/IT+Support+Jabodetabek/@-6.3387038,106.953362,21z",
                waLink: "https://wa.me/6281210874692?text=Halo%20IT%20Support%20Bekasi,%20saya%20membutuhkan%20jasa%20IT%20support%20di%20wilayah%20Bekasi.",
                center: [-6.3387038, 106.953362],
                zoom: 17, // Zoom sangat dekat untuk memperjelas jalan & lokasi kantor pusat
                markerKey: 'bekasi',
                subDistricts: ["Jatiasih", "Pondok Gede", "Cikarang", "Cibitung", "Tambun", "Bekasi Selatan", "Bekasi Barat", "Bekasi Timur", "Bekasi Utara"]
            },
            jakarta: {
                title: "Project Office DKI Jakarta",
                badge: "JAKARTA BARAT",
                desc: "Kantor Cabang kami melayani jasa setup jaringan, maintenance komputer kantor, troubleshoot Mikrotik, setup firewall, setup VPS/dedicated server, serta pasang CCTV HD online untuk gedung perkantoran, ruko, pabrik, dan hunian di seluruh DKI Jakarta dan sekitarnya.",
                address: "Komp. SMA Islam Al Azhar 20, Jl. H. Sa'aba No.25, RT.1/RW.3, Meruya Utara, Kec. Kembangan, Kota Jakarta Barat, DKI Jakarta 11620",
                response: "< 45 Menit (Respons Sangat Cepat)",
                mapsLink: "https://www.google.com/maps/place/SMA+Islam+Al+Azhar+20+Kembangan/@-6.2174923,106.7311076,17z",
                waLink: "https://wa.me/6281210874692?text=Halo%20IT%20Support%20Jakarta,%20saya%20membutuhkan%20jasa%20IT%20support%20di%20wilayah%20Jakarta.",
                center: [-6.2174923, 106.7311076],
                zoom: 17, // Zoom sangat dekat untuk memperjelas jalan & lokasi kantor cabang
                markerKey: 'jakarta',
                subDistricts: ["Meruya Utara", "Kembangan", "Jakarta Barat", "Jakarta Pusat", "Jakarta Timur", "Jakarta Selatan", "Jakarta Utara"]
            }
        };

        // Inisialisasi Peta Dasar (Leaflet Map)
        const mapElement = document.getElementById('interactive-map');
        if (mapElement) {
            // Set starting view to all JABODETABEK center
            const map = L.map('interactive-map', {
                center: [-6.32, 106.82],
                zoom: 10,
                scrollWheelZoom: false, // Prevent page scrolling issues
                zoomControl: true
            });

            // Load Tile Layer OpenStreetMap
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Batas Wilayah JABODETABEK Terpadu (Single Outer Boundary Polygon)
            // Diurutkan secara sekuensial searah jarum jam dengan koordinat yang dihaluskan (smoothed) untuk mencegah garis kaku dan persilangan
            const jabodetabekPolygon = L.polygon([
                [-6.02, 106.33], // Kresek (Tangerang Barat Daya)
                [-6.01, 106.40], // Mauk Barat (Tangerang Barat Laut)
                [-6.01, 106.48], // Mauk Timur (Tangerang Utara)
                [-6.00, 106.57], // Pakuhaji (Tangerang Utara)
                [-6.01, 106.67], // Tanjung Pasir / Teluknaga (Tangerang Utara)
                [-6.06, 106.73], // PIK / Kamal Muara (Jakarta Utara - Dihaluskan agar tidak membentuk V kaku)
                [-6.07, 106.83], // Ancol / Tanjung Priok (Jakarta Utara - Dihaluskan agar sejajar garis pantai)
                [-6.06, 106.94], // Cilincing / Marunda (Jakarta Utara - Batas Timur Laut)
                [-6.00, 106.99], // Tarumajaya (Bekasi Utara)
                [-5.92, 107.01], // Muara Gembong Tanjung Bungin (Bekasi North-West coast)
                [-5.91, 107.08], // Muara Gembong Utara (Bekasi North coast)
                [-5.98, 107.13], // Muara Gembong Timur (Bekasi North-East boundary)
                [-6.03, 107.24], // Cabangbungin (Bekasi East boundary)
                [-6.12, 107.26], // Pebayuran (Bekasi East boundary / Citarum river)
                [-6.22, 107.28], // Kedungwaringin (Bekasi East / Batas Karawang)
                [-6.31, 107.29], // Cikarang Timur Timur (Bekasi South-East)
                [-6.38, 107.23], // Bojongmangu (Bekasi South boundary)
                [-6.44, 107.14], // Cariu Utara (Bogor East boundary)
                [-6.52, 107.23], // Cariu Timur (Bogor East / Batas Cianjur)
                [-6.61, 107.19], // Tanjungsari Timur (Bogor South-East)
                [-6.69, 107.15], // Tanjungsari Selatan (Bogor South boundary)
                [-6.71, 107.02], // Puncak / Cisarua (Bogor South boundary)
                [-6.73, 106.92], // Megamendung Selatan (Bogor South boundary)
                [-6.81, 106.84], // Cigombong (Bogor South / Batas Sukabumi)
                [-6.80, 106.76], // Cijeruk (Bogor South-West / Batas Sukabumi)
                [-6.77, 106.67], // Pamijahan (Bogor West / Kaki Gunung Salak)
                [-6.73, 106.56], // Nanggung Selatan (Bogor West boundary)
                [-6.64, 106.44], // Jasinga Selatan (Bogor West boundary)
                [-6.58, 106.39], // Jasinga Barat (Bogor West / Batas Banten)
                [-6.48, 106.41], // Tenjo Selatan (Tangerang South-West boundary)
                [-6.39, 106.40], // Tenjo / Parungpanjang Barat (Tangerang West boundary)
                [-6.33, 106.33], // Solear / Batas Maja (Tangerang West boundary)
                [-6.25, 106.32], // Cisoka (Tangerang West boundary)
                [-6.17, 106.33], // Balaraja Barat (Tangerang West boundary)
                [-6.10, 106.34], // Jayanti (Tangerang West / Batas Serang)
                [-6.05, 106.33]  // Kresek (Tangerang West / Batas Serang)
            ], {
                color: '#3b82f6',     // Vibrant Premium Blue
                fillColor: '#3b82f6', // Premium blue fill
                fillOpacity: 0.08,    // Subtle modern glow
                weight: 4             // Premium thick outline
            }).addTo(map);

            // Bind premium tooltip to the Jabodetabek boundary
            jabodetabekPolygon.bindTooltip("Cakupan Wilayah Operasional <b>JABODETABEK</b>", { sticky: true });

            // PINS/MARKERS TITIK LOKASI DENGAN CUSTOM BEACON PULSE (HTML/CSS) - HANYA KANTOR 1 DAN KANTOR 2
            
            // Helper fungsi untuk membuat penanda dinamis dengan CSS pulsasi
            function createPulseIcon(colorClass) {
                return L.divIcon({
                    className: 'custom-pulse-marker',
                    html: `<div class="pulse-ring ${colorClass}"></div><div class="pulse-dot ${colorClass}"></div>`,
                    iconSize: [26, 26],
                    iconAnchor: [13, 13]
                });
            }

            // Definisikan Objek Penanda (Markers)
            const markers = {};

            // 1. Kantor Pusat Bekasi (Kantor 1)
            markers.bekasi = L.marker([-6.3387038, 106.953362], {
                icon: createPulseIcon('bekasi-pulse')
            }).addTo(map).bindPopup(`
                <div class="map-popup-premium">
                    <h4 style="color:#06b6d4; font-weight:800; margin:0 0 6px 0;">Kantor 1: PT Info Tech Support (Pusat)</h4>
                    <p style="margin:0 0 10px 0; font-size:0.85rem; color:#475569;">Jl.Durian Blok CR 6 Jatiasih, Bekasi Selatan</p>
                    <a href="${regionsData.bekasi.mapsLink}" target="_blank" style="display:inline-block; background:#06b6d4; color:#fff; padding:6px 12px; border-radius:6px; font-size:0.75rem; text-decoration:none; font-weight:700;">Buka Google Maps &rarr;</a>
                </div>
            `);

            // 2. Kantor Cabang Jakarta Barat (Kantor 2)
            markers.jakarta = L.marker([-6.2174923, 106.7311076], {
                icon: createPulseIcon('jakarta-pulse')
            }).addTo(map).bindPopup(`
                <div class="map-popup-premium">
                    <h4 style="color:#3b82f6; font-weight:800; margin:0 0 6px 0;">Kantor 2: Cabang Jakarta Barat</h4>
                    <p style="margin:0 0 10px 0; font-size:0.85rem; color:#475569;">Komp. SMA Islam Al Azhar 20 Kembangan, Jakarta Barat</p>
                    <a href="${regionsData.jakarta.mapsLink}" target="_blank" style="display:inline-block; background:#3b82f6; color:#fff; padding:6px 12px; border-radius:6px; font-size:0.75rem; text-decoration:none; font-weight:700;">Buka Google Maps &rarr;</a>
                </div>
            `);

            // Event Click pada Marker Peta untuk sinkronisasi Switcher
            Object.keys(markers).forEach(key => {
                markers[key].on('click', () => {
                    const btn = document.querySelector(`.map-switch-btn[data-region="${key}"]`);
                    if (btn) btn.click();
                });
            });

            // LOGIKA SWITCHER TOMBOL REGION
            const mapBtns = document.querySelectorAll('.map-switch-btn');
            const regionBadge = document.getElementById('region-badge');
            const regionTitle = document.getElementById('region-title');
            const regionDesc = document.getElementById('region-desc');
            const regionAddress = document.getElementById('region-address');
            const regionResponse = document.getElementById('region-response');
            const regionMapsLink = document.getElementById('region-maps-link');
            const regionWaLink = document.getElementById('region-wa-link');

            mapBtns.forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    
                    const region = btn.getAttribute('data-region');
                    const data = regionsData[region];
                    if (!data) return;

                    // 1. Update Active State Styles on Buttons
                    mapBtns.forEach(b => b.classList.remove('active'));
                    btn.classList.add('active');

                    // 2. Update Details Panel Text
                    if (regionBadge) regionBadge.textContent = data.badge;
                    if (regionTitle) regionTitle.textContent = data.title;
                    if (regionDesc) regionDesc.textContent = data.desc;
                    if (regionAddress) regionAddress.textContent = data.address;
                    if (regionResponse) regionResponse.textContent = data.response;
                    if (regionMapsLink) regionMapsLink.setAttribute('href', data.mapsLink);
                    if (regionWaLink) regionWaLink.setAttribute('href', data.waLink);

                    // Color coordination for badges
                    if (regionBadge) {
                        regionBadge.className = 'details-badge'; // Reset
                        if (region !== 'all') regionBadge.classList.add(region);
                    }

                    // 3. Map Camera Zooming and Fitting
                    if (region === 'all') {
                        // Fit bounds for the entire Jabodetabek outline
                        map.fitBounds(data.bounds, {
                            padding: [40, 40],
                            animate: true,
                            duration: 1.5
                        });
                    } else {
                        // Zoom in very closely directly onto the office coordinate for extreme clarity!
                        map.setView(data.center, data.zoom, {
                            animate: true,
                            pan: { duration: 1.5 },
                            zoom: { duration: 1.5 }
                        });
                    }
                    
                    // Populate dynamic sub-districts chips
                    const chipsContainer = document.getElementById('region-chips-container');
                    const chipsWrapper = document.getElementById('region-chips-wrapper');
                    if (chipsContainer && chipsWrapper) {
                        chipsContainer.innerHTML = ''; // Reset
                        if (data.subDistricts && data.subDistricts.length > 0) {
                            data.subDistricts.forEach(sd => {
                                const chip = document.createElement('span');
                                chip.className = 'region-chip-badge';
                                chip.style.cssText = 'background: rgba(59, 130, 246, 0.1); color: #93c5fd; border: 1px solid rgba(59, 130, 246, 0.2); padding: 4px 10px; border-radius: 6px; font-size: 0.75rem; font-weight: 700;';
                                chip.textContent = sd;
                                chipsContainer.appendChild(chip);
                            });
                            chipsWrapper.style.display = 'block';
                        } else {
                            chipsWrapper.style.display = 'none';
                        }
                    }
                    
                    // Open marker popup only if we have a physical office marker in that key
                    if (data.markerKey && markers[data.markerKey]) {
                        setTimeout(() => {
                            markers[data.markerKey].openPopup();
                        }, 1600); // Wait for close-up zoom animation to complete
                    }
                });
            });

            // Trigger initial click on first load
            const activeBtn = document.querySelector('.map-switch-btn.active');
            if (activeBtn) activeBtn.click();
        }

        // Intersection Observer
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) e.target.classList.add('visible');
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
    });

    // FAQ Accordion Toggle Function
    function toggleFaq(index) {
        const items = document.querySelectorAll('.faq-item');
        const item = items[index];
        const answer = document.getElementById(`faq-answer-${index}`);
        
        const isActive = item.classList.contains('active');
        
        // Close other open panels
        items.forEach((el, idx) => {
            el.classList.remove('active');
            const ans = document.getElementById(`faq-answer-${idx}`);
            if (ans) ans.style.maxHeight = '0px';
        });
        
        if (!isActive) {
            item.classList.add('active');
            answer.style.maxHeight = answer.scrollHeight + 'px';
        }
    }
</script>
@endsection
