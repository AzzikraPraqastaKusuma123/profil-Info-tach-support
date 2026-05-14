import { useState, useEffect } from 'react';
import { Link, useLocation } from 'react-router-dom';
import { Menu, X, Monitor, Phone, Mail } from 'lucide-react';
import './Navbar.css';

const navLinks = [
  { to: '/', label: 'Home' },
  { to: '/tentang-kami', label: 'Tentang Kami' },
  { to: '/layanan-kami', label: 'Layanan Kami' },
  { to: '/informasi', label: 'Informasi' },
  { to: '/klien-kami', label: 'Klien Kami' },
];

export default function Navbar() {
  const [scrolled, setScrolled] = useState(false);
  const [menuOpen, setMenuOpen] = useState(false);
  const location = useLocation();

  useEffect(() => {
    const onScroll = () => setScrolled(window.scrollY > 50);
    window.addEventListener('scroll', onScroll);
    return () => window.removeEventListener('scroll', onScroll);
  }, []);

  useEffect(() => { setMenuOpen(false); }, [location.pathname]);

  return (
    <>
      {/* Top Bar */}
      <div className="topbar">
        <div className="container topbar-inner">
          <div className="topbar-contact">
            <a href="tel:081210874692" className="topbar-link">
              <Phone size={14} /> <span>WA / Call: 081210874692</span>
            </a>
            <a href="mailto:cs@itsupport-jabodetabek.com" className="topbar-link">
              <Mail size={14} /> <span>cs@itsupport-jabodetabek.com</span>
            </a>
          </div>
          <a href="https://wa.me/6281210874692" target="_blank" rel="noreferrer" className="topbar-cta">
            Fast Respon Support →
          </a>
        </div>
      </div>

      {/* Main Navbar */}
      <nav className={`navbar ${scrolled ? 'navbar-scrolled' : ''}`}>
        <div className="container navbar-inner">
          {/* Logo */}
          <Link to="/" className="navbar-logo">
            <img src="/logo.png" alt="PT ITS Logo" className="logo-img" />
            <div className="logo-text">
              <span className="logo-brand">IT Support</span>
              <span className="logo-sub">Jabodetabek</span>
            </div>
          </Link>

          {/* Desktop Links */}
          <ul className="navbar-links">
            {navLinks.map(({ to, label }) => (
              <li key={to}>
                <Link
                  to={to}
                  className={`navbar-link ${location.pathname === to ? 'active' : ''}`}
                >
                  {label}
                </Link>
              </li>
            ))}
          </ul>

          {/* CTA Desktop */}
          <a href="https://wa.me/6281210874692" target="_blank" rel="noreferrer" className="btn btn-accent navbar-cta">
            Hubungi Sekarang
          </a>

          {/* Hamburger */}
          <button className="hamburger" onClick={() => setMenuOpen(!menuOpen)} aria-label="Toggle menu">
            {menuOpen ? <X size={24} /> : <Menu size={24} />}
          </button>
        </div>

        {/* Mobile Menu */}
        <div className={`mobile-menu ${menuOpen ? 'open' : ''}`}>
          <ul>
            {navLinks.map(({ to, label }) => (
              <li key={to}>
                <Link
                  to={to}
                  className={`mobile-link ${location.pathname === to ? 'active' : ''}`}
                >
                  {label}
                </Link>
              </li>
            ))}
          </ul>
          <a href="https://wa.me/6281210874692" target="_blank" rel="noreferrer" className="btn btn-accent" style={{ margin: '16px 24px', display: 'flex', justifyContent: 'center' }}>
            Hubungi Sekarang
          </a>
        </div>
      </nav>

      {/* Spacer */}
      <div style={{ height: menuOpen ? 'auto' : '0' }} />
    </>
  );
}
