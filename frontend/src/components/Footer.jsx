import { Link } from 'react-router-dom';
import { Phone, Mail, MapPin, Share2, MessageCircle, Briefcase, ChevronRight } from 'lucide-react';
import './Footer.css';

const services = [
  'Service Laptop & PC', 'Instalasi Jaringan', 'Pasang CCTV',
  'Pembuatan Website', 'Maintenance Komputer', 'Konsultasi IT',
];

export default function Footer() {
  return (
    <footer className="footer">
      <div className="footer-top">
        <div className="container footer-grid">
          {/* Brand */}
          <div className="footer-brand">
            <div className="footer-logo">
              <img src="/logo.png" alt="IT Support Jabodetabek Logo" className="footer-logo-img" />
              <div>
                <div className="footer-logo-name">IT Support</div>
                <div className="footer-logo-sub">Jabodetabek</div>
              </div>
            </div>
            <p className="footer-desc">
              Solusi IT terpercaya untuk bisnis dan UMKM di area Jabodetabek.
              Kami hadir dengan layanan profesional, cepat, dan berkualitas.
            </p>
            <div className="footer-socials">
              <a href="#" className="social-btn" aria-label="Facebook"><Share2 size={18} /></a>
              <a href="#" className="social-btn" aria-label="Instagram"><MessageCircle size={18} /></a>
              <a href="#" className="social-btn" aria-label="LinkedIn"><Briefcase size={18} /></a>
            </div>
          </div>

          {/* Links */}
          <div className="footer-col">
            <h4 className="footer-heading">Halaman</h4>
            <ul className="footer-links">
              {[
                { to: '/', label: 'Home' },
                { to: '/tentang-kami', label: 'Tentang Kami' },
                { to: '/layanan-kami', label: 'Layanan Kami' },
                { to: '/informasi', label: 'Informasi' },
                { to: '/klien-kami', label: 'Klien Kami' },
              ].map(({ to, label }) => (
                <li key={to}>
                  <Link to={to} className="footer-link">
                    <ChevronRight size={14} /> {label}
                  </Link>
                </li>
              ))}
            </ul>
          </div>

          {/* Services */}
          <div className="footer-col">
            <h4 className="footer-heading">Layanan Kami</h4>
            <ul className="footer-links">
              {services.map(s => (
                <li key={s}>
                  <Link to="/layanan-kami" className="footer-link">
                    <ChevronRight size={14} /> {s}
                  </Link>
                </li>
              ))}
            </ul>
          </div>

          {/* Contact */}
          <div className="footer-col">
            <h4 className="footer-heading">Kontak Kami</h4>
            <ul className="footer-contact-list">
              <li>
                <MapPin size={16} className="footer-contact-icon" />
                <span>Jatiasih Jatisari, Bekasi Selatan 17426</span>
              </li>
              <li>
                <Phone size={16} className="footer-contact-icon" />
                <a href="tel:081210874692">081210874692</a>
              </li>
              <li>
                <Mail size={16} className="footer-contact-icon" />
                <a href="mailto:cs@itsupport-jabodetabek.com">cs@itsupport-jabodetabek.com</a>
              </li>
            </ul>
            <a
              href="https://wa.me/6281210874692"
              target="_blank" rel="noreferrer"
              className="footer-wa-btn"
            >
              Chat WhatsApp Sekarang
            </a>
          </div>
        </div>
      </div>

      <div className="footer-bottom">
        <div className="container footer-bottom-inner">
          <p>© {new Date().getFullYear()} IT Support Jabodetabek. All rights reserved.</p>
          <p>Jatiasih Jatisari Bekasi Selatan 17426</p>
        </div>
      </div>
    </footer>
  );
}
