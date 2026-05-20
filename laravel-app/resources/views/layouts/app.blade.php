<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'IT Support Jabodetabek')</title>
    
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
