@extends('layouts.app')

@section('title', 'IT Support Jabodetabek | Solusi IT Profesional')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/Home.css') }}">
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
                    <a href="{{ url('/layanan-kami') }}" class="btn btn-outline">
                        Lihat Layanan
                    </a>
                </div>
            </div>
            <div class="hero-visual animate-float">
                <div class="hero-image-wrapper">
                    @for($i = 1; $i <= 10; $i++)
                        <img src="{{ asset('home-page/'.$i.'.png') }}" alt="Kegiatan IT Support {{ $i }}" class="hero-img-main {{ $i == 1 ? 'active' : '' }}" />
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
                    <a href="{{ url('/layanan-kami') }}" class="{{ $cardClass }}" style="--bento-accent: {{ $s['color'] }}">
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
                    <a href="{{ url('/tentang-kami') }}" class="premium-btn mt-6">
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

    <!-- ── MAP ── -->
    <section class="section map-section">
        <div class="container">
            <div class="section-header reveal">
                <div class="badge"><i data-lucide="map-pin" style="width:14px;height:14px"></i> Lokasi Kami</div>
                <h2>Kunjungi Kantor Kami</h2>
                <p>Kami siap menyambut Anda untuk konsultasi langsung terkait kebutuhan IT bisnis Anda.</p>
            </div>
            <div class="map-container reveal">
                <a 
                    href="https://www.google.com/maps/place/IT+Support+Jabodetabek/@-6.3387167,106.9532905,21z/data=!4m14!1m7!3m6!1s0x2e6993a72ff8449d:0x935eaeebbb0be78e!2sIT+Support+Jabodetabek!8m2!3d-6.3387038!4d106.953362!16s%2Fg%2F11h3bgbt5b!3m5!1s0x2e6993a72ff8449d:0x935eaeebbb0be78e!8m2!3d-6.3387038!4d106.953362!16s%2Fg%2F11h3bgbt5b?hl=en&entry=ttu"
                    target="_blank"
                    rel="noreferrer"
                    class="map-link-wrapper"
                    title="Buka di Google Maps"
                >
                    <iframe
                        src="https://maps.google.com/maps?q=-6.3387038,106.953362&hl=id&z=20&output=embed"
                        width="100%"
                        height="450"
                        style="border:0;pointer-events:none"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Lokasi Kantor IT Support Jabodetabek"
                    ></iframe>
                    <div class="map-overlay-hint">
                        <i data-lucide="external-link" style="width:24px;height:24px"></i>
                        <span>Buka di Google Maps</span>
                    </div>
                </a>
                <div class="map-info">
                    <div class="map-info-item">
                        <i data-lucide="map-pin" class="map-icon" style="width:20px;height:20px"></i>
                        <div>
                            <strong>Alamat Kantor:</strong>
                            <span>Jl.Durian Blok CR 6 Komp.Bumi Dirgantara Permai Jatiasih Jatisari Bekasi Selatan 17426, RT.004/RW.013, Jatisari, Kec. Jatiasih, Kota Bks, Jawa Barat 17426</span>
                        </div>
                    </div>
                </div>
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

        // Intersection Observer
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) e.target.classList.add('visible');
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
    });
</script>
@endsection
