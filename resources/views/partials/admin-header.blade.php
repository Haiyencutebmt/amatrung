{{-- Header Admin - AmaTrung --}}
<header class="admin-header" id="adminHeader">
    <div class="header-left">
        <button class="sidebar-toggle" id="sidebarToggle" onclick="toggleSidebar()">
            <span>☰</span>
        </button>
        <h1 class="page-title">@yield('page-title', 'Dashboard')</h1>
    </div>
    <div class="header-right">
        <div class="header-greeting">
            Xin chào, <strong>{{ auth()->user()->name }}</strong>
        </div>
        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <button type="submit" class="btn-logout" title="Đăng xuất">
                🚪 Đăng xuất
            </button>
        </form>
    </div>
</header>
