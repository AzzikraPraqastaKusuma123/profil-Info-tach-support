import { useEffect, useState } from 'react';
import { Calendar, User, Tag, ArrowRight, Search } from 'lucide-react';
import './Informasi.css';

const articles = [
  {
    id: 1, category: 'Tips IT',
    title: '10 Tips Menjaga Laptop Agar Awet dan Tidak Cepat Rusak',
    excerpt: 'Laptop adalah investasi penting yang perlu dijaga dengan baik. Berikut 10 tips praktis yang bisa Anda terapkan untuk memperpanjang usia laptop Anda.',
    date: '12 Mei 2025', author: 'Tim IT Support', readTime: '5 menit',
  },
  {
    id: 2, category: 'Keamanan',
    title: 'Pentingnya CCTV untuk Keamanan Bisnis Anda di Era Modern',
    excerpt: 'Dengan meningkatnya angka kejahatan, sistem keamanan CCTV bukan lagi sekadar pilihan, melainkan kebutuhan pokok bagi setiap bisnis.',
    date: '5 Mei 2025', author: 'Tim IT Support', readTime: '4 menit',
  },
  {
    id: 3, category: 'Jaringan',
    title: 'Perbedaan WiFi 2.4GHz vs 5GHz: Mana yang Tepat untuk Anda?',
    excerpt: 'Bingung memilih frekuensi WiFi yang tepat? Artikel ini menjelaskan perbedaan, kelebihan, dan kekurangan masing-masing frekuensi secara mudah dipahami.',
    date: '28 Apr 2025', author: 'Tim IT Support', readTime: '6 menit',
  },
  {
    id: 4, category: 'Website',
    title: 'Mengapa Bisnis UMKM Wajib Punya Website di Tahun 2025?',
    excerpt: 'Di era digital ini, website bukan lagi kemewahan. Temukan alasan mengapa UMKM Anda harus segera go online dan bagaimana cara memulainya.',
    date: '20 Apr 2025', author: 'Tim IT Support', readTime: '7 menit',
  },
  {
    id: 5, category: 'Tips IT',
    title: 'Cara Mudah Mempercepat Komputer Windows yang Lemot',
    excerpt: 'Komputer Anda terasa lambat dan membuat frustasi? Ikuti langkah-langkah mudah ini untuk meningkatkan performa PC Anda secara signifikan.',
    date: '15 Apr 2025', author: 'Tim IT Support', readTime: '5 menit',
  },
  {
    id: 6, category: 'Keamanan',
    title: 'Waspada Virus & Malware: Panduan Lengkap Proteksi Komputer',
    excerpt: 'Serangan siber semakin canggih. Pelajari cara melindungi perangkat Anda dari berbagai ancaman digital yang mengintai setiap saat.',
    date: '8 Apr 2025', author: 'Tim IT Support', readTime: '8 menit',
  },
];

const categories = ['Semua', 'Tips IT', 'Keamanan', 'Jaringan', 'Website'];
const categoryColors = {
  'Tips IT': '#3b82f6', 'Keamanan': '#ef4444', 'Jaringan': '#10b981', 'Website': '#8b5cf6',
};

export default function Informasi() {
  const [active, setActive] = useState('Semua');
  const [search, setSearch] = useState('');

  const filtered = articles.filter(a =>
    (active === 'Semua' || a.category === active) &&
    (a.title.toLowerCase().includes(search.toLowerCase()) || a.excerpt.toLowerCase().includes(search.toLowerCase()))
  );

  useEffect(() => {
    document.title = 'Informasi | IT Support Jabodetabek';
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
          <div className="badge">Informasi & Tips IT</div>
          <h1>Artikel & Berita Terbaru</h1>
          <p>Update informasi, tips, dan panduan seputar teknologi IT untuk Anda.</p>
        </div>
      </div>

      <section className="section">
        <div className="container">
          {/* Search & Filter */}
          <div className="info-toolbar reveal">
            <div className="search-box">
              <Search size={18} className="search-icon" />
              <input
                type="text"
                placeholder="Cari artikel..."
                value={search}
                onChange={e => setSearch(e.target.value)}
              />
            </div>
            <div className="filter-bar" style={{ justifyContent: 'flex-start', marginBottom: 0 }}>
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
          </div>

          {/* Articles */}
          {filtered.length === 0 ? (
            <div className="empty-state reveal">
              <p>Tidak ada artikel yang ditemukan.</p>
            </div>
          ) : (
            <div className="articles-grid">
              {filtered.map((article, i) => (
                <div className={`article-card reveal ${i === 0 && active === 'Semua' ? 'featured' : ''}`} key={article.id}>
                  <div className="article-img" style={{ background: `linear-gradient(135deg, ${categoryColors[article.category] || '#3b82f6'}22, ${categoryColors[article.category] || '#3b82f6'}44)` }}>
                    <Tag size={40} style={{ color: categoryColors[article.category] || '#3b82f6', opacity: .5 }} />
                  </div>
                  <div className="article-body">
                    <span className="article-cat" style={{ color: categoryColors[article.category] || '#3b82f6' }}>
                      {article.category}
                    </span>
                    <h3>{article.title}</h3>
                    <p>{article.excerpt}</p>
                    <div className="article-meta">
                      <span><Calendar size={14} /> {article.date}</span>
                      <span><User size={14} /> {article.author}</span>
                      <span>⏱ {article.readTime}</span>
                    </div>
                    <button className="article-read-more">
                      Baca Selengkapnya <ArrowRight size={16} />
                    </button>
                  </div>
                </div>
              ))}
            </div>
          )}
        </div>
      </section>
    </main>
  );
}
