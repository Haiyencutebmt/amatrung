{{-- Sidebar Admin - AmaTrung --}}
<aside class="admin-sidebar" id="adminSidebar">
    {{-- Logo --}}
    <div class="sidebar-logo">
        <span class="logo-icon">🌿</span>
        <span class="logo-text">AmaTrung</span>
    </div>
    <div class="sidebar-subtitle">Hệ thống Quản lý Y học cổ truyền</div>

    {{-- Navigation --}}
    <nav class="sidebar-nav">
        <a href="{{ route('admin.dashboard') }}"
           class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <span class="nav-icon">🏠</span>
            <span class="nav-label">Bảng điều khiển</span>
        </a>
        
        <div style="padding: 10px 18px 5px; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: rgba(255,255,255,0.4); font-weight: 700;">Nghiệp vụ</div>
        
        <a href="{{ route('admin.patients.index') }}"
           class="nav-item {{ request()->routeIs('admin.patients.*') ? 'active' : '' }}">
            <span class="nav-icon">👤</span>
            <span class="nav-label">Bệnh nhân</span>
        </a>
        <a href="{{ route('admin.medical-records.index') }}"
           class="nav-item {{ request()->routeIs('admin.medical-records.*') ? 'active' : '' }}">
            <span class="nav-icon">📋</span>
            <span class="nav-label">Hồ sơ bệnh án</span>
        </a>
        <a href="{{ route('admin.prescriptions.index') }}"
           class="nav-item {{ request()->routeIs('admin.prescriptions.*') ? 'active' : '' }}">
            <span class="nav-icon">💊</span>
            <span class="nav-label">Đơn thuốc</span>
        </a>
        <a href="{{ route('admin.medicinal-herbs.index') }}"
           class="nav-item {{ request()->routeIs('admin.medicinal-herbs.*') ? 'active' : '' }}">
            <span class="nav-icon">🍃</span>
            <span class="nav-label">Kho Dược liệu</span>
        </a>

        <div style="padding: 20px 18px 5px; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: rgba(255,255,255,0.4); font-weight: 700;">Nội dung & Báo cáo</div>

        <a href="{{ route('admin.articles.index') }}"
           class="nav-item {{ request()->routeIs('admin.articles.*') ? 'active' : '' }}">
            <span class="nav-icon">📝</span>
            <span class="nav-label">Bài viết y khoa</span>
        </a>
        <a href="{{ route('admin.comments.index') }}"
           class="nav-item {{ request()->routeIs('admin.comments.*') ? 'active' : '' }}">
            <span class="nav-icon">💬</span>
            <span class="nav-label">Bình luận</span>
        </a>
        <a href="{{ route('admin.reports.index') }}"
           class="nav-item {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
            <span class="nav-icon">📊</span>
            <span class="nav-label">Thống kê chi tiết</span>
        </a>

        <div style="height: 1px; background: rgba(255,255,255,0.1); margin: 15px 18px;"></div>
        
        <a href="#" class="nav-item">
            <span class="nav-icon">⚙️</span>
            <span class="nav-label">Cài đặt hệ thống</span>
        </a>
    </nav>

    {{-- User info dưới cùng sidebar --}}
    <div class="sidebar-user">
        <div class="sidebar-user-avatar">
            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
        </div>
        <div class="sidebar-user-info">
            <div class="sidebar-user-name">{{ auth()->user()->name }}</div>
            <div class="sidebar-user-role">
                @foreach(auth()->user()->roles as $role)
                    {{ $role->display_name }}
                @endforeach
            </div>
        </div>
    </div>
</aside>
