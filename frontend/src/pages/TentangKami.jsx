import { useEffect, useState } from 'react';
import { Target, Eye, Heart, Users, Award, Clock, ChevronLeft, ChevronRight, CheckCircle, MapPin, Phone } from 'lucide-react';
import './TentangKami.css';

const values = [
  {
    icon: <Award size={28} />,
    title: 'Profesionalisme',
    desc: 'Standar kerja tertinggi di setiap proyek yang kami tangani, tanpa terkecuali.',
    color: '#3b82f6',
  },
  {
    icon: <Heart size={28} />,
    title: 'Dedikasi',
    desc: 'Kepuasan klien adalah prioritas utama. Kami bekerja sepenuh hati untuk hasil terbaik.',
    color: '#ef4444',
  },
  {
    icon: <Users size={28} />,
    title: 'Kolaborasi',
    desc: 'Kemitraan yang baik menghasilkan solusi yang lebih inovatif dan efektif untuk Anda.',
    color: '#10b981',
  },
  {
    icon: <Clock size={28} />,
    title: 'Ketepatan Waktu',
    desc: 'Setiap komitmen kami jaga — pekerjaan selesai tepat sesuai tenggat yang disepakati.',
    color: '#f59e0b',
  },
];

const slidePhotos = [
  { src: '/tim-img/1.png', caption: 'Tim kami saat melayani klien di lapangan' },
  { src: '/tim-img/2.png', caption: 'Koordinasi dan diskusi bersama mitra bisnis' },
];

const highlights = [
  { icon: <CheckCircle size={18} />, text: 'Berdiri sejak 2017' },
  { icon: <CheckCircle size={18} />, text: 'Teknisi bersertifikat' },
  { icon: <CheckCircle size={18} />, text: 'Layanan bergaransi' },
  { icon: <MapPin size={18} />, text: 'Jabodetabek & sekitarnya' },
];

export default function TentangKami() {
  const [currentSlide, setCurrentSlide] = useState(0);
  const [isTransitioning, setIsTransitioning] = useState(false);

  useEffect(() => {
    document.title = 'Tentang Kami | IT Support Jabodetabek';
    const observer = new IntersectionObserver(
      entries => entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); }),
      { threshold: 0.1 }
    );
    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
    return () => observer.disconnect();
  }, []);

  useEffect(() => {
    const interval = setInterval(() => {
      changeSlide((currentSlide + 1) % slidePhotos.length);
    }, 4500);
    return () => clearInterval(interval);
  }, [currentSlide]);

  const changeSlide = (index) => {
    if (isTransitioning) return;
    setIsTransitioning(true);
    setTimeout(() => {
      setCurrentSlide(index);
      setIsTransitioning(false);
    }, 400);
  };

  const goToPrev = () => changeSlide((currentSlide - 1 + slidePhotos.length) % slidePhotos.length);
  const goToNext = () => changeSlide((currentSlide + 1) % slidePhotos.length);

  return (
    <main>
      {/* ── Page Hero ── */}
      <div className="page-hero about-page-hero">
        {/* Background photo */}
        <img src="/tim-img/1.png" alt="" className="about-hero-bg-img" />
        {/* Dark overlay */}
        <div className="about-hero-overlay" />
        {/* Dot pattern on top */}
        <div className="about-hero-bg-dots" />
        <div className="container about-hero-content">
          <div className="badge">Tentang Kami</div>
          <h1>Mengenal <span className="gradient-text">IT Support</span><br />Jabodetabek</h1>
          <p>Mitra IT terpercaya yang hadir memberikan solusi nyata untuk bisnis Anda sejak 2017.</p>
        </div>
      </div>

      {/* ── About: Siapa Kami ── */}
      <section className="section about-main-section">
        <div className="container">
          <div className="about-grid">

            {/* Left: Slideshow */}
            <div className="about-image-col reveal">
              <div className="about-image-wrapper">
                <div className="about-slideshow">
                  {slidePhotos.map((photo, index) => (
                    <img
                      key={index}
                      src={photo.src}
                      alt={photo.caption}
                      className={`about-slide-img ${index === currentSlide ? 'active' : ''} ${isTransitioning ? 'transitioning' : ''}`}
                    />
                  ))}
                  <div className="about-slide-overlay" />

                  {/* Photo caption */}
                  <div className={`about-photo-caption ${isTransitioning ? 'fading' : ''}`}>
                    <span>{slidePhotos[currentSlide].caption}</span>
                  </div>

                  <button className="slide-nav slide-prev" onClick={goToPrev} aria-label="Sebelumnya">
                    <ChevronLeft size={20} />
                  </button>
                  <button className="slide-nav slide-next" onClick={goToNext} aria-label="Berikutnya">
                    <ChevronRight size={20} />
                  </button>

                  <div className="about-slide-dots">
                    {slidePhotos.map((_, index) => (
                      <button
                        key={index}
                        className={`about-dot ${index === currentSlide ? 'active' : ''}`}
                        onClick={() => changeSlide(index)}
                        aria-label={`Foto ${index + 1}`}
                      />
                    ))}
                  </div>
                </div>

                {/* Floating badge */}
                <div className="about-badge-exp">
                  <span className="exp-num">7+</span>
                  <span className="exp-txt">Tahun<br />Pengalaman</span>
                </div>
              </div>
            </div>

            {/* Right: Text */}
            <div className="about-text-col reveal">
              <div className="badge">Siapa Kami</div>
              <h2>IT Support Jabodetabek</h2>
              <div className="divider divider-left divider-blue" />

              <p className="about-lead">
                Kami adalah perusahaan layanan IT profesional yang telah melayani ratusan klien
                dari berbagai segmen bisnis — mulai dari individu, UMKM, hingga perusahaan
                skala menengah di seluruh area Jabodetabek.
              </p>
              <p className="about-body">
                Dengan tim teknisi berpengalaman dan bersertifikat, kami berkomitmen memberikan
                solusi IT yang tepat, cepat, dan bergaransi. Setiap klien diperlakukan sebagai
                mitra jangka panjang, bukan sekadar transaksi biasa.
              </p>

              {/* Highlights */}
              <div className="about-highlights">
                {highlights.map(({ icon, text }) => (
                  <div className="about-highlight-item" key={text}>
                    <span className="highlight-icon">{icon}</span>
                    <span>{text}</span>
                  </div>
                ))}
              </div>

              {/* Stats */}
              <div className="about-stats">
                {[
                  { num: '500+', label: 'Klien Terlayani' },
                  { num: '98%', label: 'Kepuasan Klien' },
                  { num: '1000+', label: 'Proyek Selesai' },
                ].map(({ num, label }) => (
                  <div className="about-stat" key={label}>
                    <div className="about-stat-num">{num}</div>
                    <div className="about-stat-label">{label}</div>
                  </div>
                ))}
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* ── Vision & Mission ── */}
      <section className="section vm-section">
        <div className="container">
          <div className="section-header reveal">
            <div className="badge">Visi &amp; Misi</div>
            <h2>Arah dan Tujuan Kami</h2>
            <p>Landasan nilai yang mengarahkan setiap langkah dan keputusan bisnis kami.</p>
          </div>
          <div className="vm-grid">
            <div className="vm-card vm-vision reveal">
              <div className="vm-card-glow" />
              <div className="vm-icon"><Eye size={32} /></div>
              <h3>Visi</h3>
              <p>
                Menjadi perusahaan IT Support terdepan dan terpercaya di Indonesia yang memberikan
                solusi teknologi inovatif untuk mendorong pertumbuhan bisnis klien kami.
              </p>
            </div>
            <div className="vm-card vm-mission reveal">
              <div className="vm-card-glow vm-card-glow-blue" />
              <div className="vm-icon"><Target size={32} /></div>
              <h3>Misi</h3>
              <ul className="vm-list">
                <li>Memberikan layanan IT berkualitas tinggi dengan harga yang kompetitif dan terjangkau.</li>
                <li>Merespons setiap kebutuhan klien dengan cepat, tepat, dan profesional.</li>
                <li>Terus berinovasi mengikuti perkembangan teknologi terkini.</li>
                <li>Membangun hubungan jangka panjang yang saling menguntungkan bersama klien.</li>
              </ul>
            </div>
          </div>
        </div>
      </section>

      {/* ── Values ── */}
      <section className="section values-section">
        <div className="container">
          <div className="section-header reveal">
            <div className="badge">Nilai-Nilai Kami</div>
            <h2>Prinsip yang Menjadi Landasan Kami</h2>
            <p>Empat pilar utama yang membentuk cara kami bekerja dan melayani setiap klien.</p>
          </div>
          <div className="values-grid">
            {values.map(({ icon, title, desc, color }, i) => (
              <div className="value-card reveal" key={title} style={{ '--accent': color, '--delay': `${i * 0.1}s` }}>
                <div className="value-icon" style={{ background: `${color}18`, color }}>
                  {icon}
                </div>
                <h4>{title}</h4>
                <p>{desc}</p>
                <div className="value-card-bar" style={{ background: color }} />
              </div>
            ))}
          </div>
        </div>
      </section>

    </main>
  );
}
