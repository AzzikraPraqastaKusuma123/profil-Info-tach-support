@extends('layouts.app')

@section('title', 'Klien Kami | IT Support Jabodetabek')
@section('canonical', 'https://itsupport-jabodetabek.com/klien-kami')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/KlienKami.css') }}">
@endsection

@section('content')
<main>
    <div class="page-hero">
        <div class="container">
            <div class="badge">Klien Kami</div>
            <h1>Dipercaya oleh Banyak Bisnis & UMKM</h1>
            <p>Lebih dari 500 bisnis dan UMKM di Jabodetabek telah mempercayakan kebutuhan IT mereka kepada kami.</p>
        </div>
    </div>

    <!-- Client Logos -->
    <section class="section">
        <div class="container">
            <div class="section-header reveal">
                <div class="badge">Mitra Bisnis Kami</div>
                <h2>Klien yang Telah Kami Layani</h2>
                <p>Dari UMKM hingga perusahaan menengah, kami hadir untuk semua.</p>
            </div>
            <div class="client-filters reveal">
                <button class="filter-btn active" data-filter="all">Semua Klien</button>
                <button class="filter-btn" data-filter="ind-manufaktur">Manufaktur</button>
                <button class="filter-btn" data-filter="ind-teknologi">Teknologi</button>
                <button class="filter-btn" data-filter="ind-energi">Energi</button>
                <button class="filter-btn" data-filter="ind-kesehatan">Kesehatan</button>
                <button class="filter-btn" data-filter="other">Lainnya</button>
            </div>

            <div class="clients-grid">
                @php
                    $industryIcons = [
                        "Manufaktur" => "factory",
                        "Media & Telekomunikasi" => "tv",
                        "Telekomunikasi" => "phone-call",
                        "Energi" => "zap",
                        "Teknologi" => "cpu",
                        "Otomotif" => "car",
                        "Logistik" => "truck",
                        "Kesehatan" => "activity",
                        "Konstruksi" => "wrench",
                        "Desain & Konstruksi" => "wrench",
                        "FMCG" => "shopping-bag",
                        "Hospitality" => "hotel",
                        "Properti" => "building",
                        "Agrikultur" => "sprout",
                        "Konsultan" => "briefcase",
                        "Pendidikan/Sosial" => "graduation-cap",
                        "Travel" => "plane",
                        "Perdagangan" => "store",
                        "Retail" => "shopping-cart",
                        "Layanan" => "handshake"
                    ];
                @endphp
                @foreach($clients as $c)
                    @php
                        $industryClass = 'ind-' . strtolower(str_replace([' ', '&', '/'], '-', $c['industry']));
                        $industryClass = str_replace('--', '-', $industryClass);
                        $iconName = $industryIcons[$c['industry']] ?? 'building-2';
                    @endphp
                    <div class="client-card reveal">
                        <div class="client-logo-img">
                            <img src="{{ asset($c['logo']) }}" alt="Logo {{ $c['name'] }}" />
                        </div>
                        <div class="client-info">
                            <h4>{{ $c['name'] }}</h4>
                            <div class="client-industry {{ $industryClass }}">
                                <i data-lucide="{{ $iconName }}" style="width:12px;height:12px"></i>
                                <span>{{ $c['industry'] }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="section testi-full-section">
        <div class="container">
            <div class="section-header reveal">
                <div class="badge">Testimoni</div>
                <h2>Apa Kata Mereka tentang Kami?</h2>
                <p>Kepercayaan dan kepuasan klien adalah bukti nyata kualitas layanan kami.</p>
            </div>
            <div class="testi-full-grid">
                @php
                    $testimonials = [
                        ["name" => "Budi Santoso", "company" => "CV. Maju Jaya", "role" => "Direktur", "rating" => 5, "text" => "IT Support Jabodetabek adalah partner IT terbaik yang pernah kami gunakan. Respons cepat, diagnosa transparan, dan hasil kerja memuaskan. Laptop kantor kami berhasil diperbaiki dalam 2 jam!"],
                        ["name" => "Siti Rahayu", "company" => "Apotek Sehat Prima", "role" => "Pemilik", "rating" => 5, "text" => "Pemasangan CCTV di apotek saya dikerjakan dengan sangat rapi dan profesional. Sekarang saya bisa memantau toko dari smartphone kapan saja. Sangat puas!"],
                        ["name" => "Ahmad Fauzi", "company" => "PT. Berkah Abadi", "role" => "IT Manager", "rating" => 5, "text" => "Sudah 3 tahun kami mempercayakan maintenance IT kantor ke IT Support Jabodetabek. Jaringan kami selalu stabil dan masalah diselesaikan dengan cepat. Highly recommended!"],
                        ["name" => "Dewi Anggraini", "company" => "Klinik Sehat Bersama", "role" => "Kepala Admin", "rating" => 5, "text" => "Website klinik kami dibuat dengan sangat profesional dan sesuai ekspektasi. Bahkan setelah selesai, tim mereka masih siap membantu jika ada kendala. Luar biasa!"],
                        ["name" => "Hendra Kusuma", "company" => "Toko Elektronik Mega", "role" => "Manajer", "rating" => 5, "text" => "Instalasi jaringan WiFi untuk toko kami lancar dan hasilnya sangat bagus. Sinyal kuat merata di seluruh area toko. Tim kerjanya juga sangat ramah dan bersih."],
                        ["name" => "Rina Marlina", "company" => "UD. Karya Mandiri", "role" => "Owner", "rating" => 5, "text" => "Konsultasi IT gratis yang mereka tawarkan sangat membantu kami menentukan kebutuhan infrastruktur IT yang tepat sesuai kebutuhan. Profesional dan sangat memuaskan."]
                    ];
                @endphp
                @foreach($testimonials as $t)
                    <div class="testi-full-card reveal">
                        <i data-lucide="quote" class="quote-icon" style="width:32px;height:32px"></i>
                        <p class="testi-full-text">{{ $t['text'] }}</p>
                        <div class="testi-full-stars">
                            @for($i=0; $i<$t['rating']; $i++)
                                <i data-lucide="star" style="width:16px;height:16px;fill:#f59e0b;color:#f59e0b"></i>
                            @endfor
                        </div>
                        <div class="testi-full-author">
                            <div class="testi-full-avatar">{{ substr($t['name'], 0, 1) }}</div>
                            <div>
                                <div class="testi-full-name">{{ $t['name'] }}</div>
                                <div class="testi-full-meta">{{ $t['role'] }} &middot; {{ $t['company'] }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="klien-cta">
        <div class="container klien-cta-inner reveal">
            <h2>Bergabunglah dengan 500+ Klien Puas Kami</h2>
            <p>Hubungi kami sekarang dan jadilah bagian dari keluarga besar IT Support Jabodetabek.</p>
            <a href="https://wa.me/6281210874692" target="_blank" rel="noreferrer" class="btn btn-accent">
                Mulai Konsultasi Gratis
            </a>
        </div>
    </section>
</main>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // IntersectionObserver for reveal effects
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) e.target.classList.add('visible');
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

        // Client filtering logic
        const filterButtons = document.querySelectorAll('.filter-btn');
        const clientCards = document.querySelectorAll('.client-card');

        filterButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                // Toggle active button
                filterButtons.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');

                const filterValue = btn.getAttribute('data-filter');

                clientCards.forEach(card => {
                    // Remove previous animation classes
                    card.classList.remove('fade-in');
                    
                    let isVisible = false;
                    
                    if (filterValue === 'all') {
                        isVisible = true;
                    } else if (filterValue === 'other') {
                        const hasMainCategory = card.querySelector('.client-industry').classList.contains('ind-manufaktur') ||
                                                card.querySelector('.client-industry').classList.contains('ind-teknologi') ||
                                                card.querySelector('.client-industry').classList.contains('ind-energi') ||
                                                card.querySelector('.client-industry').classList.contains('ind-kesehatan');
                        isVisible = !hasMainCategory;
                    } else {
                        isVisible = card.querySelector('.client-industry').classList.contains(filterValue);
                    }

                    if (isVisible) {
                        card.classList.remove('hidden');
                        // Trigger reflow to restart CSS animation
                        void card.offsetWidth;
                        card.classList.add('fade-in');
                    } else {
                        card.classList.add('hidden');
                    }
                });
            });
        });
    });
</script>
@endsection
