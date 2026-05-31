<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Jasa IT Support Jabodetabek | Maintenance Komputer, Server, CCTV & Jaringan Kantor')</title>
    
    <!-- Favicon / Browser Tab Logo -->
    <link rel="shortcut icon" href="{{ asset('logo.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('logo.png') }}" type="image/png">
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="PT Info Tech Support Jabodetabek menyediakan jasa IT Support profesional untuk perusahaan di Jakarta, Bekasi, Bogor, Depok dan Tangerang. Layanan maintenance komputer, server, jaringan, CCTV, Mikrotik, helpdesk dan outsourcing IT.">
    <meta name="keywords" content="IT Support Jakarta, IT Support Bekasi, IT Support Bogor, IT Support Depok, IT Support Tangerang, Maintenance Komputer, Jasa IT Support, Outsourcing IT Support, Maintenance Server, Jasa Mikrotik, Instalasi CCTV">
    <link rel="canonical" href="@yield('canonical', 'https://itsupport-jabodetabek.com/')">
    
    <!-- Lucide Icons via CDN for standard use if needed, but we'll use SVG directly where possible -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Global CSS -->
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/WhatsAppButton.css') }}">
    
    <!-- Page Specific CSS -->
    @yield('styles')
</head>
<body>
    @include('components.navbar')

    <div class="main-content">
        @yield('content')
    </div>

    @include('components.footer')
    @include('components.whatsapp-button')

    <!-- Lucide Icon initialization -->
    <script>
        lucide.createIcons();
    </script>
    @yield('scripts')
</body>
</html>
