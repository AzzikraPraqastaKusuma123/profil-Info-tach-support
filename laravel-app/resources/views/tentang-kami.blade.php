@extends('layouts.app')

@section('title', 'Tentang Kami | IT Support Jabodetabek')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/TentangKami.css') }}">
@endsection

@section('content')
<main>
    <!-- ── Page Hero ── -->
    <div class="page-hero about-page-hero">
        <img src="{{ asset('tim-img/1.png') }}" alt="" class="about-hero-bg-img" />
        <div class="about-hero-overlay"></div>
        <div class="about-hero-bg-dots"></div>
        <div class="container about-hero-content">
            <div class="badge">Tentang Kami</div>
            <h1>Mengenal <span class="gradient-text">IT Support</span><br />Jabodetabek</h1>
            <p>Mitra IT terpercaya yang hadir memberikan solusi nyata untuk bisnis Anda sejak 2017.</p>
        </div>
    </div>

    <!-- ── About: Siapa Kami ── -->
    <section class="section about-main-section">
        <div class="container">
            <div class="about-grid">
                <!-- Left: Slideshow -->
                <div class="about-image-col reveal">
                    <div class="about-image-wrapper">
                        <div class="about-slideshow">
                            <img src="{{ asset('tim-img/1.png') }}" alt="Tim kami saat melayani klien di lapangan" class="about-slide-img active" />
                            <img src="{{ asset('tim-img/2.png') }}" alt="Koordinasi dan diskusi bersama mitra bisnis" class="about-slide-img" />
                            <div class="about-slide-overlay"></div>

                            <div class="about-photo-caption">
                                <span>Tim kami saat melayani klien di lapangan</span>
                            </div>

                            <button class="slide-nav slide-prev" aria-label="Sebelumnya">
                                <i data-lucide="chevron-left" style="width:20px;height:20px"></i>
                            </button>
                            <button class="slide-nav slide-next" aria-label="Berikutnya">
                                <i data-lucide="chevron-right" style="width:20px;height:20px"></i>
                            </button>

                            <div class="about-slide-dots">
                                <button class="about-dot active" data-index="0" aria-label="Foto 1"></button>
                                <button class="about-dot" data-index="1" aria-label="Foto 2"></button>
                            </div>
                        </div>

                        <!-- Floating badge -->
                        <div class="about-badge-exp">
                            <span class="exp-num">7+</span>
                            <span class="exp-txt">Tahun<br />Pengalaman</span>
                        </div>
                    </div>
                </div>

                <!-- Right: Text -->
                <div class="about-text-col reveal">
                    <div class="badge">Siapa Kami</div>
                    <h2>IT Support Jabodetabek</h2>
                    <div class="divider divider-left divider-blue"></div>

                    <p class="about-lead">
                        Kami adalah perusahaan layanan IT profesional yang telah melayani ratusan klien
                        dari berbagai segmen bisnis — mulai dari individu, UMKM, hingga perusahaan
                        skala menengah di seluruh area Jabodetabek.
                    </p>
                    <p class="about-body">
                        Dengan tim teknisi berpengalaman dan bersertifikat, kami berkomitmen memberikan
                        solusi IT yang tepat, cepat, dan bergaransi. Setiap klien diperlakukan sebagai
                        mitra jangka panjang, bukan sekadar transaksi biasa.
                    </p>

                    <!-- Highlights -->
                    <div class="about-highlights">
                        @php
                            $highlights = [
                                "Berdiri sejak 2017",
                                "Teknisi bersertifikat",
                                "Layanan bergaransi",
                            ];
                        @endphp
                        @foreach($highlights as $text)
                        <div class="about-highlight-item">
                            <span class="highlight-icon"><i data-lucide="check-circle" style="width:18px;height:18px"></i></span>
                            <span>{{ $text }}</span>
                        </div>
                        @endforeach
                        <div class="about-highlight-item">
                            <span class="highlight-icon"><i data-lucide="map-pin" style="width:18px;height:18px"></i></span>
                            <span>Jabodetabek & sekitarnya</span>
                        </div>
                    </div>

                    <!-- Stats -->
                    <div class="about-stats">
                        <div class="about-stat">
                            <div class="about-stat-num">500+</div>
                            <div class="about-stat-label">Klien Terlayani</div>
                        </div>
                        <div class="about-stat">
                            <div class="about-stat-num">98%</div>
                            <div class="about-stat-label">Kepuasan Klien</div>
                        </div>
                        <div class="about-stat">
                            <div class="about-stat-num">1000+</div>
                            <div class="about-stat-label">Proyek Selesai</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ── Vision & Mission ── -->
    <section class="section vm-section">
        <div class="container">
            <div class="section-header reveal">
                <div class="badge">Visi &amp; Misi</div>
                <h2>Arah dan Tujuan Kami</h2>
                <p>Landasan nilai yang mengarahkan setiap langkah dan keputusan bisnis kami.</p>
            </div>
            <div class="vm-grid">
                <div class="vm-card vm-vision reveal">
                    <div class="vm-card-glow"></div>
                    <div class="vm-icon"><i data-lucide="eye" style="width:32px;height:32px"></i></div>
                    <h3>Visi</h3>
                    <p>
                        Menjadi perusahaan IT Support terdepan dan terpercaya di Indonesia yang memberikan
                        solusi teknologi inovatif untuk mendorong pertumbuhan bisnis klien kami.
                    </p>
                </div>
                <div class="vm-card vm-mission reveal">
                    <div class="vm-card-glow vm-card-glow-blue"></div>
                    <div class="vm-icon"><i data-lucide="target" style="width:32px;height:32px"></i></div>
                    <h3>Misi</h3>
                    <ul class="vm-list">
                        <li>Memberikan layanan IT berkualitas tinggi dengan solusi inovatif dan efisien.</li>
                        <li>Merespons setiap kebutuhan klien dengan cepat, tepat, dan profesional.</li>
                        <li>Terus berinovasi mengikuti perkembangan teknologi terkini.</li>
                        <li>Membangun hubungan jangka panjang yang saling menguntungkan bersama klien.</li>
                    </ul>
                </div>
            </div>

            <!-- Director Quote Section -->
            <div class="director-quote-container reveal">
                <div class="director-photo-wrapper">
                    <img src="{{ asset('direktur/direktur2.png') }}" alt="Raden Ade Ahmad Suryana - Formal" class="director-photo active" id="director-formal">
                    <img src="{{ asset('direktur/direktur.png') }}" alt="Raden Ade Ahmad Suryana - Santai" class="director-photo" id="director-casual">
                </div>
                <div class="director-quote-content">
                    <i data-lucide="quote" class="director-quote-icon"></i>
                    <blockquote class="director-quote-text">
                        "Di IT Support Jabodetabek, kami percaya bahwa teknologi yang hebat adalah teknologi yang berjalan dengan andal dan tanpa hambatan. Fokus kami bukan hanya menyelesaikan masalah, tetapi juga mencegah potensi gangguan melalui sistem pemeliharaan yang terukur dan menghadirkan solusi yang tepat agar bisnis berjalan lebih optimal."
                    </blockquote>
                    <div class="director-info">
                        <span class="director-name">Raden Ade Ahmad Suryana</span>
                        <span class="director-title">IT Director</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ── Values ── -->
    <section class="section values-section">
        <div class="container">
            <div class="section-header reveal">
                <div class="badge">Nilai-Nilai Kami</div>
                <h2>Prinsip yang Menjadi Landasan Kami</h2>
                <p>Empat pilar utama yang membentuk cara kami bekerja dan melayani setiap klien.</p>
            </div>
            <div class="values-grid">
                @php
                    $values = [
                        ["icon" => "award", "title" => "Profesionalisme", "desc" => "Standar kerja tertinggi di setiap proyek yang kami tangani, tanpa terkecuali.", "color" => "#3b82f6"],
                        ["icon" => "heart", "title" => "Dedikasi", "desc" => "Kepuasan klien adalah prioritas utama. Kami bekerja sepenuh hati untuk hasil terbaik.", "color" => "#ef4444"],
                        ["icon" => "users", "title" => "Kolaborasi", "desc" => "Kemitraan yang baik menghasilkan solusi yang lebih inovatif dan efektif untuk Anda.", "color" => "#10b981"],
                        ["icon" => "clock", "title" => "Ketepatan Waktu", "desc" => "Setiap komitmen kami jaga — pekerjaan selesai tepat sesuai tenggat yang disepakati.", "color" => "#f59e0b"]
                    ];
                @endphp
                @foreach($values as $i => $val)
                    <div class="value-card reveal" style="--accent: {{ $val['color'] }}; --delay: {{ $i * 0.1 }}s">
                        <div class="value-icon" style="background: {{ $val['color'] }}18; color: {{ $val['color'] }}">
                            <i data-lucide="{{ $val['icon'] }}" style="width:28px;height:28px"></i>
                        </div>
                        <h4>{{ $val['title'] }}</h4>
                        <p>{{ $val['desc'] }}</p>
                        <div class="value-card-bar" style="background: {{ $val['color'] }}"></div>
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
        const slidePhotos = [
            "Tim kami saat melayani klien di lapangan",
            "Koordinasi dan diskusi bersama mitra bisnis"
        ];
        
        const imgs = document.querySelectorAll('.about-slide-img');
        const dots = document.querySelectorAll('.about-dot');
        const caption = document.querySelector('.about-photo-caption span');
        const captionContainer = document.querySelector('.about-photo-caption');
        
        let currentSlide = 0;
        let isTransitioning = false;
        
        function changeSlide(index) {
            if (isTransitioning) return;
            isTransitioning = true;
            captionContainer.classList.add('fading');
            
            imgs[currentSlide].classList.remove('active');
            dots[currentSlide].classList.remove('active');
            
            setTimeout(() => {
                currentSlide = index;
                imgs[currentSlide].classList.add('active');
                dots[currentSlide].classList.add('active');
                caption.textContent = slidePhotos[currentSlide];
                captionContainer.classList.remove('fading');
                isTransitioning = false;
            }, 400);
        }
        
        document.querySelector('.slide-prev').addEventListener('click', () => {
            changeSlide((currentSlide - 1 + imgs.length) % imgs.length);
        });
        
        document.querySelector('.slide-next').addEventListener('click', () => {
            changeSlide((currentSlide + 1) % imgs.length);
        });
        
        dots.forEach(dot => {
            dot.addEventListener('click', (e) => {
                const idx = parseInt(e.target.getAttribute('data-index'));
                if(idx !== currentSlide) changeSlide(idx);
            });
        });
        
        setInterval(() => {
            changeSlide((currentSlide + 1) % imgs.length);
        }, 4500);

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) e.target.classList.add('visible');
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

        // Director Photo Auto-Swapper
        const formalPhoto = document.getElementById('director-formal');
        const casualPhoto = document.getElementById('director-casual');
        
        setInterval(() => {
            if (formalPhoto.classList.contains('active')) {
                formalPhoto.classList.remove('active');
                casualPhoto.classList.add('active');
            } else {
                casualPhoto.classList.remove('active');
                formalPhoto.classList.add('active');
            }
        }, 4000);
    });
</script>
@endsection
