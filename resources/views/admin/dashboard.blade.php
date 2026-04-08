@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('styles')
    /* ===== DASHBOARD SPECIFIC ===== */
    .dashboard-date {
        font-size: 16px;
        color: var(--text-muted);
        margin-bottom: 28px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 500;
    }

    .stats-grid-6 {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 32px;
    }

    .stat-card-v2 {
        background: var(--bg-card);
        border-radius: var(--radius);
        padding: 24px;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border);
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .stat-card-v2:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-lg);
        border-color: var(--primary);
    }

    .stat-card-icon {
        width: 60px;
        height: 60px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        flex-shrink: 0;
        box-shadow: 0 4px 10px rgba(0,0,0,0.04);
    }

    .stat-card-icon.blue   { background: #eff6ff; color: #2563eb; }
    .stat-card-icon.green  { background: #ecfdf5; color: #10b981; }
    .stat-card-icon.orange { background: #fff7ed; color: #f97316; }
    .stat-card-icon.purple { background: #faf5ff; color: #a855f7; }
    .stat-card-icon.teal   { background: #f0fdfa; color: #14b8a6; }
    .stat-card-icon.pink   { background: #fff1f2; color: #f43f5e; }

    .stat-card-info {
        flex: 1;
        min-width: 0;
    }

    .stat-card-value {
        font-size: 28px;
        font-weight: 800;
        color: var(--text-main);
        line-height: 1.1;
    }

    .stat-card-label {
        font-size: 14px;
        color: var(--text-muted);
        margin-top: 4px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Two column grid */
    .two-col-grid {
        display: grid;
        grid-template-columns: 1.5fr 1fr;
        gap: 28px;
        margin-bottom: 28px;
    }

    /* Welcome hero */
    .welcome-hero {
        background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);
        color: #ffffff;
        border-radius: var(--radius-lg);
        padding: 40px;
        position: relative;
        overflow: hidden;
        box-shadow: var(--shadow-lg);
    }

    .welcome-hero::before {
        content: '🌿';
        position: absolute;
        right: 0;
        bottom: -20px;
        font-size: 150px;
        opacity: 0.1;
        transform: rotate(-15deg);
    }

    .welcome-hero h2 {
        font-size: 32px;
        font-weight: 800;
        margin-bottom: 12px;
        border: none;
        padding: 0;
        color: #ffffff;
        letter-spacing: -1px;
    }

    .welcome-hero p {
        font-size: 18px;
        color: rgba(255, 255, 255, 0.8);
        line-height: 1.7;
        max-width: 500px;
    }

    .welcome-role-badge {
        display: inline-block;
        background: rgba(255, 255, 255, 0.15);
        color: #ffffff;
        padding: 6px 18px;
        border-radius: 10px;
        font-weight: 700;
        font-size: 14px;
        margin-top: 20px;
        backdrop-filter: blur(8px);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    /* Quick info card */
    .quick-info {
        background: var(--bg-card);
        border-radius: var(--radius-lg);
        padding: 32px;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border);
    }

    .quick-info h3 {
        font-size: 20px;
        font-weight: 800;
        color: var(--primary);
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 14px 0;
        border-bottom: 1px solid var(--border);
        font-size: 16px;
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-row-label {
        color: var(--text-muted);
        font-weight: 500;
    }

    .info-row-value {
        font-weight: 700;
        color: var(--text-main);
    }

    /* Recent users table */
    .recent-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .recent-table thead th {
        text-align: left;
        font-size: 12px;
        font-weight: 700;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 16px 20px;
        background: #f8fafc;
        border-bottom: 1px solid var(--border);
    }

    .recent-table tbody td {
        padding: 16px 20px;
        font-size: 15px;
        border-bottom: 1px solid var(--border);
        color: var(--text-main);
    }

    .recent-table tbody tr:hover {
        background: #f1f5f9;
        transition: background 0.2s;
    }

    .recent-table tbody tr:last-child td {
        border-bottom: none;
    }

    .user-badge {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        font-weight: 800;
        color: var(--text-main);
    }

    .user-badge-avatar {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: var(--primary-soft);
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: 800;
        flex-shrink: 0;
    }

    .empty-state {
        text-align: center;
        padding: 48px;
        color: var(--text-muted);
        font-size: 16px;
        font-weight: 500;
    }

    @media (max-width: 1200px) {
        .two-col-grid {
            grid-template-columns: 1fr;
        }
    }
@endsection

@section('content')
    {{-- Ngày hiện tại --}}
    <div class="dashboard-date">
        📅 {{ \Carbon\Carbon::now()->locale('vi')->isoFormat('dddd, D MMMM YYYY') }}
    </div>

    {{-- 6 thẻ thống kê --}}
    <div class="stats-grid-6">
        <div class="stat-card-v2">
            <div class="stat-card-icon blue">👤</div>
            <div class="stat-card-info">
                <div class="stat-card-value">{{ $stats['patients'] }}</div>
                <div class="stat-card-label">Bệnh nhân</div>
            </div>
        </div>
        <div class="stat-card-v2">
            <div class="stat-card-icon green">📋</div>
            <div class="stat-card-info">
                <div class="stat-card-value">{{ $stats['records'] }}</div>
                <div class="stat-card-label">Hồ sơ bệnh án</div>
            </div>
        </div>
        <div class="stat-card-v2">
            <div class="stat-card-icon orange">💊</div>
            <div class="stat-card-info">
                <div class="stat-card-value">{{ $stats['prescriptions'] }}</div>
                <div class="stat-card-label">Đơn thuốc</div>
            </div>
        </div>
        <div class="stat-card-v2">
            <div class="stat-card-icon teal">🌿</div>
            <div class="stat-card-info">
                <div class="stat-card-value">{{ $stats['herbs'] }}</div>
                <div class="stat-card-label">Dược liệu</div>
            </div>
        </div>
        <div class="stat-card-v2">
            <div class="stat-card-icon purple">📝</div>
            <div class="stat-card-info">
                <div class="stat-card-value">{{ $stats['posts'] }}</div>
                <div class="stat-card-label">Bài viết</div>
            </div>
        </div>
        <div class="stat-card-v2">
            <div class="stat-card-icon pink">💬</div>
            <div class="stat-card-info">
                <div class="stat-card-value">{{ $stats['comments'] }}</div>
                <div class="stat-card-label">Bình luận</div>
            </div>
        </div>
    </div>

    {{-- Hero chào mừng + Hệ thống tóm tắt --}}
    <div class="two-col-grid">
        <div class="welcome-hero">
            <h2>Chào mừng trở lại! 👋</h2>
            <p>
                Xin chào <strong>{{ auth()->user()->name }}</strong>, bạn đang quản trị hệ thống
                <strong>AmaTrung — Nhà thuốc Y học cổ truyền</strong>.
                Sử dụng menu bên trái để quản lý bệnh nhân, hồ sơ, đơn thuốc và dược liệu.
            </p>
            @foreach(auth()->user()->roles as $role)
                <span class="welcome-role-badge">{{ $role->display_name }}</span>
            @endforeach
        </div>

        <div class="quick-info">
            <h3>📊 Tổng quan hệ thống</h3>
            <div class="info-row">
                <span class="info-row-label">Tổng tài khoản</span>
                <span class="info-row-value">{{ $stats['users'] }}</span>
            </div>
            <div class="info-row">
                <span class="info-row-label">Nhân viên</span>
                <span class="info-row-value">{{ $stats['staff'] }}</span>
            </div>
            <div class="info-row">
                <span class="info-row-label">Dược liệu</span>
                <span class="info-row-value">{{ $stats['herbs'] }}</span>
            </div>
            <div class="info-row">
                <span class="info-row-label">Bài viết</span>
                <span class="info-row-value">{{ $stats['posts'] }}</span>
            </div>
            <div class="info-row">
                <span class="info-row-label">Bình luận</span>
                <span class="info-row-value">{{ $stats['comments'] }}</span>
            </div>
        </div>
    </div>

    {{-- Tài khoản mới đăng ký --}}
    <div class="content-card">
        <h2>Tài khoản mới đăng ký</h2>
        @if(count($recentUsers) > 0)
            <div style="overflow-x: auto;">
                <table class="recent-table">
                    <thead>
                        <tr>
                            <th>Họ tên</th>
                            <th>Email</th>
                            <th>SĐT</th>
                            <th>Ngày tham gia</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentUsers as $u)
                            <tr>
                                <td>
                                    <span class="user-badge">
                                        <span class="user-badge-avatar">
                                            {{ strtoupper(substr($u->name, 0, 1)) }}
                                        </span>
                                        {{ $u->name }}
                                    </span>
                                </td>
                                <td>{{ $u->email }}</td>
                                <td>{{ $u->phone ?? '—' }}</td>
                                <td>{{ \Carbon\Carbon::parse($u->created_at)->format('d/m/Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty-state">
                📭 Chưa có tài khoản nào được đăng ký.
            </div>
        @endif
    </div>
@endsection