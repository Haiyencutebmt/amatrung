<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'AmaTrung') — Nhà thuốc Y học cổ truyền</title>
    <meta name="description" content="AmaTrung - Nhà thuốc Y học cổ truyền. Tư vấn sức khỏe, khám chữa bệnh bằng y học cổ truyền.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
    <style>
        :root {
            --primary: #2563eb;           /* Modern Medical Blue */
            --primary-hover: #1d4ed8;
            --primary-soft: #eff6ff;
            --accent: #10b981;            /* Herbal/Nature Green */
            --accent-hover: #059669;
            --accent-soft: #ecfdf5;
            --bg-page: #f8fafc;           /* Light blue-grey tint */
            --bg-card: #ffffff;
            --nav-bg: #1e3a8a;            /* Deep Navy for Footer */
            --text-main: #1e293b;
            --text-muted: #64748b;
            --border: #e2e8f0;
            --radius: 14px;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.1);
            --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.07), 0 2px 4px -1px rgba(0,0,0,0.05);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* ===== RESET & BASE ===== */
        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            font-size: 16px;
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Be Vietnam Pro', system-ui, -apple-system, sans-serif;
            background: var(--bg-page);
            color: var(--text-main);
            min-height: 100vh;
            line-height: 1.7;
            display: flex;
            flex-direction: column;
            -webkit-font-smoothing: antialiased;
        }

        a {
            color: var(--primary);
            text-decoration: none;
            transition: var(--transition);
        }

        a:hover {
            color: var(--primary-hover);
        }

        /* ===== NAVBAR ===== */
        .user-navbar {
            background: #ffffff;
            box-shadow: var(--shadow-sm);
            position: sticky;
            top: 0;
            z-index: 100;
            border-bottom: 2px solid var(--primary);
        }

        .navbar-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 80px;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 14px;
            text-decoration: none;
        }

        .brand-icon {
            font-size: 36px;
            line-height: 1;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.05));
        }

        .brand-name {
            font-size: 28px;
            font-weight: 800;
            color: var(--text-main);
            letter-spacing: -1px;
        }

        .brand-sub {
            font-size: 12px;
            color: var(--text-muted);
            display: block;
            margin-top: -6px;
            font-weight: 500;
        }

        /* Navbar links */
        .navbar-links {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .nav-link {
            padding: 12px 20px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            color: var(--text-main);
            transition: var(--transition);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-link:hover {
            background: var(--primary-soft);
            color: var(--primary);
            transform: translateY(-1px);
        }

        .nav-link.active {
            background: var(--primary-soft);
            color: var(--primary);
            box-shadow: inset 0 -2px 0 var(--primary);
        }

        /* User dropdown */
        .user-menu {
            position: relative;
            margin-left: 12px;
        }

        .user-menu-trigger {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 16px;
            border: 1px solid var(--border);
            border-radius: 16px;
            background: #fff;
            cursor: pointer;
            transition: var(--transition);
            font-family: inherit;
            font-size: 15px;
            color: var(--text-main);
        }

        .user-menu-trigger:hover {
            border-color: var(--primary);
            background: var(--primary-soft);
            box-shadow: var(--shadow-sm);
        }

        .user-avatar {
            width: 38px;
            height: 38px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--primary), var(--primary-hover));
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            font-weight: 800;
            flex-shrink: 0;
            box-shadow: 0 4px 8px rgba(37, 99, 235, 0.2);
        }

        .user-name-text {
            font-weight: 700;
        }

        .dropdown-arrow {
            font-size: 10px;
            opacity: 0.5;
            transition: transform 0.2s;
        }

        .user-dropdown {
            position: absolute;
            top: calc(100% + 12px);
            right: 0;
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 10px;
            min-width: 240px;
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.12);
            display: none;
            z-index: 110;
            animation: dropdownFade 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .user-dropdown.show {
            display: block;
        }

        @keyframes dropdownFade {
            from { opacity: 0; transform: translateY(-10px) scale(0.95); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-radius: 12px;
            font-size: 15px;
            color: var(--text-main);
            transition: var(--transition);
            text-decoration: none;
            border: none;
            background: none;
            width: 100%;
            cursor: pointer;
            font-family: inherit;
            font-weight: 600;
        }

        .dropdown-item:hover {
            background: var(--primary-soft);
            color: var(--primary);
            padding-left: 20px;
        }

        .dropdown-divider {
            height: 1px;
            background: var(--border);
            margin: 8px;
        }

        .dropdown-item.danger {
            color: #dc2626;
        }

        .dropdown-item.danger:hover {
            background: #fef2f2;
            color: #dc2626;
        }

        /* Mobile menu toggle */
        .mobile-toggle {
            display: none;
            background: none;
            border: 1.5px solid var(--border);
            border-radius: 12px;
            font-size: 24px;
            width: 44px;
            height: 44px;
            cursor: pointer;
            color: var(--text-main);
            transition: var(--transition);
        }

        .mobile-toggle:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        /* ===== MAIN CONTENT ===== */
        .user-content {
            flex: 1;
            max-width: 1200px;
            width: 100%;
            margin: 0 auto;
            padding: 48px 24px;
            animation: fadeInUp 0.5s ease-out;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* ===== UTILITY CARDS ===== */
        .content-card {
            background: var(--bg-card);
            border-radius: 20px;
            padding: 40px;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border);
            margin-bottom: 32px;
        }

        .content-card h2 {
            font-size: 26px;
            font-weight: 800;
            color: var(--text-main);
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .content-card h2::before {
            content: "";
            width: 6px;
            height: 32px;
            background: var(--accent);
            border-radius: 3px;
        }

        /* ===== ALERTS ===== */
        .alert {
            padding: 18px 24px;
            border-radius: 16px;
            margin-bottom: 32px;
            font-size: 16px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 12px;
            border-left: 6px solid transparent;
            box-shadow: var(--shadow-sm);
        }

        .alert-success {
            background: var(--accent-soft);
            color: var(--accent-hover);
            border-color: var(--accent);
            border-left-color: var(--accent);
        }

        .alert-danger {
            background: #fef2f2;
            color: #dc2626;
            border-color: #fecaca;
            border-left-color: #dc2626;
        }

        /* ===== FOOTER ===== */
        .user-footer {
            background: linear-gradient(135deg, var(--nav-bg) 0%, #1e40af 100%);
            color: rgba(255, 255, 255, 0.9);
            margin-top: auto;
            padding-top: 60px;
        }

        .footer-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px 40px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 60px;
            margin-bottom: 48px;
        }

        .footer-brand {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 20px;
        }

        .footer-brand-icon {
            font-size: 32px;
            filter: drop-shadow(0 2px 10px rgba(0,0,0,0.2));
        }

        .footer-brand-name {
            font-size: 28px;
            font-weight: 800;
            color: #ffffff;
            letter-spacing: -1px;
        }

        .footer-desc {
            font-size: 16px;
            line-height: 1.8;
            color: rgba(255, 255, 255, 0.7);
            max-width: 450px;
        }

        .footer-heading {
            font-size: 18px;
            font-weight: 800;
            color: #ffffff;
            margin-bottom: 20px;
            position: relative;
        }

        .footer-heading::after {
            content: "";
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 40px;
            height: 3px;
            background: var(--accent);
            border-radius: 2px;
        }

        .footer-link {
            display: block;
            padding: 8px 0;
            color: rgba(255, 255, 255, 0.7);
            font-size: 16px;
            transition: var(--transition);
            text-decoration: none;
        }

        .footer-link:hover {
            color: #ffffff;
            transform: translateX(6px);
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 32px;
            text-align: center;
            font-size: 14px;
            color: rgba(255, 255, 255, 0.5);
            font-weight: 500;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .navbar-inner { height: 72px; padding: 0 20px; }
            .navbar-links {
                display: none;
                position: absolute;
                top: 72px;
                left: 0;
                right: 0;
                background: #ffffff;
                flex-direction: column;
                padding: 16px;
                border-bottom: 1px solid var(--border);
                box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
                gap: 8px;
            }

            .navbar-links.show { display: flex; }
            .mobile-toggle { display: flex; align-items: center; justify-content: center; }
            .nav-link { width: 100%; border-radius: 12px; }
            
            .footer-grid { grid-template-columns: 1fr; gap: 40px; }
            .user-content { padding: 32px 16px; }
            .content-card { padding: 24px; border-radius: 16px; }
            .navbar-brand .brand-name { font-size: 24px; }
        }

        @yield('styles')
    </style>
</head>
<body>
    {{-- Navbar --}}
    <nav class="user-navbar">
        <div class="navbar-inner">
            <a href="{{ route('user.dashboard') }}" class="navbar-brand">
                <span class="brand-icon">🌿</span>
                <div>
                    <span class="brand-name">AmaTrung</span>
                    <span class="brand-sub">Y học cổ truyền</span>
                </div>
            </a>

            <button class="mobile-toggle" id="mobileToggle" onclick="toggleMobileMenu()">☰</button>

            <div class="navbar-links" id="navbarLinks">
                <a href="{{ route('user.dashboard') }}"
                   class="nav-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                    🏠 Trang chủ
                </a>
                <a href="{{ route('user.articles.index') }}" class="nav-link {{ request()->routeIs('user.articles.*') ? 'active' : '' }}">📝 Bài viết</a>
                <a href="{{ route('user.medicinal-herbs.index') }}" class="nav-link {{ request()->routeIs('user.medicinal-herbs.*') ? 'active' : '' }}">🌿 Từ điển Dược liệu</a>
                <a href="#" class="nav-link">📞 Liên hệ</a>

                {{-- User dropdown --}}
                <div class="user-menu">
                    <button class="user-menu-trigger" onclick="toggleUserDropdown(event)">
                        <span class="user-avatar">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </span>
                        <span class="user-name-text">{{ auth()->user()->name }}</span>
                        <span class="dropdown-arrow">▼</span>
                    </button>
                    <div class="user-dropdown" id="userDropdown">
                        <a href="#" class="dropdown-item">
                            <span>👤</span> Hồ sơ cá nhân
                        </a>
                        <a href="#" class="dropdown-item">
                            <span>📋</span> Lịch sử khám
                        </a>
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item danger">
                                <span>🚪</span> Đăng xuất
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    {{-- Content --}}
    <main class="user-content">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="user-footer">
        <div class="footer-inner">
            <div class="footer-grid">
                <div>
                    <div class="footer-brand">
                        <span class="footer-brand-icon">🌿</span>
                        <span class="footer-brand-name">AmaTrung</span>
                    </div>
                    <p class="footer-desc">
                        Nhà thuốc Y học cổ truyền AmaTrung — Chuyên tư vấn, khám và điều trị
                        bằng các phương pháp y học cổ truyền kết hợp hiện đại.
                        Chăm sóc sức khỏe toàn diện cho mọi gia đình.
                    </p>
                </div>
                <div>
                    <div class="footer-heading">Liên kết</div>
                    <a href="#" class="footer-link">Giới thiệu</a>
                    <a href="#" class="footer-link">Bài viết sức khỏe</a>
                    <a href="#" class="footer-link">Dược liệu</a>
                    <a href="#" class="footer-link">Liên hệ</a>
                </div>
                <div>
                    <div class="footer-heading">Liên hệ</div>
                    <p class="footer-link">📍 Địa chỉ nhà thuốc</p>
                    <p class="footer-link">📞 0xxx xxx xxx</p>
                    <p class="footer-link">✉️ info@amatrung.vn</p>
                </div>
            </div>
            <div class="footer-bottom">
                &copy; {{ date('Y') }} AmaTrung — Nhà thuốc Y học cổ truyền. Mọi quyền được bảo lưu.
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        function toggleMobileMenu() {
            document.getElementById('navbarLinks').classList.toggle('show');
        }

        // User dropdown toggle
        function toggleUserDropdown(e) {
            e.stopPropagation();
            document.getElementById('userDropdown').classList.toggle('show');
        }

        // Close dropdown on outside click
        document.addEventListener('click', function(e) {
            const dropdown = document.getElementById('userDropdown');
            if (dropdown && !e.target.closest('.user-menu')) {
                dropdown.classList.remove('show');
            }
        });

        // Close mobile menu on resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                document.getElementById('navbarLinks').classList.remove('show');
            }
        });
    </script>

    @yield('scripts')
</body>
</html>
