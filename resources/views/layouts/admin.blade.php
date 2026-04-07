<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Quản trị') — AmaTrung</title>
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
            background: #f5f0e8;
            color: #2d3a2e;
            min-height: 100vh;
            line-height: 1.7;
        }

        /* ===== LAYOUT GRID ===== */
        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* ===== SIDEBAR ===== */
        .admin-sidebar {
            width: 270px;
            min-height: 100vh;
            background: linear-gradient(180deg, #14432a 0%, #1a5632 40%, #1e6b3a 100%);
            color: #ffffff;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            z-index: 100;
            display: flex;
            flex-direction: column;
            transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 4px 0 24px rgba(0, 0, 0, 0.12);
            overflow-y: auto;
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 28px 24px 8px;
        }

        .logo-icon {
            font-size: 32px;
            line-height: 1;
        }

        .logo-text {
            font-size: 26px;
            font-weight: 700;
            letter-spacing: -0.5px;
            color: #a8e6b8;
        }

        .sidebar-subtitle {
            padding: 0 24px 20px;
            font-size: 13px;
            color: rgba(255, 255, 255, 0.55);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 8px;
        }

        /* Nav items */
        .sidebar-nav {
            flex: 1;
            padding: 8px 12px;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 14px 18px;
            border-radius: 12px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-size: 16px;
            font-weight: 500;
            transition: all 0.2s ease;
            position: relative;
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            transform: translateX(4px);
        }

        .nav-item.active {
            background: rgba(255, 255, 255, 0.18);
            color: #ffffff;
            font-weight: 600;
            box-shadow: inset 3px 0 0 #7ed69a;
        }

        .nav-icon {
            font-size: 20px;
            width: 28px;
            text-align: center;
            flex-shrink: 0;
        }

        .nav-label {
            white-space: nowrap;
        }

        /* Sidebar user info bottom */
        .sidebar-user {
            padding: 18px 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: auto;
        }

        .sidebar-user-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            font-weight: 700;
            color: #a8e6b8;
            flex-shrink: 0;
        }

        .sidebar-user-info {
            overflow: hidden;
        }

        .sidebar-user-name {
            font-size: 14px;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sidebar-user-role {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.55);
        }

        /* ===== MAIN CONTENT AREA ===== */
        .admin-main {
            flex: 1;
            margin-left: 270px;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            transition: margin-left 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* ===== HEADER ===== */
        .admin-header {
            height: 68px;
            background: #ffffff;
            border-bottom: 1px solid #e4ddd2;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            position: sticky;
            top: 0;
            z-index: 90;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .sidebar-toggle {
            display: none;
            background: none;
            border: 1px solid #d9e4d8;
            border-radius: 10px;
            font-size: 22px;
            padding: 6px 10px;
            cursor: pointer;
            color: #2d3a2e;
            transition: background 0.2s;
        }

        .sidebar-toggle:hover {
            background: #f0ebe3;
        }

        .page-title {
            font-size: 22px;
            font-weight: 700;
            color: #1a5632;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .header-greeting {
            font-size: 15px;
            color: #5a6b5e;
        }

        .btn-logout {
            background: #fff5f5;
            border: 1px solid #fecaca;
            color: #b91c1c;
            padding: 8px 18px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            font-family: inherit;
        }

        .btn-logout:hover {
            background: #fee2e2;
            border-color: #f87171;
        }

        /* ===== CONTENT ===== */
        .admin-content {
            flex: 1;
            padding: 32px;
        }

        /* ===== FOOTER ===== */
        .admin-footer {
            padding: 20px 32px;
            text-align: center;
            font-size: 14px;
            color: #8a9b8e;
            border-top: 1px solid #e4ddd2;
            background: #faf7f2;
        }

        /* ===== OVERLAY (mobile) ===== */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.4);
            z-index: 99;
            opacity: 0;
            transition: opacity 0.35s;
        }

        .sidebar-overlay.show {
            display: block;
            opacity: 1;
        }

        /* ===== UTILITY CLASSES ===== */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 28px;
        }

        .stat-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
            border: 1px solid #e8e2d8;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        }

        .stat-icon {
            font-size: 36px;
            margin-bottom: 12px;
        }

        .stat-value {
            font-size: 32px;
            font-weight: 700;
            color: #1a5632;
            line-height: 1.2;
        }

        .stat-label {
            font-size: 15px;
            color: #5a6b5e;
            margin-top: 4px;
        }

        .content-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 28px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
            border: 1px solid #e8e2d8;
            margin-bottom: 24px;
        }

        .content-card h2 {
            font-size: 20px;
            font-weight: 700;
            color: #1a5632;
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 2px solid #e8f5e9;
        }

        /* ===== ALERTS ===== */
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

        .alert-warning {
            background: #fffbeb;
            color: #92400e;
            border: 1px solid #fde68a;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 1024px) {
            .admin-sidebar {
                transform: translateX(-100%);
            }

            .admin-sidebar.open {
                transform: translateX(0);
            }

            .admin-main {
                margin-left: 0;
            }

            .sidebar-toggle {
                display: flex;
            }

            .admin-content {
                padding: 20px;
            }
        }

        @media (max-width: 600px) {
            .header-greeting {
                display: none;
            }

            .admin-header {
                padding: 0 16px;
            }

            .admin-content {
                padding: 16px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }
        }

        /* ===== SCROLLBAR ===== */
        .admin-sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .admin-sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        .admin-sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 3px;
        }

        /* ===== PAGE TRANSITION ===== */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .admin-content {
            animation: fadeIn 0.4s ease;
        }

        @yield('styles')
    </style>
</head>
<body>
    <div class="admin-wrapper">
        {{-- Overlay cho mobile --}}
        <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

        {{-- Sidebar --}}
        @include('partials.admin-sidebar')

        {{-- Main content --}}
        <div class="admin-main">
            {{-- Header --}}
            @include('partials.admin-header')

            {{-- Flash messages --}}
            <div class="admin-content">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                @if(session('warning'))
                    <div class="alert alert-warning">{{ session('warning') }}</div>
                @endif

                {{-- Page content --}}
                @yield('content')
            </div>

            {{-- Footer --}}
            @include('partials.admin-footer')
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('adminSidebar');
            const overlay = document.getElementById('sidebarOverlay');
            sidebar.classList.toggle('open');
            overlay.classList.toggle('show');
            document.body.style.overflow = sidebar.classList.contains('open') ? 'hidden' : '';
        }

        // Đóng sidebar khi nhấn Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const sidebar = document.getElementById('adminSidebar');
                if (sidebar.classList.contains('open')) {
                    toggleSidebar();
                }
            }
        });
    </script>

    @yield('scripts')
</body>
</html>
