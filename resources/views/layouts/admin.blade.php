<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Quản trị') — AmaTrung</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root {
            --primary: #2563eb;
            /* Professional Medical Blue */
            --primary-hover: #1d4ed8;
            --primary-soft: #eff6ff;
            --accent: #10b981;
            /* Herbal/Nature Green */
            --accent-hover: #059669;
            --accent-soft: #ecfdf5;
            --bg-page: #f8fafc;
            /* Very light blue-grey background */
            --bg-sidebar: #1e3a8a;
            /* Deep Navy for Sidebar */
            --bg-card: #ffffff;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --border: #e2e8f0;
            --radius: 14px;
            --radius-lg: 20px;
            --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.07), 0 2px 4px -1px rgba(0, 0, 0, 0.05);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.07), 0 4px 6px -2px rgba(0, 0, 0, 0.04);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* ===== RESET & BASE ===== */
        *,
        *::before,
        *::after {
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
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
        }

        /* ===== LAYOUT GRID ===== */
        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* ===== SIDEBAR ===== */
        .admin-sidebar {
            width: 280px;
            min-height: 100vh;
            background: linear-gradient(180deg, var(--bg-sidebar) 0%, #1e40af 100%);
            color: #ffffff;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            z-index: 100;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease;
            box-shadow: 4px 0 20px rgba(15, 23, 42, 0.1);
            overflow-y: auto;
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 32px 24px 10px;
        }

        .logo-icon {
            font-size: 32px;
            line-height: 1;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
        }

        .logo-text {
            font-size: 26px;
            font-weight: 800;
            letter-spacing: -1px;
            color: #fff;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .sidebar-subtitle {
            padding: 0 24px 24px;
            font-size: 13px;
            color: rgba(255, 255, 255, 0.6);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            margin-bottom: 12px;
            font-weight: 500;
        }

        /* Nav items */
        .sidebar-nav {
            flex: 1;
            padding: 12px 14px;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 14px 18px;
            border-radius: var(--radius);
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
            transition: var(--transition);
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.06);
            color: #ffffff;
            transform: translateX(4px);
        }

        .nav-item.active {
            background: var(--primary);
            color: #ffffff;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        .nav-icon {
            font-size: 18px;
            width: 24px;
            text-align: center;
            flex-shrink: 0;
            transition: transform 0.2s;
        }

        .nav-item:hover .nav-icon {
            transform: scale(1.1);
        }

        /* Sidebar user info bottom */
        .sidebar-user {
            padding: 20px 24px;
            background: rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 14px;
            margin-top: auto;
        }

        .sidebar-user-avatar {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            font-weight: 800;
            color: #fff;
            flex-shrink: 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .sidebar-user-info {
            overflow: hidden;
        }

        .sidebar-user-name {
            font-size: 14px;
            font-weight: 700;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            color: #fff;
        }

        .sidebar-user-role {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.5);
            font-weight: 500;
        }

        /* ===== MAIN CONTENT AREA ===== */
        .admin-main {
            flex: 1;
            margin-left: 280px;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            transition: margin-left 0.3s ease;
        }

        /* ===== HEADER ===== */
        .admin-header {
            height: 72px;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            position: sticky;
            top: 0;
            z-index: 90;
            box-shadow: var(--shadow-sm);
        }

        .page-title {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-main);
            letter-spacing: -0.5px;
        }

        .btn-logout {
            background: #fff;
            border: 1px solid #fee2e2;
            color: #dc2626;
            padding: 10px 20px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            font-family: inherit;
        }

        .btn-logout:hover {
            background: #fef2f2;
            border-color: #f87171;
            transform: translateY(-1px);
        }

        /* ===== CONTENT ===== */
        .admin-content {
            flex: 1;
            padding: 32px;
            max-width: 1400px;
            width: 100%;
            margin: 0 auto;
            animation: fadeIn 0.4s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ===== UTILITY CARDS ===== */
        .content-card {
            background: var(--bg-card);
            border-radius: var(--radius-lg);
            padding: 30px;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border);
            margin-bottom: 28px;
        }

        .content-card h2 {
            font-size: 20px;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .content-card h2::after {
            content: "";
            height: 2px;
            flex: 1;
            background: linear-gradient(90deg, var(--primary-soft) 0%, transparent 100%);
            border-radius: 1px;
        }

        /* ===== STAT CARDS ===== */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 24px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: #ffffff;
            border-radius: var(--radius-lg);
            padding: 24px;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 20px;
            transition: var(--transition);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary);
        }

        .stat-icon {
            width: 64px;
            height: 64px;
            background: var(--primary-soft);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            color: var(--primary);
        }

        .stat-value {
            font-size: 28px;
            font-weight: 800;
            color: var(--text-main);
            line-height: 1.2;
        }

        .stat-label {
            font-size: 14px;
            color: var(--text-muted);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* ===== BUTTONS ===== */
        .btn-primary {
            background: var(--primary);
            color: #fff;
            border: none;
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            font-family: inherit;
        }

        .btn-primary:hover {
            background: var(--primary-hover);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
        }

        /* ===== ALERTS ===== */
        .alert {
            padding: 18px 24px;
            border-radius: var(--radius);
            margin-bottom: 24px;
            font-size: 15px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .alert-success {
            background: var(--accent-soft);
            color: var(--accent-hover);
            border: 1px solid var(--accent);
        }

        .alert-danger {
            background: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }

        /* ===== FOOTER ===== */
        .admin-footer {
            padding: 24px 32px;
            text-align: center;
            font-size: 14px;
            color: var(--text-muted);
            border-top: 1px solid var(--border);
            background: #fff;
            font-weight: 500;
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
        }

        @media (max-width: 600px) {
            .admin-content {
                padding: 20px 16px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .admin-header {
                padding: 0 20px;
            }

            .page-title {
                font-size: 20px;
            }
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

            {{-- Flash messages (SweetAlert2) --}}
            <div class="admin-content">

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
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                const sidebar = document.getElementById('adminSidebar');
                if (sidebar.classList.contains('open')) {
                    toggleSidebar();
                }
            }
        });
    </script>

    {{-- SweetAlert2 flash messages --}}
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Thành công!',
                text: @json(session('success')),
                confirmButtonColor: '#2f7d4a',
                confirmButtonText: 'Đóng',
                timer: 3000,
                timerProgressBar: true,
            });
        </script>
    @endif
    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Lỗi!',
                text: @json(session('error')),
                confirmButtonColor: '#b91c1c',
                confirmButtonText: 'Đóng',
            });
        </script>
    @endif
    @if(session('warning'))
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Cảnh báo!',
                text: @json(session('warning')),
                confirmButtonColor: '#e65100',
                confirmButtonText: 'Đóng',
            });
        </script>
    @endif

    @yield('scripts')
</body>

</html>