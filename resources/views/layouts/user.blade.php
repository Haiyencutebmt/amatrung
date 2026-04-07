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
        /* ===== RESET & BASE ===== */
        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            font-size: 17px;
        }

        body {
            font-family: 'Be Vietnam Pro', Arial, sans-serif;
            background: #faf7f2;
            color: #2d3a2e;
            min-height: 100vh;
            line-height: 1.7;
            display: flex;
            flex-direction: column;
        }

        a {
            color: #2f7d4a;
            text-decoration: none;
        }

        a:hover {
            color: #1a5632;
        }

        /* ===== NAVBAR ===== */
        .user-navbar {
            background: #ffffff;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
            position: sticky;
            top: 0;
            z-index: 100;
            border-bottom: 3px solid #2f7d4a;
        }

        .navbar-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 72px;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .brand-icon {
            font-size: 32px;
            line-height: 1;
        }

        .brand-name {
            font-size: 26px;
            font-weight: 700;
            color: #1a5632;
            letter-spacing: -0.5px;
        }

        .brand-sub {
            font-size: 12px;
            color: #5a6b5e;
            display: block;
            margin-top: -4px;
        }

        /* Navbar links */
        .navbar-links {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-link {
            padding: 10px 18px;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 500;
            color: #2d3a2e;
            transition: all 0.2s;
            text-decoration: none;
        }

        .nav-link:hover {
            background: #f0f7f1;
            color: #1a5632;
        }

        .nav-link.active {
            background: #e8f5e9;
            color: #1a5632;
            font-weight: 600;
        }

        /* User dropdown */
        .user-menu {
            position: relative;
            margin-left: 12px;
        }

        .user-menu-trigger {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 16px;
            border: 1px solid #d9e4d8;
            border-radius: 12px;
            background: #fafff8;
            cursor: pointer;
            transition: all 0.2s;
            font-family: inherit;
            font-size: 15px;
        }

        .user-menu-trigger:hover {
            border-color: #2f7d4a;
            background: #f0f7f1;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, #2f7d4a, #3a8a52);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            font-weight: 700;
            flex-shrink: 0;
        }

        .user-name-text {
            font-weight: 600;
            color: #2d3a2e;
        }

        .dropdown-arrow {
            font-size: 12px;
            color: #5a6b5e;
            transition: transform 0.2s;
        }

        .user-dropdown {
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            background: #ffffff;
            border: 1px solid #e4ddd2;
            border-radius: 14px;
            padding: 8px;
            min-width: 200px;
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.12);
            display: none;
            z-index: 110;
            animation: dropdownFade 0.2s ease;
        }

        .user-dropdown.show {
            display: block;
        }

        @keyframes dropdownFade {
            from { opacity: 0; transform: translateY(-8px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 15px;
            color: #2d3a2e;
            transition: background 0.15s;
            text-decoration: none;
            border: none;
            background: none;
            width: 100%;
            cursor: pointer;
            font-family: inherit;
        }

        .dropdown-item:hover {
            background: #f0f7f1;
        }

        .dropdown-divider {
            height: 1px;
            background: #e4ddd2;
            margin: 6px 8px;
        }

        .dropdown-item.danger {
            color: #b91c1c;
        }

        .dropdown-item.danger:hover {
            background: #fff5f5;
        }

        /* Mobile menu toggle */
        .mobile-toggle {
            display: none;
            background: none;
            border: 1px solid #d9e4d8;
            border-radius: 10px;
            font-size: 24px;
            padding: 6px 10px;
            cursor: pointer;
            color: #2d3a2e;
        }

        /* ===== MAIN CONTENT ===== */
        .user-content {
            flex: 1;
            max-width: 1200px;
            width: 100%;
            margin: 0 auto;
            padding: 32px 24px;
        }

        /* ===== FOOTER ===== */
        .user-footer {
            background: linear-gradient(180deg, #1a5632 0%, #14432a 100%);
            color: rgba(255, 255, 255, 0.85);
            margin-top: auto;
        }

        .footer-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 24px 24px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 40px;
            margin-bottom: 28px;
        }

        .footer-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 14px;
        }

        .footer-brand-icon {
            font-size: 28px;
        }

        .footer-brand-name {
            font-size: 22px;
            font-weight: 700;
            color: #a8e6b8;
        }

        .footer-desc {
            font-size: 15px;
            line-height: 1.7;
            color: rgba(255, 255, 255, 0.7);
        }

        .footer-heading {
            font-size: 16px;
            font-weight: 700;
            color: #a8e6b8;
            margin-bottom: 14px;
        }

        .footer-link {
            display: block;
            padding: 5px 0;
            color: rgba(255, 255, 255, 0.7);
            font-size: 15px;
            transition: color 0.2s;
            text-decoration: none;
        }

        .footer-link:hover {
            color: #ffffff;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.12);
            padding-top: 20px;
            text-align: center;
            font-size: 14px;
            color: rgba(255, 255, 255, 0.5);
        }

        /* ===== UTILITY CLASSES ===== */
        .content-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 28px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
            border: 1px solid #e8e2d8;
            margin-bottom: 24px;
        }

        .content-card h2 {
            font-size: 22px;
            font-weight: 700;
            color: #1a5632;
            margin-bottom: 16px;
        }

        .alert {
            padding: 16px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 15px;
            font-weight: 500;
        }

        .alert-success {
            background: #effcf3;
            color: #1f7a3d;
            border: 1px solid #bbf7d0;
        }

        .alert-danger {
            background: #fff5f5;
            color: #b42318;
            border: 1px solid #fecaca;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .navbar-links {
                display: none;
                position: absolute;
                top: 72px;
                left: 0;
                right: 0;
                background: #ffffff;
                flex-direction: column;
                padding: 12px;
                border-bottom: 2px solid #2f7d4a;
                box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
            }

            .navbar-links.show {
                display: flex;
            }

            .mobile-toggle {
                display: flex;
            }

            .user-menu {
                margin-left: 0;
                width: 100%;
            }

            .user-menu-trigger {
                width: 100%;
                justify-content: center;
            }

            .footer-grid {
                grid-template-columns: 1fr;
                gap: 28px;
            }

            .user-content {
                padding: 20px 16px;
            }
        }

        /* ===== PAGE ANIMATION ===== */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .user-content {
            animation: fadeInUp 0.4s ease;
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
