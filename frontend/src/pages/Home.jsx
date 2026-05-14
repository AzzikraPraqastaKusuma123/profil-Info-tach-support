import { useEffect, useRef, useState } from 'react';
import { Link } from 'react-router-dom';
import {
  Laptop, Network, ShieldCheck, Code2, Settings2, Lightbulb,
  CheckCircle, ArrowRight, Star, Clock, Shield, Zap, MapPin, ExternalLink,
  Phone, Mail, Send
} from 'lucide-react';
import './Home.css';

const services = [
  {
    num: '01', icon: <Laptop size={28} />, tag: 'Hardware',
    title: 'Service Laptop & PC',
    desc: 'Perbaikan hardware & software laptop dan PC semua merk dengan penanganan cepat, bergaransi, dan transparan.',
    img: '/services/laptop-pc.png',
    color: '#3b82f6',
  },
  {
    num: '02', icon: <Network size={28} />, tag: 'Network',
    title: 'Instalasi Jaringan',
    desc: 'Pemasangan & konfigurasi jaringan LAN/WiFi enterprise untuk kantor, gedung, dan rumah Anda.',
    img: '/services/jaringan.png',
    color: '#06b6d4',
  },
  {
    num: '03', icon: <ShieldCheck size={28} />, tag: 'Security',
    title: 'Pasang CCTV',
    desc: 'Instalasi kamera CCTV resolusi tinggi untuk keamanan bisnis, kantor, dan hunian Anda 24 jam.',
    img: '/services/cctv.png',
    color: '#8b5cf6',
  },
  {
    num: '04', icon: <Code2 size={28} />, tag: 'Digital',
    title: 'Pembuatan Website',
    desc: 'Desain & pengembangan website profesional, responsif, dan SEO-friendly untuk bisnis Anda.',
    img: '/services/website.png',
    color: '#10b981',
  },
  {
    num: '05', icon: <Settings2 size={28} />, tag: 'Maintenance',
    title: 'Maintenance IT',
    desc: 'Perawatan rutin perangkat komputer & infrastruktur jaringan agar selalu dalam performa optimal.',
    img: '/services/maintenance.png',
    color: '#f59e0b',
  },
  {
    num: '06', icon: <Lightbulb size={28} />, tag: 'Consulting',
    title: 'Konsultasi IT',
    desc: 'Dapatkan saran dan rekomendasi ahli untuk kebutuhan infrastruktur IT dan digitalisasi bisnis Anda.',
    img: '/services/konsultasi.png',
    color: '#ef4444',
  },
];

const stats = [
  { number: '500+', label: 'Klien Puas' },
  { number: '7+', label: 'Tahun Pengalaman' },
  { number: '98%', label: 'Kepuasan Klien' },
  { number: '24/7', label: 'Support Tersedia' },
];

const whyUs = [
  { icon: <Zap size={24} />, title: 'Fast Response', desc: 'Kami merespons setiap permintaan dalam waktu kurang dari 1 jam.' },
  { icon: <Shield size={24} />, title: 'Bergaransi', desc: 'Semua layanan kami dilengkapi dengan garansi kepuasan pelanggan.' },
  { icon: <Star size={24} />, title: 'Berpengalaman', desc: 'Tim teknisi berpengalaman lebih dari 7 tahun di bidang IT.' },
  { icon: <Clock size={24} />, title: 'Tepat Waktu', desc: 'Komitmen kami adalah menyelesaikan pekerjaan sesuai waktu yang dijanjikan.' },
];

const testimonials = [
  { name: 'Budi Santoso', company: 'CV. Maju Jaya', rating: 5, text: 'Pelayanan sangat cepat dan profesional. Laptop saya yang rusak berhasil diperbaiki dalam 2 jam. Sangat rekomendasikan!' },
  { name: 'Siti Rahayu', company: 'Toko Online Siti', rating: 5, text: 'Instalasi CCTV di toko saya dikerjakan dengan rapi dan bersih. Harga terjangkau, kualitas premium. Terima kasih IT Support!' },
  { name: 'Ahmad Fauzi', company: 'PT. Berkah Abadi', rating: 5, text: 'Kami sudah menggunakan jasa IT Support Jabodetabek untuk maintenance kantor selama 3 tahun. Sangat puas dengan pelayanannya.' },
];

const clientLogos = [
  "Wika Realty", "Epson", "Toyota Indonesia", "Pos Indonesia",
  "Telkom Indonesia", "Yamaha", "Pertamina", "PLN", "Siloam Hospitals",
  "MNC Group", "INKA", "Wyndham", "Tamansari Hive"
];

const contactInfo = [
  { icon: <Phone size={22} />, title: 'Telepon / WhatsApp', value: '081210874692', link: 'tel:081210874692', label: 'Hubungi Sekarang' },
  { icon: <Mail size={22} />, title: 'Email', value: 'cs@itsupport-jabodetabek.com', link: 'mailto:cs@itsupport-jabodetabek.com', label: 'Kirim Email' },
  { icon: <MapPin size={22} />, title: 'Alamat', value: 'Jatiasih Jatisari, Bekasi Selatan 17426', link: 'https://www.google.com/maps/place/IT+Support+Jabodetabek', label: 'Lihat di Maps' },
  { icon: <Clock size={22} />, title: 'Jam Operasional', value: 'Senin – Sabtu: 08.00 – 20.00\nMinggu: 09.00 – 17.00', link: null, label: null },
];

export default function Home() {
  const statsRef = useRef(null);
  const [currentHeroImage, setCurrentHeroImage] = useState(0);
  const [currentBgImage, setCurrentBgImage] = useState(0);
  const [form, setForm] = useState({ name: '', email: '', phone: '', subject: '', message: '' });
  const [sent, setSent] = useState(false);
  const [loading, setLoading] = useState(false);

  const handleChange = e => setForm({ ...form, [e.target.name]: e.target.value });
  const handleSubmit = async e => {
    e.preventDefault();
    setLoading(true);
    await new Promise(r => setTimeout(r, 1500));
    setSent(true);
    setLoading(false);
  };

  const heroPhotos = [
    '/home-page/1.png',
    '/home-page/2.png',
    '/home-page/3.png',
    '/home-page/4.png',
    '/home-page/5.png',
    '/home-page/6.png'
  ];

  const bgPhotos = [
    '/background/1.png',
    '/background/2.png',
    '/background/3.png',
    '/background/4.png'
  ];

  useEffect(() => {
    const slideTimer = setInterval(() => {
      setCurrentHeroImage((prev) => (prev + 1) % heroPhotos.length);
    }, 3500);
    
    const bgTimer = setInterval(() => {
      setCurrentBgImage((prev) => (prev + 1) % bgPhotos.length);
    }, 5000); // Ganti background setiap 5 detik

    return () => {
      clearInterval(slideTimer);
      clearInterval(bgTimer);
    };
  }, []);

  useEffect(() => {
    document.title = 'IT Support Jabodetabek | Solusi IT Profesional';
    const observer = new IntersectionObserver(
      entries => entries.forEach(e => {
        if (e.isIntersecting) e.target.classList.add('visible');
      }),
      { threshold: 0.1 }
    );
    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
    return () => observer.disconnect();
  }, []);

  return (
    <main>
      {/* ── HERO ── */}
      <section className="hero">
        <div className="hero-bg">
          <div className="hero-bg-slideshow">
            {bgPhotos.map((photo, index) => (
              <img 
                key={photo}
                src={photo} 
                alt="IT Background"
                className={`hero-bg-img ${index === currentBgImage ? 'active' : ''}`}
              />
            ))}
            <div className="hero-bg-overlay"></div>
          </div>
          <div className="hero-orb hero-orb-1" />
          <div className="hero-orb hero-orb-2" />
          <div className="hero-grid" />
        </div>
        <div className="container hero-content">
          <div className="hero-text">
            <div className="badge">🚀 Fast Response IT Support</div>
            <h1 className="hero-title">
              Solusi IT <span className="gradient-text">Profesional</span><br />
              Untuk Bisnis Anda
            </h1>
            <p className="hero-desc">
              Kami hadir memberikan layanan IT Support terpercaya untuk bisnis dan UMKM di area
              Jabodetabek. Service laptop, instalasi jaringan, CCTV, hingga pembuatan website
              — semua dalam satu tempat.
            </p>
            <div className="hero-checks">
              {['Garansi Kepuasan', 'Response < 1 Jam', 'Teknisi Berpengalaman'].map(c => (
                <div key={c} className="hero-check"><CheckCircle size={18} className="check-icon" />{c}</div>
              ))}
            </div>
            <div className="hero-actions">
              <a href="https://wa.me/6281210874692" target="_blank" rel="noreferrer" className="btn btn-accent">
                Konsultasi Gratis <ArrowRight size={18} />
              </a>
              <Link to="/layanan-kami" className="btn btn-outline">
                Lihat Layanan
              </Link>
            </div>
          </div>
          <div className="hero-visual animate-float">
            <div className="hero-image-wrapper">
              {heroPhotos.map((photo, index) => (
                <img 
                  key={photo}
                  src={photo} 
                  alt={`Kegiatan IT Support ${index + 1}`} 
                  className={`hero-img-main ${index === currentHeroImage ? 'active' : ''}`} 
                />
              ))}
              <div className="hero-image-overlay"></div>
            </div>
            <div className="hero-badge-1"><CheckCircle size={16} /><span>Bergaransi</span></div>
            <div className="hero-badge-2"><Star size={16} /><span>4.9 Rating</span></div>
            <div className="hero-badge-3"><Zap size={16} /><span>Fast Response</span></div>
          </div>
        </div>
      </section>

      {/* ── STATS ── */}
      <section className="stats-strip" ref={statsRef}>
        <div className="container">
          <div className="stats-grid">
            {stats.map(({ number, label }) => (
              <div className="stat-item" key={label}>
                <div className="stat-number">{number}</div>
                <div className="stat-label">{label}</div>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* ── SERVICES ── */}
      <section className="section svc-section">
        <div className="container">
          <div className="svc-header reveal">
            <div className="svc-header-left">
              <span className="svc-eyebrow">Layanan Kami</span>
              <h2 className="svc-title">Apa yang Kami<br /><span className="gradient-text">Tawarkan?</span></h2>
            </div>
            <div className="svc-header-right">
              <p className="svc-subtitle">Berbagai layanan IT profesional untuk memastikan bisnis Anda berjalan tanpa hambatan teknologi.</p>
              <Link to="/layanan-kami" className="btn btn-primary svc-all-btn">
                Semua Layanan <ArrowRight size={16} />
              </Link>
            </div>
          </div>

          <div className="svc-grid">
            {services.map(({ num, icon, tag, title, desc, img, color }) => (
              <Link to="/layanan-kami" className="svc-card reveal" key={title} style={{ '--svc-color': color }}>
                {/* Image section */}
                <div className="svc-card-image-wrap">
                  <div className="svc-card-bg" style={{ backgroundImage: `url(${img})` }} />
                  <div className="svc-card-overlay" />
                  <div className="svc-card-top">
                    <span className="svc-num">{num}</span>
                    <span className="svc-tag">{tag}</span>
                  </div>
                </div>

                {/* Content section */}
                <div className="svc-card-content">
                  <div className="svc-icon-wrap">
                    <span style={{ color }}>{icon}</span>
                  </div>
                  <h3 className="svc-name">{title}</h3>
                  <p className="svc-desc">{desc}</p>
                  <div className="svc-cta">
                    <span>Pelajari Lebih Lanjut</span>
                    <ArrowRight size={16} />
                  </div>
                </div>
              </Link>
            ))}
          </div>
        </div>
      </section>

      {/* ── WHY US ── */}
      <section className="why-section section">
        <div className="container">
          <div className="why-inner">
            <div className="why-text reveal">
              <div className="badge" style={{ background: 'rgba(245,158,11,.12)', color: '#f59e0b', borderColor: 'rgba(245,158,11,.25)' }}>
                Mengapa Kami?
              </div>
              <h2>Kepercayaan yang Telah Kami Bangun Selama 7+ Tahun</h2>
              <p>
                Kami bukan sekadar penyedia layanan IT. Kami adalah mitra teknologi yang
                berkomitmen untuk mendukung pertumbuhan bisnis Anda dengan solusi yang tepat,
                cepat, dan terpercaya.
              </p>
              <Link to="/tentang-kami" className="btn btn-primary" style={{ marginTop: '24px', display: 'inline-flex' }}>
                Tentang Kami <ArrowRight size={18} />
              </Link>
            </div>
            <div className="why-grid">
              {whyUs.map(({ icon, title, desc }) => (
                <div className="why-card reveal" key={title}>
                  <div className="why-icon">{icon}</div>
                  <h4>{title}</h4>
                  <p>{desc}</p>
                </div>
              ))}
            </div>
          </div>
        </div>
      </section>

      {/* ── CLIENTS MARQUEE ── */}
      <section className="section clients-section">
        <div className="container">
          <div className="section-header reveal" style={{ marginBottom: '48px' }}>
            <div className="badge">Klien Kami</div>
            <h2 style={{ fontSize: '1.8rem' }}>OUR VALUED CLIENTS</h2>
          </div>
        </div>
        <div className="marquee-wrapper reveal">
          <div className="marquee-track">
            <div className="marquee-content">
              {clientLogos.map((client, i) => (
                <div className="client-logo" key={`a-${i}`}>
                  {client}
                </div>
              ))}
            </div>
            <div className="marquee-content" aria-hidden="true">
              {clientLogos.map((client, i) => (
                <div className="client-logo" key={`b-${i}`}>
                  {client}
                </div>
              ))}
            </div>
          </div>
        </div>
      </section>

      {/* ── TESTIMONIALS ── */}
      <section className="section testi-section">
        <div className="container">
          <div className="section-header reveal">
            <div className="badge">Testimoni</div>
            <h2>Apa Kata Klien Kami?</h2>
            <p>Kepercayaan klien adalah prioritas utama kami. Lihat apa yang mereka katakan.</p>
          </div>
          <div className="testi-grid">
            {testimonials.map(({ name, company, rating, text }) => (
              <div className="testi-card reveal" key={name}>
                <div className="testi-stars">
                  {Array.from({ length: rating }).map((_, i) => (
                    <Star key={i} size={16} fill="#f59e0b" color="#f59e0b" />
                  ))}
                </div>
                <p className="testi-text">"{text}"</p>
                <div className="testi-author">
                  <div className="testi-avatar">{name[0]}</div>
                  <div>
                    <div className="testi-name">{name}</div>
                    <div className="testi-company">{company}</div>
                  </div>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* ── MAP ── */}
      <section className="section map-section">
        <div className="container">
          <div className="section-header reveal">
            <div className="badge"><MapPin size={14} /> Lokasi Kami</div>
            <h2>Kunjungi Kantor Kami</h2>
            <p>Kami siap menyambut Anda untuk konsultasi langsung terkait kebutuhan IT bisnis Anda.</p>
          </div>
          <div className="map-container reveal">
            <a 
              href="https://www.google.com/maps/place/IT+Support+Jabodetabek/@-6.3387167,106.9532905,21z/data=!4m14!1m7!3m6!1s0x2e6993a72ff8449d:0x935eaeebbb0be78e!2sIT+Support+Jabodetabek!8m2!3d-6.3387038!4d106.953362!16s%2Fg%2F11h3bgbt5b!3m5!1s0x2e6993a72ff8449d:0x935eaeebbb0be78e!8m2!3d-6.3387038!4d106.953362!16s%2Fg%2F11h3bgbt5b?hl=en&entry=ttu"
              target="_blank"
              rel="noreferrer"
              className="map-link-wrapper"
              title="Buka di Google Maps"
            >
              <iframe
                src="https://maps.google.com/maps?q=-6.3387038,106.953362&hl=id&z=20&output=embed"
                width="100%"
                height="450"
                style={{ border: 0, pointerEvents: 'none' }}
                allowFullScreen=""
                loading="lazy"
                referrerPolicy="no-referrer-when-downgrade"
                title="Lokasi Kantor IT Support Jabodetabek"
              ></iframe>
              <div className="map-overlay-hint">
                <ExternalLink size={24} />
                <span>Buka di Google Maps</span>
              </div>
            </a>
            <div className="map-info">
              <div className="map-info-item">
                <MapPin size={20} className="map-icon" />
                <div>
                  <strong>Alamat Kantor:</strong>
                  <span>Jl.Durian Blok CR 6 Komp.Bumi Dirgantara Permai Jatiasih Jatisari Bekasi Selatan 17426, RT.004/RW.013, Jatisari, Kec. Jatiasih, Kota Bks, Jawa Barat 17426</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* ── HUBUNGI KAMI ── */}
      <section className="home-contact-section">
        <div className="hc-bg-deco">
          <div className="hc-orb hc-orb-1" />
          <div className="hc-orb hc-orb-2" />
          <div className="hero-grid" />
        </div>
        <div className="container">
          <div className="section-header reveal" style={{ marginBottom: '56px' }}>
            <div className="badge" style={{ background: 'rgba(59,130,246,.12)', color: '#60a5fa', borderColor: 'rgba(59,130,246,.25)' }}>Hubungi Kami</div>
            <h2 style={{ color: '#fff' }}>Kami Siap Membantu Anda</h2>
            <p style={{ color: 'rgba(255,255,255,.65)' }}>Jangan ragu menghubungi kami. Tim profesional siap merespons dalam waktu kurang dari 1 jam.</p>
          </div>
          <div className="hc-grid">
            {/* Info Column */}
            <div className="hc-info-col reveal">
              <div className="hc-cards">
                {contactInfo.map(({ icon, title, value, link, label }) => (
                  <div className="hc-card" key={title}>
                    <div className="hc-icon">{icon}</div>
                    <div className="hc-detail">
                      <h4>{title}</h4>
                      <p>{value}</p>
                      {link && <a href={link} target={link.startsWith('http') ? '_blank' : undefined} rel="noreferrer" className="hc-link">{label} →</a>}
                    </div>
                  </div>
                ))}
              </div>
              <a href="https://wa.me/6281210874692?text=Halo%20IT%20Support%20Jabodetabek" target="_blank" rel="noreferrer" className="hc-wa-btn">
                <svg viewBox="0 0 24 24" fill="currentColor" width="26" height="26"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                <div>
                  <span className="hc-wa-title">Chat WhatsApp Langsung</span>
                  <span className="hc-wa-sub">Fast Response · Senin–Sabtu 08.00–20.00</span>
                </div>
              </a>
            </div>
            {/* Form Column */}
            <div className="hc-form-col reveal">
              <div className="hc-form-wrap">
                <h3>Kirim Pesan</h3>
                <p>Isi formulir di bawah ini dan kami akan menghubungi Anda segera.</p>
                {sent ? (
                  <div className="hc-success">
                    <CheckCircle size={52} className="hc-success-icon" />
                    <h4>Pesan Terkirim!</h4>
                    <p>Terima kasih! Kami akan menghubungi Anda kurang dari 1 jam pada jam kerja.</p>
                    <button onClick={() => { setSent(false); setForm({ name:'', email:'', phone:'', subject:'', message:'' }); }} className="btn btn-primary">Kirim Pesan Lagi</button>
                  </div>
                ) : (
                  <form onSubmit={handleSubmit} className="hc-form">
                    <div className="hc-form-row">
                      <div className="hc-form-group">
                        <label htmlFor="hc-name">Nama Lengkap *</label>
                        <input id="hc-name" name="name" type="text" placeholder="Nama Anda" required value={form.name} onChange={handleChange} />
                      </div>
                      <div className="hc-form-group">
                        <label htmlFor="hc-phone">No. Telepon / WA</label>
                        <input id="hc-phone" name="phone" type="tel" placeholder="08xxxxxxxxxx" value={form.phone} onChange={handleChange} />
                      </div>
                    </div>
                    <div className="hc-form-group">
                      <label htmlFor="hc-email">Alamat Email *</label>
                      <input id="hc-email" name="email" type="email" placeholder="email@anda.com" required value={form.email} onChange={handleChange} />
                    </div>
                    <div className="hc-form-group">
                      <label htmlFor="hc-subject">Subjek / Keperluan</label>
                      <select id="hc-subject" name="subject" value={form.subject} onChange={handleChange}>
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
                    <div className="hc-form-group">
                      <label htmlFor="hc-message">Pesan *</label>
                      <textarea id="hc-message" name="message" rows={4} placeholder="Ceritakan kebutuhan IT Anda..." required value={form.message} onChange={handleChange} />
                    </div>
                    <button type="submit" className="btn btn-accent hc-submit" disabled={loading}>
                      {loading ? 'Mengirim...' : <><Send size={18} /> Kirim Pesan</>}
                    </button>
                  </form>
                )}
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
  );
}
