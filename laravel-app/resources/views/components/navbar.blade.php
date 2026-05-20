<div class="topbar">
    <div class="container topbar-inner">
        <div class="topbar-contact">
            <a href="tel:081210874692" class="topbar-link">
                <i data-lucide="phone" style="width:14px; height:14px"></i> <span>WA / Call: 081210874692</span>
            </a>
            <a href="mailto:cs@itsupport-jabodetabek.com" class="topbar-link">
                <i data-lucide="mail" style="width:14px; height:14px"></i> <span>cs@itsupport-jabodetabek.com</span>
            </a>
        </div>
        <a href="https://wa.me/6281210874692" target="_blank" rel="noreferrer" class="topbar-cta">
            Fast Respon Support &rarr;
        </a>
    </div>
</div>

<nav class="navbar" id="navbar">
    <div class="container navbar-inner">
        <a href="{{ url('/') }}" class="navbar-logo">
            <img src="{{ asset('logo.png') }}" alt="PT ITS Logo" class="logo-img" />
            <div class="logo-text">
                <span class="logo-brand">IT Support</span>
                <span class="logo-sub">Jabodetabek</span>
            </div>
        </a>

        <!-- Desktop Links -->
        <ul class="navbar-links">
            <li><a href="{{ url('/') }}" class="navbar-link {{ request()->is('/') ? 'active' : '' }}">Home</a></li>
            <li><a href="{{ url('/tentang-kami') }}" class="navbar-link {{ request()->is('tentang-kami') ? 'active' : '' }}">Tentang Kami</a></li>
            <li><a href="{{ url('/layanan-kami') }}" class="navbar-link {{ request()->is('layanan-kami') ? 'active' : '' }}">Layanan Kami</a></li>
            <li><a href="{{ url('/informasi') }}" class="navbar-link {{ request()->is('informasi') ? 'active' : '' }}">Informasi</a></li>
            <li><a href="{{ url('/klien-kami') }}" class="navbar-link {{ request()->is('klien-kami') ? 'active' : '' }}">Klien Kami</a></li>
        </ul>

        <!-- CTA Desktop -->
        <a href="https://wa.me/6281210874692" target="_blank" rel="noreferrer" class="btn btn-accent navbar-cta">
            Hubungi Sekarang
        </a>

        <!-- Hamburger -->
        <button class="hamburger" id="hamburger-btn" aria-label="Toggle menu">
            <i data-lucide="menu"></i>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobile-menu">
        <ul>
            <li><a href="{{ url('/') }}" class="mobile-link {{ request()->is('/') ? 'active' : '' }}">Home</a></li>
            <li><a href="{{ url('/tentang-kami') }}" class="mobile-link {{ request()->is('tentang-kami') ? 'active' : '' }}">Tentang Kami</a></li>
            <li><a href="{{ url('/layanan-kami') }}" class="mobile-link {{ request()->is('layanan-kami') ? 'active' : '' }}">Layanan Kami</a></li>
            <li><a href="{{ url('/informasi') }}" class="mobile-link {{ request()->is('informasi') ? 'active' : '' }}">Informasi</a></li>
            <li><a href="{{ url('/klien-kami') }}" class="mobile-link {{ request()->is('klien-kami') ? 'active' : '' }}">Klien Kami</a></li>
        </ul>
        <a href="https://wa.me/6281210874692" target="_blank" rel="noreferrer" class="btn btn-accent" style="margin: 16px 24px; display: flex; justify-content: center;">
            Hubungi Sekarang
        </a>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.add('navbar-scrolled');
            } else {
                navbar.classList.remove('navbar-scrolled');
            }
        });

        const hamburgerBtn = document.getElementById('hamburger-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        let menuOpen = false;

        hamburgerBtn.addEventListener('click', () => {
            menuOpen = !menuOpen;
            if (menuOpen) {
                mobileMenu.classList.add('open');
                hamburgerBtn.innerHTML = '<i data-lucide="x"></i>';
            } else {
                mobileMenu.classList.remove('open');
                hamburgerBtn.innerHTML = '<i data-lucide="menu"></i>';
            }
            lucide.createIcons();
        });
    });
</script>
