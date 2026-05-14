import { useEffect, useState } from 'react';
import { Monitor, Wifi, Camera, Globe, Wrench, Headphones, ChevronRight, CheckCircle } from 'lucide-react';
import './LayananKami.css';

const services = [
  {
    icon: <Monitor size={40} />,
    title: 'Service Laptop & PC',
    category: 'Hardware',
    desc: 'Kami menangani berbagai kerusakan laptop dan PC dengan penanganan cepat dan bergaransi. Dipercaya oleh ratusan pengguna di Jabodetabek.',
    features: ['Ganti LCD/LED', 'Upgrade RAM & SSD', 'Perbaikan Motherboard', 'Install Ulang OS', 'Cleaning & Servis Berkala', 'Penggantian Baterai'],
    price: 'Mulai Rp 50.000',
  },
  {
    icon: <Wifi size={40} />,
    title: 'Instalasi Jaringan',
    category: 'Network',
    desc: 'Pemasangan dan konfigurasi jaringan LAN/WiFi untuk rumah, kantor, dan gedung komersial dengan perangkat berkualitas tinggi.',
    features: ['Setting Router & Switch', 'Instalasi Kabel LAN CAT6', 'Konfigurasi WiFi Enterprise', 'VPN Setup', 'Network Monitoring', 'Troubleshooting Jaringan'],
    price: 'Mulai Rp 150.000',
  },
  {
    icon: <Camera size={40} />,
    title: 'Pasang CCTV',
    category: 'Security',
    desc: 'Instalasi CCTV profesional untuk keamanan rumah, toko, kantor, dan area publik dengan kamera resolusi tinggi dan bisa dipantau jarak jauh.',
    features: ['CCTV Indoor & Outdoor', 'Resolusi HD/Full HD/4K', 'Pemantauan via Smartphone', 'DVR & NVR Setup', 'Kabel & Aksesoris Lengkap', 'Garansi Instalasi'],
    price: 'Mulai Rp 500.000',
  },
  {
    icon: <Globe size={40} />,
    title: 'Pembuatan Website',
    category: 'Digital',
    desc: 'Desain dan pengembangan website profesional yang responsif, cepat, dan SEO-friendly untuk meningkatkan eksistensi bisnis Anda secara online.',
    features: ['Website Company Profile', 'Landing Page', 'Website Toko Online', 'Sistem Informasi Custom', 'Domain & Hosting', 'Maintenance Berkala'],
    price: 'Mulai Rp 1.500.000',
  },
  {
    icon: <Wrench size={40} />,
    title: 'Maintenance IT',
    category: 'Maintenance',
    desc: 'Layanan perawatan rutin perangkat komputer dan infrastruktur jaringan untuk memastikan sistem IT Anda selalu berjalan optimal dan bebas masalah.',
    features: ['Perawatan PC Berkala', 'Update Software & Antivirus', 'Backup Data Rutin', 'Monitoring Jaringan', 'Penanganan Masalah Cepat', 'Laporan Bulanan'],
    price: 'Mulai Rp 300.000/bulan',
  },
  {
    icon: <Headphones size={40} />,
    title: 'Konsultasi IT',
    category: 'Consulting',
    desc: 'Dapatkan saran dan rekomendasi ahli untuk kebutuhan infrastruktur IT bisnis Anda. Kami membantu Anda membuat keputusan teknologi yang tepat.',
    features: ['Analisis Kebutuhan IT', 'Perencanaan Infrastruktur', 'Rekomendasi Perangkat', 'Audit Keamanan Jaringan', 'Optimasi Sistem', 'Pendampingan Proyek IT'],
    price: 'GRATIS Konsultasi',
  },
];

const categories = ['Semua', 'Hardware', 'Network', 'Security', 'Digital', 'Maintenance', 'Consulting'];

export default function LayananKami() {
  const [active, setActive] = useState('Semua');
  const filtered = active === 'Semua' ? services : services.filter(s => s.category === active);

  useEffect(() => {
    document.title = 'Layanan Kami | IT Support Jabodetabek';
    const observer = new IntersectionObserver(
      entries => entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); }),
      { threshold: 0.1 }
    );
    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
    return () => observer.disconnect();
  }, [filtered]);

  return (
    <main>
      <div className="page-hero">
        <div className="container">
          <div className="badge">Layanan Kami</div>
          <h1>Solusi IT Lengkap untuk Anda</h1>
          <p>Semua kebutuhan IT Anda kami tangani dengan profesional, cepat, dan bergaransi.</p>
        </div>
      </div>

      <section className="section">
        <div className="container">
          {/* Filter */}
          <div className="filter-bar reveal">
            {categories.map(cat => (
              <button
                key={cat}
                className={`filter-btn ${active === cat ? 'active' : ''}`}
                onClick={() => setActive(cat)}
              >
                {cat}
              </button>
            ))}
          </div>

          {/* Services Grid */}
          <div className="layanan-grid">
            {filtered.map(({ icon, title, desc, features, price }) => (
              <div className="layanan-card reveal" key={title}>
                <div className="layanan-card-header">
                  <div className="layanan-icon">{icon}</div>
                  <div className="layanan-price">{price}</div>
                </div>
                <h3>{title}</h3>
                <p>{desc}</p>
                <ul className="layanan-features">
                  {features.map(f => (
                    <li key={f}><CheckCircle size={16} className="feat-check" />{f}</li>
                  ))}
                </ul>
                <a
                  href="https://wa.me/6281210874692"
                  target="_blank" rel="noreferrer"
                  className="btn btn-primary layanan-cta"
                >
                  Konsultasi Gratis <ChevronRight size={18} />
                </a>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Process */}
      <section className="section process-section">
        <div className="container">
          <div className="section-header reveal">
            <div className="badge">Cara Kerja</div>
            <h2>Proses Layanan Kami yang Mudah</h2>
          </div>
          <div className="process-grid">
            {[
              { num: '01', title: 'Hubungi Kami', desc: 'Hubungi kami melalui WhatsApp, telepon, atau email untuk konsultasi kebutuhan Anda.' },
              { num: '02', title: 'Analisis & Penawaran', desc: 'Tim kami akan menganalisis kebutuhan dan memberikan penawaran harga yang transparan.' },
              { num: '03', title: 'Pengerjaan', desc: 'Teknisi kami mengerjakan proyek dengan standar kualitas tinggi dan tepat waktu.' },
              { num: '04', title: 'Garansi & Support', desc: 'Pekerjaan selesai disertai garansi dan dukungan purna jual yang responsif.' },
            ].map(({ num, title, desc }) => (
              <div className="process-step reveal" key={num}>
                <div className="process-num">{num}</div>
                <h4>{title}</h4>
                <p>{desc}</p>
              </div>
            ))}
          </div>
        </div>
      </section>
    </main>
  );
}
