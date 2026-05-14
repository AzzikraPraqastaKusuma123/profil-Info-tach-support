import { useEffect } from 'react';
import { Star, Building2, Quote } from 'lucide-react';
import './KlienKami.css';

const clients = [
  { name: 'PT. Toyota Indonesia', logo: '/clients/Toyota.png', industry: 'Manufaktur' },
  { name: 'MNC Group', logo: '/clients/MNC.png', industry: 'Media & Telekomunikasi' },
  { name: 'PT. PLN (Persero)', logo: '/clients/PLN.png', industry: 'Energi' },
  { name: 'PT. Pertamina', logo: '/clients/pertamina.png', industry: 'Energi' },
  { name: 'PT. Epson Indonesia', logo: '/clients/epson.png', industry: 'Teknologi' },
  { name: 'PT. Yamaha Indonesia', logo: '/clients/yamaha.png', industry: 'Otomotif' },
  { name: 'PT. Pos Indonesia', logo: '/clients/pos.png', industry: 'Logistik' },
  { name: 'PT. INKA (Persero)', logo: '/clients/inka.png', industry: 'Manufaktur' },
  { name: 'Telkom Indonesia', logo: '/clients/telkom.png', industry: 'Telekomunikasi' },
  { name: 'Siloam Hospitals', logo: '/clients/siloam.png', industry: 'Kesehatan' },
  { name: 'WIKA', logo: '/clients/wika.png', industry: 'Konstruksi' },
  { name: 'Wings Group', logo: '/clients/wings.png', industry: 'FMCG' },
  { name: 'Wyndham Hotels', logo: '/clients/wyndham.png', industry: 'Hospitality' },
  { name: 'Tamansari Hive', logo: '/clients/tamansari.png', industry: 'Properti' },
  { name: 'PT. Pertani', logo: '/clients/Pertani.png', industry: 'Agrikultur' },
  { name: 'DIKA', logo: '/clients/dika.png', industry: 'Konsultan' },
  { name: 'BW', logo: '/clients/BW.png', industry: 'Konsultan' },
  { name: 'Yayasan', logo: '/clients/yayasan.png', industry: 'Pendidikan/Sosial' },
  { name: 'Umroh & Haji', logo: '/clients/umroh.png', industry: 'Travel' },
  { name: 'Mangkuluhur', logo: '/clients/mangkuluhur.png', industry: 'Properti' },
  { name: 'Reka', logo: '/clients/reka.png', industry: 'Desain & Konstruksi' },
  { name: 'Intrama', logo: '/clients/intrama.png', industry: 'Perdagangan' },
  { name: 'Promisco', logo: '/clients/promisco.png', industry: 'Retail' },
  { name: 'Adi Upaya', logo: '/clients/adi upaya.png', industry: 'Layanan' },
];

const testimonials = [
  {
    name: 'Budi Santoso', company: 'CV. Maju Jaya', role: 'Direktur', rating: 5,
    text: 'IT Support Jabodetabek adalah partner IT terbaik yang pernah kami gunakan. Respons cepat, harga transparan, dan hasil kerja memuaskan. Laptop kantor kami berhasil diperbaiki dalam 2 jam!',
  },
  {
    name: 'Siti Rahayu', company: 'Apotek Sehat Prima', role: 'Pemilik', rating: 5,
    text: 'Pemasangan CCTV di apotek saya dikerjakan dengan sangat rapi dan profesional. Sekarang saya bisa memantau toko dari smartphone kapan saja. Sangat puas!',
  },
  {
    name: 'Ahmad Fauzi', company: 'PT. Berkah Abadi', role: 'IT Manager', rating: 5,
    text: 'Sudah 3 tahun kami mempercayakan maintenance IT kantor ke IT Support Jabodetabek. Jaringan kami selalu stabil dan masalah diselesaikan dengan cepat. Highly recommended!',
  },
  {
    name: 'Dewi Anggraini', company: 'Klinik Sehat Bersama', role: 'Kepala Admin', rating: 5,
    text: 'Website klinik kami dibuat dengan sangat profesional dan sesuai ekspektasi. Bahkan setelah selesai, tim mereka masih siap membantu jika ada kendala. Luar biasa!',
  },
  {
    name: 'Hendra Kusuma', company: 'Toko Elektronik Mega', role: 'Manajer', rating: 5,
    text: 'Instalasi jaringan WiFi untuk toko kami lancar dan hasilnya sangat bagus. Sinyal kuat merata di seluruh area toko. Tim kerjanya juga sangat ramah dan bersih.',
  },
  {
    name: 'Rina Marlina', company: 'UD. Karya Mandiri', role: 'Owner', rating: 5,
    text: 'Konsultasi IT gratis yang mereka tawarkan sangat membantu kami menentukan kebutuhan infrastruktur IT yang tepat sesuai budget. Profesional dan tidak ada biaya tersembunyi.',
  },
];

const colors = ['#3b82f6', '#8b5cf6', '#10b981', '#f59e0b', '#ef4444', '#06b6d4'];

export default function KlienKami() {
  useEffect(() => {
    document.title = 'Klien Kami | IT Support Jabodetabek';
    const observer = new IntersectionObserver(
      entries => entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); }),
      { threshold: 0.1 }
    );
    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
    return () => observer.disconnect();
  }, []);

  return (
    <main>
      <div className="page-hero">
        <div className="container">
          <div className="badge">Klien Kami</div>
          <h1>Dipercaya oleh Banyak Bisnis & UMKM</h1>
          <p>Lebih dari 500 bisnis dan UMKM di Jabodetabek telah mempercayakan kebutuhan IT mereka kepada kami.</p>
        </div>
      </div>

      {/* Client Logos */}
      <section className="section">
        <div className="container">
          <div className="section-header reveal">
            <div className="badge">Mitra Bisnis Kami</div>
            <h2>Klien yang Telah Kami Layani</h2>
            <p>Dari UMKM hingga perusahaan menengah, kami hadir untuk semua.</p>
          </div>
          <div className="clients-grid">
            {clients.map(({ name, logo, industry }) => (
              <div className="client-card reveal" key={name}>
                <div className="client-logo-img">
                  <img src={logo} alt={`Logo ${name}`} />
                </div>
                <div className="client-info">
                  <h4>{name}</h4>
                  <div className="client-industry"><Building2 size={12} />{industry}</div>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Testimonials */}
      <section className="section testi-full-section">
        <div className="container">
          <div className="section-header reveal">
            <div className="badge">Testimoni</div>
            <h2>Apa Kata Mereka tentang Kami?</h2>
            <p>Kepercayaan dan kepuasan klien adalah bukti nyata kualitas layanan kami.</p>
          </div>
          <div className="testi-full-grid">
            {testimonials.map(({ name, company, role, rating, text }) => (
              <div className="testi-full-card reveal" key={name}>
                <Quote size={32} className="quote-icon" />
                <p className="testi-full-text">{text}</p>
                <div className="testi-full-stars">
                  {Array.from({ length: rating }).map((_, i) => (
                    <Star key={i} size={16} fill="#f59e0b" color="#f59e0b" />
                  ))}
                </div>
                <div className="testi-full-author">
                  <div className="testi-full-avatar">{name[0]}</div>
                  <div>
                    <div className="testi-full-name">{name}</div>
                    <div className="testi-full-meta">{role} · {company}</div>
                  </div>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* CTA */}
      <section className="klien-cta">
        <div className="container klien-cta-inner reveal">
          <h2>Bergabunglah dengan 500+ Klien Puas Kami</h2>
          <p>Hubungi kami sekarang dan jadilah bagian dari keluarga besar IT Support Jabodetabek.</p>
          <a href="https://wa.me/6281210874692" target="_blank" rel="noreferrer" className="btn btn-accent">
            Mulai Konsultasi Gratis
          </a>
        </div>
      </section>
    </main>
  );
}
