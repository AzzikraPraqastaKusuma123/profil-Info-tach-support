import { useEffect } from 'react';
import { Target, Eye, Heart, Users, Award, Clock } from 'lucide-react';
import './TentangKami.css';

const values = [
  { icon: <Award size={28} />, title: 'Profesionalisme', desc: 'Kami selalu mengutamakan standar kerja tertinggi di setiap proyek yang kami tangani.' },
  { icon: <Heart size={28} />, title: 'Dedikasi', desc: 'Kepuasan klien adalah prioritas utama kami. Kami bekerja sepenuh hati untuk hasil terbaik.' },
  { icon: <Users size={28} />, title: 'Kolaborasi', desc: 'Kami percaya bahwa kemitraan yang baik menghasilkan solusi yang lebih inovatif dan efektif.' },
  { icon: <Clock size={28} />, title: 'Ketepatan Waktu', desc: 'Setiap komitmen dijaga dengan menyelesaikan pekerjaan sesuai tenggat waktu yang disepakati.' },
];

const team = [
  { name: 'Ahmad Rizki', role: 'Lead Technician', initials: 'AR' },
  { name: 'Budi Hartono', role: 'Network Engineer', initials: 'BH' },
  { name: 'Citra Dewi', role: 'Web Developer', initials: 'CD' },
  { name: 'Dian Pratama', role: 'CCTV Specialist', initials: 'DP' },
];

export default function TentangKami() {
  useEffect(() => {
    document.title = 'Tentang Kami | IT Support Jabodetabek';
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
          <div className="badge">Tentang Kami</div>
          <h1>Mengenal IT Support Jabodetabek</h1>
          <p>Mitra IT terpercaya Anda selama lebih dari 7 tahun</p>
        </div>
      </div>

      {/* About Content */}
      <section className="section">
        <div className="container">
          <div className="about-grid">
            <div className="about-image-col reveal">
              <div className="about-image-wrapper">
                <div className="about-img-placeholder">
                  <Users size={80} className="about-placeholder-icon" />
                  <span>Tim Profesional Kami</span>
                </div>
                <div className="about-badge-exp">
                  <span className="exp-num">7+</span>
                  <span className="exp-txt">Tahun Pengalaman</span>
                </div>
              </div>
            </div>
            <div className="about-text-col reveal">
              <div className="badge">Siapa Kami</div>
              <h2>IT Support Jabodetabek</h2>
              <div className="divider divider-left divider-blue" />
              <p>
                IT Support Jabodetabek adalah perusahaan penyedia layanan IT profesional yang berdiri sejak
                2017 dan telah melayani ratusan klien dari berbagai segmen — mulai dari individu, UMKM,
                hingga perusahaan skala menengah di area Jabodetabek.
              </p>
              <p style={{ marginTop: '16px' }}>
                Dengan tim teknisi berpengalaman dan bersertifikat, kami berkomitmen untuk memberikan solusi
                IT yang tepat, cepat, dan bergaransi. Kepercayaan klien adalah aset terbesar yang kami jaga.
              </p>
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

      {/* Vision & Mission */}
      <section className="section vm-section">
        <div className="container">
          <div className="section-header reveal">
            <div className="badge">Visi & Misi</div>
            <h2>Arah dan Tujuan Kami</h2>
          </div>
          <div className="vm-grid">
            <div className="vm-card vm-vision reveal">
              <div className="vm-icon"><Eye size={36} /></div>
              <h3>Visi</h3>
              <p>
                Menjadi perusahaan IT Support terdepan dan terpercaya di Indonesia yang memberikan
                solusi teknologi inovatif untuk mendorong pertumbuhan bisnis klien kami.
              </p>
            </div>
            <div className="vm-card vm-mission reveal">
              <div className="vm-icon"><Target size={36} /></div>
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

      {/* Values */}
      <section className="section">
        <div className="container">
          <div className="section-header reveal">
            <div className="badge">Nilai-Nilai Kami</div>
            <h2>Prinsip yang Menjadi Landasan Kami</h2>
          </div>
          <div className="grid-4">
            {values.map(({ icon, title, desc }) => (
              <div className="value-card reveal" key={title}>
                <div className="value-icon">{icon}</div>
                <h4>{title}</h4>
                <p>{desc}</p>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Team */}
      <section className="section team-section">
        <div className="container">
          <div className="section-header reveal">
            <div className="badge">Tim Kami</div>
            <h2>Bertemu dengan Tim Profesional Kami</h2>
            <p>Para ahli berpengalaman yang siap membantu Anda 24/7.</p>
          </div>
          <div className="team-grid">
            {team.map(({ name, role, initials }) => (
              <div className="team-card reveal" key={name}>
                <div className="team-avatar">{initials}</div>
                <h4>{name}</h4>
                <p>{role}</p>
              </div>
            ))}
          </div>
        </div>
      </section>
    </main>
  );
}
