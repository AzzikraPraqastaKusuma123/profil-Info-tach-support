<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - PT. Info Tech Support</title>
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body {
            background: radial-gradient(circle at 10% 20%, var(--navy-950) 0%, var(--navy-900) 90%);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 24px;
            overflow: hidden;
            position: relative;
        }

        /* Abstract glowing blobs for premium feel */
        .blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.15;
            z-index: 0;
        }
        .blob-1 {
            background: var(--blue-400);
            width: 300px;
            height: 300px;
            top: -100px;
            left: -100px;
            animation: float-blob 8s infinite alternate;
        }
        .blob-2 {
            background: var(--accent);
            width: 250px;
            height: 250px;
            bottom: -50px;
            right: -50px;
            animation: float-blob 6s infinite alternate-reverse;
        }

        @keyframes float-blob {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(30px, 20px) scale(1.1); }
        }

        .login-container {
            width: 100%;
            max-width: 440px;
            background: rgba(10, 22, 40, 0.45);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: var(--radius-lg);
            padding: 40px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
            position: relative;
            z-index: 1;
            animation: fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) both;
        }

        .login-header {
            text-align: center;
            margin-bottom: 32px;
        }

        .login-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-bottom: 16px;
        }

        .login-logo-icon {
            background: linear-gradient(135deg, var(--blue-400), var(--navy-500));
            width: 46px;
            height: 46px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        }

        .login-logo-text {
            font-size: 1.45rem;
            font-weight: 800;
            color: var(--white);
            letter-spacing: 0.5px;
        }

        .login-logo-text span {
            color: var(--blue-300);
        }

        .login-title {
            font-size: 0.95rem;
            color: var(--gray-400);
            font-weight: 500;
        }

        .form-group {
            margin-bottom: 24px;
            position: relative;
        }

        .form-label {
            display: block;
            color: var(--gray-200);
            font-size: 0.8rem;
            font-weight: 700;
            margin-bottom: 8px;
            letter-spacing: 0.8px;
            text-transform: uppercase;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-400);
            width: 18px;
            height: 18px;
            transition: var(--transition);
        }

        .form-input {
            width: 100%;
            background: rgba(5, 13, 26, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: var(--radius-sm);
            padding: 14px 14px 14px 44px;
            color: var(--white);
            font-size: 0.95rem;
            font-family: inherit;
            transition: var(--transition);
        }

        .form-input:focus {
            outline: none;
            border-color: var(--blue-400);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
            background: rgba(5, 13, 26, 0.8);
        }

        .form-input:focus + .input-icon {
            color: var(--blue-300);
        }

        .btn-login {
            width: 100%;
            justify-content: center;
            padding: 14px;
            border-radius: var(--radius-sm);
            font-size: 1rem;
            margin-top: 10px;
        }

        .back-link {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            margin-top: 24px;
            color: var(--gray-400);
            font-size: 0.85rem;
            font-weight: 500;
            transition: var(--transition);
        }

        .back-link:hover {
            color: var(--white);
        }

        /* Alert styling */
        .alert {
            padding: 12px 16px;
            border-radius: var(--radius-sm);
            font-size: 0.9rem;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fca5a5;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.15);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: #a7f3d0;
        }
    </style>
</head>
<body>
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>

    <div class="login-container">
        <div class="login-header">
            <div class="login-logo">
                <div class="login-logo-icon">
                    <i data-lucide="shield-check"></i>
                </div>
                <div class="login-logo-text">
                    PT.ITS<span> Admin</span>
                </div>
            </div>
            <p class="login-title">Masuk ke Panel Kontrol Administrator</p>
        </div>

        @if($errors->has('login'))
            <div class="alert alert-danger">
                <i data-lucide="alert-circle" style="flex-shrink: 0; width: 18px; height: 18px;"></i>
                <span>{{ $errors->first('login') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                <i data-lucide="alert-circle" style="flex-shrink: 0; width: 18px; height: 18px;"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">
                <i data-lucide="check-circle" style="flex-shrink: 0; width: 18px; height: 18px;"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="username" class="form-label">Username</label>
                <div class="input-wrapper">
                    <input type="text" name="username" id="username" class="form-input" placeholder="Masukkan username" value="{{ old('username') }}" required autofocus>
                    <i data-lucide="user" class="input-icon"></i>
                </div>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <div class="input-wrapper">
                    <input type="password" name="password" id="password" class="form-input" placeholder="Masukkan password" required>
                    <i data-lucide="lock" class="input-icon"></i>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-login">
                <span>Masuk Dashboard</span>
                <i data-lucide="log-in"></i>
            </button>
        </form>

        <a href="/" class="back-link">
            <i data-lucide="arrow-left" style="width: 16px; height: 16px;"></i>
            <span>Kembali ke Beranda</span>
        </a>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
