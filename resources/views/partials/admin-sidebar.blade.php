{{-- Sidebar Admin - AmaTrung --}}
<aside class="admin-sidebar" id="adminSidebar">
    {{-- Logo --}}
    <div class="sidebar-logo">
        <span class="logo-icon">🌿</span>
        <span class="logo-text">AmaTrung</span>
    </div>
    <div class="sidebar-subtitle">Nhà thuốc Y học cổ truyền</div>

    {{-- Navigation --}}
    <nav class="sidebar-nav">
        <a href="{{ route('admin.dashboard') }}"
           class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <span class="nav-icon">🏠</span>
            <span class="nav-label">Dashboard</span>
        </a>
        <a href="#"
           class="nav-item {{ request()->routeIs('admin.patients.*') ? 'active' : '' }}">
            <span class="nav-icon">👤</span>
            <span class="nav-label">Bệnh nhân</span>
        </a>
        <a href="#"
           class="nav-item {{ request()->routeIs('admin.records.*') ? 'active' : '' }}">
            <span class="nav-icon">📋</span>
            <span class="nav-label">Hồ sơ bệnh án</span>
        </a>
        <a href="#"
           class="nav-item {{ request()->routeIs('admin.prescriptions.*') ? 'active' : '' }}">
            <span class="nav-icon">💊</span>
            <span class="nav-label">Đơn thuốc</span>
        </a>
        <a href="#"
           class="nav-item {{ request()->routeIs('admin.herbs.*') ? 'active' : '' }}">
            <span class="nav-icon">🌿</span>
            <span class="nav-label">Dược liệu</span>
        </a>
        <a href="#"
           class="nav-item {{ request()->routeIs('admin.posts.*') ? 'active' : '' }}">
            <span class="nav-icon">📝</span>
            <span class="nav-label">Bài viết</span>
        </a>
        <a href="#"
           class="nav-item {{ request()->routeIs('admin.comments.*') ? 'active' : '' }}">
            <span class="nav-icon">💬</span>
            <span class="nav-label">Bình luận</span>
        </a>
        <a href="#"
           class="nav-item {{ request()->routeIs('admin.accounts.*') ? 'active' : '' }}">
            <span class="nav-icon">👥</span>
            <span class="nav-label">Tài khoản</span>
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
